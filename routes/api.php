<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EndUserController;
use App\Http\Controllers\EndEventController;
use App\Http\Controllers\EndAccountController;
use App\Http\Controllers\EndPaymentController;
use App\Http\Controllers\EndSettingsController;
use App\Http\Controllers\EndAdvertisementController;
use App\Http\Controllers\EndConfigurationController;
use App\Http\Controllers\EndAuthenticationController;




Route::get('/user', function (Request $request) {
    return $request->all();
})->middleware('auth:sanctum');



Route::prefix('v2')->group(function () {

    // Free and Open Routes   ===================================================================================

    Route::post('/users/new/registration', [EndUserController::class, 'register']);
    Route::post('/users/mobile/createaccount', [EndUserController::class, 'mobileRequestAccount']);

    // Roles:  free routes
    Route::get('/settings/roles', [EndSettingsController::class, 'viewRole']);
    Route::post('/settings/roles', [EndSettingsController::class, 'createRole']);
    Route::get('/settings/roles/fetch', [EndSettingsController::class, 'fetchRole']);

    // GetbyID
    Route::get('/settings/districts/byRegion', [EndSettingsController::class, 'getDistrictByRegion']);
    Route::get('/settings/regions/get', [EndSettingsController::class, 'getRegion']);
    Route::get('/settings/identity-types/get', [EndSettingsController::class, 'getIdentityType']);

    // Authentication
    Route::get('/authentication/login', [EndAuthenticationController::class, 'getCrendential']);
    Route::post('/authentication/sessions', [EndAuthenticationController::class, 'createSessions']);

    // End of free routes    =====================================================================================

    Route::middleware([CheckApiKey::class, 'auth:sanctum'])->group(function () {

        // Sessions
        Route::get('/authentication/sessions', [EndAuthenticationController::class, 'getSessions']);
        // Bulk Remove
        Route::post('/commands/bulk-remove', [EndSettingsController::class, 'bulkRemove']);

        // Users:
        Route::get('/users', [EndUserController::class, 'viewUser']);
        Route::post('/users/add', [EndUserController::class, 'createUser']);
        Route::post('/users/update', [EndUserController::class, 'updateUser']);
        Route::post('/users/delete', [EndUserController::class, 'destroyUser']);
        Route::get('/users/get', [EndUserController::class, 'getUser']);

        // User OTP Tokens:
        Route::get('/users/otp-tokens', [EndUserController::class, 'viewUserOTPToken']);
        Route::post('/users/otp-tokens', [EndUserController::class, 'createUserOTPToken']);
        Route::post('/users/otp-tokens/update', [EndUserController::class, 'updateUserOTPToken']);
        Route::post('/users/otp-tokens/delete', [EndUserController::class, 'destroyUserOTPToken']);
        Route::get('/users/otp-tokens/get', [EndUserController::class, 'getUserOTPToken']);

        // User API Tokens:
        Route::get('/users/api-tokens', [EndUserController::class, 'viewUserAPIToken']);
        Route::post('/users/api-tokens', [EndUserController::class, 'createUserAPIToken']);
        Route::post('/users/api-tokens/update', [EndUserController::class, 'updateUserAPIToken']);
        Route::post('/users/api-tokens/delete', [EndUserController::class, 'destroyUserAPIToken']);
        Route::get('/users/api-tokens/get', [EndUserController::class, 'getUserAPIToken']);

        // Roles Route
        Route::post('/settings/roles/update', [EndSettingsController::class, 'updateRole']);
        Route::post('/settings/roles/delete', [EndSettingsController::class, 'destroyRole']);

        // Regions:
        Route::get('/settings/regions', [EndSettingsController::class, 'viewRegion']);
        Route::post('/settings/regions', [EndSettingsController::class, 'createRegion']);
        Route::post('/settings/regions/update', [EndSettingsController::class, 'updateRegion']);
        Route::post('/settings/regions/delete', [EndSettingsController::class, 'destroyRegion']);

        // Districts:
        Route::get('/settings/districts', [EndSettingsController::class, 'viewDistrict']);
        Route::post('/settings/districts', [EndSettingsController::class, 'createDistrict']);
        Route::post('/settings/districts/update', [EndSettingsController::class, 'updateDistrict']);
        Route::post('/settings/districts/delete', [EndSettingsController::class, 'destroyDistrict']);
        Route::get('/settings/districts/get', [EndSettingsController::class, 'getDistrict']);

        // Towns:
        Route::get('/settings/towns', [EndSettingsController::class, 'viewTown']);
        Route::post('/settings/towns', [EndSettingsController::class, 'createTown']);
        Route::post('/settings/towns/update', [EndSettingsController::class, 'updateTown']);
        Route::post('/settings/towns/delete', [EndSettingsController::class, 'destroyTown']);
        Route::get('/settings/towns/get', [EndSettingsController::class, 'getTown']);

        // Permissions:
        Route::get('/settings/permissions', [EndSettingsController::class, 'viewPermission']);
        Route::post('/settings/permissions', [EndSettingsController::class, 'createPermission']);
        Route::post('/settings/permissions/update', [EndSettingsController::class, 'updatePermission']);
        Route::post('/settings/permissions/delete', [EndSettingsController::class, 'destroyPermission']);
        Route::get('/settings/permissions/get', [EndSettingsController::class, 'getPermission']);

        // User Permissions:
        Route::get('/settings/user-permissions', [EndSettingsController::class, 'viewUserPermission']);
        Route::post('/settings/user-permissions', [EndSettingsController::class, 'createUserPermission']);
        Route::post('/settings/user-permissions/update', [EndSettingsController::class, 'updateUserPermission']);
        Route::post('/settings/user-permissions/delete', [EndSettingsController::class, 'destroyUserPermission']);
        Route::get('/settings/user-permissions/get', [EndSettingsController::class, 'getUserPermission']);

        // Identity Types:
        Route::get('/settings/identity-types', [EndSettingsController::class, 'viewIdentityType']);
        Route::post('/settings/identity-types', [EndSettingsController::class, 'createIdentityType']);
        Route::post('/settings/identity-types/update', [EndSettingsController::class, 'updateIdentityType']);
        Route::post('/settings/identity-types/delete', [EndSettingsController::class, 'destroyIdentityType']);

        // Notifications:
        Route::get('/settings/notifications', [EndSettingsController::class, 'viewNotification']);
        Route::post('/settings/notifications', [EndSettingsController::class, 'createNotification']);
        Route::post('/settings/notifications/update', [EndSettingsController::class, 'updateNotification']);
        Route::post('/settings/notifications/delete', [EndSettingsController::class, 'destroyNotification']);
        Route::get('/settings/notifications/get', [EndSettingsController::class, 'getNotification']);

        // API Routes:
        Route::get('/settings/api-routes', [EndSettingsController::class, 'viewAPIRoute']);
        Route::post('/settings/api-routes', [EndSettingsController::class, 'createAPIRoute']);
        Route::post('/settings/api-routes/update', [EndSettingsController::class, 'updateAPIRoute']);
        Route::post('/settings/api-routes/delete', [EndSettingsController::class, 'destroyAPIRoute']);
        Route::get('/settings/api-routes/get', [EndSettingsController::class, 'getAPIRoute']);

        // Authors:
        Route::get('/events/authors', [EndEventController::class, 'viewAuthor']);
        Route::post('/events/authors', [EndEventController::class, 'createAuthor']);
        Route::post('/events/authors/update', [EndEventController::class, 'updateAuthor']);
        Route::post('/events/authors/delete', [EndEventController::class, 'destroyAuthor']);
        Route::get('/events/authors/get', [EndEventController::class, 'getAuthor']);

        // Event Types:
        Route::get('/events/types', [EndEventController::class, 'viewEventType']);
        Route::post('/events/types', [EndEventController::class, 'createEventType']);
        Route::post('/events/types/update', [EndEventController::class, 'updateEventType']);
        Route::post('/events/types/delete', [EndEventController::class, 'destroyEventType']);
        Route::get('/events/types/get', [EndEventController::class, 'getEventType']);

        // Events:
        Route::get('/events', [EndEventController::class, 'viewEvent']);
        Route::post('/events', [EndEventController::class, 'createEvent']);
        Route::post('/events/update', [EndEventController::class, 'updateEvent']);
        Route::post('/events/delete', [EndEventController::class, 'destroyEvent']);
        Route::get('/events/get', [EndEventController::class, 'getEvent']);

        // Tickets:
        Route::get('/events/event-tickets', [EndEventController::class, 'viewEventTicket']);
        Route::post('/events/event-tickets', [EndEventController::class, 'createEventTicket']);
        Route::post('/events/event-tickets/update', [EndEventController::class, 'updateEventTicket']);
        Route::post('/events/event-tickets/delete', [EndEventController::class, 'destroyEventTicket']);
        Route::get('/events/event-tickets/get', [EndEventController::class, 'getEventTicket']);

        // User Tickets:
        Route::get('/events/user-tickets', [EndEventController::class, 'viewUserTicket']);
        Route::post('/events/user-tickets', [EndEventController::class, 'createUserTicket']);
        Route::post('/events/user-tickets/update', [EndEventController::class, 'updateUserTicket']);
        Route::post('/events/user-tickets/delete', [EndEventController::class, 'destroyUserTicket']);
        Route::get('/events/user-tickets/get', [EndEventController::class, 'getUserTicket']);

        // Event Comments:
        Route::get('/events/comments', [EndEventController::class, 'viewEventComment']);
        Route::post('/events/comments', [EndEventController::class, 'createEventComment']);
        Route::post('/events/comments/update', [EndEventController::class, 'updateEventComment']);
        Route::post('/events/comments/delete', [EndEventController::class, 'destroyEventComment']);
        Route::get('/events/comments/get', [EndEventController::class, 'getEventComment']);

        // Event Likes:
        Route::get('/events/likes', [EndEventController::class, 'viewEventLike']);
        Route::post('/events/likes', [EndEventController::class, 'createEventLike']);
        Route::post('/events/likes/update', [EndEventController::class, 'updateEventLike']);
        Route::post('/events/likes/delete', [EndEventController::class, 'destroyEventLike']);
        Route::get('/events/likes/get', [EndEventController::class, 'getEventLike']);

        // Event Stars:
        Route::get('/events/stars', [EndEventController::class, 'viewEventStar']);
        Route::post('/events/stars', [EndEventController::class, 'createEventStar']);
        Route::post('/events/stars/update', [EndEventController::class, 'updateEventStar']);
        Route::post('/events/stars/delete', [EndEventController::class, 'destroyEventStar']);
        Route::get('/events/stars/get', [EndEventController::class, 'getEventStar']);

        // Payments:
        Route::get('/events/payments', [EndPaymentController::class, 'viewPayment']);
        Route::post('/events/payments', [EndPaymentController::class, 'createPayment']);
        Route::post('/events/payments/update', [EndPaymentController::class, 'updatePayment']);
        Route::post('/events/payments/delete', [EndPaymentController::class, 'destroyPayment']);
        Route::get('/events/payments/get', [EndPaymentController::class, 'getPayment']);

        // Portrait Adverts:
        Route::get('/ads/portrait-adverts', [EndAdvertisementController::class, 'viewPortraitAdvert']);
        Route::post('/ads/portrait-adverts', [EndAdvertisementController::class, 'createPortraitAdvert']);
        Route::post('/ads/portrait-adverts/update', [EndAdvertisementController::class, 'updatePortraitAdvert']);
        Route::post('/ads/portrait-adverts/delete', [EndAdvertisementController::class, 'destroyPortraitAdvert']);
        Route::get('/ads/portrait-adverts/get', [EndAdvertisementController::class, 'getPortraitAdvert']);

        // Landscape Adverts:
        Route::get('/ads/landscape-adverts', [EndAdvertisementController::class, 'viewLandscapeAdvert']);
        Route::post('/ads/landscape-adverts', [EndAdvertisementController::class, 'createLandscapeAdvert']);
        Route::post('/ads/landscape-adverts/update', [EndAdvertisementController::class, 'updateLandscapeAdvert']);
        Route::post('/ads/landscape-adverts/delete', [EndAdvertisementController::class, 'destroyLandscapeAdvert']);
        Route::get('/ads/landscape-adverts/get', [EndAdvertisementController::class, 'getLandscapeAdvert']);

        // Issue Concern
        Route::get('/account/issue-concern', [EndAccountController::class, 'viewIssueConcern']);
        Route::post('/account/issue-concern', [EndAccountController::class, 'createIssueConcern']);
        Route::post('/account/issue-concern/update', [EndAccountController::class, 'updateIssueConcern']);
        Route::post('/account/issue-concern/delete', [EndAccountController::class, 'destroyIssueConcern']);

        // Request Refund
        Route::get('/account/request-refund', [EndAccountController::class, 'viewRequestRefund']);
        Route::post('/account/request-refund', [EndAccountController::class, 'createRequestRefund']);
        Route::post('/account/request-refund/update', [EndAccountController::class, 'updateRequestRefund']);
        Route::post('/account/request-refund/delete', [EndAccountController::class, 'destroyRequestRefund']);

        // Enable 2FA
        Route::get('/account/enable-2fa', [EndAccountController::class, 'viewEnable2FA']);
        Route::post('/account/enable-2fa', [EndAccountController::class, 'createEnable2FA']);
        Route::post('/account/enable-2fa/update', [EndAccountController::class, 'updateEnable2FA']);
        Route::post('/account/enable-2fa/delete', [EndAccountController::class, 'destroyEnable2FA']);

        // My Profile
        Route::get('/account/my-profile', [EndAccountController::class, 'viewMyProfile']);
        Route::post('/account/change/password', [EndAccountController::class, 'changeMyPassword']);
        Route::post('/account/verify-email', [EndAccountController::class, 'verifyMyEmail']);
        Route::post('/account/profile/picture/update', [EndAccountController::class, 'updateProfilePicture']);
        Route::post('/account/profile/cover/update', [EndAccountController::class, 'updateProfileCover']);

        // Cash Out
        Route::get('/account/cash-out', [EndAccountController::class, 'viewCashOut']);
        Route::post('/account/cash-out', [EndAccountController::class, 'createCashOut']);
        Route::post('/account/cash-out/update', [EndAccountController::class, 'updateCashOut']);
        Route::post('/account/cash-out/delete', [EndAccountController::class, 'destroyCashOut']);

        // Bank Statement
        Route::get('/account/bank-statement', [EndAccountController::class, 'viewBankStatement']);
        Route::post('/account/bank-statement', [EndAccountController::class, 'createBankStatement']);
        Route::post('/account/bank-statement/update', [EndAccountController::class, 'updateBankStatement']);
        Route::post('/account/bank-statement/delete', [EndAccountController::class, 'destroyBankStatement']);

        // Live Event
        Route::get('/account/live-event', [EndAccountController::class, 'viewLiveEvent']);
        Route::post('/account/live-event', [EndAccountController::class, 'createLiveEvent']);
        Route::post('/account/live-event/update', [EndAccountController::class, 'updateLiveEvent']);
        Route::post('/account/live-event/delete', [EndAccountController::class, 'destroyLiveEvent']);

        // Cast Stream
        Route::get('/account/cast-stream', [EndAccountController::class, 'viewCastStream']);
        Route::post('/account/cast-stream', [EndAccountController::class, 'createCastStream']);
        Route::post('/account/cast-stream/update', [EndAccountController::class, 'updateCastStream']);
        Route::post('/account/cast-stream/delete', [EndAccountController::class, 'destroyCastStream']);

        // Alert Management
        Route::get('/account/alert-management', [EndAccountController::class, 'viewAlertManagement']);
        Route::post('/account/alert-management', [EndAccountController::class, 'createAlertManagement']);
        Route::post('/account/alert-management/update', [EndAccountController::class, 'updateAlertManagement']);
        Route::post('/account/alert-management/delete', [EndAccountController::class, 'destroyAlertManagement']);

        // Chat Friend
        Route::get('/account/chat-friend', [EndAccountController::class, 'viewChatFriend']);
        Route::post('/account/chat-friend', [EndAccountController::class, 'createChatFriend']);
        Route::post('/account/chat-friend/update', [EndAccountController::class, 'updateChatFriend']);
        Route::post('/account/chat-friend/delete', [EndAccountController::class, 'destroyChatFriend']);

        // Read Policy
        Route::get('/account/read-policy', [EndAccountController::class, 'viewReadPolicy']);
        Route::post('/account/read-policy', [EndAccountController::class, 'createReadPolicy']);
        Route::post('/account/read-policy/update', [EndAccountController::class, 'updateReadPolicy']);
        Route::post('/account/read-policy/delete', [EndAccountController::class, 'destroyReadPolicy']);

        // Contact Management
        Route::get('/account/contact-management', [EndAccountController::class, 'viewContactManagement']);
        Route::post('/account/contact-management', [EndAccountController::class, 'createContactManagement']);
        Route::post('/account/contact-management/update', [EndAccountController::class, 'updateContactManagement']);
        Route::post('/account/contact-management/delete', [EndAccountController::class, 'destroyContactManagement']);


        Route::get('/configuration/sms', [EndConfigurationController::class, 'viewSms']);
        Route::post('/configuration/sms', [EndConfigurationController::class, 'createSms']);
        Route::post('/configuration/sms/update', [EndConfigurationController::class, 'updateSms']);
        Route::post('/configuration/sms/delete', [EndConfigurationController::class, 'destroySms']);

        Route::get('/configuration/sms-subscriptions', [EndConfigurationController::class, 'viewSmsSubscription']);
        Route::post('/configuration/sms-subscriptions', [EndConfigurationController::class, 'createSmsSubscription']);
        Route::post('/configuration/sms-subscriptions/update', [EndConfigurationController::class, 'updateSmsSubscription']);
        Route::post('/configuration/sms-subscriptions/delete', [EndConfigurationController::class, 'destroySmsSubscription']);

        Route::get('/configuration/user-concerns', [EndConfigurationController::class, 'viewUserConcern']);
        Route::post('/configuration/user-concerns', [EndConfigurationController::class, 'createUserConcern']);
        Route::post('/configuration/user-concerns/update', [EndConfigurationController::class, 'updateUserConcern']);
        Route::post('/configuration/user-concerns/delete', [EndConfigurationController::class, 'destroyUserConcern']);

        Route::get('/configuration/emails', [EndConfigurationController::class, 'viewEmail']);
        Route::post('/configuration/emails', [EndConfigurationController::class, 'createEmail']);
        Route::post('/configuration/emails/update', [EndConfigurationController::class, 'updateEmail']);
        Route::post('/configuration/emails/delete', [EndConfigurationController::class, 'destroyEmail']);

        Route::get('/configuration/messages', [EndConfigurationController::class, 'viewMessage']);
        Route::post('/configuration/messages', [EndConfigurationController::class, 'createMessage']);
        Route::post('/configuration/messages/update', [EndConfigurationController::class, 'updateMessage']);
        Route::post('/configuration/messages/delete', [EndConfigurationController::class, 'destroyMessage']);

        Route::get('/configuration/refunds', [EndConfigurationController::class, 'viewRefund']);
        Route::post('/configuration/refunds', [EndConfigurationController::class, 'createRefund']);
        Route::post('/configuration/refunds/update', [EndConfigurationController::class, 'updateRefund']);
        Route::post('/configuration/refunds/delete', [EndConfigurationController::class, 'destroyRefund']);

        Route::get('/configuration/payouts', [EndConfigurationController::class, 'viewPayout']);
        Route::post('/configuration/payouts', [EndConfigurationController::class, 'createPayout']);
        Route::post('/configuration/payouts/update', [EndConfigurationController::class, 'updatePayout']);
        Route::post('/configuration/payouts/delete', [EndConfigurationController::class, 'destroyPayout']);

        Route::get('/configuration/subscriptions', [EndConfigurationController::class, 'viewSubscription']);
        Route::post('/configuration/subscriptions', [EndConfigurationController::class, 'createSubscription']);
        Route::post('/configuration/subscriptions/update', [EndConfigurationController::class, 'updateSubscription']);
        Route::post('/configuration/subscriptions/delete', [EndConfigurationController::class, 'destroySubscription']);

        Route::get('/configuration/event-managers', [EndConfigurationController::class, 'viewEventManager']);
        Route::post('/configuration/event-managers', [EndConfigurationController::class, 'createEventManager']);
        Route::post('/configuration/event-managers/update', [EndConfigurationController::class, 'updateEventManager']);
        Route::post('/configuration/event-managers/delete', [EndConfigurationController::class, 'destroyEventManager']);

        Route::get('/configuration/subscription-packages', [EndConfigurationController::class, 'viewSubscriptionPackage']);
        Route::post('/configuration/subscription-packages', [EndConfigurationController::class, 'createSubscriptionPackage']);
        Route::post('/configuration/subscription-packages/update', [EndConfigurationController::class, 'updateSubscriptionPackage']);
        Route::post('/configuration/subscription-packages/delete', [EndConfigurationController::class, 'destroySubscriptionPackage']);
    });


});


