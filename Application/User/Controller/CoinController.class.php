<?php
namespace User\Controller;

use Think\Controller;
class CoinController extends Controller{
    public function select(){
        header("Content:text/html;charset=utf-8");

        $ip = $_SERVER["REMOTE_ADDR"];
        function GetIpLookup($ip){
            // 根据ip地址获取省份，城市
            $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
            if(empty($res)){ return false; }
            $jsonMatches = array();
            preg_match('#\{.+?\}#', $res, $jsonMatches);
            if(!isset($jsonMatches[0])){ return false; }
            $json = json_decode($jsonMatches[0], true);
            if(isset($json['ret']) && $json['ret'] == 1){
                $json['ip'] = $ip;
                unset($json['ret']);
            }else{
                return false;
            }
            return $json;
        }
        $ipInfos = GetIpLookup($ip);

        $city = $ipInfos["city"];
        $province = $ipInfos['province'];


        $areaInfo = M('area');

        $condition['area'] = $city;
        $condition['area'] = $province;
        $condition['_logic'] = 'OR';
        $areaCount = $areaInfo -> where($condition)->select();

        $area = array();

        if($areaCount){
            if($city == "深圳"){
                $area = array("$city","$city");
            }else{
                $area = array("$province","$province");
            }
        }else{
            if(empty($ipInfos)){
                $area = array("请选择","");
            }else{
                $area = array("未知区域,请选择","");
            }


        }

        $this->assign("area",$area);

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


    /**
     * 能取到地区就自动跳转到selectPost页面
     */
    public function location(){

        $ip = $_SERVER["REMOTE_ADDR"];

        function GetIpLookup($ip){
            // 根据ip地址获取省份，城市
            $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
            if(empty($res)){ return false; }
            $jsonMatches = array();
            preg_match('#\{.+?\}#', $res, $jsonMatches);
            if(!isset($jsonMatches[0])){ return false; }
            $json = json_decode($jsonMatches[0], true);
            if(isset($json['ret']) && $json['ret'] == 1){
                $json['ip'] = $ip;
                unset($json['ret']);
            }else{
                return false;
            }
            return $json;
        }
        $ipInfos = GetIpLookup($ip);

        $city = $ipInfos["city"];
        $province = $ipInfos['province'];

        if($city=="深圳"){
            //特殊情况：判断城市是深圳的话，area就为深圳
            header("location:/index.php/Coin/selectPost?coin_id=1&area=$city");
        }elseif(empty($ipInfos)){
            //获取不到ip信息的情况下跳转到select页面
            header("location:/index.php/Coin/select");
        }else{
            header("location:/index.php/Coin/selectPost?coin_id=1&area=$province");
        }
    }



    /**
     * 不在预约时间内跳转页面
     */

    public function notice(){


        $coin_id = I('get.coin_id');
        $coin =M('coin');
        $map['coin_id'] = $coin_id;
        $coinInfo = $coin -> where($map) -> find();

        $this->assign('coinInfo',$coinInfo);



        $this->display();
    }
}