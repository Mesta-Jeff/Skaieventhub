<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebUserController;
use App\Http\Controllers\WebEventController;
use App\Http\Controllers\WebAccountController;
use App\Http\Controllers\WebPaymentController;
use App\Http\Controllers\WebSettingsController;
use App\Http\Controllers\WebManagementController;
use App\Http\Controllers\WebAdvertisementController;
use App\Http\Controllers\WebConfigurationController;
use App\Http\Controllers\WebAuthenticationController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('management/dashboard', [WebManagementController::class, 'dashboard'])->name('management.dashboard');


// Roles:
Route::get('/settings/roles', [WebSettingsController::class, 'showRole'])->name('settings.roles.show');
Route::post('/settings/roles', [WebSettingsController::class, 'addRole'])->name('settings.roles.create');
Route::post('/settings/roles/update', [WebSettingsController::class, 'modifyRole'])->name('settings.roles.update');
Route::post('/settings/roles/delete', [WebSettingsController::class, 'removeRole'])->name('settings.roles.destroy');
Route::get('/settings/roles/fetch', [WebSettingsController::class, 'fetchRole'])->name('settings.roles.fetch');

// Regions:
Route::get('/settings/regions', [WebSettingsController::class, 'showRegion'])->name('settings.regions.show');
Route::post('/settings/regions', [WebSettingsController::class, 'addRegion'])->name('settings.regions.create');
Route::post('/settings/regions/update', [WebSettingsController::class, 'modifyRegion'])->name('settings.regions.update');
Route::post('/settings/regions/delete', [WebSettingsController::class, 'removeRegion'])->name('settings.regions.destroy');
Route::get('/settings/regions/get', [WebSettingsController::class, 'getRegion'])->name('settings.regions.get');

// Districts:
Route::get('/settings/districts', [WebSettingsController::class, 'showDistrict'])->name('settings.districts.show');
Route::post('/settings/districts', [WebSettingsController::class, 'addDistrict'])->name('settings.districts.create');
Route::post('/settings/districts/update', [WebSettingsController::class, 'modifyDistrict'])->name('settings.districts.update');
Route::post('/settings/districts/delete', [WebSettingsController::class, 'removeDistrict'])->name('settings.districts.destroy');
Route::get('/settings/districts/get', [WebSettingsController::class, 'getDistrict'])->name('settings.districts.get');

// Towns:
Route::get('/settings/towns', [WebSettingsController::class, 'showTown'])->name('settings.towns.show');
Route::post('/settings/towns', [WebSettingsController::class, 'addTown'])->name('settings.towns.create');
Route::post('/settings/towns/update', [WebSettingsController::class, 'modifyTown'])->name('settings.towns.update');
Route::post('/settings/towns/delete', [WebSettingsController::class, 'removeTown'])->name('settings.towns.destroy');
Route::get('/settings/towns/get', [WebSettingsController::class, 'getTown'])->name('settings.towns.get');

// Permissions:
Route::get('/settings/permissions', [WebSettingsController::class, 'showPermission'])->name('settings.permissions.show');
Route::post('/settings/permissions', [WebSettingsController::class, 'addPermission'])->name('settings.permissions.create');
Route::post('/settings/permissions/update', [WebSettingsController::class, 'modifyPermission'])->name('settings.permissions.update');
Route::post('/settings/permissions/delete', [WebSettingsController::class, 'removePermission'])->name('settings.permissions.destroy');
Route::get('/settings/permissions/get', [WebSettingsController::class, 'getPermission'])->name('settings.permissions.get');


// User Permissions:
Route::get('/settings/user-permissions', [WebSettingsController::class, 'showUserPermission'])->name('settings.userpermissions.show');
Route::post('/settings/user-permissions', [WebSettingsController::class, 'addUserPermission'])->name('settings.userpermissions.create');
Route::post('/settings/user-permissions/update', [WebSettingsController::class, 'modifyUserPermission'])->name('settings.userpermissions.update');
Route::post('/settings/user-permissions/delete', [WebSettingsController::class, 'removeUserPermission'])->name('settings.userpermissions.destroy');
Route::get('/settings/user-permissions/get', [WebSettingsController::class, 'getUserPermission'])->name('settings.userpermissions.get');

