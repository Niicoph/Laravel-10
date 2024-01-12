@extends('layouts.app')

@section ('title' , $task->title) 

@section ('content')
    <div>
        <p> {{$task->description}} </p>
    </div>
@endsection
