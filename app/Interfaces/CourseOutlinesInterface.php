<?php


namespace App\Interfaces;


interface CourseOutlinesInterface
{
    public function createCourseOutline($data);
    public function updateCourseOutline($data, $id);
    public function getCoursesOutline();
    public function getCourseOutline($id);
    public function uploadCourseOutline($id);
    public function deleteCourseOutline($id);
}
