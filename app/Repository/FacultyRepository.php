<?php


namespace App\Repository;


use App\Http\Resources\Institution\FacultyResource;
use App\Interfaces\Faculties;
use App\Models\Faculty;
use App\Traits\ApiResponser;

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
        return $this->showAll(FacultyResource::collection(Faculty::all()));
    }

    public function getFaculty($id)
    {
        return $this->showOne(new FacultyResource(Faculty::findorFail($id)));
    }

    public function uploadFaculty($id)
    {
        // TODO: Implement uploadFaculty() method.
    }

    public function deleteFaculty($id)
    {
        $faculty = Faculty::findorFail($id);
        $faculty->delete();
        return $this->showMessage('faculty deleted successfully');
    }
}
