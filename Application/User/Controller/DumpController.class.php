<?php
namespace User\Controller;

use Think\Controller;

class DumpController extends Controller{
    public function skip(){
        $coin_id = I('get.coin_id');
        $coin =M('coin');
        $map['id'] = $coin_id;
        $coinInfo = $coin -> where($map) -> find();

        $this->assign('coinInfo',$coinInfo);

        $this->display();
    }
}