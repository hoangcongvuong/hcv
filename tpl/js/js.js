$(document).ready(function(){
    $("#web-particular .nav li").hover(function(){
        var tab_active = $(this).attr("stt");
        $("#web-particular .main-content").css("left", -1100*(parseInt(tab_active) -1) + "px");
        //$("#web-particular .main-content .tab" + tab_active).css("display", "block");
        var left_arrow = 0;
        for(var i=1;i<parseInt(tab_active);i++)
        {
            left_arrow += $("#web-particular .nav li.tab" + i).width() + 40;
        }
        left_arrow =  left_arrow + ($("#web-particular .nav li.tab" + i).width() + 40) / 2;
        $("#web-particular .nav .arrow").css("left",left_arrow + "px");
    });
    
    /*$("a").click(function(){
        var target_page = $(this).attr("href");
        $.ajax({
				url:target_page,
                type:"post",
                data:{vngit:"vngit"},
				success:function(data){
					//alert(url)
					$("#main").html(data);
				}
			});
			if(target_page!=window.location){
			window.history.pushState({path:target_page},'',target_page);
			}
			//stop refreshing to the page given in
			return false;
    })*/
    
    $(window).on('popstate', function() {
		$.ajax({url:location.pathname+'?rel=tab',success: function(data){
			$('#content').html(data);
		}});
	});
    
    
    var count_webtype = $(".web-type").size();
    
    $(".area_web-type").css("width", count_webtype*245 + "px" )
})