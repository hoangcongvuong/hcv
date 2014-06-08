<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>
<section class="wrap-full" id="wrap-footer">

<div class="full" id="footer">
    <div class="col1 col">
        <?php views_BlockArea::display_area('footer-col1') ?>
    </div>
    <div class="col2 col">
        <h3>Danh mục</h3>
        <?php views_BlockArea::display_area('footer-col2') ?>
    </div>
    <div class="col3 col">
        <h3>Thông tin liên hệ</h3>
        <?php views_BlockArea::display_area('footer-col3') ?>
    </div>
    <div class="col4 col"  id="register-email">
        <div class="fl item email">
            <p class="line1 uppercase">Đăng ký nhận thư điện tử</p>
            <p class="line2">
                <input type="text" />
                <input class="pointer" type="button" value="Đăng ký" />
            </p>
        </div>
    </div>
    <span class="clear"></span>
</div>
<span class="clear"></span>
</section>
<footer id="coppyright" class="wrap-full">@2014 Vngit.com</footer>

<?php //views_BlockArea::display_area('top-banner') ?>


</body>

</html>

