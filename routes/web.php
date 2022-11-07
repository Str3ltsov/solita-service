<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ReturnsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\OrdersReportController;
use App\Http\Controllers\ReturnsReportController;
use App\Http\Controllers\CartsReportController;
use App\Http\Controllers\UsersReportController;
use App\Http\Controllers\UserActivitiesReportController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DataExportImportController;
use App\Http\Livewire\MessengerIndex;
use App\Http\Livewire\MessengerAdd;
use App\Http\Livewire\MessengerShow;

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
    if (Auth::user() && Auth::user()->type === User::TYPE_USER)
        return redirect('user/products');
    else if (Auth::user() && Auth::user()->type === User::TYPE_ADMIN)
        return redirect('admin/dashboard');
    else
        return redirect('products');
});

Route::get('/home', function () {
    if (Auth::user() && Auth::user()->type === User::TYPE_USER)
        return redirect('user/products');
    else if (Auth::user() && Auth::user()->type === User::TYPE_ADMIN)
        return redirect('admin/dashboard');
    else
        return redirect('products');
})->name("home");

Route::group(array('prefix' => 'admin', 'middleware' => 'admin'), function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('adminDashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('cookies', \App\Http\Controllers\CookieController::class);
    Route::resource('products', ProductController::class);
    Route::resource('discounts', App\Http\Controllers\DiscountController::class);
    Route::resource('discountCoupons', App\Http\Controllers\DiscountCouponController::class);
    Route::resource('promotions', App\Http\Controllers\PromotionController::class);
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::resource('orders', App\Http\Controllers\OrderController::class);
    Route::resource('orderItems', App\Http\Controllers\OrderItemController::class);
    Route::resource('orderStatuses', App\Http\Controllers\OrderStatusController::class);
    Route::resource('cartStatuses', App\Http\Controllers\CartStatusController::class);
    Route::resource('returns', App\Http\Controllers\ReturnsController::class);
    Route::resource('returnItems', App\Http\Controllers\ReturnItemController::class);
    Route::resource('returnStatuses', App\Http\Controllers\ReturnStatusController::class);
    Route::resource('carts', App\Http\Controllers\CartController::class);
    Route::resource('cartItems', App\Http\Controllers\CartItemController::class);
    Route::get('messenger', MessengerIndex::class)->name('livewire.messenger.index');
    Route::get('messenger/add', MessengerAdd::class)->name('livewire.messenger.add');
    Route::get('messenger/{id}', MessengerShow::class)->name('livewire.messenger.show');
    Route::get('invoice/{id}', [OrderController::class, 'invoicePreview'])->where('id', '[0-9]+')->name(('invoice'));

    // Statistics
    Route::prefix('')->middleware('cors')->name('customers.')->group(function () {
        Route::get('statistics', [ChartController::class, 'index'])->name('statistics');
        Route::post('statistics', [ChartController::class, 'changeStatisticType'])->name('statistics');
    });

    // Logs
    Route::get('logs', [CustomerController::class, 'logs'])->name('customers.logs');

//    Route::prefix('orders_report')->name('orders_report.')->group(function () {
    Route::prefix('orders_report')->name('orders_report.')->group(function () {
        Route::get('', [OrdersReportController::class, 'index'])->name('index');
        Route::get('email', [OrdersReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [OrdersReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [OrdersReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::prefix('returns_report')->name('returns_report.')->group(function () {
        Route::get('', [ReturnsReportController::class, 'index'])->name('index');
        Route::get('email', [ReturnsReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [ReturnsReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [ReturnsReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::prefix('carts_report')->name('carts_report.')->group(function () {
        Route::get('', [CartsReportController::class, 'index'])->name('index');
        Route::get('email', [CartsReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [CartsReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [CartsReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::prefix('users_report')->name('users_report.')->group(function () {
        Route::get('', [UsersReportController::class, 'index'])->name('index');
        Route::get('email', [UsersReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [UsersReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [UsersReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::prefix('user_activities_report')->name('user_activities_report.')->group(function () {
        Route::get('', [UserActivitiesReportController::class, 'index'])->name('index');
        Route::get('email', [UserActivitiesReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [UserActivitiesReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [UserActivitiesReportController::class, 'downloadCsv'])->name('download_csv');
    });
//});
    Route::prefix('orders_report')->name('orders_report.')->group( function () {
        Route::get('', [OrdersReportController::class, 'index'])->name('index');
        Route::get('email', [OrdersReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [OrdersReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [OrdersReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::prefix('returns_report')->name('returns_report.')->group( function () {
        Route::get('', [ReturnsReportController::class, 'index'])->name('index');
        Route::get('email', [ReturnsReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [ReturnsReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [ReturnsReportController::class, 'downloadCsv'])->name('download_csv');
    });
    Route::prefix('carts_report')->name('carts_report.')->group( function () {
        Route::get('', [CartsReportController::class, 'index'])->name('index');
        Route::get('email', [CartsReportController::class, 'sendEmail'])->name('email');
        Route::get('download_pdf', [CartsReportController::class, 'downloadPdf'])->name('download_pdf');
        Route::get('download_csv', [CartsReportController::class, 'downloadCsv'])->name('download_csv');
    });
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
});

Route::group(array('prefix' => 'user', 'middleware' => ['auth', 'cookie-consent']), function () {
    Route::get('/', function () {
        return redirect()->route('userproducts');
    });
    Route::get("rootcategories", [CategoryController::class, 'userRootCategories'])->name('rootcategories');
    Route::get("innercategories/{category_id}", [CategoryController::class, 'userInnerCategories'])->name('innercategories');
    //Route::get("categorytree", [CategoryController::class, 'userCategoryTree'])->name('categorytree');
    Route::get("viewcategory", [CategoryController::class, 'userViewCategory'])->name('viewcategory');
    Route::get("viewproduct/{id}", [ProductController::class, 'userViewProduct'])->where('id', '[0-9]+')->name('viewproduct');
    Route::get('products', [ProductController::class, 'userProductIndex'])->name('userproducts');
    Route::get('promotions', [\App\Http\Controllers\PromotionController::class, 'indexPromotions'])->name('promotions');
    Route::get('promotion/{id}', [\App\Http\Controllers\PromotionController::class, 'promotionProducts'])->name('promotion');
    Route::get('discountCoupons', [\App\Http\Controllers\DiscountCouponController::class, 'discountcouponUser'])->name('discountCoupons');
    Route::post('addtocart', [CartController::class, 'addToCart'])->name('addtocart');
    //Route::get('viewCarts', [\App\Models\Cart::class, 'viewAllCarts'])->name('viewallcarts');
    Route::get('viewcart', [CartController::class, 'viewCart'])->name('viewcart');
    Route::delete('cartItems/destroy/{id}', [\App\Http\Controllers\CartItemController::class, 'userCartItemDestroy'])->where('id', '[0-9]+')->name('userCartItemDestroy');
    Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('checkout/preview', [OrderController::class, 'checkoutPreview'])->name('checkout-preview');
    Route::post('pay', [PayController::class, 'index'])->name('pay');
    Route::get('pay/accept/{id}', [PayController::class, 'accept'])->where('id', '[0-9]+')->name('pay-accept');
    Route::get('pay/cancel/{id}', [PayController::class, 'cancel'])->where('id', '[0-9]+')->name('pay-cancel');
    Route::get('pay/callback/{id}', [PayController::class, 'callback'])->where('id', '[0-9]+')->name('pay-callback');
    //Route::get('viewOrders', [\App\Models\Order::class, 'viewAllOrders'])->name('viewallorders');
    Route::get('rootorders', [OrderController::class, 'indexOrders'])->name('rootorders');
    Route::get('rootoreturns', [ReturnsController::class, 'indexReturns'])->name('rootoreturns');
    Route::get('vieworder/{id}', [OrderController::class, 'viewOrder'])->where('id', '[0-9]+')->name('vieworder');
    Route::get('download_invoice/{id}', [OrderController::class, 'downloadInvoicePdf'])->where('id', '[0-9]+')->name(('download_invoice'));
    Route::get('viewreturn/{id}', [ReturnsController::class, 'viewReturn'])->where('id', '[0-9]+')->name('viewreturn');
    Route::get('cancelnorder/{id}', [\App\Http\Controllers\ReturnsController::class, 'cancelOrder'])->where('id', '[0-9]+')->name('cancelnorder');
    Route::get('returnorder/{id}', [\App\Http\Controllers\ReturnsController::class, 'returnOrder'])->where('id', '[0-9]+')->name('returnorder');
    Route::post('returnorder/{id}/save', [\App\Http\Controllers\ReturnsController::class, 'saveReturnOrder'])->where('id', '[0-9]+')->name('savereturnorder');
    Route::post('savecancelnorder/{id}/save', [\App\Http\Controllers\ReturnsController::class, 'saveCancelOrder'])->where('id', '[0-9]+')->name('savecancelnorder');
    Route::post('addUserRating', [\App\Http\Controllers\RatingsController::class, 'addUserRating'])->name('addUserRating');
    Route::get('userprofile', [\App\Http\Controllers\UserController::class, 'show'])->name('userprofile');
    Route::patch('userprofilesave', [\App\Http\Controllers\UserController::class, 'store'])->name('userprofilesave');
    Route::post('changePassword', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('changePassword');
    Route::get('messenger', MessengerIndex::class)->name('livewire.messenger.index');
    Route::get('messenger/add', MessengerAdd::class)->name('livewire.messenger.add');
    Route::get('messenger/{id}', MessengerShow::class)->name('livewire.messenger.show');
});

//Route::get("home", [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get("rootcategories", [CategoryController::class, 'userRootCategories'])->name('rootcategories');
Route::get("innercategories/{category_id}", [CategoryController::class, 'userInnerCategories'])->name('innercategories');
Route::get("categorytree", [CategoryController::class, 'userCategoryTree'])->name('categorytree');
Route::get("viewcategory", [CategoryController::class, 'userViewCategory'])->name('viewcategory');
Route::get("viewproduct/{id}", [ProductController::class, 'userViewProduct'])->where('id', '[0-9]+')->name('viewproduct');
Route::get('products', [ProductController::class, 'userProductIndex'])->name('userproducts');
Route::get('promotions', [\App\Http\Controllers\PromotionController::class, 'indexPromotions'])->name('promotions');
Route::get('promotion/{id}', [\App\Http\Controllers\PromotionController::class, 'promotionProducts'])->name('promotion');
Route::get("termsofservice", [\App\Http\Controllers\TermsOfServiceController::class, 'index'])->name('termsofservice');
Route::get("policy", [\App\Http\Controllers\TermsOfServiceController::class, 'policy'])->name('policy');
Route::get('about',[\App\Http\Controllers\AboutUsController::class, 'index'])->name('about');

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::resource('categories', App\Http\Controllers\CategoryController::class);
//Route::resource('messages', App\Http\Controllers\MessageController::class);
//Route::resource('ratings', App\Http\Controllers\RatingsController::class);
