@extends('base')
<!doctype html>
<html lang="en">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <title>Laravel CRUD</title>
</head>

  <!-- Setting up alerts for errors. -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<body>
<h1> Add new task </h1>
<form action="{{ url('/todos') }}" method="POST">
    @csrf
    <input type="text" class="form-control" name="title" placeholder="Add new title">
    <input type="text" class="form-control" name="task" placeholder="Add new task">
    <input type="datetime-local" class="form-control" name="dueDate">
    <div class="d-grid gap-2">
    <button class="btn btn-primary" type="submit">Add New ToDo</button>
    </div>
</form>
<hr>

<h2>Pending tasks</h2>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<ul class="list-group">
    @foreach($todos as $todo)
        <li class="list-group-item">
            <h3> Title: {{$todo->title}} </h3>
            <h4> Task: {{ $todo->task }} </h4>
            {{$todo->dueDateTime}}
            <br>

            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                Edit
            </button>
            <form action="{{ url('todos/'.$todo->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>

            <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                <div class="card card-body">
                    <form action="{{ url('todos/'.$todo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $todo->title }}">
                        <input type="text" name="task" value="{{ $todo->task }}">
                        <input type="checkbox" name="checkStatus">
                        <label>Mark item as complete</label><br/><br/>
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>
<hr>

<h2>Completed Tasks</h2>
@foreach($todosComplete as $todoComplete)
    <li class="list-group-item">
        <h3> Title: {{$todoComplete->dueDateTime}} </h3>
        <h4> Task: {{$todoComplete->title}} </h4>
        {{$todoComplete->task}}
    </li>
@endforeach

</body>
</html>
