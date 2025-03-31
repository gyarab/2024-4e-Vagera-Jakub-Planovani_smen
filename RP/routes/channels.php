<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('private-chatify.{senderId}', function ($user, $senderId) {
    //return (int)$user->id === (int)$senderId ;
    return [
        'id' => $user->id,
        'first_name' => $user->first_name,
    ];
    //return Auth::check();
});
Broadcast::channel('chatify.{receiver_id}', function ($user, $receiver_id) {
    return (int) $user->id === (int) $receiver_id;
});