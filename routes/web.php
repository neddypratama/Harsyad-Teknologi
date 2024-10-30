<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailCompanyController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GaleryProjectController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ValuesController;
use App\Http\Controllers\VisiMisiController;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;
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

Route::get('/welcome', function () { return view('welcome');})->name('welcome');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('auth')->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::resource('faq', FaqController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('detail', DetailCompanyController::class);
    Route::resource('feedback', FeedbackController::class);
    Route::resource('form', FormController::class);
    Route::resource('galery', GaleryProjectController::class);
    Route::resource('layanan', LayananController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('team', TeamController::class);
    Route::resource('values', ValuesController::class);
    Route::resource('visimisi', VisiMisiController::class);
    Route::resource('profile', ProfileController::class);
    Route::put('profile-password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::get('/', [FrontController::class, 'showLandingPage'])->name('landingpage');
Route::get('/about-us-page', [FrontController::class, 'showAboutUsPage'])->name('aboutuspage');
Route::get('/service-page/{id}', [FrontController::class, 'showServicePage'])->name('servicepage');
Route::get('/portofolio-page', [FrontController::class, 'showPortofolioPage'])->name('portofoliopage');
Route::get('/portofolio-detail-page/{id}', [FrontController::class, 'showPortofolioDetail'])->name('portofoliodetailpage');

Route::post('/add-form', [FrontController::class, 'store'])->name('add-form');
