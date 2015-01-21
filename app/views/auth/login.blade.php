<!DOCTYPE html>
<html lang=zh-cn>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>登录</title>
        <link href="css/bootstrap.min.css?v=1.6" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css?v=1.6" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css?v=1.6" rel="stylesheet">

    </head>

    <body class="gray-bg">

        <div class="middle-box text-center loginscreen  animated fadeInDown">
                <div>
                    <h1 class="logo-name"><img src="img/logo.png" /></h1>
                </div>

                <h3>欢迎使用电子与信息学院团委学生会物资管理平台</h3>


                {{ Form::open(array('url' => 'login', 'class' => 'm-t text-left', 'id' => 'loginform')) }}

                    <div class="form-group">
                    {{ Form::text('username', Input::old('username'), array('name'=>'username','id'=>'username','class' => 'form-control', 'placeholder' => '用户名', 'required' => '')) }}
                    </div>

                    <div class="form-group">
                    {{ Form::password('password', array('name'=>'password','id'=>'password', 'class' => 'form-control', 'placeholder' => '密码', 'required' => '')) }}
                    </div>
        <!--
                    {{ Form::radio('remember', false) }}记住我
                    {{Form::button('登录', array('id'=>'searchbtn','class' => 'btn btn-primary block full-width m-b', 'onclick'=>'submitPost(this.form)'));}}
                       {{ Form::submit('登录', array('class' => 'btn btn-primary block full-width m-b')) }}
        -->		

                    <label>
                    {{ Form::checkbox('remember', false, array('class' => 'checkbox')) }} 记住我
                    </label>

                    {{ Form::submit('登录', array('class' => 'btn btn-primary block full-width m-b')) }}
                {{ Form::close() }}
	
        <!-- Mainly scripts -->
        <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
        <script src="js/jquery.pjax.js"></script>
        <!-- Mainly scripts -->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js?v=1.6"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/hplus.js?v=1.6"></script>
        <script src="js/plugins/pace/pace.min.js"></script>

        <!-- jQuery Validation plugin javascript-->
        <script src="js/plugins/validate/jquery.validate.min.js"></script>
        <script src="js/plugins/validate/messages_zh.min.js"></script>
        <script>
            /*  *   *   *   *   *   *   *   *   *
             *             字体等变红           *
             *  *   *   *   *   *   *   *   *   */         
            $.validator.setDefaults({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                element.closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: "span",
            errorClass: "help-block m-b-none",
            validClass: "help-block m-b-none"
             });


            /*
             *
             */
        $().ready(function () {
            // validate signup form on keyup and submit
            $("#loginform").validate({
                rules:{
                    username:"required",
                    password:"required"
                },
                messages:{
                    username:"请输入用户名",
                    password:"请输入密码"
                }
                });
        });

	        //将form转为AJAX提交
	function ajaxSubmit(frm, fn) {
	    $.ajax({
	        url: frm.action,
	        type: frm.method,
	        data: $('form#loginform').serialize(),
	        success: fn
	    });
	}
	
	 $(document).ready(function(){
	   	 $('#loginform').bind('submit', function(){
	       	 ajaxSubmit(this, function(data){
	          	 // alert(data);
	    	    });
	        return false;
	    });
	});
        </script>
    </body>
<!--
<script type='text/javascript'>
$(document).ready(function() {
    $('form#loginform').submit(function() {
        $.ajax({
            type: 'post',
            cache: false,
            dataType: 'json',
            data: $('form#loginform').serialize(),
            beforeSend: function() { 
                $("#validation-errors").hide().empty(); 
            },
            success: function(data) {
                if(data.success == false)
                {
                    var arr = data.errors;
                    $.each(arr, function(index, value)
                    {
                        if (value.length != 0)
                        {
                            $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                        }
                    });
                    $("#validation-errors").show();
                } else {
                     location.reload();
                }
            },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.Please Try again later...');
            }
        });
        return false;
    });
});
</script>

<script type="javascript">
$(document).ready(function()
{
    $(document).pjax('a', 'body');
});
</script>-->
</html>
