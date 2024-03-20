<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

require_once 'database.php';

include 'loginheader.php';

// Fetch the current user's role
$userid = $_SESSION['user'];
$sql_role = "SELECT ur.roles_name FROM user_roles ur JOIN user u ON ur.id = u.role_id WHERE userid = ?";
$query_role = $conn->prepare($sql_role);
$query_role->execute([$userid]);
$user_role = $query_role->fetch(PDO::FETCH_ASSOC)['roles_name'];

// Include sidebar if the user is an admin
if ($user_role == 'admin') {
    include 'sidebar.php';
}

?>

<div class="content">
    <div class="col-md-2"></div>
    <div class="margin col-md-12 well">
        <h3 class="text-primary">Logs List</h3>
        <hr style="border-top:1px dotted #ccc;" />
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <?php
            // Fetch logs from the logs table if the user is an admin
            if ($user_role == 'admin') {
                $sql = "SELECT * FROM logs";
                $query = $conn->query($sql);
                $logs = $query->fetchAll(PDO::FETCH_ASSOC);

                if ($logs) {
            ?>
                    <h4 class="text-center">Logs</h4>
                    <table class="table table-striped table-hover" id="Table">
                        <thead>
                            <tr>
                                <th>Log ID</th>
                                <th>Log Type</th>
                                <th>Operation</th>
                                <th>Log Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $row):
                                // Set timezone to Indian Standard Time (IST)
                                date_default_timezone_set('Asia/Kolkata'); ?>
                                <tr>
                                    <td><?php echo $row['log_id']; ?></td>
                                    <td><?php echo $row['log_type']; ?></td>
                                    <td><?php echo $row['operation']; ?></td>
                                    <td><?php echo date('Y-m-d h:i:s A', intval($row['log_timestamp'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            <?php
                } else {
                    echo "No logs found.";
                }
            } else {
                echo "You don't have access to view logs.";
            }
            ?>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
