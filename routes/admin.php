<?php

use Illuminate\Support\Facades\Route;

// Admin Zone
Route::prefix('admin')->name('admin.')->middleware(['auth', 'CheckJobLvlPermission'])->group(function () {
    //backup db
    Route::prefix('db')->name('db.')->group(function () {
        Route::get('', [App\Http\Controllers\DBController::class, 'index'])->name('index');
        Route::post('backup', [App\Http\Controllers\DBController::class, 'backup'])->name('backup');
    });
    
    //permission
    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('', [App\Http\Controllers\System\Permission\PermissionController::class, 'index'])->name('index');
        Route::get('getData', [App\Http\Controllers\System\Permission\PermissionController::class, 'getDataTablePermission'])->name('getDataTable');
        Route::get('create', [App\Http\Controllers\System\Permission\PermissionController::class, 'create'])->name('create');
        Route::post('store', [App\Http\Controllers\System\Permission\PermissionController::class, 'store'])->name('store');
        Route::get('edit/{id}', [App\Http\Controllers\System\Permission\PermissionController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [App\Http\Controllers\System\Permission\PermissionController::class, 'update'])->name('update');
        Route::post('destroy', [App\Http\Controllers\System\Permission\PermissionController::class, 'destroy'])->name('destroy');
    });
    //department
    Route::prefix('department')->name('dept.')->group(function () {
        Route::get('', [App\Http\Controllers\System\Department\DepartmentController::class, 'index'])->name('index');
        Route::get('dt_dept', [App\Http\Controllers\System\Department\DepartmentController::class, 'dt_dept'])->name('dt_dept');
        Route::post('store', [App\Http\Controllers\System\Department\DepartmentController::class, 'store'])->name('store');
        Route::post('edit', [App\Http\Controllers\System\Department\DepartmentController::class, 'edit'])->name('edit');
        Route::post('update', [App\Http\Controllers\System\Department\DepartmentController::class, 'update'])->name('update');
        Route::post('destroy', [App\Http\Controllers\System\Department\DepartmentController::class, 'destroy'])->name('destroy');
    });

    //subdepartment
    Route::prefix('subdepartment')->name('subdept.')->group(function () {
        Route::get('', [App\Http\Controllers\System\Department\SubDepartmentController::class, 'index'])->name('index');
        Route::get('dt_subdept', [App\Http\Controllers\System\Department\SubDepartmentController::class, 'dt_subdept'])->name('dt_subdept');
        Route::post('store', [App\Http\Controllers\System\Department\SubDepartmentController::class, 'store'])->name('store');
        Route::post('edit', [App\Http\Controllers\System\Department\SubDepartmentController::class, 'edit'])->name('edit');
        Route::post('update', [App\Http\Controllers\System\Department\SubDepartmentController::class, 'update'])->name('update');
        Route::post('destroy', [App\Http\Controllers\System\Department\SubDepartmentController::class, 'destroy'])->name('destroy');
    });

    //ruangan
    Route::prefix('ruangan')->name('ruang.')->group(function () {
        Route::get('', [App\Http\Controllers\System\Ruangan\RuanganController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\System\Ruangan\RuanganController::class, 'create'])->name('create');
        Route::post('store', [App\Http\Controllers\System\Ruangan\RuanganController::class, 'store'])->name('store');
        Route::get('edit/{id}', [App\Http\Controllers\System\Ruangan\RuanganController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [App\Http\Controllers\System\Ruangan\RuanganController::class, 'update'])->name('update');
        Route::post('destroy', [App\Http\Controllers\System\Ruangan\RuanganController::class, 'destroy'])->name('destroy');
        Route::post('importExcel', [App\Http\Controllers\System\Ruangan\RuanganController::class, 'importExcel'])->name('importExcel');
    });

    //jenis
    Route::prefix('jenis')->name('jenis.')->group(function () {
        Route::prefix('ruangan')->name('ruang.')->group(function () {
            Route::get('', [App\Http\Controllers\System\JenisSyarat\JenisRuanganController::class, 'index'])->name('index');
            Route::get('create', [App\Http\Controllers\System\JenisSyarat\JenisRuanganController::class, 'create'])->name('crate');
            Route::post('store', [App\Http\Controllers\System\JenisSyarat\JenisRuanganController::class, 'store'])->name('store');
            Route::get('edit/{id}', [App\Http\Controllers\System\JenisSyarat\JenisRuanganController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [App\Http\Controllers\System\JenisSyarat\JenisRuanganController::class, 'update'])->name('update');
            Route::post('destroy', [App\Http\Controllers\System\JenisSyarat\JenisRuanganController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('dp')->name('dp.')->group(function () {
            Route::get('', [App\Http\Controllers\System\JenisSyarat\JenisDpController::class, 'index'])->name('index');
            Route::get('create', [App\Http\Controllers\System\JenisSyarat\JenisDpController::class, 'create'])->name('crate');
            Route::post('store', [App\Http\Controllers\System\JenisSyarat\JenisDpController::class, 'store'])->name('store');
            Route::get('edit/{id}', [App\Http\Controllers\System\JenisSyarat\JenisDpController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [App\Http\Controllers\System\JenisSyarat\JenisDpController::class, 'update'])->name('update');
            Route::post('destroy', [App\Http\Controllers\System\JenisSyarat\JenisDpController::class, 'destroy'])->name('destroy');
        });
    });

    // syarat
    Route::prefix('syarat')->name('syarat.')->group(function () {
        Route::get('', [App\Http\Controllers\System\JenisSyarat\SyaratController::class, 'index'])->name('index');
        Route::prefix('ruangan')->name('ruang.')->group(function () {
            Route::get('', [App\Http\Controllers\System\JenisSyarat\SyaratJenisRuanganController::class, 'index'])->name('index');
            Route::get('create', [App\Http\Controllers\System\JenisSyarat\SyaratJenisRuanganController::class, 'create'])->name('crate');
            Route::post('store', [App\Http\Controllers\System\JenisSyarat\SyaratJenisRuanganController::class, 'store'])->name('store');
            Route::get('edit/{id}', [App\Http\Controllers\System\JenisSyarat\SyaratJenisRuanganController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [App\Http\Controllers\System\JenisSyarat\SyaratJenisRuanganController::class, 'update'])->name('update');
            Route::post('destroy', [App\Http\Controllers\System\JenisSyarat\SyaratJenisRuanganController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('dp')->name('dp.')->group(function () {
            Route::get('', [App\Http\Controllers\System\JenisSyarat\SyaratJenisDpController::class, 'index'])->name('index');
            Route::get('create', [App\Http\Controllers\System\JenisSyarat\SyaratJenisDpController::class, 'create'])->name('crate');
            Route::post('store', [App\Http\Controllers\System\JenisSyarat\SyaratJenisDpController::class, 'store'])->name('store');
            Route::get('edit/{id}', [App\Http\Controllers\System\JenisSyarat\SyaratJenisDpController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [App\Http\Controllers\System\JenisSyarat\SyaratJenisDpController::class, 'update'])->name('update');
            Route::post('destroy', [App\Http\Controllers\System\JenisSyarat\SyaratJenisDpController::class, 'destroy'])->name('destroy');
        });
    });

    //waktu
    Route::prefix('waktu')->name('waktu.')->group(function () {
        Route::get('', [App\Http\Controllers\System\WaktuUkur\WaktuPengukuranController::class, 'index'])->name('index');
        Route::post('store', [App\Http\Controllers\System\WaktuUkur\WaktuPengukuranController::class, 'store'])->name('store');
        Route::post('edit', [App\Http\Controllers\System\WaktuUkur\WaktuPengukuranController::class, 'edit'])->name('edit');
        Route::post('update', [App\Http\Controllers\System\WaktuUkur\WaktuPengukuranController::class, 'update'])->name('update');
        Route::post('destroy', [App\Http\Controllers\System\WaktuUkur\WaktuPengukuranController::class, 'destroy'])->name('destroy');
    });

    //user
    Route::prefix('users')->name('user.')->group(function () {
        //Outstading User
        Route::prefix('outstanding')->name('outstanding.')->group(function () {
            Route::get('', [App\Http\Controllers\System\User\UserOutstandingController::class, 'index'])->name('index');
            Route::get('getEmployee', [App\Http\Controllers\System\User\UserOutstandingController::class, 'hrisGetEmployee'])->name('getHrisEmployee');
            Route::post('store', [App\Http\Controllers\System\User\UserOutstandingController::class, 'store'])->name('store');
            Route::delete('{id}', [App\Http\Controllers\System\User\UserOutstandingController::class, 'destroy'])->name('destroy');
        });
        // Revisi user
        Route::prefix('revisi')->name('revisi.')->group(function () {
            Route::get('', [App\Http\Controllers\System\User\UserRevisiController::class, 'index'])->name('index');
            Route::get('getEmployee', [App\Http\Controllers\System\User\UserRevisiController::class, 'hrisGetEmployee'])->name('getHrisEmployee');
            Route::post('store', [App\Http\Controllers\System\User\UserRevisiController::class, 'store'])->name('store');
            Route::delete('{id}', [App\Http\Controllers\System\User\UserRevisiController::class, 'destroy'])->name('destroy');
        });
    });

    //Library
    Route::prefix('library')->name('library.')->group(function () {
        Route::prefix('document')->name('document.')->group(function () {
            Route::get('', [App\Http\Controllers\System\NomorDokumen\NomorDokumenController::class, 'index'])->name('index');
            Route::get('getDataTable', [App\Http\Controllers\System\NomorDokumen\NomorDokumenController::class, 'getTable'])->name('getDataTable');
            Route::get('create', [App\Http\Controllers\System\NomorDokumen\NomorDokumenController::class, 'create'])->name('create');
            Route::post('store', [App\Http\Controllers\System\NomorDokumen\NomorDokumenController::class, 'store'])->name('store');
            Route::get('edit/{id}', [App\Http\Controllers\System\NomorDokumen\NomorDokumenController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [App\Http\Controllers\System\NomorDokumen\NomorDokumenController::class, 'update'])->name('update');
            Route::post('destroy', [App\Http\Controllers\System\NomorDokumen\NomorDokumenController::class, 'destroy'])->name('destroy');
        });
    });

    //Setting
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('', [App\Http\Controllers\System\Settings\SettingsController::class, 'index'])->name('index');
        Route::post('store', [App\Http\Controllers\System\Settings\SettingsController::class, 'store'])->name('store');
    });
});