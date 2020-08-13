<?php

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

//Route::get('/', function () {
//    return view('front.index');
//});

//Route::get('/index', function () {
//    return view('front.index');
//});


//Route::group(['middleware'=>'visitors'],function() {
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'blogs'], function () {
    Route::any('/', 'BlogController@blogs')->name('blogs');
    Route::any('/blogpage/{slug?}', 'BlogController@blogs_single')->name('blogs-single');
    Route::get('/blogscategory/{slug?}', 'BlogController@blog_category')->name('blog-category');
});

Route::get('/register', 'RegistrationController@register')->name('register');
Route::post('/register', 'RegistrationController@postRegister');

Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@postLogin');
Route::post('/front_login', 'LoginController@frontLogin');

Route::get('/forgotPassword', 'ForgotPasswordController@forgotPassword');
Route::post('/forgotPassword', 'ForgotPasswordController@postForgotPassword');

//});

//--------------------------------------email and reset-------------------------------
Route::post('/logout', 'LoginController@logout');
Route::post('/front_logout', 'LoginController@front_logout');
Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');

Route::get('/reset/{email}/{resetCode}', 'LoginController@reset');
Route::post('/reset/{email}/{resetCode}', 'LoginController@post_reset');

Route::get('/forget_password', 'LoginController@forget_password')->name('forget_password');
Route::post('/forget_password', 'LoginController@post_forget_password')->name('post_forgot_password');

//------------------------------------------Admin-------------------------------------
Route::get('/dashboardAdmin', 'AdminController@check')->middleware('admin');
Route::get('/admin/addProfile', 'AdminController@addProfile');
Route::get('/admin/profile', 'AdminController@viewProfile');
Route::post('/admin/addProfile', 'AdminController@postProfile')->name('postAdminProfile');
Route::post('/admin/Profile/Edit/{id}', 'AdminController@profileEdit')->name('editAdminProfile');
Route::post('/admin/Change', 'AdminController@changePswd')->name('changeAdminPswd');
Route::post('/client/Change', 'AdminController@changeClientProfile')->name('changeClientProfile');

Route::get('/admin/all-users', 'AdminController@all_users')->name('all_users');

//shipping prices
//Shipping
Route::get('/admin/shipping-location', 'admin\ShippingController@add_location')->name('add_location');
Route::post('/admin/shipping-location', 'admin\ShippingController@post_location')->name('post_location');
Route::get('/admin/view-shipping', 'admin\ShippingController@shipping_view')->name('location-view');
Route::get('/admin/shipping-confirm/{id}', 'admin\ShippingController@confirm_shipping')->name('confirm_shipping');
Route::get('/admin/shipping-delete/{id}', 'admin\ShippingController@delete_shipping')->name('delete_shipping');
Route::get('/admin/shipping-edit/{id}', 'admin\ShippingController@edit_shipping')->name('edit_shipping');
Route::post('/admin/shipping-edit/{id}', 'admin\ShippingController@save_edited_shipping')->name('save_edited_location');

//-----------------------------------------------------Setup ------------------------------------------

Route::get('/edit_contact', 'SetupController@contacts')->name('all-messages');
Route::get('/delete_contact/{id}', 'SetupController@delete_contact')->name('delete_contact');
Route::get('/confirm/{id}', 'SetupController@confirm_contact')->name('confirm_contact');

Route::get('/dashboard', 'SetupController@dashboard')->name('dashboard');

Route::get('/background', 'SetupController@background')->name('background');

Route::get('/add-background', 'SetupController@add_background')->name('add-background');
Route::post('/add-background', 'SetupController@save_background')->name('save-background');
Route::get('/add-background/{id}', 'SetupController@confirm_background')->name('confirm_background');
Route::post('/background/{id}', 'SetupController@link_confirm')->name('link_confirm');
Route::get('/remove/{id}', 'SetupController@link_remove')->name('link_remove');

Route::get('/edit/{id}', 'SetupController@edit_background')->name('edit_background');
Route::post('/edit/{id}', 'SetupController@post_edit_background')->name('post_edit_background');

