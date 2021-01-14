<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Item extends Common
{
    private $redis;
    
    public function info()
    {
        $where = array();
        $lists = Db::table('goods')->where($where)->paginate(10);
        // 获取分页显示
        $page = $lists->render();
        // 模板变量赋值
        $this->assign('lists', $lists);
        $this->assign('page', $page);
        return $this->fetch('info');
    }
    
    public function add()
    {
        return $this->fetch('add');
    }
    
    public function additem()
    {
        $name = input('name');
        $id = input('id');
        $time = input('time');
        $number = input('number');
        $num = input('num');
        $time = strtotime($time);
        $ret = Db::name('goods')->where('id',$id)->find();
		if($ret){
			return $this->error('添加失败，该活动id已经存在');
		}
		$data = ['id' => $id, 'name' => $name, 'time' => $time, 'num' => $num, 'number' => $number];
        Db::table('goods')->insert($data);
        return $this->success('添加成功');
    }

    public function edit()
    {
        return $this->fetch('edit');
    }
    
    public function edititem()
    {
        $name = input('name');
        $id = input('id');
        $time = input('time');
        $number = input('number');
        $num = input('num');
        $time = strtotime($time);
        $ret = Db::name('goods')->where('id',$id)->find();
		if(!$ret){
			return $this->error('修改失败，该活动id不存在');
		}
		Db::table('goods')->where('id', $id)->update(['name' => $name, 'time' => $time, 'num' => $num, 'number' => $number]);
        return $this->success('修改成功');
    }
    
    public function del()
    {
        return $this->fetch('del');
    }
    
    
    public function delitem()
    {
        $id = input('id');
        $ret = Db::name('goods')->where('id',$id)->find();
		if(!$ret){
			return $this->error('删除失败，该活动id不存在');
		}
		Db::table('goods')->where('id',$id)->delete();
        return $this->success('删除成功');
    }
    
    public function redis()
    {
        return $this->fetch('redis');
    }
    
    public function addredis()
    {
        $id = input('id');
        $ret = Db::name('goods')->where('id',$id)->find();
		if(!$ret){
			return $this->error('写入失败，输入活动id不合法');
		}
		$num = $ret['num'];
	    $this->redis = new \Redis();
		$this->redis->connect('127.0.0.1',6379);
		for($i=0;$i<$num;$i++)
		{
		    $this->redis->lpush($id,$id);
		}
		return $this->success('写入成功','redis');
    }
}
