@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Your Boards</h2>
    <a href="{{ route('boards.create') }}" class="btn btn-primary mb-3">Create New Board</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Board Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($boards as $index => $board)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <a href="{{ route('boards.show', $board) }}">{{ $board->title }}</a>
                    </td>
                    <td>
                        <a href="{{ route('boards.show', $board) }}" class="btn btn-info btn-sm">View</a>
                        <form action="{{ route('boards.destroy', $board->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDeletion()">
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
        return confirm("Are you sure you want to delete this board? All associated tasks will also be deleted.");
    }
</script>
@endpush

