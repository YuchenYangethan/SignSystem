<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use think\Db;


$connection = new AMQPStreamConnection('localhost', 5672, 'ethanyang', 'ethanyang');
$channel = $connection->channel();

$queue_name = 'shop';

$channel->queue_declare($queue_name, false, false, false, false);


$callback = function ($msg) {
	$data = json_decode($msg->body,true);
    $mobile = $data['mobile'];
    $goods_id = $data['goods_id'];

    $con = mysqli_connect("localhost","phpdemo","4BpPGLJBRwEhxhTi","phpdemo");
    if (!$con) { 
        echo 数据库连接失败; 
    } 
    mysqli_query($con,'set names utf8');
    $sql = "INSERT INTO orders (mobile, goods_id)
        VALUES ('$mobile', '$goods_id')";
    $result = mysqli_query($con,$sql);
    if($result)
        echo 订单写入成功;
    else
        echo 订单写入失败;
    $sql = "update goods set num=num-1 where id = $goods_id";
    $result = mysqli_query($con,$sql);
    if($result)
        echo 商品修改成功;
    else
        echo 商品修改失败;
	$con->close();
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close ();
$connection->close ();