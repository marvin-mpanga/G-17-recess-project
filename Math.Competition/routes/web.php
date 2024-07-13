<?php use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | */
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
