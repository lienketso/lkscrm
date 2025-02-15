<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Project\ProjectController;
use Webkul\Admin\Http\Controllers\Project\PhaseController;

Route::controller(ProjectController::class)->prefix('projects')->group(function () {

    Route::get('', 'index')->name('admin.projects.index');
    Route::get('create', 'create')->name('admin.projects.create');
    Route::post('store', 'store')->name('admin.projects.store');
    Route::get('{id}/edit', 'edit')->name('admin.projects.edit');
    Route::put('{id}/update', 'update')->name('admin.projects.update');
});

Route::controller(PhaseController::class)->prefix('phases')->group(function () {

    Route::get('', 'index')->name('admin.phases.index');
    Route::get('create', 'create')->name('admin.phases.create');
    Route::post('store', 'store')->name('admin.phases.store');
    Route::get('{id}/edit', 'edit')->name('admin.phases.edit');
    Route::put('{id}/update', 'update')->name('admin.phases.update');

});
