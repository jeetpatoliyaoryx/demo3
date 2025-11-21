<?php

use App\Http\Controllers\Backend\SizeGuideController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\MyAccountController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ShiprocketController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SEOController;
use App\Http\Controllers\Backend\WithdrawRequestsController;
use App\Http\Controllers\Backend\CatalogueController;
use App\Http\Controllers\Backend\AllPolicyPageController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\DiscountCodeController;
use App\Http\Controllers\ReferralOrdersController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

// Frontend
Route::get('/', [HomeController::class, 'index']);

Route::get('/clear_cache', function () {
   Artisan::call('cache:clear');
   Artisan::call('route:clear');
   Artisan::call('config:clear');

   return "Cache cleared successfully";
});

Route::get('privacy', [IndexController::class, 'privacy']);
Route::get('terms', [IndexController::class, 'terms']);
Route::get('cancellation_policy', [IndexController::class, 'cancellation_policy']);
Route::get('shipping-refund', [IndexController::class, 'shipping_refund']);
Route::get('return-policy', [IndexController::class, 'return_policy']);
Route::get('about', [IndexController::class, 'about']);
Route::get('contact', [IndexController::class, 'contact']);
Route::post('contact', [IndexController::class, 'submit_contact']);
Route::post('email-subscribe', [IndexController::class, 'email_subscribe']);

Route::get('products/search', [IndexController::class, 'search'])->name('products.search');

Route::post('subscribe_email', [AuthController::class, 'submit_subscribe_email']);
Route::post('user/close_subscribe_email', [AuthController::class, 'close_subscribe_email']);

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'auth_login']);

Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'PostRegister']);

Route::get('forgot-password', [AuthController::class, 'forgot_password']);
Route::post('forgot-password', [AuthController::class, 'forgotpassword_check']);

Route::get('reset-password/{token}', [AuthController::class, 'reset_password']);
Route::post('reset-password/{token}', [AuthController::class, 'postReset']);


Route::get('cart', [CartController::class, 'cart']);
Route::post('add_cart_product', [CartController::class, 'add_cart_product']);


//Route::get('checkout/process', [CartController::class, 'checkout_process']);

Route::get('checkout', [CartController::class, 'checkout']);
Route::post('checkout/apply_discount_code', [CartController::class, 'apply_discount_code']);
Route::post('checkout', [CartController::class, 'place_order']);
Route::post('payment/callback', [CartController::class, 'paymentCallback'])->name('payment.callback');
Route::post('checkout_payment', [CartController::class, 'checkout_payment']);


Route::post('update_cart', [CartController::class, 'update_cart']);
Route::get('remove/{id}', [CartController::class, 'removeCart']);


Route::get('catalogue/{encoded}', [HomeController::class, 'catalogue_page']);

Route::post('razorpay/webhook', [CartController::class, 'razorpayWebhook']);
Route::get('checkout-process', [CartController::class, 'checkout_process']);






// Route::post('product/ajax_search', [IndexController::class, 'product_ajax_search']);
// Route::get('search', [IndexController::class, 'search']);
Route::get('item/{slug}', [IndexController::class, 'item']);
Route::get('c/{cat1?}/{cat2?}/{cat3?}', [IndexController::class, 'getCategory']);
Route::get('a/{cat1?}/{cat2?}', [IndexController::class, 'getACategory']);
Route::get('m/{cat1?}', [IndexController::class, 'getMCategory']);



Route::group(['middleware' => 'user'], function () {
   Route::get('user/dashboard', [UserDashboardController::class, 'dashboard']);

   Route::get('user/profile', [UserController::class, 'profile']);
   Route::post('user/profile', [UserController::class, 'update_profile']);

   Route::get('user/change-password', [UserController::class, 'change_password']);
   Route::post('user/change-password', [UserController::class, 'update_change_password']);

   Route::get('user/wishlist', [UserController::class, 'wishlist']);
   Route::post('user/add-remove-wishlist', [UserController::class, 'add_remove_wishlist']);


   Route::get('user/orders', [UserController::class, 'orders']);
   Route::get('user/orders/details/{id}', [UserController::class, 'orders_detail']);

   Route::get('user/referral_orders', [ReferralOrdersController::class, 'referral_orders']);
   Route::get('user/referral_orders_details/{id}', [ReferralOrdersController::class, 'referral_orders_details']);

   Route::get('user/bank-detail', [UserController::class, 'user_bank_detail']);
   Route::post('user/bank-detail', [UserController::class, 'user_bank_detail_update']);

   Route::get('user/wallet', [WalletController::class, 'index'])->name('user.wallet');
   Route::post('wallet/withdraw', [WalletController::class, 'withdraw'])
      ->name('wallet.withdraw');

   Route::get('user/withdraw-history', [WalletController::class, 'withdraw_history']);

});


