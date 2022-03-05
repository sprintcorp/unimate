<?php


namespace App\Repository;


use App\Http\Resources\Institution\DepartmentResource;
use App\Interfaces\Departments;
use App\Models\Department;
use App\Traits\ApiResponser;

class DepartmentRepository implements Departments
{
    use ApiResponser;

    public function createDepartment($data)
    {
        $department = Department::create($data);
        return $this->showOne($department,201);
    }

    public function updateDepartment($data, $id)
    {
        $department = Department::findorFail($id);
        $department->update($data);
        return $this->showMessage('department updated successfully');
    }

    public function getDepartments()
    {
        return $this->showAll(DepartmentResource::collection(Department::all()));
    }

    public function getDepartment($id)
    {
        return $this->showOne(new DepartmentResource(Department::findorFail($id)));
    }

    public function uploadDepartment($id)
    {
        // TODO: Implement uploadDepartment() method.
    }

    public function deleteDepartment($id)
    {
        $department = Department::findorFail($id);
        $department->delete();
        return $this->showMessage('department deleted successfully');
    }
}
