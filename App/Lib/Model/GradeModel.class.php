<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-2
 * Time: 下午11:11
 * To change this template use File | Settings | File Templates.
 */
class GradeModel extends Model
{
    protected $_validate = array(
        array('itemid','require','请输入项目编号'),
        array('studentid','require','请输入学号'),

    );

}
