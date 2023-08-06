<?php


namespace App\Http\Repositories;
use App\Http\Requests\PostCreateRequest;

use App\Models\Posts as Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Itstructure\GridView\DataProviders\EloquentDataProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class PostsRepository extends CoreRepository
{
    public function getModelClass(): string
    {
        return Model::class;
    }

    public function getAllPostsPagination($filter):LengthAwarePaginator
    {
        $posts = $this->startCondition()::select(['id','user_id','name','image','body','created_at','updated_at'])
            ->where('date_publish', '<', DB::raw('NOW()'))
            ->orWhere('date_publish', null)
            ->withCount('comments')
            ->with(['user'=> function($query){
                $query->select(['name','id']);
            }])
            ->orderBy('date_publish', 'DESC')
//            ->orderBy('created_at', 'DESC')
            ->filter($filter)
            ->paginate(Model::NUMBER_RECORDS_ONE_PAGE);
        return $posts;
    }

    /**
     * @param $post_id
     * @return LengthAwarePaginator
    **/
    public function getAllPostsAndComments(int $post_id):Collection
    {
        $posts = $this->startCondition()::select([
                'posts.id',
                'posts.user_id',
                'posts.name',
                'posts.image',
                'posts.body',
                'posts.created_at',
                'posts.updated_at'
            ])
            ->where(['posts.id' => $post_id])
            ->with(['comments' => function ($query) {
                $query->with(['user'=>function($query){
                    $query->select(['name','id']);
                }]);
            }])
            ->with(['user'=> function($query){
                $query->select(['name','id']);
            }])->limit(1)->get();


        $posts->transform(function ($post) {
            $posts = $this->buildCommentTree($post->comments);
            $post->comments = array_filter($posts,function ($data){
                return is_null($data->patent_id);
            });
            return $post;
        });

        return $posts;
    }

    private function buildCommentTree($comments, $parentId = null)
    {
        $branch = [];

        foreach ($comments as $comment_value) {
            if ($comment_value->parent_id === $parentId) {
                $comment_value->children = $this->buildCommentTree($comments, $comment_value->id);
                $branch[] = $comment_value;
            }
        }

        return $branch;
    }

    public function getAllPostGridTable():EloquentDataProvider
    {
        return new EloquentDataProvider($this->startCondition()::query());
    }

    /**
     * @param $id*
     * @return bool
     */
    public function softDeleteRecords(int $id):bool
    {
       $post = $this->getModelById($id);
       if (empty($post)) {
            return false;
       }
       $post->comments()->delete();
       $post->delete();

       return true;
    }

    /**
     * @param PostCreateRequest $data * -
     *  "name" => "rgergerg"
        "body" => "ergergerg"
        "date_publish" => "2023-08-06"
     * @return int id new records
     */
    public function createNewRecords(PostCreateRequest $data):int
    {

        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $data->image_path = $this->saveFilesImages($image);
        }

       DB::beginTransaction();

       try {
           $user = Auth::user();
           $model = $this->startCondition();
           $model->name = $data->input('name');
           $model->body = $data->input('body');
           $model->some_body = serialize($data->input('body'));
           $model->date_publish = Carbon::createFromFormat('Y-m-d', $data->date_publish)
               ->format('Y-m-d H:i:s');
           $model->user_id = $user->id;

           if (isset($data->image_path)) {
               $model->image = $data->image_path;
           }
           $model->save();

           DB::commit();

           return $model->id;
       } catch (QueryException $e){
           dd($e->getMessage());
           if(isset($data->image_path)) {
               $this->unlinkFileImage($data->image_path);
           }

           DB::rollback();
           throw new \Exception($e->getMessage(), 1);
       }

    }

    /**
     * @param int $id_post
     * @return Model|null
    **/
    public function getModelById(int $id_post):Model|null
    {
         return $this->startCondition()::find($id_post);
    }

    public function updatePost(int $post_id, PostCreateRequest $data )
    {

        $model = $this->getModelById($post_id);

        throw_if(empty($model),'Undefined records');

        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $model->image = $this->saveFilesImages($image);
        }

        DB::beginTransaction();

        try {

            $user = Auth::user();
            $model->name = $data->input('name');
            $model->body = $data->input('body');
            $model->some_body = serialize($data->input('body'));
            $model->user_id = $user->id;
            $model->save();

            DB::commit();

            return $model->id;
        } catch (QueryException $e){

            if(isset($data->image_path)) {
                $this->unlinkFileImage($model->image);
            }

            DB::rollback();
            throw new \Exception($e->getMessage(), 1);
        }


    }

    /**
     * @param UploadedFile $file
     * @return string path to file
     */
    private function saveFilesImages(UploadedFile $file):string
    {
        $image_name_info = pathinfo($file->getClientOriginalName());
        $new_image_name = sprintf('%s.%s',
            md5($image_name_info['filename'].time()),
            $image_name_info['extension']
        );

        Storage::disk('public')->putFileAs('images\posts', $file, $new_image_name);
        Storage::setVisibility($new_image_name, 'public');

        $publicUrl = asset('storage/images/posts/'.$new_image_name);
        $publicUrlWithoutBase = str_replace(url('/'), '', $publicUrl);
        return $publicUrlWithoutBase;
    }

    private function unlinkFileImage(string $path_file):void
    {
        $path = pathinfo($path_file);
        try{
            Storage::delete($path['basename']);
        } catch (\Exception $e){}

    }




}
