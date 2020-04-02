;
/* 这里面是扩展的公共js代码 */

/**
 * 公共添加，窗口形式
 * @param title
 * @param url
 * @param w
 * @param h
 */
function common_open(title,url,w,h){
    w = w || '800px';
    h = h || '600px';
    var index = layer.open({
        type: 2,
        title: title,
        content: url,
        area: [w,h],
        maxmin: true,
    });
}

/**
 * 公共添加，全屏形式
 * @param title
 * @param url
 */
function common_open_full(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url,
    });
    layer.full(index);
}

/**
 * 公共添加，窗口形式
 * @param title
 * @param url
 * @param w
 * @param h
 */
function common_add(title,url,w,h){
    w = w || '800px';
    h = h || '600px';
    var index = layer.open({
        type: 2,
        title: title,
        content: url,
        area: [w,h],
        maxmin: true,
    });
}

/**
 * 公共添加，全屏形式
 * @param title
 * @param url
 */
function common_add_full(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url,
    });
    layer.full(index);
}

/**
 * 公共编辑，窗口形式
 * @param title
 * @param url
 * @param w
 * @param h
 */
function common_edit(title,url,w,h){
    w = w || '800px';
    h = h || '600px';
    var index = layer.open({
        type: 2,
        title: title,
        content: url,
        area: [w,h],
        maxmin: true,
    });
}

/**
 * 公共编辑，全屏形式
 * @param title
 * @param url
 */
function common_edit_full(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url,
    });
    layer.full(index);
}

/**
 * 公共删除
 * @param obj
 * @param url
 * @param id
 * @param reload_type
 */
function common_del(obj,url,id,reload_type){
    reload_type = reload_type || 1;

    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'DELETE',
            url : url,
            data: {id: id},
            dataType: "json",
            beforeSend : function(){
                //
            },
            success:function(res){
                if(res.code === 200) {
                    layer.msg(res.msg,{icon:6,time:1000},function(){
                        if(reload_type === 1){
                            location.reload();
                        }else {
                            layui.table.reload(reload_type);
                        }
                    });
                }else{
                    layer.msg(res.msg,{icon:5,time:1500},function(){
                        //
                    });
                }
            },
            error:function(){
                //
            }
        });
    });
}

/**
 * 更新
 * @param obj
 * @param url
 * @param id
 * @param tip_name
 */
function common_update(obj,url,id,tip_name){
    tip_name = tip_name || '处理';
    layer.confirm('确认要'+tip_name+'吗？',function(index){
        $.ajax({
            type: "post",
            url : url,
            data: {"id":id},
            dataType: "json",
            beforeSend : function(){
                //
            },
            success:function(res){
                if(res.code === 200) {
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        location.reload();
                    });
                }else{
                    layer.msg(res.msg,{icon:2,time:1500},function(){
                        //
                    });
                }
            },
            error:function(){
                //
            }
        });
    });
}

//关闭最新弹出层
function layer_close(){
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);
}

/**
 * 初始化日期插件
 */
function init_datetimepicker(){
    $('#datetimepicker').datetimepicker({
        format: 'yyyy-mm-dd',
        minView: "month",
        todayBtn:  1,
        autoclose: 1,
    });
}
