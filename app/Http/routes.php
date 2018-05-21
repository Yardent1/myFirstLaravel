<?php

use App\Task;
use Illuminate\Http\Request;

/**
 * Вывести панель с задачами
 */
Route::get('/', function () {
//    $task= new Task();
//    $tasks=$task->all();
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('tasks', ['tasks' => $tasks]);
});

/**
 * Добавить новую задачу
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:6',
    ]);

    if ($validator->fails()) {
        return redirect('/')
                        ->withInput()
                        ->withErrors($validator);
    }
    $task = new Task();
    $task->name = $request->name;
    $task->save();
    // Создание задачи...
    return redirect('/');
});


/**
 * Удалить задачу
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
    return redirect('/');
});


Route::get('/task/edit/{task}', function (Task $task) {
    return view('taskedit', [
        'task' => $task
    ]);
});
Route::post('/task/edit', function (Request $request) {

    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:6',
    ]);
    if ($validator->fails()) {
        return redirect('/task/edit/' . $request->id)
                        ->withInput()
                        ->withErrors($validator);
    }
    $task = Task::find($request->id);
    $task->name = $request->name;
    $task->save();
    return redirect('/');
});
