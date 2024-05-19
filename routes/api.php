<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\PaymentController;
use App\Http\Controllers\api\SettingsController;
use App\Http\Controllers\api\ApiRawClientController;
use App\Http\Controllers\api\AdvertisementController;
use App\Http\Controllers\api\AuthenticationController;


Route::get('/user', function (Request $request) {
    return $request->all();
})->middleware('auth:sanctum');




Route::prefix('v2')->group(function () {

    // Free and Open Routes
    Route::post('/users/add', [ApiRawClientController::class, 'createUser']);
    Route::post('/users/new/registration', [ApiRawClientController::class, 'register']);

    // Route::middleware('auth:sanctum')->get('/user/list', [AuthenticationController::class, 'getAllUsers']);

    Route::middleware([CheckApiKey::class, 'auth:sanctum'])->group(function () {

        // Regions:
        Route::get('/settings/regions', [SettingsController::class, 'viewRegion']);
        Route::post('/settings/regions', [SettingsController::class, 'createRegion']);
        Route::post('/settings/regions/update', [SettingsController::class, 'updateRegion']);
        Route::post('/settings/regions/delete', [SettingsController::class, 'destroyRegion']);
        Route::get('/settings/regions/sort', [SettingsController::class, 'sortRegion']);

        // Districts:
        Route::get('/settings/districts', [SettingsController::class, 'viewDistrict']);
        Route::post('/settings/districts', [SettingsController::class, 'createDistrict']);
        Route::post('/settings/districts/update', [SettingsController::class, 'updateDistrict']);
        Route::post('/settings/districts/delete', [SettingsController::class, 'destroyDistrict']);
        Route::get('/settings/districts/sort', [SettingsController::class, 'sortDistrict']);

        // Towns:
        Route::get('/settings/towns', [SettingsController::class, 'viewTown']);
        Route::post('/settings/towns', [SettingsController::class, 'createTown']);
        Route::post('/settings/towns/update', [SettingsController::class, 'updateTown']);
        Route::post('/settings/towns/delete', [SettingsController::class, 'destroyTown']);
        Route::get('/settings/towns/sort', [SettingsController::class, 'sortTown']);

        // Roles:
        Route::get('/settings/roles', [SettingsController::class, 'viewRole']);
        Route::post('/settings/roles', [SettingsController::class, 'createRole']);
        Route::post('/settings/roles/update', [SettingsController::class, 'updateRole']);
        Route::post('/settings/roles/delete', [SettingsController::class, 'destroyRole']);
        Route::get('/settings/roles/sort', [SettingsController::class, 'sortRole']);

        // Permissions:
        Route::get('/settings/permissions', [SettingsController::class, 'viewPermission']);
        Route::post('/settings/permissions', [SettingsController::class, 'createPermission']);
        Route::post('/settings/permissions/update', [SettingsController::class, 'updatePermission']);
        Route::post('/settings/permissions/delete', [SettingsController::class, 'destroyPermission']);
        Route::get('/settings/permissions/sort', [SettingsController::class, 'sortPermission']);

        // Users:
        Route::get('/users', [ApiRawClientController::class, 'viewUser']);
        // Route::post('/users/add', [ApiRawClientController::class, 'createUser']);
        Route::post('/users/update', [ApiRawClientController::class, 'updateUser']);
        Route::post('/users/delete', [ApiRawClientController::class, 'destroyUser']);
        Route::get('/users/sort', [ApiRawClientController::class, 'sortUser']);

        // User OTP Tokens:
        Route::get('/users/otp-tokens', [ApiRawClientController::class, 'viewUserOTPToken']);
        Route::post('/users/otp-tokens', [ApiRawClientController::class, 'createUserOTPToken']);
        Route::post('/users/otp-tokens/update', [ApiRawClientController::class, 'updateUserOTPToken']);
        Route::post('/users/otp-tokens/delete', [ApiRawClientController::class, 'destroyUserOTPToken']);
        Route::get('/users/otp-tokens/sort', [ApiRawClientController::class, 'sortUserOTPToken']);

        // User API Tokens:
        Route::get('/users/api-tokens', [ApiRawClientController::class, 'viewUserAPIToken']);
        Route::post('/users/api-tokens', [ApiRawClientController::class, 'createUserAPIToken']);
        Route::post('/users/api-tokens/update', [ApiRawClientController::class, 'updateUserAPIToken']);
        Route::post('/users/api-tokens/delete', [ApiRawClientController::class, 'destroyUserAPIToken']);
        Route::get('/users/api-tokens/sort', [ApiRawClientController::class, 'sortUserAPIToken']);

        // User Permissions:
        Route::get('/settings/user-permissions', [SettingsController::class, 'viewUserPermission']);
        Route::post('/settings/user-permissions', [SettingsController::class, 'createUserPermission']);
        Route::post('/settings/user-permissions/update', [SettingsController::class, 'updateUserPermission']);
        Route::post('/settings/user-permissions/delete', [SettingsController::class, 'destroyUserPermission']);
        Route::get('/settings/user-permissions/sort', [SettingsController::class, 'sortUserPermission']);

        // Identity Types:
        Route::get('/settings/identity-types', [SettingsController::class, 'viewIdentityType']);
        Route::post('/settings/identity-types', [SettingsController::class, 'createIdentityType']);
        Route::post('/settings/identity-types/update', [SettingsController::class, 'updateIdentityType']);
        Route::post('/settings/identity-types/delete', [SettingsController::class, 'destroyIdentityType']);
        Route::get('/settings/identity-types/sort', [SettingsController::class, 'sortIdentityType']);

        // Authors:
        Route::get('/events/authors', [EventController::class, 'viewAuthor']);
        Route::post('/events/authors', [EventController::class, 'createAuthor']);
        Route::post('/events/authors/update', [EventController::class, 'updateAuthor']);
        Route::post('/events/authors/delete', [EventController::class, 'destroyAuthor']);
        Route::get('/events/authors/sort', [EventController::class, 'sortAuthor']);

        // Event Types:
        Route::get('/events/types', [EventController::class, 'viewEventType']);
        Route::post('/events/types', [EventController::class, 'createEventType']);
        Route::post('/events/types/update', [EventController::class, 'updateEventType']);
        Route::post('/events/types/delete', [EventController::class, 'destroyEventType']);
        Route::get('/events/types/sort', [EventController::class, 'sortEventType']);

        // Events:
        Route::get('/events', [EventController::class, 'viewEvent']);
        Route::post('/events', [EventController::class, 'createEvent']);
        Route::post('/events/update', [EventController::class, 'updateEvent']);
        Route::post('/events/delete', [EventController::class, 'destroyEvent']);
        Route::get('/events/sort', [EventController::class, 'sortEvent']);

        // Tickets:
        Route::get('/events/event-tickets', [EventController::class, 'viewEventTicket']);
        Route::post('/events/event-tickets', [EventController::class, 'createEventTicket']);
        Route::post('/events/event-tickets/update', [EventController::class, 'updateEventTicket']);
        Route::post('/events/event-tickets/delete', [EventController::class, 'destroyEventTicket']);
        Route::get('/events/event-tickets/sort', [EventController::class, 'sortEventTicket']);

        // User Tickets:
        Route::get('/events/user-tickets', [EventController::class, 'viewUserTicket']);
        Route::post('/events/user-tickets', [EventController::class, 'createUserTicket']);
        Route::post('/events/user-tickets/update', [EventController::class, 'updateUserTicket']);
        Route::post('/events/user-tickets/delete', [EventController::class, 'destroyUserTicket']);
        Route::get('/events/user-tickets/sort', [EventController::class, 'sortUserTicket']);

        // Event Comments:
        Route::get('/events/comments', [EventController::class, 'viewEventComment']);
        Route::post('/events/comments', [EventController::class, 'createEventComment']);
        Route::post('/events/comments/update', [EventController::class, 'updateEventComment']);
        Route::post('/events/comments/delete', [EventController::class, 'destroyEventComment']);
        Route::get('/events/comments/sort', [EventController::class, 'sortEventComment']);

        // Event Likes:
        Route::get('/events/likes', [EventController::class, 'viewEventLike']);
        Route::post('/events/likes', [EventController::class, 'createEventLike']);
        Route::post('/events/likes/update', [EventController::class, 'updateEventLike']);
        Route::post('/events/likes/delete', [EventController::class, 'destroyEventLike']);
        Route::get('/events/likes/sort', [EventController::class, 'sortEventLike']);

        // Event Stars:
        Route::get('/events/stars', [EventController::class, 'viewEventStar']);
        Route::post('/events/stars', [EventController::class, 'createEventStar']);
        Route::post('/events/stars/update', [EventController::class, 'updateEventStar']);
        Route::post('/events/stars/delete', [EventController::class, 'destroyEventStar']);
        Route::get('/events/stars/sort', [EventController::class, 'sortEventStar']);

        // Payments:
        Route::get('/events/payments', [PaymentController::class, 'viewPayment']);
        Route::post('/events/payments', [PaymentController::class, 'createPayment']);
        Route::post('/events/payments/update', [PaymentController::class, 'updatePayment']);
        Route::post('/events/payments/delete', [PaymentController::class, 'destroyPayment']);
        Route::get('/events/payments/sort', [PaymentController::class, 'sortPayment']);

        // Notifications:
        Route::get('/settings/notifications', [SettingsController::class, 'viewNotification']);
        Route::post('/settings/notifications', [SettingsController::class, 'createNotification']);
        Route::post('/settings/notifications/update', [SettingsController::class, 'updateNotification']);
        Route::post('/settings/notifications/delete', [SettingsController::class, 'destroyNotification']);
        Route::get('/settings/notifications/sort', [SettingsController::class, 'sortNotification']);

        // Portrait Adverts:
        Route::get('/ads/portrait-adverts', [AdvertisementController::class, 'viewPortraitAdvert']);
        Route::post('/ads/portrait-adverts', [AdvertisementController::class, 'createPortraitAdvert']);
        Route::post('/ads/portrait-adverts/update', [AdvertisementController::class, 'updatePortraitAdvert']);
        Route::post('/ads/portrait-adverts/delete', [AdvertisementController::class, 'destroyPortraitAdvert']);
        Route::get('/ads/portrait-adverts/sort', [AdvertisementController::class, 'sortPortraitAdvert']);

        // Landscape Adverts:
        Route::get('/ads/landscape-adverts', [AdvertisementController::class, 'viewLandscapeAdvert']);
        Route::post('/ads/landscape-adverts', [AdvertisementController::class, 'createLandscapeAdvert']);
        Route::post('/ads/landscape-adverts/update', [AdvertisementController::class, 'updateLandscapeAdvert']);
        Route::post('/ads/landscape-adverts/delete', [AdvertisementController::class, 'destroyLandscapeAdvert']);
        Route::get('/ads/landscape-adverts/sort', [AdvertisementController::class, 'sortLandscapeAdvert']);

        // API Routes:
        Route::get('/settings/api-routes', [SettingsController::class, 'viewAPIRoute']);
        Route::post('/settings/api-routes', [SettingsController::class, 'createAPIRoute']);
        Route::post('/settings/api-routes/update', [SettingsController::class, 'updateAPIRoute']);
        Route::post('/settings/api-routes/delete', [SettingsController::class, 'destroyAPIRoute']);
        Route::get('/settings/api-routes/sort', [SettingsController::class, 'sortAPIRoute']);


    });

});
