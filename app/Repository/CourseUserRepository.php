<?php


namespace App\Repository;


use App\Http\Resources\Course\CourseResources;
use App\Interfaces\CourseUserInterface;
use App\Models\Course;
use App\Traits\ApiResponser;
use Illuminate\Http\Resources\Json\JsonResource;
use Matrix\Exception;

class CourseUserRepository implements CourseUserInterface
{
    use ApiResponser;
    public function courseRegistration($data)
    {
        auth()->user()->courses()->attach($data['course_id'],
            [
                'level'=>$data['level'],
                'semester'=>$data['semester'],
                'year'=>$data['year'],
                'created_at'=>now(),
            ]);
        return $this->successResponse('course added successfully',200);
    }

    public function updateCourseRegistration($data)
    {
        auth()->user()->current_courses()->sync($data['course_id'],
            [
                'level'=>$data['level'],
                'semester'=>$data['semester'],
                'year'=>$data['year'],
                'created_at'=>now(),
            ]);
        return $this->successResponse('course updated successfully',200);
    }



    public function getUserRegisteredCourse()
    {
        return $this->allResponse(auth()->user()->current_courses);
    }

    public function getUserCourseInformation($id)
    {

        return $this->showOne(new CourseResources(Course::findorFail($id)));
    }

    public function deleteRegisteredCourses($data)
    {
        try {
            auth()->user()->current_courses()->detach($data);
            return $this->showMessage('course deleted successfully');
        }catch (\Exception $exp){
            return $this->errorResponse($exp->getMessage(),400);
        }
    }
}
