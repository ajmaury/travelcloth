<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\{HomeController,QuoteController,CustomerControler,PartnerAgentController,EmployeeController,HotelPartnerController,
	AssociateController};
use App\Http\Controllers\Frontend\CustomerAuth\{CustomerLoginController,CustomerRegistrationController,CForgotPasswordController,CChangePasswordController};
use App\Http\Controllers\Frontend\PartnerAgentAuth\{PartnerAgentLoginController,PartnerAgentRegistrationController,PForgotPasswordController,PChangePasswordController};
use App\Http\Controllers\Frontend\EmployeeAuth\{EmployeeLoginController,EmployeeRegistrationController,EForgotPasswordController,EChangePasswordController};
use App\Http\Controllers\Frontend\HotelPartnerAuth\{HotelPartnerLoginController,HotelPartnerRegistrationController,HForgotPasswordController,HChangePasswordController};
use App\Http\Controllers\Frontend\AssociateAuth\{AssociateLoginController,AssociateRegistrationController,AForgotPasswordController,AChangePasswordController};
use App\Http\Controllers\Auth\{LoginController,ForgotPasswordController};
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Admin\{DashboardController,CountryController,StateController,CityController,ZoneController,LogisticController,
	UserController,CustomerListController,PriceController,EmployeeListController,AssociateListController,PartnerAgentListController,
	HotelPartnerListController,RoleController,PermissionController,SettingController,CMSCategoryController,PincodeController};

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
//quote
Route::post('/quote', [QuoteController::class, 'quote_gen'])->name('quote_gen');
Route::get('/quote-result', [QuoteController::class, 'quote_result'])->name('quote_result');
//customer
Route::group(['middleware' => ['customer.auth']], function () {
	Route::get('/logout',[CustomerLoginController::class, 'logout'])->name('customer.logout');
	Route::get('/my-account', [CustomerControler::class, 'my_account'])->name('customer.my_account');
	Route::get('/quote', [CustomerControler::class, 'quote'])->name('customer.quote');
	Route::get('/profile', [CustomerControler::class, 'profile'])->name('customer.profile');
	Route::get('/delete-profile-image', [CustomerControler::class, 'deleteImage'])->name('customer.deleteImage');
	Route::get('/delete-kyc-doc', [CustomerControler::class, 'deleteKycDoc'])->name('customer.deletekycdoc');
	Route::get('/address', [CustomerControler::class, 'address'])->name('customer.address');
	Route::get('/kyc', [CustomerControler::class, 'kyc'])->name('customer.kyc');
	Route::get('/change-password', [CChangePasswordController::class, 'changePass'])->name('customer.changePass');
	Route::post('/state-list', [CustomerControler::class, 'getstate'])->name('customer.getstate');
	Route::post('/city-list', [CustomerControler::class, 'getcity'])->name('customer.getcity');
	Route::get('/change-mobile-number', [CustomerControler::class, 'changemobile'])->name('customer.changemobile');
	Route::get('/verify-number', [CustomerControler::class, 'verifyno'])->name('customer.verifyno');
	Route::post('/verifyotp', [CustomerControler::class, 'verifymobileotp'])->name('customer.verify_mobile_otp');
	Route::post('/verifykycotp', [CustomerControler::class, 'verify_kyc_mobile_otp'])->name('customer.verify_kyc_mobile_otp');
	Route::get('/kyc-update', [CustomerControler::class, 'kyc_update'])->name('customer.kyc.update');
	Route::group(['middleware' => ['customer.mobile_check']], function () {
		Route::get('/order', [CustomerControler::class, 'order'])->name('customer.order');
		Route::post('/profile', [CustomerControler::class, 'postProfile'])->name('customer.profile.post');
		Route::post('/address', [CustomerControler::class, 'postAddress'])->name('customer.address.post');
		Route::post('/kyc', [CustomerControler::class, 'postkyc'])->name('customer.kyc.post');
		Route::post('/update-password', [CChangePasswordController::class, 'postChangePass'])->name('customer.changePass.post');
		Route::post('/kycupdate', [CustomerControler::class, 'postkycupdate'])->name('customer.kyc.update.post');
	});
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
		Route::get('/profile', [PartnerAgentController::class, 'profile'])->name('partneragent.profile');
		Route::get('/delete-profile-image', [PartnerAgentController::class, 'deleteImage'])->name('partneragent.deleteImage');
		Route::get('/delete-kyc-doc', [PartnerAgentController::class, 'deleteKycDoc'])->name('partneragent.deletekycdoc');
		Route::get('/address', [PartnerAgentController::class, 'address'])->name('partneragent.address');		
		Route::get('/kyc', [PartnerAgentController::class, 'kyc'])->name('partneragent.kyc');		
		Route::get('/change-password', [PChangePasswordController::class, 'changePass'])->name('partneragent.changePass');
		Route::post('/state-list', [PartnerAgentController::class, 'getstate'])->name('partneragent.getstate');
		Route::post('/city-list', [PartnerAgentController::class, 'getcity'])->name('partneragent.getcity');
		Route::get('/change-mobile-number', [PartnerAgentController::class, 'changemobile'])->name('partneragent.changemobile');
		Route::post('/verifykycotp', [PartnerAgentController::class, 'verify_kyc_mobile_otp'])->name('partneragent.verify_kyc_mobile_otp');
		Route::get('/kyc-update', [PartnerAgentController::class, 'kyc_update'])->name('partneragent.kyc.update');
		Route::get('/verify-number', [PartnerAgentController::class, 'verifyno'])->name('partneragent.verifyno');
		Route::post('/verifyotp', [PartnerAgentController::class, 'verifymobileotp'])->name('partneragent.verify_mobile_otp');
		
		Route::group(['middleware' => ['partneragent.mobile_check']], function () {
			Route::get('/order', [PartnerAgentController::class, 'order'])->name('partneragent.order');
			Route::get('/add-refer', [PartnerAgentController::class, 'add_refer'])->name('partneragent.add_refer');
			Route::get('/refer', [PartnerAgentController::class, 'refer'])->name('partneragent.refer');
			Route::post('/profile', [PartnerAgentController::class, 'postProfile'])->name('partneragent.profile.post');
			Route::post('/address', [PartnerAgentController::class, 'postAddress'])->name('partneragent.address.post');
			Route::post('/kyc', [PartnerAgentController::class, 'postkyc'])->name('partneragent.kyc.post');
			Route::post('/update-password', [PChangePasswordController::class, 'postChangePass'])->name('partneragent.changePass.post');
			Route::post('/kycupdate', [PartnerAgentController::class, 'postkycupdate'])->name('partneragent.kyc.update.post');
		});
	});
	Route::group(['middleware' => 'partneragent.guest'], function () {
		Route::get('/sign-in', [PartnerAgentLoginController::class, 'sign_in'])->name('partneragent.sign_in');
		Route::post('/sign-in',[PartnerAgentLoginController::class, 'login_go'])->name('partneragent.login_go');
	});
});
//hotelpartner
Route::prefix('hotelpartner')->group(function () {
	Route::group(['middleware' => ['hotelpartner.auth']], function () {
		Route::get('/logout',[HotelPartnerLoginController::class, 'logout'])->name('hotelpartner.logout');
		Route::get('', [HotelPartnerController::class, 'my_account'])->name('hotelpartner.my_account');
		Route::get('/profile', [HotelPartnerController::class, 'profile'])->name('hotelpartner.profile');
		Route::get('/delete-profile-image', [HotelPartnerController::class, 'deleteImage'])->name('hotelpartner.deleteImage');
		Route::get('/delete-kyc-doc', [HotelPartnerController::class, 'deleteKycDoc'])->name('hotelpartner.deletekycdoc');
		Route::get('/address', [HotelPartnerController::class, 'address'])->name('hotelpartner.address');
		Route::get('/kyc', [HotelPartnerController::class, 'kyc'])->name('hotelpartner.kyc');
		Route::get('/change-password', [HChangePasswordController::class, 'changePass'])->name('hotelpartner.changePass');
		Route::post('/state-list', [HotelPartnerController::class, 'getstate'])->name('hotelpartner.getstate');
		Route::post('/city-list', [HotelPartnerController::class, 'getcity'])->name('hotelpartner.getcity');
		Route::get('/change-mobile-number', [HotelPartnerController::class, 'changemobile'])->name('hotelpartner.changemobile');
		Route::get('/verify-number', [HotelPartnerController::class, 'verifyno'])->name('hotelpartner.verifyno');
		Route::post('/verifyotp', [HotelPartnerController::class, 'verifymobileotp'])->name('hotelpartner.verify_mobile_otp');
		Route::post('/verifykycotp', [HotelPartnerController::class, 'verify_kyc_mobile_otp'])->name('hotelpartner.verify_kyc_mobile_otp');
		Route::get('/kyc-update', [HotelPartnerController::class, 'kyc_update'])->name('hotelpartner.kyc.update');
		
		Route::group(['middleware' => ['hotelpartner.mobile_check']], function () {
			Route::get('/order', [HotelPartnerController::class, 'order'])->name('hotelpartner.order');
			Route::get('/refer', [HotelPartnerController::class, 'refer'])->name('hotelpartner.refer');
			Route::get('/add-refer', [HotelPartnerController::class, 'add_refer'])->name('hotelpartner.add_refer');
			Route::post('/profile', [HotelPartnerController::class, 'postProfile'])->name('hotelpartner.profile.post');
			Route::post('/address', [HotelPartnerController::class, 'postAddress'])->name('hotelpartner.address.post');
			Route::post('/kyc', [HotelPartnerController::class, 'postkyc'])->name('hotelpartner.kyc.post');
			Route::post('/update-password', [HChangePasswordController::class, 'postChangePass'])->name('hotelpartner.changePass.post');
			Route::post('/kycupdate', [HotelPartnerController::class, 'postkycupdate'])->name('hotelpartner.kyc.update.post');
		});
	});
	Route::group(['middleware' => 'hotelpartner.guest'], function () {
		Route::get('/sign-in', [HotelPartnerLoginController::class, 'sign_in'])->name('hotelpartner.sign_in');
		Route::post('/sign-in',[HotelPartnerLoginController::class, 'login_go'])->name('hotelpartner.login_go');
	});
});