// Identity Types:
Route::get('/settings/identity-types', [WebSettingsController::class, 'showIdentityType'])->name('settings.identitytypes.show');
Route::post('/settings/identity-types', [WebSettingsController::class, 'addIdentityType'])->name('settings.identitytypes.create');
Route::post('/settings/identity-types/update', [WebSettingsController::class, 'modifyIdentityType'])->name('settings.identitytypes.update');
Route::post('/settings/identity-types/delete', [WebSettingsController::class, 'removeIdentityType'])->name('settings.identitytypes.destroy');
Route::get('/settings/identity-types/get', [WebSettingsController::class, 'getIdentityType'])->name('settings.identitytypes.get');

// API Routes:
Route::get('/settings/api-routes', [WebSettingsController::class, 'showAPIRoute'])->name('settings.apiroutes.show');
Route::post('/settings/api-routes', [WebSettingsController::class, 'addAPIRoute'])->name('settings.apiroutes.create');
Route::post('/settings/api-routes/update', [WebSettingsController::class, 'modifyAPIRoute'])->name('settings.apiroutes.update');
Route::post('/settings/api-routes/delete', [WebSettingsController::class, 'removeAPIRoute'])->name('settings.apiroutes.destroy');
Route::get('/settings/api-routes/get', [WebSettingsController::class, 'getAPIRoute'])->name('settings.apiroutes.get');

// Notifications:
Route::get('/settings/notifications', [WebSettingsController::class, 'showNotification'])->name('settings.notifications.show');
Route::post('/settings/notifications', [WebSettingsController::class, 'addNotification'])->name('settings.notifications.create');
Route::post('/settings/notifications/update', [WebSettingsController::class, 'modifyNotification'])->name('settings.notifications.update');
Route::post('/settings/notifications/delete', [WebSettingsController::class, 'removeNotification'])->name('settings.notifications.destroy');
Route::get('/settings/notifications/get', [WebSettingsController::class, 'getNotification'])->name('settings.notifications.get');


// Users:
Route::get('/users/list', [WebUserController::class, 'showUser'])->name('users.show');
Route::post('/users/add', [WebUserController::class, 'addUser'])->name('users.create');
Route::post('/users/update', [WebUserController::class, 'modifyUser'])->name('users.update');
Route::post('/users/delete', [WebUserController::class, 'removeUser'])->name('users.destroy');
Route::get('/users/get', [WebUserController::class, 'getUser'])->name('users.get');

// User OTP Tokens:
Route::get('/users/otp-tokens', [WebUserController::class, 'showUserOTPToken'])->name('users.otptokens.show');
Route::post('/users/otp-tokens', [WebUserController::class, 'addUserOTPToken'])->name('users.otptokens.create');
Route::post('/users/otp-tokens/update', [WebUserController::class, 'modifyUserOTPToken'])->name('users.otptokens.update');
Route::post('/users/otp-tokens/delete', [WebUserController::class, 'removeUserOTPToken'])->name('users.otptokens.destroy');
Route::get('/users/otp-tokens/get', [WebUserController::class, 'getUserOTPToken'])->name('users.otptokens.get');

// User API Tokens:
Route::get('/users/api-tokens', [WebUserController::class, 'showUserAPIToken'])->name('users.apitokens.show');
Route::post('/users/api-tokens', [WebUserController::class, 'addUserAPIToken'])->name('users.apitokens.create');
Route::post('/users/api-tokens/update', [WebUserController::class, 'modifyUserAPIToken'])->name('users.apitokens.update');
Route::post('/users/api-tokens/delete', [WebUserController::class, 'removeUserAPIToken'])->name('users.apitokens.destroy');
Route::get('/users/api-tokens/get', [WebUserController::class, 'getUserAPIToken'])->name('users.apitokens.get');



// Authors:
Route::get('/events/authors', [WebEventController::class, 'showAuthor'])->name('events.authors.show');
Route::post('/events/authors', [WebEventController::class, 'addAuthor'])->name('events.authors.create');
Route::post('/events/authors/update', [WebEventController::class, 'modifyAuthor'])->name('events.authors.update');
Route::post('/events/authors/delete', [WebEventController::class, 'removeAuthor'])->name('events.authors.destroy');
Route::get('/events/authors/get', [WebEventController::class, 'getAuthor'])->name('events.authors.get');

