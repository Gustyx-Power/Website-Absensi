<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EmployeeManagement;
use App\Livewire\Admin\AttendanceReport;
use App\Livewire\Employee\CheckIn;
use App\Livewire\Employee\AttendanceHistory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes untuk Sistem Absensi Modern
| 
| Route Structure:
| - /login -> Landing page dengan tombol "Login dengan Google"
| - /auth/google -> Redirect ke Google OAuth
| - /auth/google/callback -> Handle callback dari Google (Role Lock mechanism)
| - /employee/* -> Routes untuk Employee (role: employee)
| - /admin/* -> Routes untuk Admin/HRD (role: admin, owner)
|
*/

// Landing Page (Login)
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->hasAdminAccess()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('employee.check-in');
    }
    return view('login');
})->name('login');

// Google OAuth Routes
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/logout', [SocialiteController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Employee Routes (Mobile-First)
|--------------------------------------------------------------------------
|
| Routes untuk karyawan (role: employee)
| - Check-In/Check-Out
| - Riwayat Absensi
| - Profil
|
*/
Route::middleware(['auth', 'role:employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/check-in', CheckIn::class)->name('check-in');
    Route::get('/history', AttendanceHistory::class)->name('history');
    Route::get('/profile', function () {
        return view('employee.profile');
    })->name('profile');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Desktop-Optimized)
|--------------------------------------------------------------------------
|
| Routes untuk admin dan owner (role: admin, owner)
| - Dashboard dengan charts
| - Employee Management
| - Attendance Reports & Export
|
*/
Route::middleware(['auth', 'role:admin,owner'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/employees', EmployeeManagement::class)->name('employees');
    Route::get('/reports', AttendanceReport::class)->name('reports');
});

/*
|--------------------------------------------------------------------------
| Owner-Only Routes (God Mode)
|--------------------------------------------------------------------------
|
| Routes khusus Owner (role: owner)
| - Admin Management (promote/demote admins)
| - Settings (koordinat kantor, radius, dll)
|
*/
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/admin-management', \App\Livewire\Owner\AdminManagement::class)->name('admin-management');
    Route::get('/settings', function () {
        return view('owner.settings');
    })->name('settings');
});
