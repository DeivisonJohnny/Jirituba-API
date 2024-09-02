<?php



class Response
{


    static function userInvalid( )
    {

        $responseError = [
            'status' => 'danied',
            'message' => 'Usuario e/ou senha invalida',
            'code' => 401,
        ];

        return $responseError;


    }


}