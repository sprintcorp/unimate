<?php


namespace App\Interfaces;


interface Reminder
{
    public function createReminder($data);
    public function updateReminder($data, $id);
    public function getReminders();
    public function getReminder($id);
    public function deleteReminder($id);
}
