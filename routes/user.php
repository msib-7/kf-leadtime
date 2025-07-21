<?php

use Illuminate\Support\Facades\Route;
// , 'NetworkTesting'
Route::prefix('v1')->name('v1.')->middleware(['auth', 'MaintenanceMode'])->group(function () {
    Route::prefix('calculation')->name('calculation.')->middleware(['auth'])->group(function () {
        Route::get('dt', [App\Http\Controllers\V1\Calculation\CalculationController::class, 'getdata'])->name('getData');
        Route::get('', [App\Http\Controllers\V1\Calculation\CalculationController::class, 'index'])->name('index');

        Route::get('getcalculation', [App\Http\Controllers\V1\Calculation\CalculationController::class, 'getCalculationData'])->name('getCalculationData');
        Route::get('getyears', [App\Http\Controllers\V1\Calculation\CalculationController::class, 'getAvailableYears'])->name('getAvailableYears');
        Route::get('getmonths', [App\Http\Controllers\V1\Calculation\CalculationController::class, 'getAvailableMonths'])->name('getAvailableMonths');

        Route::post('inserttoexcl', [App\Http\Controllers\V1\Calculation\CalculationController::class, 'insertToExcl'])->name('insertToExcl');
    });

    Route::get('', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('auditTrail')->name('auditTrail.')->middleware(['auth'])->group(function () {
        Route::get('', [App\Http\Controllers\System\AuditController::class, 'index'])->name('index');
        Route::post('pdf', [App\Http\Controllers\System\AuditController::class, 'generatePdf'])->name('generatePdf');
    });

    Route::get('contactUs', [App\Http\Controllers\System\ContactUs\ContactUsController::class, 'index'])->name('contactUs');
});
