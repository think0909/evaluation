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
    protected $_validate = array(
        array('fromid', 'require', '请输入From_id'),
        array('toid', 'require', '请输入To_id'),
        array('min', 'require', '请输入最小权值'),
        array('normal', 'require', '请输入最可能权值'),
        array('max', 'require', '请输入最大权值')
    );
}
