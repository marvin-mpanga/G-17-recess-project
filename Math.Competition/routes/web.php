<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PupilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RepresentativeController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protect routes for authenticated users
Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UserController::class, ['except' => ['show']]);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('{page}', [PageController::class, 'index'])->name('page.index');
});

// Added routes for login dropdown menu
Route::get('login/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::get('login/pupil', [LoginController::class, 'showPupilLoginForm'])->name('pupil.login');
Route::get('login/rep', [LoginController::class, 'showRepLoginForm'])->name('rep.login');

<<<<<<< Updated upstream
Route::post('login/admin', 'App\Http\Controllers\Auth\LoginController@adminLogin')->name('admin.login.submit');
Route::post('login/pupil', 'App\Http\Controllers\Auth\LoginController@pupilLogin')->name('pupil.login.submit');
Route::post('login/rep', 'App\Http\Controllers\Auth\LoginController@repLogin')->name('rep.login.submit');

Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact');
Route::get('/aboutUs', 'App\Http\Controllers\AboutUsController@index')->name('aboutUs');



// added routes for register 
Route::get('register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegisterForm')->name('admin.register');
Route::get('register/pupil', 'App\Http\Controllers\Auth\RegisterController@showPupilRegisterForm')->name('pupil.register');
Route::get('register/rep', 'App\Http\Controllers\Auth\RegisterController@showRepRegisterForm')->name('rep.register');

Route::post('register/admin', 'App\Http\Controllers\Auth\RegisterController@adminRegister')->name('admin.register.submit');
Route::post('register/pupil', 'App\Http\ControllersAuth\RegisterController@pupilRegister')->name('pupil.register.submit');
Route::post('register/rep', 'App\Http\ControllersAuth\RegisterController@repRegister')->name('rep.register.submit');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::prefix('admin')->name('admin.')->group(function () {
Route::get('/overview', 'App\Http\Controllers\AdminController@overview')->name('overview');
Route::get('/schools', 'App\Http\Controllers\AdminController@manageSchools')->name('schools');
Route::get('/questions', 'App\Http\Controllers\AdminController@manageQuestions')->name('questions');
Route::get('/answers', 'App\Http\Controllers\AdminController@manageAnswers')->name('answers');
Route::get('/uploads', 'App\Http\Controllers\AdminController@manageUploads')->name('uploads');
Route::get('/statistics', 'App\Http\Controllers\AdminController@viewStatistics')->name('stats');
});



// School Representative Routes
Route::prefix('school-rep')->name('school-rep.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\SchoolRepController::class, 'index'])->name('dashboard');
    Route::get('/pupils', [App\Http\Controllers\SchoolRepController::class, 'listPupils'])->name('pupils');
    Route::post('/pupils/{id}/confirm', [App\Http\Controllers\SchoolRepController::class, 'confirmPupil'])->name('pupil.confirm');
    Route::get('/rep_profile', [App\Http\Controllers\SchoolRepController::class, 'rep_profile'])->name('rep_profile');
    Route::post('rep_profile/update', [App\Http\Controllers\SchoolRepController::class, 'updateProfile'])->name('profile.update');
    Route::get('/communications', [App\Http\Controllers\SchoolRepController::class, 'communications'])->name('communications');
    Route::post('/communications/send', [App\Http\Controllers\SchoolRepController::class, 'sendMessage'])->name('communications.send');
    Route::get('/analytics', [App\Http\Controllers\SchoolRepController::class, 'analytics'])->name('analytics');
   
});

