<?php


namespace App\Repository;


use App\Http\Resources\Course\PastQuestionResources;
use App\Interfaces\PastQuestionInterface;
use App\Models\PastQuestion;
use App\Traits\ApiResponser;
use App\Traits\FileManager;

class PastQuestionRepository implements PastQuestionInterface
{
    use ApiResponser,FileManager;
    public function createPastQuestion($data)
    {
        $res = $this->fileUpload($data['file']->getRealPath());
        $data['file'] = $res->getSecurePath();
        $data['thumbnail'] = str_replace(".pdf",".jpg",$res->getSecurePath());
        $data['file_id'] = $res->getPublicId();
        return $this->showOne(PastQuestion::create($data));
    }

    public function updatePastQuestion($data, $id)
    {
        $res = $this->fileUpload($data['file']->getRealPath());
        $data['file'] = $res->getSecurePath();
        $data['thumbnail'] = str_replace(".pdf",".jpg",$res->getSecurePath());
        $data['file_id'] = $res->getPublicId();
        $past_question = PastQuestion::findorFail($id);
        $past_question->update($data);
        return $this->showOne('past question updated successfully',200);
    }

    public function getPastQuestions()
    {
        return $this->showAll(PastQuestionResources::collection(PastQuestion::where('course_id',request()->get('course_id'))));
    }

    public function getPastQuestion($id)
    {
        return $this->showOne(new PastQuestionResources(PastQuestion::findorFail($id)));
    }

    public function deletePastQuestion($id)
    {
        $past_question = PastQuestion::findorFail($id);
        $past_question->delete();
        return $this->showMessage('past question deleted successfully');
    }

    public function uploadPastQuestion($data)
    {

    }
}
