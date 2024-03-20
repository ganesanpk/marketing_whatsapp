<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once 'database.php';
require_once 'logs.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Initialize variables
$c_name = '';
$c_userid = '';
$page_title = '';

// Check if the action is edit
if (isset($_GET['action'], $_GET['name']) && $_GET['action'] === 'edit') {
    $id = $_GET['name'];

    $query = "SELECT * FROM message_group WHERE `name`=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);

    // Check if the message group exists
    if ($stmt->rowCount() > 0) {
        $messagegroupData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($messagegroupData) {
            $c_name = $messagegroupData[0]['name'];
            $c_userids = array_column($messagegroupData, 'userid');

            // Fetch user names associated with the retrieved user IDs
            $userNames = array();
            $placeholders = rtrim(str_repeat('?,', count($c_userids)), ',');
            $sql = "SELECT userid, name FROM `user` WHERE userid IN ($placeholders)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($c_userids);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $userNames[$row['userid']] = $row['name'];
            }

            $page_title = 'Edit message';
        }
    }
}





if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $c_name = '';
    $c_userids = '';
    $page_title = 'Add messagegroup';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name']; 
    $userid = $_POST['userid']; 

    if ($name == $c_name && $userid == $c_userid) {
        $_SESSION['message'] = ["text" => "No changes made to the message.", "alert" => "success"];
        header("Location: message_group_list.php");
        exit();
    }

    if ($action == 'edit') {
        // Update the user ID and name
        $existingUserIdsArray = $c_userids; 
        $newUserIdsArray = $_POST['userid']; 
        
        // Prepare the SQL query for updating message_group
        $query = "UPDATE `message_group` SET `userid`=?, `name`=? WHERE `name`=? AND `userid`=?";
        $stmt = $conn->prepare($query);
    
        // Iterate over the existing user IDs
        foreach ($existingUserIdsArray as $index => $existingUserId) {
            // Check if a corresponding new user ID exists
            if (isset($newUserIdsArray[$index])) {
                $newUserId = $newUserIdsArray[$index];
                $existingName = $c_name;
                $newName = $_POST['name']; // Using POST data for updated name
                
                // Execute the update query
                if ($stmt->execute([$newUserId, $newName, $existingName, $existingUserId])) {
                    // Handle success if needed
                } else {
                    // Handle failure
                }
            }
        }
    
        $_SESSION['message'] = ["text" => "Message group successfully updated.", "alert" => "success"];
        getlog('deleted a messagegroup');
   
        header("Location: message_group_list.php");
        exit();
    }
    
    
    
    
     
    
    else if($_GET['action'] = 'add') {
        // Prepare the SQL query
        $name = $_POST['name'];
        $useridArray = $_POST['userid'];
        $user_created_id = $_SESSION['user']; 

        // Check if the name already exists
        $check_sql = "SELECT COUNT(*) AS count FROM message_group WHERE name = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->execute([$name]);
        $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];
     
        if ($count > 0) {
            $_SESSION['message'] = ["text" => "A message group with the same name already exists.", "alert" => "danger"];
            header('location: edit_messagegrp.php');
            exit();
        }
        
        // Prepare the SQL query
        
        
        // Explode userids string into an array
        // $useridsArray = explode(',', $userids);
        
        // Execute the statement for each user id
        foreach ($useridArray as $userid) {
            $sql = "INSERT INTO `message_group` (`name`, `userid`, `user_created_id`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $userid, $user_created_id]);
        }
        
        // Set session message and redirect after successful insertion
        $_SESSION['message'] = ["text" => "Message group successfully created.", "alert" => "info"];
        getlog('created a messagegroup');
        header('location: message_group_list.php');
        exit();
    }
}

include 'loginheader.php';
include 'sidebar.php';
?>
<div class="content">
    <div class="col-md-3"></div>
    <div  class=" margin col-md-12 well">
        <h3 class="text-primary text-center"> <?php echo $page_title; ?></h3>
        <hr style="border-top:1px dotted #ccc;"/>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['message']['alert']; ?> msg">
                    <?php echo $_SESSION['message']['text']; ?>
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
            <form action="messagegroup.php?action=<?php echo $action; if($action == 'edit' && isset($_GET['name'])) echo '&name='.$_GET['name']; ?>" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $c_name; ?>" required>
                </div>
                <div class="form-group">
    <label for="userid">User ID:</label>
    <select type="text" class="form-control" id="autoCompleteSelect2" name="userid[]" multiple="multiple" required>
    <?php foreach ($userNames as $userid => $username): ?>
                            <option value="<?php echo $userid; ?>" <?php if (in_array($userid, $c_userids)) echo 'selected'; ?>><?php echo $username; ?></option>
                        <?php endforeach; ?>
    </select>
</div>

                <button type="submit" style="font-size:14px;" class="btn btn-success btn-lg">Submit</button>
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
						url: 'search.php',
						processResults: function(data) {
							return {
								results: $.map(data, function(item) {
									return {
										text: item.name,
										id: item.userid
									}
								})
							};
						}
					}
				});
			});
		</script>

        