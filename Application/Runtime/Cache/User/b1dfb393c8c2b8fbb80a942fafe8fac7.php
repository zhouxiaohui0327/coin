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
<div class="container" style="margin-top: 50px">
    <form class="form-horizontal" action="/index.php/Index/enterPost" method="post">
        <div class="form-group">
            <label for="inputaccount" class="col-sm-2 control-label">账号</label>
            <div class="col-sm-4">
                <input type="text" name="account" class="form-control" id="inputaccount" placeholder="id">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-4">
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="password">
            </div>
        </div>
        <div>
            <div class="col-sm-offset-5 col-sm-1">
                <button type="submit" class="loginBtn btn btn-success">登录</button>
            </div>
        </div>
    </form>
</div>



</body>
</html>