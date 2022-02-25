<?php


namespace App\Interfaces;


use App\Models\NoteTaker;

interface Note
{
    public function createNote($data);
    public function updateNote($data,$id);
    public function getNotes();
    public function getNote($id);
    public function deleteNote($id);
}
