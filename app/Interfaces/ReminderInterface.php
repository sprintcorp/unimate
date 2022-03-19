<?php


namespace App\Interfaces;


interface ReminderInterface
{
    public function createReminder($data);
    public function updateReminder($data, $id);
    public function getReminders();
    public function getReminder($id);
    public function deleteReminder($id);
}
