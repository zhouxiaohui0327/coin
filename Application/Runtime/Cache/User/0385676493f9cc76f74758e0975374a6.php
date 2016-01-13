<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!--<script type="text/javascript" src="/Public/js/jquery-2.1.4.js"></script>-->
    <script src="/Public/js/jquery-2.1.4.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="Public/css/select.css" />-->
    <link rel="stylesheet" href="/Public/css/select.css"/>
    <title></title>
</head>
<body>
<header>
    <h3 class="text-center">纪念币预约、兑换银行查询</h3>
</header>

<div class="container">
    <form action="/index.php/Coin/selectPost?coin_id=1" class="form-horizontal" method="get" >
        <div class="form-group">
            <label class="control-label col-md-5 text-center" style="display:block">--请选择地区--</label>
            <div class="col-sm-2">
                <select name="area" class="form-control">
                    <option value="<?php echo ($area[1]); ?>"><?php echo ($area[0]); ?></option>
                    <option value="北京">北京</option>
                    <option value="重庆">重庆</option>
                    <option value="江苏">江苏</option>
                    <option value="湖北">湖北</option>
                    <option value="广西">广西</option>
                    <option value="安徽">安徽</option>
                    <option value="贵州">贵州</option>
                    <option value="宁夏">宁夏</option>
                    <option value="辽宁">辽宁</option>
                    <option value="浙江">浙江</option>
                    <option value="湖南">湖南</option>
                    <option value="广东">广东</option>
                    <option value="四川">四川</option>
                    <option value="西藏">西藏</option>
                    <option value="青海">青海</option>
                    <option value="新疆">新疆</option>
                    <option value="天津">天津</option>
                    <option value="河北">河北</option>
                    <option value="山西">山西</option>
                    <option value="黑龙江">黑龙江</option>
                    <option value="河南">河南</option>
                    <option value="江西">江西</option>
                    <option value="甘肃">甘肃</option>
                    <option value="深圳">深圳</option>
                    <option value="内蒙古">内蒙古</option>
                    <option value="吉林">吉林</option>
                    <option value="上海">上海</option>
                    <option value="福建">福建</option>
                    <option value="山东">山东</option>
                    <option value="海南">海南</option>
                    <option value="云南">云南</option>
                    <option value="陕西">陕西</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="text-center">
                <button class="btn btn-info next" type="submit"  value="">下一步</button>
            </div>
        </div>
    </form>
</div>


</body>
</html>