<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Models\User;

// Welcome Page
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', function () {

    $customersCount = Customer::count();
    $usersCount = User::count();

    return view('dashboard', compact(
        'customersCount',
        'usersCount'
    ));

})->middleware(['auth', 'verified'])->name('dashboard');

// Customer Resource Routes
Route::resource('customers', CustomerController::class)
    ->middleware('auth');

// User Resource Routes
Route::resource('users', UserController::class)
    ->middleware('auth');

// Protected Profile Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

// Authentication Routes
require __DIR__.'/auth.php';
