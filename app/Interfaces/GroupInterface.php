<?php


namespace App\Interfaces;


interface GroupInterface
{
    public function createGroup($data);
    public function updateGroup($data, $id);
    public function getGroups();
    public function getGroup($id);
    public function deleteGroup($id);
    public function addUserToGroup($user,$group);
    public function removeUserFromGroup($user,$group);
}
