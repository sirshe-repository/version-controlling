
<?php echo form_open_multipart('Login/add_product');?>
<?php echo validation_errors(); ?>
  <div class="col-xs-4">
    <label for="ex3">Product Name:</label>
    <input class="form-control" id="ex3" type="text" name="name" value=>
  </div>
  <div class="col-xs-4">
    <label for="ex3">Product Price:</label>
    <input class="form-control" id="ex4" type="text" name="price">
  </div>
  <div class="col-xs-4">
    <label for="ex3">Product Description:</label>
     <textarea class="form-control" rows="5" id="comment" name="description"></textarea>
  </div>
  <div class="col-xs-4">
    <label for="ex3">Product Image:</label>
    <input type="file" name="image_file">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
