<?php

use App\Http\Requests\TaskRequest;
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


Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]); #busca registro no banco de dados pelo ID / retorna null se nao encontrar
})->name('tasks.edit');


Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]); #busca registro no banco de dados pelo ID / retorna null se nao encontrar
})->name('tasks.show');


Route::post('/tasks', function(TaskRequest $request) {
    $task = Task::create($request->validated()); #salva novo registro

    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Task created successfully'); #redireciona para rota / define dados de sessão com with / flash message
})->name('tasks.store');


Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
    $task->update($request->validated()); #edita registro

    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Task updated successfully');
})->name('tasks.update');

Route::delete('/tasks/{task}', function(Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');


Route::fallback(function () {
    return 'Still got somewhere!';
});