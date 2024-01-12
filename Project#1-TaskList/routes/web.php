<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
class Task
{
  public function __construct(
    public int $id,
    public string $title,
    public string $description,
    public ?string $long_description,
    public bool $completed,
    public string $created_at,
    public string $updated_at
  ) {
  }
}

$tasks = [
  new Task(
    1,
    'Buy groceries',
    'Task 1 description',
    'Task 1 long description',
    false,
    '2023-03-01 12:00:00',
    '2023-03-01 12:00:00'
  ),
  new Task(
    2,
    'Sell old stuff',
    'Task 2 description',
    null,
    false,
    '2023-03-02 12:00:00',
    '2023-03-02 12:00:00'
  ),
  new Task(
    3,
    'Learn programming',
    'Task 3 description',
    'Task 3 long description',
    true,
    '2023-03-03 12:00:00',
    '2023-03-03 12:00:00'
  ),
  new Task(
    4,
    'Take dogs for a walk',
    'Task 4 description',
    null,
    false,
    '2023-03-04 12:00:00',
    '2023-03-04 12:00:00'
  ),
];


*/





Route::get('/' , function() {
  return redirect()->route('tasks.index');
});



Route::get( '/tasks' , function() {
  return view( 'index' , [ 'tasks' => \App\models\Task::latest()->where('completed', true)->get() ]);
})->name('tasks.index');

/* Route::get( '/tasks/{id}' , function($id) use ($tasks) { 
              // convierte el array en una coleccion, para poder trabajar con principios de POO
    $task = collect($tasks)->firstWhere('id' , $id);
    if (!$task) {
      abort(Response::HTTP_NOT_FOUND);
    }
                      // se pasa el array como segundo parametro para poder trabajar con el desde los templates
    return view('show', ['task' => $task]);
 })->name('tasks.show');
*/

Route::get('/tasks/{id}' , function($id) {
  return view ('show' , ['task' => \App\Models\Task::find($id)]);
})->name('tasks.show');




// basically takes something by URL and return a view, proceeding from a function. // (1)
// it does via a get method (get the URL and return the view)
/*Route::get('/', function () use ($tasks){
    return view('index' , [
        'tasks' => $tasks
    ]);
})->name('main'); // we use name to give a name to the route, instead of just using a URL. (1.4)
*/

// Here we are defining a route that takes a parameter (name) and return a string with the name (1.2)
Route::get('/greet/{name}', function ($name) {
    return 'hello ' . $name;
});

Route::get('/hello', function () {
    return 'hello, you are on the hello page';
});

// Here we are defining a route that takes by a get method a URL 'xxx' and redirect to the hello page by using the redirect function (1.3)
Route::get('/xxx' , function() {
    return redirect('hello');
});
// Here we are defining a route that takes by a get method a URL 'hallo' and redirect to the main page by using the redirect function and the route name (1.5)
Route::get('/hallo' , function() {
    return redirect()->route('main'); // by using route we can redirect to a route name instead of a URL (1.6)
});

// Here we are using fallback. This will allow us to redirect to a 404 page if the URL is not found or if it doesn't exits (1.7)
Route::fallback(function () {
    return '404';
});

Route::get('index' , function() {
    return view('index' , [  // here we are returning a view template. This will be located at resources/views(1.8)
        'name' => 'Nico'   // Here we are creating a new variable called name which stores a string 'Nico' and it is usable by the view template (1.9)
    ]); 
});


