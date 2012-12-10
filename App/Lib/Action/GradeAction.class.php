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
        $student = D('Student');
        $items1 = $item->distinct(true)->field('title,id')->where('level=1')->order('id')->select();
        $this->assign('items1', $items1);
        /*
        foreach($ids as $stu_id){
            for($i=0;$i<count($items1);$i++) {
                $point[$stu_id['studentid']][]=0;
            }
        }
        */
        $students = $student->distinct(true)->field('id')->select();
        $this->assign("students", $students);
        $items = $item->distinct(true)->field('id')->select();
        foreach ($items as $s) {
            $set_item_id[] = $s['id'];
        }

        foreach ($students as $stu) {
            $grade_itemid = $grade->distinct(true)->field('itemid')->where(array('studentid' => $stu['id']))->select();
            foreach ($grade_itemid as $s) {
                $set_grade_itemid[$stu['id']][] = $s['itemid'];
            }
            foreach ($set_item_id as $s) {
                if (in_array($s, $set_grade_itemid[$stu['id']])) continue;
                else {
                    $data['studentid'] = $stu['id'];
                    $data['itemid'] = $s;
                    if ($grade->create($data)) {
                        if ($grade->add()) {
                            //  $this->success('成功添加！', U('Grade/manage'));
                        } else {
                            $this->error($grade->getDbError(), U('Grade/manage'));
                        }
                    } else {
                        $this->error($grade->getError(), U('Grade/manage'));
                    }
                }
            }
        }


        foreach ($students as $stu_id) {
            foreach ($items1 as $item1) {
                $temp = $item->where(array('parentid' => $item1['id']))->select();
                foreach ($temp as $s) {
                    $temp2[$item1['id']][] = $s['id'];
                }
                $sum_point[$stu_id['id']][$item1['id']] = 0;
                $point[$stu_id['id']][$item1['id']] = $grade->where(array('itemid' => array('in', $temp2[$item1['id']]), 'studentid' => $stu_id['id']))->select();
                if ($point[$stu_id['id']][$item1['id']] != false) {
                    foreach ($point[$stu_id['id']][$item1['id']] as $p_p) {
                        if ($p_p['point'] == null) continue;
                        $temp3 = $item->where(array('id' => $p_p['itemid']))->select();
                        $sum_point[$stu_id['id']][$item1['id']] = $sum_point[$stu_id['id']][$item1['id']] + $p_p['point'] * 100 * floatval($temp3[0]['weight']) / floatval($temp3[0]['full']);
                    }
                }
            }
        }

        $this->assign('sum_point', $sum_point);
        $this->display();
        //TODO 一级目录写入数据库
        /*
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

        */
    }

    public function detail()
    {
        $grade = D("Grade");
        $item = D("Item");
        $student = D('Student');
        $items2 = $item->distinct(true)->field('title,id')->where('level=2')->order('id')->select();
        $this->assign('items2', $items2);

        $itemids2 = $item->distinct(true)->field('id')->where('level=2')->order('id asc')->select();
        foreach ($itemids2 as $itemid2) {
            $id2[] = $itemid2['id'];
        }
        $stu_id = $this->_get('id');
        $stu_info = $student->where(array('id' => $stu_id))->select();

        $this->assign("stu_info", $stu_info);

        $score2 = $grade->where(array('studentid' => $stu_id, 'itemid' => array('in', $id2)))->order('itemid asc')->select();
        $this->assign("score2", $score2);
        $this->display();
    }

    public function input()
    {
        $grade = D("Grade");
        $item = D("Item");
        $items2 = $item->distinct(true)->field('title,id')->where('level=2')->order('id')->select();
        $this->assign('items2', $items2);

        $this->display();
    }

    public function add()
    {
        $student = D('Student');
        $student_id = $this->_post('studentid');
        if (!$student->find($student_id)) {
            $this->error('学号不存在', U('Grade/input'));
        }

        $model = D('Grade');
        $ids = $this->_post('itemid');
        $result = array();
        $errCount = 0;
        foreach ($ids as $itemid) {
            $data = array('itemid' => $itemid, 'studentid' => $student_id);
            $data['point'] = $this->_post('item_' . $itemid);
            if ($model->create($data)) {
                if ($model->add()) {
                    $result[] = "[成功]项目：$data[itemid]，分数：$data[point]";
                } else {
                    $errCount++;
                    $result[] = "[失败]项目：$data[itemid]，错误信息：" . $model->getDbError();
                }
            } else {
                $errCount++;
                $result[] = "[失败]项目：$data[itemid]，错误信息：" . $model->getError();
            }
        }

        if ($errCount) {
            $this->error(implode('<br>', $result), U('Grade/input'));
        } else {
            $this->success(implode('<br>', $result), U('Grade/input'));
        }
    }

    //上传成绩处理
    public function upload()
    {
        import('ORG.Net.UploadFile');
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->allowExts = array('xls', 'xlsx'); // 设置附件上传类型
        $upload->savePath = './Upload/'; // 设置附件上传目录
        if (!$upload->upload()) { // 上传错误提示错误信息
            $this->error($upload->getErrorMsg(), U('Grade/input'));
        } else { // 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
            $file = $info[0];
            $path = $file['savepath'] . $file['savename'];
            //Read Excel
            try {
                Vendor("PHPExcel.PHPExcel.IOFactory");
                $itemid = $this->_post('id');
                $objPHPExcel = PHPExcel_IOFactory::load($path);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                //规定：第一行是表头，第一列是学号，第二列是成绩
                $result = array();
                $errCount = 0;
                $model = D('Grade');
                for ($i = 2; $i <= count($sheetData); $i++) {
                    $line = $sheetData[$i];
                    $data = array('itemid' => $itemid);
                    $data['studentid'] = $line['A'];
                    if ($model->where($data)->find()) {
                        $model->where($data)->delete();
                    }
                    $data['point'] = $line['B'];
                    if ($model->create($data)) {
                        if ($model->add()) {
                            $result[] = "[成功]学号：$data[studentid]，分数：$data[point]";
                        } else {
                            $errCount++;
                            $result[] = "[失败]学号：$data[studentid]，错误信息：" . $model->getDbError();
                        }
                    } else {
                        $errCount++;
                        $result[] = "[失败]学号：$data[studentid]，错误信息：" . $model->getError();
                    }
                }
                unlink($path);
                if ($errCount) {
                    $this->error(implode('<br>', $result), U('Grade/input'));
                } else {
                    $this->success(implode('<br>', $result), U('Grade/input'));
                }
            } catch (Exception $e) {
                unlink($path);
                $this->error($e->getMessage(), U('Grade/input'));
            }
        }
    }
}
