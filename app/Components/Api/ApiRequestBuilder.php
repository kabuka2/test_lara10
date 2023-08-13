<?php


namespace App\Components\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
class ApiRequestBuilder
{
    private $object;
    private PendingRequest $request;

    public function __construct()
    {
        $this->create();
    }

    /** @return ApiRequestBuilder **/
    public function create(): ApiRequestBuilder
    {
        $this->object = new class{};

        return $this;
    }

    /*** set ***/

    /**
     * @param string $url
     * @return ApiRequestBuilder
    **/
    public function setUrl(string $url): ApiRequestBuilder
    {
        $this->object->url = $url;

        return $this;
    }

    /**
     * @param string $method
     * @return ApiRequestBuilder
    **/
    public function setMethod(string $method): ApiRequestBuilder
    {
        $this->object->method = strtolower($method);
        return $this;
    }

    /**
     * @param string $name_header
     * @param string $value
     * @return ApiRequestBuilder
     **/
    public function setHeaders(string $name_header, string $value): ApiRequestBuilder
    {

        if (!isset($this->object->headers)) {
            $this->object->headers = [];
        }
        $this->object->headers[$name_header] = $value;

        return $this;
    }

    /**@param array $params ['key' => 'value'] **/
    /**@param string $type**/
    public function setParams(array $params, string $type = ''): ApiRequestBuilder
    {
        switch ($type){
            case 'json':
                $this->object->params = json_encode($params);
                break;
            default:
                $this->object->params = $params;
        }
        return $this;
    }

    /**
     * @param string $action
     * @return ApiRequestBuilder
    **/
    public function setEndpoint(string $action , array $params = []): ApiRequestBuilder
    {
        $this->object->url = (sprintf('%s/%s/%s',
            $this->object->url,
            $action,
            implode('/',$params)
        ));
//        dd($this->object->url);
        return $this;
    }

    /********* get *********/

    public function run()
    {
        $obj = $this->object;
        $this->create();
        return $obj;
    }

    /*** business logic ***/
    public function runRequest()
    {
        $object = $this->run();

        $this->createRequest();

        if (isset($object->params)) {
             $this->setParamsRequest($object->params);
        }

        if (isset($object->headers)) {
            $this->setHeadersRequest($object->headers);
        }

        return $this->getMethod($object->method, $object->url);
    }

    /**
     * @param string $method *
     * @param string $url
    **/
    private function getMethod(string $method, string $url)
    {

        switch ($method) {

            case 'post':
                return $this->request->post($url);
            case 'get':
                return $this->request->get($url);

        }
    }

    private function createRequest():void
    {
        $this->request = Http::retry(3, 100);
    }

    /**
     * @param array $headers
    **/
    private function setHeadersRequest(array $headers):void
    {
        $this->request->withHeaders($headers);
    }

    /**
     * @param array $params
     **/
    private function setParamsRequest(array $params): void
    {
        $this->request->withQueryParameters($params);
    }


}
