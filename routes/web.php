<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\AccountingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

Route::get('/members', [MemberController::class, 'all']);

// Get All Packages
Route::get('/packages', [PackageController::class, 'index'])->name('index');

// Get all measurements
Route::get('/measurements', [MeasurementController::class,'all'])->name('all');

// Get measurement by member_id
Route::get('/measurements/{memberId}', [MeasurementController::class,'getMeasurementsByMemberId'])->name('getMeasurementsByMemberId');

// Get all accounting transactions
Route::get('/accounting', [AccountingController::class, 'index'])->name('index');

// Settings page
Route::get('/settings', function () {
    if (!Auth::check()) {
        return redirect('login');
    }
    return view('settings');
});

// Add a member
Route::get('/member/add', [MemberController::class, 'index'])->name('index');

// Delete package by id
Route::get('/package/del/{id}', [PackageController::class, 'delete'])->name('delete');

// Delete member by id
Route::get('/member/delete/{id}', [MemberController::class, 'delete'])->name('delete');

// Delete member by id
Route::get('/membership/cancel/{id}', [MemberController::class, 'cancel'])->name('cancel');

// Delete member by id
Route::get('/measurement/del/{id}', [MeasurementController::class, 'delete'])->name('delete');

// Delete member by id
Route::get('/transaction/del/{id}', [AccountingController::class, 'delete'])->name('delete');

// Freeze member by id
Route::get('/member/freeze/{memberId}', [MemberController::class, 'freeze'])->name('freeze');

// Unfreeze member by id
Route::get('/member/unfreeze/{memberId}', [MemberController::class, 'unfreeze'])->name('unfreeze');

// Add a new package
Route::get('/package/add', function () {
    if (!Auth::check()) {
        return redirect('login');
    }
    return view('addpackage');
});

// Add a new measurement
Route::get('/measurement/add', [MeasurementController::class, 'index'])->name('index');

// Add a new measurement
Route::get('/measurement/add/{memberId}', [MeasurementController::class, 'getMemberForAddMemberMeasurement'])->name('addmembermeasurement');

// Get package by id
Route::get('/package/{id}', [PackageController::class, 'getPackage'])->name('getPackage');

// Get member by id
Route::get('/member/edit/{id}', [MemberController::class, 'getMember'])->name('getMember');

// Get measurement by id
Route::get('/measurement/{measurementId}', [MeasurementController::class, 'getMeasurement'])->name('getMeasurement');

// Add a new package
Route::post('/package/add', [PackageController::class, 'add'])->name('add-package');

// Add a new member
Route::post('/member/add', [MemberController::class, 'add'])->name('add-member');

// Add a measurement
Route::post('/measurement/add', [MeasurementController::class, 'add'])->name('add-measurement');

// Add a measurement
Route::post('/measurement/add/{memberId}', [MeasurementController::class, 'addMeasurementByMemberId'])->name('add-measurement-by-member-id');

// Edit package by id
Route::post('/package/{id}', [PackageController::class, 'update'])->name('update-package');

// Edit member by id
Route::post('/member/edit/{id}', [MemberController::class, 'update'])->name('update-member');

// Edit measurement by id
Route::post('/measurement/{measurementId}', [MeasurementController::class, 'update'])->name('update-measurement');

// Admin Authentication
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');

Route::post('/settings/changepassword', [AdminUserController::class, 'changePassword'])->name('change-password');

// // Get All Members
// Route::post('/member/all', [MemberController::class, 'all'])->name('all');
