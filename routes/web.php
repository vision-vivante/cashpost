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
//demo
// Route::get('/testing', function() {
// 	dd(Auth::user()->userRoles->first()->role->id);
// });

Route::get('/demo/cron_1', 'DemoController@cron_1');
Route::get('/demo/cron_2', 'DemoController@cron_2');
Route::get('/register/influencer', 'Auth\RegisterController@showinfluencerRegistrationForm');
Route::get('/register/brand', 'Auth\RegisterController@showinbrandRegistrationForm');
Route::post('/validate/{step}', 'Auth\RegisterController@custom_validator');
Route::post('create-request', 'ProjectController@campaign_create_request')->name('create.request');



Route::get('/refresh-csrf', function(){
    return csrf_token();
});
Route::GET('/update-notificatons/{id}', 'NotificationController@update_notification')->name('update_notification');


Route::post('/aiz-uploader', 'AizUploadController@show_uploader');
Route::post('/aiz-uploader/upload', 'AizUploadController@upload');
Route::get('/aiz-uploader/get_uploaded_files', 'AizUploadController@get_uploaded_files');
Route::delete('/aiz-uploader/destroy/{id}', 'AizUploadController@destroy');
Route::post('/aiz-uploader/get_file_by_ids', 'AizUploadController@get_preview_files');
Route::get('/aiz-uploader/download/{id}', 'AizUploadController@attachment_download')->name('download_attachment');

// Route::get('/', 'HomeController@index')->name('home');
// Route::get('/brand', 'HomeController@brand')->name('brand');

