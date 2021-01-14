<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Register extends Common
{
    public function info()
    {
        $where = array();
        $lists = Db::table('user')->where($where)->select();
        for ($i = 0;$i<sizeof($lists);$i++)
        {
            $lists[$i]['username'] = base64_decode($lists[$i]['username']);
        }
        $this->assign('lists', $lists);
        return $this->fetch('info');
    }
    
    public function add()
    {
        return $this->fetch('add');
    }

    public function addregister()
    {
        $username = input('username');
        $studentid = input('studentid');
        $password = input('password');
        $mobile = input('mobile');
        $username = base64_encode($username);
        $ret = Db::name('user')->where('mobile',$mobile)->find();
		if($ret){
			return $this->error('添加失败，该用户已经存在');
		}
		$ret = Db::name('user')->where('studentid',$studentid)->find();
		if($ret){
			return $this->error('添加失败，该用户已经存在');
		}
		$ret = Db::name('stulist')->where('stu_id',$studentid)->find();
		if(!$ret){
			return $this->error('添加失败，该用户未通过验证');
		}
        $data = ['username' => $username, 'mobile' => $mobile, 'studentid' => $studentid, 'mobile' => $mobile, 'password' => $password];
        Db::table('user')->insert($data);
        return $this->success('添加成功');
    }
    
    public function edit()
    {
        return $this->fetch('edit');
    }
    
    public function editregister()
    {
        $username = input('username');
        $password = input('password');
        $mobile = input('mobile');
        $username = base64_encode($username);
        $ret = Db::name('user')->where('mobile',$mobile)->find();
		if(!$ret){
			return $this->error('修改失败，该用户不存在');
		}
		Db::table('user')->where('mobile', $mobile)->update(['password' => $password, 'username' => $username]);
        return $this->success('修改成功');
    }
    
    public function del()
    {
        return $this->fetch('del');
    }
    
    public function delregister()
    {
        $mobile = input('mobile');
        $ret = Db::name('user')->where('mobile',$mobile)->find();
		if(!$ret){
			return $this->error('删除失败，用户验证未通过');
		}
		Db::table('user')->where('mobile',$mobile)->delete();
        return $this->success('删除成功');
    }
}
