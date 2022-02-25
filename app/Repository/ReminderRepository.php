<?php


namespace App\Repository;


use App\Http\Resources\User\ReminderResources;
use App\Interfaces\Reminder;
use App\Traits\ApiResponser;

class ReminderRepository implements Reminder
{

    use ApiResponser;
    public function createReminder($data)
    {
        $reminder = \App\Models\Reminder::create($data);
        return $this->showOne($reminder);
    }

    public function updateReminder($data, $id)
    {
        $reminder = \App\Models\Reminder::findorFail($id);
        $reminder->update($data);
        return $this->showMessage('reminder updated successfully');
    }

    public function getReminders()
    {
        return $this->showAll(ReminderResources::collection(\App\Models\Reminder::all()));
    }

    public function getReminder($id)
    {
        $reminder = \App\Models\Reminder::findorFail($id);
        return $this->showOne(new ReminderResources($reminder));
    }

    public function deleteReminder($id)
    {
        $reminder = \App\Models\Reminder::findorFail($id);
        $reminder->delete();
        return $this->showMessage('reminder deleted successfully');
    }
}