Route::get('/subscriber', 'SetupController@subscriber')->name('subscriber');
Route::post('/subscriber', 'FrontController@postSubscriber')->name('post_subscriber');
Route::get('/delete_subscriber/{id}', 'SetupController@delete_subscriber')->name('delete_subscriber');


Route::get('/setting', 'SettingController@setup')->name('manage_setting');
Route::post('/setting/post', 'SettingController@postSetting')->name('postSetting');
Route::post('/setting/post/edit', 'SettingController@editPostSetting')->name('editPostSetting');


//-------------------------------Tags-------------------------------------------

Route::get('/admin/tags', 'admin\TagController@add_tag')->name('add_tag');
Route::post('/admin/tags', 'admin\TagController@post_tag')->name('post_tag');
Route::get('/admin/delete_tag/{id}', 'admin\TagController@delete_tag')->name('delete_tag');

//--------------------------------------------------------products---------------------

Route::get('/admin/add_products', 'admin\ProductController@view')->name('product_add');

Route::post('/admin/store_products', 'admin\ProductController@store')->name('post_add_products');
Route::any('/admin/all_products/{filter?}', 'admin\ProductController@view_all')->name('all_products');
//new added
//Route::get('/admin/view_products','ProductController@all_products')->name('view_products');

Route::get('/admin/edit_product/{id}', 'admin\ProductController@edit')->name('edit_product');
Route::get('/admin/delete_product/{id}', 'admin\ProductController@destroy')->name('delete_product');
Route::get('/admin/view_products', 'admin\ProductController@all_products')->name('view_products');

Route::get('/admin/edit_product/{id}', 'admin\ProductController@edit')->name('edit_product');
Route::post('/admin/edit_product/{id}', 'admin\ProductController@post_edit')->name('post_edit_product');
Route::get('/admin/delete_product/{id}', 'admin\ProductController@destroy')->name('delete_product');

//------------------------------------------------Image Controller
Route::get('/admin/edit_product/image_delete/{id}', 'ImageController@delete');
Route::get('/admin/edit_product/is_main_edit/{id}', 'ImageController@change_main');

Route::post('/edit_upload/{id}', 'ImageController@store')->name('edit_upload');

//-------------------------------------------------Admin Orders------------------------------------

Route::get('/admin/orders', 'admin\OrderController@view')->name('admin_orders');
Route::get('/admin/orders/cancel/{id}', 'admin\OrderController@cancel')->name('cancel_order');
Route::get('/admin/orders/cancel_to_pending/{id}', 'admin\OrderController@cancel_to_pending')->name('cancel_to_pending');
Route::post('/admin/order/change_status/{id}', 'admin\OrderController@change_status')->name('change_status');
Route::get('/admin/order/delivered', 'admin\OrderController@delivered')->name('order_delivered');
Route::get('/admin/order/pending', 'admin\OrderController@pending')->name('order_pending');
Route::get('/admin/order/cancel', 'admin\OrderController@cancelled')->name('order_cancel');


//-------------------------------------------User Orders ----------------------------------

//Route::get('/user_orders','front\OrderController@view')->name('user_orders');

Route::post('admin/edit_user_role/{id}', 'AdminController@edit_role')->name('edit_role');
//----------------------------------------------------------brands--------------------

Route::get('/admin/add_brands', 'admin\BrandController@view')->name('admin_brands');

Route::post('/admin/store_brands', 'admin\BrandController@store')->name('post_add_brand');

Route::get('/admin/delete_brand/{id}', 'admin\BrandController@delete')->name('delete_brand');

//---------------------------------------------------------categories------------------
Route::get('/add_categories', 'CategoryController@view')->name('add_category');

Route::post('/store_categories', 'CategoryController@store')->name('post_add_category');

Route::get('/delete_category/{id}', 'CategoryController@delete')->name('delete_category');
Route::post('/edit_category/{id}', 'CategoryController@edit')->name('edit_category');
Route::get('delete_category_image', 'CategoryController@delete_category_image')->name('delete-category-image');

//-------------------------------------Special by Price----------------------------------

