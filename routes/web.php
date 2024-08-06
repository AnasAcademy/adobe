<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IllustratorAppointmentController;
use App\Http\Controllers\IllustratorEmailController;
use App\Http\Controllers\PhotoshopAppointmentController;
use App\Http\Controllers\PhotoshopEmailController;
use App\Http\Controllers\DesignAppointmentController;
use App\Http\Controllers\DesignEmailController;
use App\Http\Controllers\DuplicatedAppointmentController;
use App\Http\Controllers\DuplicatedEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FormController;
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

Route::get('/', [AppointmentController::class, 'index'])->name('form');
//
Route::get('/adobe-register', [FormController::class, 'index']);

Route::post('/send_form',[AppointmentController::class,'store'])->name('submit_form');
Route::post('/set-cookie', [AppointmentController::class,'setCookie']);
Route::post('/validation',[AppointmentController::class,'validation'])->name('validation');
Route::post('/payment/{amount}',[AppointmentController::class,'createStripeIntent'])->name('pay');
Route::post('/stripe/callback',[AppointmentController::class,'processConfirmation'])->name('stripe.return');
///////////////////////////////////////////////////////////////
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/adminPanel', function () {return view('dashboard.index');})->name('adminPanel');
    Route::get('/illustrator_email', [IllustratorEmailController::class, 'index']);
    Route::get('/photoshop_email', [PhotoshopEmailController::class, 'index']);
    Route::get('/design_email', [DesignEmailController::class, 'index']);
    Route::get('/duplicated_email', [DuplicatedEmailController::class, 'index']);
    Route::get('/illustrator_appointment', [IllustratorAppointmentController::class, 'index']);
    Route::get('/photoshop_appointment', [PhotoshopAppointmentController::class, 'index']);
    Route::get('/design_appointment', [DesignAppointmentController::class, 'index']);
    Route::get('/duplicated_appointment', [DuplicatedAppointmentController::class, 'index']);
    Route::get('/allAppointment', [AppointmentController::class, 'index_dashboard']);
    Route::get('/export-appointments', [AppointmentController::class, 'exportAppointmentsToExcel']);
    Route::delete('/delete-appointments/{id}', [AppointmentController::class, 'destroy'])->name('delete-appointments');
    Route::get('/deleteAllAppointment', [AppointmentController::class,'deleteAllAppointment'])->name('deleteAllAppointment');
    //illustrator email crud operation//
    Route::post('/new_email',[IllustratorEmailController::class,'store'])->name('add_email');
    Route::delete('/emails/{id}', [IllustratorEmailController::class,'destroy'])->name('emails.destroy');
    Route::put('/emails/{id}', [IllustratorEmailController::class,'update'])->name('emails.update');
    Route::get('/delete-table', [IllustratorEmailController::class,'deleteTable'])->name('deleteTable');
    //photoshop email crud operation//
    Route::post('/new_email_photoshop',[PhotoshopEmailController::class,'store'])->name('add_email_photoshop');
    Route::delete('/emails_photoshop/{id}', [PhotoshopEmailController::class,'destroy'])->name('emails_photoshop.destroy');
    Route::put('/emails_photoshop/{id}', [PhotoshopEmailController::class,'update'])->name('emails_photoshop.update');
    Route::get('/deletePhoto_email', [PhotoshopEmailController::class,'deleteTable'])->name('deletePhoto_email');
    //design email crud operation//
    Route::post('/new_email_design',[DesignEmailController::class,'store'])->name('add_email_design');
    Route::delete('/emails_design/{id}', [DesignEmailController::class,'destroy'])->name('emails_design.destroy');
    Route::put('/emails_design/{id}', [DesignEmailController::class,'update'])->name('emails_design.update');
    Route::get('/deleteDesign_email', [DesignEmailController::class,'deleteTable'])->name('deleteDesign_email');
    //duplicated email crud operation//
    Route::post('/new_email_duplicated',[DuplicatedEmailController::class,'store'])->name('add_email_duplicated');
    Route::delete('/emails_duplicated/{id}', [DuplicatedEmailController::class,'destroy'])->name('emails_duplicated.destroy');
    Route::put('/emails_duplicated/{id}', [DuplicatedEmailController::class,'update'])->name('emails_duplicated.update');
    Route::get('/deleteDuplicated_email', [DuplicatedEmailController::class,'deleteTable'])->name('deleteDuplicated_email');
    //illustrator appointment crud operation//
    Route::post('/new_appointment',[IllustratorAppointmentController::class,'store'])->name('add_appointment');
    Route::delete('/appointments/{id}', [IllustratorAppointmentController::class,'destroy'])->name('appointments.destroy');
    Route::put('/appointments/{id}', [IllustratorAppointmentController::class,'update'])->name('appointments.update');
    Route::get('/delete-appointment', [IllustratorAppointmentController::class,'deleteTable'])->name('deleteAppointment');
    //photoshop appointment crud operation//
    Route::post('/new_appointment_photoshop',[PhotoshopAppointmentController::class,'store'])->name('add_appointment_photoshop');
    Route::delete('/appointments_photoshop/{id}', [PhotoshopAppointmentController::class,'destroy'])->name('appointments_photoshop.destroy');
    Route::put('/appointments_photoshop/{id}', [PhotoshopAppointmentController::class,'update'])->name('appointments_photoshop.update');
    Route::get('/deletePhoto_appointment', [PhotoshopAppointmentController::class,'deleteTable'])->name('deletePhoto_appointment');
    //design appointment crud operation//
    Route::post('/new_appointment_design',[DesignAppointmentController::class,'store'])->name('add_appointment_design');
    Route::delete('/appointments_design/{id}', [DesignAppointmentController::class,'destroy'])->name('appointments_design.destroy');
    Route::put('/appointments_design/{id}', [DesignAppointmentController::class,'update'])->name('appointments_design.update');
    Route::get('/deleteDesign_appointment', [DesignAppointmentController::class,'deleteTable'])->name('deleteDesign_appointment');
    //duplicated appointment crud operation//
    Route::post('/new_appointment_duplicated',[DuplicatedAppointmentController::class,'store'])->name('add_appointment_duplicated');
    Route::delete('/appointments_duplicated/{id}', [DuplicatedAppointmentController::class,'destroy'])->name('appointments_duplicated.destroy');
    Route::put('/appointments_duplicated/{id}', [DuplicatedAppointmentController::class,'update'])->name('appointments_duplicated.update');
    Route::get('/deleteDuplicated_appointment', [DuplicatedAppointmentController::class,'deleteTable'])->name('deleteDuplicated_appointment');
    /////////import emails from excel/////////////////
    Route::post('import_ill_email',[IllustratorEmailController::class,'importExcel'])->name('emailExcel_ill');
    Route::post('import_photo_email',[PhotoshopEmailController::class,'importExcel'])->name('emailExcel_photo');
    Route::post('import_design_email',[DesignEmailController::class,'importExcel'])->name('emailExcel_design');
    Route::post('import_duplicated_email',[DuplicatedEmailController::class,'importExcel'])->name('emailExcel_duplicated');
    /////////import appointment from excel/////////////////
    Route::post('import_ill_appointment',[IllustratorAppointmentController::class,'importExcel'])->name('appointmentExcel_ill');
    Route::post('import_photo_appointment',[PhotoshopAppointmentController::class,'importExcel'])->name('appointmentExcel_photo');
    Route::post('import_design_appointment',[DesignAppointmentController::class,'importExcel'])->name('appointmentExcel_design');
    Route::post('import_duplicated_appointment',[DuplicatedAppointmentController::class,'importExcel'])->name('appointmentExcel_duplicated');
    ///////////////////////////////////
});

require __DIR__.'/auth.php';
