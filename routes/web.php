<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DrugsController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\InvetigationController;
use App\Http\Controllers\LettersController;
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
Route::get('/oauth/create', [OauthController::class, 'index'])->name('oauth.index')->middleware('isLogin')->middleware('authorization');
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
    Route::post('/patient/update-cart', 'updateCart')->name('patient.update-cart');
    Route::get('/patient/delete-cart-item/{raw_id}', 'deleteCartItem')->name('patient.delete-cart-item');
    Route::post('/patient/mixtard-insulin', 'mistardInsulin')->name('patient.mixtard');
    Route::get('/patient/print/{prescription_id}/{check_date}', 'print')->name('patient.print');
    Route::post('patient/register', 'patientRegister')->name('patient.resgister');
    Route::get('/patient/clear-form', 'clearForm')->name('patient.clear-form');
    Route::post('/patient/search', 'patientSearch')->name('patient.search');
    Route::get('/patient/clear-prescription', 'clearPrescription')->name('patient.clear-prescription');
    Route::get('patient/list', 'patientList')->name('patient.list');
    Route::post('/patient/patient-search', 'seach')->name('patient.patient-search');
    Route::get('/patient/edit/{patient_id}', 'editPatient')->name('patient.edit');
    Route::post('/patient/update/{patient_id}', 'updatePatient')->name('patient.update');
    Route::get('/patient/patient-new', 'viewPateintNew')->name('patient.patient-new');

    Route::post('/patient/update', 'newUpdate')->name('patient.update');
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

/**
 * Letters routes
 */
Route::controller(LettersController::class)->group(function() {
    Route::get('/letters/aco', 'acoLetter')->name('letters.aco')->middleware('isLogin')->middleware('authorization');
    Route::post('/letters/aco-print', 'acoLetterPost')->name('letters.aco-print');
    Route::get('/letters/aco-letter-clear', 'acoLetterClear')->name('letters.aco-clear');
    Route::get('/letters/fee', 'feeLetter')->name('letters.fee')->middleware('isLogin')->middleware('authorization');
    Route::post('/letters/fee-print', 'feeLetterPost')->name('letters.fee-print');
    Route::get('/letters/fee-clear', 'feeLetterClear')->name('letters.fee-clear');
    Route::get('/letters/leaves', 'leavesLetterPage')->name('letters.leaves')->middleware('isLogin')->middleware('authorization');
    Route::post('/letters/leave-print', 'leaveLetterPrint')->name('letters.leaves-print');
    Route::get('/letters/leave-clear', 'leaveLetterClear')->name('letters.leaves-clear');
    Route::get('/letters/clinic', 'clinicLetterPage')->name('letters.clinic')->middleware('isLogin')->middleware('authorization');
    Route::post('/letters/clinic-print', 'clinicLetterPrint')->name('letters.clinic-print');
    Route::get('/letters/clinic-clear', 'clinicLetterClear')->name('letters.clinic-clear');
    Route::get('/letter/letter', 'letterPage')->name('letters.letter')->middleware('isLogin')->middleware('authorization');
    Route::post('/letter/letter-print', 'letterPrint')->name('letters.letter-print');
    Route::get('/letter/letter-clear', 'letterClear')->name('letters.letter-clear');
    Route::get('/letters/r-letter', 'radiologLetterPage')->name('letters.radiology')->middleware('isLogin')->middleware('authorization');
    Route::post('/letters/r-letter-print', 'radiologyPrint')->name('letters.radiology-print');
    Route::get('/letters/r-letter-clear', 'radiologyClear')->name('letters.radiology-clear');
    Route::get('/letter/admission', 'admissionLetterPage')->name('letters.admission');
    Route::post('/letter/admission-print', 'admissionPrint')->name('letters.admission-print');
    Route::get('/letter/admission-clear', 'admissionClear')->name('letters.admission-clear');
    Route::get('/letter/b-letter', 'bloodPictureLetter')->name('letters.blood-picture');
    Route::post('/letter/b-letter-print', 'bloodPictureLetterPrint')->name('letters.blodd-picture-print');
    Route::get('/letter/b-letter-clear', 'bloodPictureLetterClear')->name('letters.blood-picture-clear');
    Route::get('/letter/common', 'commonLetterPage')->name('letters.common');
    Route::post('/letter/common-print', 'commonPrint')->name('letters.common-print');
    Route::get('/letter/common-clear', 'commonLetterClear')->name('letters.common-clear');
});
