<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\backend\DashboardController;

use App\Http\Controllers\backend\RoleController;

use App\Http\Controllers\backend\StatesController;

use App\Http\Controllers\backend\ProjectController;

use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\TeamsController;

use App\Http\Controllers\Admin\ColorMasterController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\backend\CategoryController;

use App\Http\Controllers\DashbordController;

// use App\Http\Controllers\Usercontroller;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\backend\VideoCategoryController;

use App\Http\Controllers\backend\NewsletterController;

use App\Http\Controllers\backend\InformationController;

use App\Http\Controllers\backend\SubscriptionsController;

use App\Http\Controllers\backend\PagesController;

use App\Http\Controllers\backend\ServiceController;

use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\VideoController;

use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\ClientController;
use App\Http\Controllers\backend\VisitorUserController;
use App\Http\Controllers\backend\DifficultyController;
use App\Http\Controllers\backend\TagController;
use App\Http\Controllers\backend\HomePageController;
use App\Http\Controllers\backend\ProfilePageController;
use App\Http\Controllers\backend\BadgeController;
use App\Http\Controllers\backend\SportsController;
use App\Http\Controllers\backend\MaliciousVideoController;
use App\Http\Controllers\backend\MaliciousProfessionalController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\backend\ModuleController;
use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backend\AdsController;
use App\Http\Controllers\backend\VideoAdsController;
use App\Http\Controllers\backend\SubscriptionHestoryController;
use App\Http\Controllers\LessonController;
use App\Console\Commands\UpdateUserAdsStatus;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/test-mail', [RegisterController::class, 'Testmail']);

Route::get('/send-email-test', [FrontendController::class, 'SendMailTest'])->name('send.email.test');
Route::get('/expire-adds-data', [FrontendController::class, 'ExpireAddsData'])->name('expire.adds.data');
Route::get('/expire-subscription', [FrontendController::class, 'ExpireSubscription'])->name('expire.subscription');
Route::get('/expire-profile-ads', [UpdateUserAdsStatus::class, 'handle'])->name('expire.profile.ads');
Route::get('/export-subscription-history', [SubscriptionHestoryController::class, 'exportSubscriptionHistory'])->name('subscription.export');
Route::get('/export-video-ads', [VideoAdsController::class, 'exportVideoAds'])->name('video.ads.export');
Route::get('/invoices/{id}', [VideoAdsController::class, 'generateInvoicePdf'])->name('invoice.generate_pdf');

// Route::post('/language-switch', [LanguageController::class, 'languageSwitch'])->name('language.switch');

Route::get('lang/{locale}', function ($locale) {

    if (in_array($locale, ['en', 'fr'])) {
        Session::put('locale', $locale);
    }
    return Redirect::back();
});

