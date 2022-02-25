<?php


namespace App\Repository;


use App\Http\Resources\User\NoteResources;
use App\Interfaces\Note;
use App\Models\NoteTaker;
use App\Traits\ApiResponser;

class NoteRepository implements Note
{
    use ApiResponser;

    public function createNote($data)
    {
        $note = NoteTaker::create($data);
        return $this->showOne($note);
    }

    public function updateNote($data, $id)
    {
        $noteTaker = NoteTaker::findorFail($id);
        $noteTaker->update($data);
        return $this->showMessage('note updated successfully');
    }

    public function getNotes()
    {
        return $this->showAll(NoteResources::collection(NoteTaker::all()));
    }

    public function getNote($id)
    {
        $noteTaker = NoteTaker::findorFail($id);
        return $this->showOne(new NoteResources($noteTaker));
    }

    public function deleteNote($id)
    {
        $noteTaker = NoteTaker::findorFail($id);
        $noteTaker->delete();
        return $this->showMessage('note deleted successfully');
    }
}
