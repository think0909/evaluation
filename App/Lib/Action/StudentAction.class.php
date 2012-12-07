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
    public function manage(){
        $student = D('Student');

        $data = $student->select();
        $this->assign('students',$data);
        $this->display();
    }

    public function add(){
        $student = D('Student');

        if($student->create()){
            if($student->add()){
                $this->success('成功添加！',U('Student/manage'));
            }else{
                $this->error($student->getDbError(),U('Student/manage'));
            }
        }else{
            $this->error($student->getError(),U('Student/manage'));
        }
    }

    public function edit(){
        $student = D('Student');
        if($student->create()){
            if($student->save()){
                $this->success('成功编辑！',U('Student/manage'));
            }else{
                $this->error($student->getDbError(),U('Student/manage'));
            }
        }else{
            $this->error($student->getError(),U('Student/manage'));
        }
    }

    public function del(){
        $student = D('Student');
        $id = $this->_get('id');
        if($id && $student->find($id)){
            if($student->where(array('id'=>$id))->delete()){
                $this->success('成功删除！',U('Student/manage'));
            }else{
                $this->error($student->getDbError(),U('Student/manage'));
            }
        }else{
            $this->error('用户名不存在',U('Student/manage'));
        }
    }
}
