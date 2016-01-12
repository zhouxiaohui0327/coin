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
    <div class="bank_icon">
        <img width="100%" src="/Public/img/zhonghang.jpg" alt=""/>
    </div>

    <p class="text-center">您所在的区域：<span style="color:red"><?php echo ($area); ?></span></p>
    <p class="text-center">兑换银行：<span style="color:red"><?php echo ($select["name"]); ?></span></p>
    <div class="text-center" style="margin-top: 20px">
        <a href="<?php echo ($select["apply_url"]); ?>" class="btn btn-success" style="margin-right: 5px;">预约</a>
        <a href="<?php echo ($select["query_url"]); ?>" class="btn btn-info" style="margin-left: 5px;">查询</a>
    </div>
</div>
</body>
</html>