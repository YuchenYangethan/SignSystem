<?php

namespace app\user\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
		'mobile'=>'require|length:11|token',
		'password'=>'require'
	];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
		'mobile.require'=>'手机号必须输入',
		'mobile.length'=>'手机号必须11位',
		'password.require'=>'密码字段必须输入',
	];
}
