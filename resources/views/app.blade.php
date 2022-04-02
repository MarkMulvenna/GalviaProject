@extends('base')
<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->

    <title>Laravel CRUD</title>
</head>
<body>
<h1>Todos</h1>
<hr>

<h2>Add new task</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
            Title: {{$todo->title}}
            Task: {{ $todo->task }}
            {{$todo->dueDateTime}}
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
        {{$todoComplete->title}}
        {{$todoComplete->task}}
    </li>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
