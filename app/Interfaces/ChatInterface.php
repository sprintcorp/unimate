<?php


namespace App\Interfaces;


interface ChatInterface
{
    public function createChat($data);
    public function updateChat($data,$id);
    public function getGroupChat($id);
    public function getCourseChat($id);
    public function getUserChat($id);
    public function deleteChat($id);
    public function searchUser($data);
    public function addUserToChat($userId);
    public function removeUserFromChat($userId);
    public function getChatUsers();
}