// Event Types:
Route::get('/events/types', [WebEventController::class, 'showEventType'])->name('events.types.show');
Route::post('/events/types', [WebEventController::class, 'addEventType'])->name('events.types.create');
Route::post('/events/types/update', [WebEventController::class, 'modifyEventType'])->name('events.types.update');
Route::post('/events/types/delete', [WebEventController::class, 'removeEventType'])->name('events.types.destroy');
Route::get('/events/types/get', [WebEventController::class, 'getEventType'])->name('events.types.get');

// Events:
Route::get('/events', [WebEventController::class, 'showEvent'])->name('events.show');
Route::post('/events', [WebEventController::class, 'addEvent'])->name('events.create');
Route::post('/events/update', [WebEventController::class, 'modifyEvent'])->name('events.update');
Route::post('/events/delete', [WebEventController::class, 'removeEvent'])->name('events.destroy');
Route::get('/events/get', [WebEventController::class, 'getEvent'])->name('events.get');

// Tickets:
Route::get('/events/event-tickets', [WebEventController::class, 'showEventTicket'])->name('events.tickets.show');
Route::post('/events/event-tickets', [WebEventController::class, 'addEventTicket'])->name('events.tickets.create');
Route::post('/events/event-tickets/update', [WebEventController::class, 'modifyEventTicket'])->name('events.tickets.update');
Route::post('/events/event-tickets/delete', [WebEventController::class, 'removeEventTicket'])->name('events.tickets.destroy');
Route::get('/events/event-tickets/get', [WebEventController::class, 'getEventTicket'])->name('events.tickets.get');

// User Tickets:
Route::get('/events/user-tickets', [WebEventController::class, 'showUserTicket'])->name('events.usertickets.show');
Route::post('/events/user-tickets', [WebEventController::class, 'addUserTicket'])->name('events.usertickets.create');
Route::post('/events/user-tickets/update', [WebEventController::class, 'modifyUserTicket'])->name('events.usertickets.update');
Route::post('/events/user-tickets/delete', [WebEventController::class, 'removeUserTicket'])->name('events.usertickets.destroy');
Route::get('/events/user-tickets/get', [WebEventController::class, 'getUserTicket'])->name('events.usertickets.get');

// Event Comments:
Route::get('/events/comments', [WebEventController::class, 'showEventComment'])->name('events.comments.show');
Route::post('/events/comments', [WebEventController::class, 'addEventComment'])->name('events.comments.create');
Route::post('/events/comments/update', [WebEventController::class, 'modifyEventComment'])->name('events.comments.update');
Route::post('/events/comments/delete', [WebEventController::class, 'removeEventComment'])->name('events.comments.destroy');
Route::get('/events/comments/get', [WebEventController::class, 'getEventComment'])->name('events.comments.get');

// Event Likes:
Route::get('/events/likes', [WebEventController::class, 'showEventLike'])->name('events.likes.show');
Route::post('/events/likes', [WebEventController::class, 'addEventLike'])->name('events.likes.create');
Route::post('/events/likes/update', [WebEventController::class, 'modifyEventLike'])->name('events.likes.update');
Route::post('/events/likes/delete', [WebEventController::class, 'removeEventLike'])->name('events.likes.destroy');
Route::get('/events/likes/get', [WebEventController::class, 'getEventLike'])->name('events.likes.get');

// Event Stars:
Route::get('/events/stars', [WebEventController::class, 'showEventStar'])->name('events.stars.show');
Route::post('/events/stars', [WebEventController::class, 'addEventStar'])->name('events.stars.create');
Route::post('/events/stars/update', [WebEventController::class, 'modifyEventStar'])->name('events.stars.update');
Route::post('/events/stars/delete', [WebEventController::class, 'removeEventStar'])->name('events.stars.destroy');
Route::get('/events/stars/get', [WebEventController::class, 'getEventStar'])->name('events.stars.get');

// Payments:
Route::get('/events/payments', [WebPaymentController::class, 'showPayment'])->name('events.payments.show');
Route::post('/events/payments', [WebPaymentController::class, 'addPayment'])->name('events.payments.create');
Route::post('/events/payments/update', [WebPaymentController::class, 'modifyPayment'])->name('events.payments.update');
Route::post('/events/payments/delete', [WebPaymentController::class, 'removePayment'])->name('events.payments.destroy');
Route::get('/events/payments/get', [WebPaymentController::class, 'getPayment'])->name('events.payments.get');


