<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Stulist extends Common
{
    public function info()
    {
        $where = array();
        $lists = db('stulist')->alias('s')->join('user u','s.stu_id=u.studentid','left')->select();
        for ($i = 0;$i<sizeof($lists);$i++)
        {
            $lists[$i]['stu_name'] = base64_decode($lists[$i]['stu_name']);
            $lists[$i]['username'] = base64_decode($lists[$i]['username']);
        }
        $this->assign('lists', $lists);
        return $this->fetch('info');
    }
    
    public function add()
    {
        return $this->fetch('add');
    }
    
    public function addstulist()
    {
        $stu_name = input('stu_name');
        $stu_id = input('stu_id');
        $enroll = input('enroll');
        $stu_name = base64_encode($stu_name);
        $ret = Db::name('stulist')->where('stu_id',$stu_id)->find();
		if($ret){
			return $this->error('添加失败，该学号已经存在');
		}
		$data = ['stu_name' => $stu_name, 'stu_id' => $stu_id, 'enroll' => $enroll];
        Db::table('stulist')->insert($data);
        return $this->success('添加成功');
    }

    public function edit()
    {
        return $this->fetch('edit');
    }
    
    public function editstulist()
    {
        $stu_id = input('stu_id');
        $enroll = input('enroll');
        $ret = Db::name('stulist')->where('stu_id',$stu_id)->find();
		if(!$ret){
			return $this->error('修改失败，该学生不存在');
		}
		Db::table('stulist')->where('stu_id', $stu_id)->update(['enroll' => $enroll]);
        return $this->success('修改成功');
    }
    
    public function del()
    {
        return $this->fetch('del');
    }
    
    public function delstulist()
    {
        $stu_id = input('stu_id');
        $ret = Db::name('stulist')->where('stu_id',$stu_id)->find();
		if(!$ret){
			return $this->error('删除失败，用户验证未通过');
		}
		Db::table('stulist')->where('stu_id', $stu_id)->delete();
        return $this->success('删除成功');
    }
}