Route::get('/influencer', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@brand')->name('brand');

Route::get('/verify/link/{email}', 'HomeController@verification_email');
Route::post('/subscribe_form/', 'HomeController@subscribe_form');

Route::get('send-verification-request', 'HomeController@send_email_verification_request')->name('email.verification');
Route::get('verification-confirmation/{code}', 'HomeController@verification_confirmation')->name('email.verification.confirmation');

Auth::routes(['verify' => true]);
Route::get('/admin/login', 'HomeController@admin_login')->name('admin.login');
Route::get('/users/login', 'HomeController@login')->name('user.login');
//sociallite login
Route::get('/social-login/redirect/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('/social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/language/{locale}', 'LanguageController@changeLanguage')->name('language.change');
Route::get('/package-select', 'PackageController@select_package')->name('select_package');
Route::get('/check', 'UserController@userOnlineStatus');

Route::post('/user-name-check', 'HomeController@user_name_check')->name('user_name_check');
Route::post('/cities/get_city_by_country', 'CityController@get_city_by_country')->name('cities.get_city_by_country');

Route::post('/user-account-type', 'UserController@set_account_type')->name('user.account.type');

Route::group(['middleware' => ['user']], function(){
	Route::get('mark/incomplete','ProjectController@Project_Mark_Incomplete')->name('mark.incomplete');
	Route::get('mark/complete','ProjectController@Project_Mark_Complete')->name('mark.complete');

    Route::post('/package/get-package-purchase-modal', 'PackageController@get_package_purchase_modal')->name('get_package_purchase_modal');
    Route::get('/packages/free-package-purchase/{id}', 'PackageController@package_purchase_free')->name('package_purchase_free');

    Route::post('/packages/get-package-purchase-modal', 'ProjectController@get_bid_modal')->name('get_bid_for_project_modal');


 	Route::post('/influencer/get-hire-modal', 'ProjectController@get_hire_project_modal')->name('get_hire_for_project_modal');	
 	
 	Route::post('/influencer/get-dispute-modal', 'ProjectController@get_disputed_project_modal')->name('get_disputed_project_modal');
 	Route::post('/influencer/dispute-modal', 'ProjectController@dispute_for_project_modal')->name('dispute_for_project_modal');

	//Purchase PackagePayment
	Route::post('purchase-package/payment', 'PackagePaymentController@purchase_package')->name('purchase_package');

});
Route::group(['middleware' => ['stripe']], function(){
	Route::post('/projects/submit-approval', 'ProjectController@project_submit')->name('projects.submit');
	Route::post('/projects/submit-modal', 'ProjectController@submit_proof_for_project_modal')->name('submit_proof_for_project_modal');
	Route::post('/projects/project-disputed','ProjectController@project_disputed')->name('projects.disputed');
	Route::post('/projects/mark-complete', 'ProjectController@project_complete')->name('projects.mark_complete');
	Route::post('cancel-project-request/store', 'CancelProjectController@store')->name('cancel-project-request.store');
	
	Route::post('/interview-chat', 'ChatController@index')->name('call_for_interview');
	Route::post('/chat-reply', 'ChatController@chat_reply')->name('chat.reply');
	Route::post('/chat/old-messages', 'ChatController@get_old_messages')->name('get-old-message');
	Route::post('/hiring-confirmation-store', 'HireController@hire')->name('hiring_confirmation_store');

	//milestone message showing exampleModalLabel
	Route::post('/milestone-requests-message', 'MilestonePaymentController@milestone_request_message')->name('milestone_request_message_show_modal');
	Route::post('/reviews/store', 'ReviewController@store')->name('reviews.store');
	Route::post('wallet-recharge', 'WalletController@rechage')->name('wallet.recharge');
	
	Route::get('/chat', 'ChatController@chat_index')->name('all.messages');
	Route::get('/chat/refresh/{id}', 'ChatController@chat_refresh')->name('chat_refresh');
	Route::get('/hiring-invitation/reject{id}', 'HireController@reject')->name('hiring.reject');

});

Route::group(['middleware' => ['user']], function(){
	Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
	Route::get('/profile-settings', 'ProfileController@user_profile')->name('user.profile');
	Route::get('/projects/running-project', 'ProjectController@my_running_project')->name('projects.my_running_project');
	Route::get('/projects/completed-project', 'ProjectController@my_completed_project')->name('projects.my_completed_project');
	Route::get('/projects/cancelled-project', 'ProjectController@my_cancelled_project')->name('projects.my_cancelled_project');
	Route::get('/projects/cancel-project-request/{id}', 'ProjectController@project_cancel')->name('projects.cancel');
	Route::get('/projects/find-project', 'ProjectController@find_my_all_project')->name('projects.find_project');
   	/*Route::get('/projects/invitation', 'ProjectController@my_invitation_project')->name('projects.invitation_project');*/
   	/*Private  use for invitation */
   	Route::get('/private-projects', 'HireController@private_projects')->name('private_projects');
	Route::get('/project-listing/', 'ProjectController@my_all_project')->name('projects.all_project');
	Route::get('/profile', 'ProfileController@user_view')->name('user.profile_view');
	Route::post('/edit_social_link/{id}', 'ProfileController@edit_social_link')->name('edit.social_link');
	Route::get('/single-chat/{id}', 'ChatController@chat_view')->name('chat_view');
	//hire from interview
   Route::get('/project/{slug}', 'HomeController@project_details')->name('project.details');
	//walletController
	Route::resource('wallet','WalletController');
	Route::get('/freelancer/packages/history', 'PackagePaymentController@freelancer_package_purchase_history_index')->name('freelancer.packages.history');
	Route::get('/client/packages/history', 'PackagePaymentController@freelancer_package_purchase_history_index')->name('client.packages.history');
	Route::get('/user-reviews/{type}', 'ReviewController@review_index')->name('user_review');
	//reviews
	Route::get('/notifications','NotificationController@frontend_listing')->name('frontend.notifications');
	Route::post('/profile-settings/basic-info-update', 'ProfileController@basic_info_update')->name('user_profile.basic_info_update');
	Route::post('/profile-settings/photo-update', 'ProfileController@photo_update')->name('user_profile.photo_update');
	Route::post('/profile-settings/bio-update', 'ProfileController@bio_update')->name('user_profile.bio_update');
	Route::post('/profile-settings/verification-update', 'VerificationController@verification_store')->name('user_profile.verification_store');

});

// Client middleware
	Route::group(['middleware' => ['auth', 'client']], function(){
	Route::resource('/projects', 'ProjectController');
	Route::get('/my-open-projects', 'ProjectController@my_open_project')->name('projects.my_open_project');

	Route::get('/find-influencer', 'ProjectController@find_influencers')->name('projects.find_influencer');

	Route::get('/influencer-detail/{user_name}','HomeController@my_influencers_details')->name('influencer.detail');

	///Route::get('/client/{user_name}', 'HomeController@client_details')->name('client.details');
	Route::get('/client-lists', 'HomeController@client_list')->name('client.lists');

	Route::get('/invition-for-hire-freelancer/{username}', 'HireController@freelancer_invition')->name('invition_for_hire_freelancer');
	Route::post('/invition-for-hire-freelancer/store', 'HireController@store')->name('invition_for_hire_freelancer_sent');

	//Milestone payment
	Route::get('/recieved-milestone-requests', 'MilestonePaymentController@recieved_milestone_request_index')->name('milestone-requests.all');
	Route::post('/milestone-payment-select-modal', 'MilestonePaymentController@show_payment_select_modal')->name('show_payment_select_modal');
	Route::post('/milestone-payment', 'MilestonePaymentController@index')->name('milestone.pay_to_admin');

	//project completed
	Route::get('/projects/edit/{slug}', 'ProjectController@edit')->name('projects.edit');
	Route::get('/projects/destroy/{slug}', 'ProjectController@destroy')->name('projects.destroy');
	Route::get('/project-bids', 'ProjectController@project_bids')->name('project.bids');
	Route::get('/project-done/{id}', 'ProjectController@project_done')->name('projects.complete');
	Route::get('/project-hire-done/{id}', 'ProjectController@project_hire_done')->name('projects.hireDone');

    Route::resource('bookmarked-freelancers', 'BookmarkedFreelancerController');
    Route::get('/bookmarked-freelancers/store/{id}', 'BookmarkedFreelancerController@store')->name('bookmarked-freelancers.store');
	Route::get('/bookmarked-freelancers/destroy/{id}', 'BookmarkedFreelancerController@destroy')->name('bookmarked-freelancers.destroy');
	Route::get('/client/purchased-services', 'ServiceController@client_purchased_services')->name('client.purchased.services');


    Route::get('/service/{id}/cancel', 'ServiceController@cancel_service')->name('services.cancel');
	Route::post('/service/cancel/store', 'ServiceController@cancel_service_store')->name('services.cancel.store');

	Route::get('/client/cancel-requests-services', 'ServiceController@client_cancel_requested_services')->name('client.services.cancel.requests');
	Route::get('/client/cancelled-services', 'ServiceController@client_cancelled_services')->name('client.services.cancelled');

	Route::post('/hire/store', 'HireController@store')->name('hire.store');

});


Route::get('service/show/{slug}', 'ServiceController@show')->name('service.show');
Route::post('/service/package', 'ServiceController@get_service_package_purchase_modal')->name('get_package_service_modal');
Route::post('/service/package-purchase','ServiceController@purchase_service_package')->name('purchase_service_package');

// Freelancer middleware
Route::group(['middleware' => ['auth', 'freelancer']], function(){

    Route::post('/bids/store', 'BiddingController@store')->name('bids.store');


	Route::get('/account-settings', 'ProfileController@user_account')->name('user.account');
	Route::get('/stripe/add-account', 'StripePaymentController@StripeBankAccount')->name('stripe.bank_account');
	Route::get('/stripe/delete-account', 'StripePaymentController@delBankAccount')->name('stripe.bank_account_del');
	Route::post('/stripe/add-account', 'StripePaymentController@StripeAccount')->name('stripe.account');


	Route::post('/profile-settings/portfolio-add', 'PortfolioController@store')->name('user_profile.portfolio_add');
	Route::get('/profile-settings/portfolio-edit/{id}', 'PortfolioController@edit')->name('user_profile.portfolio_edit');
	Route::post('/profile-settings/portfolio-update/{id}', 'PortfolioController@update')->name('user_profile.portfolio_update');
    Route::get('/profile-settings/portfolio-delete/{id}', 'PortfolioController@destroy')->name('user_profile.portfolio_destroy');

	Route::post('/profile-settings/work-experience-add', 'WorkExperienceController@store')->name('user_profile.work_experience_add');
	Route::get('/profile-settings/work-experience-edit/{id}', 'WorkExperienceController@edit')->name('user_profile.work_experience_edit');
	Route::post('/profile-settings/work-experience-update/{id}', 'WorkExperienceController@update')->name('user_profile.work_experience_update');
    Route::get('/profile-settings/work-experience-delete/{id}', 'WorkExperienceController@destroy')->name('user_profile.work_experience_destroy');

	Route::post('/profile-settings/education-info-add', 'FreelancerEducationController@store')->name('user_profile.education_info_add');
	Route::get('/profile-settings/education-info-edit/{id}', 'FreelancerEducationController@edit')->name('user_profile.education_info_edit');
	Route::post('/profile-settings/education-info-update/{id}', 'FreelancerEducationController@update')->name('user_profile.education_info_update');
    Route::get('/profile-settings/education-info-delete/{id}', 'FreelancerEducationController@destroy')->name('user_profile.education_info_destroy');

	Route::post('/freelancer-account-info/store', 'FreelancerAccountController@store')->name('freelancer_account.store');

	Route::get('/bidded-projects', 'ProjectController@bidded_projects')->name('bidded_projects');

	//Route::get('/services', 'ServiceController@index')->name('service.index');
	Route::get('/service/create', 'ServiceController@create')->name('service.create');
	Route::post('/service/store', 'ServiceController@store')->name('service.store');

	Route::get('/service/edit/{slug}', 'ServiceController@edit')->name('service.edit');
	Route::post('/service/update/{slug}', 'ServiceController@update')->name('service.update');
	Route::get('/service/destroy/{slug}', 'ServiceController@destroy')->name('service.destroy');



	//Milestone payment request sending cancel_modal
	Route::post('/partial-payment-modal', 'MilestonePaymentController@request_modal')->name('milestone_payment_request.modal');
	Route::post('/partial-payment-request-store', 'MilestonePaymentController@request_store')->name('partial_payment_request');
	Route::get('/sent-milestone-requests', 'MilestonePaymentController@sent_milestone_request_index')->name('sent-milestone-requests.all');
	Route::get('/recieved-milestone-payment', 'MilestonePaymentController@recieved_milestone_payment_index')->name('recieved_milestone_payment_index');


	//payment history
	Route::get('/send-withdrawal-request', 'PaytoFreelancerController@send_withdrawal_request_index')->name('send_withdrawal_request_to_admin');
	Route::get('/withdrawal-history', 'PaytoFreelancerController@withdrawal_history_index')->name('withdrawal_history_index');
	Route::post('/send-withdrawal-request/store', 'PaytoFreelancerController@send_withdrawal_request_store')->name('store_withdrawal_request_to_admin');

    Route::resource('bookmarked-projects', 'BookmarkedProjectController');
    Route::get('/bookmarked-projects/store/{id}', 'BookmarkedProjectController@store')->name('bookmarked-projects.store');
    Route::get('/bookmarked-projects/destroy/{id}', 'BookmarkedProjectController@destroy')->name('bookmarked-projects.destroy');

    Route::get('/following-clients', 'BookmarkedClientController@index')->name('bookmarked-clients.index');
    Route::get('/following-clients/store/{id}', 'BookmarkedClientController@store')->name('bookmarked-clients.store');
	Route::get('/following-clients/destroy/{id}', 'BookmarkedClientController@destroy')->name('bookmarked-clients.destroy');

	Route::get('/services', 'ServiceController@freelancer_index')->name('service.freelancer_index');
    Route::get('services/purchased', 'ServiceController@sold_services')->name('service.sold');

});

Route::get('/search', 'SearchController@index')->name('search');
Route::get('/search?category={category_slug}', 'SearchController@index')->name('projects.category');
Route::get('/skills/{skill}/{type}', 'SearchController@searchBySkill')->name('search.skill');


Route::get('/private-project-details/{slug}', 'HomeController@private_project_details')->name('private_project.details');

Route::get('/project-lists', 'HomeController@all_projects')->name('projects.list');

// Route::get('/client/{user_name}', 'HomeController@client_details')->name('client.details');
// Route::get('/client-lists', 'HomeController@client_list')->name('client.lists');

Route::get('/freelancer-lists', 'HomeController@freelancer_list')->name('freelancer.lists');
Route::get('/freelancer/{user_name}', 'HomeController@freelancer_details')->name('freelancer.details');

Route::get('/get_freelancer_skills','SkillController@freelancer_skills')->name('get_freelancer_skills');

//Payments

//Paypal
Route::get('/paypal/payment/done', 'PayPalController@getDone')->name('payment.done');
Route::get('/paypal/payment/cancel', 'PayPalController@getCancel')->name('payment.cancel');

//STRIPE
Route::get('/stripe', 'StripePaymentController@index');
Route::post('/stripe/create-checkout-session', 'StripePaymentController@create_checkout_session')->name('stripe.get_token');
Route::any('/stripe/payment/callback', 'StripePaymentController@callback')->name('stripe.callback');
Route::get('/stripe/success', 'StripePaymentController@success')->name('stripe.success');
Route::get('/stripe/cancel', 'StripePaymentController@cancel')->name('stripe.cancel');


//Paystack
Route::get('/paystack/payment/callback', 'PaystackController@handleGatewayCallback');

// SSLCOMMERZ Start
Route::get('/sslcommerz/pay', 'PublicSslCommerzPaymentController@index');
Route::POST('/sslcommerz/success', 'PublicSslCommerzPaymentController@success');
Route::POST('/sslcommerz/fail', 'PublicSslCommerzPaymentController@fail');
Route::POST('/sslcommerz/cancel', 'PublicSslCommerzPaymentController@cancel');
Route::POST('/sslcommerz/ipn', 'PublicSslCommerzPaymentController@ipn');

//Instamojo
Route::get('/instamojo/payment/pay-success', 'InstamojoController@success')->name('instamojo.success');

//Paytm
Route::get('/paytm/index', 'PaytmController@index');
Route::post('/paytm/callback', 'PaytmController@callback')->name('paytm.callback');


Route::get('/{slug}', 'PageController@show_custom_page')->name('custom-pages.show_custom_page');
Route::post('/contact-us', 'ContactController@contactPost')->name('contactPost');