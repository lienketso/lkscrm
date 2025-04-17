<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Project\ProjectController;
use Webkul\Admin\Http\Controllers\Project\PhaseController;

Route::controller(ProjectController::class)->prefix('my-projects')->group(function () {
    Route::get('', 'indexMy')->name('admin.my-projects.index');
});

