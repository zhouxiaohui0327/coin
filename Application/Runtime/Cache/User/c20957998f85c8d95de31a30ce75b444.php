<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/base.css" />
    <title></title>
    <style>
        img{
            width: 100%;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body>
<div class="content container" style="margin-top: 10px">
    <?php if($content==''): ?>您的内容走丢了...<?php endif; ?>
    <?php echo ($content); ?>
</div>

</body>
</html>