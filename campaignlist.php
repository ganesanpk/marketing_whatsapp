<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once 'database.php';

// Check if the user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

try {
    if (isset($_POST['campaign'])) {
        if ($_POST['userid'] != "") {
            $userid = $_SESSION['user'];

            $sql = "SELECT * FROM `campaign` WHERE `userid`=?";
            $query = $conn->prepare($sql);
            $query->execute(array($userid));
            $row = $query->rowCount();
            $fetch = $query->fetch();
            if ($row > 0) {
                $_SESSION['user'] = $fetch['userid'];
                $_SESSION['message'] = array("text" => "Campaign List successfully created.", "alert" => "info");
                header("Location: campaignlist.php");

            } else {
                echo "
                    <script>alert('Invalid name or password')</script>
                    <script>window.location = 'index.php'</script>
                ";
               
            }
        } else {
            echo "
                <script>alert('Please complete the required field!')</script>
                <script>window.location = 'index.php'</script>
            ";
           
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
   <?php
    include 'loginheader.php';
    include 'sidebar.php';
    ?>
   
    <div class=" content">
    <div class="col-md-2"></div>
    <div  class=" margin col-md-12 well">
        <h3 class="text-primary">Campaign List  <a style="float:right; margin-bottom:2px; font-size:14px;" class="btn btn-success btn-sm  glyphicon glyphicon-plus-sign" href="campaign.php?action=add"> Add </a></h3> 
        <hr style="border-top:1px dotted #ccc;" />
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg">
                    <?php echo $_SESSION['message']['text'] ?>
                </div>
                <script>
                    (function () {
                        // removing the message 3 seconds after the page load
                        setTimeout(function () {
                            document.querySelector('.msg').remove();
                        }, 3000)
                    })();
                </script>
            <?php endif;
            // clearing the message
            unset($_SESSION['message']);
            ?>

            <br />
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
            // ... (previous code)
            
            $userid = $_SESSION['user'];
            $sql = "SELECT *,status FROM `campaign` WHERE `userid`=$userid";
            $query = $conn->prepare($sql);
            $query->execute(); // Use an array to pass the parameter
            
            // Check if the fetch operation was successful
            $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
            //  echo "<pre>";
            //   print_r($fetch);
            //  exit;

            if ($fetch) {
                ?>
                <div class="tab">
                    <h4 class="text-center"></h4>
                    <table  class="table table-striped table-hover" id="Table"  >
                        <thead>
                        <tr>
                            
                            <th>No</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($fetch as $index => $row):
                            //  print_r($row);
                            //  exit;
                            
                            
                            

                           
                           
                            $StartDate = date('Y-m-d', intval($row['StartDate']));
                            $EndDate = date('Y-m-d', intval($row['EndDate']));


                            // echo $startDate ;
                            // echo $EndDate;
                            ?>

                            <tr>
                               
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $StartDate ?></td>
                                <td><?php echo $EndDate?></td>
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

                               

                                <td text-align="center">
                                <!-- In campaign.php or any other page where you have the campaign ID available -->
                                <a href="campaign.php?action=edit&id=<?php echo $row['campaignid']; ?>">Edit</a>

                                </td>
                               
                                <td text-align="center">
                                <a href="delete.php?id=<?php echo $row["campaignid"]; ?>">Delete</a>
                                </td>            
                            </tr>
                        <?php  endforeach; ?>
                        <tbody>
                    </table>
               </div>
           
                <?php
            } else {
                // Handle the case where no records were found
                echo "No campaigns found for the given ID.";
            }
            

            // ... (remaining code)
            ?>



    
        </div>
   </div>
   </div>
   <script>
                 
                </script>
<?php
include 'footer.php';
?>