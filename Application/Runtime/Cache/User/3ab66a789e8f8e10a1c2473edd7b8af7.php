<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="/Public/js/jquery-2.1.4.js"></script>
    <link rel="stylesheet" href="/Public/css/select.css"/>
    <title></title>
</head>
<body>
<div class="container" style="padding: 0">
    <div style="margin-top: 50px;margin-bottom: 30px;">
        <p class="text-center" style="color:red">非常抱歉，目前不在预约时间段</p>
    </div>
    <div class="text-center">
        <a class="btn btn-info btn-sm text-center" style="width:80%" href="<?php echo ($coinInfo['notice_url']); ?>">点击查看央行公告</a>
    </div>
    <div class="text-center" style="margin-top: 20px">
        <a class="btn btn-success btn-sm text-center" style="width:80%" href="http://shequ.yunzhijia.com/thirdapp/forum/network/56946d80e4b01b76b8595ed2">去论坛逛逛</a>
    </div>
</div>

</body>
</html>