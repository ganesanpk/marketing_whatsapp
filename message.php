<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once 'database.php';
require_once 'logs.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Initialize variables
$c_campaignid = '';
$c_messagegroup = '';
$c_content = '';
$c_status = '';
$page_title = '';

// Check if the action is edit
if ($action == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch campaign data based on the campaign ID
    $query = "SELECT *, status FROM message WHERE `messageid`=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    if ($stmt->rowCount() > 0) {
        $messageData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($messageData) {
            $c_campaignids = explode(',', $messageData['campaignid']); // Explode the campaign IDs string into an array
            $c_messagegroup = $messageData['messagegroup'];
            $c_content = $messageData['content'];
            $c_status = $messageData['status'];
    
            // Fetch campaign names associated with the retrieved campaign IDs
            $campaignNames = array();
            if (!empty($c_campaignids)) {
                $placeholders = rtrim(str_repeat('?,', count($c_campaignids)), ',');
                $sql = "SELECT campaignid, name FROM `campaign` WHERE campaignid IN ($placeholders)";
                $stmt = $conn->prepare($sql);
                $stmt->execute($c_campaignids); // Execute the statement with the campaign IDs array
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $campaignNames[$row['campaignid']] = $row['name'];
                }
            }
    
            $page_title = 'Edit message';
        }
    }
    
    
 
}


// Check if the action is add
if ($action == 'add') {
    $c_campaignid = '';
    $c_messagegroup ='';
    $c_content = '';
    $c_status = '';
    $page_title = 'Add message';
}

// Process form submission if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campaignid = $_POST['campaignid'];
    $messagegroup = $_POST['messagegroup'];
    $content = $_POST['content'];
    $status = $_POST['status']; // Corrected name
    
    if($_GET['action'] == 'edit'){
        // Update the campaign data in the database
   
      $query = "UPDATE `message` SET `campaignid`=?, `messagegroup`=?, `content`=?, `status`=? WHERE `messageid`=?";
      $stmt = $conn->prepare($query);

        // Convert $campaignid array to string
        $campaignid = implode(',', $campaignid);

// Bind parameters and execute the statement
        $stmt->execute([$campaignid, $messagegroup, $content, $status, $id]);

        
    
        $_SESSION['message'] = array("text" => "Campaign successfully updated.", "alert" => "success");
        getlog('updated a message');
        header("Location: messagelist.php");
        exit();
    }
    
    elseif ($action == 'add') {
        $campaignidArray = $_POST['campaignid'];
        $messagegroup = $_POST['messagegroup'];
        $userid = $_SESSION['user'];
        $content = $_POST['content'];
        $content = str_replace("</p><p>", "\n", $content);
        $content = str_replace("<p>", "",  $content);
        $content = str_replace("</p>", "", $content);
        $status = $_POST['status'];
        $timestamp = strtotime(date('Y-m-d'));
    
        // $campaignidsArray = explode(',', $campaignids);
        // $messagegroupsArray = explode(',', $messagegroups);
    
        // $sql = "INSERT INTO `message` (`campaignid`, `userid`, `messagegroup`, `content`, `status`, `timestamp`) VALUES (?, ?, ?, ?, ?, ?)";
        // $stmt = $conn->prepare($sql);
    
        foreach ($campaignidArray as $campaignid) {
            // foreach ($messagegroupsArray as $messagegroup) {
                
                $sql = "INSERT INTO `message` (`campaignid`, `userid`, `messagegroup`, `content`, `status`, `timestamp`) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$campaignid, $userid, $messagegroup, $content, $status, $timestamp]);
            // }
        }
    
        // Set session message for successful insertion
        $_SESSION['message'] = array(
            'text' => 'Message added successfully.',
            'alert' => 'success'
        );
        getlog('created a message');
        // Redirect back to the home page
        header('Location: messagelist.php');
        exit(); // Ensure script execution stops after redirect
    }
    
    
    
}
?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?>">
        <?php echo $_SESSION['message']['text']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php
include 'loginheader.php';
include 'sidebar.php';
include 'index.html';
?>
<div class=" content">
    <div class="col-md-2"></div>
    <div class=" margin col-md-12 well">
        <h3 class="text-primary"><?php echo $page_title; ?></h3>
        <hr style="border-top:1px dotted #ccc;"/>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1><?php echo $page_title; ?></h1>
            <form action="message.php?action=<?php echo $action; if($action == 'edit' && isset($_GET['id'])) echo '&id='.$_GET['id']; ?>" method="post">
            <div class="form-group">
                    <label for="campaignid">Campaign ID:</label>
                    <select class="form-control" id="autoCompleteSelect2" name="campaignid[]" multiple="multiple">
                     <?php foreach ($campaignNames as $campaignid => $campaignname): ?>
                            <option value="<?php echo $campaignid; ?>" <?php if (in_array($campaignid, $c_campaignids)) echo 'selected'; ?>><?php echo $campaignname; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="campaignid">messagegroup:</label>
                    <input type="text" class="form-control"  id="messagegroup" name="messagegroup" value="<?php echo $c_messagegroup; ?>"required>
                  
                </div>
                
                <div class="form-group">
                <label for="content">Content:</label>
             <textarea class="form-control"  name="content"><?php echo $c_content; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" class="form-control" required>
                    <option value="">Select status</option>
                        <option value="2" <?php if ($c_status == 2) echo 'selected'; ?>>Draft</option>
                        <option value="1" <?php if ($c_status == 1) echo 'selected'; ?>>Active</option>
                        <option value="0" <?php if ($c_status == 0) echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>
                <br><br><br>
                <a style="float:right; margin-top:2px; font-size:14px;" class="btn btn-success btn-lg  glyphicon glyphicon-send" href=""> Send </a>                            

  
                <input style="font-size:14px;" class="btn btn-success btn-lg" type="submit" value="<?php echo $page_title; ?>">
            </form>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>

<script>
			$(document).ready(function() {
				$('#autoCompleteSelect2').select2({
					placeholder: 'Keyword...',
					multiple: true,
					ajax: {
						type: 'GET',
						url: 'search2.php',
						processResults: function(data) {
							return {
								results: $.map(data, function(item) {
									return {
										text: item.name,
										id: item.campaignid
									}
								})
							};
						}
					}
				});
			});
		</script>