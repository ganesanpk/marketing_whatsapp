<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once 'database.php';

if (!isset($_SESSION['user']))  {
	header("Location: index.php");
	exit; // Make sure to exit after redirection
}

include 'loginheader.php';
include 'sidebar.php';
?>

<div class="content">
    <div class="col-md-3"></div>
    <div class="margin col-md-12 well">
        <h3 class="text-primary">Message group List <a style="float:right; margin-bottom:2px; font-size:14px;" class="btn btn-success btn-sm  glyphicon glyphicon-plus-sign" href="messagegroup.php?action=add"> Add </a></h3>
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

<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Assuming you have the current user's ID stored in a variable $currentUserID
    // Replace $currentUserID with the actual variable holding the user's ID
    $user_created_id = $_SESSION['user']; // Example, replace this with your actual method of retrieving the current user's ID

    $userNames = array();
    $sql = "SELECT userid, name FROM `user`";
    $query = $conn->query($sql);
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $userNames[$row['userid']] = $row['name'];
   }


    $sql = "SELECT * FROM `message_group`";
    $query = $conn->prepare($sql);
    $query->execute();

    // Check if the fetch operation was successful
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($fetch) {
?>
    <table class="table  table-striped table-hover" id="Table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>User Created ID</th> <!-- Added column -->
                <th>Edit</th>
                <th>Delete</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($fetch as $index => $row):

                    $userName = isset($userNames[$row['user_created_id']]) ? $userNames[$row['user_created_id']] : '';
            ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $userName; ?></td> <!-- Displaying current user ID -->
                <td text-align="center">
                    <a href="messagegroup.php?action=edit&name=<?php echo $row['name'] ?>">Edit</a>
                </td>
                <td text-align="center">
                    <a href="delete_messagegrp.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php
    } else {
        // Handle the case where no records were found
        echo "No Message group found for the given ID.";
    }
?>

        </div>
    </div>
</div>
<?php
include 'footer.php';
?>

