<?php


namespace App\Repository;


use App\Http\Resources\Course\CourseOutlineResources;
use App\Interfaces\CourseOutlinesInterface;
use App\Models\CourseOutline;
use App\Traits\ApiResponser;

class CourseOutlineRepository implements CourseOutlinesInterface
{
    use ApiResponser;
    public function createCourseOutline($data)
    {
        $course_outline = CourseOutline::create($data);
        return $this->showOne($course_outline,201);
    }

    public function updateCourseOutline($data, $id)
    {
        $course_outline = CourseOutline::findorFail($id);
        $course_outline->update($data);
        return $this->showOne('course outline updated successfully',200);
    }

    public function getCoursesOutline()
    {
        $course_outline = CourseOutline::where('course_id',request()->get('course_id'))->get();
        return $this->showAll(CourseOutlineResources::collection($course_outline));
    }

    public function getCourseOutline($id)
    {
        return $this->showOne(new CourseOutlineResources(CourseOutline::findorFail($id)));
    }

    public function uploadCourseOutline($id)
    {
        // TODO: Implement uploadCourseOutline() method.
    }

    public function deleteCourseOutline($id)
    {
        $course_outline = CourseOutline::findorFail($id);
        $course_outline->delete();
        return $this->showMessage('course outline deleted successfully');
    }
}
