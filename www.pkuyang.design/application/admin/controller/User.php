<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class User extends Common
{

    public function info()
    {
        $where = array();
        $lists = Db::table('admin')->where($where)->select();
        for ($i = 0;$i<sizeof($lists);$i++)
        {
            $lists[$i]['mobile'] = base64_decode($lists[$i]['mobile']);
            $lists[$i]['realname'] = base64_decode($lists[$i]['realname']);
        }
        $this->assign('lists', $lists);
        return $this->fetch('info');
    }
    
    public function add()
    {
        return $this->fetch('add');
    }
    
    public function adduser()
    {
        $username = input('username');
        $realname = input('realname');
        $password = input('password');
        $mobile = input('mobile');
        $role = input('role');
        $realname = base64_encode($realname);
        $mobile = base64_encode($mobile);
        if(($role!=1)&&($role!=2)&&($role!=3))
        {
            return $this->error('添加失败，权限不合法');
        }
        $ret = Db::name('admin')->where('username',$username)->find();
		if($ret){
			return $this->error('添加失败，该用户已经存在');
		}
        $data = ['username' => $username, 'realname' => $realname, 'status' => 1, 'mobile' => $mobile, 'password' => $password];
        Db::table('admin')->insert($data);
        $ret = Db::name('admin')->where('username',$username)->find();
        $data = ['uid' => $ret['id'], 'group_id' => $role];
        Db::table('admin_group_access')->insert($data);
        return $this->success('添加成功');
    }

    public function edit()
    {
        return $this->fetch('edit');
    }
    
    public function edituser()
    {
        $username = input('username');
        $realname = input('realname');
        $password = input('password');
        $mobile = input('mobile');
        $role = input('role');
        $realname = base64_encode($realname);
        $mobile = base64_encode($mobile);
        if(($role!=1)&&($role!=2)&&($role!=3))
        {
            return $this->error('修改失败，权限不合法');
        }
        $ret = Db::name('admin')->where('username',$username)->find();
		if(!$ret){
			return $this->error('修改失败，该用户不存在');
		}
		Db::table('admin')->where('username', $username)->update(['password' => $password, 'mobile' => $mobile, 'realname' => $realname]);
        $ret = Db::name('admin')->where('username',$username)->find();
        Db::table('admin_group_access')->where('uid', $ret['id'])->update(['group_id' => $role]);
        return $this->success('修改成功');
    }
    
    public function del()
    {
        return $this->fetch('del');
    }
    
    public function deluser()
    {
        $username = input('username');
        $password = input('password');
        $ret = Db::name('admin')->where('username',$username)->find();
		if(!$ret){
			return $this->error('删除失败，用户验证未通过');
		}
		if($ret['password']!=$password){
			return $this->error('删除失败，用户验证未通过');
		}
		Db::table('admin_group_access')->where('uid', $ret['id'])->delete();
		Db::table('admin')->where('username',$username)->delete();
        return $this->success('删除成功');
    }
    
    
}
