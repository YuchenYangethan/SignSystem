<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Set extends Common
{
    /**
     * 登入
     */
    public function password()
    {
        return $this->fetch('password');
    }

    public function passwordchange() {
        
        //验证密码流程
        $username = session('user_name');
        $pre_password = input('pre_password');
        $password = input('password');
        
        $info = db('admin')->field('username,password')->where('username', $username)->where('password', $pre_password)->find();
        if (!$info) {
            $this->error('验证失败，修改失败', 'Set/password');
        } else {
                Db::name('admin')->where('username', $username)->update(['password' => $password]);
                $this->success('密码修改成功', 'Set/password');
        }
    }
    
}    