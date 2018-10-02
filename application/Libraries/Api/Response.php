<?php 
namespace App\Libraries\Api;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Response 
{
    use ResponseTrait;

    public function render($data) : ResponseInterface
    {
        return $this->respond([
            'title' => 'Hello World!',
            'data' => $data,
            'token' => $data ? (\Utils\Jwt::encode($data))['token'] : null,
        ]);
    }

}
