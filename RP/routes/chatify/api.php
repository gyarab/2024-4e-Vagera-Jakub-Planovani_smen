<?php

use Illuminate\Support\Facades\Route;

/**
 * Authentication for pusher private channels
 */
//Route::post('/chat/auth', 'MessagesController@pusherAuth')->name('api.pusher.auth');

/**
 *  Fetch info for specific id [user/group]
 */
Route::post('/idInfo', 'MessagesController@idFetchData')->name('api.idInfo');

/**
 * Send message route
 */
Route::middleware("auth:sanctum")->group(function () {
    Route::post('/chat/auth', action: 'MessagesController@pusherAuth')->name('api.pusher.auth');
    Route::post('/getFavoriteStatus', action: 'MessagesController@getFavoriteStatus')->name('api.getFavoriteStatus');
    Route::post('/removeFavoriteStatus', action: 'MessagesController@removeFavoriteStatus')->name('api.removeFavoriteStatus');
    Route::post('/star', 'MessagesController@favorite')->name('api.star');
    Route::post('/deleteConversation', 'MessagesController@deleteConversation')->name('api.conversation.delete');
    Route::post('/makeSeen', 'MessagesController@seen')->name('api.messages.seen');
    Route::post('/shared', 'MessagesController@sharedPhotos')->name('api.shared');
    Route::get('/getContacts', 'MessagesController@getContacts')->name('api.contacts.get');

    

Route::post('/sendMessage', 'MessagesController@send')->name('api.send.message');
});
/**
 * Fetch messages
 */
Route::post('/fetchMessages', 'MessagesController@fetch')->name('api.fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/download/{fileName}', 'MessagesController@download')->name('api.'.config('chatify.attachments.download_route_name'));

/**
 * Make messages as seen
 */

/**
 * Get contacts
 */

/**
 * Star in favorite list
 */

/**
 * get favorites list
 */
Route::post('/favorites', 'MessagesController@getFavorites')->name('api.favorites');

/**
 * Search in messenger
 */
Route::get('/search', 'MessagesController@search')->name('api.search');

/**
 * Get shared photos
 */

/**
 * Delete Conversation
 */

/**
 * Delete Conversation
 */
Route::post('/updateSettings', 'MessagesController@updateSettings')->name('api.avatar.update');

/**
 * Set active status
 */
Route::post('/setActiveStatus', 'MessagesController@setActiveStatus')->name('api.activeStatus.set');