// Backend

Route::group(['middleware' => 'admin'], function () {

   Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

   Route::get('admin/users', [UsersController::class, 'list']);
   Route::get('admin/users/add', [UsersController::class, 'add']);
   Route::get('admin/users/delete/{id}', [UsersController::class, 'delete']);
   Route::get('admin/users/view/{id}', [UsersController::class, 'view']);

   Route::get('admin/report', [ReportController::class, 'list']);
   Route::get('admin/report/{year}/{month}', [ReportController::class, 'monthlyDetail'])->name('admin.report.monthly');
   Route::get('admin/report/export/{year}/{month}', [ReportController::class, 'exportMonthly'])->name('admin.report.export');



   Route::get('admin/product', [ProductController::class, 'list']);
   Route::get('admin/product/add', [ProductController::class, 'add']);
   Route::post('admin/product/add', [ProductController::class, 'PostProduct']);
   Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
   Route::post('admin/product/edit/{id}', [ProductController::class, 'UpdateProduct']);
   Route::post('admin/product/parent', [ProductController::class, 'getParent']);
   Route::post('admin/product/parent/sub', [ProductController::class, 'getSubParent']);

   Route::post('admin/ajax/add-color', [ProductController::class, 'addcolorajax']);
   Route::post('admin/ajax/add-size', [ProductController::class, 'addsizeajax']);

   Route::get('admin/color/delete/{colorid}/{productid}', [ProductController::class, 'deletecolor']);
   Route::get('admin/size/delete/{colorid}/{productid}', [ProductController::class, 'deletesize']);

   Route::post('admin/product-image', [ProductController::class, 'ImageUpload']);
   Route::post('admin/product/{id}/delete-photo', [ProductController::class, 'delete_photo']);

   Route::get('admin/category', [CategoryController::class, 'list']);
   Route::get('admin/category/add', [CategoryController::class, 'add']);
   Route::post('admin/category/add', [CategoryController::class, 'PostCategory']);
   Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit']);
   Route::post('admin/category/edit/{id}', [CategoryController::class, 'post_edit']);
   Route::post('admin/category/parent', [CategoryController::class, 'getParent']);
   Route::post('admin/category/parent/sub', [CategoryController::class, 'getSubParent']);

   Route::get('admin/orders', [OrdersController::class, 'list']);
   Route::get('admin/orders/orders_item/{id}', [OrdersController::class, 'orders_item']);

   Route::post('admin/orders/{id}/ship', [ShiprocketController::class, 'shipToShiprocket'])->name('admin.orders.ship');
   Route::post('admin/orders/{id}/assign-awb', [ShiprocketController::class, 'assignAwb'])->name('admin.orders.assign_awb');
   Route::get('admin/orders/{id}/label', [ShiprocketController::class, 'generateLabel'])->name('admin.orders.label');
   Route::get('admin/orders/{id}/track', [ShiprocketController::class, 'track'])->name('admin.orders.track');
   Route::post('admin/orders/{id}/pickup', [ShiprocketController::class, 'generatePickup'])->name('admin.orders.pickup');
   Route::post('admin/orders/{id}/print-invoice', [ShiprocketController::class, 'printInvoice'])->name('admin.orders.print_invoice');
   Route::post('admin/manifests/generate', [ShiprocketController::class, 'generateManifest'])->name('admin.manifests.generate');


   Route::post('admin/orders/ship/bulk', [ShiprocketController::class, 'shipToShiprocketBulk'])
      ->name('admin.orders.ship.bulk');

   Route::get('admin/orders/create_shiprocket_order_all_option', [ShiprocketController::class, 'create_shiprocket_order_all_option']);




   Route::get('admin/contact_us', [ProductController::class, 'contact_us_list']);
   Route::get('admin/contact_us/delete/{id}', [ProductController::class, 'contact_us_delete']);

   Route::get('admin/my_account', [MyAccountController::class, 'list']);
   Route::post('admin/my_account', [MyAccountController::class, 'update_account']);

   Route::get('admin/contact_setting', [MyAccountController::class, 'contact_setting']);
   Route::post('admin/contact_setting_update', [MyAccountController::class, 'update_contact_setting']);

   Route::get('admin/header', [MyAccountController::class, 'header']);
   Route::post('admin/header_udpate', [MyAccountController::class, 'update_header']);

   Route::get('admin/footer', [MyAccountController::class, 'footer']);
   Route::post('admin/footer_udpate', [MyAccountController::class, 'update_footer']);


   Route::get('admin/banner', [BannerController::class, 'banner_list']);
   Route::get('admin/banner/add', [BannerController::class, 'add_banner']);
   Route::post('admin/banner/add', [BannerController::class, 'add_banner_store']);
   Route::get('admin/banner/edit/{id}', [BannerController::class, 'edit_banner']);
   Route::post('admin/banner/edit/{id}', [BannerController::class, 'edit_banner_update']);
   Route::get('admin/banner/delete/{id}', [BannerController::class, 'banner_delete']);

   Route::get('admin/instagram', [BannerController::class, 'instagram_list']);
   Route::get('admin/instagram/add', [BannerController::class, 'add_instagram']);
   Route::post('admin/instagram/add', [BannerController::class, 'add_instagram_store']);
   Route::get('admin/instagram/edit/{id}', [BannerController::class, 'edit_instagram']);
   Route::post('admin/instagram/edit/{id}', [BannerController::class, 'edit_instagram_update']);
   Route::get('admin/instagram/delete/{id}', [BannerController::class, 'instagram_delete']);

   Route::get('admin/marquee', [BannerController::class, 'marquee_list']);
   Route::get('admin/marquee/add', [BannerController::class, 'add_marquee']);
   Route::post('admin/marquee/add', [BannerController::class, 'add_marquee_store']);
   Route::get('admin/marquee/edit/{id}', [BannerController::class, 'edit_marquee']);
   Route::post('admin/marquee/edit/{id}', [BannerController::class, 'edit_marquee_update']);
   Route::get('admin/marquee/delete/{id}', [BannerController::class, 'marquee_delete']);

   Route::get('admin/surface', [BannerController::class, 'surface']);
   Route::post('admin/surface_udpate', [BannerController::class, 'update_surface']);

   Route::get('admin/spacing', [BannerController::class, 'spacing']);
   Route::post('admin/spacing_udpate', [BannerController::class, 'update_spacing']);

   Route::get('admin/why_shop', [BannerController::class, 'why_shop']);
   Route::get('admin/why_shop/add', [BannerController::class, 'add_why_shop']);
   Route::post('admin/why_shop/add', [BannerController::class, 'add_why_shop_store']);
   Route::get('admin/why_shop/edit/{id}', [BannerController::class, 'edit_why_shop']);
   Route::post('admin/why_shop/edit/{id}', [BannerController::class, 'edit_why_shop_update']);
   Route::get('admin/why_shop/delete/{id}', [BannerController::class, 'why_shop_delete']);

   Route::get('admin/customer_say', [BannerController::class, 'customer_say']);
   Route::get('admin/customer_say/add', [BannerController::class, 'add_customer_say']);
   Route::post('admin/customer_say/add', [BannerController::class, 'add_customer_say_store']);
   Route::get('admin/customer_say/edit/{id}', [BannerController::class, 'edit_customer_say']);
   Route::post('admin/customer_say/edit/{id}', [BannerController::class, 'edit_customer_say_update']);
   Route::get('admin/customer_say/delete/{id}', [BannerController::class, 'customer_say_delete']);

   Route::get('admin/email_subscribe', [BannerController::class, 'email_subscribe']);
   Route::get('admin/email_subscribe/delete/{id}', [BannerController::class, 'email_subscribe_delete']);

   Route::get('admin/social', [BannerController::class, 'social_list']);
   Route::get('admin/social/add', [BannerController::class, 'add_social']);
   Route::post('admin/social/add', [BannerController::class, 'add_social_store']);
   Route::get('admin/social/edit/{id}', [BannerController::class, 'edit_social']);
   Route::post('admin/social/edit/{id}', [BannerController::class, 'edit_social_update']);
   Route::get('admin/social/delete/{id}', [BannerController::class, 'social_delete']);

   Route::get('admin/seo', [SEOController::class, 'list']);
   Route::get('admin/seo/add', [SEOController::class, 'add']);
   Route::post('admin/seo/add', [SEOController::class, 'store']);
   Route::get('admin/seo/edit/{id}', [SEOController::class, 'edit']);
   Route::post('admin/seo/edit/{id}', [SEOController::class, 'update']);

   Route::get('admin/all_title', [BannerController::class, 'all_title']);
   Route::post('admin/all_title_udpate', [BannerController::class, 'all_title_udpate']);

   Route::get('admin/assurance', [BannerController::class, 'assurance_list']);
   Route::get('admin/assurance/add', [BannerController::class, 'add_assurance']);
   Route::post('admin/assurance/add', [BannerController::class, 'add_assurance_store']);
   Route::get('admin/assurance/edit/{id}', [BannerController::class, 'edit_assurance']);
   Route::post('admin/assurance/edit/{id}', [BannerController::class, 'edit_assurance_update']);
   Route::get('admin/assurance/delete/{id}', [BannerController::class, 'assurance_delete']);

   Route::get('admin/catalogue', [CatalogueController::class, 'list']);
   Route::get('admin/catalogue/add', [CatalogueController::class, 'add']);
   Route::post('admin/catalogue/add', [CatalogueController::class, 'store']);
   Route::get('admin/catalogue/edit/{id}', [CatalogueController::class, 'edit']);
   Route::post('admin/catalogue/edit/{id}', [CatalogueController::class, 'update']);
   Route::get('admin/catalogue/delete/{id}', [CatalogueController::class, 'delete']);

   Route::get('admin/withdraw_requests', [WithdrawRequestsController::class, 'list']);
   Route::get('admin/withdraw_requests/accept/{id}', [WithdrawRequestsController::class, 'accept']);
   Route::post('admin/withdraw_requests/add_reason', [WithdrawRequestsController::class, 'add_reason']);


   Route::get('admin/terms_conditions', [AllPolicyPageController::class, 'terms_conditions']);
   Route::get('admin/terms_conditions/add', [AllPolicyPageController::class, 'terms_conditions_add']);
   Route::post('admin/terms_conditions/add', [AllPolicyPageController::class, 'terms_conditions_store']);
   Route::get('admin/terms_conditions/edit/{id}', [AllPolicyPageController::class, 'terms_conditions_edit']);
   Route::post('admin/terms_conditions/edit/{id}', [AllPolicyPageController::class, 'terms_conditions_update']);
   Route::get('admin/terms_conditions/delete/{id}', [AllPolicyPageController::class, 'terms_conditions_delete']);

   Route::get('admin/privacy_policy', [AllPolicyPageController::class, 'privacy_policy']);
   Route::get('admin/privacy_policy/add', [AllPolicyPageController::class, 'privacy_policy_add']);
   Route::post('admin/privacy_policy/add', [AllPolicyPageController::class, 'privacy_policy_store']);
   Route::get('admin/privacy_policy/edit/{id}', [AllPolicyPageController::class, 'privacy_policy_edit']);
   Route::post('admin/privacy_policy/edit/{id}', [AllPolicyPageController::class, 'privacy_policy_update']);
   Route::get('admin/privacy_policy/delete/{id}', [AllPolicyPageController::class, 'privacy_policy_delete']);


   Route::get('admin/cancellation_policy', [AllPolicyPageController::class, 'cancellation_policy']);
   Route::get('admin/cancellation_policy/add', [AllPolicyPageController::class, 'cancellation_policy_add']);
   Route::post('admin/cancellation_policy/add', [AllPolicyPageController::class, 'cancellation_policy_store']);
   Route::get('admin/cancellation_policy/edit/{id}', [AllPolicyPageController::class, 'cancellation_policy_edit']);
   Route::post('admin/cancellation_policy/edit/{id}', [AllPolicyPageController::class, 'cancellation_policy_update']);
   Route::get('admin/cancellation_policy/delete/{id}', [AllPolicyPageController::class, 'cancellation_policy_delete']);

   Route::get('admin/return_refund', [AllPolicyPageController::class, 'return_refund']);
   Route::get('admin/return_refund/add', [AllPolicyPageController::class, 'return_refund_add']);
   Route::post('admin/return_refund/add', [AllPolicyPageController::class, 'return_refund_store']);
   Route::get('admin/return_refund/edit/{id}', [AllPolicyPageController::class, 'return_refund_edit']);
   Route::post('admin/return_refund/edit/{id}', [AllPolicyPageController::class, 'return_refund_update']);
   Route::get('admin/return_refund/delete/{id}', [AllPolicyPageController::class, 'return_refund_delete']);

   Route::get('admin/shipping_policy', [AllPolicyPageController::class, 'shipping_policy']);
   Route::get('admin/shipping_policy/add', [AllPolicyPageController::class, 'shipping_policy_add']);
   Route::post('admin/shipping_policy/add', [AllPolicyPageController::class, 'shipping_policy_store']);
   Route::get('admin/shipping_policy/edit/{id}', [AllPolicyPageController::class, 'shipping_policy_edit']);
   Route::post('admin/shipping_policy/edit/{id}', [AllPolicyPageController::class, 'shipping_policy_update']);
   Route::get('admin/shipping_policy/delete/{id}', [AllPolicyPageController::class, 'shipping_policy_delete']);

   Route::get('admin/about_image', [BannerController::class, 'about_image']);
   Route::post('admin/about_image_udpate', [BannerController::class, 'update_about_image']);

   Route::get('admin/about_add', [AllPolicyPageController::class, 'about_add']);
   Route::get('admin/about_add/add', [AllPolicyPageController::class, 'about_add_add']);
   Route::post('admin/about_add/add', [AllPolicyPageController::class, 'about_add_store']);
   Route::get('admin/about_add/edit/{id}', [AllPolicyPageController::class, 'about_add_edit']);
   Route::post('admin/about_add/edit/{id}', [AllPolicyPageController::class, 'about_add_update']);
   Route::get('admin/about_add/delete/{id}', [AllPolicyPageController::class, 'about_add_delete']);

   Route::get('admin/facebook', [AllPolicyPageController::class, 'facebooklist']);
   Route::get('admin/facebook/add', [AllPolicyPageController::class, 'facebook_add']);
   Route::post('admin/facebook/add', [AllPolicyPageController::class, 'facebook_store']);
   Route::get('admin/facebook/edit/{id}', [AllPolicyPageController::class, 'facebook_edit']);
   Route::post('admin/facebook/edit/{id}', [AllPolicyPageController::class, 'facebook_update']);
   Route::get('admin/facebook/delete/{id}', [AllPolicyPageController::class, 'facebook_delete']);



   Route::get('admin/color', [ColorController::class, 'list']);
   Route::get('admin/color/add', [ColorController::class, 'add']);
   Route::post('admin/color/add', [ColorController::class, 'Store']);
   Route::get('admin/color/edit/{id}', [ColorController::class, 'edit']);
   Route::post('admin/color/edit/{id}', [ColorController::class, 'Update']);
   Route::get('admin/color/delete/{id}', [ColorController::class, 'Delete']);


   Route::get('admin/size', [SizeController::class, 'list']);
   Route::get('admin/size/add', [SizeController::class, 'add']);
   Route::post('admin/size/add', [SizeController::class, 'Store']);
   Route::get('admin/size/edit/{id}', [SizeController::class, 'edit']);
   Route::post('admin/size/edit/{id}', [SizeController::class, 'Update']);
   Route::get('admin/size/delete/{id}', [SizeController::class, 'delete']);

   Route::get('admin/subscribe', [BannerController::class, 'subscribe_image']);
   Route::post('admin/subscribe_udpate', [BannerController::class, 'update_subscribe_image']);

   Route::get('admin/size_guide', [SizeGuideController::class, 'size_guide_list']);
   Route::get('admin/size_guide/add', [SizeGuideController::class, 'add_size_guide']);
   Route::post('admin/size_guide/add', [SizeGuideController::class, 'add_size_guide_store']);
   Route::get('admin/size_guide/edit/{id}', [SizeGuideController::class, 'edit_size_guide']);
   Route::post('admin/size_guide/edit/{id}', [SizeGuideController::class, 'edit_size_guide_update']);
   Route::get('admin/size_guide/delete/{id}', [SizeGuideController::class, 'size_guide_delete']);

   Route::get('admin/marketing_key', [BannerController::class, 'marketing_key']);
   Route::post('admin/marketing_key_udpate', [BannerController::class, 'update_marketing_key']);

   Route::get('admin/couponcode', [DiscountCodeController::class, 'index']);
   Route::get('admin/couponcode/add', [DiscountCodeController::class, 'addDiscountCode']);
   Route::post('admin/couponcode/add', [DiscountCodeController::class, 'addStoreDiscountCode']);
   Route::get('admin/couponcode/edit/{id}', [DiscountCodeController::class, 'editDiscountCode']);
   Route::post('admin/couponcode/edit/{id}', [DiscountCodeController::class, 'updateDiscountCode']);
   Route::get('admin/couponcode/delete/{id}', [DiscountCodeController::class, 'destroyDiscountCode']);


});


Route::get('logout', [AuthController::class, 'logout']);