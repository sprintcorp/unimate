<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\Course\CourseOutlineRequest;
use App\Interfaces\CourseOutlinesInterface;
use App\Models\CourseOutline;
use Illuminate\Http\Request;

class CourseOutlineController extends Controller
{
    public function __construct(protected CourseOutlinesInterface $course_outline){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->course_outline->getCoursesOutline();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseOutlineRequest $request)
    {
        return $this->course_outline->createCourseOutline($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseOutline  $courseOutline
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->course_outline->getCourseOutline($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseOutline  $courseOutline
     * @return \Illuminate\Http\Response
     */
    public function update(CourseOutlineRequest $request, $id)
    {
        return $this->course_outline->updateCourseOutline($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseOutline  $courseOutline
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->course_outline->deleteCourseOutline($id);
    }
}
