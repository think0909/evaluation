<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-3
 * Time: 下午9:51
 * To change this template use File | Settings | File Templates.
 */
class ItemAction extends Action
{
    public function manage()
    {
        $model = D('Item');

        $level1 = $model->where(array('level' => 1))->order('id asc')->select();

        $level2 = array();
        foreach ($level1 as $item) {
            $temp = $model->where(array('level' => 2, 'parentid' => $item['id']))->order('id asc')->select();
            $level2[] = array('title' => $item['title'], 'data' => $temp);
        }

        $this->assign('level1', $level1);
        $this->assign('level2', $level2);

        $this->display();
    }

    public function weight()
    {
        $model = D('Item');

        $level1 = $model->where(array('level' => 1))->order('id asc')->select();
        $this->assign('level1', $level1);
        $this->assign('level1Matrix', $this->getItemMatrix($level1));

        $level2 = array();
        foreach ($level1 as $item) {
            $items = $model->where(array('level' => 2, 'parentid' => $item['id']))->order('id asc')->select();
            $matrix = $this->getItemMatrix($items);
            $level2[] = array('title' => $item['title'], 'level' => $items, 'matrix' => $matrix);
        }
        $this->assign('level2', $level2);

        $this->display();
    }


    public function getItemMatrix($searchResult)
    {
        $result = array();
        foreach ($searchResult as $item) {
            $data = array('id' => $item['id'], 'title' => $item['title']);
            $temp = array();
            foreach ($searchResult as $item1) {
                $temp1 = $this->getWeightItem($item['id'], $item1['id']);
                $temp1['fromid'] = $item['id'];
                $temp1['toid'] = $item1['id'];
                $temp[] = $temp1;
            }
            $data['data'] = $temp;
            $result[] = $data;
        }
        return $result;
    }

    public function getWeightItem($from, $to)
    {
        if ($from < $to) {
            $model = D('Weight');
            $data = $model->where(array('fromid' => $from, 'toid' => $to))->find();
            if ($data) {
                return array('max' => $data['max'], 'min' => $data['min'], 'normal' => $data['normal']);
            } else {
                return array('max' => 1, 'min' => 1, 'normal' => 1);
            }

        } else if ($from == $to) {
            return array('max' => 1, 'min' => 1, 'normal' => 1);
        } else {
            //$from > $to
            $temp = $this->getWeightItem($to, $from);
            return array('max' => (1 / $temp['min']), 'min' => (1 / $temp['max']), 'normal' => (1 / $temp['normal']));
        }
    }

    //删除项目
    public function delete()
    {
        $id = $this->_get('id');
        if ($id && is_numeric($id)) {
            $model = D('Item');
            if ($item = $model->find($id)) {
                if ($item['level'] == 2) {
                    if ($model->where(array('id' => $item['id']))->delete()) {
                        $this->success('删除成功', U('Item/manage'));
                    } else {
                        $this->error('删除失败' . $model->getDbError(), U('Item/manage'));
                    }

                } else if ($item['level'] == 1) {
                    if ($model->where(array('parentid' => $item['id']))->count() > 0) {
                        $this->error('删除失败！该项目下仍有二级项目！', U('Item/manage'));
                    } else {
                        if ($model->where(array('id' => $item['id']))->delete()) {
                            $this->success('删除成功', U('Item/manage'));
                        } else {
                            $this->error('删除失败' . $model->getDbError(), U('Item/manage'));
                        }
                    }
                } else {
                    $this->error('删除失败！未知错误', U('Item/manage'));
                }
            } else {
                $this->error('删除失败！ID不存在', U('Item/manage'));
            }
        } else {
            $this->error('删除失败！ID非法', U('Item/manage'));
        }

    }

