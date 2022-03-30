<?php


namespace App\Interfaces;


interface Group
{
    public function createGroup($data);
    public function updateGroup($data, $id);
    public function getGroups();
    public function getGroup($id);
    public function deleteGroup($id);
}
