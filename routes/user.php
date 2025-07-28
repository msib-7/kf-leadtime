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


        Route::prefix('exclude')->name('exclude.')->middleware(['auth'])->group(function () {
            Route::get('', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'index'])->name('index');

            Route::get('getcalculation', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'getCalculationData'])->name('getCalculationData');
            Route::get('getyears', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'getAvailableYears'])->name('getAvailableYears');
            Route::get('getmonths', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'getAvailableMonths'])->name('getAvailableMonths');
            Route::get('getlines', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'getAvailableLines'])->name('getAvailableLines');

            // routes/web.php
            Route::get('gettags', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'getAvailableTags'])->name('getAvailableTags');
            Route::post('destroy/{lot_number}', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'destroy'])->name('destroy');
            Route::post('lineafter/{lot_number}', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'updateLineX'])->name('updateLineX');
            Route::post('rollback/{lot_number}', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'rollback'])->name('rollback');
            Route::post('rollbacklinex/{lot_number}', [App\Http\Controllers\V1\Calculation\ExcludeController::class, 'rollbackLineX'])->name('rollbackLineX');
        });

        Route::prefix('problem')->name('problem.')->middleware(['auth'])->group(function () {
            Route::get('', [App\Http\Controllers\V1\Calculation\Problem\IndexProbController::class, 'index'])->name('index');

            Route::get('getcalculation', [App\Http\Controllers\V1\Calculation\Problem\IndexProbController::class, 'getCalculationData'])->name('getCalculationData');
            Route::get('getyears', [App\Http\Controllers\V1\Calculation\Problem\IndexProbController::class, 'getAvailableYears'])->name('getAvailableYears');
            Route::get('getmonths', [App\Http\Controllers\V1\Calculation\Problem\IndexProbController::class, 'getAvailableMonths'])->name('getAvailableMonths');
            Route::get('getlines', [App\Http\Controllers\V1\Calculation\Problem\IndexProbController::class, 'getAvailableLines'])->name('getAvailableLines');

            Route::post('inserttoexcl', [App\Http\Controllers\V1\Calculation\Problem\IndexProbController::class, 'insertToExcl'])->name('insertToExcl');

            Route::prefix('menuprob')->name('menuprob.')->middleware(['auth'])->group(function () {
                Route::get('', [App\Http\Controllers\V1\Calculation\Problem\MenuProbController::class, 'index'])->name('index');

                Route::get('getcalculation', [App\Http\Controllers\V1\Calculation\Problem\MenuProbController::class, 'getCalculationData'])->name('getCalculationData');
                Route::get('getyears', [App\Http\Controllers\V1\Calculation\Problem\MenuProbController::class, 'getAvailableYears'])->name('getAvailableYears');
                Route::get('getmonths', [App\Http\Controllers\V1\Calculation\Problem\MenuProbController::class, 'getAvailableMonths'])->name('getAvailableMonths');
                Route::get('getlines', [App\Http\Controllers\V1\Calculation\Problem\MenuProbController::class, 'getAvailableLines'])->name('getAvailableLines');
            });
        });
        // Route::prefix('problem')->name('problem.')->middleware(['auth'])->group(function() {
        //     Route::get('', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'index'])->name('index');

        //     Route::get('getcalculation', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'getCalculationData'])->name('getCalculationData');
        //     Route::get('getyears', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'getAvailableYears'])->name('getAvailableYears');
        //     Route::get('getmonths', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'getAvailableMonths'])->name('getAvailableMonths');
        //     Route::get('getlines', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'getAvailableLines'])->name('getAvailableLines');
        // });

    });
    // 
    // Route::prefix('problem')->name('problem.')->middleware(['auth'])->group(function() {
    //     Route::get('', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'index'])->name('index');

    //     Route::get('getcalculation', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'getCalculationData'])->name('getCalculationData');
    //     Route::get('getyears', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'getAvailableYears'])->name('getAvailableYears');
    //     Route::get('getmonths', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'getAvailableMonths'])->name('getAvailableMonths');
    //     Route::get('getlines', [App\Http\Controllers\V1\Calculation\ProblemController::class, 'getAvailableLines'])->name('getAvailableLines');
    // });

    Route::get('', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('auditTrail')->name('auditTrail.')->middleware(['auth'])->group(function () {
        Route::get('', [App\Http\Controllers\System\AuditController::class, 'index'])->name('index');
        Route::post('pdf', [App\Http\Controllers\System\AuditController::class, 'generatePdf'])->name('generatePdf');
    });

    Route::get('contactUs', [App\Http\Controllers\System\ContactUs\ContactUsController::class, 'index'])->name('contactUs');
});
