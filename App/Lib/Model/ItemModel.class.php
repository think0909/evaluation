<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-2
 * Time: 下午11:11
 * To change this template use File | Settings | File Templates.
 */
class ItemModel extends Model
{
    protected $_validate = array(
        array('id', '', '该项目已存在', Model::MUST_VALIDATE, 'unique', Model::MODEL_INSERT),
        array('title', 'require', '必须填项目名称'),
        array('level', 'require', '必须填所属层次（1、2）'),
        array('parentid', 'require', '必须填所属项目'),
    );


    public function setTableName($name)
    {
        $this->trueTableName = $name;
        return $this;
    }

    public function getTableName()
    {
        if ($this->trueTableName) {
            return parent::getTableName();
        } else {
            $this->trueTableName = parent::getTableName() . '_' . C('SITE_current_storage');
            return $this->trueTableName;
        }
    }
}
