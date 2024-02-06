<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;

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

Route::apiResource('events' , EventController::class);
        // Attendees do not exist without an event, they always need to be part of an event
Route::apiResource('events.attendees' , AttendeeController::class)
->scoped( /* ['attendee' => 'event'] */ )->except(['update']);
        /*
        -This will allow to get the attendees of a specific event
        -the attende resource is always part of an event
        if we check the routes we will see 
            -> api/events/{event}/attendees/{attendee}
        This means that the attendee resource is always part of an event (parent)
        and if a parent(which its the event) is not defined or it doesnt exist, this will cause an error
        */

Route::post('/login' , [AuthController::class , 'login']);

Route::post('/logout' , [AuthController::class , 'logout'])
         ->middleware('auth:sanctum');