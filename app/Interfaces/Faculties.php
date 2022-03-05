<?php


namespace App\Interfaces;


interface Faculties
{
    public function createFaculty($data);
    public function updateFaculty($data, $id);
    public function getFaculties();
    public function getFaculty($id);
    public function uploadFaculty($id);
    public function deleteFaculty($id);
}
