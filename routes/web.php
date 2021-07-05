<?php

use RealRashid\SweetAlert\Facades\Alert;

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

// Route::get('/', function () {
    // return view('welcome');
    // toast('Your Post as been submited!','success');

//     return view('dashboard');
// })->middleware('auth');


Auth::routes();
Route::group(['middleware'=>'is-ban'], function(){
    Route::get('/', 'DashboardController@index');
    Route::resource('user-management', 'UserManagementController');
    Route::get('user-management/edit/{id}', 'UserManagementController@edit')->name('user-management.edit');
    Route::patch('user-management/update/{id}', 'UserManagementController@update')->name('user-management.update');
    Route::get('user-management/delete/{id}', 'UserManagementController@destroy')->name('user-management.destroy');
    Route::get('userUserRevoke/{id}', array('as'=> 'user-management.revokeuser', 'uses' => 'UserManagementController@revoke'));
    Route::post('userBan', array('as'=> 'user-management.ban', 'uses' => 'UserManagementController@ban'));
    });



// Route::get('/home', 'HomeController@index')->name('home');
// Route::post('logout', 'HomeController@logout');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/profile', 'ProfileController@index')->name('profile');


Route::get('contact-us', 'ContactController@getContact')->name('contact-us');
Route::post('contact-us', 'ContactController@saveContact')->name('contact-us');

Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
// Route::resource('user-management', 'UserManagementController');
// Route::get('user-management/edit/{id}', 'UserManagementController@edit')->name('user-management.edit');
// Route::patch('user-management/update/{id}', 'UserManagementController@update')->name('user-management.update');
// Route::get('user-management/delete/{id}', 'UserManagementController@destroy')->name('user-management.destroy');

Route::post('company-management/search', 'CompanyManagementController@search')->name('company-management.search');
Route::resource('company-management', 'CompanyManagementController');
Route::get('company-management/delete/{id}', 'CompanyManagementController@destroy')->name('company-management.destroy');

Route::get('social-login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social-login.redirect');
Route::get('social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social-login.callback');

// Route::resource('employee-management', 'EmployeeManagementController');
Route::get('employee-management', 'EmployeeManagementController@index')->name('employee-management');
Route::get('employee-management/create', 'EmployeeManagementController@create')->name('employee-management.create');


Route::get('employee-management/edit/{id}', 'EmployeeManagementController@edit')->name('employee-management.edit');
Route::get('employee-management/show/{id}', 'EmployeeManagementController@show')->name('employee-management.show');

Route::put('employee-management/update/{id}', 'EmployeeManagementController@update')->name('employee-management.update');
Route::post('employee-management/store', 'EmployeeManagementController@uploadEmployee')->name('employee-management.store');

Route::get('employee-management/delete/{id}', 'EmployeeManagementController@destroy')->name('employee-management.destroy');


Route::post('employee-management/search', 'EmployeeManagementController@search')->name('employee-management.search');

Route::resource('system-management/department', 'DepartmentController');
Route::get('system-management/department/edit/{id}', 'DepartmentController@edit')->name('department.edit');
Route::put('system-management/department/update/{id}', 'DepartmentController@update')->name('department.update');
Route::get('system-management/department/delete/{id}', 'DepartmentController@destroy')->name('department.destroy');
Route::post('system-management/department/search', 'DepartmentController@search')->name('department.search');

Route::resource('system-management/division', 'DivisionController');
Route::get('system-management/division/edit/{id}', 'DivisionController@edit')->name('division.edit');
Route::patch('system-management/division/update/{id}', 'DivisionController@update')->name('division.update');
Route::get('system-management/division/delete/{id}', 'DivisionController@destroy')->name('division.destroy');
Route::post('system-management/division/search', 'DivisionController@search')->name('division.search');

Route::resource('system-management/country', 'CountryController');
Route::get('system-management/country/edit/{id}', 'CountryController@edit')->name('country.edit');
Route::put('system-management/country/update/{id}', 'CountryController@update')->name('country.update');
Route::get('system-management/country/delete/{id}', 'CountryController@destroy')->name('country.destroy');
Route::post('system-management/country/search', 'CountryController@search')->name('country.search');

Route::resource('system-management/state', 'StateController');
Route::get('system-management/state/edit/{id}', 'StateController@edit')->name('state.edit');
Route::put('system-management/state/update/{id}', 'StateController@update')->name('state.update');
Route::get('system-management/state/delete/{id}', 'StateController@destroy')->name('state.destroy');
Route::post('system-management/state/search', 'StateController@search')->name('state.search');

Route::resource('system-management/city', 'CityController');
Route::get('system-management/city/edit/{id}', 'CityController@edit')->name('city.edit');
Route::put('system-management/city/update/{id}', 'CityController@update')->name('city.update');
Route::get('system-management/city/delete/{id}', 'CityController@destroy')->name('city.destroy');
Route::post('system-management/city/search', 'CityController@search')->name('city.search');

// Route::resource('system-management/salary', 'SalaryController');
Route::get('salary',               [ 'as'=>'salary',              'uses' => 'SalaryController@index']);
Route::get('salary/create',        [ 'as'=>'salary.create',       'uses' => 'SalaryController@create']);
Route::post('salary/store',        [ 'as'=>'salary.store',        'uses' => 'SalaryController@store']);
Route::get('salary/edit/{id}',     [ 'as'=>'salary.edit',         'uses' => 'SalaryController@edit']);
Route::put('salary/update/{id}',  [ 'as'=>'salary.update',       'uses' => 'SalaryController@update']);
Route::get('salary/delete/{id}',   [ 'as'=>'salary.delete',       'uses' => 'SalaryController@delete']);

