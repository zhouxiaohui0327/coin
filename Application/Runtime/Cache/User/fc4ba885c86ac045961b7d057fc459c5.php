<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script type="text/javascript" src="/coin/Public/js/jquery-2.1.4.js"></script>
    <title></title>
</head>
<body>
<div class="container">
    <a href="<?php echo ($select["apply_url"]); ?>" class="btn btn-info">预约</a>
    <a href="<?php echo ($select["query_url"]); ?>" class="btn btn-success">查询</a>
</div>
<p><?php echo ($area); ?></p>
<p><?php echo ($select["name"]); ?></p>
</body>
</html>