Route::get('/admin/special_price', 'admin\SpecialController@add_special')->name('add_special_price');
Route::post('/admin/special', 'admin\SpecialController@post_special')->name('post_special_price');
Route::get('/admin/special_view', 'admin\SpecialController@view_special')->name('view_special');
Route::get('/admin/delete_special/{id}', 'admin\SpecialController@delete_special_price')->name('delete_special_price');
Route::get('/admin/edit_special/{id}', 'admin\SpecialController@edit_special_price')->name('edit_special_price');
Route::post('/admin/edit_special/{id}', 'admin\SpecialController@save_edited_special_price')->name('save_edited_special_price');


//-----------------------------------Advertisement-------------------------------

Route::any('/admin/advertisement', 'admin\SpecialController@advertisement')->name('advertisement');


//-----------------------------------Special by Category-------------------------------
Route::get('/admin/special_category', 'admin\SpecialController@index')->name('add_special_category');
Route::post('/admin/add_special_category', 'admin\SpecialController@store')->name('post_special_category');
Route::get('/admin/delete_special_category/{id}', 'admin\SpecialController@delete')->name('delete_special_category');
Route::get('/admin/confirm_special_category/{id}', 'admin\SpecialController@confirm')->name('confirm_special_category');
Route::get('/admin/edit_special_category/{id}', 'admin\SpecialController@edit')->name('edit_special_category');
Route::post('/admin/post_edit_special_category/{id}', 'admin\SpecialController@post_edit')->name('post_edit_special_category');

//---------------------------------------------------------Color------------------
Route::get('/admin/colors_sizes', 'admin\ColorController@view')->name('color_size');

Route::post('/admin/store_colors', 'admin\ColorController@store')->name('post_add_color');
Route::get('/admin/delete_color/{id}', 'admin\ColorController@delete')->name('delete_color');

//---------------------------------------------------------Sizes------------------

Route::post('/admin/store_sizes', 'admin\SizeController@store')->name('post_add_size');
Route::get('/admin/delete_size/{id}', 'admin\SizeController@delete')->name('delete_size');

//-----------------------------------------------------------faq-------------------------
Route::get('/faq', 'FAQController@view');


//Route::post('/add_faq', 'FAQController@store');

//---------------------------------------------------------coupons-----------------------
Route::get('/add_coupons', 'CouponController@index');

Route::post('/store_coupons', 'CouponController@store');

Route::post('/verify_coupon', 'CouponController@verify');

Route::get('/remove_coupon', 'CouponController@destroy');

//---------------------------------------------------------------visitor--------------------------

//Route::get('/index', 'ProductController@master');

Route::get('/product_list', 'ProductController@lists');

Route::get('/category/{id}', 'ProductController@index')->name('filter');
Route::get('/search-result', 'ProductController@search')->name('search');
Route::get('/search/{slug}', 'ProductController@slug_filter')->name('slug_filter');
Route::get('/dashboard', 'SetupController@dashboard')->name('dashboard');

Route::get('/order', 'ProductController@order');
Route::get('/profile', 'ProductController@profile');


//Route::post('/review','ReviewController@review')->name('review');

Route::get('/contact', 'MessageController@contact');
Route::post('/contact', 'MessageController@message')->name('message');


Route::get('/product/{slug}', 'ProductController@single_product')->name('view_details');


Route::post('/buy_product/{id}', 'CartController@index')->name('buy_product');
Route::get('/buy_product/{id}', 'CartController@add_cart')->name('add_cart');
Route::get('/view_cart', 'CartController@view')->name('view-cart');

Route::get('/remove_from_cart/{id}', 'CartController@remove')->name('delete_cart_item');

Route::get('/edit_cart/{id}', 'CartController@edit');

Route::post('/store_edit_cart/{id}', 'CartController@store');

Route::get('/wishlist', 'WishlistController@wishlist');

Route::get('/postWishlist/{id}', 'WishlistController@postWishlist')->name('postWishlist');
Route::get('/deleteWishlist/{id}', 'WishlistController@deleteWishlist')->name('delete_wishlist');

//update cart
Route::post('/post_cart_update', 'CartController@post_cart_update')->name('post_update_cart');

