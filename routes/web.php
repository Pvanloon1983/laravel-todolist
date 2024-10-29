<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;
use Illuminate\Http\Request;

Route::get('/', function() {
    return view('index', [
        'todolist' => Todo::latest()->paginate(5)
    ]);
})->name('home.index');

Route::get('/todo/add', function() {
    return view('create');
})->name('todos.create');

Route::post('/todos', function (Request $request) {
    $request->validate([
        'text' => 'required|string|max:255',
    ]);

    Todo::create([
        'text' => $request->text,
        'completed' => false, // Default to incomplete
    ]);

    return redirect()->route('home.index')->with('success', 'Todo item created successfully!');
})->name('todos.store');

Route::delete('/todo/{todo}', function (Todo $todo) {
    $todo->delete();

    return redirect()->route('home.index')
        ->with('success', 'Todo item deleted successfully!');
})->name('todo.destroy');

Route::fallback(function () {
    return '404 - Not found!';
});
