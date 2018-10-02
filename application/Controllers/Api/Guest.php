<?php 
namespace App\Controllers\Api;

Use App\Models\Users\Guest\Auth;
Use App\Controllers\Api\Base;
    
class Guest extends Base 
{
    
    public function postIdentity()
    {
        $identity = $this->request->getPost('identity'); 
        
        if(! $identity){
            return $this->fail('Username atau email belum diset.');
        }
        
        if( ! preg_match("/^(.*?)@(.*?).(.*?)$/",$identity)){
            $data = (new Auth())->getByUsername($identity);
        }else{
            $data = (new Auth())->getByEmail($identity);
        }

        if($data){
            return $this->success($data, 'postIdentity', $data);
        }
        
        return $this->fail('Data tidak ditemukan.');
                
    }

    public function postPassword()
    {
        $password = $this->request->getPost('password');
        
        if(! $password){
            return $this->fail('Password belum diset.');
        }

        $data = (new Auth())->getPassword((Config('App'))->session['id']); 

        if( password_verify( $password, $data->password ) )
        {
            $data = (new Auth())->getData((Config('App'))->session['id']);

            return $this->success([], 'postPassword', $data);
        }

        return $this->fail('Password salah.');
        
    } 

    public function requestToken()
    {

        $data = (new Auth())->getData((Config('App'))->session['id']);
        
        $field = [
            'forgotten_password_time' => date('Y-m-d H:i:s',strtotime('+ 5 minutes')),
            'forgotten_password_code' => substr(str_shuffle('0123456789'), 0, 6),
            'id' => (Config('App'))->session['id'],
        ];
        
        $message = 'Token anda adalah: <code>'.$field['forgotten_password_code'].'</code>, token berlaku sampai <b>' . $field['forgotten_password_time']. '</b>';
        
        $user = (new Auth())->saveData($field);

        return $this->success([$message], 'requestToken');


        
        //return $this->fail('Pesan');
    }

}