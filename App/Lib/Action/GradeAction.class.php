<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-3
 * Time: 下午9:52
 * To change this template use File | Settings | File Templates.
 */
class GradeAction extends Action
{
    public function manage()
    {
        $grade = D("Grade");
        $item = D("Item");

        $items = $item->where('level = 2')->select('title');
        $data = $grade->select();
    }
}
