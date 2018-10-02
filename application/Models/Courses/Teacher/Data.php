<?php namespace App\Models\Courses\Teacher;


class Data extends \App\Models\Courses\Base
{
    function getByTitle($title = '')
    {
        return $this
            ->select('id,title')
            ->join('lecturers','lecturers.course_id=courses.id','inner')
            ->where('lecturers.teacher_id',config('App')->session->id)
            ->like('title',$title)
            ->asObject()
            ->findAll();
    }

}