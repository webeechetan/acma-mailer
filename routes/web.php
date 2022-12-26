<?php

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

Route::get('/test',function(){
    $body = "<a href='https://acma.in'>test mail</a>";
    \Mail::to('chetan.singh@webeesocial.com')->send(new \App\Mail\TestMail($body));
});

Route::get('/', 'LoginController@index');
Route::post('/', 'LoginController@login');
Route::get('/forget-password','LoginController@forget_password_view')->name('forget_password.view');
Route::post('/forget-password','LoginController@forget_password')->name('forget_password.post');
Route::get('/reset-password/{otp}/{email}','LoginController@reset_password_view')->name('reset_password_view');
Route::post('/reset-password','LoginController@reset_password')->name('reset_password');
Route::get('/authentication', 'LoginController@OTPAuthentication');
Route::post('/authentication', 'LoginController@OTPVerification');
Route::get('/logout', 'LoginController@logout');

Route::group(['middleware' => 'admin'], function () {

    Route::get('/compose/{id?}', 'SentboxController@compose')->name('compose');
    Route::post('/sendEmail', 'SentboxController@sendEmail');
    Route::get('/sentbox', 'SentboxController@index');
    Route::get('/mail/{id}', 'SentboxController@mailDetail');
    // Route::get('/test', 'SentboxController@test');

    Route::get('/groups', 'GroupsController@index');
    Route::get('/create-group', 'GroupsController@create');
    Route::post('/create-group', 'GroupsController@create');
    Route::get('/edit-group/{id}', 'GroupsController@edit');
    Route::post('/save-group/{id}', 'GroupsController@save');
    Route::get('/delete-group/{id}', 'GroupsController@delete');

    Route::get('/group-members', 'GroupMembersController@index');
    Route::get('/create-group-member', 'GroupMembersController@create');
    Route::post('/create-group-member', 'GroupMembersController@create');
    Route::get('/edit-group-member/{id}', 'GroupMembersController@edit');
    Route::post('/save-group-member/{id}', 'GroupMembersController@save');
    Route::get('/delete-group-member/{id}', 'GroupMembersController@delete');

    Route::get('/group-users', 'GroupUsersController@index');
    Route::get('/create-group-user', 'GroupUsersController@create');
    Route::post('/create-group-user', 'GroupUsersController@create');
    Route::get('/import-group-user', 'GroupUsersController@import');
    Route::post('/import-group-user', 'GroupUsersController@import');
    Route::post('/get-group-users', 'GroupUsersController@getGroupUsers');
    Route::get('/edit-group-user/{id}', 'GroupUsersController@edit');
    Route::post('/save-group-user/{id}', 'GroupUsersController@save');
    Route::get('/delete-group-user/{id}', 'GroupUsersController@delete');
    Route::get('/export-group-user', 'GroupUsersController@exportCSV');
});


/*
Test Mails
*/
/*
Route::get('sendemail', function () {

    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message) {

        $message->from('help@segunlife.com', 'Learning Laravel');

        $message->to('nidhi.chaudhary@armworldwide.com')->subject('Learning Laravel test email');

    });

    return "Your email has been sent successfully";

});
*/

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
