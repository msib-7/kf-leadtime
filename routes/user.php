<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->middleware(['auth', 'MaintenanceMode', 'CheckJobLvlPermission', 'NetworkTesting'])->group(function () {
    Route::get('', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('auditTrail')->name('auditTrail.')->middleware(['auth'])->group(function () {
        Route::get('', [App\Http\Controllers\System\AuditController::class, 'index'])->name('index');
        Route::post('pdf', [App\Http\Controllers\System\AuditController::class, 'generatePdf'])->name('generatePdf');
    });

    Route::get('contactUs', [App\Http\Controllers\System\ContactUs\ContactUsController::class, 'index'])->name('contactUs');
});
