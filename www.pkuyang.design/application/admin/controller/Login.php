<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Cookie;
use think\Db;

class Login extends Controller
{

    /**
     * 登入
     */
    public function index()
    {
        if(isset($_COOKIE['username'])){
            $username = $_COOKIE['username'];
            $token = $_COOKIE['token'];
            $user_id = $_COOKIE['user_id'];
            $group_id = $_COOKIE['group_id'];
            $info = db('www_cookie')->field('username,token')->where('username', $username)->where('token', $token)->find();
            if ($info) {
                $admin = model('Admin');
                $info = $admin->getInfoByUsername($username);
                session('user_name', $username);
                session('user_id', $info['id']);
                session('group_id', $admin->getUserGroups($info['id']));
                $admin->editInfo($info['id']);
            //    session('action', $action);
                $this->success('欢迎您回来', 'index/index');
            }
        }
        $this->view->engine->layout(false);
        return $this->fetch();
    }


    /**
     * 处理登录请求
     */
    public function dologin(Request $request)
    {
        if($request->isPost()){
            $data = $request->param();
            $validate = new \app\admin\validate\Admin();
            if(!captcha_check($data['code'])){
                //验证失败
                return $this->error("验证码错误");
            };
            if(!$validate->check($data)){
                return $this->error($validate->getError());
            }
            $username = $request->param('username');
            $password = $request->param('password');
            $remember = $request->param('remember');
          
            $admin = model('Admin');
            $info = $admin->getInfoByUsername($username);
            if (!$info) {
                $this->error('错误，登录信息不正确');
            }
            if ($password != $info['password']) {
                $this->error('错误，登录信息不正确');
            } else {
                if($remember)
                    {
                        $token = md5($username.$password);
                        $res = Db::name('www_cookie')->where('username',$username)->find();
                        if($res)
                        {
                            Db::table('www_cookie')->where('username',$username)->update(['token'  => $token]);
                        }
                        else
                        {
                            $data = ['username' => $username, 'token' => $token];
                            Db::table('www_cookie')->insert($data);
                        }
                        setcookie("username",$username,time()+3600);
                        setcookie("token",$token,time()+3600);
                        setcookie("user_id",$info['id'],time()+3600);
                        setcookie("group_id",$admin->getUserGroups($info['id']),time()+3600);
                    }
                session('user_name', $info['username']);
                session('user_id', $info['id']);
                session('group_id', $admin->getUserGroups($info['id']));
                //记录登录信息
                $admin->editInfo($info['id']);
                $this->success('登入成功', 'index/index');
            }
        }
    }

    /**
     * 登出
     */
    public function logout()
    {
        session('user_name', null);
        session('user_id', null);
        session('group_id', null);
        setcookie("username",null);
        setcookie("token",null);
        setcookie("user_id",null);
        setcookie("group_id",null);
        $this->success('退出成功', 'login/index');
    }

}
