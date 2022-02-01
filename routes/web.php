<?php

use App\Http\Controllers\Admin\CompatibilityController;
use App\Http\Controllers\Admin\GrabberController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Automation\DataGrabberController;
use App\Http\Controllers\Automation\DataTranslatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('locale/{locale}', LocalizationController::class)->name('locale');

Route::get('/privacy-policy', [SiteController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-use', [SiteController::class, 'terms'])->name('terms');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::view('/contact', 'visitor.site.contact')->name('contact');
Route::put('/contact', [SiteController::class, 'contact'])->name('contact.post')->middleware('throttle:contact');

Route::get('/names', [HomeController::class, 'names'])->name('names');
Route::get('/search-names', [HomeController::class, 'search'])->name('name.search');
Route::get('/name/{translation}/show', [HomeController::class, 'showById'])->name('name.show-by-id');
Route::get('/names/{link}', [HomeController::class, 'showByLink'])->name('name.show-by-link');
Route::get('/compatibility/{first}/{second}', [HomeController::class, 'compatibility'])->name('name.compatibility');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::get('/change-password', [UserProfileController::class, 'showChangePasswordForm'])->name('change-password');
        Route::put('/change-password', [UserProfileController::class, 'changePassword'])->name('change-password.update');
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::view('/', 'admin.index')->name('index');
        Route::get('/messages', [MessageController::class, 'index'])->name('messages');
        Route::get('/messages/{message}/', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}/destroy', [MessageController::class, 'destroy'])->name('messages.destroy');
        Route::get('/messages/mark-all/as-read', [MessageController::class, 'markAllAsRead'])->name('messages.mark-all-as-read');
        Route::resource('settings', SettingController::class)->except(['create', 'store', 'destroy']);
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('grabbers', GrabberController::class)->only(['index', 'edit', 'update', 'destroy']);
        Route::get('/get/names', [TranslationController::class, 'getNames'])->name('translations.get-names');
        Route::resource('translations', TranslationController::class)->only(['index', 'edit', 'update', 'destroy']);
        Route::get('/compatibilities', [CompatibilityController::class, 'index'])->name('compatibilities.index');
        Route::post('/compatibilities', [CompatibilityController::class, 'store'])->name('compatibilities.store');
        Route::get('/compatibilities/{first}/{second}', [CompatibilityController::class, 'show'])->name('compatibilities.show');
        Route::get('/compatibilities/{first}/{second}/edit', [CompatibilityController::class, 'edit'])->name('compatibilities.edit');
        Route::put('/compatibilities/{first}/{second}', [CompatibilityController::class, 'update'])->name('compatibilities.update');
        Route::delete('/compatibilities/{first}/{second}', [CompatibilityController::class, 'destroy'])->name('compatibilities.destroy');

        // Route::get('translate', DataTranslatorController::class);
        // Route::get('/grab', DataGrabberController::class);
    });
});
