<?php
   error_reporting(E_ALL);
   ini_set('display_errors', '1');
   
   	require 'database.php';
   	//start the php session     
   	session_start();  	
   
       if (!isset($_SESSION['user']))  {
           header ("Location: index.php");
       }  
	   
   ?>
<?php
   include 'loginheader.php';
   include 'sidebar.php';
   ?>
     <div class=" content">            
               
  
<div class="col-md-2"></div>
<div class=" margin col-md-12 well ">
   <h3 class="text-primary">Dashboard</h3>
   <hr style="border-top:1px dotted #ccc;"/>
   <div class="col-md-2"></div>
   <div class="col-md-8">
   
      <?php if(isset($_SESSION['message'])): ?>
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
      <?php
         $id = $_SESSION['user'];
         $sql = $conn->prepare("SELECT * FROM `user` WHERE `userid`='$id'");
         $sql->execute();
         $fetch = $sql->fetch();
       
         ?>
      <!-- <div class=text-center>
         <h4><?php echo $fetch['name']." ". $fetch['email']?></h4>
        </div>
      <br> -->


      <?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    
    // Assuming $_SESSION['user'] contains the ID of the current user
    $userid = $_SESSION['user'];
    
    // Prepare SQL query to fetch user's role
    $sql_role = "SELECT ur.roles_name FROM user_roles ur JOIN user u ON ur.id = u.role_id WHERE userid = ?";
    $query_role = $conn->prepare($sql_role);
    $query_role->execute([$userid]);
    
    // Fetch user's role
    $user_role = $query_role->fetch(PDO::FETCH_ASSOC)['roles_name'];
    
    // Check user's role and construct query accordingly
    if ($user_role == 'admin') {
        $sql = "SELECT * FROM `campaign`";
        $query = $conn->prepare($sql);
        $query->execute();
    } elseif ($user_role == 'regular_user') {
        $sql = "SELECT * FROM `campaign` WHERE `userid` = ?";
        $query = $conn->prepare($sql);
        $query->execute([$userid]);
    }
    
    // Fetch campaign data based on user's role
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    
    // Process fetched data as needed
    
    

    if ($fetch) {
        ?>
        <div class="tab">
            <h4 class="text-center">Campaign Information</h4>
            <table class="table table-striped table-hover" id="Table">
                <thead>
                <tr>
                    
                    <th>No</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($fetch as $index => $row):
                   
                    $StartDate = date('Y-m-d', intval($row['StartDate']));
                    $EndDate = date('Y-m-d', intval($row['EndDate']));

                    ?>

                    <tr>
                       
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $StartDate ?></td>
                        <td><?php echo $EndDate?></td>        
                    </tr>
                <?php  endforeach; ?>
                </tbody>
            </table>
       </div>
       <?php
    } else {
        ?>
        <div class="tab">
        <h4 class="text-center">Campaign Information</h4>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4" class="text-center">No data found in dashboard.</td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php
    }
?>

<br>
<br>



    <?php
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
         
            
// Assuming $_SESSION['user'] contains the ID of the current user
$userid = $_SESSION['user'];

// Prepare SQL query to fetch user's role
$sql_role = "SELECT ur.roles_name FROM user_roles ur JOIN user u ON ur.id = u.role_id WHERE userid = ?";
$query_role = $conn->prepare($sql_role);
$query_role->execute([$userid]);

// Fetch user's role
$user_role = $query_role->fetch(PDO::FETCH_ASSOC)['roles_name'];

// Check user's role and construct query accordingly
if ($user_role == 'admin') {
    $sql = "SELECT name, COUNT(DISTINCT userid) as userid FROM `message_group` GROUP BY name";
    $query = $conn->prepare($sql);
    $query->execute();
} else {
    $sql = "SELECT name, COUNT(DISTINCT userid) as userid FROM `message_group` WHERE `userid` = ? GROUP BY name";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
}

// Fetch message group data based on user's role
$fetch = $query->fetchAll(PDO::FETCH_ASSOC);

// Process fetched data as needed
       
           

            if ($fetch) {
                ?>
                <center>
                    <br>
                    <h4>Message Group Information</h4>
                    <br>
                    <table class="table table-striped table-hover" id ="Table">
                        <thead>
                        <tr>
                            
                            <th>No</th>
                            <th>Name</th>
                            <th>TOtal Number of users</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($fetch as $index => $row):
                            
                        
                            ?>

                            <tr>
                               
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['userid'] ?></td>          
                            </tr>
                        <?php  endforeach; ?>
                        </tbody>
                    </table>
                </center>
                <?php
    } else {
        ?>
        <div class="tab">
        <h4 class="text-center">Message Group Information</h4>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Total Number of users</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4" class="text-center">No data found in dashboard.</td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php
    }
?>






<br>
<br>


<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ... (previous code)

// Assuming $_SESSION['user'] contains the ID of the current user
$userid = $_SESSION['user'];

// Fetch campaign names
$campaignNames = array();
$sql = "SELECT campaignid, name FROM `campaign`";
$query = $conn->query($sql);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $campaignNames[$row['campaignid']] = $row['name'];
}

// Prepare SQL query to fetch user's role
$sql_role = "SELECT ur.roles_name FROM user_roles ur JOIN user u ON ur.id = u.role_id WHERE userid = ?";
$query_role = $conn->prepare($sql_role);
$query_role->execute([$userid]);

// Fetch user's role
$user_role = $query_role->fetch(PDO::FETCH_ASSOC)['roles_name'];

// Check user's role and construct query accordingly
if ($user_role == 'admin') {
    $sql = "SELECT *, status FROM `message`";
    $query = $conn->prepare($sql);
    $query->execute();
} else {
    $sql = "SELECT *, status FROM `message` WHERE `userid` = ?";
    $query = $conn->prepare($sql);
    $query->execute([$userid]);
}

// Fetch message data based on user's role
$fetch = $query->fetchAll(PDO::FETCH_ASSOC);

// Process fetched data as needed


if ($fetch) {
?>

    <h4 class="text-center">Message List Information</h4>
    <br>
    <table class="table table-striped table-hover" id="Table">
        <thead>
            <tr>
                <th>No</th>
                <th>Campaign Name</th>
                <th>Content</th>
                <th>Timestamp</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($fetch as $index => $row):
                // Get campaign name from the pre-fetched array
                $campaignName = isset($campaignNames[$row['campaignid']]) ? $campaignNames[$row['campaignid']] : '';
            ?>

                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $campaignName; ?></td>
                    <td><?php echo $row['content']; ?></td>
                    <td><?php echo date('Y-m-d', intval($row['timestamp'])); ?></td>
                    <td>
                        <?php
                        $status = $row['status'];
                        if ($status == 2) {
                            echo "Draft";
                        } elseif ($status == 1) {
                            echo "Active";
                        } elseif ($status == 0) {
                            echo "Inactive";
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    } else {
        ?>
        <div class="tab">
        <h4 class="text-center">Message List Information</h4>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
            <th>No</th>
            <th>Campaign Name</th>
            <th>Content</th>
            <th>Timestamp</th>
            <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4" class="text-center">No data found in dashboard.</td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php
    }
?>





   </div>
</div>

</div>
</div>
</div>






<?php

   include 'footer.php';
   ?>