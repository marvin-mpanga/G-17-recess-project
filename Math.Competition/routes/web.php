<?php 

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

// Added routes for login dropdown menu
Route::get('login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::get('login/pupil', 'App\Http\Controllers\Auth\LoginController@showPupilLoginForm')->name('pupil.login');
Route::get('login/rep', 'App\Http\Controllers\Auth\LoginController@showRepLoginForm')->name('rep.login');

Route::post('login/admin', 'App\Http\Controllers\Auth\LoginController@adminLogin')->name('admin.login.submit');
Route::post('login/pupil', 'App\Http\ControllersAuth\LoginController@pupilLogin')->name('pupil.login.submit');
Route::post('login/rep', 'App\Http\ControllersAuth\LoginController@repLogin')->name('rep.login.submit');

// added routes for register 
Route::get('register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegisterForm')->name('admin.register');
Route::get('register/pupil', 'App\Http\Controllers\Auth\RegisterController@showPupilRegisterForm')->name('pupil.register');
Route::get('register/rep', 'App\Http\Controllers\Auth\RegisterController@showRepRegisterForm')->name('rep.register');

Route::post('lregister/admin', 'App\Http\Controllers\Auth\RegisterController@adminRegister')->name('admin.register.submit');
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
