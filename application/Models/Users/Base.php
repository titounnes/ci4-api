<?php namespace App\Models\Users;


class Base extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $allowedFields = ['forgotten_password_time','forgotten_password_code'];
    
}