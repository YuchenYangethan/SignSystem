<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Log extends Common
{

    public function log()
    {
        $where = array();
        $lists = Db::table('admin_log')->where($where)->paginate(10);
        // 获取分页显示
        $page = $lists->render();
        // 模板变量赋值
        $this->assign('lists', $lists);
        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch('log');
        
    //    $lists=Db::table('admin_log')->paginate(10);
     //   $this->assign('lists',$lists);
        // $lists = db("admin_log")->where($where)->select();
        // $this->assign('lists', $lists);
        // return $this->fetch('log');
    }
}
