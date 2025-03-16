<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin-panel', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.panel');
    Route::delete('/admin-panel/queue/{id}', [\App\Http\Controllers\AdminController::class, 'destroyQueue'])->name('admin.panel.queue.delete');
    Route::delete('/admin-panel/daily-queue/{id}', [\App\Http\Controllers\AdminController::class, 'destroyDailyQueue'])->name('admin.panel.daily-queue.delete');
    Route::get('/admin-panel/daily-queue/{id}/edit', [\App\Http\Controllers\AdminController::class, 'editDailyQueue'])->name('admin.panel.daily-queue.edit');
    Route::put('/admin-panel/daily-queue/{id}', [\App\Http\Controllers\AdminController::class, 'updateDailyQueue'])->name('admin.panel.daily-queue.update');
});
Route::get('/view-queue', [\App\Http\Controllers\QueueController::class, 'index'])->name('queue.index');
Route::post('/create', [\App\Http\Controllers\QueueController::class, 'create'])->name('queue.create');
Route::post('/call', [\App\Http\Controllers\QueueController::class, 'call'])->name('queue.call');
Route::post('/serve/{queue}', [\App\Http\Controllers\QueueController::class, 'serve'])->name('queue.serve');
Route::get('/history', [\App\Http\Controllers\QueueController::class, 'history'])->name('queue.history');
Route::post('/queue/register', [\App\Http\Controllers\QueueController::class, 'register'])->name('queue.register');

Route::get('/take-ticket', [\App\Http\Controllers\QueueController::class, 'showTakeTicketPage'])->name('queue.take-ticket');
Route::post('/take-ticket', [\App\Http\Controllers\QueueController::class, 'takeTicket'])->name('queue.take-ticket.post');
Route::post('/take-ticket-next-day', [\App\Http\Controllers\QueueController::class, 'takeDailyTicket'])->name('daily.queue.post');



require __DIR__.'/auth.php';