// ........................Front Route ---------------------------------------------------------
Route::get('/', 'FrontController@index')->name('index');
// Route::get('/category','FrontController@categories')->name('categories');
Route::get('/about', 'FrontController@about')->name('about');
// Route::get('/category/{id}','FrontController@categories')->name('single-page');
Route::get('/contact', 'FrontController@contact')->name('contact');
Route::post('/contact', 'FrontController@contact_post')->name('contact-post');
// Route::get('/categories/{id}','FrontController@shop')->name('shop');

Route::get('/new-arrival', 'FrontController@new_arrival')->name('new_arrival');
Route::get('/sale', 'FrontController@sale')->name('nav_sale');


// -------------------------Ads Route ----------------------------------
Route::get('/add-ads', 'AdController@add_ads')->name('add_ads');
Route::post('/add-ads', 'AdController@post_ads')->name('post_ads');
Route::get('/view-ads', 'AdController@view_ads')->name('view_ads');
Route::get('/confirm-ads/{id}', 'AdController@confirm_ads')->name('confirm_ad');
Route::get('/delete-ads/{id}', 'AdController@delete_ads')->name('delete_ad');
Route::get('/edit-ads/{id}', 'AdController@edit_ads')->name('edit_ad');
Route::post('/edit-ads/{id}', 'AdController@post_edit_ads')->name('post_edit_ads');
//
//Route::get('/login','FrontController@login')->name('login');
//Route::post('/login','FrontController@login')->name('login_post');
//
//Route::get('/register','FrontController@register')->name('register');
//Route::post('/register','FrontController@register_save')->name('register_save');

