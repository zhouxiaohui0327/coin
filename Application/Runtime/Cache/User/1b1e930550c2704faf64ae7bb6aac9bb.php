<?php if (!defined('THINK_PATH')) exit();?><!--<!DOCTYPE html>-->
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <title></title>
    <script type="text/javascript" src="/Public/js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="/Public/js/myJs.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/base.css" />
</head>
<body>
<header class="container-fuld clearfix">
    <a  href="javascript:loginOut()" class="loginOutBtn pull-right btn btn-danger btn-sm" style="border-radius: 0px">退出</a>
    <p class="welcome pull-right">当前用户：<span><?php echo ($nickname); ?></span></p>
</header>


<div class="container" style="margin-top: 20px">
    <div class="coin_wrap">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>id</th>
                <th>纪念币名称</th>
                <th>预约开始时间</th>
                <th>预约结束时间</th>
                <th>兑换开始时间</th>
                <th>兑换结束时间</th>
                <th>央行公告链接</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($coinInfo)): foreach($coinInfo as $key=>$vo): ?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["apply_start"]); ?></td>
                    <td><?php echo ($vo["apply_end"]); ?></td>
                    <td><?php echo ($vo["exchange_start"]); ?></td>
                    <td><?php echo ($vo["exchange_end"]); ?></td>
                    <td><?php echo ($vo["notice_url"]); ?></td>
                    <td>
                        <a class="btn btn-default btn-sm" modifyId="<?php echo ($vo["id"]); ?>" id="modifyBtn" style="padding:0 10px" href="">修改</a>
                        <a class="btn btn-danger btn-sm" style="padding:0 10px" href="">删除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $("#modifyBtn").click(function(e){
                var id = $(this).attr('modifyId');
                e.preventDefault();
                $.get('/index.php/Index/modifyPost',{id:id},function(data){
                    $('input[name=coin_name]').val(data['coin_name']);
                    $('input[name=apply_start]').val(data['apply_start']);
                    $('input[name=apply_end]').val(data['apply_end']);
                    $('input[name=exchange_start]').val(data['exchange_start']);
                    $('input[name=exchange_end]').val(data['exchange_end']);
                    $('input[name=notice_url]').val(data['notice_url']);
                    $('input[name=bank_name]').val(data['bank_name']);
                    $('input[name=apply_url]').val(data['apply_url']);
                    $('input[name=query_url]').val(data['query_url']);
                    console.log(data);
                    $('#addBtn').html("确认修改");
                },'json');
            })



        })
    </script>
    <div class="bank_wrap">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>id</th>
                <th>银行编号</th>
                <th>兑换银行</th>
                <th>预约链接</th>
                <th>查询链接</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($bankInfo)): foreach($bankInfo as $key=>$vo): ?><tr>
                    <td><?php echo ($vo["coin_id"]); ?></td>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><input name="xxx" bank_id="<?php echo ($vo["id"]); ?>" type="text" value="<?php echo ($vo["name"]); ?>"/></td>
                    <td><?php echo ($vo["apply_url"]); ?></td>
                    <td><?php echo ($vo["query_url"]); ?></td>
                </tr><?php endforeach; endif; ?>

            </tbody>
        </table>
    </div>

    <script>

        $(document).ready(function(){
            $("input[name=xxx]").blur(function(){
                var bank_name = $(this).val();
                var bank_id =$(this).attr("bank_id");
                $.get('/index.php/Index/modify',{bank_name:bank_name,bank_id:bank_id},function(data){
                    if(data.status){
                        alert(data.info);
                    }else{
                        alert(data.info);
                    }
                }
              ,'json')
            })
        })

    </script>


    <div class="area_wrap">

        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>银行编号</th>
                <th colspan="8">地区</th>
            </tr>

            <?php $__FOR_START_29188__=1;$__FOR_END_29188__=$count+1;for($i=$__FOR_START_29188__;$i < $__FOR_END_29188__;$i+=1){ ?><tr>
                    <td><?php echo ($i); ?></td>
                    <?php if(is_array($areaInfo[$i])): foreach($areaInfo[$i] as $key=>$vo): ?><td><?php echo ($vo["area"]); ?></td><?php endforeach; endif; ?>
                </tr><?php } ?>

        </table>
    </div>
</div>


<div>
    <form class="form-horizontal" action="/index.php/Index/addPost">
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">纪念币信息</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="coin_name" placeholder="纪念币信息">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">预约开始时间</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="apply_start" placeholder="预约开始时间">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">预约结束时间</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="apply_end" placeholder="预约结束时间">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">兑换开始时间</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="exchange_start" placeholder="兑换开始时间">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">兑换结束时间</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="exchange_end" placeholder="兑换结束时间">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">央行公告链接</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="notice_url" placeholder="央行公告链接">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">兑换银行</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="bank_name" placeholder="多个银行用“，”隔开">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">预约链接</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="apply_url" placeholder="多个预约链接用“，”隔开">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">查询链接</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="query_url" placeholder="多个查询链接用“，”隔开">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <label class="col-sm-2 control-label">地区</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="area_names" placeholder="多个地区用“，”隔开 ， 多个银行用“；”隔开">
            </div>
        </div>
        <div class="form-group" style="margin-right: 0">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="addBtn" class="btn btn-success">确认添加</button>
            </div>
        </div>
    </form>
</div>




</body>
</html>