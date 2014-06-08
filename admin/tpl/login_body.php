<div class="container text-center">
    <div class="row">
        <form  role="form" class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 text-left clearfix" action="" method="POST">
            <p class="form-group text-center">
                <img class="img-responsive center-block" src="images/logo.png" />
            </p>
            <?php
           	if(isset($_POST['submit'])) : 
            ?>
            <p style="padding: 10px;" class="form-group bg-danger">Sai User Name hoặc Password</p>
            <?php
            endif;	
            ?>
            <p class="form-group">
                <label class="" for="name">User Name</label>
                <br />
                <input class="form-control" id="name" value="" type="text" name="name" />
                
            </p>
            
            <p class="form-group">
                <label class="" for="password">Password</label>
                <br />
                <input class="form-control" id="password" value="" type="password" name="password" />
            </p>
            
            <p class="form-group text-right">
                <input class="btn btn-info btn-md" id="submit" value="Login" type="submit" name="submit" />
            </p>
        </form>
    </div>
</div>