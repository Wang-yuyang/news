<?php
namespace app\admin\validate;
use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        'names' => 'require',
        'password' => 'require',
        'captcha' => 'require|checkCaptcha',
    ];
    protected $message = [
        'names' => '用户名不能为空,重新输入',
        'password' => '密码不能为空,重新输入',
        'captcha' => '验证码不能为空,重新输入',
    ];

    // 自定义验证规则
    protected function checkCaptcha($value, $rule, $data = [])
    {
        if (!captcha_check($value)) {
            return "输入的验证码不正确,请重新输入.";
        }
        return true;
    }
}