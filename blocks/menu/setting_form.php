<?php
$default = array(
    '0'     => array(
        'link'      => 'http://coding.vn',
        'anchor'    => 'Coding',
        'depth'     => '0'
    )
);


if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>

<script>
    $(document).ready(function(){
        $("body").on("click", ".add_child", function(){
            var parent = $(this).parent().parent();
            var depth = parseInt(parent.attr("depth")) + 1;
            var margin_left = depth*20
            var add = '<div style="margin-left:' + margin_left + 'px" class="menu-item array_form" depth="' + depth + '">\
                            <div class="represent pointer fl">New Menu</div> <div class="fr"><div class="fl action expand pointer">Expand</div> <div class="fl action add_child pointer">Add child</div><div class="fl action delete pointer">Delete</div></div>\
                            <span class="clear"></span>\
                            <div class="inner" style="display: none;">\
                                <input placeholder="Url" style="" class="form-control parameter-depth-1" parameter="link" type="text" value="" />\
                                <input placeholder="Anchor Text" class="form-control parameter-depth-1" parameter="anchor" type="text" value="" />\
                                <input placeholder="Depth" class="form-control parameter-depth-1 depth" parameter="depth" type="text" value="' + depth + '" />\
                            </div>\
                        </div>';
            $(this).parent().parent().after(add);
        })
        
        $("body").on("click", ".expand", function(){
                var parent = $(this).parent().parent();
                parent.find('.inner').each(function(){
                $(this).slideToggle();
            });
        });
        
        $("body").on("click", ".delete", function(){
                var parent = $(this).parent().parent();
                parent.remove();
        });
        
        $("body").on("change", ".depth", function(){
                var parent = $(this).parent().parent();
                parent.css("margin-left", 20*$(this).val() + "px");
        });
        
        $("body").on("click", ".add", function(){
            var depth = 0;
            var margin_left = depth*20
            var add = '<div style="margin-left:' + margin_left + 'px" class="menu-item array_form" depth="' + depth + '">\
                            <div class="represent pointer fl">New Menu</div> <div class="fr"><div class="fl action expand pointer">Expand</div> <div class="fl action add_child pointer">Add child</div><div class="fl action delete pointer">Delete</div></div>\
                            <span class="clear"></span>\
                            <div class="inner" style="display: none;">\
                                <input placeholder="Url" style="" class="form-control parameter-depth-1" parameter="link" type="text" value="" />\
                                <input placeholder="Anchor Text" class="form-control parameter-depth-1" parameter="anchor" type="text" value="" />\
                                <input placeholder="Depth" class="form-control parameter-depth-1 depth" parameter="depth" type="text" value="' + depth + '" />\
                            </div>\
                        </div>';
            $("#menu_form_setting").append(add);
        });
        
        $(".sortable").sortable();
    
    })
</script>

<style>
    input[type="text"]{
        margin-bottom:5px!important ;
    }
    .represent{
        margin:10px;
        font-weight:bold;
        margin-left:0;
    }
    .action{
        font-size:11px;
        color:red;
        margin:13px;
    }
    .menu-item {
        border: 1px solid silver;
        border-radius: 5px;
        margin: 5px 0;
        padding:0 10px
    }
    

    
</style>
<form id="menu_form_setting"  class="block_form sortable" block_id="0" type="array">
<span class="fr add pointer">(+)</span>
<span class="clear"></span><br />
<?php 
    foreach($default as $k=>$v)
    {
        ?>

        <div style="margin-left:<?php echo $v['depth']*20 ?>px" class="menu-item array_form" depth="<?php echo $v['depth'] ?>">
            <div class="represent pointer fl"><?php echo $v['anchor'] ?></div> <div class="fr"><div class="fl action expand pointer">Expand</div> <div class="fl action add_child pointer">Add child</div><div class="fl action delete pointer">Delete</div></div>
            <span class="clear"></span>
            <div class="inner" style="display: none;">
                <input placeholder="Url" class="form-control parameter-depth-1" parameter="link" type="text" value="<?php echo $v['link'] ?>" />
                <input placeholder="Anchor Text" class="form-control parameter-depth-1" parameter="anchor" type="text" value="<?php echo $v['anchor'] ?>" />
                
                <input placeholder="Depth" class="form-control parameter-depth-1 depth" parameter="depth" type="text" value="<?php echo $v['depth'] ?>" />
            </div>
        </div>
        <?php
    }
?>
</form>