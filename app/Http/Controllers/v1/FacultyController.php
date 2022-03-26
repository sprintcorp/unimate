<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\Institution\FacultyRequest;
use App\Interfaces\Faculties;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function __construct(protected Faculties $faculty){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->faculty->getFaculties();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRequest $request)
    {
        return $this->faculty->createFaculty($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->faculty->getFaculty($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyRequest $request, $id)
    {
        return $this->faculty->updateFaculty($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->faculty->deleteFaculty($id);
    }
}
