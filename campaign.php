<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once 'database.php';
require_once 'logs.php';

// Check if the campaign ID is provided in the URL
if (isset($_GET['action']) && $_GET['action'] == 'edit' ) {
    if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Fetch campaign data based on the campaign ID
    $query = "SELECT *,status FROM campaign WHERE `campaignid`=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);

    // Check if the campaign exists
    if ($stmt->rowCount() > 0) {
        $campaignData = $stmt->fetch(PDO::FETCH_ASSOC);
        if($campaignData){
            $c_name = $campaignData['name'];
            $c_start_date = date('Y-m-d', $campaignData['StartDate']);
            $c_end_date = date('Y-m-d', $campaignData['EndDate']);
            $c_status = $campaignData['status'];
            $page_title = 'Edit Campign';
        }

    } else {
        $_SESSION['message'] = array("text" => "Campaign not found.", "alert" => "danger");
        header("Location: campaignlist.php");
        exit();
    }
} else {
    $_SESSION['message'] = array("text" => "No ID parameter provided in the URL.", "alert" => "danger");
    header("Location: campaignlist.php");
    exit();
}
}
// Check if the campaign ID is provided in the URL
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $c_name = '';
    $c_start_date = '';
    $c_end_date = '';
    $c_status='';
    $page_title = 'Add Campign';
}


// Process form submission if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and update campaign data in the database
    $name = $_POST['name']; 
    $StartDateString = $_POST['StartDate'];
    $EndDateString = $_POST['EndDate'];
    $status = $_POST['status'];

    // Convert input date strings to timestamps
    $StartDateTimestamp = strtotime($StartDateString);
    $EndDateTimestamp = strtotime($EndDateString);

    if ($StartDateTimestamp === false || $EndDateTimestamp === false) {
        // Handle invalid date/time strings
        echo "Invalid date/time string in StartDate or EndDate";
    } else {
        if($_GET['action'] == 'edit'){
        // Update the campaign data in the database
        $query = "UPDATE `campaign` SET `name`=?, `StartDate`=?, `EndDate`=?, `status`=? WHERE `campaignid`=?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$name, $StartDateTimestamp, $EndDateTimestamp, $status, $id]);

        $_SESSION['message'] = array("text" => "Campaign successfully updated.", "alert" => "success");
        getlog(" edited a campaign $campaignName");
        header("Location: campaignlist.php");
       
        }
        else if($_GET['action'] == 'add') {
            // Insert new campaign data into the database
            $userid = $_SESSION['user'];
         // You need to define status as it's used in the INSERT query

            $sql = "INSERT INTO `campaign` (`userid`, `name`, `StartDate`, `EndDate`, `status`) 
                    VALUES (:userid, :name, :StartDate, :EndDate, :status)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userid', $userid);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':StartDate', $StartDateTimestamp);
            $stmt->bindParam(':EndDate', $EndDateTimestamp);
            $stmt->bindParam(':status', $status); // Make sure to initialize $status before using

            $stmt->execute();

            $_SESSION['message'] = array("text" => "Campaign successfully added.", "alert" => "success");
            $campaignName = $_POST['name']; // Assuming name is the campaign name field in your form
            getlog(" created a campaign $campaignName");
            header("Location: campaignlist.php");
            exit();

        }
    }
}
?>


<?php
include 'loginheader.php';
include 'sidebar.php';
?>
<div class=" content">
	<div class="col-md-2"></div>
	<div class=" margin col-md-12 well">
		<h3 class="text-primary"><?php echo $page_title ?></h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">

      <form action="campaign.php?action=<?php echo $_GET['action']; if(isset($_GET['id'])) echo '&id='.$_GET['id']; ?>" method="post">
       <div class="form-group">
             <label for="name">Campaign Name:</label>
             <input type="text" class="form-control"  name="name" value="<?php echo $c_name; ?>" required>
       </div>
       <div class="form-group">
             <label for="StartDate">Start Date:</label>
             <input type="date" class="form-control" id="StartDate" name="StartDate" value="<?php echo $c_start_date; ?>"required>
       </div>
       <div class="form-group">
             <label for="EndDate">End Date:</label>
             <input type="date" class="form-control" id="EndDate" name="EndDate" value="<?php echo $c_end_date; ?>" required>
       </div>


       <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" class="form-control">
                        <option value="2" <?php if ($c_status == 2) echo 'selected'; ?>>Draft</option>
                        <option value="1" <?php if ($c_status == 1) echo 'selected'; ?>>Active</option>
                        <option value="0" <?php if ($c_status == 0) echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>
                <br><br><br>
  
  <input name="submit" style="font-size:14px;" class="btn btn-success btn-lg" type="submit" value="submit">
</form>
       
    </div>
</div>
</div>
</div>

<?php
include 'footer.php';
?>




