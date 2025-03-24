<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Task\TaskController;

Route::controller(TaskController::class)->prefix('tasks')->group(function () {

    Route::get('/', 'index')->name('admin.tasks.index');
    Route::get('create', 'create')->name('admin.tasks.create');
    Route::post('store', 'store')->name('admin.tasks.store');
    Route::get('{id}/edit', 'edit')->name('admin.tasks.edit');
    Route::delete('{id}/delete', 'delete')->name('admin.tasks.delete');
    Route::put('update/{id}', 'update')->name('admin.tasks.update');
    Route::get('get-phase-by-project-input', 'getPhaseByProjectInput')->name('admin.tasks.getPhaseByProjectInput');
    Route::get('get-assign-by-project-input', 'getAssignByProjectInput')->name('admin.tasks.getAssignByProjectInput');
    Route::get('get-user-support-input', 'getUserSupportInput')->name('admin.tasks.getUserSupportInput');
    Route::get('get-parent-task-by-project-input', 'getParentTaskByProjectInput')->name('admin.tasks.getParentTaskByProjectInput');
    Route::get('get-comment-by-task-id', 'getCommentByTaskId')->name('admin.tasks.getCommentByTaskId');
    Route::post('change-task-status', 'changeTaskStatus')->name('admin.tasks.changeTaskStatus');
    Route::post('store-comment', 'storeComment')->name('admin.tasks.storeComment');
    Route::get('{id}/edit-comment', 'editComment')->name('admin.tasks.editComment');
    Route::put('update-comment', 'updateComment')->name('admin.tasks.updateComment');
    Route::delete('delete-comment/{id}', 'deleteComment')->name('admin.tasks.deleteComment');
});
