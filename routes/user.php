<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->middleware(['auth', 'MaintenanceMode', 'CheckJobLvlPermission', 'NetworkTesting'])->group(function () {
    Route::get('', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('auditTrail')->name('auditTrail.')->middleware(['auth'])->group(function () {
        Route::get('', [App\Http\Controllers\System\AuditController::class, 'index'])->name('index');
        Route::post('pdf', [App\Http\Controllers\System\AuditController::class, 'generatePdf'])->name('generatePdf');
    });

    Route::get('contactUs', [App\Http\Controllers\System\ContactUs\ContactUsController::class, 'index'])->name('contactUs');

    

    Route::prefix('pengukuran-awal')->name('pengukuran-awal.')->group(function () {
        Route::prefix('punch')->name('punch.')->group(function () {
            Route::prefix('atas')->name('atas.')->group(function () {
                Route::get('', [App\Http\Controllers\V1\PengukuranAwal\PunchAtasController::class, 'index'])->name('index');
            });
            Route::prefix('bawah')->name('bawah.')->group(function () {
                Route::get('', [App\Http\Controllers\V1\PengukuranAwal\PunchBawahController::class, 'index'])->name('index');
            });
        });
        Route::prefix('dies')->name('dies.')->group(function () {
            Route::get('', [App\Http\Controllers\V1\PengukuranAwal\DiesController::class, 'index'])->name('index');
        });
    });

    Route::prefix('pengukuran-rutin')->name('pengukuran-rutin.')->group(function () {
        Route::prefix('punch')->name('punch.')->group(function () {
            Route::prefix('atas')->name('atas.')->group(function () {

            });
            Route::prefix('bawah')->name('bawah.')->group(function () {

            });
        });
        Route::prefix('dies')->name('dies.')->group(function () {

        });
    });

    Route::prefix('approval')->name('approval.')->group(function () {
        Route::prefix('pengukuran')->name('pengukuran.')->group(function () {
            Route::prefix('awal')->name('awal.')->group(function () {

            });
            Route::prefix('rutin')->name('rutin.')->group(function () {

            });
        });
        Route::prefix('disposal')->name('disposal.')->group(function () {

        });
    });

    Route::prefix('History')->name('history.')->group(function () {
        
    });

    Route::prefix('disposal')->name('disposal.')->group(function () {
        Route::prefix('request')->name('request.')->group(function () {

        });
    });

});