// Portrait Adverts:
Route::get('/ads/portrait-adverts', [WebAdvertisementController::class, 'showPortraitAdvert'])->name('ads.portraitadverts.show');
Route::post('/ads/portrait-adverts', [WebAdvertisementController::class, 'addPortraitAdvert'])->name('ads.portraitadverts.create');
Route::post('/ads/portrait-adverts/update', [WebAdvertisementController::class, 'modifyPortraitAdvert'])->name('ads.portraitadverts.update');
Route::post('/ads/portrait-adverts/delete', [WebAdvertisementController::class, 'removePortraitAdvert'])->name('ads.portraitadverts.destroy');
Route::get('/ads/portrait-adverts/get', [WebAdvertisementController::class, 'getPortraitAdvert'])->name('ads.portraitadverts.get');

// Landscape Adverts:
Route::get('/ads/landscape-adverts', [WebAdvertisementController::class, 'showLandscapeAdvert'])->name('ads.landscapeadverts.show');
Route::post('/ads/landscape-adverts', [WebAdvertisementController::class, 'addLandscapeAdvert'])->name('ads.landscapeadverts.create');
Route::post('/ads/landscape-adverts/update', [WebAdvertisementController::class, 'modifyLandscapeAdvert'])->name('ads.landscapeadverts.update');
Route::post('/ads/landscape-adverts/delete', [WebAdvertisementController::class, 'removeLandscapeAdvert'])->name('ads.landscapeadverts.destroy');
Route::get('/ads/landscape-adverts/get', [WebAdvertisementController::class, 'getLandscapeAdvert'])->name('ads.landscapeadverts.get');

// Issue Concern
Route::get('/account/issue-concern', [WebAccountController::class, 'showIssueConcern'])->name('account.issueconcern.show');
Route::post('/account/issue-concern', [WebAccountController::class, 'addIssueConcern'])->name('account.issueconcern.create');
Route::post('/account/issue-concern/update', [WebAccountController::class, 'modifyIssueConcern'])->name('account.issueconcern.update');
Route::post('/account/issue-concern/delete', [WebAccountController::class, 'removeIssueConcern'])->name('account.issueconcern.destroy');

// Request Refund
Route::get('/account/request-refund', [WebAccountController::class, 'showRequestRefund'])->name('account.requestrefund.show');
Route::post('/account/request-refund', [WebAccountController::class, 'addRequestRefund'])->name('account.requestrefund.create');
Route::post('/account/request-refund/update', [WebAccountController::class, 'modifyRequestRefund'])->name('account.requestrefund.update');
Route::post('/account/request-refund/delete', [WebAccountController::class, 'removeRequestRefund'])->name('account.requestrefund.destroy');

// Enable 2FA
Route::get('/account/enable-2fa', [WebAccountController::class, 'showEnable2FA'])->name('account.enable2fa.show');
Route::post('/account/enable-2fa', [WebAccountController::class, 'addEnable2FA'])->name('account.enable2fa.create');
Route::post('/account/enable-2fa/update', [WebAccountController::class, 'modifyEnable2FA'])->name('account.enable2fa.update');
Route::post('/account/enable-2fa/delete', [WebAccountController::class, 'removeEnable2FA'])->name('account.enable2fa.destroy');

// My Profile
Route::get('/account/my-profile', [WebAccountController::class, 'showMyProfile'])->name('account.myprofile.show');
Route::post('/account/change/password', [WebAccountController::class, 'changeMyPassword'])->name('account.changepassword');
Route::post('/account/verify-email', [WebAccountController::class, 'verifyMyEmail'])->name('account.verifyemail');
Route::post('/account/profile/picture/update', [WebAccountController::class, 'modifyProfilePicture'])->name('account.profilepicture.update');
Route::post('/account/profile/cover/update', [WebAccountController::class, 'modifyProfileCover'])->name('account.profilecover.update');

// Cash Out
Route::get('/account/cash-out', [WebAccountController::class, 'showCashOut'])->name('account.cashout.show');
Route::post('/account/cash-out', [WebAccountController::class, 'addCashOut'])->name('account.cashout.create');
Route::post('/account/cash-out/update', [WebAccountController::class, 'modifyCashOut'])->name('account.cashout.update');
Route::post('/account/cash-out/delete', [WebAccountController::class, 'removeCashOut'])->name('account.cashout.destroy');

