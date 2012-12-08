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

        $items1 = $item->distinct(true)->field('title')->where('level=1')->order('title')->select();
        $this->assign('items1', $items1);


        $itemids1 = $item->distinct(true)->field('id')->where('level=1')->order('id asc')->select();
        foreach ($itemids1 as $itemid1) {
            $id1[] = $itemid1['id'];
        }

        $ids = $grade->distinct(true)->field('studentid')->order('studentid')->select();
        $this->assign("ids", $ids);

        foreach ($ids as $id) {
            $score1[$id[studentid]] = $grade->where(array('studentid' => $id[studentid], 'itemid' => array('in', $id1)))->order('itemid asc')->select();
        }
        $this->assign("score1", $score1);

        $this->display();
    }

    public function detail()
    {
        $grade = D("Grade");
        $item = D("Item");
        $items2 = $item->distinct(true)->field('title,id')->where('level=2')->order('id')->select();
        $this->assign('items2', $items2);

        $itemids2 = $item->distinct(true)->field('id')->where('level=2')->order('id asc')->select();
        foreach ($itemids2 as $itemid2) {
            $id2[] = $itemid2['id'];
        }
        $stu_id = $this->_get('id');
        $this->assign("stu_id", $stu_id);

        $score2 = $grade->where(array('studentid' => $stu_id, 'itemid' => array('in', $id2)))->order('itemid asc')->select();
        $this->assign("score2", $score2);
        $this->display();
    }
}
