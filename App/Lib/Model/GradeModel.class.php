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
        array('itemid', 'require', '请输入项目编号'),
        array('studentid', 'require', '请输入学号'),
        array('itemid', 'checkItemid', '项目不存在', Model::MUST_VALIDATE, 'callback'),
        array('studentid', 'checkStudentid', '学号不存在', Model::MUST_VALIDATE, 'callback'),
        array('itemid,point', 'checkPoint', '分数不合法', Model::MUST_VALIDATE, 'callback'),
    );

    public function checkItemid($id)
    {
        $model = D('Item');
        return $model->find($id) ? TRUE : FALSE;
    }

    public function checkStudentid($id)
    {
        $model = D('Student');
        return $model->find($id) ? TRUE : FALSE;
    }

    public function checkPoint($data)
    {
        $itemid = $data['itemid'];
        $point = $data['point'];
        $model = D('Item');
        if ($item = $model->find($itemid)) {
            if ($item['full'] >= $point && $point >= 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
