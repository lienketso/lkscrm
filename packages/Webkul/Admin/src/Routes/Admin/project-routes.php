<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Project\ProjectController;
use Webkul\Admin\Http\Controllers\Project\PhaseController;

Route::controller(ProjectController::class)->prefix('projects')->group(function () {

    Route::get('', 'index')->name('admin.projects.index');
    Route::get('create', 'create')->name('admin.projects.create');
    Route::post('store', 'store')->name('admin.projects.store');
    Route::get('{id}/edit', 'edit')->name('admin.projects.edit');
    Route::put('update/{id}', 'update')->name('admin.projects.update');
    Route::get('get-member-by-leader', 'getMemberByLeader')->name('admin.projects.getMemberByLeader');
});

Route::controller(PhaseController::class)->prefix('phases')->group(function () {
    Route::get('list/{projectId}', 'index')->name('admin.phases.index');
    Route::post('store', 'store')->name('admin.phases.store');
    Route::get('{id}/edit', 'edit')->name('admin.phases.edit');
    Route::put('update/{id}', 'update')->name('admin.phases.update');

});
