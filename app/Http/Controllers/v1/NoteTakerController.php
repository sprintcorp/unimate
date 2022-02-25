<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\User\NoteTakeRequest;
use App\Interfaces\Note;
use App\Models\NoteTaker;
use Illuminate\Http\Request;

class NoteTakerController extends Controller
{
    protected $note;
    public function __construct(Note $note)
    {
        $this->note = $note;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->note->getNotes();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteTakeRequest $request)
    {
        return $this->note->createNote($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NoteTaker  $noteTaker
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->note->getNote($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoteTaker  $noteTaker
     * @return \Illuminate\Http\Response
     */
    public function update(NoteTakeRequest $request, $id)
    {
        return $this->note->updateNote($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoteTaker  $noteTaker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->note->deleteNote($id);
    }
}
