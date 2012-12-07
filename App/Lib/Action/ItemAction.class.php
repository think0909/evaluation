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
}
