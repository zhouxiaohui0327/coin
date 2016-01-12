<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!--<script type="text/javascript" src="/Public/js/jquery-2.1.4.js"></script>-->
    <script src="/Public/js/jquery-2.1.4.js"></script>
    <link rel="stylesheet" href="/Public/css/select.css"/>
    <title></title>
</head>
<body>
<div class="container" style="padding: 0">
    <div class="bank_icon" style="text-align: center;">


        <?php if($select['id'] ==1): ?><img width="80%" src="/Public/img/gongshang.jpg" alt=""/>

        <?php elseif($select['id'] ==2): ?>
            <img width="80%" src="/Public/img/jianshe.jpg" alt=""/>

        <?php elseif($select['id'] ==3): ?>
            <img width="80%" src="/Public/img/nongye.jpg" alt=""/>

        <?php elseif($select['id'] ==4): ?>
            <img width="80%" src="/Public/img/zhonghang.jpg" alt=""/><?php endif; ?>

    </div>

    <p class="text-center">您所在的区域：<span style="color:red"><?php echo ($area); ?></span></p>
    <p class="text-center">兑换银行：<span style="color:red"><?php echo ($select["name"]); ?></span></p>
    <div class="text-center" style="margin-top: 20px">
        <a href="<?php echo ($select["apply_url"]); ?>" class="btn btn-success" style="width:80%">点击预约</a>
        <p></p>
        <a href="<?php echo ($select["query_url"]); ?>" class="btn btn-info" style="width:80%">点击查询</a>
    </div>
</div>
</body>
</html>