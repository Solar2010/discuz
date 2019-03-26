<?php
namespace app\index\controller;

use think\captcha\Captcha;
use think\Controller;
use think\Db;
use think\Exception;
use think\Log;

class Index extends Controller
{
    public function index()
    {

        return view();
    }

    public function login()
    {
        return view();
    }

    /**
     * 注册
     * @author Ian
     * @desc
     * @params
     * @return
     * @return \think\response\View
     */
    public function register()
    {
        if(request() -> isPost()) {
            //验证码验证
            $verify = input('post.verify');
            $captcha = new Captcha();
            var_dump($captcha -> check($verify,'register'));die;
            if(!$captcha -> check($verify,'register')) {
                $this -> error("验证码错误");
            }
            //检测手机是否已经被注册
            $mobile = input('post.mobile');
            $mobileRes = db('user')
                -> where('mobile',$mobile)
                -> find();
            if(!empty($mobileRes)) {
                return $this -> error("该手机号已经被注册过");
            }
            //写入数据
            $data = [
                'nick_name' => input('post.nick_name'),
                'mobile' => input('post.mobile'),
                'password' => md5(input('post.password')),
                'reg_time' => time()
            ];

            $result = db('user') -> insert($data);

            if($result !== false) {
                 return $this -> success("注册成功",'Index/index');
            } else {
                return  $this -> error("网络异常");
            }

        }
        return view();
    }

    /**
     * 验证码
     * @author Ian
     * @desc
     * @params
     * @return
     * @return \think\Response
     */
    public function verify()
    {

        $verify = new Captcha();
        $verify -> imageH = 40;
        $verify -> imageW = 150;
        $verify -> useNoise = false;
        $verify -> useCurve = false;
        $verify -> fontSize = 18;
        $verify -> length = 4;
        return $verify -> entry('register');
    }
}
