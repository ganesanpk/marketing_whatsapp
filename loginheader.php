<?php
if (!isset($_SESSION['user']))  {
   header ("Location: index.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link href="custom.css" rel="stylesheet">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK">
      


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>


        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <link rel="stylesheet"  href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


      <script src="custom.js"></script>
      
</head>
<body>

   <nav  class=" navbar navbar-default navbar-fixed-top  ">
   <div class="container-fluid mt-3">
      <div class="navbar-header">
         <!-- <a class="navbar-brand">DASHBOARD</a> -->
         <ul class="nav navbar-nav navbar-left">
            <li >
               <a style="margin-left:20px">
               <img src="images/logo.jpg" class="img-circle" class="img-rounded" alt="whatsapp">
                  <bold>Dashboard</bold>
               </a>
            </li>
         </ul>
      </div>
      <ul class="nav navbar-nav navbar-right">
         <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
   </div>
</nav>








              