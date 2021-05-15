<html>
<head>
    <link rel="stylesheet" href="<?=base_url()?>css/cart.css" media="screen" title="no title">
    <link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css" media="screen" title="no title">
    <link rel="stylesheet" href="<?=base_url()?>css/jquery.dataTables.css" media="screen" title="no title">
  </head>
  <body>
    <div class="row">
    <div class="col-lg-12">           
        <h3 style="text-align: center">Product Listing          
            <div class="pull-right">
                <!-- <a class="btn btn-primary add_user" id="add_product" style="margin-right:10px" href="javascript:void(0)"> Add</a> -->
                
                <a href="<?php echo base_url('index.php/welcome/billing_view') ?>"><button class="orderplace btn btn-primary" <?php if( count($this->cart->contents()) <= 0){ echo "disabled='disabled'"; } ?>>Place Order</button></a>

                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="javascript:opencart()">
                  <span>
                    Cart ( <span class="cartcount"><?php echo count($this->cart->contents());  ?></span> )
                  </span>
                </button>
                <a class="btn btn-primary logout" id="logout_user" style="margin-right:10px"
                 href="<?php echo base_url('index.php/User/user_logout') ?>"> Logout </a>
            </div>
        </h3>
     </div>
</div>
<div class="table-responsive" style="padding: 2%">
<table class="table table-striped" id="user_table">
  <thead>
    <tr>
      <th scope="col">Index</th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Short Description</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
     <?php foreach ($product_list as $key => $val) {?>  
      <tr>
        <th scope="row"><?php echo $key+1?></th>
        <td class="image<?php echo $val['ProductId']?>" rel="<?php echo $val['Image'] ?>"><img src="<?=base_url()?>images/<?= $val['Image']?>" height="70" width="70"></td>
        <td class="name<?php echo $val['ProductId']?>" rel="<?php echo $val['ProductId'] ?>"><?php echo $val['ProductName']?></td>
        <td><?php echo $val['ShortDescription']?></td>
        <td><?php 
            $descArr= explode(",",$val['Description']);?>
            <ul>
              <?php foreach ($descArr as $key => $value) { ?>
                <li><?php echo $value?></li>
              <?php } ?>
            </ul>
        </td>
        <td class="price<?php echo $val['ProductId']?>" rel="<?php echo str_replace(',', '',$val['Price']) ?>">Rs. <?php echo $val['Price']?> /-</td>
        <td><?php echo $val['Status']?></td>
        <td>
          <?php if($val['Status']!='Inactive'){?>
            <a class="btn btn-primary add_cart" p_id="<?php echo $val['ProductId']?>" id="cart<?php echo $val['ProductId']?>"><span>Add To Cart</span></a>
          <?php } ?> 
        </td>    
      </tr>
     <?php } ?>
  </tbody>
</table>
  </body>
</html>
<div class="modal fade bs-example-modal-lg displaycontent" id="exampleModal" tabindex="-1" >
<script type="text/javascript" src="<?=base_url()?>js/jquery.min.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/additional-methods.min.js" ></script>
<script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?=base_url()?>js/product.js" ></script>
<script>
    var site_url = "<?=$this->config->item('site_url')?>";
    $('#user_table').DataTable();
</script>
