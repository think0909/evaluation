<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action
{
    public function index()
    {
        $this->display('main.html');
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