//Associate
Route::prefix('associate')->group(function () {
	Route::group(['middleware' => ['associate.auth']], function () {
		Route::get('/logout',[AssociateLoginController::class, 'logout'])->name('associate.logout');
		Route::get('', [AssociateController::class, 'my_account'])->name('associate.my_account');
		Route::get('/profile', [AssociateController::class, 'profile'])->name('associate.profile');
		Route::get('/address', [AssociateController::class, 'address'])->name('associate.address');
		Route::get('/kyc', [AssociateController::class, 'kyc'])->name('associate.kyc');
		Route::get('/change-password', [AChangePasswordController::class, 'changePass'])->name('associate.changePass');
		Route::post('/state-list', [AssociateController::class, 'getstate'])->name('associate.getstate');
		Route::post('/city-list', [AssociateController::class, 'getcity'])->name('associate.getcity');
		Route::get('/change-mobile-number', [AssociateController::class, 'changemobile'])->name('associate.changemobile');
		Route::get('/verify-number', [AssociateController::class, 'verifyno'])->name('associate.verifyno');
		Route::get('/kyc-update', [AssociateController::class, 'kyc_update'])->name('associate.kyc.update');
		Route::post('/verifykycotp', [AssociateController::class, 'verify_kyc_mobile_otp'])->name('associate.verify_kyc_mobile_otp');
		Route::post('/verifyotp', [AssociateController::class, 'verifymobileotp'])->name('associate.verify_mobile_otp');
		Route::get('/delete-profile-image', [AssociateController::class, 'deleteImage'])->name('associate.deleteImage');
		Route::get('/delete-kyc-doc', [AssociateController::class, 'deleteKycDoc'])->name('associate.deletekycdoc');
		Route::group(['middleware' => ['associate.mobile_check']], function () {
			Route::get('/order', [AssociateController::class, 'order'])->name('associate.order');
			Route::get('/refer', [AssociateController::class, 'refer'])->name('associate.refer');
			Route::get('/add-refer', [AssociateController::class, 'add_refer'])->name('associate.add_refer');
			Route::post('/profile', [AssociateController::class, 'postProfile'])->name('associate.profile.post');
			Route::post('/address', [AssociateController::class, 'postAddress'])->name('associate.address.post');
			Route::post('/kyc', [AssociateController::class, 'postkyc'])->name('associate.kyc.post');
			Route::post('/update-password', [AChangePasswordController::class, 'postChangePass'])->name('associate.changePass.post');
			Route::post('/kycupdate', [AssociateController::class, 'postkycupdate'])->name('associate.kyc.update.post');
		});
	});
	Route::group(['middleware' => 'associate.guest'], function () {
		Route::post('/sign-in', [AssociateLoginController::class, 'login_go'])->name('associate.login_go');
		Route::get('/sign-in', [AssociateLoginController::class, 'sign_in'])->name('associate.sign_in');
	});
	
});
//Customer forgot password
Route::get('customer-forget-password', [CForgotPasswordController::class, 'showForgetPasswordForm'])->name('customer.forget.password.get');
Route::post('customer-forget-password',[CForgotPasswordController::class, 'submitForgetPasswordForm'])->name('customer.forget.password.post');
Route::post('customer-verify-otp', 	[CForgotPasswordController::class, 'verify_otp'])->name('customer.verify.password');
Route::post('customer-set-password', 	[CForgotPasswordController::class, 'set_password'])->name('customer.set.password');
Route::get('customer-resend-password', 	[CForgotPasswordController::class, 'resend_password'])->name('customer.resend.otp');
//Employee forgot password
Route::get('employee/forget-password', [EForgotPasswordController::class, 'showForgetPasswordForm'])->name('employee.forget.password.get');
Route::post('employee/forget-password',[EForgotPasswordController::class, 'submitForgetPasswordForm'])->name('employee.forget.password.post');
Route::post('employee/verify-otp', 	[EForgotPasswordController::class, 'verify_otp'])->name('employee.verify.password');
Route::post('employee/set-password', 	[EForgotPasswordController::class, 'set_password'])->name('employee.set.password');
Route::get('employee/resend-password', 	[EForgotPasswordController::class, 'resend_password'])->name('employee.resend.otp');
//Associate forgot password
Route::get('associate/forget-password', [AForgotPasswordController::class, 'showForgetPasswordForm'])->name('associate.forget.password.get');
Route::post('associate/forget-password',[AForgotPasswordController::class, 'submitForgetPasswordForm'])->name('associate.forget.password.post');
Route::post('associate/verify-otp', 	[AForgotPasswordController::class, 'verify_otp'])->name('associate.verify.password');
Route::post('associate/set-password', 	[AForgotPasswordController::class, 'set_password'])->name('associate.set.password');
Route::get('associate/resend-password', [AForgotPasswordController::class, 'resend_password'])->name('associate.resend.otp');
//Partner Agent forgot password
Route::get('partneragent/forget-password', [PForgotPasswordController::class, 'showForgetPasswordForm'])->name('partneragent.forget.password.get');
Route::post('partneragent/forget-password',[PForgotPasswordController::class, 'submitForgetPasswordForm'])->name('partneragent.forget.password.post');
Route::post('partneragent/verify-otp', 	[PForgotPasswordController::class, 'verify_otp'])->name('partneragent.verify.password');
Route::post('partneragent/set-password', 	[PForgotPasswordController::class, 'set_password'])->name('partneragent.set.password');
Route::get('partneragent/resend-password', [PForgotPasswordController::class, 'resend_password'])->name('partneragent.resend.otp');
//Hotel Partner forgot password
Route::get('hotelpartner/forget-password', [HForgotPasswordController::class, 'showForgetPasswordForm'])->name('hotelpartner.forget.password.get');
Route::post('hotelpartner/forget-password',[HForgotPasswordController::class, 'submitForgetPasswordForm'])->name('hotelpartner.forget.password.post');
Route::post('hotelpartner/verify-otp', 	[HForgotPasswordController::class, 'verify_otp'])->name('hotelpartner.verify.password');
Route::post('hotelpartner/set-password', 	[HForgotPasswordController::class, 'set_password'])->name('hotelpartner.set.password');
Route::get('hotelpartner/resend-password', [HForgotPasswordController::class, 'resend_password'])->name('hotelpartner.resend.otp');

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
		Route::get('/quotes', 			[DashboardController::class, 'quotes'])->name('quotes');
		Route::get('file-upload', [UploadFileController::class, 'fileUpload'])->name('file.upload');
		Route::post('file-upload', [UploadFileController::class, 'fileUploadPost'])->name('file.upload.post');	
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
		// Logistic
		Route::prefix('logistic')->group(function () {
			Route::get('/index', 			[LogisticController::class, 'index'])->name('logistic.index');
			Route::get('/create', 			[LogisticController::class, 'create'])->name('logistic.create');
			Route::post('/store', 			[LogisticController::class, 'store'])->name('logistic.store');
			Route::get('/edit/{id}', 		[LogisticController::class, 'edit'])->name('logistic.edit');
			Route::post('/update/{id}', 	[LogisticController::class, 'update'])->name('logistic.update');
			Route::post('/destroy', 		[LogisticController::class, 'destroy'])->name('logistic.destroy');
			Route::get('/status_update', 	[LogisticController::class, 'status_update'])->name('logistic.status_update');
			Route::get('/view', 	[LogisticController::class, 'view'])->name('logistic.view');
		});
		// State
		Route::prefix('states')->group(function () {
			Route::get('/index', 			[StateController::class, 'index'])->name('states.index');
			Route::get('/create', 			[StateController::class, 'create'])->name('states.create');
			Route::post('/store', 			[StateController::class, 'store'])->name('states.store');
			Route::get('/edit/{id}', 		[StateController::class, 'edit'])->name('states.edit');
			Route::post('/update/{id}', 	[StateController::class, 'update'])->name('states.update');
			Route::post('/destroy', 		[StateController::class, 'destroy'])->name('states.destroy');
			Route::get('/export-state', 	[StateController::class, 'exportState'])->name('states.export');
			Route::post('/import-state', 	[StateController::class, 'importState'])->name('states.import');
		});
		// Country
		Route::prefix('country')->group(function () {
			Route::get('/index', 			[CountryController::class, 'index'])->name('country.index');
			Route::get('/create', 			[CountryController::class, 'create'])->name('country.create');
			Route::post('/store', 			[CountryController::class, 'store'])->name('country.store');
			Route::get('/edit/{id}', 		[CountryController::class, 'edit'])->name('country.edit');
			Route::post('/update/{id}', 	[CountryController::class, 'update'])->name('country.update');
			Route::post('/destroy', 		[CountryController::class, 'destroy'])->name('country.destroy');
		});
		// ZOne
		Route::prefix('zones')->group(function () {
			Route::get('/index', 			[ZoneController::class, 'index'])->name('zones.index');
			Route::get('/create', 			[ZoneController::class, 'create'])->name('zones.create');
			Route::post('/store', 			[ZoneController::class, 'store'])->name('zones.store');
			Route::get('/edit/{id}', 		[ZoneController::class, 'edit'])->name('zones.edit');
			Route::post('/update/{id}', 	[ZoneController::class, 'update'])->name('zones.update');
			Route::post('/destroy', 		[ZoneController::class, 'destroy'])->name('zones.destroy');
		});
		//city
		Route::prefix('citys')->group(function () {
			Route::get('/index', 			[CityController::class, 'index'])->name('citys.index');
			Route::get('/create', 			[CityController::class, 'create'])->name('citys.create');
			Route::post('/store', 			[CityController::class, 'store'])->name('citys.store');
			Route::get('/edit/{id}', 		[CityController::class, 'edit'])->name('citys.edit');
			Route::post('/update/{id}', 	[CityController::class, 'update'])->name('citys.update');
			Route::post('/destroy', 		[CityController::class, 'destroy'])->name('citys.destroy');
			Route::get('/status_update', 	[CityController::class, 'status_update'])->name('citys.status_update');
			Route::get('/export-city', 	    [CityController::class, 'exportCity'])->name('citys.export');
			Route::post('/import-city', 	[CityController::class, 'importCity'])->name('citys.import');
		});
		//Pincode
		Route::prefix('pincode')->group(function () {
			Route::get('/index', 			[PincodeController::class, 'index'])->name('pincode.index');
			Route::get('/create', 			[PincodeController::class, 'create'])->name('pincode.create');
			Route::post('/store', 			[PincodeController::class, 'store'])->name('pincode.store');
			Route::get('/edit/{id}', 		[PincodeController::class, 'edit'])->name('pincode.edit');
			Route::post('/update/{id}', 	[PincodeController::class, 'update'])->name('pincode.update');
			Route::post('/destroy', 		[PincodeController::class, 'destroy'])->name('pincode.destroy');
			Route::get('/export-pincode', 	[PincodeController::class, 'export'])->name('pincode.export');
			Route::post('/import-pincode', 	[PincodeController::class, 'import'])->name('pincode.import');
		});
		//customer
		Route::prefix('customers')->group(function () {
			Route::get('/index', [CustomerListController::class, 'index'])->name('customer.index');
			Route::get('/account_status_update', 	[CustomerListController::class, 'account_status_update'])->name('customer.account_status_update');
			Route::get('/signup', [CustomerListController::class, 'create'])->name('customer.create');
			Route::post('/signup', [CustomerListController::class, 'store'])->name('customer.registers');
			Route::get('/view', [CustomerListController::class, 'view'])->name('customer.adminview');
			Route::get('/change_kyc_status',[CustomerListController::class, 'change_kyc_status'])->name('customer.change_kyc_status');
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
			Route::get('/sign-up', [AssociateListController::class, 'create'])->name('associate.sign_up');
			Route::post('/sign-up', [AssociateListController::class, 'store'])->name('associate.register');
			Route::get('/view', [AssociateListController::class, 'view'])->name('associate.adminview');
			Route::get('/change_kyc_status',[AssociateListController::class, 'change_kyc_status'])->name('associate.change_kyc_status');
		});
		//partneragent
		Route::prefix('partneragent')->group(function () {
			Route::get('/index', 			[PartnerAgentListController::class, 'index'])->name('partneragent.index');
			Route::get('/account_status_update', 	[PartnerAgentListController::class, 'account_status_update'])->name('partneragent.account_status_update');
			Route::get('/sign-up', [PartnerAgentListController::class, 'create'])->name('partneragent.sign_up');
			Route::post('/sign-up', [PartnerAgentListController::class, 'store'])->name('partneragent.register');
			Route::get('/view', [PartnerAgentListController::class, 'view'])->name('partneragent.adminview');
			Route::get('/change_kyc_status',[PartnerAgentListController::class, 'change_kyc_status'])->name('partneragent.change_kyc_status');
		});
		//hotelpartner
		Route::prefix('hotelpartner')->group(function () {
			Route::get('/index', 			[HotelPartnerListController::class, 'index'])->name('hotelpartner.index');
			Route::get('/account_status_update', 	[HotelPartnerListController::class, 'account_status_update'])->name('hotelpartner.account_status_update');
			Route::get('/sign-up', [HotelPartnerListController::class, 'create'])->name('hotelpartner.sign_up');
			Route::post('/sign-up', [HotelPartnerListController::class, 'store'])->name('hotelpartner.register');
			Route::get('/view', [HotelPartnerListController::class, 'view'])->name('hotelpartner.adminview');
			Route::get('/change_kyc_status',[HotelPartnerListController::class, 'change_kyc_status'])->name('hotelpartner.change_kyc_status');
		});
		//price
		Route::prefix('price')->group(function () {
			Route::get('/index', [PriceController::class, 'index'])->name('price.index');
			Route::get('/add-price', [PriceController::class, 'create'])->name('price.create');
			Route::post('/add-price', [PriceController::class, 'store'])->name('price.insert');
			Route::get('/edit-price', [PriceController::class, 'edit'])->name('price.edit');
			Route::post('/update-price', [PriceController::class, 'update'])->name('price.update');
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
