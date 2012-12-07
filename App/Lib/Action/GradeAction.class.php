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

        $items = $item->distinct('title')->where('level=2')->order('title')->select();
        $this->assign('items', $items);

        $grades = $grade->select();
        $this->assign('grades', $grades);

        $ids = $grade->distinct('studentid')->order('studentid')->select();
        $this->assign("ids", $ids);


        foreach ($ids as $id) {
            $score[$id['studentid']] = $grade->where(array('studentid' => $id['studentid']))->order('itemid asc')->select();
        }
        $this->assign("score", $score);


        $this->display();
    }

}
