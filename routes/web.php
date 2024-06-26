<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventFaqController;
use App\Http\Controllers\EventViewController;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\OrganiserController;
use App\Http\Controllers\RegionTaxController;
use App\Http\Controllers\RemindersController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserLogoutController;
use App\Http\Controllers\UserSignupController;
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\EventOrdersController;
use App\Http\Controllers\EventSurveyController;
use App\Http\Controllers\EventCheckInController;
use App\Http\Controllers\EventPromoteController;
use App\Http\Controllers\EventTicketsController;
use App\Http\Controllers\EventWidgetsController;
use App\Http\Controllers\RefundPolicyController;
use App\Http\Controllers\EventCheckoutController;
use App\Http\Controllers\ManageAccountController;
use App\Http\Controllers\OrganiserViewController;
use App\Http\Controllers\EventAttendeesController;
use App\Http\Controllers\EventCustomizeController;
use App\Http\Controllers\EventDashboardController;
use App\Http\Controllers\OrganiserEventsController;
use App\Http\Controllers\EventAccessCodesController;
use App\Http\Controllers\EventViewEmbeddedController;
use App\Http\Controllers\EventDiscountCodesController;
use App\Http\Controllers\OrganiserCustomizeController;
use App\Http\Controllers\OrganiserDashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('/', [EventViewController::class,'events'])->name('home');

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    /*
     * -------------------------
     * Installer
     * -------------------------
     */
    Route::get('install',
        [InstallerController::class, 'showInstaller']
    )->name('showInstaller');

    Route::post('install',
        [InstallerController::class, 'postInstaller']
    )->name('postInstaller');

    Route::get('upgrade',
        [InstallerController::class, 'showUpgrader']
    )->name('showUpgrader');

    Route::post('upgrade',
        [InstallerController::class, 'postUpgrader']
    )->name('postUpgrader');

    /*
     * Logout
     */
    Route::any('/logout',
        [UserLogoutController::class, 'doLogout']
    )->name('logout');

    Route::group(['middleware' => ['installed']], function () {

        /*
         * Login
         */
        Route::get('/admin/login',
            [UserLoginController::class, 'showLogin']
        )->name('login')->middleware('throttle:10,1');
        
        Route::get('/client-login',
            [ClientLoginController::class, 'showLoginForm']
        )->name('client-login.show');

        Route::match(['get','post'],'/client-login-check',
            [ClientLoginController::class, 'checkClientEmail']
        )->name('client-login.check')->middleware('throttle:10,1');

        Route::get('/client-login-otp',
            [ClientLoginController::class, 'showOtpForm']
        )->name('client-login.otp.show');
        
        Route::post('/client-verify-otp',
            [ClientLoginController::class, 'verifyLoginOtp']
        )->name('client-login.otp.verify')->middleware('throttle:10,1');

        Route::post('/client-logout',
            [ClientLoginController::class, 'clientLogout']
        )->name('client.logout')->middleware('throttle:10,1');

        // Client

        Route::get('/client-profile',[ClientController::class, 'profile'])->name('client.profile.index');
        
        Route::put('/client-profile/update',[ClientController::class, 'profileUpdate'])->name('client.profile.update');

        Route::get('/client-my-orders',[ClientController::class, 'myOrders'])->name('client.my-orders.index');
        Route::get('/client-my-orders/{order}/details',[ClientController::class, 'myOrderDetails'])->name('client.my-orders.details');

        // Admin Login

        Route::post('/admin/login',
            [UserLoginController::class, 'postLogin']
        );

        /*
         * Forgot password
         */
        Route::get('login/forgot-password',
            [RemindersController::class, 'getRemind']
        )->name('forgotPassword');

        Route::post('login/forgot-password',
            [RemindersController::class, 'postRemind']
        )->name('postForgotPassword')->middleware('throttle:3,1');

        /*
         * Reset Password
         */
        Route::get('login/reset-password/{token}',
            [RemindersController::class, 'getReset']
        )->name('password.reset');

        Route::post('login/reset-password',
            [RemindersController::class, 'postReset']
        )->name('postResetPassword')->middleware('throttle:3,1');

        /*
         * Registration / Account creation
         */
        Route::get('/signup',
            [UserSignupController::class, 'showSignup']
        )->name('showSignup');

        Route::post('/signup',
            [UserSignupController::class, 'postSignup'])->middleware('throttle:3,1');

        /*
         * Confirm Email
         */
        Route::get('signup/confirm_email/{confirmation_code}',
            [UserSignupController::class, 'confirmEmail']
        )->name('confirmEmail')->middleware('throttle:3,1');
    });

    /*
     * Public organiser page routes
     */
    Route::group(['prefix' => 'o'], function () {

        Route::get('/{organiser_id}/{organier_slug?}',
            [OrganiserViewController::class, 'showOrganiserHome']
        )->name('showOrganiserHome');

    });

    /*
     * Public event page routes
     */
    
    Route::get('events/{event}/tickets',
        [EventViewController::class, 'eventTickets']
    )->name('events.tickets.index');

    Route::group(['prefix' => 'e'], function () {

        /*
         * Embedded events
         */
        Route::get('/{event_id}/embed',
            [EventViewEmbeddedController::class, 'showEmbeddedEvent']
        )->name('showEmbeddedEventPage');

        Route::get('/{event_id}/calendar.ics',
            [EventViewController::class, 'showCalendarIcs']
        )->name('downloadCalendarIcs');

        Route::get('/{event_id}/{event_slug?}',
            [EventViewController::class, 'showEventHome']
        )->name('showEventPage');

        Route::post('/{event_id}/contact_organiser',
            [EventViewController::class, 'postContactOrganiser']
        )->name('postContactOrganiser');

        Route::post('/{event_id}/show_hidden',
            [EventViewController::class, 'postShowHiddenTickets']
        )->name('postShowHiddenTickets');

        /*
         * Used for previewing designs in the backend. Doesn't log page views etc.
         */
        Route::get('/{event_id}/preview',
            [EventViewController::class, 'showEventHomePreview']
        )->name('showEventPagePreview');

        Route::post('{event_id}/checkout/',
            [EventCheckoutController::class, 'postValidateTickets']
        )->name('postValidateTickets');

        Route::post('{event_id}/checkout/validate',
            [EventCheckoutController::class, 'postValidateOrder']
        )->name('postValidateOrder');

        Route::get('{event_id}/checkout/payment',
            [EventCheckoutController::class, 'showEventPayment']
        )->name('showEventPayment');

        Route::get('{event_id}/checkout/create',
            [EventCheckoutController::class, 'showEventCheckout']
        )->name('showEventCheckout');

        Route::get('{event_id}/checkout/success',
            [EventCheckoutController::class, 'showEventCheckoutPaymentReturn']
        )->name('showEventCheckoutPaymentReturn');

        Route::post('{event_id}/checkout/create',
            [EventCheckoutController::class, 'postCreateOrder']
        )->name('postCreateOrder');
    });

    /*
     * Public view order routes
     */
    Route::get('order/{order_reference}',
        [EventCheckoutController::class, 'showOrderDetails']
    )->name('showOrderDetails');

    Route::get('order/{order_reference}/tickets',
        [EventCheckoutController::class, 'showOrderTickets']
    )->name('showOrderTickets');

    /*
     * Backend routes
     */
    Route::group(['middleware' => ['auth', 'first.run']], function () {

        /*
         * Edit User
         */
        Route::group(['prefix' => 'user'], function () {

            Route::get('/',
                [UserController::class, 'showEditUser']
            )->name('showEditUser');

            Route::post('/',
                [UserController::class, 'postEditUser']
            )->name('postEditUser');

        });

        /*
         * Manage account
         */
        Route::group(['prefix' => 'account'], function () {

            Route::get('/',
                [ManageAccountController::class, 'showEditAccount']
            )->name('showEditAccount');

            Route::post('/',
                [ManageAccountController::class, 'postEditAccount']
            )->name('postEditAccount');

            Route::post('/edit_payment',
                [ManageAccountController::class, 'postEditAccountPayment']
            )->name('postEditAccountPayment');

            Route::post('invite_user',
                [ManageAccountController::class, 'postInviteUser']
            )->name('postInviteUser');

        });

        Route::get('select_organiser',
            [OrganiserController::class, 'showSelectOrganiser']
        )->name('showSelectOrganiser');

        /*
         * Organiser routes
         */
        Route::group(['prefix' => 'organiser'], function () {

            Route::get('{organiser_id}/dashboard',
                [OrganiserDashboardController::class, 'showDashboard']
            )->name('showOrganiserDashboard');
            
            // Region Taxes 
            Route::get('{organiser_id}/region-taxes', [RegionTaxController::class, 'index'])
            ->name('region-taxes.index');
            Route::post('{organiser_id}/region-taxes', [RegionTaxController::class, 'store'])
            ->name('region-taxes.store');
            Route::get('{organiser_id}/region-taxes/{regionTax}', [RegionTaxController::class, 'edit'])
            ->name('region-taxes.edit');
            Route::put('{organiser_id}/region-taxes/{regionTax}', [RegionTaxController::class, 'update'])
            ->name('region-taxes.update');
            Route::delete('region-taxes/{region_tax}', [RegionTaxController::class, 'destroy'])
            ->name('region-taxes.destroy');

            // Refund Policy
            Route::get('{organiser_id}/refund-policy', [RefundPolicyController::class, 'index'])
            ->name('refund-policy.index');
            Route::put('{organiser_id}/refund-policy/update', [RefundPolicyController::class, 'update'])
            ->name('refund-policy.update');


            Route::get('{organiser_id}/events',
                [OrganiserEventsController::class, 'showEvents']
            )->name('showOrganiserEvents');

            Route::get('{organiser_id}/customize',
                [OrganiserCustomizeController::class, 'showCustomize']
            )->name('showOrganiserCustomize');

            Route::post('{organiser_id}/customize',
                [OrganiserCustomizeController::class, 'postEditOrganiser']
            )->name('postEditOrganiser');

            Route::get('create',
                [OrganiserController::class, 'showCreateOrganiser']
            )->name('showCreateOrganiser');

            Route::post('create',
                [OrganiserController::class, 'postCreateOrganiser']
            )->name('postCreateOrganiser');

            Route::post('{organiser_id}/page_design',
                [OrganiserCustomizeController::class, 'postEditOrganiserPageDesign']
            )->name('postEditOrganiserPageDesign');
        });

        /*
         * Events dashboard
         */
        Route::group(['prefix' => 'events'], function () {

            /*
             * ----------
             * Create Event
             * ----------
             */
            Route::get('/create',
                [EventController::class, 'showCreateEvent']
            )->name('showCreateEvent');

            Route::post('/create',
                [EventController::class, 'postCreateEvent']
            )->name('postCreateEvent');
        });

        /*
         * Upload event images
         */
        Route::post('/upload_image',
            [EventController::class, 'postUploadEventImage']
        )->name('postUploadEventImage');

        /*
         * Event management routes
         */
        Route::group(['prefix' => 'event'], function () {

            /*
             * Dashboard
             */
            Route::get('{event_id}/dashboard/',
                [EventDashboardController::class, 'showDashboard']
            )->name('showEventDashboard');

            Route::get('{event_id}/',
                [EventDashboardController::class, 'redirectToDashboard']
            );

            Route::post('{event_id}/go_live',
                [EventController::class, 'postMakeEventLive']
            )->name('MakeEventLive');

            /*
             * -------
             * Tickets
             * -------
             */
            Route::get('{event_id}/tickets/',
                [EventTicketsController::class, 'showTickets']
            )->name('showEventTickets');

            Route::get('{event_id}/tickets/edit/{ticket_id}',
                [EventTicketsController::class, 'showEditTicket']
            )->name('showEditTicket');

            Route::post('{event_id}/tickets/edit/{ticket_id}',
                [EventTicketsController::class, 'postEditTicket']
            )->name('postEditTicket');

            Route::get('{event_id}/tickets/create',
                [EventTicketsController::class, 'showCreateTicket']
            )->name('showCreateTicket');

            Route::post('{event_id}/tickets/create',
                [EventTicketsController::class, 'postCreateTicket']
            )->name('postCreateTicket');

            Route::post('{event_id}/tickets/delete',
                [EventTicketsController::class, 'postDeleteTicket']
            )->name('postDeleteTicket');

            Route::post('{event_id}/tickets/pause',
                [EventTicketsController::class, 'postPauseTicket']
            )->name('postPauseTicket');

            Route::post('{event_id}/tickets/order',
                [EventTicketsController::class, 'postUpdateTicketsOrder']
            )->name('postUpdateTicketsOrder');

            /*
             * -------
             * Attendees
             * -------
             */
            Route::get('{event_id}/attendees/',
                [EventAttendeesController::class, 'showAttendees']
            )->name('showEventAttendees');

            Route::get('{event_id}/attendees/message',
                [EventAttendeesController::class, 'showMessageAttendees']
            )->name('showMessageAttendees');

            Route::post('{event_id}/attendees/message',
                [EventAttendeesController::class, 'postMessageAttendees']
            )->name('postMessageAttendees');

            Route::get('{attendee_id}/attendees/single_message',
                [EventAttendeesController::class, 'showMessageAttendee']
            )->name('showMessageAttendee');

            Route::post('{attendee_id}/attendees/single_message',
                [EventAttendeesController::class, 'postMessageAttendee']
            )->name('postMessageAttendee');

            Route::get('{attendee_id}/attendees/resend_ticket',
                [EventAttendeesController::class, 'showResendTicketToAttendee']
            )->name('showResendTicketToAttendee');

            Route::post('{attendee_id}/attendees/resend_ticket',
                [EventAttendeesController::class, 'postResendTicketToAttendee']
            )->name('postResendTicketToAttendee');

            Route::get('{event_id}/attendees/invite',
                [EventAttendeesController::class, 'showInviteAttendee']
            )->name('showInviteAttendee');

            Route::post('{event_id}/attendees/invite',
                [EventAttendeesController::class, 'postInviteAttendee']
            )->name('postInviteAttendee');

            Route::get('{event_id}/attendees/import',
                [EventAttendeesController::class, 'showImportAttendee']
            )->name('showImportAttendee');

            Route::post('{event_id}/attendees/import',
                [EventAttendeesController::class, 'postImportAttendee']
            )->name('postImportAttendee');

            Route::get('{event_id}/attendees/print',
                [EventAttendeesController::class, 'showPrintAttendees']
            )->name('showPrintAttendees');

            Route::get('{event_id}/attendees/{attendee_id}/export_ticket',
                [EventAttendeesController::class, 'showExportTicket']
            )->name('showExportTicket');

            Route::get('{event_id}/attendees/{attendee_id}/ticket',
                [EventAttendeesController::class, 'showAttendeeTicket']
            )->name('showAttendeeTicket');

            Route::get('{event_id}/attendees/export/{export_as?}',
                [EventAttendeesController::class, 'showExportAttendees']
            )->name('showExportAttendees');

            Route::get('{event_id}/attendees/{attendee_id}/edit',
                [EventAttendeesController::class, 'showEditAttendee']
            )->name('showEditAttendee');

            Route::post('{event_id}/attendees/{attendee_id}/edit',
                [EventAttendeesController::class, 'postEditAttendee']
            )->name('postEditAttendee');

            Route::get('{event_id}/attendees/{attendee_id}/cancel',
                [EventAttendeesController::class, 'showCancelAttendee']
            )->name('showCancelAttendee');

            Route::post('{event_id}/attendees/{attendee_id}/cancel',
                [EventAttendeesController::class, 'postCancelAttendee']
            )->name('postCancelAttendee');

            /*
             * -------
             * Orders
             * -------
             */
            Route::get('{event_id}/orders/',
                [EventOrdersController::class, 'showOrders']
            )->name('showEventOrders');

            Route::get('order/{order_id}',
                [EventOrdersController::class, 'manageOrder']
            )->name('showManageOrder');

            Route::post('order/{order_id}/resend',
                [EventOrdersController::class, 'resendOrder']
            )->name('resendOrder');

            Route::get('order/{order_id}/show/edit',
                [EventOrdersController::class, 'showEditOrder']
            )->name('showEditOrder');

            Route::post('order/{order_id}/edit',
                [EventOrdersController::class, 'postEditOrder']
            )->name('postOrderEdit');

            Route::get('order/{order_id}/cancel',
                [EventOrdersController::class, 'showCancelOrder']
            )->name('showCancelOrder');

            Route::post('order/{order_id}/cancel',
                [EventOrdersController::class, 'postCancelOrder']
            )->name('postCancelOrder');

            Route::post('order/{order_id}/mark_payment_received',
                [EventOrdersController::class, 'postMarkPaymentReceived']
            )->name('postMarkPaymentReceived');

            Route::get('{event_id}/orders/export/{export_as?}',
                [EventOrdersController::class, 'showExportOrders']
            )->name('showExportOrders');

            Route::get('{event_id}/orders/message/{order_id}',
                [EventOrdersController::class, 'showMessageOrder']
            )->name('showMessageOrder');

            Route::post('{event_id}/orders/message/{order_id}',
                [EventOrdersController::class, 'postMessageOrder']
            )->name('postMessageOrder');

            /*
             * -------
             * Edit Event
             * -------
             */
            Route::post('{event_id}/customize',
                [EventController::class, 'postEditEvent']
            )->name('postEditEvent');

            /*
             * -------
             * Customize Design etc.
             * -------
             */
            Route::get('{event_id}/customize',
                [EventCustomizeController::class, 'showCustomize']
            )->name('showEventCustomize');

            Route::get('{event_id}/customize/{tab?}',
                [EventCustomizeController::class, 'showCustomize']
            )->name('showEventCustomizeTab');

            Route::post('{event_id}/customize/order_page',
                [EventCustomizeController::class, 'postEditEventOrderPage']
            )->name('postEditEventOrderPage');

            Route::post('{event_id}/customize/design',
                [EventCustomizeController::class, 'postEditEventDesign']
            )->name('postEditEventDesign');

            Route::post('{event_id}/customize/ticket_design',
                [EventCustomizeController::class, 'postEditEventTicketDesign']
            )->name('postEditEventTicketDesign');

            Route::post('{event_id}/customize/social',
                [EventCustomizeController::class, 'postEditEventSocial']
            )->name('postEditEventSocial');

            Route::post('{event_id}/customize/fees',
                [EventCustomizeController::class, 'postEditEventFees']
            )->name('postEditEventFees');

            /*
             * -------
             * Event Widget page
             * -------
             */
            Route::get('{event_id}/widgets',
                [EventWidgetsController::class, 'showEventWidgets']
            )->name('showEventWidgets');

            /*
             * -------
             * Event Access Codes page
             * -------
             */
            Route::get('{event_id}/access_codes',
                [EventAccessCodesController::class, 'show']
            )->name('showEventAccessCodes');

            Route::get('{event_id}/access_codes/create',
                [EventAccessCodesController::class, 'showCreate']
            )->name('showCreateEventAccessCode');

            Route::post('{event_id}/access_codes/create',
                [EventAccessCodesController::class, 'postCreate']
            )->name('postCreateEventAccessCode');

            Route::post('{event_id}/access_codes/{access_code_id}/delete',
                [EventAccessCodesController::class, 'postDelete']
            )->name('postDeleteEventAccessCode');

            /*
             * -------
             * Event Discount Codes page
             * -------
             */
            Route::get('{event_id}/discount_codes',
                [EventDiscountCodesController::class, 'show']
            )->name('showEventDiscountCodes');

            Route::get('{event_id}/discount_codes/create',
                [EventDiscountCodesController::class, 'showCreate']
            )->name('showCreateEventDiscountCode');

            Route::post('{event_id}/discount_codes/create',
                [EventDiscountCodesController::class, 'postCreate']
            )->name('postCreateEventDiscountCode');

            Route::post('{event_id}/discount_codes/{discount_code_id}/delete',
                [EventDiscountCodesController::class, 'postDelete']
            )->name('postDeleteEventDiscountCode');
            
            /*
             * -------
             * Event FAQ page
             * -------
             */
            Route::get('{event_id}/faq',
                [EventFaqController::class, 'show']
            )->name('showEventFaq');

            Route::get('{event_id}/faq/create',
                [EventFaqController::class, 'showCreate']
            )->name('showCreateEventFaq');

            Route::post('{event_id}/faq/create',
                [EventFaqController::class, 'postCreate']
            )->name('postCreateEventFaq');
            
            Route::get('{event_id}/faq/{faq_id}/edit',
                [EventFaqController::class, 'showEdit']
            )->name('showEditEventFaq');

            Route::put('{event_id}/faq/{faq_id}/update',
                [EventFaqController::class, 'postEdit']
            )->name('postEditEventFaq');

            Route::post('{event_id}/faq/{faq_id}/delete',
                [EventFaqController::class, 'postDelete']
            )->name('postDeleteEventFaq');

            /*
             * -------
             * Event Survey page
             * -------
             */
            Route::get('{event_id}/surveys',
                [EventSurveyController::class, 'showEventSurveys']
            )->name('showEventSurveys');

            Route::get('{event_id}/question/create',
                [EventSurveyController::class, 'showCreateEventQuestion']
            )->name('showCreateEventQuestion');

            Route::post('{event_id}/question/create',
                [EventSurveyController::class, 'postCreateEventQuestion']
            )->name('postCreateEventQuestion');

            Route::get('{event_id}/question/{question_id}',
                [EventSurveyController::class, 'showEditEventQuestion']
            )->name('showEditEventQuestion');

            Route::post('{event_id}/question/{question_id}',
                [EventSurveyController::class, 'postEditEventQuestion']
            )->name('postEditEventQuestion');

            Route::post('{event_id}/question/delete/{question_id}',
                [EventSurveyController::class, 'postDeleteEventQuestion']
            )->name('postDeleteEventQuestion');

            Route::get('{event_id}/question/{question_id}/answers',
                [EventSurveyController::class, 'showEventQuestionAnswers']
            )->name('showEventQuestionAnswers');

            Route::post('{event_id}/questions/update_order',
                [EventSurveyController::class, 'postUpdateQuestionsOrder']
            )->name('postUpdateQuestionsOrder');

            Route::get('{event_id}/answers/export/{export_as?}',
                [EventSurveyController::class, 'showExportAnswers']
            )->name('showExportAnswers');

            Route::post('{event_id}/question/{question_id}/enable',
                [EventSurveyController::class, 'postEnableQuestion']
            )->name('postEnableQuestion');


            /*
             * -------
             * Check In App
             * -------
             */
            Route::get('{event_id}/check_in',
                [EventCheckInController::class, 'showCheckIn']
            )->name('showCheckIn');
            
            Route::get('{event_id}/get-attendee-ticket/{attendee_id}',
                [EventCheckInController::class, 'getAttendeeTicket']
            )->name('getAttendeeTicket');

            Route::post('{event_id}/check_in/search',
                [EventCheckInController::class, 'postCheckInSearch']
            )->name('postCheckInSearch');

            Route::post('{event_id}/check_in/',
                [EventCheckInController::class, 'postCheckInAttendee']
            )->name('postCheckInAttendee');

            Route::post('{event_id}/qrcode_check_in',
                [EventCheckInController::class, 'postCheckInAttendeeQr']
            )->name('postQRCodeCheckInAttendee');

            Route::post('{event_id}/confirm_order_tickets/{order_id}',
                [EventCheckInController::class, 'confirmOrderTicketsQr']
            )->name('confirmCheckInOrderTickets');


            /*
             * -------
             * Promote
             * -------
             */
            Route::get('{event_id}/promote',
                [EventPromoteController::class, 'showPromote']
            )->name('showEventPromote');
        });
    });

    // Route::get('/',
    //     [IndexController::class, 'showIndex']
    // )->name('index');
});
