@extends('layouts.app')

@section('title', 'Todo List')

@section('content')
    <h1>Todo List</h1>
    <!-- Flash Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div>
        <a href="{{ route('todos.create') }}"><button class="btn btn-success">Add an item</button></a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($todolist as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->text }}</td>
                    <td><button class="btn btn-primary">View</button></td>
                    <td><button class="btn btn-warning">Edit</button></td>
                    <td>
                        <form action="{{ route('todo.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No items found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($todolist->count())
        <nav>
            {{ $todolist->links('pagination::bootstrap-5') }}
        </nav>
    @endif
@endsection
