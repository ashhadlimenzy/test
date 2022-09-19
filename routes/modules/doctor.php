<?php
/*
|--------------------------------------------------------------------------
| Doctor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'doctor', 'namespace' => 'Doctor','as' => 'doctor.'], function() {

    // User Dashboard pages
    Auth::routes();
    Route::group(['middleware' => ['auth:doctor']], function() {

        Route::get('/', 'HomeController@index')->name('home');

        // User
        Route::resource('user', 'UserController');

        // Booking
        Route::resource('booking', 'BookingController');
        Route::get('visited/appointment/{id}','BookingController@VisitedAppointment');
        Route::get('notvisited/appointment/{id}','BookingController@NotVisitedAppointment');

        // Available-Appointment
        Route::resource('available-appointment', 'AppointmentController');

        //Profile
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', 'ProfileController@index')->name('index');
            Route::put('/update', 'ProfileController@update')->name('update');
            Route::get('/change-password', 'ProfileController@viewChangePassword')->name('change-password');
            Route::put('/update-password', 'ProfileController@updatePassword')->name('update-password');
            Route::put('/profile/update-image', 'ProfileController@updateImage')->name('update-image');
        });

    });
});
