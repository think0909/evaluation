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
}