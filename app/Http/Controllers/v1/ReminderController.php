<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\User\ReminderRequest;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    protected $reminder;
    public function __construct(\App\Interfaces\Reminder $reminder)
    {
        $this->reminder = $reminder;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->reminder->getReminders();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReminderRequest $request)
    {
        return $this->reminder->createReminder($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->reminder->getReminder($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->reminder->updateReminder($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->reminder->deleteReminder($id);
    }
}
