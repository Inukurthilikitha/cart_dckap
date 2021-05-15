<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" id="bill_info">
    <?php
        $grand_total = 0;
        // Calculate grand total.
        if ($cart = $this->cart->contents()):
        foreach ($cart as $data):
        $grand_total = $grand_total + $data['subtotal'];
        endforeach;
        endif;
    ?>
    <h1 align="left">Billing Info</h1>
    <form class="form-horizontal" name="billing" method="post" action="<?php echo site_url('welcome/save_order') ?>">
        <div class="form-group">
          <label class="control-label col-sm-4" for="ordertotal">Order Total:</label>
          <div class="col-sm-4">
            <strong>INR <?php echo $grand_total; ?></strong>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="ordertotal">Continue with logged user address</label>
          <div class="col-sm-4">
            <input type="checkbox" name="loggedaddress" id="loggedaddress" onclick="javascript:addressCheck()">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="username">Name:</label>
          <div class="col-sm-4">
            <input type="username" class="form-control" name="username" id="username" placeholder="Enter User Name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="useremail">Email:</label>
          <div class="col-sm-4">
            <input type="useremail" class="form-control" name="useremail" id="useremail" placeholder="Enter Email">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="userphone">Phone:</label>
          <div class="col-sm-4">          
            <input type="userphone" class="form-control" name="userphone" id="userphone" placeholder="Enter Phone">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="useraddress">Address:</label>
          <div class="col-sm-4">          
            <input type="useraddress" class="form-control" name="useraddress" id="useraddress" placeholder="Enter Address">
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <input type="hidden" id="usertype" name="usertype" value="exists">
            <input type="hidden" id="userid" name="userid" value="">
            <a class="btn btn-default" href="<?php echo site_url()?>/product_list">Back</a>
            <button type="submit" class="btn btn-default">Place Order</button>
          </div>
        </div>
    </form>
</div>
</body>
</html>
<script type="text/javascript">
  var site_url = "<?=$this->config->item('site_url')?>";
  function addressCheck(){
    if($("#loggedaddress").prop("checked") == true ){
      $.ajax({
          type: "POST",
          url: site_url + "welcome/get_user_data",
          success: function (response) {
            res = JSON.parse(response)
            $("#username").val(res.Name).attr('readonly',true);
            $("#useremail").val(res.Email).attr('readonly',true);
            $("#userphone").val(res.Phone).attr('readonly',true);
            $("#useraddress").val(res.Address).attr('readonly',true);
            $("#usertype").val('exists');
            $("#userid").val(res.UserId);
          }
      })
    }else{
      $("#username").val('').attr('readonly',false);
      $("#useremail").val('').attr('readonly',false);
      $("#userphone").val('').attr('readonly',false);
      $("#useraddress").val('').attr('readonly',false);
      $("#usertype").val("new");
      $("#userid").val('');
    }
  }
</script>