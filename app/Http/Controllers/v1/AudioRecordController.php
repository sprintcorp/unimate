<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\User\AudioRequest;
use App\Interfaces\Audio;
use App\Models\AudioRecord;
use Illuminate\Http\Request;

class AudioRecordController extends Controller
{
    public function __construct(protected Audio $audio){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->audio->getAudios();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AudioRequest $request)
    {
        return $this->audio->createAudio($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AudioRecord  $audioRecord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->audio->getAudio($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AudioRecord  $audioRecord
     * @return \Illuminate\Http\Response
     */
    public function updateAudio(AudioRequest $request, $id)
    {
        return $this->audio->updateAudio($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AudioRecord  $audioRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->audio->deleteAudio($id);
    }
}
