<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cart Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php error_reporting(E_ALL & ~E_NOTICE);
 ?>
<div class="container">
  <h2>Cart Details</h2>
  <table class="table">
    <thead>
      <tr class="success">
        <th>QTY </th>
        <th>Item Description</th>
        <th>Item Price</th>
        <th>Sub-Total</th>
        <th>Remove Item</th>
      </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($this->cart->contents() as $items): ?>

      <tr class="danger">
      <input type="hidden" name="rowid" id="rowid" value="<?php echo $items['rowid']; ?>">  
        <td><input type="text" id="qtty" class="form-control" name="qtty" value="<?php echo $items['qty']; ?>" onchange="update(this.value,'<?php echo $items['rowid']; ?>');" style="width:60px"></td>
        <td><?php echo $items['name']; ?>
            <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
              <p>
          <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

            <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

          <?php endforeach; ?>
        </p>

        <?php endif; ?>
        </td>
        <td>Rs.<?php echo $this->cart->format_number($items['price']); ?></td>
        <td>Rs.<?php echo $this->cart->format_number($items['subtotal']); ?></td>
        <td style="text-align: center;"><?php echo anchor('Login/removeCartItem/'.$items['rowid'],'x'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php endforeach; ?>
      <tr>
        <td colspan="3"></td>
        <td>Total</td>
        <td>Rs.<?php echo $this->cart->format_number($this->cart->total()); ?></td>
      </tr>
    </tbody>
  </table>
  <!--<button id="order_id" class="order_class" onclick="place_order('<?php// echo $items['rowid']; ?>')">Place Order</button>-->
  <a href=""></a>
  <span style="float:right;"><?php echo anchor('Login/view_product','Continue Shopping  '); ?>

</div>

</body>
</html>
<script type="text/javascript">
function update(qty,rowid){
    var row_id = rowid;
    var quantity = qty;
    if(quantity>=0){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>/Login/cart_update',
        type: 'post',
        data: {quantity:quantity, rowid: row_id },
        success: function (response) {
        window.location.reload(true);
        }      
      });
      exit;
    }else{
      alert('Quantity cannot be negative');
      window.location.reload();
      return false;
      
    }
}

function place_order(id){
    alert(id);
    var unit_price = price;
    var quantity = qty;
    var product_name = name;
     $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>/Login/order',
        type: 'post',
        data: {price:unit_price, quantity:quantity, name: product_name },
        success: function (response) {
              window.location.reload(true);
        }
    });
}

</script>
