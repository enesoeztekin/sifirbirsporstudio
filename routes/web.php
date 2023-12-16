<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;

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

// Add a member
Route::get('/member/add', [MemberController::class, 'index'])->name('index');

// Get All Packages
Route::get('/packages', [PackageController::class, 'index'])->name('index');

// Delete package by id
Route::get('/package/del/{id}', [PackageController::class, 'delete'])->name('delete');

// Delete member by id
Route::get('/member/delete/{id}', [MemberController::class, 'delete'])->name('delete');

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

// Get package by id
Route::get('/package/{id}', [PackageController::class, 'getPackage'])->name('getPackage');

// Settings page
Route::get('/settings', function () {
    if (!Auth::check()) {
        return redirect('login');
    }
    return view('settings');
});

// Add a new package
Route::post('/package/add', [PackageController::class, 'add'])->name('add-package');

// Add a new member
Route::post('/member/add', [MemberController::class, 'add'])->name('add-member');

// Edit package by id
Route::post('/package/{id}', [PackageController::class, 'update'])->name('update-package');

// Admin Authentication
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');

// // Get All Members
// Route::post('/member/all', [MemberController::class, 'all'])->name('all');
