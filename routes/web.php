<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/calendar', 'Admin\SystemCalendarController@index'); 
  
    Route::resource('profiles', 'Admin\ProfilesController');
    Route::resource('products', 'Admin\ProductsController');
    Route::resource('warranties', 'Admin\WarrantiesController');
    Route::resource('requestings', 'Admin\RequestingsController');
    Route::post('requestings_mass_destroy', ['uses' => 'Admin\RequestingsController@massDestroy', 'as' => 'requestings.mass_destroy']);
    Route::post('requestings_restore/{id}', ['uses' => 'Admin\RequestingsController@restore', 'as' => 'requestings.restore']);
    Route::delete('requestings_perma_del/{id}', ['uses' => 'Admin\RequestingsController@perma_del', 'as' => 'requestings.perma_del']);
    Route::resource('bookings', 'Admin\BookingsController');
    Route::post('bookings_mass_destroy', ['uses' => 'Admin\BookingsController@massDestroy', 'as' => 'bookings.mass_destroy']);
    Route::post('bookings_restore/{id}', ['uses' => 'Admin\BookingsController@restore', 'as' => 'bookings.restore']);
    Route::delete('bookings_perma_del/{id}', ['uses' => 'Admin\BookingsController@perma_del', 'as' => 'bookings.perma_del']);
    Route::resource('jobsheets', 'Admin\JobsheetsController');
    Route::post('jobsheets_mass_destroy', ['uses' => 'Admin\JobsheetsController@massDestroy', 'as' => 'jobsheets.mass_destroy']);
    Route::post('jobsheets_restore/{id}', ['uses' => 'Admin\JobsheetsController@restore', 'as' => 'jobsheets.restore']);
    Route::delete('jobsheets_perma_del/{id}', ['uses' => 'Admin\JobsheetsController@perma_del', 'as' => 'jobsheets.perma_del']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);


    Route::get('search', 'MegaSearchController@search')->name('mega-search');
});
