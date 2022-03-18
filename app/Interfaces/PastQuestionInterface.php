<?php


namespace App\Interfaces;


interface PastQuestionInterface
{
    public function createPastQuestion($data);
    public function updatePastQuestion($data, $id);
    public function getPastQuestions();
    public function getPastQuestion($id);
    public function deletePastQuestion($id);
}
