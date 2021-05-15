<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin panel</title>
  <link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css" media="screen" title="no title">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css">
  </head>
  <body style="background-color: #000">

    <div class="container" style="margin-top:10%">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
              <span><img src="<?=base_url()?>images/user_image.png" height="60" width="60" style="    margin: 5% 43%;"></span>
                <div class="">
                    <h3 class="panel-title" style="text-align: center;">Login</h3>
                </div>
                <?php
                  $success_msg= $this->session->flashdata('success_msg');
                  $error_msg= $this->session->flashdata('error_msg');
                  if($success_msg){
                    ?>
                    <div class="alert alert-success">
                      <?php echo $success_msg; ?>
                    </div>
                  <?php
                  }
                  if($error_msg){
                    ?>
                    <div class="alert alert-danger">
                      <?php echo $error_msg; ?>
                    </div>
                    <?php
                  }
                  ?>

                <div class="panel-body">
                    <form role="form" method="post" id="login_form">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="User Name" name="email" type="text" autofocus id="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" id="password">
                            </div>


                                <input class="btn btn-lg btn-success btn-block" type="submit" value="SIGN IN" name="login" id="sign_in">

                        </fieldset>
                    </form> 
              <!--   <center><b>You are not registered ?</b> <br></b><a href="<?php echo base_url('user/'); ?>">Register here</a></center> --><!--for centered text-->

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
  var site_url = "<?=$this->config->item('site_url')?>";
</script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.min.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/additional-methods.min.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/index.js" ></script>