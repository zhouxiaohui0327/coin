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
    <div style="margin-top: 100px">
        <p class="text-center" style="font-size: 25px;">SIGN IN</p>
        <form class="form-horizontal" action="/index.php/Index/enterPost" method="post">
            <div class="form-group">
                <label for="inputaccount" class="sr-only col-sm-2 control-label">账号</label>
                <div class="col-sm-offset-2 col-sm-4">
                    <input type="text" name="account" class="form-control" id="inputaccount" placeholder="账号">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only col-sm-2 control-label">密码</label>
                <div class="col-sm-offset-2 col-sm-4">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="密码">
                </div>
            </div>
            <div>
                <div class="text-center">
                    <button type="submit" class="loginBtn btn btn-default">登录</button>
                </div>
            </div>
        </form>
    </div>
</div>



</body>
</html>