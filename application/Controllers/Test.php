<?php 
namespace App\Controllers;

use Firebase\JWT\JWT;

class Test
{
    function index()
    {
        $key = "example_key";
        $token = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );
        //$a = JWT::encode($token, $key);
        //var_dump($a);
        echo 1;
    }
}