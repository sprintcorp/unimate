<?php

namespace App\Providers;

use App\Interfaces\Audio;
use App\Interfaces\Auth;
use App\Interfaces\Course;
use App\Interfaces\CourseMaterialsInterface;
use App\Interfaces\CourseOutlinesInterface;
use App\Interfaces\Departments;
use App\Interfaces\Faculties;
use App\Interfaces\Note;
use App\Interfaces\Reminder;
use App\Interfaces\Universities;
use App\Repository\AudioRepository;
use App\Repository\AuthRepository;
use App\Repository\CourseMaterialRepository;
use App\Repository\CourseOutlineRepository;
use App\Repository\CourseRepository;
use App\Repository\DepartmentRepository;
use App\Repository\FacultyRepository;
use App\Repository\NoteRepository;
use App\Repository\ReminderRepository;
use App\Repository\UniversityRepository;
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
        $this->app->bind(Universities::class,UniversityRepository::class);
        $this->app->bind(Faculties::class,FacultyRepository::class);
        $this->app->bind(Departments::class,DepartmentRepository::class);
        $this->app->bind(Audio::class,AudioRepository::class);
        $this->app->bind(Course::class,CourseRepository::class);
        $this->app->bind(CourseOutlinesInterface::class,CourseOutlineRepository::class);
        $this->app->bind(CourseMaterialsInterface::class,CourseMaterialRepository::class);
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
