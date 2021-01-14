<?php

namespace app\user\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Cookie;

class Index extends Controller{

	private $memcache;

	public function logout(){
		session('mobile',null);
		session('token',null);
		setcookie("mobile",null);
        setcookie("token",null);
		$this->redirect('user/index/login');
	}

	public function login(Request $request){
	    $this->memcache = new \Memcache;
		$this->memcache->connect('127.0.0.1',11211);
		if(isset($_COOKIE['mobile']))
		    {
		        $mobile = $_COOKIE['mobile'];
		        $token = $_COOKIE['token'];
		        $res = Db::name('cookie')->where('mobile',$mobile)->find();
		        if($res){
		            if($res['token'] == $token )
		            {
		                session('mobile',$mobile);
		                $this->redirect('index/index/index');
		            }
		        }
		    }
		    
		if($request->isPost()){
            $data = $request->param();

            $validate = new \app\user\validate\User();

            if(!captcha_check($data['code'])){
            //验证失败
            return $this->error("验证码错误");
            };
            if(!$validate->check($data)){
                return $this->error($validate->getError());
            }
            $user['mobile'] = $request->param('mobile');
            $user['password'] = $request->param('password');
            $user['remember'] = $request->param('remember');


			if($password = $this->memcache->get($user['mobile'])){
				if($password==$user['password']){
					session('mobile',$user['mobile']);
                    $this->memcache->set($user['mobile'],$user['password'] ); 
                    if($user['remember'])
                    {
                        $token = md5($user['mobile'].$user['password']);
                        $res = Db::name('cookie')->where('mobile',$user['mobile'])->find();
                        if($res)
                        {
                            Db::table('cookie')->where('mobile',$user['mobile'])->update(['token'  => $token]);
                        }
                        else
                        {
                            $data = ['mobile' => $user['mobile'], 'token' => $token];
                            Db::table('cookie')->insert($data);
                        }
                        setcookie("mobile",$user['mobile'],time()+3600);
                        setcookie("token",$token,time()+3600);
                    }
					$this->redirect('index/index/index');
				}else{
					return $this->error('验证未通过，登陆失败');
				}
			}

			$res = Db::name('user')->where('mobile',$user['mobile'])->find();

			if($res){
				
				if($res['password']==$user['password'] ){
					 session('mobile',$user['mobile']);
                     $this->memcache->set($user['mobile'],$user['password'] );
                     if($user['remember'])
                    {
                        $token = md5($user['mobile'].$user['password']);
                        $res = Db::name('cookie')->where('mobile',$user['mobile'])->find();
                        if($res)
                        {
                            Db::table('cookie')->where('mobile',$user['mobile'])->update(['token'  => $token]);
                        }
                        else
                        {
                            $data = ['mobile' => $user['mobile'], 'token' => $token];
                            Db::table('cookie')->insert($data);
                        }
                        setcookie("mobile",$user['mobile'],time()+3600);
                        setcookie("token",$token,time()+3600);
                    }
                    
                     $this->redirect('index/index/index'); 
				}

			}else{
			    return $this->error('验证未通过，登陆失败');
			}


		}else{
			return view('login');
		}
	}

	public function register(Request $request){
		$this->memcache = new \Memcache;
		$this->memcache->connect('127.0.0.1',11211);
		if($request->isPost()){
			$data = $request->param();

			$validate = new \app\user\validate\User();
		    if(!captcha_check($data['code'])){
            //验证失败
            return $this->error("验证码错误");
            };
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}		
			
			$user['mobile'] = $request->param('mobile');
			$user['username'] = $request->param('username');
			$user['password'] = $request->param('password');
			$user['stu_name'] = $request->param('stu_name');
			$user['stu_id'] = $request->param('stu_id');
	
			$ret = Db::name('user')->where('mobile',$user['mobile'])->find();
			
			if($ret){
				return $this->error('用户已经存在');
			}
			
			$ret = Db::name('user')->where('studentid',$user['stu_id'])->find();
			
			if($ret){
				return $this->error('用户已经存在');
			}
			
			$ret = Db::name('stulist')->where('stu_id',$user['stu_id'])->find();
			if($ret){
			    if($ret['stu_name']==$user['stu_name'] ){
			        if($ret['enroll']!= '2020')
			        {
			            //return $this->error(base64_decode($ret['stu_name']));
			            return $this->error('身份验证未通过，注册失败');
			        }
			        $data = ['mobile' => $user['mobile'], 'password' => $user['password'],'username' => $user['username'],'studentid' => $user['stu_id']];
			        Db::table('user')->insert($data);
			        session('mobile',$user['mobile']);
			        $this->memcache->set($user['mobile'],$user['password'] );
			        $this->redirect('index/index/index');
				}
				else
				{
			        return $this->error('身份验证未通过，注册失败');
			    }
		    }
		    else
		    {
			    return $this->error('身份验证未通过，注册失败');
			}
		}else{
			return view('register');
		}
	}
}