Route::get('system-management/report', 'ReportController@index');
Route::post('system-management/report/search', 'ReportController@search')->name('report.search');
Route::get('system-management/report/excel', 'ReportController@exportExcel')->name('report.excel');
Route::post('system-management/report/pdf', 'ReportController@exportPDF')->name('report.pdf');
// Route::get('users/export/', 'UsersController@export');

Route::get('designation',               [ 'as'=>'designation',              'uses' => 'DesignationController@index']);
Route::get('designation/create',        [ 'as'=>'designation.create',       'uses' => 'DesignationController@create']);
Route::post('designation/store',        [ 'as'=>'designation.store',        'uses' => 'DesignationController@store']);
Route::get('designation/edit/{id}',     [ 'as'=>'designation.edit',         'uses' => 'DesignationController@edit']);
Route::put('designation/update/{id}',  [ 'as'=>'designation.update',       'uses' => 'DesignationController@update']);
Route::get('designation/delete/{id}',   [ 'as'=>'designation.delete',       'uses' => 'DesignationController@delete']);
Route::post('designation/search',   [ 'as'=>'designation.search',       'uses' => 'DesignationController@search']);



Route::get('leave',               [ 'as'=>'leave',              'uses' => 'LeaveController@index']);
Route::get('leave/create',        [ 'as'=>'leave.create',       'uses' => 'LeaveController@create']);
Route::post('leave/store',        [ 'as'=>'leave.store',        'uses' => 'LeaveController@store']);
Route::get('leave/search',       [ 'as'=>'leave.search',      'uses' => 'LeaveController@search']);

//    Route::get('leave/edit/{id}',     [ 'as'=>'leave.edit',         'uses' => 'LeaveController@edit']);
//    Route::post('leave/update/{id}',  [ 'as'=>'leave.update',       'uses' => 'LeaveController@update']);
//    Route::get('leave/delete/{id}',   [ 'as'=>'leave.delete',       'uses' => 'LeaveController@delete']);
Route::post('leave/approve/{id}',        [ 'as'=>'leave.approve',        'uses' => 'LeaveController@approve']);
Route::post('leave/paid/{id}',        [ 'as'=>'leave.paid',        'uses' => 'LeaveController@paid']);
Route::post('leave/unpaid/{id}',        [ 'as'=>'leave.unpaid',        'uses' => 'LeaveController@unpaid']);
//    Route::post('leave/pending/{id}',        [ 'as'=>'leave.pending',        'uses' => 'LeaveController@pending']);
   Route::post('leave/reject/{id}',        [ 'as'=>'leave.reject',        'uses' => 'LeaveController@reject']);

Route::get('total-leave',               [ 'as'=>'total-leave',              'uses' => 'TotalLeaveController@index']);
Route::get('total-leave/create',        [ 'as'=>'total-leave.create',       'uses' => 'TotalLeaveController@create']);
Route::post('total-leave/store',        [ 'as'=>'total-leave.store',        'uses' => 'TotalLeaveController@store']);
Route::get('total-leave/edit/{id}',     [ 'as'=>'total-leave.edit',         'uses' => 'TotalLeaveController@edit']);
Route::post('total-leave/update/{id}',  [ 'as'=>'total-leave.update',       'uses' => 'TotalLeaveController@update']);
Route::get('total-leave/delete/{id}',   [ 'as'=>'total-leave.delete',       'uses' => 'TotalLeaveController@delete']);


Route::get('managesalary',                    [ 'as'=>'managesalary',                   'uses' => 'ManagesalaryController@index']);

// Route::get('staff-salary/{id}', 'ManagesalaryController@yahoo')->name('staff-salary');
Route::get('manage-salary/detail/{id}',        [ 'as'=>'manage-salary.detail',           'uses' => 'ManagesalaryController@detail']);
Route::post('managesalary/store',             [ 'as'=>'managesalary.store',           'uses' => 'ManagesalaryController@store']);
Route::get('managesalary/salarylist',         [ 'as'=>'managesalary.salarylist',           'uses' => 'ManagesalaryController@salarylist']);
Route::get('managesalary/makepayment/{id}',        [ 'as'=>'managesalary.makepayment',               'uses' => 'ManagesalaryController@makepayment']);
Route::post('managesalary/make-advance',      [ 'as'=>'managesalary.makeadvance',               'uses' => 'ManagesalaryController@makeAdvance']);
// Route::post('managesalary/search',            [ 'as'=>'managesalary.search',               'uses' => 'ManagesalaryController@search']);


Route::get('event', ['as'=>'event', 'uses' => 'EventController@event']);
Route::post('event/store', ['as'=>'event.store', 'uses' => 'EventController@store']);

Route::post('/notify/users', 'NotifyController@notifyUsers');

Route::post('mailbox/sendMail', 'MailController@sendMail')->name('mailbox.sendMail');
// Route::post('mailbox/sendMail', function () {

//     return('Your Post as been submited!');

// });
// Route::get('mailbox/compose/{id}', 'MailController@compose')->name('mailbox.compose');
Route::get('mailbox/compose', 'MailController@compose')->name('mailbox.compose');
// Route::get('mailbox/compose', 'MailController@bulkCompose')->name('mailbox.compose');;
Route::get('mailbox/read-mail', 'MailController@readMail');

Route::post('/send-sms', [
    'uses'   =>  'SmsController@getUserNumber',
    'as'     =>  'sendSms'
 ]);


Route::get('avatars/{name}', 'EmployeeManagementController@load');
