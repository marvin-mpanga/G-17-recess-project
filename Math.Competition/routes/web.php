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
Route::get('login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin_login');
Route::get('login/pupil', 'App\Http\Controllers\Auth\LoginController@showPupilLoginForm')->name('pupil_login');
Route::get('login/rep', 'App\Http\Controllers\Auth\LoginController@showRepLoginForm')->name('representative_login');
Route::get('login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::get('login/pupil', 'App\Http\Controllers\Auth\LoginController@showPupilLoginForm')->name('pupil.login');
Route::get('login/rep', 'App\Http\Controllers\Auth\LoginController@showRepLoginForm')->name('rep.login');

Route::post('login/admin', 'App\Http\Controllers\AdminController@adminLogin')->name('admin_login.submit');
Route::post('login/pupil', 'App\Http\Controllers\AdminController@pupilLogin')->name('pupil_login.submit');
Route::post('login/rep', 'App\Http\Controllers\RepresentativeController@repLogin')->name('representative_login.submit');

Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact');
Route::get('/aboutUs', 'App\Http\Controllers\AboutUsController@index')->name('aboutUs');


Route::post('login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login.submit');
Route::post('login/pupil', 'App\Http\Controllers\Auth\LoginController@showPupilLoginForm')->name('pupil.login.submit');
Route::post('login/rep', 'App\Http\Controllers\Auth\LoginController@showRepLoginForm')->name('rep.login.submit');

// added routes for register 
Route::get('register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegisterForm')->name('admin_register');
Route::get('register/pupil', 'App\Http\Controllers\Auth\RegisterController@showPupilRegisterForm')->name('pupil_register');
Route::get('register/representative', 'App\Http\Controllers\Auth\RegisterController@showRepRegisterForm')->name('representative_register');

Route::post('register/admin', 'App\Http\Controllers\AdminController@adminRegister')->name('admin.register.submit');
Route::post('register/pupil', 'App\Http\Controllers\PupilController@pupilRegister')->name('pupil.register.submit');
Route::post('register/representative', 'App\Http\ControllersAuth\RegisterController@repRegister')->name('rep_register.submit');
Route::post('register/admin', 'App\Http\Controllers\Auth\RegisterController@adminRegister')->name('admin.register.submit');
Route::post('register/pupil', 'App\Http\Controllers\PupilController@pupilRegister')->name('pupil.register.submit');
Route::post('register/rep', 'App\Http\ControllersAuth\RegisterController@repRegister')->name('rep.register.submit');



// pupil routes

Route::get('/pupil/dashboard', 'App\Http\Controllers\PupilController@showPupilDashboard')->name('pupil.dashboard');
Route::get('/pupil/challenge', 'App\Http\Controllers\PupilController@showChallenges')->name('pupil.challenges');
Route::get('/pupil/progress', 'App\Http\Controllers\PupilController@showProgress')->name('pupil.progress');
Route::get('/pupil/profile', 'App\Http\Controllers\PupilController@showProfile')->name('pupil.profile');
Route::get('/pupil/settings', 'App\Http\Controllers\PupilController@showSettings')->name('pupil.settings');
Route::get('/pupil/help', 'App\Http\Controllers\PupilController@showHelp')->name('pupil.help');

//admin routes
Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@showAdminDashboard')->name('admin.dashboard');
Route::get('/admin/overview', 'App\Http\Controllers\AdminController@adminOverview')->name('admin_overview');
Route::get('/upload/schools', 'App\Http\Controllers\AdminController@uploadSchools')->name('upload_schools');
Route::get('/upload/questions', 'App\Http\Controllers\AdminController@showUpLoadForm')->name('upload_questions');
//upload of qtn
Route::get('/upload/questions', 'App\Http\Controllers\AdminController@showUploadForm')->name('uploadQuestionsForm');
Route::post('/upload/questions', 'App\Http\Controllers\AdminController@uploadQuestions')->name('upload_questions');

Route::get('/upload/answers', 'App\Http\Controllers\AdminController@uploadAnswers')->name('upload_answers');
Route::get('/admin/profile', 'App\Http\Controllers\AdminController@adminProfile')->name('admin_profile');
Route::get('/admin/edit/info', 'App\Http\Controllers\AdminController@editInfo')->name('editInfo');
Route::post('/admin/update/info', 'App\Http\Controllers\AdminController@updateInfo')->name('updateInfo');


Route::get('/overallstats', 'App\Http\Controllers\AdminController@overallStats')->name('overall_stats');
Route::get('/upload/docs', 'App\Http\Controllers\AdminController@uploadDocs')->name('upload_docs');

//challenge routes
Route::get('/challenges', 'App\Http\Controllers\ChallengeController@getRandomQuestions')->name('challenges');
Route::get('/admin/create-challenge', 'App\Http\Controllers\AdminController@showChallengeForm')->name('challenge_form');
Route::post('/admin/create-challenge', 'App\Http\Controllers\AdminController@createChallenge')->name('createChallenge');
Route::post('/challenge/set-params', 'App\Http\Controllers\ChallengeController@setChallengeParams')->name('set.challenge.params');


Route::get('/challenge/start', 'App\Http\Controllers\ChallengeController@startChallenge')->name('challenge.start');
Route::post('/challenge/submit', 'App\Http\Controllers\ChallengeController@submitAnswer')->name('challenge.submit');
Route::get('/challenge/end', 'App\Http\Controllers\ChallengeController@endChallenge')->name('challenge.end');

//questions routes
Route::get('/admin/upload-questions', 'App\Http\Controllers\AdminController@showUploadForm')->name('QuestionsForm');
Route::post('/admin/upload-questions', 'App\Http\Controllers\AdminController@uploadQuestions')->name('upload_questions');

//pupil routes
Route::middleware(['auth'])->group(function () {
    Route::get('/pupil/dashboard', 'APP\Http\Controllers\PupilController@dashboard')->name('pupil.dashboard');
    // Other pupil routes
});

//representative routes
Route::middleware(['auth', 'representative'])->group(function () {
    Route::get('/representative/dashboard', [RepresentativeController::class, 'dashboard']);
    // Other representative routes
});
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

Route::get('/aboutUs', 'App\Http\Controllers\HomeController@showAboutUs')->name('aboutUs');
Route::get('/contact', 'App\Http\Controllers\HomeController@showContact')->name('contact');


