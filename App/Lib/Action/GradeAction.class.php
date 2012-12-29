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
        needAuth(1);
        $studentModel = D('Student');
        $data = array();
        $search = $this->_post('search');
        $condition = array();

        if ($search) {
            $spilt = explode(' ', $search);
            foreach ($spilt as &$value) {
                $value = "%$value%";
            }
            $condition['id|name|class|gender'] = array('like', $spilt, 'OR');
        }

        $students = $studentModel->where($condition)->select();
        $this->assign('search', $search);

        foreach ($students as &$s) {
            $s['point'] = 0;
            for ($i = 1; $i <= 5; $i++) {
                $temp = $this->calculate($s['id'], $i);
                $s['point_' . $i] = $temp['point'];
                $s['point'] += C('SITE_storage_' . $i . '_weight') * $temp['point'];
                unset($temp);
            }
            $data[] = $s;
            unset($res);
        }
        $items1 = array();
        for ($i = 1; $i <= 5; $i++) {
            $items1[] = array('id' => $i, 'title' => C('SITE_storage_' . $i . '_name'), 'weight' => C('SITE_storage_' . $i . '_weight'));
        }
        $this->assign('items1', $items1);
        $this->assign('data', $data);
        $this->display();
    }

    public function detail($id = false)
    {
        $student = D('Student');

        $stu_id = $id ? $id : $this->_get('id');

        if ($id) {
            $this->assign('showJacLogout', 1);
        }

        if ($stu = $student->find($stu_id)) {
            $data = $this->calculate($stu_id);

            $total = 0;
            $storage = array();
            if (C('SITE_calculate_mode') == 'multiple') {
                for ($i = 1; $i <= 5; $i++) {
                    $temp = $this->calculate($stu_id, $i);
                    $storage[] = array('name' => $i . ':' . C('SITE_storage_' . $i . '_name'), 'data' => $temp, 'weight' => C('SITE_storage_' . $i . '_weight'));
                    $total += C('SITE_storage_' . $i . '_weight') * $temp['point'];
                }
            } else {
                $i = C('SITE_current_storage');
                $temp = $this->calculate($stu_id);
                $storage[] = array('name' => $i . ':' . C('SITE_storage_' . $i . '_name'), 'data' => $temp, 'weight' => C('SITE_storage_' . $i . '_weight'));
                $total = $temp['point'];
            }
            $this->assign('storage', $storage);
            $this->assign('total', $total);
            $this->assign('student', $stu);

            $this->display('Grade:detail');
        } else {
            $this->error('学生信息不存在', U('Grade/manage'));
        }

    }

    public function itemdetail()
    {
        needAuth(1);
        $itemModel = D('Item');
        $studentModel = D('Student');
        $itemlist = $itemModel->where('level=1')->order('id asc')->select();
        foreach ($itemlist as &$level1) {
            $level1['data'] = $itemModel->where(array('level' => 2, 'parentid' => $level1['id']))->order('id asc')->select();
        }

        if (!($item = $itemModel->find($this->_get('item')))) {
            $item = $itemlist[0];
        }

        $student = $studentModel->order('id asc')->select();
        foreach ($student as &$s) {
            $s['grade'] = $this->getGrade($s['id'], $item['id']);
        }

        $this->assign('itemlist', $itemlist);
        $this->assign('item', $item);
        $this->assign('pointlist', $student);
        $this->display('Grade:itemdetail');
    }

    public function calculate($studentid, $storage = '')
    {
        $itemModel = D('Item');
        if ($storage) {
            $itemModel->setTableName('item_' . $storage);
        }
        $data = array('point' => 0);
        $data['details'] = array();
        //level 1
        $items1 = $itemModel->where('level=1')->order('id asc')->select();
        foreach ($items1 as $item) {
            //level 2
            $items2 = $itemModel->where(array('level' => 2, 'parentid' => $item['id']))->order('id asc')->select();
            $level1 = array('id' => $item['id'], 'title' => $item['title'], 'weight' => $item['weight'], 'point' => 0);
            $level1['subItems'] = array();
            foreach ($items2 as $subitem) {
                $point = $this->getGrade($studentid, $subitem['id'], $storage);
                if ($subitem['weight'] && $subitem['weight'] > 0) {
                    $level1['point'] += $subitem['weight'] * $point;
                }
                $level2 = array('id' => $subitem['id'], 'title' => $subitem['title'], 'weight' => $subitem['weight'], 'point' => $point);
                $level1['subItems'][] = $level2;
            }
            $data['details'][] = $level1;
            if ($item['weight'] && $item['weight'] > 0) {
                $data['point'] += $level1['point'] * $item['weight'];
            }
        }
        return $data;
    }

    public function getGrade($studentid, $itemid, $storage = '')
    {
        $gradeModel = D('Grade');
        $itemModel = D('Item');
        if ($storage) {
            $gradeModel->setTableName('grade_' . $storage);
            $itemModel->setTableName('item_' . $storage);
        }
        $item = $itemModel->find($itemid);
        if ($item['level'] == 2) {
            $res = $gradeModel->where(array('studentid' => $studentid, 'itemid' => $itemid))->find();
            if ($res) {
                return $res['point'];
            } else {
                return 0;
            }
        } else {
            //level 1
            $items2 = $itemModel->where(array('level' => 2, 'parentid' => $item['id']))->select();
            $sum = 0;
            foreach ($items2 as $subitem) {
                $point = $this->getGrade($studentid, $subitem['id']);
                if ($subitem['weight'] && $subitem['weight'] > 0) {
                    $sum += $subitem['weight'] * $point;
                }
            }
            return $sum;
        }
    }

    public function input()
    {
        needAuth(1);
        $grade = D("Grade");
        $item = D("Item");
        $items1 = $item->where('level=2')->order('id asc')->select();
        $this->assign('items2', $items1);

        $this->display();
    }

    public function add()
    {
        needAuth(1);
        $student = D('Student');
        $student_id = $this->_post('studentid');
        if (!$student->find($student_id)) {
            $this->error('学号不存在', U('Grade/input'));
        }

        $model = D('Grade');
        $model1 = D('Grade');
        $ids = $this->_post('itemid');
        $result = array();
        $errCount = 0;
        foreach ($ids as $itemid) {
            $data = array('itemid' => $itemid, 'studentid' => $student_id);
            $data['point'] = $this->_post('item_' . $itemid);
            if ($model->create($data)) {
                $model1->where(array('studentid' => $student_id, 'itemid' => $itemid))->delete();
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
        needAuth(1);
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
