<?php


namespace App\Repository;


use App\Http\Resources\Course\CourseMaterialResources;
use App\Interfaces\CourseMaterialsInterface;
use App\Models\CourseMaterial;
use App\Traits\ApiResponser;
use App\Traits\FileManager;

class CourseMaterialRepository implements CourseMaterialsInterface
{
    use ApiResponser,FileManager;
    public function createCourseMaterial($data)
    {
        $res = $this->fileUpload($data['file']->getRealPath());
        $data['file'] = $res->getSecurePath();
        $data['file_id'] = $res->getPublicId();
        $data['extension'] = $res->getExtension();
        $data['size'] = $res->getReadableSize();
        $data['file_name'] = $res->getOriginalFileName();
        $course_material = CourseMaterial::create($data);
        return $this->showOne($course_material,201);
    }

    public function updateCourseMaterial($data, $id)
    {
        $res = $this->fileUpload($data['file']->getRealPath());
        $data['file'] = $res->getSecurePath();
        $data['file_id'] = $res->getPublicId();
        $data['extension'] = $res->getExtension();
        $data['size'] = $res->getReadableSize();
        $data['file_name'] = $res->getOriginalFileName();
        $course_material = CourseMaterial::findorFail($id);
        $course_material->update($data);
        return $this->showOne('course updated successfully',200);
    }

    public function getCoursesMaterial()
    {
        return $this->showAll(CourseMaterialResources::collection(CourseMaterial::all()));
    }

    public function getCourseMaterial($id)
    {
        return $this->showOne(new CourseMaterialResources(CourseMaterial::findorFail($id)));
    }

    public function deleteCourseMaterial($id)
    {
        $course_material = CourseMaterial::findorFail($id);
        $course_material->delete();
        return $this->showMessage('course material deleted successfully');
    }
}
