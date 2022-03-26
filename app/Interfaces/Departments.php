<?php


namespace App\Interfaces;


interface Departments
{
    public function createDepartment($data);
    public function updateDepartment($data, $id);
    public function getDepartments();
    public function getDepartment($id);
    public function uploadDepartment($data);
    public function deleteDepartment($id);
}
