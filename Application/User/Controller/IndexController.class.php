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
        $UserModel = M('User');
        $map['account'] = $cookie;
        $nickname = $UserModel->where($map)->getField('nickname');
        $this->assign('nickname',$nickname);

        $count1 = M('user')->count();
        $Page1  = new \Think\Page($count1,5);
        $show1  = $Page1->show();
        $list1 = M('user') ->order('id')->order("id")->limit($Page1->firstRow,$Page1->listRows)->select();
        $this->assign('list1',$list1);// 赋值数据集
        $this->assign('page1',$show1);// 赋值分页输出

        /**
         * 循环出coin表数据
         */

        $CoinModel =M('coin');
        $coinInfo = $CoinModel ->order('id desc')-> select();

        $this->assign('coinInfo',$coinInfo);

        /**
         *  循环出bank表数据
         */

        $BankModel =M('bank');
        $bankInfo = $BankModel ->order('id desc')-> select();

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
             $areaInfo[] = $areaModel ->where("bank_id=$bank_ids[$x]")->order('id desc')-> select();
        }

        $type = I('get.type');
        if(empty($type)){
            $type=0;
        }

        $this -> assign('areaInfo',$areaInfo);
        $this -> assign('count',$count);
        $this -> assign('type',$type);

        $count = M('news')->count();
        $Page  = new \Think\Page($count,5);

        $show  = $Page->show();
        $list = M('news')->order("id desc")->limit($Page->firstRow,$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();


       echo U(ACTION_NAME, $this->parameter);

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
                header("location:/index.php/Index/admin");
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

    public function publish(){
        header("Content-type:text/html;charset=utf8");
        $id = I('get.id');
        $tab = I('get.tab');
        $content = I('get.content');

        if(empty($tab)){
            $result=array();
            $result['status']=true;
            $result['data']='标记不能为空';

            echo json_encode($result);
            die();
        }

        if(empty($content)){
            $result=array();
            $result['status']=true;
            $result['data']='内容不能为空';

            echo json_encode($result);
            die();
        }


        $map['id'] = $id;
        $data['content'] = $content;
        $data['tab'] = $tab;
        $data['create_time'] = date("Y-m-d H:i:s");

        if(empty($id)){
            $News = M('news')->add($data);
            if($News){
                $result=array();
                $result['success']=true;
                $result['data']='发布成功';

                echo json_encode($result);
                die();
            }else{
                $result=array();
                $result['success']=false;
                $result['data']='发布失败';

                echo json_encode($result);
                die();
            }
        }else{
            $News = M('news')->where($map)->save($data);
            if($News){
                $result=array();
                $result['success']=true;
                $result['data']='编辑成功';

                echo json_encode($result);
                die();
            }else{
                $result=array();
                $result['success']=false;
                $result['data']='编辑失败';

                echo json_encode($result);
                die();
            }
        }
    }

    public function news_delete(){

        $id = I('get.id');
        $news = M('news');
        $map['id'] = $id;
        $News = $news->where($map)->delete();
        if($News){
            $result=array();
            $result['success'] = true;
            $result['data'] = '删除成功';
            echo json_encode($result);die();
        }else{
            $result = array();
            $result['success'] = false;
            $result['data'] = '删除失败';
            echo json_encode($result);die();
        }
    }
    public function news_modify(){
        $id = I('get.id');
        $news = M('news');
        $map['id'] = $id;
        $News = $news->where($map)->find();
        echo json_encode($News);
        die();
    }


    /**
     * 后台增加用户
     */
    public function user_add(){
        $id = trim(I('post.id'));
        $account = trim(I('post.account'));
        $nickname = trim(I('post.nickname'));
        $password = trim(I('post.password'));
        $password_2 = trim(I('post.password_2'));
        if(empty($id)){
            $result=array();
            $result['success']= false;
            $result['data'] = '请输入编号';
            echo json_encode($result);
            die();
        }elseif(!is_numeric($id)){
            $result=array();
            $result['success']= false;
            $result['data'] = '编号只能为数字';
            echo json_encode($result);
            die();
        }else{
            $map['id'] = $id;
            $result11 = M('user')->where($map)->find();
            if($result11){
                $result=array();
                $result['success']= false;
                $result['data'] = '编号已被注册';
                echo json_encode($result);
                die();
            }
        }
        if(empty($account)){
            $result=array();
            $result['success']= false;
            $result['data'] = '请输入账号';
            echo json_encode($result);
            die();
        }else{
            $map['account']= $account;
            $user = M('user')->where($map)->find();
            if($user){
                $result=array();
                $result['success']= false;
                $result['data'] = '账号已被注册';
                echo json_encode($result);
                die();
            }
        }

        if(empty($nickname)){
            $result=array();
            $result['success']= false;
            $result['data'] = '请填写昵称';
            echo json_encode($result);
            die();
        }
        if(empty($password)){
            $result=array();
            $result['success']= false;
            $result['data'] = '请填写密码';
            echo json_encode($result);
            die();
        }
        if(empty($password_2)){
            $result=array();
            $result['success']= false;
            $result['data'] = '请填写确认密码';
            echo json_encode($result);
            die();
        }elseif($password!=$password_2){
            $result=array();
            $result['success']= false;
            $result['data'] = '两次密码输入不一致';
            echo json_encode($result);
            die();
        }
        $data['id'] = $id;
        $data['account'] = $account;
        $data['nickname'] = $nickname;
        $data['password'] =md5($password);
        $User = M('user')->add($data);
        if($User){
            $result=array();
            $result['success']= true;
            $result['data'] = '添加成功';
            echo json_encode($result);
            die();
        }else{
            $result=array();
            $result['success']= false;
            $result['data'] = '添加失败';
            echo json_encode($result);
            die();
        }

    }

    public function user_delete(){
        $id = I('post.id');
        if(empty($id)){
            $result=array();
            $result['success']= false;
            $result['data'] = '系统错误';
            echo json_encode($result);
            die();
        }

        $map['id']  = $id;
        $User = M('user')->where($map)->delete();
        if($User){
            $result=array();
            $result['success']= true;
            $result['data'] = '删除成功';
            echo json_encode($result);
            die();
        }else{
            $result=array();
            $result['success']= false;
            $result['data'] = '删除失败';
            echo json_encode($result);
            die();
        }


    }
}