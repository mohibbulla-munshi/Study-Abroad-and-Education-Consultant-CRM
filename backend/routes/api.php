<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    StudentController,
    CourseController,
    UniversityController,
    ApplicationController,
    AgentController,
    VisaApplicationController,
    DocumentController,
    LeadController,
    CommunicationLogController,
    UserController,
    RolePermissionController,
    AuthController,
    DepartmentController,
    CourseOfferUniversityController
};



// Public Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Requires Authentication)
Route::middleware(['auth:sanctum'])->group(function () {

    // User and Permissions
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('assign-permissions', [RolePermissionController::class, 'assignPermissions']);

    // Resource Routes
    Route::apiResources([
        'students'            => StudentController::class,
        'courses'             => CourseController::class,
        'universities'        => UniversityController::class,
        'applications'        => ApplicationController::class,
        'agents'              => AgentController::class,
        'visa-applications'   => VisaApplicationController::class,
        'documents'           => DocumentController::class,
        'leads'               => LeadController::class,
        'communication-logs'  => CommunicationLogController::class,
        'departments'         => DepartmentController::class,
        'course-offers'       => CourseOfferUniversityController::class
    ]);

});
