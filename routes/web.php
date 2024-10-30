<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;
use Illuminate\Http\Request;

Route::get('/', function() {
    return view('index', [
        'todolist' => Todo::latest()->paginate(5)
    ]);
})->name('home.index');

Route::get('/todos/create', function() {
    return view('create');
})->name('todos.create');

Route::get('/todos/{todo}', function (Todo $todo) {
    return view('show', [
        'todo' => $todo
    ]);
})->name('todos.show');

Route::post('/todos', function (Request $request) {
    $request->validate([
        'text' => 'required|string|min:10',
    ]);

    Todo::create([
        'text' => $request->text,
        'completed' => false, // Default to incomplete
    ]);

    return redirect()->route('home.index')->with('success', 'Todo item created successfully!');
})->name('todos.store');

Route::delete('/todos/{todo}', function (Todo $todo) {
    $todo->delete();

    return redirect()->route('home.index')
        ->with('success', 'Todo item deleted successfully!');
})->name('todo.destroy');

Route::get('/todos/edit/{todo}', function (Todo $todo) {
    return view('edit', [
        'todo' => $todo
    ]);
})->name('todos.edit');

Route::put('/todos/{todo}', function(Todo $todo, Request $request) {
    $request->validate([
        'text' => 'required|string|min:10',
    ]);

    $todo->update([
        'text' => $request->input('text')
    ]);

    return redirect()->route('todos.update', ['todo' => $todo->id])->with('success', 'Todo item updated successfully!');

})->name('todos.update');

Route::fallback(function () {
    return '404 - Not found!';
});
