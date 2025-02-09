<?php
use Illuminate\Http\Request;
use App\Models\ChMessage;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->post('/send-message', function (Request $request) {
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
});

?>