//login with provider
Route::get('login/{service}', 'LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'LoginController@handleProviderCallback');


//----------------------User Review---------------------------
Route::post('/add_review', 'ReviewController@review')->name('post_add_review');


//---------------------------------Checkout----------------------------------
//Route::get('/post_checkout','CheckoutController@post_check')->name('post_checkout');
Route::post('/user/order_confirmed', 'CheckoutController@post_check')->name('confirm_order');

//Route::post('/checkout', 'CheckoutController@check');
Route::get('/cart_checkout', 'CheckoutController@cart_checkout')->name('checkout');

Route::get('/order_confirmed', 'CheckoutController@code_display');

//Route::post('/place_order', 'CheckoutController@index');

//--------------price filter-----------------------------------
Route::get('/by_price/{id}', 'front\SpecialController@by_price')->name('price_filter');

//notification
Route::get('/markAsRead', function () {
    Sentinel::getUser()->unreadNotifications->markAsRead();
});

//search
Route::post('/search', 'FrontController@result')->name('result');

//terms and policies
Route::get('/terms-conditions', 'FrontController@terms')->name('terms_and_conditions');
Route::get('/privacy-policies', 'FrontController@policies')->name('privacy_policies');

//track code
Route::get('/order_track', 'FrontController@order_track')->name('track_code');
Route::post('/post/track_code', 'FrontController@post_order_track')->name('post_track_code');

//--------------------User Account Dashboard---------------------------
Route::get('/user/info', 'UserController@index')->name('user_info');
Route::get('/user/orders', 'UserController@index')->name('user_orders');
Route::get('/user/wishlists', 'UserController@index')->name('user_wishlists');
Route::get('/user/address', 'UserController@index')->name('user_address');
Route::post('/user/change_password', 'UserController@change_pswd')->name('change_pswd');

Route::post('/user/change_address', 'UserController@change_adddress')->name('post_user_address');
Route::post('/user/user_account', 'UserController@user')->name('user');

Route::get('/apply_coupon/{coupon_code}', 'CouponController@verify');
Route::get('/user/delete_coupon', 'CouponController@destroy')->name('coupon_destroy');

//----------------------Payment-----------------------
Route::get('/user/second_test', 'admin\PaymentController@test')->name('test');
Route::post('/user/second_test/{id}', 'admin\PaymentController@test_post')->name('test_post');

Route::get('/pay', 'admin\PaymentController@best')->name('best');
Route::get('/returnPaypal/{id}', 'admin\PaymentController@returnPaypal')->name('process.paypal');
Route::get('/cancelPaypal', 'admin\PaymentController@cancelPaypal')->name('cancel.paypal');
Route::post('/paypal/{order}', 'admin\PaymentController@paypal')->name('checkout.paypal');

Route::get('/user_payment/{track_code}', 'admin\PaymentController@index')->name('user_payment');


//-------------------------Coupon--------------------------------
Route::get('/admin/add_coupon', 'admin\CouponController@index')->name('add_coupon');
Route::post('/admin/add_coupon', 'admin\CouponController@store')->name('store_coupons');
Route::get('/admin/all_coupons', 'admin\CouponController@view_all')->name('all_coupons');
Route::get('/admin/all_coupons/delete/{id}', 'admin\CouponController@delete')->name('delete_coupon');

//---------------Blogs Setup Admin------------------


Route::group(['namespace' => 'admin', 'prefix' => 'Blog', 'middleware' => 'admin'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::any('add_category', 'BlogsSetupController@add_category')->name('blog-add-category');
        Route::get('delete_category_blog/{id?}', 'BlogsSetupController@delete_category')->name('blog-delete-category');
        Route::post('edit_category/{id?}', 'BlogsSetupController@edit_category')->name('blog-edit-category');
    });
    Route::group(['prefix' => 'Tags'], function () {
        Route::any('blog_tags', 'BlogsSetupController@blog_tags')->name('blog-tags');
        Route::get('blog_tags_delete/{id?}', 'BlogsSetupController@blog_tags_delete')->name('blog-delete-tags');
        Route::post('blog_tags_edit/{id?}', 'BlogsSetupController@blog_tags_edit')->name('blog-edit-tags');
    });
    Route::group(['prefix' => 'Tags'], function () {
        Route::any('blog_author', 'BlogsSetupController@blog_author')->name('blog-author');
        Route::get('blog_author_delete/{id?}', 'BlogsSetupController@blog_author_delete')->name('blog-delete-author');
        Route::any('blog_author_edit/{id?}', 'BlogsSetupController@blog_author_edit')->name('blog-edit-author');
    });
    Route::any('add_blog', 'BlogsSetupController@add_blog')->name('add-blog');
    Route::get('blog_delete/{id?}', 'BlogsSetupController@blog_delete')->name('blog-delete');
    Route::get('blog_delete_image/{id?}', 'BlogsSetupController@blog_delete_image')->name('blog-delete-image');
    Route::any('blog_edit/{id?}', 'BlogsSetupController@blog_edit')->name('blog-edit');
    Route::get('blog_images', 'BlogsSetupController@blog_images')->name('blog-images');
    Route::post('update-blog-image', 'BlogsSetupController@update_blog_image')->name('update-blog-image');

    Route::group(['prefix' => 'Slides'], function () {
        Route::any('blog_slides', 'BlogsSetupController@blog_slides')->name('blog-add-slides');
        Route::get('delete_blog_slides/{id?}', 'BlogsSetupController@delete_blog_slides')->name('delete-blog-slides');
        Route::any('edit_blog_slides/{id?}', 'BlogsSetupController@edit_blog_slides')->name('edit-blog-slides');

    });
    Route::group(['prefix' => 'Advertisement'], function () {
        Route::any('blog_advertisement', 'BlogsSetupController@blog_add_advertisement')->name('blog-add-advertisement');
        Route::get('delete_blog_advertisement/{id?}', 'BlogsSetupController@delete_blog_advertisement')->name('delete-blog-advertisement');
        Route::any('edit_blog_advertisement/{id?}', 'BlogsSetupController@edit_blog_advertisement')->name('edit-blog-advertisement');

    });


});

Route::group(['namespace' => 'admin','prefix' => 'Deal of The Day'], function () {
    Route::any('update-deal', 'HotDealController@update_deal')->name('update-deal');
    Route::get('delete_category_blog/{id?}', 'BlogsSetupController@delete_category')->name('blog-delete-category');
    Route::post('edit_category/{id?}', 'BlogsSetupController@edit_category')->name('blog-edit-category');
});