<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use think\Db;

	$connection = new AMQPStreamConnection('172.81.214.81', 5672, 'ethanyang', 'ethanyang');
    $channel = $connection->channel();

	$queue_name = 'shop';
	
	$channel->queue_declare($queue_name, false, false, false, false);
		
	$callback = function ($msg) {
        echo $msg->body, "\n";
    };

	$channel->basic_consume($queue_name, '', false, true, false, false, $callback);
		
	while ($channel->is_consuming()) {
		   $channel->wait();
	}
		
	$channel->close ();
	$connection->close ();

