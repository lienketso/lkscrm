<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Lead\ZaloTemplateController;
use Webkul\Admin\Http\Controllers\Lead\CampaignController;

Route::controller(ZaloTemplateController::class)->prefix('zalos')->group(function () {

    Route::get('', 'index')->name('admin.zalo.template.index');

    Route::get('view/{id}', 'view')->name('admin.zalo.view');

    Route::get('sync-template', 'syncZaloMessageTemplate')->name('admin.zalo.template.sync');
});

Route::controller(CampaignController::class)->prefix('campaign')->group(function () {

    Route::get('', 'index')->name('admin.campaign.index');

    Route::get('create', 'create')->name('admin.campaign.create');

    Route::post('create', 'store')->name('admin.campaign.store');

    Route::get('view/{id}', 'view')->name('admin.campaign.view');

    Route::get('edit/{id}', 'edit')->name('admin.campaign.edit');

    Route::put('edit/{id}', 'update')->name('admin.campaign.update');
});
