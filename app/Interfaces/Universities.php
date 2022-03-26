<?php


namespace App\Interfaces;


interface Universities
{
    public function createUniversity($data);
    public function updateUniversity($data, $id);
    public function getUniversities();
    public function getUniversity($id);
    public function uploadUniversity($data);
    public function deleteUniversity($id);
}
