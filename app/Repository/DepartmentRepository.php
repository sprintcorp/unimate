<?php


namespace App\Repository;


use App\Http\Resources\Institution\DepartmentResource;
use App\Imports\DepartmentImport;
use App\Interfaces\Departments;
use App\Models\Department;
use App\Traits\ApiResponser;
use Maatwebsite\Excel\Facades\Excel;

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
        if(auth()->user() && auth()->user()->role_id == 2) {
            return $this->showAll(DepartmentResource::collection(Department::where('faculty_id', auth()->user()->student->faculty_id)->get()));
        }
        return $this->showAll(DepartmentResource::collection(Department::where('faculty_id', request()->get('faculty_id'))->get()));

    }

    public function getDepartment($id)
    {
        return $this->showOne(new DepartmentResource(Department::findorFail($id)));
    }

    public function uploadDepartment($data)
    {
        try {
            Excel::import(new DepartmentImport($data['faculty_id']),$data['file']);
            return $this->showMessage("Department imported successfully");
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

    public function deleteDepartment($id)
    {
        $department = Department::findorFail($id);
        $department->delete();
        return $this->showMessage('department deleted successfully');
    }
}
