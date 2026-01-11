<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffMahasiswaController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Ensure roles exist
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'mahasiswa']);

        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('role:admin|staff|mahasiswa');
    Route::resource('staff', StaffController::class)->middleware('role:admin');
    Route::resource('projects', ProjectController::class)->middleware('role:admin|staff');
    Route::resource('mahasiswa', \App\Http\Controllers\Admin\MahasiswaController::class)->middleware('role:admin');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('role:admin');
    Route::get('/reports/project-status', [ReportController::class, 'projectStatus'])->name('reports.project-status')->middleware('role:admin');
    Route::get('/reports/staff-performance', [ReportController::class, 'staffPerformance'])->name('reports.staff-performance')->middleware('role:admin');
    Route::get('/staff/mahasiswa', [StaffMahasiswaController::class, 'index'])->name('staff.mahasiswa.index')->middleware('role:staff');
    Route::get('/staff/mahasiswa/{id}', [StaffMahasiswaController::class, 'show'])->name('staff.mahasiswa.show')->middleware('role:staff');
    Route::post('/staff/mahasiswa/{id}/approve', [StaffMahasiswaController::class, 'approveProject'])->name('staff.mahasiswa.approve')->middleware('role:staff');
    Route::post('/staff/mahasiswa/{id}/reject', [StaffMahasiswaController::class, 'rejectProject'])->name('staff.mahasiswa.reject')->middleware('role:staff');
});
