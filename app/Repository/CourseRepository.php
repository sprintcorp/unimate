<?php


namespace App\Repository;


use App\Http\Resources\Course\CourseResources;
use App\Interfaces\CourseInterface;
use App\Models\Course;
use App\Traits\ApiResponser;

class CourseRepository implements CourseInterface
{
    use ApiResponser;
    public function createCourse($data)
    {
        $course = Course::create($data);
        return $this->showOne($course,201);
    }

    public function updateCourse($data, $id)
    {
        $course = Course::findorFail($id);
        $course->update($data);
        return $this->showOne('course updated successfully',200);
    }

    public function getCourses()
    {
        if(auth()->user() && auth()->user()->role_id == 2) {
            $courses = Course::where('department_id',auth()->user()->student->department_id)->get();
            return $this->showAll(CourseResources::collection($courses));
        }
        $courses = Course::where('department_id',request()->get('department_id'))->get();
        return $this->showAll(CourseResources::collection($courses));
    }

    public function getCourse($id)
    {
        return $this->showOne(new CourseResources(Course::findorFail($id)));
    }

    public function uploadCourse($id)
    {

    }

    public function deleteCourse($id)
    {
        $course = Course::findorFail($id);
        $course->delete();
        return $this->showMessage('course deleted successfully');
    }
}
