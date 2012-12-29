<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action
{
    function _initialize()
    {
    }

    public function index()
    {
        if (checkLogin()) {
            $this->main();
        } else {
            $this->login();
        }
    }

    public function takeLogin()
    {
        $username = $this->_post('username');
        $password = $this->_post('password');
        if (!$username || !$password) {
            $this->error('请填写用户名和密码', U('Index/login'));
        }
        $user = D('User');
        $res = $user->where(array('username' => $username))->find();
        if ($res) {
            if ($res['password'] == md5($password)) {
                //session
                session('user', $res['id']);
                //jump
                $this->success('登录成功！欢迎使用', U('Index/main'));
            } else {
                $this->error('密码错误', U('Index/login'));
            }
        } else {
            $this->error('用户名不存在', U('Index/login'));
        }
    }

    public function main()
    {
        $user = D('user');
        $item = D('item');
        $student = D('student');

        $this->assign('student', $student->count());
        $this->assign('boys', $student->where("gender = '男'")->count());
        $this->assign('girls', $student->where("gender = '女'")->count());

        $this->assign('user', $user->count());

        $this->assign('level1', $item->where("level=1")->count());
        $this->assign('level2', $item->where("level=2")->count());

        $this->display('main');
    }

    public function login()
    {
        $this->display('login');
    }

    public function takeLogout()
    {
        session('user', false);
        $this->success('退出成功！谢谢使用', U('Index/login'));
    }

    public function mkUser()
    {
        $user = D('User');
        $data = array('username' => 'chengs', 'password' => md5('253177'), 'auth' => 3);
        $user->data($data)->add();
    }


    public function takeJacLogin()
    {
        //login
        jacLogin();
        if ($id = jacGetUser()) {
            $student = D('Student');
            if ($student->find($id)) {
                $GradeAction = A('Grade');
                $GradeAction->detail($id);
            } else {
                $this->error('系统中没有该学生的信息', U('Index/takeJacLogout'));
            }
        } else {
            $this->error('未知错误', U('Index/takeJacLogout'));
        }
    }

    public function takeJacLogout()
    {
        jacLogout();
        $this->success('退出成功！谢谢使用', U('Index/login'));
    }

    public function takeConfig()
    {
        needAuth(3);
        $model = D('Config');
        foreach ($_POST as $key => $value) {
            if ($value) {
                $model->where(array('key' => $key))->delete();
                $model->data(array('key' => $key, 'value' => $value))->add();
            }
        }
        $this->success('已修改！', U('Index/config'));
    }

    public function config()
    {
        needAuth(3);
        $storage_name = array();
        $storage_weight = array();
        for ($i = 1; $i <= 5; $i++) {
            $this->assign('current_storage_' . $i . '_checked', (C('SITE_current_storage') == $i) ? 'checked' : '');
            $storage_name[$i] = C('SITE_storage_' . $i . '_name');
            $storage_weight[$i] = C('SITE_storage_' . $i . '_weight');
        }
        $this->assign('storage_name', $storage_name);
        $this->assign('storage_weight', $storage_weight);
        $this->assign('calculate_mode_single_checked', C('SITE_calculate_mode') == 'single' ? 'checked' : '');
        $this->assign('calculate_mode_multiple_checked', C('SITE_calculate_mode') == 'multiple' ? 'checked' : '');
        $this->display('Index:config');
    }
}