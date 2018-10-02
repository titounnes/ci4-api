<?php
 
if ( ! function_exists('validate'))
{
    function validate($role, $request)
    {
        helper(['form', 'url']);
            
        //Jika request tidak lewat ajax dan bukan https
        
        /*if( $request->isAJAX() === FALSE ){//|| $request->isSecure() === FALSE){
            \Utils\Response::fail(1);
            echo json_encode(['r'=>$request->isAJAX()]);
            return FALSE;
        }*/

        if($request->getServer('SERVER_ADDR') !== $request->getServer('REMOTE_ADDR')){
            \Utils\Response::fail(2);
            return FALSE;
        }

        if( $role === 'GUEST'){
            return true;
        }
        
        $bearer = $request->getServer('HTTP_BEARER') ?? false;
        if($bearer){
            $token = \Utils\jwt::decode($bearer);
            if($token['code'] == 0){
                return false;
            }
            if(in_array($role, $token['data']->roles) && $token['data']->isLogin === true){
                return $token['data']; 
            }
            return false; 
        }
        return false;
    }
}
