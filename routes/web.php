<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CustomerControler;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CMSCategoryController;
use App\Http\Controllers\TestimonialController;
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

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/faqs', [HomeController::class, 'faq'])->name('faq');
Route::get('/book-service', [HomeController::class, 'book_service'])->name('book_service');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/quote', [HomeController::class, 'quote'])->name('quote');
Route::get('/terms-conditions', [HomeController::class, 'terms'])->name('terms');
//customer
Route::get('/sign-up', [CustomerControler::class, 'index'])->name('customer.sign_up');
Route::get('/sign-in', [CustomerControler::class, 'sign_in'])->name('customer.sign_in');
Route::post('/sign-up', [CustomerControler::class, 'store'])->name('customer.register');
Route::post('/verify-cotp', [CustomerControler::class, 'verify_otp'])->name('customer.verify_otp');
Route::get('/resend-cotp', [CustomerControler::class, 'resend_otp'])->name('customer.resend_otp');




	// Admin Routes
	Route::prefix('admin')->group(function () {

		Route::get('/login', 					[LoginController::class, 'login'])->name('login');
		Route::post('/login', 					[LoginController::class, 'login_go'])->name('login_go');
		Route::get('/logout', 					[LoginController::class, 'logout'])->name('logout');

		Route::get('forget-password', 			[ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
		Route::post('forget-password', 			[ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

		Route::get('reset-password/{token}', 	[ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
		Route::post('reset-password', 			[ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

		// Admin Authenticated Routes
		Route::group(['middleware' => ['auth']], function () {

			Route::get('/dashboard', 			[DashboardController::class, 'dashboard'])->name('dashboard');
			Route::get('/fileUpload', 			[UploadFileController::class, 'index'])->name('fileUpload');
			Route::post('/showUploadFile', 			[UploadFileController::class, 'showUploadFile']);

			// Profile
			Route::get('/profile', 				[UserController::class, 'profile'])->name('profile');
			Route::post('/profile/update/{id}', [UserController::class, 'profile_update'])->name('profile.update');

			// User
			Route::prefix('users')->group(function () {
				Route::get('/index', 			[UserController::class, 'index'])->name('users.index');
				Route::get('/create', 			[UserController::class, 'create'])->name('users.create');
				Route::post('/store', 			[UserController::class, 'store'])->name('users.store');
				Route::get('/edit/{id}', 		[UserController::class, 'edit'])->name('users.edit');
				Route::post('/update/{id}', 	[UserController::class, 'update'])->name('users.update');
				Route::post('/destroy', 		[UserController::class, 'destroy'])->name('users.destroy');
				Route::get('/status_update', 	[UserController::class, 'status_update'])->name('users.status_update');
			});

			// Role
			Route::prefix('roles')->group(function () {
				Route::get('/index', 			[RoleController::class, 'index'])->name('roles.index');
				Route::get('/create', 			[RoleController::class, 'create'])->name('roles.create');
				Route::post('/store', 			[RoleController::class, 'store'])->name('roles.store');
				Route::get('/edit/{id}', 		[RoleController::class, 'edit'])->name('roles.edit');
				Route::post('/update/{id}', 	[RoleController::class, 'update'])->name('roles.update');
				Route::post('/destroy', 		[RoleController::class, 'destroy'])->name('roles.destroy');
			});

			// Permission
			Route::prefix('permissions')->group(function () {
				Route::get('/index', 			[PermissionController::class, 'index'])->name('permissions.index');
				Route::get('/create', 			[PermissionController::class, 'create'])->name('permissions.create');
				Route::post('/store', 			[PermissionController::class, 'store'])->name('permissions.store');
				Route::get('/edit/{id}', 		[PermissionController::class, 'edit'])->name('permissions.edit');
				Route::post('/update/{id}', 	[PermissionController::class, 'update'])->name('permissions.update');
				Route::post('/destroy', 		[PermissionController::class, 'destroy'])->name('permissions.destroy');
			});

			// Setting
			Route::prefix('setting')->group(function () {
				Route::get('/file-manager/index', 			 [FileManagerController::class, 'index'])->name('filemanager.index');
				Route::get('/website-setting/edit', 		 [SettingController::class, 'edit'])->name('website-setting.edit');
				Route::post('/website-setting/update/{id}',  [SettingController::class, 'update'])->name('website-setting.update');
			});

			// CMS category
			Route::prefix('cmscategories')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\CMSCategoryController::class, 'index'])->name('cmscategories.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\CMSCategoryController::class, 'create'])->name('cmscategories.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\CMSCategoryController::class, 'store'])->name('cmscategories.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\CMSCategoryController::class, 'edit'])->name('cmscategories.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\CMSCategoryController::class, 'update'])->name('cmscategories.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\CMSCategoryController::class, 'destroy'])->name('cmscategories.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\CMSCategoryController::class, 'status_update'])->name('cmscategories.status_update');
			});

			// CMS Pages
			Route::prefix('cmspages')->group(function () {
				Route::get('/index', 			[CMSPageController::class, 'index'])->name('cmspages.index');
				Route::get('/create', 			[CMSPageController::class, 'create'])->name('cmspages.create');
				Route::post('/store', 			[CMSPageController::class, 'store'])->name('cmspages.store');
				Route::get('/edit/{id}', 		[CMSPageController::class, 'edit'])->name('cmspages.edit');
				Route::post('/update/{id}', 	[CMSPageController::class, 'update'])->name('cmspages.update');
				Route::post('/destroy', 		[CMSPageController::class, 'destroy'])->name('cmspages.destroy');
				Route::get('/status_update', 	[CMSPageController::class, 'status_update'])->name('cmspages.status_update');
			});

			// Testimonials
			Route::prefix('testimonials')->group(function () {
				Route::get('/index', 			[TestimonialController::class, 'index'])->name('testimonials.index');
				Route::get('/create', 			[TestimonialController::class, 'create'])->name('testimonials.create');
				Route::post('/store', 			[TestimonialController::class, 'store'])->name('testimonials.store');
				Route::get('/edit/{id}', 		[TestimonialController::class, 'edit'])->name('testimonials.edit');
				Route::post('/update/{id}', 	[TestimonialController::class, 'update'])->name('testimonials.update');
				Route::post('/destroy', 		[TestimonialController::class, 'destroy'])->name('testimonials.destroy');
				Route::get('/status_update', 	[TestimonialController::class, 'status_update'])->name('testimonials.status_update');
			});

		});
	});

