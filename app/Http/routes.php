<?php

use App\Task;
use App\News;
use Carbon\Carbon;
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



///-------News--------
Route::get('/news', function () {

    $news = News::orderBy('created_at', 'asc')->get();
    return view('news', ['news' => $news]);
});

/**
 * Добавить новую новость
 */
Route::post('/news', function (Request $request) {
    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:6',
    ]);

    if ($validator->fails()) {
        return redirect('/news')
                        ->withInput()
                        ->withErrors($validator);
    }
    $news = new News();
    $news->name = $request->name;
    $news->text = $request->text;
    $news->save();
    // Создание задачи...
    return redirect('/news');
});
/**
 * Удалить новость
 */
Route::delete('/news/{news_item}', function (News $news_item) {
    $news_item->delete();
    return redirect('/news');
});
/**
 * Получить новость
 */
Route::get('/news/{news_item}/edit', function (News $news_item) {
    return view('newsedit', [
        'news_item' => $news_item
    ]);
});

Route::post('/news/edit', function (Request $request) {

    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:6',
    ]);
    if ($validator->fails()) {
        return redirect('/news/edit/' . $request->id)
                        ->withInput()
                        ->withErrors($validator);
    }
    $news = News::find($request->id);
    $news->name = $request->name;
    $news->text = $request->text;
    $news->updated_at = Carbon::now('Europe/Kiev');
    $news->save();
    return redirect('/news');
});