<?php 
declare(strict_types=1);

namespace App\Filters\API;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;

final class GuestWithBearerRequest implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        if($request->getMethod() === 'post' && $request->isAJAX()===TRUE && $request->getServer('HTTP_BEARER') !== NULL)
        {
            $token = JWT::decode($request->getServer('HTTP_BEARER'), (Config('Jwt'))->key, [(Config('Jwt'))->algo]);
            
            if($token){

                if($token->expired_at < strtotime('+0')){
                    return Services::response()
                    ->setStatusCode(ResponseInterface::HTTP_FORBIDDEN);    
                }

                return (config('App'))->session = ['id' => $token->id];
            }
            
            return (config('App'))->session = [
                'id'=> $token['data']->id
            ];
            
        }

        return Services::response()
            ->setStatusCode(ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
    }

    public function after(RequestInterface $request, ResponseInterface $response )
    {

    }
}
