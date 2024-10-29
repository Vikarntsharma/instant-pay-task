@extends('layouts.app')
@section('content')
    <h2>Task: {{ $task->title }}</h2>
    <p>{{ $task->description }}</p>
    <p>Status: {{ ucfirst($task->status) }}</p>

    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Edit Task</a>
    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Task</button>
    </form>
@endsection
