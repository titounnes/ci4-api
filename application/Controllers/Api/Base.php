<?php 
declare( strict_types = 1 );
namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
    
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
        if(is_object($tokenData)){
            $tokenData->expired_at = strtotime('+30 minutes');
        }else{
            (Config('App'))->session->expired_at = strtotime('+30 minutes');
        }

        return $this->respond([
            'message' => 'Proses berhasil.',
            'action' => $action,
            'data' => $data,
            'token' => JWT::encode(is_object($tokenData) ? $tokenData : (Config('App'))->session, (Config('Jwt'))->key, (Config('Jwt'))->algo),
        ]);
    }
}
