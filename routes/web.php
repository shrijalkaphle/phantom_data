<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AdminController;


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


Route::get('/term-and-conditions', function () {
    return view('Policy.termConditons'); 
})->name('term-and-conditions');

Route::get('payment', [PaymentController::class, 'handleGet'])->name('payment.get');
Route::post('payment', [PaymentController::class, 'handleSubscription'])->name('payment.post');



Route::post('manuall-payment', [PaymentController::class, 'handlePost'])->name('manuall-payment');
Route::post('/create-checkout-session', [PaymentController::class, 'processPayment'])->name('create-checkout-session');
Route::get('/subscription-success', [PaymentController::class, 'subscriptionSuccess'])->name('subscription.success');
Route::get('/subscription-cancel', [PaymentController::class, 'subscriptionCancel'])->name('subscription.cancel');
Route::post('/cancelSubscription', [PaymentController::class, 'cancelSubscription'])->name('cancelSubscription');



Route::get('/account-setting/{user_id}', [AccountController::class, 'AccountSettingView'])->name('account-setting');
Route::post('/verify-email', [AccountController::class, 'verifyEmail'])->name('verify-email');
Route::get('/password-update/{user_id}', [AccountController::class, 'passwordUpdateView'])->name('password-update');
Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('update-password');
Route::post('/update-account-setting', [AccountController::class, 'updateAccountSetting'])->name('update-account-setting');

Route::get('/userTotalCredits', [ProfileController::class, 'userTotalCredits'])->name('userTotalCredits');
Route::get('/getUserLatestTransaction', [ProfileController::class, 'getUserLatestTransaction'])->name('getUserLatestTransaction');
Route::get('/getUserFileNumber', [ProfileController::class, 'getUserFileNumber'])->name('getUserFileNumber');
Route::get('/getUserDetails', [ProfileController::class, 'getUserDetails'])->name('getUserDetails');

Route::get('/dashboard', [ProfileController::class, 'dashboardView'])->name('dashboard');
Route::get('/how-to-use', [ProfileController::class, 'howToUseView'])->name('how-to-use');
Route::get('/purchase-more/{user_id}', [ProfileController::class, 'purchaseMoreView'])->name('purchase-more');
Route::get('/purchase-history', [ProfileController::class, 'purchaseHistoryView'])->name('purchase-history');
Route::get('/getData', [ProfileController::class, 'getData'])->middleware(['auth'])->name('getData');
Route::get('/getTransactionData/{email}', [ProfileController::class, 'getTransactionData'])->name('getTransactionData');
Route::get('/profile-update/{user_id}', [ProfileController::class, 'ProfileUpdateView'])->name('profile-update');
Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
Route::post('/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('upload.avatar');
Route::post('/remove-avatar/{user_id}', [ProfileController::class, 'removeAvatar'])->name('remove.avatar');

Route::post('/set-properties', [ProfileController::class, 'setProperties'])->name('set.properties');
//Route::post('/sendPropertyData', [ProfileController::class, 'sendPropertyData'])->middleware(['auth'])->name('sendPropertyData');
Route::post('/upload-property-data', [PropertyController::class, 'sendPropertyData'])->name('upload-property-data');
Route::get('/my-properties/{user_id}', [PropertyController::class, 'myProperties'])->name('my-properties');
Route::get('/getPropertiesData', [PropertyController::class, 'getPropertiesData'])->name('getPropertiesData');
Route::post('/request-property-data', [PropertyController::class, 'requestPropertyData'])->name('request-property-data');



Route::get('/export-properties-csv', [PropertyController::class, 'exportPropertiesCsv'])->name('export-properties-csv');
Route::post('/export-current-properties', [PropertyController::class, 'exportCurrentProperties'])->name('export-current-properties');
Route::get('/export-csv-by-date', [PropertyController::class, 'exportCsvByDate'])->name('export-csv-by-date');


Route::post('/verify-coupon', [CouponController::class, 'verifyCoupon'])->name('verify-coupon');

Route::get('/stream-video', function (Request $request) {
    $videoPath = $request->get('video');
    return response()->file(storage_path('app/public/videos/' . $videoPath));
})->middleware('stream.video');



require __DIR__.'/auth.php';

Route::get('/admin/dashboard', [AdminController::class, 'adminDashboardView'])->middleware(['auth:admin'])->name('admin.dashboard');
Route::get('/admin/users-list', [AdminController::class, 'usersListView'])->middleware(['auth:admin'])->name('admin.users-list');
Route::post('/admin/add-user', [AdminController::class, 'addUser'])->middleware(['auth:admin'])->name('admin.add-user');
Route::get('/admin/transaction-list', [AdminController::class, 'transactionListView'])->middleware(['auth:admin'])->name('admin.transaction-list');
Route::get('/admin/properties-list', [AdminController::class, 'propertiesListView'])->middleware(['auth:admin'])->name('admin.properties-list');
Route::get('/admin/coupons-list', [AdminController::class, 'couponsListView'])->middleware(['auth:admin'])->name('admin.coupons-list');
Route::get('/admin/get-users-data', [AdminController::class, 'getUserData'])->middleware(['auth:admin'])->name('get-users-data');
Route::get('/admin/get-properties-data', [AdminController::class, 'getPropertiesData'])->middleware(['auth:admin'])->name('get-properties-data');
Route::get('/admin/get-transactions-data', [AdminController::class, 'getTransactionData'])->middleware(['auth:admin'])->name('get-transactions-data');
Route::get('/admin/get-coupons-data', [AdminController::class, 'getCouponsData'])->middleware(['auth:admin'])->name('get-coupons-data');
Route::get('/admin/get-user-properties/{user_id}', [AdminController::class, 'getUserProperties'])->middleware(['auth:admin'])->name('get-user-properties');
Route::get('/admin/hide-coupon/{coupon_id}', [AdminController::class, 'hideCoupon'])->middleware(['auth:admin'])->name('hide-coupon');
Route::get('/admin/show-coupon/{coupon_id}', [AdminController::class, 'showCoupon'])->middleware(['auth:admin'])->name('show-coupon');
Route::post('/admin/save-coupon', [AdminController::class, 'saveCoupon'])->middleware(['auth:admin'])->name('admin.save-coupon');
Route::post('/admin/update-credits', [AdminController::class, 'updateCredits'])->middleware(['auth:admin'])->name('admin.update-credits');
Route::get('/admin/get-user-info', [AdminController::class, 'getUserInfo'])->middleware(['auth:admin'])->name('admin.get-user-info');
Route::post('/admin/update-user-info', [AdminController::class, 'updateUserInfo'])->middleware(['auth:admin'])->name('admin.update-user-info');



require __DIR__.'/adminauth.php';



Route::get('/user/dashboard', function () { return view('User.dashboard.dashboard'); })->name('user.dashboard');
Route::get('/user/profile', function () { return view('User.dashboard.profile'); })->name('user.profile');
Route::get('/user/setting', function () { return view('User.dashboard.setting'); })->name('user.setting');