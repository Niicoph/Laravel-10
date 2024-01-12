@extends('layouts.app')

@section('title' , 'hello world, welcome to blade template!')

@section('content')
<div>
    @if (count($tasks) > 0)
        <p>There are tasks!</p>
        <div>
            <ul>
                @foreach ($tasks as $task)
                    <li>
                        <a href=" {{route('tasks.show' , ['id' => $task->id] )}} "> {{$task->title}}  </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else 
        <div>There are no tasks!</div>
    @endif
</div>

@endsection