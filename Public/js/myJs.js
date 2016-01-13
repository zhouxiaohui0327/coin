/**
 * Created by Admin on 2016/1/11.
 */
function loginOut() {
    if (confirm("确定要退出？")) {
        self.location = '/index.php/Index/enter';
    }
}

//$(document).ready(function(){
//    $(".loginBtn").click(function(e){
//        var account = $("input[name=account]").val();
//        var password = $("input[name=password]").val();
//        e.preventDefault();
//        $.ajax({
//            url:'http://127.0.0.1/coin/index.php/Index/enter',
//            type:'post',
//            data:{account:account,password:password},
//            dataType:'json',
//            success: function(data){
//                if(data.state==0){
//                    alert(data.info);
//                    window.self.href='http://127.0.0.1/coin/index.php/Index/admin';
//                }else
//                {
//                    alert(data.info);
//                }
//            },
//            error:function(error){
//                console.log(error);
//            }
//        });
//        return false;
//    })
//})