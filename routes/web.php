<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\OpRoomController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\DocExamController;




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

Route::get('/', function () {
    return view('Startpage');
});

Route::get('/es', function () {
    return view('examinations');
});

Route::resource('doctors', DoctorController::class);
Route::resource('nurses', NurseController::class);
Route::resource('teams', TeamController::class);
Route::resource('patients', PatientController::class);
Route::resource('opRooms', OpRoomController::class);
Route::resource('operations', OperationController::class);
Route::resource('examinations', ExaminationController::class);
Route::resource('doc_exams', DocExamController::class);


/*
Route::get('/doctors', [DoctorController::class, 'index'])->name('getDoctors');
Route::post('/doctors.store', [DoctorController::class, 'store'])->name('doctorStore');
Route::delete('/doctors.delete', [DoctorController::class, 'delete'])->name('doctorDelete');
*/