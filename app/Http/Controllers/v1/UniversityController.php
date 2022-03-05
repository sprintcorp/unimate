<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\Institution\UniversityRequest;
use App\Interfaces\Universities;

class UniversityController extends Controller
{
    protected $university;
    public function __construct(Universities $university)
    {
        $this->university = $university;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->university->getUniversities();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UniversityRequest $request)
    {
        return $this->university->createUniversity($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->university->getUniversity($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(UniversityRequest $request, $id)
    {
        return $this->university->updateUniversity($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->university->deleteUniversity($id);
    }
}
