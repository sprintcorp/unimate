<?php


namespace App\Interfaces;


interface CourseUserInterface
{
    public function courseRegistration($data);
    public function getUserRegisteredCourse();
    public function getUserCourseInformation($id);
    public function updateCourseRegistration($data);
    public function deleteRegisteredCourses($data);
}
