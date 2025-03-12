<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Task\TaskController;

Route::controller(TaskController::class)->prefix('tasks')->group(function () {

    Route::get('/', 'index')->name('admin.tasks.index');
    Route::get('create', 'create')->name('admin.tasks.create');
    Route::post('store', 'store')->name('admin.tasks.store');
    Route::get('{id}/edit', 'edit')->name('admin.tasks.edit');
    Route::put('update/{id}', 'update')->name('admin.tasks.update');
    Route::get('get-phase-by-project-input', 'getPhaseByProjectInput')->name('admin.tasks.getPhaseByProjectInput');
    Route::get('get-assign-by-project-input', 'getAssignByProjectInput')->name('admin.tasks.getAssignByProjectInput');
    Route::get('get-parent-task-by-project-input', 'getParentTaskByProjectInput')->name('admin.tasks.getParentTaskByProjectInput');
    Route::post('change-task-status', 'changeTaskStatus')->name('admin.tasks.changeTaskStatus');
});
