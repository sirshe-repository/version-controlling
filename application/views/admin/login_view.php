  <!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login for User</title>
    
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/reset.css">

    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

    
    
    
  </head>

  <body>

    
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Login for User</h1>
  <?php echo validation_errors(); ?>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
  </div>
  <div class="form" id="loguser">
    <h2>Login to your account</h2>
    <form method="post" action="<?php echo base_url(); ?>Login/login_user" id="log_user">
      <input type="text" placeholder="Username" name="log_name"/>
      <input type="password" placeholder="Password" name="log_password"/>
      <button type="submit">Login</button>
    </form>
    <button id="reg_button">New User</button>
  </div>
  <div class="form" id="reguser">
    <h2>Create an account</h2>
    <form method="post" action="<?php echo base_url(); ?>Login/registration_user" id="reg_user">
      <input type="text" placeholder="Username" name="reg_name"/>
      <input type="password" placeholder="Password" name="reg_password"/>
      <input type="email" placeholder="Email Address" name="reg_eaddress"/>
      <input type="tel" placeholder="Phone Number" name="reg_telephone"/>
      <button type="submit" id="register_success">Register</button>
    </form>
  </div>
  <div class="cta"><a href="#">Forgot your password?</a></div>
  </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='<?php echo base_url(); ?>assets/js/index.js'></script>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#reg_button").click(function(){
      $("#loguser").hide();
      $("#reguser").show();
    });
});
</script>