// Bank Statement
Route::get('/account/bank-statement', [WebAccountController::class, 'showBankStatement'])->name('account.bankstatement.show');
Route::post('/account/bank-statement', [WebAccountController::class, 'addBankStatement'])->name('account.bankstatement.create');
Route::post('/account/bank-statement/update', [WebAccountController::class, 'modifyBankStatement'])->name('account.bankstatement.update');
Route::post('/account/bank-statement/delete', [WebAccountController::class, 'removeBankStatement'])->name('account.bankstatement.destroy');

// Live Event
Route::get('/account/live-event', [WebAccountController::class, 'showLiveEvent'])->name('account.liveevent.show');
Route::post('/account/live-event', [WebAccountController::class, 'addLiveEvent'])->name('account.liveevent.create');
Route::post('/account/live-event/update', [WebAccountController::class, 'modifyLiveEvent'])->name('account.liveevent.update');
Route::post('/account/live-event/delete', [WebAccountController::class, 'removeLiveEvent'])->name('account.liveevent.destroy');

// Cast Stream
Route::get('/account/cast-stream', [WebAccountController::class, 'showCastStream'])->name('account.caststream.show');
Route::post('/account/cast-stream', [WebAccountController::class, 'addCastStream'])->name('account.caststream.create');
Route::post('/account/cast-stream/update', [WebAccountController::class, 'modifyCastStream'])->name('account.caststream.update');
Route::post('/account/cast-stream/delete', [WebAccountController::class, 'removeCastStream'])->name('account.caststream.destroy');

// Alert Management
Route::get('/account/alert-management', [WebAccountController::class, 'showAlertManagement'])->name('account.alertmanagement.show');
Route::post('/account/alert-management', [WebAccountController::class, 'addAlertManagement'])->name('account.alertmanagement.create');
Route::post('/account/alert-management/update', [WebAccountController::class, 'modifyAlertManagement'])->name('account.alertmanagement.update');
Route::post('/account/alert-management/delete', [WebAccountController::class, 'removeAlertManagement'])->name('account.alertmanagement.destroy');

// Chat Friend
Route::get('/account/chat-friend', [WebAccountController::class, 'showChatFriend'])->name('account.chatfriend.show');
Route::post('/account/chat-friend', [WebAccountController::class, 'addChatFriend'])->name('account.chatfriend.create');
Route::post('/account/chat-friend/update', [WebAccountController::class, 'modifyChatFriend'])->name('account.chatfriend.update');
Route::post('/account/chat-friend/delete', [WebAccountController::class, 'removeChatFriend'])->name('account.chatfriend.destroy');

// Read Policy
Route::get('/account/read-policy', [WebAccountController::class, 'showReadPolicy'])->name('account.readpolicy.show');
Route::post('/account/read-policy', [WebAccountController::class, 'addReadPolicy'])->name('account.readpolicy.create');
Route::post('/account/read-policy/update', [WebAccountController::class, 'modifyReadPolicy'])->name('account.readpolicy.update');
Route::post('/account/read-policy/delete', [WebAccountController::class, 'removeReadPolicy'])->name('account.readpolicy.destroy');

// Contact Management
Route::get('/account/contact-management', [WebAccountController::class, 'showContactManagement'])->name('account.contactmanagement.show');
Route::post('/account/contact-management', [WebAccountController::class, 'addContactManagement'])->name('account.contactmanagement.create');
Route::post('/account/contact-management/update', [WebAccountController::class, 'modifyContactManagement'])->name('account.contactmanagement.update');
Route::post('/account/contact-management/delete', [WebAccountController::class, 'removeContactManagement'])->name('account.contactmanagement.destroy');

// Configuration Routes
Route::get('/configuration/sms', [WebConfigurationController::class, 'showSms'])->name('config.sms.show');
Route::post('/configuration/sms', [WebConfigurationController::class, 'addSms'])->name('config.sms.create');
Route::post('/configuration/sms/update', [WebConfigurationController::class, 'modifySms'])->name('config.sms.update');
Route::post('/configuration/sms/delete', [WebConfigurationController::class, 'removeSms'])->name('config.sms.destroy');

Route::get('/configuration/sms-subscriptions', [WebConfigurationController::class, 'showSmsSubscription'])->name('config.smssubscriptions.show');
Route::post('/configuration/sms-subscriptions', [WebConfigurationController::class, 'addSmsSubscription'])->name('config.smssubscriptions.create');
Route::post('/configuration/sms-subscriptions/update', [WebConfigurationController::class, 'modifySmsSubscription'])->name('config.smssubscriptions.update');
Route::post('/configuration/sms-subscriptions/delete', [WebConfigurationController::class, 'removeSmsSubscription'])->name('config.smssubscriptions.destroy');

