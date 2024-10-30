@extends('layouts.app')

@section('title', 'Show Todo')

@section('content')
    <h1>Todo ID: {{ $todo->id }}</h1>
    <!-- Flash Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <p>{{ $todo->text }}</p>
    <div>
        <a href="{{ route('home.index') }}"><button class="btn btn-secondary">Back to list</button></a>

        <a href="{{ route('todos.edit', $todo->id) }}"><button class="btn btn-warning">Edit</button></a>

        <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
