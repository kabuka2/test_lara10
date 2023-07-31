<?php


namespace App\Http\Services;


abstract class CoreService
{

    /**
     * @Required
     * @return [
            ['message' => 'string', 'code' => int],
            ['message' => 'string', 'code' => int],
        ]
     **/
    abstract protected function errors():array;

    /**
         * @param int $code
         * @param string $message_error
         * @param bool $return  true - return Exception, false - array
         * @return \Exception or array
     **/
    protected function error(int $code, string $message_error = '', bool $return = false)
    {
        $errors = $this->errors();

        if (!isset($errors[$code]['message'],$errors[$code]['code'])) {
            throw_if(true,
                'Not found required key in errors array "message" or "code"',
                [
                    'code' => 400
                ]
            );
        }

        $message = $errors[$code]['message'];

        if (!empty($message_error)) {
            $message = $message_error;
        }

        if ($return) {
            return $errors[$code];
        }
        throw_if(true,$message,['code'=>$errors[$code]['code']]);
    }


    /**
     * may be needed on hosting for api
     * @param array $data_array ['test' => '12']
     * @param array $keys_to_convert_and_type ['test' => int||str||json_encode||json_decode||bool ]
     * @return array
     **/
    public function convertTypeInArray(array $data_array, array $keys_to_convert_and_type):array
    {

        $conv_type = function ($data, $type )
        {
            switch ($type) {
                case 'int' :
                    return intval($data);
                case 'str' :
                    return trim(strval($data));
                case 'json_encode' :
                    return json_encode($data);
                case 'json_decode' :
                    return json_decode($data);
                case 'bool' :
                    return (bool)$data;
                default :
                    throw new \Exception('Not found type');
            }
        };
        foreach ( $keys_to_convert_and_type as $key => $value ) {
            $data_array[$key] = $conv_type($data_array[$key] , $value);
        }
        return $data_array;
    }


}
