<?php


namespace App\Repository;


use App\Http\Resources\Course\PastQuestionResources;
use App\Imports\PastQuestionImport;
use App\Interfaces\PastQuestionInterface;
use App\Models\PastQuestion;
use App\Traits\ApiResponser;
use App\Traits\FileManager;
use Maatwebsite\Excel\Facades\Excel;

class PastQuestionRepository implements PastQuestionInterface
{
    use ApiResponser,FileManager;
    public function createPastQuestion($data)
    {
        $res = $this->fileUpload($data['file']->getRealPath());
        $data['file'] = $res->getSecurePath();
        $data['type'] = 'file';
        $data['thumbnail'] = str_replace(".pdf",".jpg",$res->getSecurePath());
        $data['file_id'] = $res->getPublicId();
        return $this->showOne(PastQuestion::create($data));
    }

    public function updatePastQuestion($data, $id)
    {
        $res = $this->fileUpload($data['file']->getRealPath());
        $data['file'] = $res->getSecurePath();
        $data['type'] = 'file';
        $data['thumbnail'] = str_replace(".pdf",".jpg",$res->getSecurePath());
        $data['file_id'] = $res->getPublicId();
        $past_question = PastQuestion::findorFail($id);
        $past_question->update($data);
        return $this->showOne('past question updated successfully',200);
    }

    public function getPastQuestions()
    {
        return $this->showAll(PastQuestionResources::collection(PastQuestion::where('course_id',request()->get('course_id'))->get()));
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
        try {
            Excel::import(new PastQuestionImport($data['course_id'],$data['year']),$data['file']);
            return $this->showMessage("Past question imported successfully");
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e){
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $failure->row();
                $failure->attribute();
                $failure->errors();
                $failure->values();
                return $failure;
            }
        }
    }
}
