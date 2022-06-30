<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Settings;

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

Route::get('/logout', function () {
    
    Auth::logout();

    return redirect()->route('home');

});

Route::get('/maintenance', function() {

    return view('Maintenance');

})->name('maintenance');

Auth::routes();

Route::controller(HomeController::class)->group(function() {

    Route::get('/', 'index');
    Route::get('/home', 'index')->name('home');
    Route::get('/chek-whatsapp-number/{wa}', 'chekWaNumber')->name('chekWaNumber');
    Route::get('/check-email/{email}', 'checkEmail')->name('checkEmail');
    Route::post('/save-new-member', 'saveNewMember')->name('saveNewMember');
    Route::post('/resend-new-member-notification', 'resendLink')->name('resendLink');
    Route::get('/count-down-timer', 'countDownTimer')->name('countDownTimer');
    Route::get('/register-end-at', 'registerEndAt')->name('registerEndAt');

});

Route::group(['middleware' => ['auth', 'verified']], function() {

    Route::controller(AdminController::class)->group( function() {

        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/website-settings', 'websiteSettings')->name('websiteSettings');
        Route::post('/save-website-settings', 'saveWebsiteSettings')->name('saveWebsiteSettings');

    });

});

Route::get('/date-jascript', function() {

    return date('M d, Y H:i:s');

});

Route::get('/format-date', function() {

    $settings = Settings::orderBy('created_at', 'ASC')->first();

    return $data = [
        'no_formated' => $settings->register_end_at,
        'formated' => date('d F Y, H:i:s', strtotime($settings->register_end_at)),
        'date_now' => date('d F Y, H:i:s'),
        'binding' => date('d F Y, H:i:s') < date('d F Y, H:i:s', strtotime($settings->register_end_at))
    ];

});