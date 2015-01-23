<!DOCTYPE html>
<html lang=zh-cn>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>物资管理系统</title>
    <link href="/css/bootstrap.min.css?v=1.6" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css?v=1.6" rel="stylesheet">

    <!-- Morris -->
    <link href="/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="css/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css?v=1.6" rel="stylesheet">

</head>

<body>

    @yield('sidebar')

    <!-- Mainly scripts -->
    <script src="/js/jquery-1.10.2.js"></script>
    <script src="/js/bootstrap.min.js?v=1.6"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Data Tables -->
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom and plugin javascript
        <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>

     -->
    <script src="/js/hplus.js?v=1.6"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>
    <script src="/js/jquery.pjax.js"></script>

    
    <!-- layer javascript -->
    <script src="/js/plugins/layer/layer.min.js"></script>
    <script>
        layer.use('extend/layer.ext.js'); //载入layer拓展模块
    </script>
    <script src="/js/demo/layer-demo.js"></script>

<script>
function logout(){
    $.layer({
        shade: [0],
        title: ' ',
        offset: ['200px', ''],
        area: ['auto','auto'],
        shade: [0.5, '#000'],
        shadeClose: true,
        closeBtn: [1, false],
        time: 3,
        dialog: {
            msg: 'Are You Sure to Quit?',
            btns: 2, 
            type: 4,
            btn: ['Yes','No'],
            yes: function(){
                $.post("{{ URL::route('logout') }}", 
                {
                    _method: 'delete'
                },
                function(json){
                    if(json.success==true){
                        window.location.href="{{ URL::route('login') }}";
                    }
                })
            }, 
            no: function(){
            }
        }
    });     
}
</script>

<script>
$(document).ready(function () {
    $('.dataTables-example').dataTable();

    /* Init DataTables */
    // var oTable = $(document).dataTable();
    /* Apply the jEditable handlers to the table */
/*
    oTable.$('td').editable('../example_ajax.php', {
        "callback": function (sValue, y) {
            var aPos = oTable.fnGetPosition(this);
            oTable.fnUpdate(sValue, aPos[0], aPos[1]);
        },
        "submitdata": function (value, settings) {
            return {
                "row_id": this.parentNode.getAttribute('id'),
                "column": oTable.fnGetPosition(this)[2]
            };
        },
        "width": "90%",
        "height": "100%"
    });
*/
});

/*function fnClickAddRow() {
    $('#editable').dataTable().fnAddData([
        "Custom row",
        "New row",
        "New row",
        "New row",
        "New row"]);
}*/
</script>
<script>                    //user.blade.php's javascript 

function addUser(){         //user.blade.php 新增帐号
    iframeset('{{ URL::route("user.create") }}');
}

function alterbtn(id){        //user.blade.php 修改按钮
    iframeset("{{ URL::route('user') }}" + '/' + id);
}

function delUser(id){
    layer.prompt({
        top: 'auto',
        type : 1,
        title: '输入密码以确认删除!!'
    }, function(val){
        $.post(
            "{{ URL::route('user') }}" + '/' + id,
            {
                _method : 'delete', 
                password : val
            },
            function (json){
                if(json.success == true){
                    layer.msg('删除成功!',2,function(){
                        location.reload();
                    });
                }else{
                    layer.msg(json.error,2,2);
                }
        });
    });
}

function iframeset(srcurl){
    var pageii = $.layer({
        type: 2,
        offset:['100px',''],
        //shade: [0],
        closeBtn: [0, true],
        shadeClose: true,
        area: ['450px', '400px'],
        title: false,
        border: [0],
        iframe: {
            src: srcurl,
            scrolling: 'auto'
            }
        });
        //layer.load(1);
}
</script>

<script>
/*******************************
 * @author Mr.Think
 * @author blog http://mrthink.net/
 * @2011.12.09
 * @可自由转载及使用,但请注明版权归属
 *******************************/
$.fn.iVaryVal=function(iSet,CallBack){
    /*
     * Minus:点击元素--减小
     * Add:点击元素--增加
     * Input:表单元素
     * Min:表单的最小值，非负整数
     * Max:表单的最大值，正整数
     */
    iSet=$.extend({Minus:$('.J_minus'),Add:$('.J_add'),Input:$('.J_input'),Min:0,Max:20},iSet);
    var C=null,O=null;
    //插件返回值
    var $CB={};
    //增加
    iSet.Add.each(function(i){
        $(this).click(function(){
            O=parseInt(iSet.Input.eq(i).val());
            (O+1<=iSet.Max) || (iSet.Max==null) ? iSet.Input.eq(i).val(O+1) : iSet.Input.eq(i).val(iSet.Max);
            //输出当前改变后的值
            $CB.val=iSet.Input.eq(i).val();
            $CB.index=i;
            //回调函数
            if (typeof CallBack == 'function') {
                CallBack($CB.val,$CB.index);
            }
        });
    });
    //减少
    iSet.Minus.each(function(i){
        $(this).click(function(){
            O=parseInt(iSet.Input.eq(i).val());
            O-1<iSet.Min ? iSet.Input.eq(i).val(iSet.Min) : iSet.Input.eq(i).val(O-1);
            $CB.val=iSet.Input.eq(i).val();
            $CB.index=i;
            //回调函数
            if (typeof CallBack == 'function') {
                CallBack($CB.val,$CB.index);
            }
        });
    });
    //手动
    iSet.Input.bind({
        'click':function(){
            O=parseInt($(this).val());
            $(this).select();
        },
        'keyup':function(e){
            if($(this).val()!=''){
                C=parseInt($(this).val());
                //非负整数判断
                if(/^[1-9]\d*|0$/.test(C)){
                    $(this).val(C);
                    O=C;
                }else{
                    $(this).val(O);
                }
            }
            //键盘控制：上右--加，下左--减
            if(e.keyCode==38 || e.keyCode==39){
                iSet.Add.eq(iSet.Input.index(this)).click();
            }
            if(e.keyCode==37 || e.keyCode==40){
                iSet.Minus.eq(iSet.Input.index(this)).click();
            }
            //输出当前改变后的值
            $CB.val=$(this).val();
            $CB.index=iSet.Input.index(this);
            //回调函数
            if (typeof CallBack == 'function') {
                CallBack($CB.val,$CB.index);
            }
        },
        'blur':function(){
            $(this).trigger('keyup');
            if($(this).val()==''){
                $(this).val(O);
            }
            //判断输入值是否超出最大最小值
            if(iSet.Max){
                if(O>iSet.Max){
                    $(this).val(iSet.Max);
                }
            }
            if(O<iSet.Min){
                $(this).val(iSet.Min);
            }
            //输出当前改变后的值
            $CB.val=$(this).val();
            $CB.index=iSet.Input.index(this);
            //回调函数
            if (typeof CallBack == 'function') {
                CallBack($CB.val,$CB.index);
            }
        }
    });
}
//调用
$( function() {
    $('.i_box').iVaryVal({},function(value,index){
        $('.i_tips').html('你点击的表单索引是：'+index+'；改变后的表单值是：'+value);
    });
    
});
</script>

</body>
</html>
