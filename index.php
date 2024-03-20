<?php
   error_reporting(E_ALL);
   ini_set('display_errors', '1');
   //start the php session
    session_start();
   require_once 'database.php';
   if (isset($_SESSION['user']))  {
   	header ("Location: home.php");
   }  
?>
<?php
   include 'header.php';
   ?>
<div class="col-md-3"></div>
<div class="col-md-6 well index">
   <h3 class="text-primary  text-center">Whatsapp Login</h3>
   <hr style="border-top:1px dotted #ccc;"/>
   <div class="col-md-2"></div>
   <div class="col-md-8">
      <?php 
         //Display the status message
         if(isset($_SESSION['message'])): 
      ?>
      <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg"><?php echo $_SESSION['message']['text'] ?></div>
      <script>
         (function() {
         	// removing the message 3 seconds after the page load
         	setTimeout(function(){
         		document.querySelector('.msg').remove();
         	},3000)
         })();
      </script>
      <?php 
         endif;
         // clearing the message
         unset($_SESSION['message']);
      ?>
      <form action="login_query.php" method="POST">
         <h4 class="text-success">Login here...</h4>
         <hr style="border-top:1px groovy #000;">
         <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required
                
               title="Please enter valid email" />
         </div>
         <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" required/>
         </div>
         <br />
         <div class="form-group">
            <button style="font-size:14px; font-family:Glyphicons Halflings;" class="btn btn-success btn-lg" name="login"><span class="glyphicon glyphicon-log-out"></span>  Login</button>
            <a  style="float:right; font-size:14px;" class="btn btn-success btn-lg glyphicon glyphicon-user" href="registration.php"> Registration</a>
         </div>
      </form>
   </div>
</div>
<?php
include 'footer.php';
?>