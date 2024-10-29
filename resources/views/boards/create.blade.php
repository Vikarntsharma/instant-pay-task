@extends('layouts.app')
@section('content')
    <h2>Create New Board</h2>
    <form action="{{ route('boards.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Board Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create Board</button>
    </form>
@endsection
