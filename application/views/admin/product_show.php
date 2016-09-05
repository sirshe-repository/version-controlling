
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Viewing Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<span style="float:right; top: 12px;  position: relative;">Hi.<?php if(isset($_SESSION['user_name'])){ echo " ".$_SESSION['user_name']; } ?></span>
<a href="<?php echo base_url(); ?>Login/cart_details"><button type="button" class="btn btn-default btn-sm" style="float:right; top:10px; position:relative; right: 20px;">
    <span class="glyphicon glyphicon-shopping-cart"></span> <?php if(count($this->cart->contents())> 0){ echo (count($this->cart->contents()) )."&nbsp"."Items"; } else{ echo "No Item"; }?>
</button></a>

<div class="container">
  <h2>Product to Show</h2>
           
  <table class="table">
    <thead>
      <tr class="danger">
      	<th>Serial No</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Product Description</th>
        <th>Image</th>
        <th>Add to Cart</th>
      </tr>
    </thead>
    <tbody>
      
      <?php
		foreach($result as $val){	?>
		
			<tr class="success">
	        <td name="p_id"><?php echo $val->product_id; ?></td>
	        <td name="p_name"><?php echo $val->product_name; ?></td>
	        <td name="p_price">Rs.<?php echo $val->product_price; ?></td>
	        <td><?php echo $val->product_brand; ?></td>
	        <td><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $val->img; ?> " height='80px' width='100px' alt="No Img"/></td>
	        <td><a href="<?php echo base_url(); ?>Login/add_to_cart/<?php echo $val->product_id; ?>">Add to Cart</a></td>
	      </tr>
	   
<?php  } ?>
      
    </tbody>
  </table>
</div>

</body>
</html>
