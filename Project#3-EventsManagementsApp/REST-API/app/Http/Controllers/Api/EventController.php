<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EventResource;
use App\Http\Controllers\Controller;
use App\Http\Traits\CanLoadRelationships;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller {

    use CanLoadRelationships;

    private array $relations = ['user' , 'attendees' , 'attendees.user'];

    public function __construct() {
        $this->middleware(['auth:sanctum'])->except(['index' , 'show']);
        $this->middleware('throttle:api')->only(['store' , 'update' , 'destroy']);
        $this->authorizeResource(Event::class , 'event');
    }
    
    public function index() {

        $query = $this->loadRelationships(Event::query());
    
        return EventResource::collection(
           $query->latest()->paginate()
        );
    }

    protected function shouldIncluideRelation(string $relation) : bool  {
        $include = request()->query('include');
        if (!$include) {
            return false;
        }
        $relations =  array_map( 'trim' ,  explode(',' , $include) );   
                            // Here we are 'sanitizing' the URL 
        return in_array($relation , $relations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $event = Event::create([
            ...$request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_date',
            ]) , 
            'user_id' => $request->user()->id
        ]);

        return new EventResource($this->loadRelationships($event));

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event) {
       return new EventResource($this->loadRelationships($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event) {
        // if ($request->user()->id !== $event->user_id)  
        if(Gate::denies('update-event' , $event)) {
            abort(403 , 'you are not authorized to update'); // Forbidden, so user may be authenticated but not authorized
        }

        // $this->authorize('update' , $event); 


        $event->update(
            $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_date',
        ])
      );
      return new EventResource($this->loadRelationships($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event) {
        $event->delete();
        return response(status : 204);
    }
}
