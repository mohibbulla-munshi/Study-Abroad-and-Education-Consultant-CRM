<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\VisaApplicationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CommunicationLogController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('students', StudentController::class);
Route::apiResource('courses', CourseController::class);
Route::apiResource('universities', UniversityController::class);
Route::apiResource('applications', ApplicationController::class);
Route::apiResource('agents', AgentController::class);
Route::apiResource('visa-applications', VisaApplicationController::class);
Route::apiResource('documents', DocumentController::class);
Route::apiResource('leads', LeadController::class);
Route::apiResource('communication-logs', CommunicationLogController::class);
Route::post('/register', [UserController::class, 'register']);

