<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\Course\CourseMaterialRequest;
use App\Interfaces\CourseMaterialsInterface;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;

class CourseMaterialController extends Controller
{
    public function __construct(protected CourseMaterialsInterface $course_material){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->course_material->getCoursesMaterial();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseMaterialRequest $request)
    {
        return $this->course_material->createCourseMaterial($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->course_material->getCourseMaterial($id);
    }

    public function updateMaterial(CourseMaterialRequest $request, $id)
    {
        return $this->course_material->updateCourseMaterial($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->course_material->deleteCourseMaterial($id);
    }
}
