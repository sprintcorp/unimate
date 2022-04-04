<?php

use App\Http\Controllers\v1\AudioRecordController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\ChatController;
use App\Http\Controllers\v1\CourseController;
use App\Http\Controllers\v1\CourseMaterialController;
use App\Http\Controllers\v1\CourseOutlineController;
use App\Http\Controllers\v1\CourseUserController;
use App\Http\Controllers\v1\DepartmentController;
use App\Http\Controllers\v1\FacultyController;
use App\Http\Controllers\v1\GroupController;
use App\Http\Controllers\v1\NoteTakerController;
use App\Http\Controllers\v1\PastQuestionController;
use App\Http\Controllers\v1\ReminderController;
use App\Http\Controllers\v1\RoleController;
use App\Http\Controllers\v1\UniversityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Role route
    Route::resource('roles',RoleController::class);

//    Unauthorized route
    Route::group(['prefix' => 'auth'], function(){
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login']);
        Route::post('/otp', [AuthController::class, 'otp']);
        Route::put('/reset', [AuthController::class, 'reset'])->name('reset');
        Route::post('/verify', [AuthController::class, 'verify'])->name('verify');
        Route::put('/user-password', [AuthController::class, 'passwordReset'])->name('password-reset');
    });

//  User route
    Route::group(['prefix' => 'user','middleware'=>'auth:api'], function(){
        Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('update-profile');
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::resource('courses',CourseUserController::class);
        Route::put('update-courses',[CourseUserController::class,'updateCourse'])->name('updateCourse');
        Route::resource('notes',NoteTakerController::class);
        Route::resource('reminder',ReminderController::class);
        Route::resource('group',GroupController::class);
        Route::resource('chat',ChatController::class);
        Route::get('/group-chat/{id}',[ChatController::class,'getGroupChat']);
        Route::get('/course-chat/{id}',[ChatController::class,'getCourseChat']);
        Route::get('/chats/{id}',[ChatController::class,'getUserChat']);
        Route::get('/connections',[ChatController::class,'getChatUsers']);
        Route::post('/search',[ChatController::class,'searchUser'])->name('searchUser');
        Route::post('/add-to-chat',[ChatController::class,'addUserToChat'])->name('addUserToChat');
        Route::delete('/remove-from-chat/{id}',[ChatController::class,'removeUserFromChat'])->name('removeUserFromChat');
        Route::post('/add-to-group/{id}',[GroupController::class,'addUserToGroup'])->name('addUserToGroup');
        Route::post('/remove-from-group/{id}',[GroupController::class,'removeUserFromGroup'])->name('removeUserFromGroup');
        Route::resource('audio',AudioRecordController::class);
        Route::post('/audio/{id}', [AudioRecordController::class, 'updateAudio'])->name('updateAudio');
    });

// Institution route
    Route::group(['middleware'=>'auth:api'], function(){
        Route::resource('university',UniversityController::class);
        Route::post('upload-university',[UniversityController::class,'uploadUniversity'])->name('uploadUniversity');
        Route::resource('faculty',FacultyController::class);
        Route::post('upload-faculty',[FacultyController::class,'uploadFaculty'])->name('uploadFaculty');
        Route::resource('department',DepartmentController::class);
        Route::post('upload-department',[DepartmentController::class,'uploadDepartment'])->name('uploadDepartment');
        Route::resource('institution-course',CourseController::class);
        Route::resource('course-outline',CourseOutlineController::class);
        Route::resource('course-material',CourseMaterialController::class);
        Route::post('/course-material/{id}', [CourseMaterialController::class, 'updateMaterial'])->name('updateMaterial');
        Route::resource('past-question',PastQuestionController::class);
        Route::post('/past-question/{id}', [PastQuestionController::class, 'updatePastQuestion'])->name('updatePastQuestion');
        Route::post('/upload-past-question', [PastQuestionController::class, 'uploadPastQuestion'])->name('uploadPastQuestion');
    });

