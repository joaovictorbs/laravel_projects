<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function() {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => \App\Models\Task::latest()->get() #registros mais recentes primeiro
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create'); #url e arquivo

# se a rota de cima ficasse embaixo da /tasks{id} pode acontecer de buscar o create como o id

Route::get('/tasks{id}', function ($id) {
    
    return view('show', [
        'task' => \App\Models\Task::findOrFail($id)
    ]); #busca registro no banco de dados pelo ID / retorna null se nao encontrar
})->name('tasks.show');

Route::post('/tasks', function(Request $request) {
    dd($request->all());
})->name('tasks.store');



Route::fallback(function () {
    return 'Still got somewhere!';
});