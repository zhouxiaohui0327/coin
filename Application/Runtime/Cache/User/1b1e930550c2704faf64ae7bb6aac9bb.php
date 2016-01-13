<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>预约开始时间</th>
                <th>预约结束时间</th>
                <th>兑换开始时间</th>
                <th>兑换结束时间</th>
                <th>央行公告链接</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($coinInfo)): foreach($coinInfo as $key=>$vo): ?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["apply_start"]); ?></td>
                    <td><?php echo ($vo["apply_end"]); ?></td>
                    <td><?php echo ($vo["exchange_start"]); ?></td>
                    <td><?php echo ($vo["exchange_end"]); ?></td>
                    <td><?php echo ($vo["notice_url"]); ?></td>
                </tr><?php endforeach; endif; ?>

            </tbody>
        </table>
    </div>
    <div class="bank_wrap">
        <table class="table table-bordered table-striped">
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
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["apply_url"]); ?></td>
                    <td><?php echo ($vo["query_url"]); ?></td>
                </tr><?php endforeach; endif; ?>

            </tbody>
        </table>
    </div>
    <div class="area_wrap">

        <table class="table table-bordered table-striped">
            <tr>
                <th>银行编号</th>
                <th colspan="8">地区</th>
            </tr>

            <?php $__FOR_START_29978__=1;$__FOR_END_29978__=5;for($i=$__FOR_START_29978__;$i < $__FOR_END_29978__;$i+=1){ ?><tr>
                    <td><?php echo ($i); ?></td>
                    <?php if(is_array($areaInfo[$i])): foreach($areaInfo[$i] as $key=>$vo): ?><td><?php echo ($vo["area"]); ?></td><?php endforeach; endif; ?>
                </tr><?php } ?>

        </table>
    </div>
</div>


</body>
</html>