<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use Illuminate\App\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes
Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protect routes for authenticated userscAAAAAaaAAAAAAAA
Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UserController::class, ['except' => ['show']]);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('{page}', [PageController::class, 'index'])->name('page.index');
});

// Added routes for login dropdown menu

Route::get('login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::get('login/pupil', 'App\Http\Controllers\Auth\LoginController@showPupilLoginForm')->name('pupil.login');
Route::get('login/rep', 'App\Http\Controllers\Auth\LoginController@showRepLoginForm')->name('rep.login');

Route::post('login/admin', 'App\Http\Controllers\AdminController@adminLogin')->name('admin.login.submit');
Route::post('login/pupil', 'App\Http\Controllers\PupilController@pupilLogin')->name('pupil.login.submit');
Route::post('login/rep', 'App\Http\Controllers\RepresentativeController@repLogin')->name('representative.login.submit');

Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact');
Route::get('/aboutUs', 'App\Http\Controllers\AboutUsController@index')->name('aboutUs');


  
// added routes for register 
Route::get('register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegisterForm')->name('admin_register');
Route::get('register/pupil', 'App\Http\Controllers\Auth\RegisterController@showPupilRegisterForm')->name('pupil_register');
Route::get('register/representative', 'App\Http\Controllers\Auth\RegisterController@showRepRegisterForm')->name('representative_register');

Route::post('register/admin', 'App\Http\Controllers\AdminController@adminRegister')->name('admin.register.submit');
Route::post('register/pupil', 'App\Http\Controllers\PupilController@pupilRegister')->name('pupil.register.submit');
Route::post('register/rep', 'App\Http\ControllersAuth\RegisterController@repRegister')->name('rep.register.submit');



// pupil routes

Route::get('/dashboard/overview', 'App\Http\Controllers\PupilController@showOverview')->name('dashboard.overview');
Route::get('/dashboard/challenge', 'App\Http\Controllers\PupilController@showChallenges')->name('dashboard.challenges');
Route::get('/dashboard/analytics', 'App\Http\Controllers\PupilController@showAnalytics')->name('dashboard.analytics');
Route::get('/dashboard/settings', 'App\Http\Controllers\PupilController@showSettings')->name('dashboard.settings');
Route::get('/dashboard/help', 'App\Http\Controllers\PupilController@showHelp')->name('dashboard.help');


Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@showAdminDashboard')->name('admin.dashboard');
Route::get('/manage/challenge', 'App\Http\Controllers\AdminController@manageChallenge')->name('manage_challenge');
Route::get('/upload/schools', 'App\Http\Controllers\AdminController@uploadSchools')->name('upload_schools');

Route::get('/upload/questions', 'App\Http\Controllers\AdminController@uploadQuestions')->name('upload_questions');
Route::get('/upload/answers', 'App\Http\Controllers\AdminController@uploadAnswers')->name('upload_answers');
//upload of qtn
//Route::post('/upload/questions', 'App\Http\Controllers\AdminController@showUploadForm')->name('showUploadForm');
//upload of school
//Route::post('/store/schools', 'App\Http\Controllers\AdminController@storeSchool')->name('store_schools');
//upload of answer
//Route::post('/upload/answers', 'App\Http\Controllers\AdminController@showAnswerForm')->name('showAnswerForm');
//challenge routes
Route::post('/store/challenge', 'App\Http\Controllers\AdminController@setChallengeParameter')->name('store_challenge');

Route::get('/aboutUs', 'App\Http\Controllers\HomeController@showAboutUs')->name('aboutUs');
Route::get('/contact', 'App\Http\Controllers\HomeController@showContact')->name('contact');

Route::get('/schools', [SchoolController::class, 'index'])->name('school.index');
Route::get('/fetch_schools', [SchoolController::class, 'fetchSchools']);
Route::post('/add_school', [SchoolController::class, 'addSchool']);

Route::get('/best-participant', [PupilController::class, 'showBestParticipant']);
