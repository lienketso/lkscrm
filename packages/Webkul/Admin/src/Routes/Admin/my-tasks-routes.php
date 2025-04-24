<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Task\TaskController;

Route::controller(TaskController::class)->prefix('my-tasks')->group(function () {
    Route::get('get-projects', 'getMyProjects')->name('admin.my-tasks.get-projects');
    Route::get('get-phase-by-project-id/{id}', 'getPhaseByProjectId')->name('admin.my-tasks.get-phase-by-project-id');
    Route::get('', 'indexMy')->name('admin.my-tasks.index');
    Route::get('create', 'create')->name('admin.my-tasks.create');
    Route::post('store', 'store')->name('admin.my-tasks.store');
    Route::get('{id}/edit', 'edit')->name('admin.my-tasks.edit');
    Route::delete('{id}/delete', 'delete')->name('admin.my-tasks.delete');
    Route::put('update/{id}', 'update')->name('admin.my-tasks.update');
    Route::get('get-phase-by-project-input', 'getPhaseByProjectInput')->name('admin.my-tasks.getPhaseByProjectInput');
    Route::get('get-assign-by-project-input', 'getAssignByProjectInput')->name('admin.my-tasks.getAssignByProjectInput');
    Route::get('get-assign-only-me', 'getAssignOnlyMeInput')->name('admin.my-tasks.getAssignOnlyMeInput');
    Route::get('get-user-support-input', 'getUserSupportInput')->name('admin.my-tasks.getUserSupportInput');
    Route::get('get-parent-task-by-project-input', 'getParentTaskByProjectInput')->name('admin.my-tasks.getParentTaskByProjectInput');
    Route::get('get-comment-by-task-id', 'getCommentByTaskId')->name('admin.my-tasks.getCommentByTaskId');
    Route::post('change-task-status', 'changeTaskStatus')->name('admin.my-tasks.changeTaskStatus');
    Route::post('store-comment', 'storeComment')->name('admin.my-tasks.storeComment');
    Route::get('{id}/edit-comment', 'editComment')->name('admin.my-tasks.editComment');
    Route::put('update-comment', 'updateComment')->name('admin.my-tasks.updateComment');
    Route::delete('delete-comment/{id}', 'deleteComment')->name('admin.my-tasks.deleteComment');
});

