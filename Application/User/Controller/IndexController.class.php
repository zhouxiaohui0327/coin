<?php
namespace User\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function admin(){
        header("Content-type: text/html; charset=utf-8");
        /**
         * 获取cookie;
         */
        $cookie =  $_COOKIE['user'];
        if (!isset($_COOKIE["user"])) {
            header('location:/index.php/Index/enter');
        }

        /**
         * 根据cookie获取昵称
         */
        $UserModel = D('User');
        $map['account'] = $cookie;
        $nickname = $UserModel->where($map)->getField('nickname');
        $this->assign('nickname',$nickname);

        /**
         * 循环出coin表数据
         */

        $CoinModel =M('coin');
        $coinInfo = $CoinModel -> select();

        $this->assign('coinInfo',$coinInfo);

        /**
         *  循环出bank表数据
         */

        $BankModel =M('bank');
        $bankInfo = $BankModel -> select();

        $this->assign('bankInfo',$bankInfo);

        /**
         * 循环出area表数据
         */

        $areaModel =M('area');

        for($i=1;$i<count($bankInfo)+1;$i++){
             $areaInfo[$i] = $areaModel ->where("bank_id=$i")-> select();
        }

        $this -> assign('areaInfo',$areaInfo);

        $this->display();

    }

    public  function enter(){
        setcookie("user","", time()-1);
        $this->display();
    }


    public function enterPost(){

         header("Content-type:text/html;charset:utf-8");
        $account = trim(I('post.account'));
        $password = trim(I('post.password'));

        if(empty($account)){
//            $this->ajaxReturn('','用户名不能为空',1);
            die("<script>alert('用户名不能为空');history.back();</script>");
        }
        if(empty($account)){
//            $this->ajaxReturn('','密码不能为空',2);
            die("<script>alert('密码不能为空');history.back();</script>");
        }
        $user = M('User');
        $map['account'] = $account;
        $userModel =$user->where($map)->find();
//        if(!empty($userModel))
//        {
//            if($userModel['password'] == md5($password))
//            {
//                $this->ajaxReturn('','登录成功',0);
//                setcookie("user", "$account", time()+3600);
//            }
//            else
//            {
//                $this->ajaxReturn('','密码不正确',4);
//            }
//        }
//        else
//        {
//            $this->ajaxReturn('','用户名不存在',3);
//        }

        if(!empty($userModel))
        {
            if($userModel['password'] == md5($password))
            {
                header("location:/index.php/Index/admin.html");
                setcookie("user","$account",time()+3600);
            }
            else
            {
                die("<script>alert('密码不正确');history.back();</script>");
            }
        }else
        {
            die("<script>alert('用户名不存在');history.back();</script>");
        }





    }
}