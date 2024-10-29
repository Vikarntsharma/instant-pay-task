@extends('layouts.app')

@section('content')
    <h2 class="text-center">{{ $board->title }}</h2>
    <p class="text-center">{{ $board->description }}</p>

    <a href="{{ route('boards.edit', $board) }}" class="btn btn-primary">Edit Board</a>
    <a href="{{ route('boards.tasks.create', $board) }}" class="btn btn-success">Add Task</a>

    <h3 class="mt-4">Tasks</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Task Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $index => $task)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;" onsubmit="return confirmDeletion()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
<script>
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this task?");
    }
</script>
@endpush
