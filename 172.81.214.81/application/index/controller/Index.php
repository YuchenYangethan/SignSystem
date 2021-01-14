<?php

namespace app\index\controller;

require_once __DIR__ . '/vendor/autoload.php';

use think\Request;
use think\Controller;
use think\Db;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class Index extends Controller{
	protected $start_time;
	private $redis;

    public function index()
    {
        $this->redis = new \Redis();
		$this->redis->connect('127.0.0.1',6379);
		return view('index');
    }
	public function getTime(){
		if(!session('mobile')){
			return json(['status'=>'fail','msg'=>'先去登录']);;
		}
		$start_time = Db::name('goods')->where('id',1)->value('time');
		$time = $start_time-time();
		return json(['time'=>$time]);	
	}


	public function getPath(Request  $request){
	    $this->redis = new \Redis();
		$this->redis->connect('127.0.0.1',6379);
		if(!session('mobile')){
            return json(['status'=>'fail','msg'=>'先去登录']);
        }
		$now_time = time();
		if($now_time<$this->start_time){
			return json(['status'=>'fail','msg'=>'报名还没有开始']);
		}

 		$ip = $request->server()["REMOTE_ADDR"];
	
		if($this->redis->exists($ip)){
			if($this->redis->get($ip)>2){
				return json(['status'=>'fail','msg'=>'ip请求过多']);
			}			
			$this->redis->incr($ip);
		}else{		
			$this->redis->set($ip,1);		
 		}
		$url = md5(session('mobile').$request->param('id'));
		
		$this->redis->set($url,1);  //1 为未访问  0访问 	
		// 这个地方 把地址 存到redis
		return json(['status'=>'success','url'=>$url]);	
	}

	public function order(Request $request){
	    $this->redis = new \Redis();
		$this->redis->connect('127.0.0.1',6379);
		$url = $request->param('url');//+是否已经秒杀过了
		$id = $request->param('id');//+id商品是否存在
		
		if(!$this->redis->exists($url)){
			return json(['status'=>'fail','msg'=>'请求地址不合法']);
		}
		
		if(!$this->redis->get($url)){
			return json(['status'=>'fail','msg'=>'报名已经参加过了吧']);
		}		
		$this->redis->set($url,0);


        $mobile = base64_encode(session('mobile'));
        $mobile = base64_decode($mobile);
		

		//  数据库处理方式
		/**
		 * try{	
			Db::startTrans();
			
//          $ticket = Db::name('goods')->where('id',$id)->find();
// 			if(!$ticket){
// 			    return json(['status'=>'fail','msg'=>'报名失败']);
// 			} 
            
			$res = Db::name('goods')->where('id',$id)->setDec('num');
			$num = Db::name('goods')->where('id',$id)->value('num'); 		
	
			if($num<0){
				return json(['status'=>'fail','msg'=>'报名失败']);
			}
			
			//$res = Db::name('goods')->where('id',$id)->setDec('num');		
			// $res = Db::name('orders')->insert(['mobile'=>$mobile,'goods_id'=>$id]);
		
			//$res = Db::name('goods')->where('id',$id)->setDec('num');
	
			if($res){
			    
			 //   $order = Db::name('orders')->where('mobile',base64_decode($mobile))->find();
			 //   if($order){
			 //       return json(['status'=>'fail','msg'=>'报名失败,每名用户只能报名一次']);
			 //   }
			    
			    
			  //  Db::name('goods')->where('id',$id)->setDec('num');		
				Db::name('orders')->insert(['mobile'=>$mobile,'goods_id'=>$id]);
				Db::commit();
				return json(['status'=>'success','msg'=>'报名成功']);
			}
	
		}catch(\Exception $e){
			Db::rollback();
		}
		
		**/

		$goods_id = $this->redis->lpop(1);
		
		if($goods_id){
			$this->redis->lpush('orders',$mobile.'=='.$goods_id);
 			$this->sendOrder(json_encode(['mobile'=>$mobile,'goods_id'=>$goods_id]));
				
			return json(['status'=>'success','msg'=>'报名成功']);
		}else{
			return json(['status'=>'fail','msg'=>'报名失败']);
		}
		
	}	

	public function sendOrder($data){
		$connection = new AMQPStreamConnection('localhost', 5672, 'ethanyang', 'ethanyang');
		$channel = $connection->channel();
		$queue_name = 'shop';
		
		$channel->queue_declare($queue_name, false, false, false, false);
		
		$msg = new AMQPMessage($data);
		$channel->basic_publish($msg,'',$queue_name);
		
		
		$channel->close();
		$connection->close();		
	}

}
