<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CustomerControler;
use App\Http\Controllers\Frontend\CustomerAuth\CustomerLoginController;
use App\Http\Controllers\Frontend\CustomerAuth\CustomerRegistrationController;
use App\Http\Controllers\Frontend\PartnerAgentController;
use App\Http\Controllers\Frontend\PartnerAgentAuth\PartnerAgentLoginController;
use App\Http\Controllers\Frontend\PartnerAgentAuth\PartnerAgentRegistrationController;
use App\Http\Controllers\Frontend\EmployeeController;
use App\Http\Controllers\Frontend\EmployeeAuth\EmployeeLoginController;
use App\Http\Controllers\Frontend\EmployeeAuth\EmployeeRegistrationController;
use App\Http\Controllers\Frontend\HotelPartnerController;
use App\Http\Controllers\Frontend\HotelPartnerAuth\HotelPartnerLoginController;
use App\Http\Controllers\Frontend\HotelPartnerAuth\HotelPartnerRegistrationController;
use App\Http\Controllers\Frontend\AssociateController;
use App\Http\Controllers\Frontend\AssociateAuth\AssociateLoginController;
use App\Http\Controllers\Frontend\AssociateAuth\AssociateRegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeListController;
use App\Http\Controllers\Admin\AssociateListController;
use App\Http\Controllers\Admin\PartnerAgentListController;
use App\Http\Controllers\Admin\HotelPartnerListController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
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
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/faqs', [HomeController::class, 'faq'])->name('faq');
Route::get('/book-service', [HomeController::class, 'book_service'])->name('book_service');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/quote-generate', [HomeController::class, 'quote'])->name('quote');
Route::get('/terms-conditions', [HomeController::class, 'terms'])->name('terms');
//customer
Route::group(['middleware' => ['customer.auth']], function () {
	Route::get('/logout',[CustomerLoginController::class, 'logout'])->name('customer.logout');
	Route::get('/my-account', [CustomerControler::class, 'my_account'])->name('customer.my_account');
	Route::get('/order', [CustomerControler::class, 'order'])->name('customer.order');
	Route::get('/quote', [CustomerControler::class, 'quote'])->name('customer.quote');
	Route::get('/profile', [CustomerControler::class, 'profile'])->name('customer.profile');
});
Route::group(['middleware' => 'customer.guest'], function () {
	Route::post('/sign-in', [CustomerLoginController::class, 'login_go'])->name('customer.login_go');
	Route::get('/sign-in', [CustomerLoginController::class, 'sign_in'])->name('customer.sign_in');
});
Route::get('/sign-up', [CustomerRegistrationController::class, 'index'])->name('customer.sign_up');
Route::post('/sign-up', [CustomerRegistrationController::class, 'store'])->name('customer.register');
Route::post('/verify-cotp', [CustomerRegistrationController::class, 'verify_otp'])->name('customer.verify_otp');
Route::get('/resend-cotp', [CustomerRegistrationController::class, 'resend_otp'])->name('customer.resend_otp');
//partneragent 
Route::prefix('partneragent')->group(function () {
	Route::group(['middleware' => ['partneragent.auth']], function () {
		Route::get('/logout',[PartnerAgentLoginController::class, 'logout'])->name('partneragent.logout');
		Route::get('', [PartnerAgentController::class, 'my_account'])->name('partneragent.my_account');
		Route::get('/order', [PartnerAgentController::class, 'order'])->name('partneragent.order');
		Route::get('/refer', [PartnerAgentController::class, 'refer'])->name('partneragent.refer');
		Route::get('/add-refer', [PartnerAgentController::class, 'add_refer'])->name('partneragent.add_refer');
		Route::get('/profile', [PartnerAgentController::class, 'profile'])->name('partneragent.profile');
	});
	Route::group(['middleware' => 'partneragent.guest'], function () {
		Route::get('/sign-in', [PartnerAgentLoginController::class, 'sign_in'])->name('partneragent.sign_in');
		Route::post('/sign-in',[PartnerAgentLoginController::class, 'login_go'])->name('partneragent.login_go');
	});
	Route::get('/sign-up', [PartnerAgentRegistrationController::class, 'index'])->name('partneragent.sign_up');
	Route::post('/sign-up', [PartnerAgentRegistrationController::class, 'store'])->name('partneragent.register');
	Route::post('/verify-cotp', [PartnerAgentRegistrationController::class, 'verify_otp'])->name('partneragent.verify_otp');
	Route::get('/resend-cotp', [PartnerAgentRegistrationController::class, 'resend_otp'])->name('partneragent.resend_otp');
});
//hotelpartner
Route::prefix('hotelpartner')->group(function () {
	Route::group(['middleware' => ['hotelpartner.auth']], function () {
		Route::get('/logout',[HotelPartnerLoginController::class, 'logout'])->name('hotelpartner.logout');
		Route::get('', [HotelPartnerController::class, 'my_account'])->name('hotelpartner.my_account');
		Route::get('/order', [HotelPartnerController::class, 'order'])->name('hotelpartner.order');
		Route::get('/refer', [HotelPartnerController::class, 'refer'])->name('hotelpartner.refer');
		Route::get('/add-refer', [HotelPartnerController::class, 'add_refer'])->name('hotelpartner.add_refer');
		Route::get('/profile', [HotelPartnerController::class, 'profile'])->name('hotelpartner.profile');
	});
	Route::group(['middleware' => 'hotelpartner.guest'], function () {
		Route::get('/sign-in', [HotelPartnerLoginController::class, 'sign_in'])->name('hotelpartner.sign_in');
		Route::post('/sign-in',[HotelPartnerLoginController::class, 'login_go'])->name('hotelpartner.login_go');
	});
	Route::get('/sign-up', [HotelPartnerRegistrationController::class, 'index'])->name('hotelpartner.sign_up');
	Route::post('/sign-up', [HotelPartnerRegistrationController::class, 'store'])->name('hotelpartner.register');
	Route::post('/verify-cotp', [HotelPartnerRegistrationController::class, 'verify_otp'])->name('hotelpartner.verify_otp');
	Route::get('/resend-cotp', [HotelPartnerRegistrationController::class, 'resend_otp'])->name('hotelpartner.resend_otp');
});
//employee
Route::prefix('employee')->group(function () {
	Route::group(['middleware' => ['employee.auth']], function () {
		Route::get('/logout',[EmployeeLoginController::class, 'logout'])->name('employee.logout');
		Route::get('', [EmployeeController::class, 'my_account'])->name('employee.my_account');
		Route::get('/order', [EmployeeController::class, 'order'])->name('employee.order');
		Route::get('/refer', [EmployeeController::class, 'refer'])->name('employee.refer');
		Route::get('/add-refer', [EmployeeController::class, 'add_refer'])->name('employee.add_refer');
		Route::get('/profile', [EmployeeController::class, 'profile'])->name('employee.profile');
	});
	Route::group(['middleware' => 'employee.guest'], function () {
		Route::get('/sign-in', [EmployeeLoginController::class, 'sign_in'])->name('employee.sign_in');
		Route::post('/sign-in',[EmployeeLoginController::class, 'login_go'])->name('employee.login_go');
	});
	Route::get('/sign-up', [EmployeeRegistrationController::class, 'index'])->name('employee.sign_up');
	Route::post('/sign-up', [EmployeeRegistrationController::class, 'store'])->name('employee.register');
	Route::post('/verify-cotp', [EmployeeRegistrationController::class, 'verify_otp'])->name('employee.verify_otp');
	Route::get('/resend-cotp', [EmployeeRegistrationController::class, 'resend_otp'])->name('employee.resend_otp');
});
//Associate
Route::prefix('associate')->group(function () {
	Route::group(['middleware' => ['associate.auth']], function () {
		Route::get('/logout',[AssociateLoginController::class, 'logout'])->name('associate.logout');
		Route::get('', [AssociateController::class, 'my_account'])->name('associate.my_account');
		Route::get('/order', [AssociateController::class, 'order'])->name('associate.order');
		Route::get('/refer', [AssociateController::class, 'refer'])->name('associate.refer');
		Route::get('/add-refer', [AssociateController::class, 'add_refer'])->name('associate.add_refer');
		Route::get('/profile', [AssociateController::class, 'profile'])->name('associate.profile');
	});
	Route::group(['middleware' => 'associate.guest'], function () {
		Route::post('/sign-in', [AssociateLoginController::class, 'login_go'])->name('associate.login_go');
		Route::get('/sign-in', [AssociateLoginController::class, 'sign_in'])->name('associate.sign_in');
	});
	Route::get('/sign-up', [AssociateRegistrationController::class, 'index'])->name('associate.sign_up');
	Route::post('/sign-up', [AssociateRegistrationController::class, 'store'])->name('associate.register');
	Route::post('/verify-cotp', [AssociateRegistrationController::class, 'verify_otp'])->name('associate.verify_otp');
	Route::get('/resend-cotp', [AssociateRegistrationController::class, 'resend_otp'])->name('associate.resend_otp');
});




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
		//customer
		Route::prefix('customers')->group(function () {
			Route::get('/index', 			[CustomerController::class, 'index'])->name('customer.index');
			Route::get('/account_status_update', 	[CustomerController::class, 'account_status_update'])->name('customer.account_status_update');
		});
		//Employee
		Route::prefix('employee')->group(function () {
			Route::get('/index', 			[EmployeeListController::class, 'index'])->name('employee.index');
			Route::get('/account_status_update', 	[EmployeeListController::class, 'account_status_update'])->name('employee.account_status_update');
		});
		//Associate
		Route::prefix('associate')->group(function () {
			Route::get('/index', 			[AssociateListController::class, 'index'])->name('associate.index');
			Route::get('/account_status_update', 	[AssociateListController::class, 'account_status_update'])->name('associate.account_status_update');
		});
		//partneragent
		Route::prefix('partneragent')->group(function () {
			Route::get('/index', 			[PartnerAgentListController::class, 'index'])->name('partneragent.index');
			Route::get('/account_status_update', 	[PartnerAgentListController::class, 'account_status_update'])->name('partneragent.account_status_update');
		});
		//hotelpartner
		Route::prefix('hotelpartner')->group(function () {
			Route::get('/index', 			[HotelPartnerListController::class, 'index'])->name('hotelpartner.index');
			Route::get('/account_status_update', 	[HotelPartnerListController::class, 'account_status_update'])->name('hotelpartner.account_status_update');
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
