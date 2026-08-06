<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserVerificationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Provider\ProviderProfileController;
use App\Http\Controllers\Provider\ProviderRequestController;
use App\Http\Controllers\Seeker\SeekerProfileController;
use App\Http\Controllers\Seeker\SeekerServiceRequestController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Provider\ProviderServiceController;
use App\Http\Controllers\Seeker\BrowseProviderController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| GOOGLE AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/auth/google',          [AuthController::class, 'googleRedirect'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('auth.google.callback');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// LOGIN PAGE
Route::get('/login', [AuthController::class, 'LoginScreen'])
    ->name('login');

// LOGIN FUNCTION
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// REGISTER PAGE
Route::get('/register', [AuthController::class, 'RegisterScreen'])
    ->name('auth.register');

// REGISTER FUNCTION
Route::post('/register/store', [AuthController::class, 'Register'])
    ->name('register.store');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    Route::middleware(['auth'])->prefix('admin')->group(function () {

        Route::get('/users', [UserVerificationController::class, 'index'])->name('admin.users');
        Route::get('/users/{id}', [UserVerificationController::class, 'show'])->name('admin.users.show');
        Route::post('/users/{id}/verify', [UserVerificationController::class, 'verify'])->name('admin.users.verify');
        Route::post('/users/{id}/unverify', [UserVerificationController::class, 'unverify'])->name('admin.users.unverify');
    });

    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/update/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/delete/{id}', [ServiceController::class, 'destroy'])->name('services.delete');

    // PROFILE PAGE
    Route::get('/profile', [SeekerProfileController::class, 'index'])->name('seeker.profile');
    // STORE / UPDATE PROFILE
    Route::post('/profile/store', [SeekerProfileController::class, 'store'])->name('seeker.profile.store');

    Route::get('/seeker/requests/index', [SeekerServiceRequestController::class, 'index'])->name('seeker.requests');
    Route::get('/seeker/services', [SeekerServiceRequestController::class, 'create'])->name('seeker.services.create');
    Route::post('/seeker/services/request', [SeekerServiceRequestController::class, 'store'])->name('seeker.services.request');

    /*
    |--------------------------------------------------------------------------
    | PROVIDER PROFILE ROUTES
    |--------------------------------------------------------------------------
    */

    Route::prefix('provider')->name('provider.')->group(function () {

        // PROFILE PAGE
        Route::get('/profile', [ProviderProfileController::class, 'index'])->name('profile');
        // STORE / UPDATE PROFILE
        Route::post('/profile/store', [ProviderProfileController::class, 'store'])->name('profile.store');

        Route::get('/requests', [ProviderRequestController::class, 'index'])->name('requests');
        Route::get('/requests/{id}', [ProviderRequestController::class, 'show'])->name('requests.show');
        Route::post('/requests/{id}/status', [ProviderRequestController::class, 'updateStatus'])->name('requests.status');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAT ROUTES — Seeker ↔ Provider Real-Time Chat (WebSocket / Reverb)
    |--------------------------------------------------------------------------
    */

    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/booking/{booking}',        [ChatController::class, 'bookingChat'])->name('booking');
        Route::post('/booking/{booking}/send',  [ChatController::class, 'sendMessage'])->name('booking.send');
        Route::get('/booking/{booking}/poll',   [ChatController::class, 'pollMessages'])->name('booking.poll');
    });

    /*
    |--------------------------------------------------------------------------
    | PROVIDER MY SERVICES — Provider apni services manage kare
    |--------------------------------------------------------------------------
    */
    Route::prefix('provider')->name('provider.')->group(function () {
        Route::get('/my-services',         [ProviderServiceController::class, 'index']) ->name('services.index');
        Route::post('/my-services/store',  [ProviderServiceController::class, 'store']) ->name('services.store');
        Route::delete('/my-services/{id}', [ProviderServiceController::class, 'destroy'])->name('services.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | SEEKER BROWSE PROVIDERS — Seeker providers dhundhein
    |--------------------------------------------------------------------------
    */
    Route::get('/seeker/providers', [BrowseProviderController::class, 'index'])->name('seeker.providers');
});

/*
|--------------------------------------------------------------------------
| BROADCASTING AUTH — Private WebSocket channels ke liye
|--------------------------------------------------------------------------
*/
Broadcast::routes(['middleware' => ['web', 'auth']]);
require base_path('routes/channels.php');