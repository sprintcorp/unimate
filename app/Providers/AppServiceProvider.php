<?php

namespace App\Providers;

use App\Interfaces\Audio;
use App\Interfaces\Auth;
use App\Interfaces\CourseInterface;
use App\Interfaces\CourseMaterialsInterface;
use App\Interfaces\CourseOutlinesInterface;
use App\Interfaces\CourseUserInterface;
use App\Interfaces\Departments;
use App\Interfaces\Faculties;
use App\Interfaces\GroupInterface;
use App\Interfaces\Note;
use App\Interfaces\PastQuestionInterface;
use App\Interfaces\ReminderInterface;
use App\Interfaces\Roles;
use App\Interfaces\Universities;
use App\Repository\AudioRepository;
use App\Repository\AuthRepository;
use App\Repository\CourseMaterialRepository;
use App\Repository\CourseOutlineRepository;
use App\Repository\CourseRepository;
use App\Repository\CourseUserRepository;
use App\Repository\DepartmentRepository;
use App\Repository\FacultyRepository;
use App\Repository\GroupRepository;
use App\Repository\NoteRepository;
use App\Repository\PastQuestionRepository;
use App\Repository\ReminderInterfaceRepository;
use App\Repository\RolesRepository;
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
        $this->app->bind(Roles::class,RolesRepository::class);
        $this->app->bind(Note::class,NoteRepository::class);
        $this->app->bind(ReminderInterface::class,ReminderInterfaceRepository::class);
        $this->app->bind(Universities::class,UniversityRepository::class);
        $this->app->bind(Faculties::class,FacultyRepository::class);
        $this->app->bind(Departments::class,DepartmentRepository::class);
        $this->app->bind(Audio::class,AudioRepository::class);
        $this->app->bind(CourseInterface::class,CourseRepository::class);
        $this->app->bind(CourseOutlinesInterface::class,CourseOutlineRepository::class);
        $this->app->bind(CourseMaterialsInterface::class,CourseMaterialRepository::class);
        $this->app->bind(PastQuestionInterface::class,PastQuestionRepository::class);
        $this->app->bind(CourseUserInterface::class,CourseUserRepository::class);
        $this->app->bind(GroupInterface::class,GroupRepository::class);
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
