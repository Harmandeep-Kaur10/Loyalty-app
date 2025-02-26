<?php

use \PhpAmqpLib\Connection\AMQPStreamConnection;
use \PhpAmqpLib\Message\AMQPMessage;

// connection ek he baar bnao, message kitne b bhejo
// ye function connection bna k uska object return krega
function _rabbit_make_connection(){
	$host=env('RABBIT_HOST');
	$port=env('RABBIT_PORT');
	$username=env('RABBIT_USERNAME');
	$passw=env('RABBIT_PASSWORD');
	$connection = new AMQPStreamConnection($host, $port, $username, $passw);
	$channel = $connection->channel();
	return ['channel'=>$channel, 'connection'=>$connection];
}


// php artisan rabbit:consume {queue_name}
// ye cmd as a daemon run hoga, queue:work jese
function _rabbit_consume($queue_name){
	$rc = _rabbit_make_connection();
	$channel = $rc['channel'];
	$channel->queue_declare($queue_name, false, true, false, false);
	// 4th true se ack auto krdi hai, recieve hote he ack krdega
	// jada safety k liye message process krne k baad ack bhej skte hai explicitly
	$callback = rabbit_consume_queue_fxn_map($queue_name);
	$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

	try {
		$channel->consume();
	} catch (\Throwable $exception) {
		echo $exception->getMessage();
	}
}

// konsi queue k msg pe kya function run krna hume
// job b shor skte sida fxn b chala skte
function rabbit_consume_queue_fxn_map($queue_name){
	// kisi queue ka special callback if lga k set krskte
	if ($queue_name == 'yo'){
		$callback = function ($msg) {
			$queue_name = $msg->delivery_info['routing_key'];
			//dump("[x] if yo callback | Received Message | Queue: $queue_name | Message: $msg->body");
			Log::info("[Received Message][Queue: $queue_name] $msg->body");
		};
		return $callback;
	}

	// default callback
	$callback = function ($msg) {
		//dump("[Received Message] Default callback | Message: $msg->body");
		Log::info("[Received Message] Default callback | Message: $msg->body");
	};
	return $callback;
}

