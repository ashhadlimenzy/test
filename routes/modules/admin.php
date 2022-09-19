<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function() {

    Auth::routes();
    Route::group(['middleware' => ['auth:admin']], function() {

        Route::get('/', 'HomeController@index')->name('home');

        // User
        Route::resource('user', 'UserController');
        Route::get('activeuser/{id}','UserController@activeuser');
        Route::get('inactiveuser/{id}','UserController@Inactiveuser');

        // Doctor
        Route::resource('doctor', 'DoctorController');
        Route::get('activedoctor/{id}','DoctorController@activedoctor');
        Route::get('inactivedoctor/{id}','DoctorController@Inactivedoctor');
        Route::post('/doctor/add-doctor-timeslot', 'DoctorController@addtimeslot')->name('add.timeslot');

        // Booking
        Route::resource('booking', 'BookingController');
        Route::get('confirm/appointment/{id}','BookingController@ConfirmAppointment');
        Route::get('reject/appointment/{id}','BookingController@RejectAppointment');

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