Route::group(['middleware' => ['public_remove']], function () {
    Auth::routes();




    // Route::post('/language-switch', [LanguageController::class, 'languageSwitch'])->name('language.switch');
    // Route::get('test-google-meet', [FrontendController::class, 'testGoogleMeet'])->name('front.physio');
    // Route::get('test-google-meet', [FrontendController::class, 'testGoogleMeet'])->name('front.physio');
    Route::post('/user-register', [FrontendController::class, 'SubmitRegisterForm'])->name('store-register-form');
    Route::get('/', [FrontendController::class, 'Home'])->name('front.home');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('become-physio', [FrontendController::class, 'Physio'])->name('front.physio');
    Route::post('news-letter', [FrontendController::class, 'StoreNewsLetter'])->name('store-news-letter');
    Route::post('get-in-touch', [FrontendController::class, 'StoreGetInTouch'])->name('store-get-in-touch');

    Route::post('/store-message', [MessageController::class, 'store'])->name('store.message');
    Route::post('/get-messages', [MessageController::class, 'getMessages'])->name('get.messages');
    Route::get('/get-chat-users', [MessageController::class, 'getUsersWithChats'])->name('get.chat.users');


    //This will move in private route later
    Route::get('/physio-bio/{slug}/{user_id?}', [FrontendController::class, 'PhysioBio'])->name('front.physio.bio');

    Route::post('/physio-bio/malicious-profile', [FrontendController::class, 'MaliciousProfile'])->name('malicious.report.user');
    Route::post('/physio-bio/malicious-profile-video', [FrontendController::class, 'MaliciousVideo'])->name('malicious.report.video');

    //add route for notification
    Route::post('/update-notification-status', [FrontendController::class, 'UpdateNotificationStatus'])->name('update.notification.status');
    Route::get('/notifications', [FrontendController::class, 'Notifications'])->name('front.notifications');


    Route::put('/profile/add-video', [FrontendController::class, 'ProfileAddVideo'])->name('add.video');
    Route::post('/profile/add-lesson-video', [FrontendController::class, 'AddLessonVideo'])->name('add.lesson.video');
    Route::put('/profile/update-seo', [FrontendController::class, 'ProfileUpdateSeo'])->name('update.seo');
    Route::post('/profile/get-video-html-data', [FrontendController::class, 'GetVideoHtmlData'])->name('get.video.htmldata');
    Route::post('/profile/edit-video', [FrontendController::class, 'GetVideoHtmlData'])->name('profile.video.edit');
    Route::put('/profile/update-video', [FrontendController::class, 'updateVideo'])->name('profile.video.update');
    Route::post('/profile/delete-video', [FrontendController::class, 'DeleteVideo'])->name('delete-video');
    Route::post('/profile/delete-slider', [FrontendController::class, 'DeleteSlider'])->name('delete-slider');
    Route::get('/changepassword', [FrontendController::class, 'ChangePassword'])->name('changepassword');
    Route::post('/confirm-password', [FrontendController::class, 'UpdatePassword'])->name('confirm.password');
    Route::get('/video-payment/{ads}/{video}', [FrontendController::class, 'VideoPayment'])->name('video.payment');
    Route::get('/video-payment/success', [FrontendController::class, 'VideoPaymentSuccess'])->name('payment.success.video');
    Route::get('/video-payment/fail', [FrontendController::class, 'VideoPaymentFail'])->name('payment.fail.video');


    Route::get('/profile-payment/{ads}/{profile}', [FrontendController::class, 'ProfilePayment'])->name('profile.payment');
    Route::get('/profile-payment/success', [FrontendController::class, 'ProfilePaymentSuccess'])->name('payment.success.profile');
    Route::get('/profile-payment/fail', [FrontendController::class, 'ProfilePaymentFail'])->name('payment.fail.profile');


    Route::get('/pages/{slug}', [FrontendController::class, 'pages'])->name('pages');

    Route::put('/physio-bio/update', [FrontendController::class, 'UpdateProfessionalProfile'])->name('update.professional.profile');
    Route::put('/update-document-professional-user', [FrontendController::class, 'uploadDocument'])->name('update.document.professional.user');
    Route::post('/update-thumbnail-delete', [FrontendController::class, 'DeleteThumbnail'])->name('update.thumbnail.delete');

    Route::post('/user-send-otp', [FrontendController::class, 'SendUserOtp'])->name('user.send.otp');
    Route::post('user-otp-verify', [FrontendController::class, 'VerifyOtp'])->name('user.otp.verify');
    Route::post('user-set-password', [FrontendController::class, 'UserSetPassword'])->name('user.set.password');

    Route::post('/follow', [FrontendController::class, 'follow'])->name('follow');
    Route::delete('/unfollow', [FrontendController::class, 'unfollow'])->name('unfollow');

    Route::get('/contactus', [FrontendController::class, 'ContactUs'])->name('front.contactus');
    Route::get('/how-it-work', [FrontendController::class, 'HowItWork'])->name('front.how-it-work');
    Route::get('/video-list', [FrontendController::class, 'VideoList'])->name('front.video-list');

    Route::get('/professional-list', [FrontendController::class, 'ProfessionalList'])->name('front.professional-list');

    Route::post('/unlike-video', [FrontendController::class, 'UnLikeVideo'])->name('unlike.video');
    Route::post('/like-video', [FrontendController::class, 'LikeVideo'])->name('like.video');
    Route::get('/get-appointment', [FrontendController::class, 'GetAppointment'])->name('front.get-appointment');
    Route::post('/unlike-professional', [FrontendController::class, 'UnLikeProfessional'])->name('unlike.professional');
    Route::post('/like-professional', [FrontendController::class, 'LikeProfessional'])->name('like.professional');
    Route::get('/my-favourites', [FrontendController::class, 'MyFavourites'])->name('my.favourites');
    Route::get('/my-plans', [FrontendController::class, 'MyPlans'])->name('my.plans');
    Route::post('/edit-appointment', [FrontendController::class, 'editAppointment'])->name('front.edit.appointment');
    Route::put('/update-appointment', [FrontendController::class, 'updateAppointment'])->name('front.update-appointment');
    Route::post('/delete-appointment', [FrontendController::class, 'deleteAppointment'])->name('front.delete.appointment');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('resetpasswordemail', [ResetPasswordController::class, 'forgotPasswordSendEmail'])->name('resetpasswordemail');
    Route::get('reset-password/{token}/{ismobile?}', [ResetPasswordController::class, 'showPasswordResetForm']);
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');
    Route::get('check-login-credential', [LoginController::class, 'checkCredential'])->name('check-credential');

    // Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('register', [RegisterController::class, 'Register'])->name('registration');
    Route::post('register', [RegisterController::class, 'Store'])->name('post.registration');

    Route::get('payment/{subscription}', [PaymentController::class, 'payment'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment-fail', [PaymentController::class, 'paymentFail'])->name('payment.fail');
    Route::post('add-video-watch-count', [VideoController::class, 'addVideoWatchCount'])->name('add.video.watch-count');
    Route::post('lesion/', [VideoController::class, 'addVideoWatchCount'])->name('add.video.watch-count');

    Route::resource('lesson', LessonController::class);
    Route::get('get-more-lesson-videos/{page}/{lesson_id?}', [LessonController::class, 'getMoreLessonVideos'])->name('get.more.lesson.videos');
    Route::post('add-video-to-lesson', [LessonController::class, 'addVideoToLesson'])->name('add-video-to-lesson');
    Route::get('get-add-lesson-video-html', [LessonController::class, 'GetLessonDrpHtml'])->name('get-add-lesson-video-html');
    Route::get('/get-appointment', [FrontendController::class, 'GetAppointment'])->name('front.get-appointment');
    Route::post('/online-appointments', [FrontendController::class, 'OnlineAppointments'])->name('online.appointments');
    Route::post('/edit-appointment', [FrontendController::class, 'editAppointment'])->name('front.edit.appointment');
    Route::post('/update-appointment', [FrontendController::class, 'updateAppointment'])->name('front.update-appointment');
    Route::group(['middleware' => ['is_admin', 'auth']], function () {
        Route::resource('backend/role', RoleController::class);
        Route::prefix('backend/category')->group(function () {
            Route::get('/', [CategoryController::class, 'Index'])->name('list.category');
            Route::get('create', [CategoryController::class, 'Create'])->name('add.category');
            Route::post('store', [CategoryController::class, 'Store'])->name('store.category');
            Route::get('{id}/edit', [CategoryController::class, 'Edit'])->name('edit.category');
            Route::post('update/{id}', [CategoryController::class, 'Update'])->name('update.category');
            Route::post('delete', [CategoryController::class, 'Delete'])->name('delete.category');
            Route::post('chage-status-category', [CategoryController::class, 'ChageStatusCategory'])->name('chage-status-category');
        });

        Route::prefix('backend/')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('video-category', 'App\Http\Controllers\backend\VideoCategoryController');
            Route::post('get-sub-category-list', [VideoCategoryController::class, 'GetSubCategoryList'])->name('get-sub-category-list');
            Route::post('change-status-video-category', [VideoCategoryController::class, 'ChangeStatusVideoCategory'])->name('change-status-video-category');
            Route::resource('subscriptions', 'App\Http\Controllers\backend\SubscriptionsController');
            Route::post('change-status-subscription', [SubscriptionsController::class, 'ChangeStatusSubscription'])->name('change-status-subscription');
            Route::resource('page', 'App\Http\Controllers\backend\PagesController');

            Route::get('malicious-videos', [MaliciousVideoController::class, 'index'])->name('malicious.videos');
            Route::post('update-status-malicious-video', [MaliciousVideoController::class, 'updateStatus'])->name('update.status.malicious.video');
            Route::post('get-video-descriptions', [MaliciousVideoController::class, 'GetVideoDescriptions'])->name('get.video.descriptions');
            Route::post('get-video-notes', [MaliciousVideoController::class, 'GetVideoNotes'])->name('get.video.notes');

            Route::get('malicious-professionals', [MaliciousProfessionalController::class, 'index'])->name('malicious.professionals');
            Route::post('get-descriptions', [MaliciousProfessionalController::class, 'GetDescriptions'])->name('get.descriptions');
            Route::post('get-notes', [MaliciousProfessionalController::class, 'GetNotes'])->name('get.notes');

            Route::post('update-status-malicious-professional', [MaliciousProfessionalController::class, 'updateStatusProfessional'])->name('update.status.malicious.professional');



            //for backend subscription and ads
            Route::get('video-ads', [VideoAdsController::class, 'index'])->name('video.ads');
            Route::get('video-ads/{id}/purchase-details', [VideoAdsController::class, 'PurchaseDetails'])->name('purchase.details');
            Route::get('subscription-list', [SubscriptionHestoryController::class, 'index'])->name('subscription.list');

            //end backend subscription and ads
            Route::resource('news-letter', 'App\Http\Controllers\backend\NewsletterController');
            Route::post('news-letters/delete', [NewsletterController::class, 'Delete'])->name('delete.news-letters');

            Route::resource('information', 'App\Http\Controllers\backend\InformationController');
            Route::post('get-information', [InformationController::class, 'GetInformation'])->name('get.information');
            Route::resource('difficulty', 'App\Http\Controllers\backend\DifficultyController');
            Route::resource('tag', 'App\Http\Controllers\backend\TagController');
            Route::resource('sports', 'App\Http\Controllers\backend\SportsController');

            Route::resource('homepage', 'App\Http\Controllers\backend\HomePageController');

            Route::get('user/profession', [UserController::class, 'index'])->name('user.index');
            Route::get('user/profession/create', [UserController::class, 'create'])->name('user.create');
            Route::post('user/profession/', [UserController::class, 'store'])->name('user.store');
            Route::get('user/profession//{user}', [UserController::class, 'show'])->name('user.show');
            Route::get('user/profession/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::put('user/profession/{user}', [UserController::class, 'update'])->name('user.update');
            Route::delete('user/profession/{user}', [UserController::class, 'destroy'])->name('user.destroy');
            Route::post('user-profile-slider', [UserController::class, 'Slider'])->name('user.profile.slider');

            Route::get('user/visitor', [VisitorUserController::class, 'index'])->name('user.visitor.index');
            Route::get('user/visitor/create', [VisitorUserController::class, 'create'])->name('user.visitor.create');
            Route::post('user/visitor/', [VisitorUserController::class, 'store'])->name('user.visitor.store');
            Route::get('user/visitor/{user}', [VisitorUserController::class, 'show'])->name('user.visitor.show');
            Route::get('user/visitor/{user}/edit', [VisitorUserController::class, 'edit'])->name('user.visitor.edit');
            Route::put('user/visitor/{user}', [VisitorUserController::class, 'update'])->name('user.visitor.update');
            Route::delete('user/visitor/{user}', [VisitorUserController::class, 'destroy'])->name('user.visitor.destroy');
            Route::post('change-status-visitor-user', [VisitorUserController::class, 'ChangeStatusVisitorUser'])->name('change-status-visitor-user');
            Route::post('get-category-data', [VideoController::class, 'GetCategoryList'])->name('get.category.data');

            Route::post('change-status-user', [UserController::class, 'ChangeStatusUser'])->name('change-status-user');
            Route::post('get-profilevideo', [UserController::class, 'GetProfileVideo'])->name('get.profilevideo');
            Route::resource('videos', VideoController::class);
            Route::post('video/change-home-share-status', [VideoController::class, 'ChangeHomeShareStatus'])->name('change.home.share.status');
            // Route::post('get-fileter-video', [VideoController::class, 'index'])->name('get.fileter.video');

            Route::post('change-status-video', [VideoController::class, 'ChangeStatusVideo'])->name('change-status-video');
            Route::resource('service', ServiceController::class);
            Route::resource('setting', SettingController::class);
            Route::resource('ads', AdsController::class);

            Route::resource('profile-page', ProfilePageController::class);

            Route::resource('badge', 'App\Http\Controllers\backend\BadgeController');
            Route::post('change-status-badge', [BadgeController::class, 'ChangeStatusBadge'])->name('change-status-badge');
            Route::get('bagde/download-document', [BadgeController::class, 'DownloadDocument'])->name('bagde.download.document');

            Route::resource('client', 'App\Http\Controllers\backend\ClientController');
            Route::post('get-clientsinformation', [ClientController::class, 'GetClientsInformation'])->name('get.clientsinformation');

            Route::resource('module', ModuleController::class);
        });
    });
});
