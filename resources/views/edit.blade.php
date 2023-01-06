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
    <h1>Edit Your Task</h1>
    <form action="/tasks/create/{{$task['id']}}" method="POST">
        @csrf
        @method('PATCH')
        <input type="text" placeholder="Task Name" name="task_title" value="{{old('task_title', $task['task_title'])}}" required>
        <br>
        <textarea type="text"  name="task_description" required> {{old('task_description', $task['task_description'])}}</textarea>
        <br>
        <input  type="date" name="published_at" value="{{old('published_at', $task['published_at'])}}" required>
        <br>
        <button type="submit">Update Task</button>
    </form>

<br>
<br>
<br>
    Title: {{ $task->task_title }}
    <br>
    Description: {{ $task->task_description }}
    <br>
    Published At: {{ $task->published_at }}
</body>
</html>