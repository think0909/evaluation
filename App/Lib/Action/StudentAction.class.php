<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-3
 * Time: 下午9:51
 * To change this template use File | Settings | File Templates.
 */
class StudentAction extends Action
{
    public function manage()
    {
        needAuth(1);
        $student = D('Student');

        $search = $this->_post('search');
        $condition = array();

        if ($search) {
            $spilt = explode(' ', $search);
            foreach ($spilt as &$value) {
                $value = "%$value%";
            }
            $condition['id|name|class'] = array('like', $spilt, 'OR');
        }

        $data = $student->where($condition)->select();
        $this->assign('search', $search);
        $this->assign('students', $data);
        $this->display();
    }

    public function  typeaheadQuery()
    {
        $model = D('Student');
        $query = $this->_get('query');
        $condition = array('id' => array('like', "$query%"));

        $results = $model->where($condition)->getField('id', true);

        $this->ajaxReturn($results, 'json');
    }

    public function add()
    {
        needAuth(1);
        $student = D('Student');

        if ($student->create()) {
            if ($student->add()) {
                $this->success('成功添加！', U('Student/manage'));
            } else {
                $this->error($student->getDbError(), U('Student/manage'));
            }
        } else {
            $this->error($student->getError(), U('Student/manage'));
        }
    }

    public function edit()
    {
        needAuth(1);
        $student = D('Student');
        if ($student->create()) {
            if ($student->save()) {
                $this->success('成功编辑！', U('Student/manage'));
            } else {
                $this->error($student->getDbError(), U('Student/manage'));
            }
        } else {
            $this->error($student->getError(), U('Student/manage'));
        }
    }

    public function del()
    {
        needAuth(1);
        $student = D('Student');
        $id = $this->_get('id');
        if ($id && $student->find($id)) {
            if ($student->where(array('id' => $id))->delete()) {
                $this->success('成功删除！', U('Student/manage'));
            } else {
                $this->error($student->getDbError(), U('Student/manage'));
            }
        } else {
            $this->error('用户名不存在', U('Student/manage'));
        }
    }

    public function upload()
    {
        needAuth(1);
        import('ORG.Net.UploadFile');
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->allowExts = array('xls', 'xlsx'); // 设置附件上传类型
        $upload->savePath = './Upload/'; // 设置附件上传目录
        if (!$upload->upload()) { // 上传错误提示错误信息
            $this->error($upload->getErrorMsg(), U('Student/manage'));
        } else { // 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
            $file = $info[0];
            $path = $file['savepath'] . $file['savename'];
            //Read Excel
            try {
                Vendor("PHPExcel.PHPExcel.IOFactory");
                $objPHPExcel = PHPExcel_IOFactory::load($path);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                //规定：第一行是表头，第一列是学号，第二列是成绩
                $result = array();
                $errCount = 0;
                $model = D('Student');
                for ($i = 2; $i <= count($sheetData); $i++) {
                    $line = $sheetData[$i];
                    $data = array();
                    $data['id'] = $line['A'];
                    $data['name'] = $line['B'];
                    $data['gender'] = $line['C'];
                    $data['class'] = $line['D'];
                    $data['pro'] = $line['E'];
                    if ($model->create($data)) {
                        if ($model->add()) {
                            $result[] = "[成功]学号：$data[id]";
                        } else {
                            $errCount++;
                            $result[] = "[失败]学号：$data[id]，错误信息：" . $model->getDbError();
                        }
                    } else {
                        $errCount++;
                        $result[] = "[失败]学号：$data[id]，错误信息：" . $model->getError();
                    }
                }
                unlink($path);
                if ($errCount) {
                    $this->error(implode('<br>', $result), U('Student/manage'));
                } else {
                    $this->success(implode('<br>', $result), U('Student/manage'));
                }
            } catch (Exception $e) {
                unlink($path);
                $this->error($e->getMessage(), U('Student/manage'));
            }
        }
    }
}
