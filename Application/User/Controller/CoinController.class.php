<?php
namespace User\Controller;

use Think\Controller;
class CoinController extends Controller{
    public function select(){
        header("Content:text/html;charset=utf-8");

        $this->display();

    }

    public function notice(){

        $coin_id = I('get.coin_id');
        $coin =M('coin');
        $map['id'] = $coin_id;
        $coinInfo = $coin -> where($map) -> find();

        $this->assign('coinInfo',$coinInfo);

        $this->display();
    }

    public function selectPost(){
        header("Content-type:text/html;charset=utf-8");
        $area = trim(I('get.area'));
        $coin_id =I('get.coin_id');
        if(!isset($_GET['coin_id'])){
            $coin_id = 1 ;
        }

        $coinModel =M('coin');
        $map1['id'] = $coin_id;
        $coinInfo = $coinModel->where($map1)->find();

        if(empty($area)){
           die("<script>alert('请选择地区');history.back();</script>");
        }
        $coin = M("area");

        $map2['area'] = $area;
        $result = $coin->where($map2)->getField('bank_id');

        $bank =M("bank");

        $map3['id'] = $result ;
        $map3['coin_id'] = $coin_id ;

        $select = $bank->where($map3)->find();

        $this->assign('select',$select);
        $this->assign('area',$area);
        $this->assign('coinInfo',$coinInfo);


        $this->display();
    }

    public function news(){
        M('news');
        $id = I('get.id');
        $map['id'] = $id;
        if(empty($id)){
            $content = M('news')->order('id desc')->find();
        }else{
            $content = M('news')->where($map)->find();
        }

        $content = stripcslashes((htmlspecialchars_decode($content['content'])));
        $this->assign('content',$content);
        $this->display();
    }


}
