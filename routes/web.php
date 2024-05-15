<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

Route::redirect('/', 'login');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/employee', function () {
    return view('employees.list');
})->middleware(['auth', 'verified'])->name('employee');

Route::get('/emailcheck', function () {
    return view('mail.employeeMail');
})->name('emailcheck');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/inviteMail', [UserController::class, 'sendInvite'])->name('sendInvite');
});

Route::get('/create-password/{id}', [UserController::class, 'createPassword'])->name('create-password');
Route::post('/create-password/{id}', [UserController::class, 'addPassword'])->name('add-password');
Route::get('/todolist', [TaskController::class, 'todoList'])->name('todo-list');
Route::get('/add-todo', [TaskController::class, 'addTodo'])->name('add-todo');
Route::post('/create-todo', [TaskController::class, 'store'])->name('create-todo');
Route::post('/delete-todo/{id}', [TaskController::class, 'destroy'])->name('delete-todo');
Route::get('/edit-todo/{id}', [TaskController::class, 'edit'])->name('edit-todo');
Route::get('/notification/{id}', [UserController::class, 'notification'])->name('notification');


require __DIR__.'/auth.php';
