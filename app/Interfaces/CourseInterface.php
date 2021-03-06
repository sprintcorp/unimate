<?php


namespace App\Interfaces;


interface CourseInterface
{
    public function createCourse($data);
    public function updateCourse($data, $id);
    public function getCourses();
    public function getCourse($id);
    public function uploadCourse($id);
    public function deleteCourse($id);
}
