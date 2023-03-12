<?php

use Pusher\Pusher;

if(!function_exists("notify")){
    function notify($channel, $event, $data){
        //notification
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_ID'),
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            $options
        );
    }
}
