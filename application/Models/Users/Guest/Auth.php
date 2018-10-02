<?php namespace App\Models\Users\Guest;


class Auth extends \App\Models\Users\Base
{

    function getByUsername($username)
    {
        return $this
            ->select('id')
            ->where('username',$username)
            ->asObject()
            ->first();
    }

    function getByEmail($email)
    {
        return $this
            ->select('id')
            ->where('email',$email)
            ->asObject()
            ->first();
    }

    function getPassword($id)
    {
        return $this
            ->select('password')
            ->where('id',$id)
            ->asObject()
            ->first();
    }

    function getData($id)
    {
        return $this
            ->select('users.id,users.original_name, GROUP_CONCAT(groups.name SEPARATOR "|") roles, 1 isLogin, users.telegram')
            ->join('users_groups','users_groups.user_id=users.id','inner')
            ->join('groups','groups.id=users_groups.group_id','inner')
            ->where('users.id',$id)
            ->asObject()
            ->groupBy('users.id')
            ->first();
    }

    function saveData($field)
    {
        return $this
            ->save($field);
    }
}