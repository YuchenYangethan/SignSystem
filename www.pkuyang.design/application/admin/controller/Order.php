<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Order extends Common
{
    /**
     * 登入
     */
    public function order()
    {
        $lists = db('orders')->alias('o')->join('user u','o.mobile=u.mobile','left')->join('goods g','o.goods_id=g.id')->join('stulist s','s.stu_id=u.studentid')->select();
        for ($i = 0;$i<sizeof($lists);$i++)
        {
            $lists[$i]['username'] = base64_decode($lists[$i]['username']);
            $lists[$i]['stu_name'] = base64_decode($lists[$i]['stu_name']);
        }
        $this->assign('lists', $lists);
        return $this->fetch('order');
    }
    
    public function list()
    {
        return $this->fetch('list');
    }
    
    public function idlist()
    {
        $id = input('id');
        $ret = Db::name('goods')->where('id',$id)->find();
		if(!$ret){
			return $this->error('输入活动id不合法');
		}
        
        $lists = db('orders')->alias('o')->join('user u','o.mobile=u.mobile','left')->join('goods g','o.goods_id=g.id')->join('stulist s','s.stu_id=u.studentid')->where('goods_id', $id)->select();
        for ($i = 0;$i<sizeof($lists);$i++)
        {
            $lists[$i]['username'] = base64_decode($lists[$i]['username']);
            $lists[$i]['stu_name'] = base64_decode($lists[$i]['stu_name']);
        }
        $this->assign('lists', $lists);
        return $this->fetch('idlist');
    }

}
