<?php

use App\Http\Controllers\JobController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;



route::get('/' , fn() => to_route('jobs.index'));

Route::resource('jobs' , JobController::class)
    ->only(['index' , 'show']);

