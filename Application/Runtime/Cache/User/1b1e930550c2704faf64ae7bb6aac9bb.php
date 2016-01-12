<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <title></title>
    <script type="text/javascript" src="/coin/Public/js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="/coin/Public/js/myJs.js"></script>
    <link rel="stylesheet" type="text/css" href="/coin/Public/css/base.css" />
</head>
<body>
<header class="container-fuld clearfix">
    <a  href="javascript:loginOut()" class="loginOutBtn pull-right btn btn-danger btn-sm">退出</a>
    <p class="welcome pull-right">您好：<span><?php echo ($nickname); ?></span></p>
</header>


<div class="container">
    <div class="wrap"  style="width:2000px">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>预约开始时间</th>
                <th>预约结束时间</th>
                <th>兑换开始时间</th>
                <th>兑换结束时间</th>
                <th>央行公告链接</th>
                <th>银行未开启预约跳转链接</th>
                <th>地区与兑换银行对应关系</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>2016-01-16</td>
                <td>2016-01-28</td>
                <td>2016-01-29</td>
                <td>2016-01-31</td>
                <td>http://www.pbc.gov.cn/huobijinyinju/147948/147964/2996628/index.html</td>
                <td>http://www.baidu.com</td>
                <td>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>中国工商银行</th>
                            <th>中国农业银行</th>
                            <th>中国银行</th>
                            <th>中国建设银行</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th >浙江省，江苏省，安徽省</th>
                            <th>浙江省，江苏省，安徽省</th>
                            <th>浙江省，江苏省，安徽省</th>
                            <th>浙江省，江苏省，安徽省</th>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>




            </tbody>
        </table>
    </div>
</div>


</body>
</html>