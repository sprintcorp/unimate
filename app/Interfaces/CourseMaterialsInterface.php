<?php


namespace App\Interfaces;


interface CourseMaterialsInterface
{
    public function createCourseMaterial($data);
    public function updateCourseMaterial($data, $id);
    public function getCoursesMaterial();
    public function getCourseMaterial($id);
    public function deleteCourseMaterial($id);
}
