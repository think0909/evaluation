<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-2
 * Time: 下午8:09
 * To change this template use File | Settings | File Templates.
 */
class UserModel extends Model
{
    protected $_validate = array(
        array('username', '', '帐号名称已经存在！', Model::MUST_VALIDATE, 'unique', Model::MODEL_INSERT), // 在新增的时候验证name字段是否唯一
        array('repassword', 'password', '确认密码不正确', Model::VALUE_VALIDATE, 'confirm'), // 验证确认密码是否和密码一致
        array('username', '/^[A-Za-z0-9]+$/', '用户名不符合规则', Model::MUST_VALIDATE, 'regex'),
        array('password', 'require', '请输入密码', Model::MUST_VALIDATE, '', Model::MODEL_INSERT),
        array('auth', 'require', '请输入权限'),
    );
    protected $_auto = array(
        array('password', 'mkPass', Model::MODEL_BOTH, 'callback'),
    );

    public function mkPass($pass)
    {
        if (strlen($pass) != 32) {
            return md5($pass);
        } else {
            return $pass;
        }
    }

}
