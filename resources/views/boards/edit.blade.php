@extends('layouts.app')
@section('content')
    <h2>Edit Board</h2>
    <form action="{{ route('boards.update', $board) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Board Title</label>
            <input type="text" name="title" class="form-control" value="{{ $board->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $board->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Board</button>
    </form>
@endsection
