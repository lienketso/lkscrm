<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Lead\ZaloTemplateController;

Route::controller(ZaloTemplateController::class)->prefix('zalos')->group(function () {

    Route::get('', 'index')->name('admin.zalo.template.index');

    Route::get('sync-template', 'syncZaloMessageTemplate')->name('admin.zalo.template.sync');
});
