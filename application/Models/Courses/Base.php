<?php namespace App\Models\Courses;


class Base extends \CodeIgniter\Model
{
    protected $table = 'courses';
    protected $allowedFields = ['title','description'];
    
}