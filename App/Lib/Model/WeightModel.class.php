<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-2
 * Time: 下午11:11
 * To change this template use File | Settings | File Templates.
 */
class WeightModel extends Model
{
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

    protected $_validate = array(
        array('fromid', 'require', '请输入From_id'),
        array('toid', 'require', '请输入To_id'),
        array('min', 'require', '请输入最小权值'),
        array('normal', 'require', '请输入最可能权值'),
        array('max', 'require', '请输入最大权值'),
        array('fromid,toid', 'checkIds', 'ID存在错误', Model::MUST_VALIDATE, 'callback'),
        array('min,normal,max', 'checkValues', '值存在错误', Model::MUST_VALIDATE, 'callback'),
    );

    public function checkItemid($id)
    {
        $item = D('Item');
        if ($item->find($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIds($data)
    {
        $fromid = $data['fromid'];
        $toid = $data['toid'];
        if ($this->checkItemid($fromid) && $this->checkItemid($toid)) {
            if ($fromid < $toid) {
                $model = D('Item');
                $from = $model->find($fromid);
                $to = $model->find($toid);
                if ($from['level'] == 1 && $to['level'] == 1) {
                    return true;
                } else if ($from['level'] == $to['level'] && $from['parentid'] == $to['parentid']) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkValues($data)
    {
        $min = $data['min'];
        $normal = $data['normal'];
        $max = $data['max'];

        if (is_numeric($min) && is_numeric($normal) && is_numeric($max)) {
            if ($min <= $normal && $normal <= $max) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}
