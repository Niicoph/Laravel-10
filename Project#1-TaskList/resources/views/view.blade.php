@extends('layouts.app')

@section('title')
    <!-- Mobile first, thats why small text and then increase its value -->
    <h1 class="text-4xl sm:text-6xl font-bold font-mono text-white">Task List</h1>
@endsection


@section('search')
    <form action="" method="" class="w-full h-full flex justify-center items-center flex-col ">
        <input type="text" placeholder="Enter a task" class="border-b border-indigo-600 text-center w-3/4">
    </form>
@endsection

@section('form')
    <section class="border-4 rounded-2xl border-indigo-600 h-3/4 w-3/4 flex flex-col">
        <div class="w-full h-1/4 ">
            <form action="{{route('tasks.store')}}" method="POST" class="w-full h-3/4 flex justify-center items-center">
                @csrf
                <input type="text" placeholder="Enter a task" class="border-b-2 border-indigo-600 w-2/4 focus:outline-none" name="title" id="title">
                <input type="submit" value="Add" class="bg-indigo-600 text-center text-white rounded-md p-1 ml-2 mb-1 text-md">
            </form>
            @error('title')
            <p class="flex justify-center text-red-500">{{$message}}</p>
            @enderror
        </div>
        <div class="w-full h-3/4">
            <ul class="w-full h-full flex items-center flex-col overflow-y-auto">
                @foreach($tasks as $task)
                <li class="border-b border-indigo-600 w-3/4 mt-2 p-2 flex">
                    <p class="w-3/4 flex items-center"> {{$task->title}} </p>
                    <div class="w-1/4 flex">
                        <form action="{{route('tasks.delete', ['task' => $task->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white rounded-md p-1 text-md"> Delete </button>
                        </form>
                        <button class="bg-indigo-600 text-white rounded-md p-1 ml-1 text-md">
                            <a href="{{route('tasks.edit', $task->id)}}">Edit</a>
                        </button>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
