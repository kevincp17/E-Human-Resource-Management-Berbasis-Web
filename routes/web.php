<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageUploadController;

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
Route::get('/index_main', 'App\Http\Controllers\UserController@index')->name('home');
Route::get('/', 'App\Http\Controllers\UserController@indexPelamar')->name('user.loginApplicant');
Route::get('/index_company', 'App\Http\Controllers\UserController@indexPerusahaan')->name('user.loginCompany');

Route::get('/career_details', function () {
    return view('career_details');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/registrasi', 'App\Http\Controllers\UserController@indexRegPelamar');
Route::post('/dependent-dropdownKab', 'App\Http\Controllers\DependentDropdownController@indexKabupaten')->name('dependent-dropdown.kabupaten');
Route::post('/dependent-dropdownKec', 'App\Http\Controllers\DependentDropdownController@indexKecamatan')->name('dependent-dropdown.kecamatan');
Route::post('/dependent-dropdownKel', 'App\Http\Controllers\DependentDropdownController@indexKelurahan')->name('dependent-dropdown.kelurahan');
Route::get('/registrasi_company', 'App\Http\Controllers\UserController@indexRegPerusahaan');

//Route::post('/login_applicant','App\Http\Controllers\UserController@loginApplicant');
//Route::post('/login_company','App\Http\Controllers\UserController@loginCompany');
Route::post('/registrasi_user','App\Http\Controllers\UserController@registrasiUser');
Route::post('/registrasi_company','App\Http\Controllers\UserController@registrasiCompany');
Route::post('/loginApplicant/validate','App\Http\Controllers\UserController@validateLoginApplicant');
Route::post('/loginCompany/validate','App\Http\Controllers\UserController@validateLoginCompany');
Route::get('/userApplicant/verify/{token}','App\Http\Controllers\UserController@verifyEmailApplicant');
Route::get('/userCompany/verify/{token}','App\Http\Controllers\UserController@verifyEmailApplicant');

Route::get('/logout','App\Http\Controllers\UserController@logout')->name('logout');

Route::get('/career_add', function () {
    return view('career_add');
});

Route::get('/profile_applicant', function () {
    return view('profile_applicant');
});
Route::get('/profile_applicant','App\Http\Controllers\ProfileController@index');
Route::get('/profile_company','App\Http\Controllers\ProfileController@index_company');
Route::get('/post_overview','App\Http\Controllers\ProfileController@overviewEdit');
Route::get('/applied_detail/{id}','App\Http\Controllers\ProfileController@show_profile');
Route::post('/post_overview','App\Http\Controllers\ProfileController@storeOverview');
Route::get('/accept/{id}/{jobid}/{jobap}','App\Http\Controllers\ProfileMatchController@index');
Route::get('/interview/{id}/{jobid}','App\Http\Controllers\JobApplyController@interview');
Route::post('/change_date','App\Http\Controllers\JobApplyController@changeInterview');
Route::get('/decline_int/{id}/{jobid}/{jobap}','App\Http\Controllers\JobApplyController@declineInterview');

Route::get('/company_credit', 'App\Http\Controllers\TransactionController@index');
Route::get('/admin_credit', 'App\Http\Controllers\TransactionController@index_paket');
Route::get('/get_package/{id}', 'App\Http\Controllers\TransactionController@getPackage');
Route::get('/admin_transaction', 'App\Http\Controllers\TransactionController@index_admin');
Route::post('/admin_transaction/searchTransaction', 'App\Http\Controllers\TransactionController@searchTransaction');
Route::get('/company_transaction', 'App\Http\Controllers\TransactionController@index_company');
Route::post('/buy_credit', 'App\Http\Controllers\TransactionController@store');
Route::get('/harga_edit', 'App\Http\Controllers\TransactionController@edit');
Route::post('/update_harga', 'App\Http\Controllers\TransactionController@update');
Route::get('/verify_sub/{id}', 'App\Http\Controllers\TransactionController@verifySub');
Route::get('/cancel_sub/{id}', 'App\Http\Controllers\TransactionController@cancelSub');
Route::post('/filter_transaction','App\Http\Controllers\JobController@filterCareer');


Route::get('/company_list', 'App\Http\Controllers\CompanyController@index');
Route::get('/search_company','App\Http\Controllers\CompanyController@searchCompany');
Route::post('/filter_company','App\Http\Controllers\CompanyController@filterCompany');

Route::get('/education_form', 'App\Http\Controllers\EducationController@indexFakultas');
Route::post('/education_user','App\Http\Controllers\EducationController@store');
Route::get('/education_delete/{id}','App\Http\Controllers\EducationController@destroy');
Route::post('/dependent-dropdownJur', 'App\Http\Controllers\DependentDropdownController@indexJurusan')->name('dependent-dropdown.jurusan');


Route::get('/skill_form', function () {
    return view('skill_form');
});
Route::post('/skill_user','App\Http\Controllers\SkillController@store');
Route::get('/skill_delete/{id}','App\Http\Controllers\SkillController@destroy');

Route::get('/bahasa_form', function () {
    return view('bahasa_form');
});
Route::post('/bahasa_user','App\Http\Controllers\BahasaController@store');
Route::get('/bahasa_delete/{id}','App\Http\Controllers\BahasaController@destroy');

Route::get('/experience_form', 'App\Http\Controllers\ExperienceController@index');
Route::post('/experience_user','App\Http\Controllers\ExperienceController@store');
Route::get('/experience_delete/{id}','App\Http\Controllers\ExperienceController@destroy');

Route::get('/applied_job','App\Http\Controllers\JobApplyController@index');
Route::post('/insert_apply','App\Http\Controllers\JobApplyController@store');
Route::post('/accept_job','App\Http\Controllers\JobApplyController@accept_apply');
Route::get('/decline_job/{id}/{jobid}/{jobap}','App\Http\Controllers\JobApplyController@decline_apply');

Route::get('/insert_ktp','App\Http\Controllers\ProfileController@ktpUpload');
Route::post('/insert_ktp','App\Http\Controllers\ProfileController@ktpUploadPost');
Route::get('/display_ktp/{ktp}','App\Http\Controllers\ProfileController@displayKTP');

Route::get('/insert_cv','App\Http\Controllers\ProfileController@cvUpload');
Route::post('/insert_cv','App\Http\Controllers\ProfileController@cvUploadPost');
Route::get('/display_cv/{cv}','App\Http\Controllers\ProfileController@displayCV');

Route::get('/insert_sular','App\Http\Controllers\ProfileController@sularUpload');
Route::post('/insert_sular','App\Http\Controllers\ProfileController@sularUploadPost');
Route::get('/display_sular/{sular}','App\Http\Controllers\JobApplyController@displaySular');

Route::get('/display_siup/{siup}','App\Http\Controllers\CompanyController@displaySIUP');

Route::get('/career_list','App\Http\Controllers\JobController@index');
Route::post('/add_career','App\Http\Controllers\JobController@store');
Route::get('/career_apply/{id}/{comid}','App\Http\Controllers\JobController@getApplyJob');
Route::post('/career_apply/post','App\Http\Controllers\JobController@createApplyJob');
Route::get('/career_details/{id}','App\Http\Controllers\JobController@getOneJobDetail');
Route::get('/career_edit/{id}','App\Http\Controllers\JobController@edit');
Route::post('/update_career','App\Http\Controllers\JobController@update');
Route::get('/search_career','App\Http\Controllers\JobController@searchCareer');
Route::get('/search_career2','App\Http\Controllers\JobController@searchCareerKota');
Route::post('/filter_career','App\Http\Controllers\JobController@filterCareer');
Route::post('/filter_company','App\Http\Controllers\CompanyController@filterCompany');

Route::get('/image-uploadPost', 'App\Http\Controllers\ProfileController@imageUpload');
Route::post('/image-uploadPost', 'App\Http\Controllers\ProfileController@imageUploadPost');

Route::get('/image-uploadLogoPost', 'App\Http\Controllers\ProfileController@imageUploadLogo');
Route::post('/image-uploadLogoPost', 'App\Http\Controllers\ProfileController@imageUploadLogoPost');

Route::get('/image-uploadCompanyPost', 'App\Http\Controllers\ProfileController@imageUploadCompany');
Route::post('/image-uploadCompanyPost', 'App\Http\Controllers\ProfileController@imageUploadCompanyPost');

Route::get('/laporanCompany','App\Http\Controllers\PDFController@index');
Route::get('/download-pdf','App\Http\Controllers\PDFController@downloadPDF');



Auth::routes(['verify' => true]);

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified');

//Route::get('/', 'App\Http\Controllers\AutocompleteController@index');
//Route::get('/autocomplete','App\Http\Controllers\AutocompleteController@fetch')->name('autocomplete');