    public function editWeight()
    {
        $model = D('Weight');
        if ($model->create()) {
            $weight = M('Weight');
            $condition = array('fromid' => $model->fromid, 'toid' => $model->toid);
            if ($weight->where($condition)->find()) {
                $weight->where($condition)->delete();
            }

            if ($model->add()) {
                $this->success('编辑成功！', U('Item/weight'));
                $this->calculate(false);
            } else {
                $this->error('编辑失败！' . $model->getDbError(), U('Item/weight'));
            }
        } else {
            $this->error('编辑失败！' . $model->getError(), U('Item/weight'));
        }
    }

    public function calculate($redirect = true)
    {
        //TODO:计算权重

        if ($redirect) {
            $this->success('计算完毕', U('Item/manage'));
        }
    }

    public function add()
    {
        $data = array();

        $data['title'] = $this->_post('title');
        $data['description'] = $this->_post('description');
        $data['full'] = $this->_post('full');
        $data['parentid'] = $this->_post('parentid');
        $data['level'] = ($data['parentid'] == 0) ? 1 : 2;

        $model = D('Item');

        if ($model->create($data)) {
            if ($model->add()) {
                $this->success('添加成功！', U('Item/manage'));
            } else {
                $this->error('添加失败！' . $model->getDbError(), U('Item/manage'));
            }
        } else {
            $this->error('添加失败！' . $model->getError(), U('Item/manage'));
        }
    }

    public function edit()
    {
        $data = array();

        $data['id'] = $this->_post('id');
        $data['title'] = $this->_post('title');
        $data['description'] = $this->_post('description');
        $data['full'] = $this->_post('full');
        $data['parentid'] = $this->_post('parentid');
        $data['level'] = ($data['parentid'] == 0) ? 1 : 2;

        $model = D('Item');

        if (!$data['id']) {
            $this->error('编辑失败！ID不存在', U('Item/manage'));
        }

        if ($model->create($data)) {
            if ($model->save()) {
                $this->success('编辑成功！', U('Item/manage'));
            } else {
                $this->error('编辑失败！' . $model->getDbError(), U('Item/manage'));
            }
        } else {
            $this->error('编辑失败！' . $model->getError(), U('Item/manage'));
        }
    }

    public function compare($s1, $s2)
    {
        return ($s2['min'] - $s1['max']) / (($s1['normal'] - $s1['max']) - ($s2['normal'] - $s2['min']));
    }

    public function weightCalculate($s)
    {
        $length = count($s);
        for ($i = 0; $i < $length; $i++) {
            if (count($s[$i]['data']) != $length) return null;
        }
        $sums = array("max" => 0,
            "min" => 0,
            "normal" => 0
        );
        foreach ($sums as $key => $sum) {
            for ($i = 0; $i < $length; $i++) {
                $sum_row[$i][$key] = 0;
                for ($j = 0; $j < $length; $j++) {
                    $sum_row[$i][$key] += $s[$i]['data'][$j][$key];
                }
            }
        }
        for ($i = 0; $i < $length; $i++) {
            $sums['max'] += $sum_row[$i]['max'];
            $sums['min'] += $sum_row[$i]['min'];
            $sums['normal'] += $sum_row[$i]['normal'];
        }
        for ($i = 0; $i < $length; $i++) {
            $sum_row[$i]['normal'] = $sum_row[$i]['normal'] / $sums['normal'];
            $sum_row[$i]['max'] = $sum_row[$i]['max'] / $sums['min'];
            $sum_row[$i]['min'] = $sum_row[$i]['min'] / $sums['max'];
        }
        $sum_result = 0;
        for ($i = 0; $i < $length; $i++) {
            $result[$i]['id'] = $s[$i]['id'];
            $result[$i]['weight'] = 100;
            for ($j = 0; $j < $length; $j++) {
                if ($j == $i) continue;
                $s1 = $sum_row[$i];
                $s2 = $sum_row[$j];
                $temp = $this->compare($s1, $s2);
                $result[$i]['weight'] = ($temp < $result[$i]['weight']) ? $temp : $result[$i]['weight'];
            }
            $sum_result += $result[$i]['weight'];
        }
        for ($i = 0; $i < $length; $i++) {
            $result[$i]['weight'] /= $sum_result;
        }
        return $result;
    }

}

