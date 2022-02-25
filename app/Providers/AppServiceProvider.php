<?php

namespace App\Providers;

use App\Interfaces\Auth;
use App\Interfaces\Note;
use App\Interfaces\Reminder;
use App\Repository\AuthRepository;
use App\Repository\NoteRepository;
use App\Repository\ReminderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Auth::class,AuthRepository::class);
        $this->app->bind(Note::class,NoteRepository::class);
        $this->app->bind(Reminder::class,ReminderRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
