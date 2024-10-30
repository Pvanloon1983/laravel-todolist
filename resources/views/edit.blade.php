@extends('layouts.app')

@section('title', 'Show Todo')

@section('content')
    <h1>Todo ID: {{ $todo->id }}</h1>
    <form action="{{ route('todos.update', ['todo' => $todo->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="text" name="text" id="text" class="form-control" value="{{ $todo->text }}">
            @error('text')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update Todo</button>
    </form>
    <a href="{{ route('todos.show', ['todo' => $todo->id]) }}"><button class="btn btn-primary mt-3">View item</button></a>
    <a href="{{ route('home.index') }}"><button class="btn btn-secondary mt-3">Back to list</button></a>
@endsection
