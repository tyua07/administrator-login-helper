<?php

namespace Yangyifan\Administrator\Login\Model;

use Yangyifan\Exception\InvalidArgumentException;
use Yangyifan\Model\WhereModelHelper;

class LoginModel extends BaseModel
{
    use WhereModelHelper;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_info';

    const USER_NAME_LOGIN       = 1; // user_name 登录
    const EMAIL_NAME_LOGIN      = 2; // email 登录
    const MOBILE_NAME_LOGIN     = 3; // 手机 登录
    const QQ_NAME_LOGIN         = 4; // qq 登录
    const WECHAT_NAME_LOGIN     = 5; // 微信登录

    /**
     * 处理登录
     *
     * @param $user_name
     * @param $password
     * @param $type
     * @return bool
     */
    public static function login($user_name, $password, $type = self::USER_NAME_LOGIN )
    {
        //设置map
        $map = static::getLoginMap($user_name, $type);


        $user = static::multiwhere($map)->first();

        if ( empty($user) || !password_verify($password, $user->password)) {
            throw new InvalidArgumentException('账户或者密码错误！');
        }

        if ( $user->status != 1 ) {
            throw new InvalidArgumentException('当前用户禁止登录！');
        }

        return true;
    }

    /**
     * 获得登录的查询条件
     *
     * @param string $user_name    登录名
     * @param string $type         类型
     * @return array
     */
    public static function getLoginMap($user_name, $type)
    {
        $map = [];
        
        switch ( $type ) {
            case self::USER_NAME_LOGIN:
                $map['user_name'] = $user_name;
                break;
            case self::EMAIL_NAME_LOGIN:
                $map['email'] = $user_name;
                break;
            case self::MOBILE_NAME_LOGIN:
                $map['mobile'] = $user_name;
                break;
            case self::QQ_NAME_LOGIN:
                $map['qq_open_id'] = $user_name;
                break;
            case self::WECHAT_NAME_LOGIN:
                $map['wechat_open_id'] = $user_name;
                break;
        }

        return $map;
    }
}
