<?php

use App\Http\Middleware\Authenticate;
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

// home page
Route::get('/', function () { return view('welcome'); });

Auth::routes();


Route::middleware([Authenticate::class])->group(function () {
    // Only authenticated users may access this route...
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'show'])->name('contact');;
    Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


    // Patient Routes  
    Route::get('/patient/index', [App\Http\Controllers\PatientController::class, 'index'])->name('listPatients');
    Route::get('/patient/add', [App\Http\Controllers\PatientController::class, 'create'])->name('addPatient');
    Route::post('/patient/store', [App\Http\Controllers\PatientController::class, 'store']);
    Route::get('/patient/show', [App\Http\Controllers\PatientController::class, 'show']);

    Route::get('/patient/analysis/{id}', [App\Http\Controllers\PatientController::class, 'createAnalysis'])->name('add_analysis');
    Route::get('/patient/analysis/delete/{id}', [App\Http\Controllers\PatientController::class, 'deleteAnalysis'])->name('delete_analysis');
    Route::post('/patient/analysis/store', [App\Http\Controllers\PatientController::class, 'storeAnalysis']);
    Route::get('/patient/analysis/edit/{patient_id}/{analysis_id}', [App\Http\Controllers\PatientController::class, 'editAnalysis'])->name('edit_analysis');;
    Route::put('/patient/analysis/update', [App\Http\Controllers\PatientController::class, 'update']);

    Route::get('/patient/edit/{id}', [App\Http\Controllers\PatientController::class, 'edit'])->name('edit');;
    Route::put('/patient/edit', [App\Http\Controllers\PatientController::class, 'update']);
    Route::delete('/patient/delete/{id}', [App\Http\Controllers\PatientController::class, 'delete']);


    // Alergen Routes
    Route::get('/allergens/show', [App\Http\Controllers\AllergensController::class, 'show'])->name('showAllergens');
    Route::get('/allergens/stats', [App\Http\Controllers\AllergensController::class, 'stats'])->name('showAllergensStats');
    Route::post('/allergens', [App\Http\Controllers\AllergensController::class, 'create'])->name('add');
    Route::get('/allergens/edit/{id}', [App\Http\Controllers\AllergensController::class, 'edit'])->name('edit');;
    Route::put('/allergens', [App\Http\Controllers\AllergensController::class, 'update']);

    // Users Routes
    Route::get('/users', [App\Http\Controllers\AccountUserController::class, 'index'])->name('showUsers');
    Route::get('/users/create', [App\Http\Controllers\AccountUserController::class, 'create'])->name('create');
    Route::post('/users/store', [App\Http\Controllers\AccountUserController::class, 'store']);
    Route::get('/users/edit/{id}', [App\Http\Controllers\AccountUserController::class, 'edit'])->name('edit');
    Route::get('/users/profile', [App\Http\Controllers\AccountUserController::class, 'profile'])->name('userProfile');

    // Report Routes
    Route::get('/patient/{patient_id}/report/{record_id}',[App\Http\Controllers\ReportsController::class, 'show'])->name('patientReport');
    Route::get('/immuno/{patient_id}/report/{record_id}',[App\Http\Controllers\ReportsController::class, 'showImmuno'])->name('immunoReport');


});

