<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-2
 * Time: 下午8:15
 * To change this template use File | Settings | File Templates.
 */
class StudentModel extends Model
{
    protected $_validate = array(
        array('id', 'require', '必须填写学号', Model::MUST_VALIDATE, '', Model::MODEL_INSERT), // 在新增的时候验证name字段是否唯一
        array('id', '', '该用户已存在', Model::MUST_VALIDATE, 'unique', Model::MODEL_INSERT),
        array('name', 'require', '必须填姓名', Model::MUST_VALIDATE, '', Model::MODEL_INSERT),
        array('class', 'require', '必须填班级', Model::MUST_VALIDATE, '', Model::MODEL_INSERT),
    );
}
