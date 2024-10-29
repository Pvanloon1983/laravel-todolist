@extends('layouts.app')

@section('title', 'Create Todo')

@section('content')
    <h1>Create a New Todo Item</h1>
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="text" class="form-label">Todo Item</label>
            <input type="text" name="text" id="text" class="form-control" value="{{ old('text') }}" required>
            @error('text')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Create Todo</button>
        <a href="{{ route('home.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection
