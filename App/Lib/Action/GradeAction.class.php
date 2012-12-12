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
        $student = D('Student');
        $item = D('Item');
        $items1 = $item->where('level=1')->order('id asc')->select();
        $data = array();
        $students = $student->select();

        foreach ($students as $s) {
            $res = $this->calculate($s['id']);
            $res = array_merge($res, $s);
            $data[] = $res;
            unset($res);
        }
        $this->assign('items1', $items1);
        $this->assign('data', $data);
        $this->display();
    }

    public function detail()
    {
        $student = D('Student');

        $stu_id = $this->_get('id');

        if ($stu = $student->find($stu_id)) {
            $data = $this->calculate($stu_id);

            $this->assign('data', $data['details']);
            $this->assign('point', $data['point']);
            $this->assign('student', $stu);

            $this->display();
        } else {
            $this->error('学生信息不存在', U('Grade/manage'));
        }

    }

    public function calculate($studentid)
    {
        $model = D('Item');
        $data = array('point' => 0);
        $data['details'] = array();
        //level 1
        $items1 = $model->where('level=1')->order('id asc')->select();
        foreach ($items1 as $item) {
            //level 2
            $items2 = $model->where(array('level' => 2, 'parentid' => $item['id']))->order('id asc')->select();
            $level1 = array('id' => $item['id'], 'title' => $item['title'], 'weight' => $item['weight'], 'point' => 0);
            $level1['subItems'] = array();
            foreach ($items2 as $subitem) {
                $point = $this->getGrade($studentid, $subitem['id']);
                if ($subitem['weight'] && $subitem['weight'] > 0) {
                    $level1['point'] += $subitem['weight'] * $point;
                    //dump($level1);
                }
                $level2 = array('id' => $subitem['id'], 'title' => $subitem['title'], 'weight' => $subitem['weight'], 'point' => $point);
                $level1['subItems'][] = $level2;
            }
            $data['details'][] = $level1;
            if ($item[weight] && $item['weight'] > 0) {
                $data['point'] += $level1['point'];
            }
        }
        return $data;
    }

    public function getGrade($studentid, $itemid)
    {
        $model = D('Grade');
        $res = $model->where(array('studentid' => $studentid, 'itemid' => $itemid))->find();
        if ($res) {
            return $res['point'];
        } else {
            return 0;
        }
    }

    public function input()
    {
        $grade = D("Grade");
        $item = D("Item");
        $items1 = $item->where('level=2')->order('id asc')->select();
        $this->assign('items2', $items1);

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
