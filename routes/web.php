<?php
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RecoverController;
use App\Http\Controllers\Backsite\BloggController;
use App\Http\Controllers\Backsite\ContactController;
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\EducationController;
use App\Http\Controllers\Backsite\ExperienceController;
use App\Http\Controllers\Backsite\FormEditController;
use App\Http\Controllers\Backsite\GallaryController;
use App\Http\Controllers\Backsite\PortoController;
use App\Http\Controllers\BacksiteController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [BacksiteController::class,  'index']);
//AuthPage
Route::prefix('login')->middleware(RedirectIfAuthenticated::class)->name('login.')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('index');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-store', [RegisterController::class, 'store'])->name('register.store');
Route::get('/recover', [RecoverController::class, 'index'])->name('recover');

Route::middleware(['auth'])->group(function () {
    Route::get('/form-edit', [FormEditController::class, 'index'])->name('form.edit');
    Route::post('/form-edit/store', [FormEditController::class, 'store'])->name('form.store');
});

//BacksitePage
Route::middleware(Authenticate::class)->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('backsite.dashboard');
    Route::get('/contact', [ContactController::class, 'index'])->name('backsite.contact');
    Route::get('/gallary', [GallaryController::class, 'index' ])->name('backsite.gallary');
    Route::get('/edit-profil', [FormEditController::class, 'index'])->name('backsite.form-edit');
    Route::get('/education', [EducationController::class, 'index'])->name('backsite.education');
    Route::get('/porto', [PortoController::class, 'index'])->name('backsite.porto');
    Route::get('/experience', [ExperienceController::class, 'index'])->name('backsite.experience');
    Route::get('/backsite-blog', [BloggController::class, 'index'])->name('backsite.blog');

});