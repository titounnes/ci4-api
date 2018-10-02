<?php 
declare( strict_types = 1 );
namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
    
class Base extends Controller 
{
    use ResponseTrait;

    protected function fail($message = 'Data tidak ditemukan.'): ResponseInterface 
    {
        return $this->respond([
            'message' => $message,
            'token' => $this->request->getServer('HTTP_BEARER'),
        ]);
    }

    protected function success($data = [], $action = '', $tokenData = null)
    {
        return $this->respond([
            'message' => 'Proses berhasil.',
            'action' => $action,
            'data' => $data,
            'token' => $tokenData ? (\Utils\Jwt::encode($tokenData))['token']: $this->request->getServer('HTTP_BEARER'),
        ]);
    }
}