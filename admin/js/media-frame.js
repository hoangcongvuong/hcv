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