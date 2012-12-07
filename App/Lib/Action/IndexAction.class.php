<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action
{
    public function index()
    {
        $model = M('User');
        dump($model->getDbFields());
        $data = array();
        $data['username'] = 'chengs';
        $data['password'] = md5(time());

        $model->create($data);
        $model->add();

        dump($model->select());
    }


    public function take()
    {
        $model = D('User');

        if ($model->create()) {
            if ($model->add()) {
                echo 'ok';

            } else {
                echo $model->getDbError();
            }
        } else {
            dump($model->getError());
        }
    }
}