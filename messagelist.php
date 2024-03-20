<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once 'database.php';

include 'loginheader.php';
include 'sidebar.php';
?>

<div class=" content">
    <div class="col-md-2"></div>
    <div class="margin col-md-12 well">
        <h3 class="text-primary">Message List  <a style="float:right; margin-bottom:2px; font-size:14px;" class="btn btn-success btn-sm  glyphicon glyphicon-plus-sign" href="message.php?action=add"> Add </a></h3>
        <hr style="border-top:1px dotted #ccc;" />
        <div class="col-md-1"></div>
        <div class="col-md-10">
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
            // ... (previous code)

            $campaignNames = array();
$sql = "SELECT campaignid, name FROM `campaign`";
$query = $conn->query($sql);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $campaignNames[$row['campaignid']] = $row['name'];
}

            $sql = "SELECT *, status FROM `message`";

            $query = $conn->prepare($sql);
            $query->execute(); // Use an array to pass the parameter

            // Check if the fetch operation was successful
            $fetch = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($fetch) {

                ?>

                <table class="table table-striped table-hover" id="Table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Campaign Name</th>
                        <th>Message Group</th>
                        <th>Content</th>
                        <th>Timestamp</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Sent</th>
                    </tr>
                    <thead>
                        <tbody>
                    <?php
                    foreach ($fetch as $index => $row):
                         
                        $campaignName = isset($campaignNames[$row['campaignid']]) ? $campaignNames[$row['campaignid']] : '';

                    

                        ?>

                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $campaignName; ?></td>
                            <td><?php echo $row['messagegroup']; ?></td>
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

                           
                     
                            <td text-align="center">
                                <!-- Assuming you have edit.php for editing -->
                                <a href="message.php?action=edit&id=<?php echo $row['messageid']; ?>">Edit</a>
                            </td>
                            <td text-align="center">
                                <!-- Assuming you have delete.php for deleting -->
                                <a href="deletemsg.php?messageid=<?php echo $row['messageid']; ?>">Delete</a>
                            </td>

                            <td text-align="center">
                                <!-- Assuming you have delete.php for deleting -->
                                <a style="float:right; margin-top:2px; font-size:14px;" class="btn btn-success btn-sm  glyphicon glyphicon-send" href=""> Send </a>                            </td>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            <?php
            } else {
                // Handle the case where no records were found
                echo "No campaigns found for the given ID.";
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

