<?php

namespace Yangyifan\Administrator\Login\Controller;

use Yangyifan\Controller\BaseController;
use Illuminate\Http\Request;
use Yangyifan\Administrator\Login\Model\LoginModel;
use Yangyifan\Response\ResponseHelper;
use Yangyifan\Response\CodeHelp;
use Yangyifan\Exception\InvalidArgumentException;
use Yangyifan\Administrator\Login\Requests\LoginRequest;

class LoginController extends BaseController
{
    /**
     * 构造方法
     *
     * @description 方法说明
     * @author @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获得当前模型
     *
     * @return LoginModel
     */
    public function getModel()
    {
        return new LoginModel();
    }

    /**
     * 处理登录
     *
     * @param Request $request
     */
    public function login(LoginRequest $request)
    {
        try {
            $status = $this->getModel()->login($request->user_name, $request->password);

            return $status == true
                ? (new ResponseHelper($code = CodeHelp::SUCCESS, $msg = '登录成功',  $data = []))->json()
                : (new ResponseHelper($code = CodeHelp::UN_AUTHORIZED, $msg = '登录失败',  $data = []))->json();
        } catch (InvalidArgumentException $e) {
            return (new ResponseHelper($code = $e->getCode(), $msg = $e->getMessage(),  $data = []))->json();
        }
    }
}
