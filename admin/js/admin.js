$(document).ready(function(){
    function convert_string(old)
    {
        var result = "";
        var lowercase = old.toLowerCase();
        var latin = [ ["-", "^", ",", " ", ".", "!", "@", "#", "$", "%", "&", "*", "(", ")", "=", "~", "`"], ["d", "đ"], ["a", "à", "á", "ả", "ã", "ạ", "ă", "ằ", "ắ", "ẳ", "ẵ", "ặ", "â", "ầ", "ấ", "ẩ", "ẫ", "ậ"], ["e", "è", "é", "ẻ", "ẽ", "ẹ", "ê", "ề", "ế", "ể", "ễ", "ệ"], ["i", "ì", "í", "ỉ", "ĩ", "ị"], ["o", "ò", "ó", "ỏ", "õ", "ọ", "ô", "ồ", "ố", "ổ", "ỗ", "ộ", "ơ", "ờ", "ớ", "ở", "ỡ", "ợ"], ["u", "ù", "ú", "ủ", "ũ", "ụ", "ư", "ừ", "ứ", "ử", "ữ", "ự"], ["y", "ỳ", "ý", "ỷ", "ỹ", "ỵ"]]
        var input_array = lowercase.split("");
        var last = true;
        for(x in input_array)
        {        
            last = true;
            if(input_array[x]==" ")
            {
                result+="-";
                continue;   
            }
            for(y in latin)
            {
                
                for(z in latin[y])
                {
                    if( z!=0 )
                    {
                       if(input_array[x] == latin[y][z])
                       {
                         result += latin[y][0];
                         last = false;
                       }
                    }
                }
                                
            }
            if(last == true) result += input_array[x];
            
            //$("body").prepend(input_array[x])
        }
       
        return result;
    }
    
     /**
     * Media Frame
     */
     var current_frame;
    $("#media-frame").css("left",(screen.width-960)/2  + "px");
    $("#media-frame").css("top",(screen.height-500)/2 - 100 + "px");
    
    $(".show-media-frame").click(function(){
        $("#media-frame").css("display", "block").prepend("<iframe src='js/index.php?multi_select=0' width='960px' height='500px'></iframe>");
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
    
    
    /**
     * Auto create pretty url when write title
     */
    $("#form_content .the_title").change(function(){
        //var title = 
        $("#form_content .the_url.Publish").val(convert_string($("#form_content .the_title").val()))
        $("#form_content .the_url.Add").val(convert_string($("#form_content .the_title").val()))
    });
    

    $(".all .delete_post").click(function(){
        var post_id = $(this).parent().parent().attr("particular");
        //$(this).parent().parent().slideUp();
        $.ajax({
            url:"handle_ajax.php",
            type:"post",
            data:{type:"delete_post",post_id:post_id},
            success:function(data){
                if(data == '0') alert("Delete Failed");
                else $(".all div[particular='" + post_id + "']").slideUp(500,function(){$(this).remove()});
                $("#notification").empty().append(data);
            }
        })
    })
   
    $(".all .delete_category").click(function(){
        var category_id = $(this).parent().parent().attr("particular");
        //alert(category_id)
        if(confirm("Are U sure ? "))
        {
            $.ajax({
                url:"handle_ajax.php",
                type:"post",
                data:{type:"delete_category",category_id:category_id},
                success:function(data){
                    if(data == '0') alert("Delete Failed");
                    else $(".all div[particular='" + category_id + "']").slideUp(500,function(){$(this).remove()});
                    $("#notification").empty().append(data);
                }
            })
        }
        
    });
    
    
    $(".all .delete_block_area").click(function(){
        var block_area_id = $(this).parent().parent().attr("particular");
        //alert(category_id)
        if(confirm("Are U sure ? "))
        {
            $.ajax({
                url:"handle_ajax.php",
                type:"post",
                data:{type:"delete_block_area",block_area_id:block_area_id},
                success:function(data){
                    if(data == '0') alert("Delete Failed");
                    else $(".all div[particular='" + block_area_id + "']").slideUp(500,function(){$(this).remove()});
                    $("#notification").empty().append(data);
                }
            })
        }
        
    });
    
})
