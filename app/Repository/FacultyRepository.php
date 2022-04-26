<?php


namespace App\Repository;


use App\Http\Resources\Institution\FacultyResource;
use App\Imports\FacultyImport;
use App\Interfaces\Faculties;
use App\Models\Faculty;
use App\Traits\ApiResponser;
use Maatwebsite\Excel\Facades\Excel;

class FacultyRepository implements Faculties
{
    use ApiResponser;

    public function createFaculty($data)
    {
        $faculty = Faculty::create($data);
        return $this->showOne($faculty,201);
    }

    public function updateFaculty($data, $id)
    {
        $faculty = Faculty::findorFail($id);
        $faculty->update($data);
        return $this->showMessage('faculty updated successfully');
    }

    public function getFaculties()
    {
        if(auth()->user() && auth()->user()->role_id == 2){
            return $this->showAll(FacultyResource::collection(Faculty::where('university_id', auth()->user()->student->university_id)->get()));
        }
        return $this->showAll(FacultyResource::collection(Faculty::where('university_id', request()->get('university_id'))->get()));

    }

    public function getFaculty($id)
    {
        return $this->showOne(new FacultyResource(Faculty::findorFail($id)));
    }

    public function uploadFaculty($data)
    {
        try {
            Excel::import(new FacultyImport($data['university_id']),$data['file']);
            return $this->showMessage("Faculty imported successfully");
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

    public function deleteFaculty($id)
    {
        $faculty = Faculty::findorFail($id);
        $faculty->delete();
        return $this->showMessage('faculty deleted successfully');
    }
}
