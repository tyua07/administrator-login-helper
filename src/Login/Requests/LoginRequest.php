<?php

// +----------------------------------------------------------------------
// | date: 2016-11-20
// +----------------------------------------------------------------------
// | LoginRequest.php: 后端登录表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Administrator\Login\Requests;

use Yangyifan\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{

	/**
	 * 验证错误规则
	 *
	 * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function rules(){
		return [
            'user_name'     => ['required'],
            'password'      => ['required', 'regex:[\S{6,}]'],
		];
	}

    /**
     * 验证错误提示
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function messages(){
        return [
            'user_name.required'    => '用户名不能为空',
            'password.required'     => '密码不能为空',
            'password.regex'        => '密码格式不正确',
        ];
    }



}
