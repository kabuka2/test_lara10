<?php


namespace App\Components\Api;

use App\Components\Api\ApiRequestBuilder;

class JsonPlaceholderApi
{
    private string $url_api;
    const PAGE_ELEMENTS = 3;
    public function __construct()
    {
        $this->url_api = env('API_URL_JSON_PLACEHOLDER');
    }

    public function getPost(int $page)
    {
         $request = (new ApiRequestBuilder())
            ->setMethod('get')
            ->setUrl($this->url_api)
            ->setEndpoint('posts')
            ->setParams([
                '_limit'=>self::PAGE_ELEMENTS,
                '_page'=> $page,
                '_embed' => 'comments'
            ])
            ->runRequest();

         $post_headers = $request->headers();
         $data_posts = $request->object();

         array_walk($data_posts,function (&$data){

            $request = (new ApiRequestBuilder())
                ->setMethod('get')
                ->setUrl($this->url_api)
                ->setEndpoint('post',[$data->id,'comments'])
                ->runRequest();
             $data->comments = $request->object();
             $data->count_comments = count($data->comments);

            $request_users = (new ApiRequestBuilder())
                ->setMethod('get')
                 ->setUrl($this->url_api)
                 ->setEndpoint('post',[$data->id,'users'])
                 ->runRequest();
             $data->users = $request_users->object();
         });

         return [
             'posts'=> $data_posts,
             'page'=> (int)ceil(current($post_headers['X-Total-Count']) / self::PAGE_ELEMENTS)
         ];
    }

    public function getPostById(int $post_id)
    {
        $request = (new ApiRequestBuilder())
            ->setMethod('get')
            ->setUrl($this->url_api)
            ->setEndpoint('posts',[$post_id])
            ->runRequest();
        $data_posts = $request->object();

        $comments_request = (new ApiRequestBuilder())
            ->setMethod('get')
            ->setUrl($this->url_api)
            ->setEndpoint('post',[$post_id,'comments'])
            ->runRequest();
        $data_comments = $comments_request->object();

        array_walk($data_comments,function (&$data){
            $request_users = (new ApiRequestBuilder())
                ->setMethod('get')
                ->setUrl($this->url_api)
                ->setEndpoint('comments',[$data->id,'users'])
                ->runRequest();
            $data->user = current($request_users->object());
        });

        $data_posts->comments = $data_comments;
        $data_posts->count_comments = count($data_comments);

        $request_users = (new ApiRequestBuilder())
            ->setMethod('get')
            ->setUrl($this->url_api)
            ->setEndpoint('post',[$post_id,'users'])
            ->runRequest();

        $data_posts->user = current($request_users->object());

        return $data_posts;
    }

}
