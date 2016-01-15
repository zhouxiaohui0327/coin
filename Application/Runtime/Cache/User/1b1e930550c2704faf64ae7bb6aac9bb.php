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
                    <td><input name="modify_coin_name" coin_id="<?php echo ($vo["id"]); ?>" type="text" value="<?php echo ($vo["name"]); ?>" style="width:100%;border: none"/></td>
                    <td><input name="modify_apply_start" coin_id="<?php echo ($vo["id"]); ?>" type="date" value="<?php echo ($vo["apply_start"]); ?>" style="width:100%;border: none"/></td>
                    <td><input name="modify_apply_end" coin_id="<?php echo ($vo["id"]); ?>" type="date" value="<?php echo ($vo["apply_end"]); ?>" style="width:100%;border: none"/></td>
                    <td><input name="modify_exchange_start" coin_id="<?php echo ($vo["id"]); ?>" type="date" value="<?php echo ($vo["exchange_start"]); ?>" style="width:100%;border: none"/></td>
                    <td><input name="modify_exchange_end" coin_id="<?php echo ($vo["id"]); ?>" type="date" value="<?php echo ($vo["exchange_end"]); ?>" style="width:100%;border: none"/></td>
                    <td><input name="modify_notice_url" coin_id="<?php echo ($vo["id"]); ?>" type="text" value="<?php echo ($vo["notice_url"]); ?>" style="width:100%;border: none"/></td>
                    <td>
                        <a class="btn btn-danger btn-sm" style="padding:0 10px" href="">删除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        $("input[name=modify_coin_name]").blur(function(){
            var name = $(this).val();
            var id =$(this).attr("coin_id");
            $.get('/index.php/Index/modify_coin',{name:name,id:id},function(result1){
                        if(result1.success){
                        }else{
                            alert(result1.data);
                        }
                    }
                    ,'json')
        });
        $("input[name=modify_apply_start]").blur(function(){
            var apply_start = $(this).val();
            var id =$(this).attr("coin_id");
            $.get('/index.php/Index/modify_coin',{apply_start:apply_start,id:id},function(result1){
                        if(result1.success){
                        }else{
                            alert(result1.data);
                        }
                    }
                    ,'json')
        });
        $("input[name=modify_apply_end]").blur(function(){
            var apply_end = $(this).val();
            var id =$(this).attr("coin_id");
            $.get('/index.php/Index/modify_coin',{apply_end:apply_end,id:id},function(result1){
                        if(result1.success){
                        }else{
                            alert(result1.data);
                        }
                    }
                    ,'json')
        });
        $("input[name=modify_exchange_start]").blur(function(){
            var exchange_start = $(this).val();
            var id =$(this).attr("coin_id");
            $.get('/index.php/Index/modify_coin',{exchange_start:exchange_start,id:id},function(result1){
                        if(result1.success){
                        }else{
                            alert(result1.data);
                        }
                    }
                    ,'json')
        });
        $("input[name=modify_exchange_end]").blur(function(){
            var exchange_end = $(this).val();
            var id =$(this).attr("coin_id");
            $.get('/index.php/Index/modify_coin',{exchange_end:exchange_end,id:id},function(result1){
                        if(result1.success){
                        }else{
                            alert(result1.data);
                        }
                    }
                    ,'json')
        });
        $("input[name=modify_notice_url]").blur(function(){
            var notice_url = $(this).val();
            var id =$(this).attr("coin_id");
            $.get('/index.php/Index/modify_coin',{notice_url:notice_url,id:id},function(result1){
                        if(result1.success){
                        }else{
                            alert(result1.data);
                        }
                    }
                    ,'json')
        });

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
                    <td><input name="modify_bank_name" bank_id="<?php echo ($vo["id"]); ?>" type="text" value="<?php echo ($vo["name"]); ?>" style="width:100%;border: none"/></td>
                    <td><input name="modify_apply_url" bank_id="<?php echo ($vo["id"]); ?>" type="text" value="<?php echo ($vo["apply_url"]); ?>" style="width:100%;border: none"/></td>
                    <td><input name="modify_query_url" bank_id="<?php echo ($vo["id"]); ?>" type="text" value="<?php echo ($vo["query_url"]); ?>" style="width:100%;border: none"/></td>
                </tr><?php endforeach; endif; ?>

            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function(){
            $("input[name=modify_bank_name]").blur(function(){
                var bank_name = $(this).val();
                var bank_id =$(this).attr("bank_id");
                $.get('/index.php/Index/modify',{bank_name:bank_name,bank_id:bank_id},function(result1){
                    if(result1.success){
                    }else{
                        alert("修改失败");
                    }
                }
              ,'json')
            });

            $("input[name=modify_apply_url]").blur(function(){
                var apply_url = $(this).val();
                var bank_id =$(this).attr("bank_id");
                $.get('/index.php/Index/modify',{apply_url:apply_url,bank_id:bank_id},function(result1){
                            if(result1.success){
                            }else{
                                alert(result1.data);
                            }
                        }
                        ,'json')
            });

            $("input[name=modify_query_url]").blur(function(){
                var query_url = $(this).val();
                var bank_id =$(this).attr("bank_id");
                $.get('/index.php/Index/modify',{query_url:query_url,bank_id:bank_id},function(result1){
                            if(result1.success){
                            }else{
                                alert(result1.data);
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

            <?php $__FOR_START_18218__=1;$__FOR_END_18218__=$count+1;for($i=$__FOR_START_18218__;$i < $__FOR_END_18218__;$i+=1){ ?><tr>
                    <td><?php echo ($i); ?></td>
                    <?php if(is_array($areaInfo[$i])): foreach($areaInfo[$i] as $key=>$vo): ?><td><input name="modify_area" bank_id="<?php echo ($vo["bank_id"]); ?>" type="text" value="<?php echo ($vo["area"]); ?>" style="width:80px;border: none"/></td><?php endforeach; endif; ?>
                </tr><?php } ?>
        </table>
    </div>
</div>

<script>
    $("input[name=modify_area]").blur(function(){
        var area = $(this).val();
        var bank_id =$(this).attr("bank_id");
        var order =$(this).parent().index();

        $.get('/index.php/Index/modify_area',{area:area,bank_id:bank_id,order:order},function(result1){
                    if(result1.success){
                    }else{
                        alert(result1.data);
                    }
                }
                ,'json')
    })
</script>



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