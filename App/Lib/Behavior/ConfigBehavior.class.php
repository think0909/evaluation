<?php
/**
 * Created by JetBrains PhpStorm.
 * User: chengs
 * Date: 12-12-27
 * Time: 下午9:06
 * To change this template use File | Settings | File Templates.
 */
class ConfigBehavior extends Behavior
{
    public function run(&$params)
    {
        $model = D('Config');
        $arr = $model->select();
        foreach ($arr as $i) {
            C('SITE_' . $i['key'], $i['value']);
        }
    }
}
