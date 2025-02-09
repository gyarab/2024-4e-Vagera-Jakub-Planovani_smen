<?php

use App\Http\Controllers\PersonalShiftControler;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\vendor\Chatify\MessagesController;

/**
 * -----------------------------------------------------------------
 * NOTE : There is two routes has a name (user & group),
 * any change in these two route's name may cause an issue
 * if not modified in all places that used in (e.g Chatify class,
 * Controllers, chatify javascript file...).
 * -----------------------------------------------------------------
 */

use Illuminate\Support\Facades\Route;

/*
* This is the main app route [Chatify Messenger]
*/
Route::get('/', 'MessagesController@index')->name(config('chatify.routes.prefix'));
/*Route::get('/', [MessagesController::class, 'index'])->name(config('chatify.routes.prefix'));
Route::get('/ProfileController/id', [ProfileController::class, 'id'])->name(config('chatify.routes.prefix') . '.id');
Route::get('/ProfileController/parameters', [ProfileController::class, 'id'])->name(config('chatify.routes.prefix') . '.parameters');*/

//$parameters = (new ProfileController)->session_parameters();
/*Route::get('/', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    //return view(compact('id','parameters'));
})->name(config('chatify.routes.prefix'));*/
/*Route::get('/', function () {
    // Logic for the first route (MessagesController)
    // Assuming you want to pass the same route name to both routes:
    $messagesRouteName = config('chatify.routes.prefix');

    // Logic for the second route (ProfileController)
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    
    // Return the appropriate view
    //return view( compact('id', 'parameters', 'messagesRouteName'));
})
->middleware(['auth', 'verified', 'admin'])
->name(compact('id', 'parameters', 'messagesRouteName'));*/


/**
 *  Fetch info for specific id [user/group]
 */
Route::post('/idInfo', 'MessagesController@idFetchData');

/**
 * Send message route
 */
Route::post('/sendMessage', 'MessagesController@send')->name('send.message');

/**
 * Fetch messages
 */
Route::post('/fetchMessages', 'MessagesController@fetch')->name('fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/download/{fileName}', 'MessagesController@download')->name(config('chatify.attachments.download_route_name'));

/**
 * Authentication for pusher private channels
 */
Route::post('/chat/auth', 'MessagesController@pusherAuth')->name('pusher.auth');

/**
 * Make messages as seen
 */
Route::post('/makeSeen', 'MessagesController@seen')->name('messages.seen');

/**
 * Get contacts
 */
Route::get('/getContacts', 'MessagesController@getContacts')->name('contacts.get');

/**
 * Update contact item data
 */
Route::post('/updateContacts', 'MessagesController@updateContactItem')->name('contacts.update');


/**
 * Star in favorite list
 */
Route::post('/star', 'MessagesController@favorite')->name('star');

/**
 * get favorites list
 */
Route::post('/favorites', 'MessagesController@getFavorites')->name('favorites');

/**
 * Search in messenger
 */
Route::get('/search', 'MessagesController@search')->name('search');

/**
 * Get shared photos
 */
Route::post('/shared', 'MessagesController@sharedPhotos')->name('shared');

/**
 * Delete Conversation
 */
Route::post('/deleteConversation', 'MessagesController@deleteConversation')->name('conversation.delete');

/**
 * Delete Message
 */
Route::post('/deleteMessage', 'MessagesController@deleteMessage')->name('message.delete');

/**
 * Update setting
 */
Route::post('/updateSettings', 'MessagesController@updateSettings')->name('avatar.update');

/**
 * Set active status
 */
Route::post('/setActiveStatus', 'MessagesController@setActiveStatus')->name('activeStatus.set');






/*
* [Group] view by id
*/
Route::get('/group/{id}', 'MessagesController@index')->name('group');

/*
* user view by id.
* Note : If you added routes after the [User] which is the below one,
* it will considered as user id.
*
* e.g. - The commented routes below :
*/
// Route::get('/route', function(){ return 'Munaf'; }); // works as a route
Route::get('/{id}', 'MessagesController@index')->name('user');
// Route::get('/route', function(){ return 'Munaf'; }); // works as a user id
