<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DrugsController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\InvetigationController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProblemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('isLogin');

/**
 * Oauth routes
 */
Route::get('/oauth/sign-in', function(){return view('oauth.login');})->name('oauth.sign-in');
Route::get('/oauth/create', [OauthController::class, 'index'])->name('oauth.index');
Route::post('/oauth/save', [OauthController::class, 'store'])->name('oauth.store');
Route::get('/oauth/edit/{user_id}', [OauthController::class, 'edit'])->name('oauth.edit');
Route::post('/oauth/update/{user_id}', [OauthController::class, 'update'])->name('oauth.update');
Route::get('/oauth/delete/{user_id}', [OauthController::class, 'destroy'])->name('oauth.destroy');
Route::post('/oauth/login', [OauthController::class, 'signIn'])->name('oauth.login');
Route::get('/oauth/sign-out', [OauthController::class, 'signOut'])->name('oauth.sign-out');
Route::get('/', [OauthController::class, 'home'])->name('welcome')->middleware('isLogin');

/**
 * Investigation routes
 */
Route::get('/investigation/manage', [InvetigationController::class, 'index'])->name('investigation.index')->middleware('isLogin')->middleware('authorization');
Route::post('/investigation/save', [InvetigationController::class, 'store'])->name('investigation.store');
Route::get('/investigation/edit/{investigation_id}', [InvetigationController::class, 'edit'])->name('investigation.edit');
Route::post('/investigation/update/{investigation_id}', [InvetigationController::class, 'update'])->name('investigation.update');
Route::get('/investigation/delete/{investigation_id}', [InvetigationController::class, 'destroy'])->name('investigation.destroy');

/**
 * Patient management routes
 */
Route::controller(PatientController::class)->group(function() {
    Route::get('/patient/manage', 'index')->name('patient.index')->middleware('isLogin')->middleware('authorization');
    Route::post('/patient/save', 'store')->name('patient.store');
    Route::get('/patient/new', 'clearAll')->name('patient.new');
    Route::post('/patient/get-history', 'getPrevoiusDate')->name('patient.get-prevoius-date');
    Route::post('/patient/history', 'getPatientRecords')->name('patient.history');
    Route::post('/patient/add-investigation', 'addInvestigation')->name('patient.add-investigation');
    Route::post('/patient/add-problem', 'addProblem')->name('patient.add-problem');
    Route::post('/patient/add-note', 'addNote')->name('patient.add-note');
    Route::post('/patient/add-clinic', 'addClinic')->name('patient.add-clinic');
    Route::post('/patient/add-normal-drugs', 'addNormalDrug')->name('patient.add-normal-drugs');
    Route::post('/patient/add-special-drugs', 'addSpecialDrug')->name('patient.add-special-drugs');
    Route::get('/patient/user-panel', 'userPanel')->name('patient.user-panel');
    Route::post('/patient/patient-data', 'addPatientData')->name('patient.add-data');
    Route::post('/patient/prescription', 'savePrescription')->name('patient.prescription');
    Route::post('/patient/add-to-cart', 'addToCart')->name('patient.add-to-cart');
});

/**
 * Problem routes
 */
Route::controller(ProblemController::class)->group(function() {
    Route::get('/problem/manage', 'index')->name('problem.index')->middleware('isLogin')->middleware('authorization');
    Route::post('/problem/save', 'store')->name('problem.store');
    Route::get('/problem/edit/{problem_id}', 'edit')->name('problem.edit');
    Route::post('/problem/update/{problem_id}', 'update')->name('problem.update');
    Route::get('/problem/delete/{problem_id}', 'destroy')->name('problem.destroy');
});

/**
 * Clinic routes
 */
Route::controller(ClinicController::class)->group(function() {
    Route::get('/clinic/manage', 'index')->name('clinic.index')->middleware('isLogin')->middleware('authorization');
    Route::post('/clinic/save', 'store')->name('clinic.store');
    Route::get('/clinic/edit/{clinic_id}', 'edit')->name('clinic.edit');
    Route::post('/clinic/update/{clinic_id}', 'update')->name('clinic.update');
    Route::get('/clinic/delete/{clinic_id}', 'destroy')->name('clinic.destroy');
});

/**
 * Frequency routes
 */
Route::controller(FrequencyController::class)->group(function() {
    Route::get('/frequency/manage', 'index')->name('frequency.index')->middleware('isLogin')->middleware('authorization');
    Route::post('/frequency/save', 'store')->name('frequency.store');
    Route::get('/frequency/edit/{frequency_id}', 'edit')->name('frequency.edit');
    Route::post('/frequency/update/{frequency_id}', 'update')->name('frequency.update');
    Route::get('/frequency/delete/{frequency_id}', 'destroy')->name('frequency.destroy');
});

/**
 * Drugs routes
 */
Route::controller(DrugsController::class)->group(function() {
    Route::get('/drugs/manage', 'index')->name('drugs.index')->middleware('isLogin')->middleware('authorization');
    Route::post('/drugs/save', 'store')->name('drugs.store');
    Route::get('/drugs/edit/{drug_id}', 'edit')->name('drugs.edit');
    Route::post('/drugs/update/{drug_id}', 'update')->name('drugs.update');
    Route::get('/drugs/delete/{drug_id}', 'destroy')->name('drugs.destroy');
});
