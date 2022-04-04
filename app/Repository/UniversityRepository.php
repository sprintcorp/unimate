<?php


namespace App\Repository;


use App\Http\Resources\Institution\UniversityResource;
use App\Imports\UniversityImport;
use App\Interfaces\Universities;
use App\Models\University;
use App\Traits\ApiResponser;
use Maatwebsite\Excel\Facades\Excel;

class UniversityRepository implements Universities
{
    use ApiResponser;

    public function createUniversity($data)
    {
        $university = University::create($data);
        return $this->showOne($university,201);
    }

    public function updateUniversity($data, $id)
    {
        $university = University::findorFail($id);
        $university->update($data);
        return $this->showMessage('university updated successfully');
    }

    public function getUniversities()
    {
        return $this->noPaginate(UniversityResource::collection(University::all()));
    }

    public function getUniversity($id)
    {
        return $this->showOne(new UniversityResource(University::findorFail($id)));
    }

    public function uploadUniversity($data)
    {
        try {
            Excel::import(new UniversityImport(),$data['file']);
            return $this->showMessage("University imported successfully");
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

    public function deleteUniversity($id)
    {
        $university = University::findorFail($id);
        $university->delete();
        return $this->showMessage('university deleted successfully');
    }
}
