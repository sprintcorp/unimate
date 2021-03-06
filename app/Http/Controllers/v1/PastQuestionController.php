<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\Course\PastQuestionRequest;
use App\Interfaces\PastQuestionInterface;

class PastQuestionController extends Controller
{
    public function __construct(protected PastQuestionInterface $past_question){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->past_question->getPastQuestions();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PastQuestionRequest $request)
    {
        return $this->past_question->createPastQuestion($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PastQuestion  $pastQuestion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->past_question->getPastQuestion($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PastQuestion  $pastQuestion
     * @return \Illuminate\Http\Response
     */
    public function updatePastQuestion(PastQuestionRequest $request, $id)
    {
        return $this->past_question->updatePastQuestion($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PastQuestion  $pastQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->past_question->deletePastQuestion($id);
    }

    public function uploadPastQuestion(PastQuestionRequest $request)
    {
        return $this->past_question->uploadPastQuestion($request->all());
    }
}
