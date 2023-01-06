<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    @vite('resources/css/app.css')
</head>
<body>
    @if (Session::has('message'))
    {{Session::get('message')}}
    @endif

    @if($errors->has('task_title'))
        {{$errors->first('task_title')}}
    @endif
    @if($errors->has('task_description'))
        {{$errors->first('task_description')}}
    @endif

    <h1>Create Task</h1>
    <form action="/create" method="POST">
        @csrf
        <input type="text" placeholder="Task Name" name="task_title" value="{{old('')}}" required>
        <br>
        <textarea type="text" placeholder="Task Description" name="task_description" value="{{old('')}}" required></textarea>
        <br>
        <input  type="date" name="published_at" value="{{old('published_at')}}" required>
        <br>
        <br>
        <input  type="date" name="published_at" value="{{old('published_at')}}" required class="border-solid border-2 border-black">
        <br>
        <br>
        <button type="submit" class="border-solid border-2 border-black">Create</button>
    </form>

    @foreach ($tasks as $task )
        <br>
        <br>    
            Title: {{ $task->task_title }}
        <br>
            Description: {{ $task->task_description }}
        <br>
            Published At: {{ $task->published_at }}
        <br>
        <button class="border-solid border-2 border-black"><a href="/tasks/create/{{ $task['id'] }}">Edit</a></button>
        <form action="/tasks/create/{{ $task['id'] }}" method="POST" >
            @csrf
            @method('DELETE')
            <input type="submit" name="" value="delete" class="border-solid border-2 border-black">

        </form>
        <br>
        <br>
        @endforeach
</body>
</html>