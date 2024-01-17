<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    $tasks = \App\Models\Task::all(); 
    return view('view', ['tasks' => $tasks]);
})->name('home');


// remember to use illuminate request
Route::post('/' , function(Request $request) {
    $data = $request->validate([
        'title' => 'required|max:25',
    ]);

    $task = new \App\Models\Task;
    $task->title = $data['title'];
    $task->save();
    return redirect()->route('home');
})->name('tasks.store');

Route::get('/edit/{id}', function($id) {
    $task = \App\Models\Task::findOrFail($id);
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::put('/{id}' , function($id, Request $request) {
    $data = $request->validate([
        'title' => 'required|max:25',
    ]);

    $task = \App\Models\Task::findOrFail($id);
    $task->title = $data['title'];
    $task->save();
    return redirect()->route('home');
})->name('tasks.update');

Route::delete('/{task}' , function($task) {
    $task = \App\Models\Task::findOrFail($task);
    $task->delete();
    return redirect()->route('home');
})->name('tasks.delete');

Route::fallback(function () {
    abort(404);
});
