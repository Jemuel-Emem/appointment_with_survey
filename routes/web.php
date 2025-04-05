<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\admin;
use App\Http\Middleware\doctor;
use App\Http\Middleware\midwife;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->is_admin == 1) {
            return redirect()->route('Admindashboard');
        }
        else if  (Auth::user()->is_admin == 2){
            return redirect()->route('Doctordashboard');
        }
        else {
            return redirect()->route('Midwifedashboard');
        }
    })->name('dashboard');
});


Route::prefix('admin')->middleware(['auth', admin::class])->group(function () {
    Route::get('/Admindashboard', function () {
        return view('admin.index');
    })->name('Admindashboard');

    Route::get('/admin.patients', function () {
        return view('admin.patients');
    })->name('admin.patients');

    Route::get('/admin.staffs', function () {
        return view('admin.staffs');
    })->name('admin.staffs');

    Route::get('/admin.survey', function () {
        return view('admin.survey');
    })->name('admin.survey');

    Route::get('/admin.resident', function () {
        return view('admin.resident');
    })->name('admin.resident');

    Route::get('/admin.appointments', function () {
        return view('admin.appointments');
    })->name('admin.appointments');




    // Route::post('/logout', function () {
    //     Auth::logout();
    //     return redirect('/login');
    // })->name('logouts');

});


Route::prefix('doctor')->middleware(['auth', doctor::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('doctor.index');
    })->name('Doctordashboard');

    Route::get('/appointment', function () {
        return view('doctor.appointment');
    })->name('doctor.appointment');

    Route::get('/docttor.patients', function () {
        return view('doctor.patients');
    })->name('doctor.patients');

    Route::get('/docttor.medical_record', function () {
        return view('doctor.medical_record');
    })->name('doctor.medical_record');


    // Route::post('/logout', function () {
    //     Auth::logout();
    //     return redirect('/login');
    // })->name('logout');

});

Route::prefix('midwife')->middleware(['auth', midwife::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('midwife.index');
    })->name('Midwifedashboard');

    Route::get('/midwife.add-pregnant', function () {
        return view('midwife.add-pregnant');
    })->name('midwife.add-pregnant');

    Route::get('/midwife.newborn', function () {
        return view('midwife.newborn');
    })->name('midwife.newborn');


    Route::get('/midwifepregnants-tracker', function () {
        return view('midwife.pregnants-tracker');
    })->name('midwifepregnats-tracker');


    // Route::post('/logout', function () {
    //     Auth::logout();
    //     return redirect('/login');
    // })->name('logout');

});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
require __DIR__.'/auth.php';
