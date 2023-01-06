<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
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

    <form action="/tasks/create" method="POST">
        @csrf
        <br>
        <br>
        <br>
        <button type="submit">Create</button>
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
        <button><a href="create/{{ $task['id'] }}">Edit</a></button>
        <form action="create/{{ $task['id'] }}" method="POST">
        <form action="/tasks/create/{{ $task['id'] }}" method="POST" >
            @csrf
            @method('DELETE')
        </form>
        <br>
        <br>
        @endforeach
</body>
</html>