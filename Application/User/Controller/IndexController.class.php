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
        $coinInfo = $CoinModel ->order('id asc')-> select();

        $this->assign('coinInfo',$coinInfo);

        /**
         *  循环出bank表数据
         */

        $BankModel =M('bank');
        $bankInfo = $BankModel ->order('id asc')-> select();

        $this->assign('bankInfo',$bankInfo);

        /**
         * 循环出area表数据
         */

        $count = count($bankInfo);



        for($i=0;$i<$count;$i++){
            $bank_ids[] = $bankInfo[$i]['id'];
        }

        $areaModel =M('area');

        for($x=0;$x<$count;$x++){
             $areaInfo[] = $areaModel ->where("bank_id=$bank_ids[$x]")->order('id asc')-> select();
        }


        $this -> assign('areaInfo',$areaInfo);
        $this -> assign('count',$count);

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



    public function addPost(){

        header("Content-type:text/html;charset=utf8");
        $coin_name = I('get.coin_name');

        $apply_start = I('get.apply_start');
        $apply_end = I('get.apply_end');
        $exchange_start = I('get.exchange_start');
        $exchange_end = I('get.apply_end');
        $notice_url= I('get.notice_url');
        $bank_name= I('get.bank_name');
        $apply_url= I('get.apply_url');
        $query_url= I('get.query_url');
        $area_names= I('get.area_names');


        $Coin = M('coin');
        $data1['name']=$coin_name;
        $data1['apply_start']=$apply_start;
        $data1['apply_end']=$apply_end;
        $data1['exchange_start']=$exchange_start;
        $data1['exchange_end']=$exchange_end;
        $data1['notice_url']=$notice_url;

        $CoinId = $Coin->add($data1);


        $Bank = M('bank');

        $bank_name_num =explode("，",$bank_name);
        $apply_url_num =explode("，",$apply_url);
        $query_url_num =explode("，",$query_url);

        $count1 = count($bank_name_num);

        for($i=0;$i<$count1;$i++){
            $data2['coin_id']=$CoinId;
            $data2['name']=$bank_name_num[$i];
            $data2['apply_url']=$apply_url_num[$i];
            $data2['query_url']=$query_url_num[$i];
            $BankId[$i] = $Bank->add($data2);
        }

        $Area = M('area');


        for($i=0;$i<$count1;$i++){
            $area_names_num =explode("；",$area_names);
            $count[] =count(explode("，",$area_names_num[$i]));
        }


        for($x=0;$x<$count1;$x++){
            $one = explode("，",$area_names_num[$x]);
            for($i=0;$i<$count[$x];$i++){
                $data3['bank_id'] =$BankId[$x];
                $data3['area']=$one[$i];
                $AreaResult=$Area->add($data3);
            }
        }

        if($CoinId&&$BankId&&$AreaResult){
            header("location:/index.php/Index/admin");
        }else{
            die("<script>alert('添加失败');history.back();</script>");
        }
    }


    public function modify(){
        header("Content-type:text/html;charset=utf8");

        $bank_name=I('get.bank_name');
        $bank_id=I('get.bank_id');
        $apply_url=I('get.apply_url');
        $query_url=I('get.query_url');

        $Bank = M('bank');
        $data=array();

        if(!empty($bank_name)){
            $data['name']= $bank_name;
        }
        if(!empty($apply_url)){
            $data['apply_url']=$apply_url;
        }
        if(!empty($query_url)){
            $data['query_url']=$query_url;
        }


        $map['id'] = $bank_id;

        $bank_name_select =$Bank->where($map)->find();
        $result =$Bank->where($map)->save($data);


        if($result||$bank_name_select['name']==$bank_name||$bank_name_select['apply_url']==$apply_url||$bank_name_select['query_url']==$query_url){
            $result1=array();
            $result1['success']=true;
            $result1['data']='修改成功';

            echo json_encode($result1);
            die();
        }else{
            $result1=array();
            $result1['success']=false;
            $result1['data']='修改失败';
            echo json_encode($result1);
            die();
        }
    }


    public function modify_area(){
        header("Content-type:text/html;charset=utf8");

        $bank_id=I('get.bank_id');
        $area=I('get.area');
        $order =I('get.order');

        $Area = M('area');
        $map['bank_id'] =$bank_id;
        $Area_name =$Area ->where($map)->order('id asc')->select();



        $area1 = $Area_name[$order-1]['area'];



        $map1['name'] = $area1;
        $map1['bank_id'] =$bank_id;
        $Area_id =$Area ->where($map1)->order('id asc')->select();

        $id = $Area_id[$order-1]['id'];

        $map2['id']=$id;
        $map2['bank_id'] = $bank_id;
        $data['area']=$area;
        $result = $Area->where($map2)->save($data);

        if($result||$area1==$area){
            $result1=array();
            $result1['success']=true;
            $result1['data']='修改成功';

            echo json_encode($result1);
            die();
        }else{
            $result1=array();
            $result1['success']=false;
            $result1['data']='修改失败';
            echo json_encode($result1);
            die();
        }


    }

    public function modify_coin(){
        header("Content-type:text/html;charset=utf8");
        $id=I('get.id');
        $name=I('get.name');
        $apply_start=I('get.apply_start');
        $apply_end=I('get.apply_end');
        $exchange_start=I('get.exchange_start');
        $exchange_end=I('get.exchange_end');
        $notice_url=I('get.notice_url');



        $Coin = M('coin');
        $data=array();
        if(!empty($name)){
            $data['name']= $name;
        }
        if(!empty($apply_start)){
            $data['apply_start']= $apply_start;
        }
        if(!empty($apply_end)){
            $data['apply_end']= $apply_end;
        }
        if(!empty($exchange_start)){
            $data['exchange_start']= $exchange_start;
        }
        if(!empty($exchange_end)){
            $data['exchange_end']= $exchange_end;
        }
        if(!empty($notice_url)){
            $data['notice_url']= $notice_url;
        }

        $map['id'] = $id;
        $coin_name_select =$Coin->where($map)->find();
        $result =$Coin->where($map)->save($data);

        if($result||$coin_name_select['name']==$name||$coin_name_select['apply_start']==$apply_start||$coin_name_select['apply_end']==$apply_end||$coin_name_select['exchange_start']==$exchange_start||$coin_name_select['exchange_end']==$exchange_end||$coin_name_select['notice_url']==$notice_url){
            $result1=array();
            $result1['success']=true;
            $result1['data']='修改成功';

            echo json_encode($result1);
            die();
        }else{
            $result1=array();
            $result1['success']=false;
            $result1['data']='修改失败';
            echo json_encode($result1);
            die();
        }

    }



    public function delete(){
        header("Content-type:text/html;charset=utf8");

        $id =I('get.id');

        $map1['id'] =$id;
        $map2['coin_id'] = $id;
        $result = M('bank')->where($map2)->select();

        $count= count($result);
        for($i=0;$i<$count;$i++){
            $num[]=$result[$i]['id'];
        }

        for($i=0;$i<$count;$i++){
            $map3['bank_id']=$num[$i];
            $result3 = M('area')->where($map3)->delete();
        }

        $result1=M('coin')->where($map1)->delete();
        $result2=M('bank')->where($map2)->delete();

        if($result1&&$result2&&$result3){
            $result_delete=array();
            $result_delete['success']=true;
            $result_delete['data']='删除成功';

            echo json_encode($result_delete);
            die();
        }else{
            $result4=array();
            $result4['success']=false;
            $result4['data']='删除失败';

            echo json_encode($result4);
            die();
        }




    }







}