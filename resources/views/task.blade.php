<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
</head>
<body>
    <h1> Create a To Do</h1>
    <form action="">
        <input type="text" placeholder="Task Name" name="task_title">
        <br>
        <textarea type="text" placeholder="Task Description" name="task_description"></textarea>
        <br>
        <button type="submit">Create</button>
    </form>
</html>