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

    public function getPost(int $page )
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

}
