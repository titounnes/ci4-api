<?php 
namespace App\Controllers\Api\Teacher;

Use App\Models\Courses\Teacher\Data;
    
class Course extends \App\Controllers\Api\Base 
{
    function index()
    {
        $courses = (new Data())->getByTitle($this->request->getPost('title'));

        return $this->success($courses,'Sukses');
        
        //return $this->fail('gagal');
    }
}