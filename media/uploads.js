$(document).ready(function(){
    
    /**
     * For upload attachment
     */
    $("#virtual_select_file").click(function(){
        $("#hcv_upload_button").click();
    });
    
    $("#hcv_upload_button").change(function(){
        $("#upload_instant").click();
    });
    
    $("body").on("click", ".box img", function(){
        $(this).parent().toggleClass("active");
        $(this).toggleClass("active");
    });
    
    
    
    /**
     * Change Attributes for attachment
     */
    $("body").on("submit", ".box form", function(){
        var parent_stt = $(this).parent().attr("stt");        
        $.ajax({
            url:                "ajax_handle.php",
            async:              true,
            type:               "POST",
            data:{
                type:           "update_attribute",
                attachment_url:  parent_stt,
                new_title:      $(".box[stt='" + parent_stt + "'] .title").val(),
                new_alt:        $(".box[stt='" + parent_stt + "'] .alt").val()
            },
            success:function(data){
                if(data == '1')
                {
                    $(".box[stt='" + parent_stt + "'] .noti").empty().append("Save Success").css("opacity","1").animate(
                        {
                            "opacity" : 0
                        }, 2000
                    );
                }
                else
                {
                    $(".box[stt='" + parent_stt + "'] .noti").empty().append("Save Success").css("opacity","1");
                    $(".box[stt='" + parent_stt + "'] .noti").empty().append("<span style='color:red'>" + data + "</span>");
                }
            },
            error: function(){
                alert("error")
            }
        });
        
        return false;
    });
    
    
    
    
    /**
     * Delete attachment
     */
    $("body").on("click", ".box .handle.delete", function(){
        var parent_stt = $(this).parent().attr("stt");        
        $.ajax({
            url:                "ajax_handle.php",
            async:              true,
            type:               "POST",
            data:{
                type:           "delete_attachment",
                attachment_url: parent_stt,
                new_title:      $(".box[stt='" + parent_stt + "'] .title").val(),
                new_alt:        $(".box[stt='" + parent_stt + "'] .alt").val()
            },
            success:function(data){
                if(data == '1')
                {
                    $(".box[stt='" + parent_stt + "']").remove();
                }
                else
                {
                    $(".box[stt='" + parent_stt + "'] .noti").empty().append("Save Success").css("opacity","1");
                    $(".box[stt='" + parent_stt + "'] .noti").empty().append("<span style='color:red'>" + data + "</span>");
                }
            },
            error: function(){
                alert("error")
            }
        });
        
        return false;
    });
    
    /**
     * Load more attachment
     */
     
     function load_more()
     {
        $.ajax({
            url:            "ajax_handle.php",
            type:           "POST",
            data:           {
                                type:       "load_more_gallery",
                                start:      $("#gallery img").size()
                            },
            success:        function(data)
                            {
                                $("#gallery").append(data)
                            },
            error:          function(jqXHR, textStatus, errorThrown)
                            {
                                alert("error : " + textStatus);
                            }
        })
     }
     $(document).scroll(function(){
        if($("#end-gallery").offset().top <= $("#load-more-point").offset().top)
        {
            load_more();
        }
     });
     $("#button-load-more").click(function(){
        load_more()
     })
    
    
    $("#link_insert").change(function(){
        $("#display img").attr("src", $(this).val());
    });
    
    
    
    $("body").on("click",".box .setting_icon", function(){
        var parent_stt = $(this).parent().attr("stt");
        $(".box[stt='" + parent_stt + "'] .attribute").css("display", "block");
    });
    
    $("body").on("click", ".box .close_attribute_form", function(){
        $(this).parent().css("display", "none");
    });
    
    
    
})