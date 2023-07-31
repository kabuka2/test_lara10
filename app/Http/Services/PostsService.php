<?php


namespace App\Http\Services;

use App\Http\Repositories\PostsRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\PostCreateRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class PostsService extends CoreService
{
    private PostsRepository $repository;

    public function __construct()
    {
        $this->repository = new PostsRepository();
    }

    public function getAllPostGrid()
    {
       return $this->repository->getAllPostGridTable();
    }

    public function getAllPostsPagination():LengthAwarePaginator
    {
       return $this->repository->getAllPostsPagination();
    }

    /**
     * @param int $id_post
     */
    public function getPostAndCommentsById(int $id_post)
    {
        return $this->repository->getAllPostsAndComments($id_post);
    }

    public function softDelete(int $id)
    {
        try {
            $this->repository->softDeleteRecords($id);
        } catch (\Exception $e) {
            $this->error(0,$e->getMessage());
        }
    }
    /**@param PostCreateRequest $data * */
    public function savePost(PostCreateRequest $data):array
    {

        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $data->image_path = $this->saveFilesImages($image);
        }

        try {

           $result =  $this->repository->createNewRecords($data);
           return ['id'=> $result];

        } catch (\Exception $e){
            if(isset($data->image_path)) {
                $this->unlinkFileImage($data->image_path);
            }

            $this->errors(1);
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

    /**
     * @inheritDoc
     */
    protected function errors(): array
    {
        return [
            0 => ['code' => 400, 'message'=> 'Undefined error'],
            1 => ['code' => 400, 'message'=> 'Error save'],
        ];
    }
}
