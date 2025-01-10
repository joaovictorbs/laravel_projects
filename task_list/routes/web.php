<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('/', function() {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->get() #registros mais recentes primeiro
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create'); #url e arquivo

# se a rota de cima ficasse embaixo da /tasks{id} pode acontecer de buscar o create como o id

Route::get('/tasks{id}', function ($id) {
    
    return view('show', [
        'task' => Task::findOrFail($id)
    ]); #busca registro no banco de dados pelo ID / retorna null se nao encontrar
})->name('tasks.show');

Route::post('/tasks', function(Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]); #valida dados declarando obrigatoriedade e tamanho maximo

    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save(); #salva novo registro

    return redirect()->route('tasks.show', ['id' => $task->id]); #redireciona para rota
})->name('tasks.store');



Route::fallback(function () {
    return 'Still got somewhere!';
});