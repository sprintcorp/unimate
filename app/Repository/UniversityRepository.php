<?php


namespace App\Repository;


use App\Http\Resources\Institution\UniversityResource;
use App\Interfaces\Universities;
use App\Models\University;
use App\Traits\ApiResponser;

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
        return $this->showAll(UniversityResource::collection(University::all()));
    }

    public function getUniversity($id)
    {
        return $this->showOne(new UniversityResource(University::findorFail($id)));
    }

    public function uploadUniversity($id)
    {
        // TODO: Implement uploadUniversity() method.
    }

    public function deleteUniversity($id)
    {
        $university = University::findorFail($id);
        $university->delete();
        return $this->showMessage('university deleted successfully');
    }
}
