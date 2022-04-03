<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\User\CourseUserRequest;
use App\Interfaces\CourseUserInterface;
use Illuminate\Http\Request;

class CourseUserController extends Controller
{
    public function __construct(protected CourseUserInterface $courseUser){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->courseUser->getUserRegisteredCourse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->courseUser->getUserCourseInformation($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseUserRequest $request)
    {
        return $this->courseUser->courseRegistration($request->all());
    }

    public function updateCourse(CourseUserRequest $request)
    {
        return $this->courseUser->updateCourseRegistration($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->courseUser->deleteRegisteredCourses($id);
    }
}
