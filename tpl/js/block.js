$(document).ready(function(){
    
    /**
     * FUNCTIONS
     */
    function open_setting_form(block_id, block_name, block_area_name)
    {
        
    }
    
    function update_area_content(update_block_area_content, area_name)
    {
        $.ajax({
            url:"http://localhost/Sites/MySites/hcv/tpl/handle_ajax.php",
            type:"post",
            data:{
                type:"update_area_content",
                update_block_area_content:update_block_area_content,
                area_name:area_name
            },
            success:function(data){               
                //alert(data)
            }
            //error:alert("error")
        })
    }
    
    function save_setting(block_id, block_name, block_area_name, item)
    {
        var i = 0;
        var key = new Array();
        var value = new Array();
        
        $("#dialog").dialog({width: 750,close:function(){$(".opacity").css("display","none");$("#dialog").remove();},buttons:[{text:"Save", click:function(){
            
            if($("#dialog").find(".array_form").length == 0)
            {
                var form_type = "form";
                $("#dialog").find(".parameter").each(function(){
                    key[i] = $(this).attr("parameter");
                    value[i] = $(this).val();
                    i++;
                });
            }
            else
            {
                var form_type = "array";
                $("#dialog").find(".array_form").each(function(){
                    var child =$(this).find(".parameter-depth-1").length;
                    if(child == 0)
                    {
                        key[i] = $(this).attr("parameter");
                        value[i] = $(this).val();
                        i++;
                    }
                    else
                    {
                        value[i] = new Array();
                        key[i] = new Array();
                        var j = 0;
                        $(this).find(".parameter-depth-1").each(function(){
                            value[i][j] = $(this).val();
                            key[i][j] = $(this).attr("parameter");
                             j++;
                        });
                        i++;
                    }
                    
                });
            }
            /*
            })*/
            
            $.ajax({
                url:"http://localhost/Sites/MySites/hcv/tpl/handle_ajax.php",
                type:"post",
                data:{
                    type:"save_setting",
                    form_type:form_type,
                    block_area_name:block_area_name,
                    block_id:block_id,
                    block_name:block_name,
                    key:key,
                    value:value
                },
                success:function(data){
                    $("#dialog").dialog("close");
                    $(".opacity").css("display","none");
                    $("#dialog").remove();
                    item.replaceWith(data);
                    //$("*[block_area_name='" + block_area_name +"']").append(data);
                    var update_block_area_content = '';
                    var j = 0;
                    $("*[block_area_name='" + block_area_name +"']").find(".block").each(function(){
                        if(j== 0) update_block_area_content +=  $(this).attr("block_id");
                        else update_block_area_content += "," + $(this).attr("block_id");
                        j++;
                    });
                    
                    update_area_content(update_block_area_content, block_area_name);            
                }
            })
        }}]});
        
    }
    
    function save_sort(block_area_name)
    {
        var update_block_area_content = '';
        var j = 0;
        $("*[block_area_name='" + block_area_name +"']").find(".block").each(function(){
            if(j== 0) update_block_area_content +=  $(this).attr("block_id");
            else update_block_area_content += "," + $(this).attr("block_id");
            j++;
        });
        //alert(update_block_area_content)
        
        update_area_content(update_block_area_content, block_area_name);     
    }
    /**
     * END FUNCTIONS
     */
    
    
    $(".draggable").draggable({cursor:"move",opacity:0.4, revert:"invalid",helper:"clone", connectToSortable:".sortable"});
    
    $(".sortable").sortable({helper:"clone", connectWith:".sortable",placeholder:"ui-state-highlight",scrollSpeed:500,revert:true,placeholder: "ui-state-highlight",forcePlaceholderSize: true,update:function(event, ui){
        var block_area_name = $(this).attr("block_area_name")
        var block_name = ui.item.attr("block_name");
        var block_id = ui.item.attr("block_id");
        if(block_id == 0)
        {
           //alert(block_id)
           $.ajax({
                url:"http://localhost/Sites/MySites/hcv/tpl/handle_ajax.php",
                type:"post",
                data:{
                    type:"load_form_setting",
                    block_name:block_name                
                },
                success:function(data){
                    $("body").append(data); // append #dialog
                    var item = ui.item;
                    save_setting(block_id, block_name, block_area_name,item);
                    
                    $("#dialog").dialog("open");
                    
                    $(".opacity").css("display","block");
                }
            }) 
        }
        else
        {
            save_sort(block_area_name);    
        }
        
    }});
    
    $("body").on("click", ".update_block", function(){
        var block = $(this).parent();
        var block_id = block.attr("block_id");
        //alert(block_id);
        var block_name = block.attr("block_name");
        var block_area_name = $(this).parent().parent().attr("block_area_name");
        $.ajax({
            url:"http://localhost/Sites/MySites/hcv/tpl/handle_ajax.php",
            type:"post",
            data:{
                type:"update_setting",
                block_name:block_name,
                block_id:block_id             
            },
            success:function(data){
                $("body").append(data);  // append #dialog
                save_setting(block_id, block_name, block_area_name,block);
                //block.replaceWith(data);
                $("#dialog").dialog("open");
                $(".opacity").css("display","block");
                
            }
        }) 
        //open_setting_form(block_id, block_name, block_area_name)
    });
    
    $("body").on("click", ".delete_block", function(){
        if(confirm("Are U Sure ?"))
        {
            var block = $(this).parent();
            var block_id = $(this).parent().attr("block_id");
            //alert(block_id);
            var block_name = $(this).parent().attr("block_name");
            var block_area_name = $(this).parent().parent().attr("block_area_name");
            $.ajax({
                url:"http://localhost/Sites/MySites/hcv/tpl/handle_ajax.php",
                type:"post",
                data:{
                    type:"delete_block",
                    block_id:block_id             
                },
                success:function(data){
                    if(data=='1') block.remove();
                    //save_setting(block_id, block_name, block_area_name);
                    //alert(data)
                    //$("#dialog").dialog("open");
                    //$(".opacity").css("display","block");
                    save_sort(block_area_name);
                    
                }
            }) 
        }
        //open_setting_form(block_id, block_name, block_area_name)
    });
    
    
    
    /**
     * Media Frame
     */
     var current_frame;
    $("#media-frame").css("left",(screen.width-960)/2  + "px");
    $("#media-frame").css("top",(screen.height-500)/2 - 100 + "px");
    
    $("body").on("click", ".show-media-frame", function(){
        $("#media-frame").css("display", "block").prepend("<iframe src='http://localhost/Sites/MySites/hcv/admin/js/index.php?multi_select=0' width='960px' height='500px'></iframe>");
        $(".opacity-frame").css("display", "block");
        current_frame = $(this).attr("particular");
    });
    
    $(".close-frame").click(function(){
        $("#media-frame").css("display", "none");
        $("#media-frame iframe").remove();
        $(".opacity-frame").css("display", "none");
    });
    
    $(".submit-frame").click(function(){
        $("iframe").contents().find(".box.active img").each(function(){
            src = $(this).attr("src");
            
            $("#" + current_frame ).val(src);
            
            $("#" + current_frame + "_display").attr("src", src);
        });
    
        $("iframe").contents().find("#insert_by_link_form").each(function(){
            $(this).find("#link_insert").each(function(){
                src = $(this).val();
            })
            $("#" + current_frame ).val(src);
            $("#" + current_frame +"_display").attr("src", src);            
        });  
        
        $("#media-frame").css("display", "none");
        $("#media-frame iframe").remove();
        $(".opacity-frame").css("display", "none");
    });
    
    $("body").on("change", "#select_image", function(){
        $("#select_image_display").attr("src", $(this).val());
    })
    
    $(".block").append('<span class="delete_block block_action"></span>\
                        <span class="update_block block_action"></span>');
    
    $( ".sortable" ).disableSelection();
    

})