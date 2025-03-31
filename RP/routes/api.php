<?php

use App\Http\Controllers\ApiOffersController;
use App\Http\Controllers\ApiSearchController;
use App\Http\Controllers\ApiOptionsController;
use App\Http\Controllers\ApiObjectController;
use App\Http\Controllers\ApiMyShiftsController;
use App\Http\Controllers\ApiAttendanceController;
use App\Http\Controllers\ApiBoardController;
use App\Http\Controllers\ApiStatisticsController;
use App\Http\Controllers\MessageController2;

use App\Http\Controllers\vendor\Chatify\Api\MessagesController;
use Illuminate\Http\Request;
use App\Models\ChMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthManager;
use Pusher\Pusher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use Chatify\Facades\ChatifyMessenger as Chatify;

use App\Models\User;
use Illuminate\Http\JsonResponse;


/*Route::middleware('auth:sanctum')->post('/send-message', function (Request $request) {
    $message = ChMessage::create([
        'user_id' => Auth::id(),
        'message' => $request->message
    ]);

    // Broadcast the message using Pusher
    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        ['cluster' => env('PUSHER_APP_CLUSTER'), 'useTLS' => true]
    );

    $pusher->trigger('chat-channel', 'new-message', [
        'message' => $message->message,
        'user' => Auth::user()->name
    ]);

    return response()->json($message);
});*/

Route::post('/login_mobile', [AuthManager::class, 'login_mobile']);
Route::post('/register_mobile', [AuthManager::class, 'register']);


Route::middleware("auth:sanctum")->group(function () {
    Route::post('/list', function () {

        return \App\Models\User::all();
    });
});/*
Route::middleware('auth:sanctum')->group(function () {
 Broadcast::routes(['middleware' => ['auth:sanctum']]);
});*/   


Route::middleware("auth:sanctum")->group(function () {
    /*Route::post('/search', [ApiSearchController::class, 'search']);
});*/
    Route::post('/broadcasting/auth', function (Request $request) {
        //return Broadcast::auth($request);
        Broadcast::routes();

    });
    Route::post('/private-chatify.{receiver_id}', function (Request $request, $receiver_id) {
        $user = $request->user();

    $channelData = [
        'id' => $user->id,
        'first_name' => $user->first_name,
    ];

    return response()->json([
        'auth' => "key:signature", // You should dynamically generate this
        'channel_data' => json_encode($channelData),
    ]);
    });

    Route::post('/send-message', [MessageController2::class, 'sendMessage']);
    Route::post('/send', [MessagesController::class, 'send']);
    //Route::post('/sendMessage', 'MessagesController@send')->name('api.send.message');

    Route::post('/search', [ApiSearchController::class, 'search']);
    Route::post('/upcomming', [ApiSearchController::class, 'upComming']);
    Route::post('/employee_detail', [ApiSearchController::class, 'employeeDetail']);
    Route::post('/getAssignments', [ApiSearchController::class, 'getAssignments']);

    

    Route::post('/objects', [ApiSearchController::class, 'mainObjects']);
    Route::post('/organization', [ApiSearchController::class, 'organization']);
    Route::post('/options', [ApiOptionsController::class, 'options']);
    Route::post('/optionsSave', [ApiOptionsController::class, 'optionsSave']);
    Route::post('/workDay', [ApiOptionsController::class, 'workDay']);
    Route::post('/sideObjects', [ApiObjectController::class, 'sideObjects']);
    Route::post('/orgCalendar', [ApiSearchController::class, 'searchORG']);
    Route::post('/offers', [ApiOffersController::class, 'getOffers']);
    Route::post('/getOffer', [ApiOffersController::class, 'updateOffer']);
    Route::post('/deleteOffer', [ApiOffersController::class, 'deleteOffer']);

    Route::post('/chatify_favorite', [MessagesController::class, 'getFavorites']);
    //Route::post('/chatify_favorite', [MessagesController::class, 'getFavorites']);
    Route::post('/chatify_contacts', [MessagesController::class, 'getContacts']);
    //Route::post('/chatify_messages', [MessagesController::class, 'customGetter']);
    Route::post('/chatify_messages', [MessagesController::class, 'getMessages']);
    Route::post('/chatify_messages2', [MessagesController::class, 'getMessages']);




    Route::post('/myShifts', [ApiMyShiftsController::class, 'myShifts']);



    Route::post('/attendanceConditions', [ApiAttendanceController::class, 'attendanceConditions']);
    Route::post('/confirmArrival', [ApiAttendanceController::class, 'confirmArrival']);
    Route::post('/confirmDeparture', [ApiAttendanceController::class, 'confirmDeparture']);


    Route::post('/pauseStart', [ApiAttendanceController::class, 'startBreak']);
    Route::post('/pauseEnd', [ApiAttendanceController::class, 'endBreak']);
    Route::post('/boardLoader', [ApiBoardController::class, 'boardLoader']);


    Route::post('/myStatsTable', [ApiStatisticsController::class, 'myStatsTable']);

    

    Route::post('/chatt', function (Request $request) {
        return Chatify::pusherAuth(
            Auth::user(),
            Auth::user(),
            $request->channel_name,
            $request->socket_id
        );
    });
});

/*Route::middleware('auth:sanctum')->post('/private-chatify/{receiver_id}', function (Request $request, $receiver_id) {
    return response()->json([
        'auth' => 'key:signature',
        'channel_data' => json_encode([
            'user_id' => $request->user()->id,
            'receiver_id' => $receiver_id,
        ]),
    ]);
});*/

//getContacts
?>