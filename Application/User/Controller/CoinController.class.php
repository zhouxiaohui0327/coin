<?php
namespace User\Controller;

use Think\Controller;
class CoinController extends Controller{
    public function select(){
        header("Content:text/html;charset=utf-8");
        $this->display();
    }

    public function selectPost(){
        header("Content-type:text/html;charset=utf-8");
        $area = trim(I('post.area'));
        $coin_id =I('get.coin_id');
        if(isset($_GET['coin_id'])){
            $coin_id = 1 ;
        }

        if(empty($area)){
           die("<script>alert('请选择地区');history.back();</script>");
        }
        $coin = M("area");

        $map['area'] = $area;
        $result = $coin->where($map)->getField('bank_id');

        $bank =M("bank");

        $map['id'] = $result ;
        $map['coin_id'] = $coin_id ;
        $select = $bank->where($map)->find();


        $this->assign('select',$select);
        $this->assign('area',$area);


        $this->display();



    }
}