<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-3
 * Time: 下午9:51
 * To change this template use File | Settings | File Templates.
 */
class UserAction extends Action
{
    public function manage()
    {
        $user = D('User');

        $data = $user->select();
        $this->assign('users', $data);
        $this->display();
    }

    public function add()
    {
        $user = D('User');

        if ($user->create()) {
            if ($user->add()) {
                $this->success('成功添加！', U('User/manage'));
            } else {
                $this->error($user->getDbError(), U('User/manage'));
            }
        } else {
            $this->error($user->getError(), U('User/manage'));
        }
    }

    public function edit()
    {
        $user = D('User');
        if ($user->create()) {
            if ($user->save()) {
                $this->success('成功编辑！', U('User/manage'));
            } else {
                $this->error($user->getDbError(), U('User/manage'));
            }
        } else {
            $this->error($user->getError(), U('User/manage'));
        }
    }

    public function del()
    {
        $user = D('User');
        $id = $this->_get('id');
        if ($id && $user->find($id)) {
            if ($user->where(array('id' => $id))->delete()) {
                $this->success('成功删除！', U('User/manage'));
            } else {
                $this->error($user->getDbError(), U('User/manage'));
            }
        } else {
            $this->error('用户名不存在', U('User/manage'));
        }
    }
}
