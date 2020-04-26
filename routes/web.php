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

//Payment IPN

Route::get('/ipnbtc', 'PaymentController@ipnBchain')->name('ipn.bchain');
Route::get('/ipnblockbtc', 'PaymentController@blockIpnBtc')->name('ipn.block.btc');
Route::get('/ipnblocklite', 'PaymentController@blockIpnLite')->name('ipn.block.lite');
Route::get('/ipnblockdog', 'PaymentController@blockIpnDog')->name('ipn.block.dog');
Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
Route::post('/ipncoinpaybtc', 'PaymentController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
Route::post('/ipncoinpayeth', 'PaymentController@ipnCoinPayEth')->name('ipn.coinPay.eth');
Route::post('/ipncoinpaybch', 'PaymentController@ipnCoinPayBch')->name('ipn.coinPay.bch');
Route::post('/ipncoinpaydash', 'PaymentController@ipnCoinPayDash')->name('ipn.coinPay.dash');
Route::post('/ipncoinpaydoge', 'PaymentController@ipnCoinPayDoge')->name('ipn.coinPay.doge');
Route::post('/ipncoinpayltc', 'PaymentController@ipnCoinPayLtc')->name('ipn.coinPay.ltc');
Route::post('/ipncoin', 'PaymentController@ipnCoin')->name('ipn.coinpay');
Route::post('/ipncoingate', 'PaymentController@ipnCoinGate')->name('ipn.coingate');


Route::post('/ipnpaytm', 'PaymentController@ipnPayTm')->name('ipn.paytm');
Route::post('/ipnpayeer', 'PaymentController@ipnPayEer')->name('ipn.payeer');
Route::post('/ipnpaystack', 'PaymentController@ipnPayStack')->name('ipn.paystack');
Route::post('/ipnvoguepay', 'PaymentController@ipnVoguePay')->name('ipn.voguepay');
//Payment IPN


Route::get('/', 'FrontendController@index')->name('main');
Route::get('/blogs', 'FrontendController@blog')->name('blog');
Route::get('/more/{slug}', 'FrontendController@details')->name('blog.details');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/faqs', 'FrontendController@faqs')->name('faqs');
Route::get('/menu/{id}/{slug}', 'FrontendController@menu')->name('menu');
Route::get('/service/{slug}', 'FrontendController@service')->name('service');

Route::get('/franchises', 'FrontendController@outlets')->name('franchise.all');
Route::post('/franchises', 'FrontendController@outlets')->name('franchise.all');

Route::get('/franchise/{franchise}', 'FrontendController@franchisesInformation')->name('franchise.info');
Route::post('/franchise/{franchise}', 'FrontendController@franchisesInformation')->name('franchise.info');

Route::get('/franchise/{country}/{franchise}', 'FrontendController@franchisesProducts')->name('franchise.products');
Route::post('/franchise/{country}/{franchise}', 'FrontendController@franchisesProducts')->name('franchise.products');

Route::get('/{country}/outlets', 'FrontendController@outletsBySuburb')->name('outlets.category');
Route::get('/{country}/{state}/outlets', 'FrontendController@outletsBySuburb')->name('outlets.category');
Route::get('/{country}/{state}/{city}/outlets', 'FrontendController@outletsBySuburb')->name('outlets.category');
Route::get('/{country}/{state}/{city}/{neighbourhood}/outlets', 'FrontendController@outletsBySuburb')->name('outlets.category');
Route::get('/{country}/{state}/{city}/{neighbourhood}/{suburb}/outlets', 'FrontendController@outletsBySuburb')->name('outlets.category');

Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');
Route::get('/contact-us', 'FrontendController@contactUs')->name('contact-us');
Route::post('/contact-us', 'FrontendController@contactSubmit')->name('contact-us');

Auth::routes();


Route::group(['prefix' => 'user'], function () {

    Route::get('authorization', 'HomeController@authCheck')->name('user.authorization');
    Route::post('verification', 'HomeController@sendVcode')->name('user.send-vcode');
    Route::post('smsVerify', 'HomeController@smsVerify')->name('user.sms-verify');
    Route::post('verify-email', 'HomeController@sendEmailVcode')->name('user.send-emailVcode');
    Route::post('postEmailVerify', 'HomeController@postEmailVerify')->name('user.email-verify');

Route::group(['middleware' => ['auth','CheckStatus']], function() {

        Route::get('/home', 'HomeController@index')->name('home');

        //user Deposit
        Route::get('/deposit', 'HomeController@deposit')->name('deposit');
        Route::post('/deposit', 'HomeController@deposit')->name('deposit');
        Route::post('/deposit-data-insert', 'HomeController@depositDataInsert')->name('deposit.data-insert');
        Route::get('/deposit-preview', 'HomeController@depositPreview')->name('user.deposit.preview');
        Route::post('/deposit-confirm', 'PaymentController@depositConfirm')->name('deposit.confirm');

        Route::get('/transaction-log', 'HomeController@activity')->name('user.trx');
        Route::get('/deposit-log', 'HomeController@depositLog')->name('user.depositLog');


        Route::get('change-password', 'HomeController@changePassword')->name('user.change-password');
        Route::post('change-password', 'HomeController@submitPassword')->name('user.change-password');
        Route::get('edit-profile', 'HomeController@editProfile')->name('edit-profile');
        Route::post('edit-profile', 'HomeController@submitProfile')->name('edit-profile');


        /*Merchant */
        Route::get('/send-money', 'HomeController@sendMoney')->name('send.money');
        Route::post('/send-money', 'HomeController@sendMoneyCheck')->name('send.money.check');
        Route::get('/send-money/{trx}', 'HomeController@sendMoneyPreview')->name('send.money.preview');
        Route::post('/send-confirmed', 'HomeController@sendingConfirm')->name('send.confirm');
        Route::get('/send-invoice/{trx}', 'HomeController@sendInvoice')->name('send.invoice');
        Route::get('/send-history', 'HomeController@sendingLog')->name('sendingLog');


        Route::get('/transfer-money','TransferMoneyController@transferMoney')->name('transfer.money');
        Route::post('/transfer-money', 'TransferMoneyController@transferMoneyCheck')->name('transfer.money.check');
        Route::get('/transfer-money/{trx}', 'TransferMoneyController@transferMoneyPreview')->name('transfer.money.preview');
        Route::post('/transfer-confirmed', 'TransferMoneyController@TransferConfirm')->name('transfer.confirm');
        Route::get('/transfer-invoice/{trx}', 'TransferMoneyController@transferInvoice')->name('transfer.invoice');
        Route::get('/transfer-log', 'TransferMoneyController@transferLog')->name('transfer.log');

        Route::get('/payout-money', 'HomeController@withdraw')->name('merchant.withdraw');
        Route::post('/payout-money', 'HomeController@trxCheck')->name('withdraw.trxCheck');
        Route::post('/payout-confirm', 'HomeController@withdrawConfirm')->name('withdrawConfirm');
        Route::post('/payout-confirm', 'HomeController@withdrawConfirm')->name('withdrawConfirm');
        Route::get('/payout-log', 'HomeController@withdrawLog')->name('withdrawLog');


        //notifications
        Route::resource('notifications','NotificationController');
        Route::get('/read-notification/{id}','NotificationController@readNotification')->name('read-notification');
        Route::get('/clear-notifications','NotificationController@clearNotifications')->name('clear-notifications');

        //Outlets
        Route::get('/franchise/{type}','Common\OutletsController@index')->name('outlets');
        Route::get('/franchise/{outlet}/{department}','Common\OutletsController@outletDepartments')->name('outlet.departments');
        Route::get('/franchise/{outlet}/{type}/{department}','Common\OutletsController@outletProducts')->name('outlet.products');

        //delivery locations
        Route::resource('contact-groups', 'ContactGroupController');
        Route::any('add-contact-to-group','ContactGroupController@addContactToGroup')->name('add-contact-to-group');
        Route::any('update-contact-group','ContactGroupController@update')->name('update-contact-group');
        Route::any('share-contact-group','ContactGroupController@shareContactGroup')->name('share-contact-group');
        Route::any('delete-contact-group','ContactGroupController@destroy')->name('delete-contact-group');



        //delivery locations
        Route::resource('delivery-locations', 'DeliveryLocationsController');
        Route::any('get-delivery-option/{id}','DeliveryLocationsController@getDeliveryOption')->name('get-delivery-option');
        Route::any('delete-delivery-option','DeliveryLocationsController@destroy')->name('delete-delivery-option');
        Route::any('share-delivery-location','DeliveryLocationsController@shareDeliveryOption')->name('share-delivery-location');
        Route::any('update-delivery-option','DeliveryLocationsController@update')->name('update-delivery-option');

        //Sell Airtime
        Route::resource('sell-airtime', 'SellAirTimeController');
        Route::any('airtime-sells', 'SellAirTimeController@airTimeSells')->name('airtime-sells');
        Route::any('sell-airtime-preview', 'SellAirTimeController@airTimepreview')->name('sell-airtime-preview');
        Route::any('sell-airtime-confirm', 'SellAirTimeController@airTimeConfirm')->name('sell-airtime-confirm');

        //Direct Withdrawal Requests
        Route::resource('withdrawal-requests', 'WithdrawalRequests');
        Route::post('delete-withdrawal-requests',  'WithdrawalRequests@destroy')->name('delete-withdrawal-requests');
        Route::get('withdrawal-via-e-wallet',  'WithdrawalRequests@usingEwallet')->name('withdrawal-via-e-wallet');
        Route::get('withdrawal-via-e-bank-transfer',  'WithdrawalRequests@usingBankTransfer')->name('withdrawal-via-e-bank-transfer');

        //Buy Airtime
        Route::resource('buy-airtime', 'BuyAirTimeController');

        //shopping request
        Route::resource('shopping-requests', 'ShoppingRequestController');
        Route::any('pay-shopping-requests', 'ShoppingRequestController@pay')->name('pay-shopping-requests');
        Route::any('cancel-shopping-requests', 'ShoppingRequestController@cancel')->name('cancel-shopping-requests');
        Route::any('delete-shopping-requests', 'ShoppingRequestController@destroy')->name('delete-shopping-requests');

        //Contacts
        Route::resource('contacts', 'ContactController');
        Route::post('/update-contact/{contact}','ContactController@update')->name('update-contact');
        Route::get('/contact/{contact}','ContactController@singleUser')->name('contact');
        Route::get('/delete-contact/{contact}','ContactController@destroy')->name('delete-contact');
        Route::get('/delete-all-contacts','ContactController@destroyAll')->name('delete-all-contacts');

        Route::post('/search-contacts','ContactController@searchContacts')->name('search-contacts');
        Route::any('/contacts-import','ContactController@contactsImport')->name('contacts-import');
        Route::post('/contacts-import-save','ImportsController@importGoogleCSVContacts')->name('contacts-import-save');
        Route::any('/contacts-export','ContactController@contactsExport')->name('contacts-export');
        Route::any('/all-contacts-export','ContactController@allContactsExport')->name('all-contacts-export');
        //Route::any('/contact/{slug}','ContactController@viewContact')->name('view-contact');
        Route::any('/delete-contact-share/{user_id}/{id}','ContactController@deleteContactShare')->name('delete-contact-share');
        Route::post('/contact-group-update','ContactController@assignGroupContact')->name('contact-group-update');
        Route::any('/share-contact','ContactController@shareContact')->name('share-contact');

        //Shopping items and Lists
        Route::post('/share-shopping-item','Common\ShoppingItemController@shareShoppingItem')->name('share-shopping-item');
        Route::post('/share-shopping-list','Common\ShoppingListController@shareShoppingList')->name('share-shopping-list');
        Route::post('/add-product-to-shopping-items','Common\ShoppingItemController@addProductToShoppingItems')->name('add-product-to-shopping-items');
        Route::post('/search-shopping-items','Common\ShoppingItemController@index')->name('search-shopping-items');
        Route::get('/download-shopping-list/{groud_id}','Common\ShoppingListController@exportShoppingGroupItems')->name('download-shopping-list');
        Route::post('/shopping-list-request','Common\ShoppingListController@shoppingListPurchaseRequest')->name('shopping-list-request');
        Route::get('/all-shopping-items-export','Common\ShoppingItemController@exportAllShoppingItems')->name('all-shopping-items-export');
        Route::get('/shopping-product-list/{slug}','Common\ShoppingItemController@showShoppingList')->name('shopping-product-list');
        Route::post('/shopping-items-import-save','ImportsController@importShoppingItemsCSV')->name('shopping-items-import-save');
        Route::get('/shopping-product/{slug}','Common\ShoppingItemController@showShoppingProduct')->name('shopping-product');
        Route::any('/shopping-item/{id}','Common\ShoppingItemController@showShoppingItem')->name('shopping-item');
        Route::any('/shopping-items','Common\ShoppingItemController@index')->name('shopping-items');
        Route::get('/shopping-items-import','Common\ShoppingItemController@import')->name('shopping-items-import');
        Route::get('/shopping-items-export','Common\ShoppingItemController@export')->name('shopping-items-export');
        Route::post('/shopping-item-group-update','Common\ShoppingItemController@assignGroupItem')->name('shopping-item-group-update');
        Route::any('/add-shopping-item','Common\ShoppingItemController@addShoppingItem')->name('add-shopping-item');
        Route::any('/save-shopping-item','Common\ShoppingItemController@saveShoppingItem')->name('save-shopping-item');
        Route::any('/edit-shopping-item/{id}','Common\ShoppingItemController@editShoppingItem')->name('edit-shopping-item');
        Route::any('/update-shopping-item/{id}','Common\ShoppingItemController@updateShoppingItem')->name('update-shopping-item');
        Route::any('/delete-shopping-item','Common\ShoppingItemController@deleteShoppingItem')->name('delete-shopping-item');
        Route::any('/delete-from-group-shopping-item/{group_id}/{contact_id}','Common\ShoppingItemController@deleteFromGroupContact')->name('delete-from-group-shopping-item');


        //Shopping List Controller
        Route::get('/shopping-lists', 'Common\ShoppingListController@index')->name('shopping-list');
        Route::any('/shopping-list-create', 'Common\ShoppingListController@create')->name('shopping-list-create');
        Route::any('/shopping-list-save', 'Common\ShoppingListController@save')->name('shopping-list-save');
        Route::any('/shopping-list-update', 'Common\ShoppingListController@update')->name('shopping-list-update');
        Route::any('/shopping-list-destroy', 'Common\ShoppingListController@destroy')->name('shopping-list-destroy');

        //Notes Controller
        Route::get('/notes', 'Common\NoteController@index')->name('notes');
        Route::post('/share-goup-notes', 'Common\NoteController@shareNoteGroup')->name('share-goup-notes');
        Route::any('/note-create', 'Common\NoteController@create')->name('note-create');
        Route::any('/note-update', 'Common\NoteController@update')->name('note-update');
        Route::any('/note-destroy/{id}', 'Common\NoteController@destroy')->name('note-destroy');

        //Links Controller
        Route::get('/bookmark-links', 'Common\LinkController@index')->name('bookmark-links');
        Route::post('/share-group-links', 'Common\LinkController@shareLinkGroup')->name('share-group-links');
        Route::any('/link-create', 'Common\LinkController@create')->name('link-create');
        Route::any('/link-save/{id}', 'Common\LinkController@save')->name('link-save');
        Route::any('/link-edit/{id}', 'Common\LinkController@edit')->name('link-edit');
        Route::any('/link-update', 'Common\LinkController@update')->name('link-update');
        Route::any('/link-destroy', 'Common\LinkController@destroy')->name('link-destroy');

        //Group Link Routes
        Route::get('/all-group-links', 'Common\GroupLinkController@index')->name('all-group-links');
        Route::any('/group-create', 'Common\GroupLinkController@create')->name('group-link-create');
        Route::any('/group-edit/{id}', 'Common\GroupLinkController@edit')->name('group-link-edit');
        Route::any('/group-update', 'Common\GroupLinkController@update')->name('group-link-update');
        Route::any('/group-links/{id}','Common\GroupLinkController@groupUrls')->name('group-links');
        Route::any('/group-destroy', 'Common\GroupLinkController@destroy')->name('group-link-destroy');

        //Group Notes Routes
        Route::get('/groups-note', 'Common\GroupNoteController@index')->name('groups-note');
        Route::any('/group-note-create', 'Common\GroupNoteController@create')->name('group-note-create');
        Route::any('/group-note-update', 'Common\GroupNoteController@update')->name('group-note-update');
        Route::any('/group-note-destroy', 'Common\GroupNoteController@destroy')->name('group-note-destroy');


        //Polls
        Route::resource('polls', 'PollController');
        Route::get('created-poll/{poll}', 'PollController@createdPoll')->name('created-poll');
        Route::post('/update-poll/{poll}','PollController@update')->name('update-poll');
        Route::get('/poll/{poll}','PollController@singleUser')->name('poll');
        Route::get('/delete-poll/{poll}','PollController@destroy')->name('delete-poll');

        //Group Contacts
        Route::resource('contacts-groups', 'ContactGroupController');


        /*Normal User*/
        Route::post('/send-money-user', 'HomeController@sendMoneyCheckUser')->name('send.money.user');


        Route::get('supportTicket', 'HomeController@supportTicket')->name('user.ticket');
        Route::get('openSupportTicket', 'HomeController@openSupportTicket')->name('user.ticket.open');
        Route::post('openSupportTicket', 'HomeController@storeSupportTicket')->name('user.ticket.store');
        Route::get('supportMessage/{ticket}', 'HomeController@supportMessage')->name('user.message');
        Route::put('storeSupportMessage/{ticket}', 'HomeController@supportMessageStore')->name('user.message.store');

    });

});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminLoginController@index')->name('admin.loginForm');
    Route::post('/', 'AdminLoginController@authenticate')->name('admin.login');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {


        Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');


        // General Settings
        Route::get('/general-settings', 'GeneralSettingController@GenSetting')->name('admin.GenSetting');
        Route::post('/general-settings', 'GeneralSettingController@UpdateGenSetting')->name('admin.UpdateGenSetting');

        //Contact Setting
        Route::get('contact-setting', 'GeneralSettingController@getContact')->name('contact-setting');
        Route::put('contact-setting/{id}', 'GeneralSettingController@putContactSetting')->name('contact-setting-update');


        // Admin Settings
        Route::get('/change-password', 'AdminController@changePassword')->name('admin.changePass');
        Route::post('/change-password', 'AdminController@updatePassword')->name('admin.changePass');
        Route::get('/profile', 'AdminController@profile')->name('admin.profile');
        Route::post('/profile', 'AdminController@updateProfile')->name('admin.profile');


        // Country  Settings
        Route::resource('continent', 'ContinentController');
        Route::resource('country', 'CountryController');
        Route::resource('state', 'StateController');
        Route::resource('city', 'CityController');
        Route::resource('neighbourhood', 'NeighbourhoodController');
        Route::resource('suburb', 'SuburbController');
        Route::resource('merchant', 'MerchantController');

        //Outlets settings
        Route::resource('outlet', 'OutletController');
        Route::resource('outlet-cat', 'OutletCatController');

        //Outlet products
        Route::resource('product', 'ProductController');
        Route::get('product-assign-outlet/{id}', 'ProductController@assign')->name('product.assign.outlet');
        Route::post('product-assign-outlet', 'ProductController@createAssignment')->name('product.assign.outlet1');

        //Outlet products
        Route::resource('product-category', 'ProCatController');
        Route::resource('product-sub-category', 'ProSubCatController');

        Route::resource('outlet-cat-outlet', 'OutletCatOutletController');
        Route::get('outlet-cat-outlet-create/{id}', 'OutletCatOutletController@create')->name('outlet-cat-outlet-create');
        Route::get('outlet-cat-outlet-delete/{outlet_id}/{outlet_cat_id}', 'OutletCatOutletController@edit')->name('outlet-cat-outlet-delete');


        //Gateway
        Route::get('/gateway', 'GatewayController@show')->name('gateway');
        Route::post('/gateway', 'GatewayController@update')->name('update.gateway');

        //Deposit
        Route::get('/deposits', 'DepositController@index')->name('deposits');
        Route::get('/deposits/requests', 'DepositController@requests')->name('deposits.requests');
        Route::put('/deposit/approve/{id}', 'DepositController@approve')->name('deposit.approve');
        Route::get('/deposit/{deposit}/delete', 'DepositController@destroy')->name('deposit.destroy');

        //    Blog Controller
        Route::get('blog', 'PostController@index')->name('admin.blog');
        Route::get('blog/create', 'PostController@create')->name('blog.create');
        Route::post('blog/create', 'PostController@store')->name('blog.store');
        Route::delete('blog/delete', 'PostController@destroy')->name('blog.delete');
        Route::get('blog/edit/{id}', 'PostController@edit')->name('blog.edit');
        Route::post('blog-update', 'PostController@updatePost')->name('blog.update');

        /*Manage Faq*/
        Route::get('faqs-create', 'FaqController@createFaqs')->name('faqs-create');
        Route::post('faqs-create', 'FaqController@storeFaqs')->name('faqs-create');
        Route::get('faqs', 'FaqController@allFaqs')->name('faqs-all');
        Route::get('faqs-edit/{id}', 'FaqController@editFaqs')->name('faqs-edit');
        Route::put('faqs-edit/{id}', 'FaqController@updateFaqs')->name('faqs-update');
        Route::delete('faqs-delete', 'FaqController@deleteFaqs')->name('faqs-delete');

        /*Manage Faq*/
        Route::get('service-faqs-create', 'ServiceFaqController@createFaqs')->name('service-faqs-create');
        Route::post('service-faqs-create', 'ServiceFaqController@storeFaqs')->name('service-faqs-store');
        Route::get('service-faqs', 'ServiceFaqController@allFaqs')->name('service-faqs');
        Route::get('service-faqs-edit/{id}', 'ServiceFaqController@editFaqs')->name('service-faqs-edit');
        Route::put('service-faqs-edit/{id}', 'ServiceFaqController@updateFaqs')->name('service-faqs-update');
        Route::delete('service-faqs-delete', 'ServiceFaqController@deleteFaqs')->name('service-faqs-delete');

        //    SubscriberController
        Route::get('/subscribers', 'SubscriberController@manageSubscribers')->name('manage.subscribers');
        Route::post('/update-subscribers', 'SubscriberController@updateSubscriber')->name('update.subscriber');
        Route::get('/send-email', 'SubscriberController@sendMail')->name('send.mail.subscriber');
        Route::post('/send-email', 'SubscriberController@sendMailsubscriber')->name('send.email.subscriber');

        //    Testimonial Controller
        Route::get('testimonial', 'TestimonialController@index')->name('admin.testimonial');
        Route::get('testimonial/create', 'TestimonialController@create')->name('testimonial.create');
        Route::post('testimonial/create', 'TestimonialController@store')->name('testimonial.store');
        Route::delete('testimonial/delete', 'TestimonialController@destroy')->name('testimonial.delete');
        Route::get('testimonial/edit/{id}', 'TestimonialController@edit')->name('testimonial.edit');
        Route::post('testimonial-update', 'TestimonialController@updatePost')->name('testimonial.update');

        //User Management
        Route::get('users', 'UserManageController@users')->name('users');
        Route::get('user-search', 'UserManageController@userSearch')->name('search.users');
        Route::get('user/{user}', 'UserManageController@singleUser')->name('user.single');
        Route::put('user/pass-change/{user}', 'UserManageController@userPasschange')->name('user.passchange');
        Route::put('user/status/{user}', 'UserManageController@statupdate')->name('user.status');
        Route::get('mail/{user}', 'UserManageController@userEmail')->name('user.email');
        Route::post('/sendmail', 'UserManageController@sendemail')->name('send.email');
        Route::get('/user-login-history/{id}', 'UserManageController@loginLogsByUsers')->name('user.login.history');
        Route::get('/user-balance/{id}', 'UserManageController@ManageBalanceByUsers')->name('user.balance');
        Route::post('/user-balance', 'UserManageController@saveBalanceByUsers')->name('user.balance.update');
        Route::get('/user-banned', 'UserManageController@banusers')->name('user.ban');
        Route::get('login-logs/{user?}', 'UserManageController@loginLogs')->name('user.login-logs');
        Route::get('/user-transaction/{id}', 'UserManageController@userTrans')->name('user.trans');
        Route::get('/user-deposit/{id}', 'UserManageController@userDeposit')->name('user.deposit');
        Route::get('/user-withdraw/{id}', 'UserManageController@userWithdraw')->name('user.withdraw');

        //Email Template
        Route::get('/template', 'EtemplateController@index')->name('email.template');
        Route::post('/template-update', 'EtemplateController@update')->name('template.update');
        //Sms Api
        Route::get('/sms-api', 'EtemplateController@smsApi')->name('sms.api');
        Route::post('/sms-update', 'EtemplateController@smsUpdate')->name('sms.update');


        /*Menu Control*/
        Route::get('menu-create', 'WebSettingController@createMenu')->name('menu-create');
        Route::post('menu-create', 'WebSettingController@storeMenu')->name('menu-create');
        Route::get('menu-control', 'WebSettingController@manageMenu')->name('menu-control');
        Route::get('menu-edit/{id}', 'WebSettingController@editMenu')->name('menu-edit');
        Route::post('menu-update/{id}', 'WebSettingController@updateMenu')->name('menu-update');
        Route::delete('menu-delete', 'WebSettingController@deleteMenu')->name('menu-delete');


        //  Manage Social Controller
        Route::get('manage-social', 'WebSettingController@manageSocial')->name('manage-social');
        Route::post('manage-social', 'WebSettingController@storeSocial')->name('manage-social');
        Route::get('manage-social/{product_id?}', 'WebSettingController@editSocial')->name('social-edit');
        Route::put('manage-social/{product_id?}', 'WebSettingController@updateSocial')->name('social-edit');
        Route::post('delete-social', 'WebSettingController@destroySocial')->name('del.social');

        //  Admin Support Controller
        Route::get('supportTickets', 'AdminController@supportTicket')->name('admin.ticket');
        Route::get('ticketReply/{id}', 'AdminController@ticketReply')->name('admin.ticket.reply');
        Route::get('pendingSupportTickets', 'AdminController@pendingSupportTicket')->name('admin.pending.ticket');
        Route::put('ticketReplySend/{id}', 'AdminController@ticketReplySend')->name('admin.ticket.send');


        // Web Settings
        Route::get('manage-logo', 'WebSettingController@manageLogo')->name('manage-logo');
        Route::post('manage-logo', 'WebSettingController@updateLogo')->name('manage-logo');

        Route::get('manage-text', 'WebSettingController@manageFooter')->name('manage-footer');
        Route::put('manage-text', 'WebSettingController@updateFooter')->name('manage-footer-update');

        Route::get('/achievement', 'WebSettingController@achievement')->name('admin.achievement');
        Route::post('/achievement', 'WebSettingController@updateAchievement')->name('admin.achievement');

        Route::get('/about', 'WebSettingController@getAbout')->name('admin.about');
        Route::post('/about', 'WebSettingController@updateAbout')->name('admin.about');
        Route::post('/testimonial-text', 'WebSettingController@testimonialText')->name('testimonial.text');



    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
});


/*============== User Password Reset Route list ===========================*/
Route::get('user-password/reset', 'User\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('user-password/email', 'User\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('user-password/reset/{token}', 'User\ResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('user-password/reset', 'User\ResetPasswordController@reset');
