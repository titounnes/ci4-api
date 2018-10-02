<?php
 
if ( ! function_exists('render'))
{
    function render(string $name, object $obj, array $options = [])
    {
        return view(
            'success',
            [
                'data' => $obj,
            ]
        ); 
/*        if($obj->data){
            return $obj->respond([
                'ack' => time(),
                'title' => 'Hello World!',
                'match' => preg_match("/^(.*?)@(.*?).(.*?)$/",'harjito@mailcom'),
                'username' => $obj->data->username,
                'token' => (\Utils\Jwt::encode($obj->data))['token'],
                ]);
        }

        return $obj->respond([
            'ack' => time(),
            'title' => 'Hello World!',
            'token' => null,
            ]);*/

    }
}
