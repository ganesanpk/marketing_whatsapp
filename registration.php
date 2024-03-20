<?php
session_start();
 
if (isset($_SESSION['user'])) {
    header("Location: home.php");
}
?>
<?php 
   include 'registerheader.php';
?>
<div class="col-md-3"></div>
<div class=" break col-md-6 well">
   <h3 class="text-primary  text-center">User Register</h3>
   <hr style="border-top:1px dotted #ccc;"/>
   <div class="col-md-2"></div>
   <div class="col-md-8">
      <form action="registerquery.php" method="POST">
         <h4 class="text-success">Register here...</h4>
         <hr style="border-top:1px groovy #000;">
         <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required />
         </div>
         <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" name="phonenumber" required 
               pattern=".{10}" 
               title="Please enter valid phone number"/>
         </div>
         <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required
                
               title="Please enter valid email" />
         </div>
         <div class="form-group">
            <label>Company</label>
            <input type="text" class="form-control" name="company" required />
         </div>
         <div class="form-group">
            <label> Password</label>
            <input type="password" class="form-control" name="password" id="password" required 
               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            <br><br>
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" onchange="check()" required />
            <span class="color" id='message'></span>
         </div>

         <!-- <div class="form-group">
        <label for="user_roles">User_roles:</label>
        <select name="user_roles" class="form-control">
        <option value="" required>Select roles</option>
        <option value="1">Admin</option>
        <option value="2">Regular User</option>
        </select>
         </div> -->
         <br>
         <br>
         <br>

         <div class="form-group">
            <button style="font-size:14px;" class="btn btn-success btn-lg glyphicon glyphicon-check" name="register" id="register"> Register</button>
            <a style="float:right; font-size:14px;" class="btn btn-success btn-lg  glyphicon glyphicon-circle-arrow-left" href="index.php"> Back</a>
         </div>
      </form>
   </div>
</div>
<?php
   include 'footer.php';
?>

   