Route::get('/configuration/user-concerns', [WebConfigurationController::class, 'showUserConcern'])->name('config.userconcerns.show');
Route::post('/configuration/user-concerns', [WebConfigurationController::class, 'addUserConcern'])->name('config.userconcerns.create');
Route::post('/configuration/user-concerns/update', [WebConfigurationController::class, 'modifyUserConcern'])->name('config.userconcerns.update');
Route::post('/configuration/user-concerns/delete', [WebConfigurationController::class, 'removeUserConcern'])->name('config.userconcerns.destroy');

Route::get('/configuration/emails', [WebConfigurationController::class, 'showEmail'])->name('config.emails.show');
Route::post('/configuration/emails', [WebConfigurationController::class, 'addEmail'])->name('config.emails.create');
Route::post('/configuration/emails/update', [WebConfigurationController::class, 'modifyEmail'])->name('config.emails.update');
Route::post('/configuration/emails/delete', [WebConfigurationController::class, 'removeEmail'])->name('config.emails.destroy');

Route::get('/configuration/messages', [WebConfigurationController::class, 'showMessage'])->name('config.messages.show');
Route::post('/configuration/messages', [WebConfigurationController::class, 'addMessage'])->name('config.messages.create');
Route::post('/configuration/messages/update', [WebConfigurationController::class, 'modifyMessage'])->name('config.messages.update');
Route::post('/configuration/messages/delete', [WebConfigurationController::class, 'removeMessage'])->name('config.messages.destroy');

Route::get('/configuration/refunds', [WebConfigurationController::class, 'showRefund'])->name('config.refunds.show');
Route::post('/configuration/refunds', [WebConfigurationController::class, 'addRefund'])->name('config.refunds.create');
Route::post('/configuration/refunds/update', [WebConfigurationController::class, 'modifyRefund'])->name('config.refunds.update');
Route::post('/configuration/refunds/delete', [WebConfigurationController::class, 'removeRefund'])->name('config.refunds.destroy');

Route::get('/configuration/payouts', [WebConfigurationController::class, 'showPayout'])->name('config.payouts.show');
Route::post('/configuration/payouts', [WebConfigurationController::class, 'addPayout'])->name('config.payouts.create');
Route::post('/configuration/payouts/update', [WebConfigurationController::class, 'modifyPayout'])->name('config.payouts.update');
Route::post('/configuration/payouts/delete', [WebConfigurationController::class, 'removePayout'])->name('config.payouts.destroy');

Route::get('/configuration/subscription-packages', [WebConfigurationController::class, 'showSubscriptionPackage'])->name('config.subscriptionpackages.show');
Route::post('/configuration/subscription-packages', [WebConfigurationController::class, 'addSubscriptionPackage'])->name('config.subscriptionpackages.create');
Route::post('/configuration/subscription-packages/update', [WebConfigurationController::class, 'modifySubscriptionPackage'])->name('config.subscriptionpackages.update');
Route::post('/configuration/subscription-packages/delete', [WebConfigurationController::class, 'removeSubscriptionPackage'])->name('config.subscriptionpackages.destroy');

// Configuration Subscriptions Routes
Route::get('/configuration/subscriptions', [WebConfigurationController::class, 'showSubscription'])->name('config.subscriptions.show');
Route::post('/configuration/subscriptions', [WebConfigurationController::class, 'addSubscription'])->name('config.subscriptions.create');
Route::post('/configuration/subscriptions/update', [WebConfigurationController::class, 'modifySubscription'])->name('config.subscriptions.update');
Route::post('/configuration/subscriptions/delete', [WebConfigurationController::class, 'removeSubscription'])->name('config.subscriptions.destroy');

// Configuration Event Managers Routes
Route::get('/configuration/event-managers', [WebConfigurationController::class, 'showEventManager'])->name('config.eventmanagers.show');
Route::post('/configuration/event-managers', [WebConfigurationController::class, 'addEventManager'])->name('config.eventmanagers.create');
Route::post('/configuration/event-managers/update', [WebConfigurationController::class, 'modifyEventManager'])->name('config.eventmanagers.update');
Route::post('/configuration/event-managers/delete', [WebConfigurationController::class, 'removeEventManager'])->name('config.eventmanagers.destroy');




