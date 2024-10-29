<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Lead\ActivityController;
use Webkul\Admin\Http\Controllers\Lead\EmailController;
use Webkul\Admin\Http\Controllers\Lead\LeadController;
use Webkul\Admin\Http\Controllers\Lead\CustomerController;
use Webkul\Admin\Http\Controllers\Lead\QuoteController;
use Webkul\Admin\Http\Controllers\Lead\TagController;

Route::controller(CustomerController::class)->prefix('customers')->group(function () {
    Route::get('', 'index')->name('admin.customers.index');

    Route::get('create', 'create')->name('admin.customers.create');

    Route::post('create', 'store')->name('admin.customers.store');

    Route::get('view/{id}', 'view')->name('admin.customers.view');

    Route::get('edit/{id}', 'edit')->name('admin.customers.edit');

    Route::put('edit/{id}', 'update')->name('admin.customers.update');

    Route::put('attributes/edit/{id}', 'updateAttributes')->name('admin.customers.attributes.update');

    Route::put('stage/edit/{id}', 'updateStage')->name('admin.customers.stage.update');

    Route::get('search', 'search')->name('admin.customers.search');

    Route::delete('{id}', 'destroy')->name('admin.customers.delete');

    Route::post('mass-update', 'massUpdate')->name('admin.customers.mass_update');

    Route::post('mass-destroy', 'massDestroy')->name('admin.customers.mass_delete');

    Route::get('get/{pipeline_id?}', 'get')->name('admin.customers.get');

    Route::delete('product/{lead_id}', 'removeProduct')->name('admin.customers.product.remove');

    Route::put('product/{lead_id}', 'addProduct')->name('admin.customers.product.add');

    Route::get('kanban/look-up', [CustomerController::class, 'kanbanLookup'])->name('admin.customers.kanban.look_up');

    Route::controller(ActivityController::class)->prefix('{id}/activities')->group(function () {
        Route::get('', 'index')->name('admin.customers.activities.index');
    });

    Route::controller(TagController::class)->prefix('{id}/tags')->group(function () {
        Route::post('', 'attach')->name('admin.customers.tags.attach');

        Route::delete('', 'detach')->name('admin.customers.tags.detach');
    });

    Route::controller(EmailController::class)->prefix('{id}/emails')->group(function () {
        Route::post('', 'store')->name('admin.customers.emails.store');

        Route::delete('', 'detach')->name('admin.customers.emails.detach');
    });

    Route::controller(QuoteController::class)->prefix('{id}/quotes')->group(function () {
        Route::delete('{quote_id?}', 'delete')->name('admin.customers.quotes.delete');
    });
});
