<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderReviewController;
use App\Http\Controllers\AnalysisChartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataExportImportController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersReportController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialistsController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\UserActivitiesReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReviewController;
use App\Http\Controllers\UsersReportController;
use App\Http\Livewire\MessengerAdd;
use App\Http\Livewire\MessengerIndex;
use App\Http\Livewire\MessengerShow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('userproducts');
});

Route::get('/home', function () {
    return redirect()->route('userproducts');
})->name("home");

Auth::routes();

Route::get("logout", function () {
    Auth::logout();
    return redirect('products');
})->name("getlogout");

Route::prefix('facebook')->name('facebook.')->group(function () {
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});

Route::prefix('google')->name('google.')->group(function () {
    Route::get('auth', [GoogleController::class, 'loginUsingGoogle'])->name('login');
    Route::get('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

Route::prefix('twitter')->name('twitter.')->group(function () {
    Route::get('auth', [TwitterController::class, 'loginUsingTwitter'])->name('login');
    Route::get('callback', [TwitterController::class, 'callbackFromTwitter'])->name('callback');
});

Route::get('lang/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::group(['prefix' => 'admin', 'middleware' => 'role:Admin'], function () {
    Route::prefix('users_report')->name('users_report.')->group( function () {
        Route::get('', [UsersReportController::class, 'index'])->name('index');
        Route::get('email', [UsersReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [UsersReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [UsersReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('adminDashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('cookies', \App\Http\Controllers\CookieController::class);
    Route::resource('products', ProductController::class);
//    Route::resource('discounts', App\Http\Controllers\DiscountController::class);
//    Route::resource('discountCoupons', App\Http\Controllers\DiscountCouponController::class);
//    Route::resource('promotions', App\Http\Controllers\PromotionController::class);
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::resource('orders', App\Http\Controllers\OrderController::class);
    Route::resource('orderItems', App\Http\Controllers\OrderItemController::class);
    Route::resource('orderStatuses', App\Http\Controllers\OrderStatusController::class);
//    Route::resource('cartStatuses', App\Http\Controllers\CartStatusController::class);
//    Route::resource('returns', App\Http\Controllers\ReturnsController::class);
//    Route::resource('returnItems', App\Http\Controllers\ReturnItemController::class);
//    Route::resource('returnStatuses', App\Http\Controllers\ReturnStatusController::class);
//    Route::resource('carts', App\Http\Controllers\CartController::class);
//    Route::resource('cartItems', App\Http\Controllers\CartItemController::class);
//    Route::get('messenger', MessengerIndex::class)->name('livewire.messenger.index');
//    Route::get('messenger/add', MessengerAdd::class)->name('livewire.messenger.add');
//    Route::get('messenger/{id}', MessengerShow::class)->name('livewire.messenger.show');
    Route::get('invoice/{id}', [OrderController::class, 'invoicePreview'])->where('id', '[0-9]+')->name(('invoice'));
    Route::get('logs', [CustomerController::class, 'logs'])->name('customers.logs');
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::prefix('')->middleware('cors')->name('customers.')->group(function () {
        Route::get('statistics', [ChartController::class, 'index'])->name('statistics');
        Route::post('statistics', [ChartController::class, 'changeStatisticType'])->name('statistics');
    });
    Route::prefix('orders_report')->name('orders_report.')->group( function () {
        Route::get('', [OrdersReportController::class, 'index'])->name('index');
        Route::get('email', [OrdersReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [OrdersReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [OrdersReportController::class, 'downloadCsv'])->name('download_csv');
    });
//    Route::prefix('returns_report')->name('returns_report.')->group( function () {
//        Route::get('', [ReturnsReportController::class, 'index'])->name('index');
//        Route::get('email', [ReturnsReportController::class, 'sendEmail'])->name('email');
//        Route::get('download_pdf', [ReturnsReportController::class, 'downloadPdf'])->name('download_pdf');
//        Route::get('download_csv', [ReturnsReportController::class, 'downloadCsv'])->name('download_csv');
//    });
//    Route::prefix('carts_report')->name('carts_report.')->group( function () {
//        Route::get('', [CartsReportController::class, 'index'])->name('index');
//        Route::get('email', [CartsReportController::class, 'sendEmail'])->name('email');
//        Route::get('download_pdf', [CartsReportController::class, 'downloadPdf'])->name('download_pdf');
//        Route::get('download_csv', [CartsReportController::class, 'downloadCsv'])->name('download_csv');
//    });
    Route::prefix('users_report')->name('users_report.')->group( function () {
        Route::get('', [UsersReportController::class, 'index'])->name('index');
        Route::get('email', [UsersReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [UsersReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [UsersReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::prefix('user_activities_report')->name('user_activities_report.')->group( function () {
        Route::get('', [UserActivitiesReportController::class, 'index'])->name('index');
        Route::get('email', [UserActivitiesReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [UserActivitiesReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [UserActivitiesReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::get('data_export_import', [DataExportImportController::class, 'index'])->name('data_export_import.index');
    Route::get('data_export_import/export', [DataExportImportController::class, 'export'])->name('data_export_import.export');
    Route::post('data_export_import/import', [DataExportImportController::class, 'import'])->name('data_export_import.import');
    Route::get('analysis_chart', [AnalysisChartController::class, 'index'])->name('analysisChart');
    Route::resource('skills', \App\Http\Controllers\SkillsController::class);
    Route::get('customers/{id}/add_skill', [CustomerController::class, 'addSkill'])->name('adminAddSkill');
    Route::post('customers/{id}/add_skill', [CustomerController::class, 'saveAddedSkill'])->name('adminSaveAddedSkill');
    Route::delete('customers/{id}/remove_skill', [CustomerController::class, 'removeSkill'])->name('adminRemoveSkill');
    Route::resource('orderQuestions', \App\Http\Controllers\OrderQuestionController::class)->except(['show']);
    Route::resource('orderPriorities', \App\Http\Controllers\OrderPriorityController::class);
    Route::get('orders/{orderId}/add_specialist', [OrderController::class, 'adminAddOrderSpecialist'])
        ->name('adminAddOrderSpecialist');
    Route::post('orders/{orderId}/add_specialist', [OrderController::class, 'adminAddOrderSpecialistSave'])
        ->name('adminAddOrderSpecialistSave');
    Route::post('orders/{id}/update_specialists', [OrderController::class, 'adminUpdateOrderSpecialists'])
        ->name('adminUpdateOrderSpecialists');
    Route::delete('orders/delete_specialist/{id}', [OrderController::class, 'adminDeleteOrderSpecialist'])
        ->name('adminDeleteOrderSpecialist');
});

Route::group(['prefix' => 'specialist', 'middleware' => ['role:Specialist', 'cookie-consent']], function () {
    Route::get('orders', [\App\Http\Controllers\Specialist\OrderController::class, 'index'])
        ->name('specialistOrders');
    Route::get('orders/{id}', [\App\Http\Controllers\Specialist\OrderController::class, 'show'])
        ->name('specialistOrderDetails');
    Route::post('orders/{id}/add_hours', [\App\Http\Controllers\Specialist\OrderController::class, 'addHours'])
        ->name('specialistOrderAddHours');
//    Route::post('orders/{id}', [App\Http\Controllers\Specialist\OrderController::class, 'update'])
//        ->name('specialistOrderUpdate');
//    Route::get('returns', [App\Http\Controllers\Specialist\ReturnController::class, 'index'])
//        ->name('specialistReturns');
//    Route::get('returns/{id}', [App\Http\Controllers\Specialist\ReturnController::class, 'show'])
//        ->name('specialistReturnDetails');
//    Route::post('returns/{id}', [App\Http\Controllers\Specialist\ReturnController::class, 'update'])
//        ->name('specialistReturnUpdate');
    Route::post('userprofile/add_skills', [UserController::class, 'addSkill'])
        ->name('addSkill');
    Route::delete('userprofile/{id}/remove_skill', [UserController::class, 'removeSkill'])
        ->name('removeSkill');
});

Route::group(['prefix' => 'employee', 'middleware' => ['role:Employee', 'cookie-consent']], function () {
    Route::get('orders', [App\Http\Controllers\Employee\OrderController::class, 'index'])
        ->name('employeeOrders');
    Route::get('orders/{id}', [App\Http\Controllers\Employee\OrderController::class, 'show'])
        ->name('employeeOrderDetails');
    Route::post('orders/{id}', [App\Http\Controllers\Employee\OrderController::class, 'update'])
        ->name('employeeOrderUpdate');
    Route::get('orders/{orderId}/add_specialist', [App\Http\Controllers\Employee\OrderController::class, 'addOrderSpecialist'])
        ->name('addOrderSpecialist');
    Route::post('orders/{orderId}/add_specialist', [App\Http\Controllers\Employee\OrderController::class, 'addOrderSpecialistSave'])
        ->name('addOrderSpecialistSave');
    Route::post('orders/{id}/update_specialists', [App\Http\Controllers\Employee\OrderController::class, 'updateOrderSpecialists'])
        ->name('updateOrderSpecialists');
    Route::delete('orders/delete_specialist/{id}', [App\Http\Controllers\Employee\OrderController::class, 'deleteOrderSpecialist'])
        ->name('deleteOrderSpecialist');
//    Route::get('returns', [App\Http\Controllers\Employee\ReturnController::class, 'index'])
//        ->name('employeeReturns');
//    Route::get('returns/{id}', [App\Http\Controllers\Employee\ReturnController::class, 'show'])
//        ->name('employeeReturnDetails');
//    Route::post('returns/{id}', [App\Http\Controllers\Employee\ReturnController::class, 'update'])
//        ->name('employeeReturnUpdate');
    Route::resource('product_panel', App\Http\Controllers\Employee\ProductPanelController::class);
    Route::patch('orders/{id}/generate_commerce_offer', [App\Http\Controllers\Employee\OrderController::class, 'generateCommerceOffer'])
        ->name('generateCommerceOffer');
});

Route::group(['prefix' => '{prefix}', 'middleware' => ['role:Admin,Specialist,Employee,Client', 'cookie-consent']], function () {
//    Route::get('discountCoupons', [\App\Http\Controllers\DiscountCouponController::class, 'discountcouponUser'])->name('discountCoupons');
//    Route::post('addtocart', [CartController::class, 'addToCart'])->name('addtocart');
    //Route::get('viewCarts', [\App\Models\Cart::class, 'viewAllCarts'])->name('viewallcarts');
//    Route::get('viewcart', [CartController::class, 'viewCart'])->name('viewcart');
//    Route::post('viewcart/update', [CartController::class, 'updateCart'])->name('updateCart');
//    Route::delete('cartItems/destroy/{id}', [\App\Http\Controllers\CartItemController::class, 'userCartItemDestroy'])->where('id', '[0-9]+')->name('userCartItemDestroy');
//    Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
//    Route::post('checkout/preview', [OrderController::class, 'checkoutPreview'])->name('checkout-preview');
//    Route::post('pay', [PayController::class, 'index'])->name('pay');
//    Route::get('pay/accept/{id}', [PayController::class, 'accept'])->where('id', '[0-9]+')->name('pay-accept');
//    Route::get('pay/cancel/{id}', [PayController::class, 'cancel'])->where('id', '[0-9]+')->name('pay-cancel');
//    Route::get('pay/callback/{id}', [PayController::class, 'callback'])->where('id', '[0-9]+')->name('pay-callback');
    //Route::get('viewOrders', [\App\Models\Order::class, 'viewAllOrders'])->name('viewallorders');
    Route::get('rootorders', [OrderController::class, 'indexOrders'])->name('rootorders');
//    Route::get('rootoreturns', [ReturnsController::class, 'indexReturns'])->name('rootoreturns');
    Route::get('vieworder/{id}', [OrderController::class, 'viewOrder'])->where('id', '[0-9]+')->name('vieworder');
    Route::get('download_invoice/{id}', [OrderController::class, 'downloadInvoicePdf'])->where('id', '[0-9]+')->name(('download_invoice'));
//    Route::get('viewreturn/{id}', [ReturnsController::class, 'viewReturn'])->where('id', '[0-9]+')->name('viewreturn');
    Route::get('cancelnorder/{id}', [\App\Http\Controllers\ReturnsController::class, 'cancelOrder'])->where('id', '[0-9]+')->name('cancelnorder');
//    Route::get('returnorder/{id}', [\App\Http\Controllers\ReturnsController::class, 'returnOrder'])->where('id', '[0-9]+')->name('returnorder');
//    Route::post('returnorder/{id}/save', [\App\Http\Controllers\ReturnsController::class, 'saveReturnOrder'])->where('id', '[0-9]+')->name('savereturnorder');
    Route::post('savecancelnorder/{id}/save', [\App\Http\Controllers\ReturnsController::class, 'saveCancelOrder'])->where('id', '[0-9]+')->name('savecancelnorder');
    Route::post('addUserRating', [\App\Http\Controllers\RatingsController::class, 'addUserRating'])->name('addUserRating');
    Route::get('userprofile', [UserController::class, 'show'])->name('userprofile');
    Route::patch('userprofilesave', [UserController::class, 'store'])->name('userprofilesave');
    Route::post('changePassword', [UserController::class, 'changePassword'])->name('changePassword');
    Route::patch('deleteAccount', [UserController::class, 'deleteAccount'])->name('deleteAccount');
//    Route::get('messenger', MessengerIndex::class)->name('livewire.messenger.index');
//    Route::get('messenger/add', MessengerAdd::class)->name('livewire.messenger.add');
//    Route::get('messenger/{id}', MessengerShow::class)->name('livewire.messenger.show');
    Route::get('{id}/reviews', [UserReviewController::class, 'show'])->name('userReviews');
    Route::post('{id}/reviews', [UserReviewController::class, 'store'])->name('postUserReview');
    Route::get('specialists', [SpecialistsController::class, 'index'])->name('specialists');
    Route::get('create_order', [OrderController::class, 'getCreateOpenOrder'])->name('getCreateOpenOrder');
    Route::get('create_order/{id}', [OrderController::class, 'getCreateOrder'])->name('getCreateOrder');
    Route::post('create_order', [OrderController::class, 'postCreateOrder'])->name('postCreateOrder');
    Route::patch('approve_order/{id}', [OrderController::class, 'approveOrder'])->name('approveOrder');
    Route::post('upload_document', [OrderController::class, 'uploadDocument'])->name('uploadDocument');
    Route::get('vieworder/{orderId}/download_document/{docId}', [OrderController::class, 'downloadDocument'])->name('downloadDocument');
    Route::get('vieworder/{id}/review', [OrderReviewController::class, 'getOrderReview'])->name('getOrderReview');
    Route::post('vieworder/{id}/review', [OrderReviewController::class, 'postOrderReview'])->name('postOrderReview');
    Route::post('create_defect_removal_act', [OrderController::class, 'createDefectRemovalAct'])->name('createDefectRemovalAct');
    Route::get('notifications/system', [NotificationController::class, 'systemNotifications'])->name('systemNotifications');
    Route::get('notifications/user', [NotificationController::class, 'userNotifications'])->name('userNotifications');
    Route::post('notifications/mark_as_read/{id}', [NotificationController::class, 'markAsRead'])->name('markAsReadNotification');
    Route::post('notifications/mark_all_as_read/{type}', [NotificationController::class, 'markAllAsRead'])->name('markAllAsReadNotifications');
    Route::delete('notifications/delete/{id}', [NotificationController::class, 'deleteNotification'])->name('deleteNotification');
    Route::patch('notifications/settings/delete_notifications', [NotificationController::class, 'deleteNotificationsSetting'])->name('deleteNotificationsSetting');
    Route::resource('messages', MessageController::class);
    Route::get('messages/{id}/reply', [MessageController::class, 'reply'])->name('reply');
    Route::get('messages/create/order_users', [MessageController::class, 'orderUsers'])->name('orderUsers');
    Route::post('messages/mark_as_read/{id}', [MessageController::class, 'markAsRead'])->name('markAsReadMessage');
    Route::post('messages/mark_all_as_read', [MessageController::class, 'markAllAsRead'])->name('markAllAsReadMessages');
    Route::patch('messages/settings/delete_messages', [MessageController::class, 'deleteMessagesSetting'])->name('deleteMessagesSetting');
    Route::post('pay', [PayController::class, 'index'])->name('pay');
    Route::get('pay/accept/{id}', [PayController::class, 'accept'])->where('id', '[0-9]+')->name('payAccept');
    Route::get('pay/cancel/{id}', [PayController::class, 'cancel'])->where('id', '[0-9]+')->name('payCancel');
    Route::get('pay/callback/{id}', [PayController::class, 'callback'])->where('id', '[0-9]+')->name('payCallback');
});

Route::group(['prefix' => 'users', 'middleware' => ['role:Admin,Specialist,Employee,Client', 'cookie-consent']], function () {
    Route::get('{id}/reviews', [UserReviewController::class, 'show'])->name('userReviews');
    Route::post('{id}/reviews', [UserReviewController::class, 'store'])->name('postUserReview');
});

Route::middleware('cookie-consent')->group(function() {
    Route::get("rootcategories", [CategoryController::class, 'userRootCategories'])->name('rootcategories');
    Route::get("innercategories/{category_id}", [CategoryController::class, 'userInnerCategories'])->name('innercategories');
    Route::get("viewcategory", [CategoryController::class, 'userViewCategory'])->name('viewcategory');
    Route::get("viewproduct/{id}", [ProductController::class, 'userViewProduct'])->where('id', '[0-9]+')->name('viewproduct');
    Route::get('products', [ProductController::class, 'userProductIndex'])->name('userproducts');
//    Route::get('promotions', [\App\Http\Controllers\PromotionController::class, 'indexPromotions'])->name('promotions');
//    Route::get('promotion/{id}', [\App\Http\Controllers\PromotionController::class, 'promotionProducts'])->name('promotion');
    //Route::get("termsofservice", [\App\Http\Controllers\TermsOfServiceController::class, 'index'])->name('termsofservice');
    Route::get("policy", [\App\Http\Controllers\TermsOfServiceController::class, 'policy'])->name('policy');
    Route::get('eu_projects',[\App\Http\Controllers\EuProjectsController::class, 'index'])->name('euProjects');
});

//Route::resource('categories', App\Http\Controllers\CategoryController::class);
//Route::resource('ratings', App\Http\Controllers\RatingsController::class);
