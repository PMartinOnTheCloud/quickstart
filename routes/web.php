<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use App\Models\Category;

/**
 * Show Categories With Tasks
 */
Route::get('/category/show', function () {
    $categories = Category::select("*")->with('tasks')->orderBy('name', 'asc')->get();

    return view('categories.show', [
        'categories' => $categories
    ]);
});
Route::get('/category/', function () {
    return redirect('/category/show');
});

/**
 * Categories
 */
Route::get('/category/add', function () {
    $categories = Category::select("*")->with('category_parent')->orderBy('name', 'asc')->get();

    return view('categories.add', [
        'categories' => $categories
    ]);
});

/**
 * Add New Categories
 */
Route::post('/category/add', function (Request $request) {
    $name = (!empty($request->category_parent)) ? Category::select("name")->where('id', $request->category_parent)->get()[0]['name'] . ">$request->name" : $request->name;

    $category = new Category;
    $category->name = $name;
    $category->parent = $request->category_parent;
    $category->save();

    return redirect('/category/add');
});

/**
 * Delete Category
 */
Route::get('/category/delete', function (Category $category) {
// $category->delete();
return view('dev.test', []);
// return redirect('/category');
});

/**
 * Show Task Dashboard
 */
Route::get('/', function () {
    $tasks['cat'] = Category::select("*")->orderBy('name', 'asc')->get();

    $tasks['list'] = Task::with('categories')->orderBy('created_at', 'asc')->get();
    // for ($i = 0; $i < sizeOf($tasks['list']); $i++)
    //     $tasks['list'][$i]['cat_name'] = Category::select("name")->where("id", $tasks['list'][$i]['cat_id'])->get()[0]['name'];

    return view('tasks.main', [
        'tasks' => $tasks
    ]);
});

/**
 * Add New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    if (!empty($request->priority)) $task->priority = $request->priority;
    if (!empty($request->limit)) $task->limit = $request->limit;
    $task->category_id = $request->category;
    $task->save();

    return redirect('/');
});

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
    return redirect('/');
});