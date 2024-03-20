<?php

// Connect to the database
require_once 'database.php';

// SQL query to create the user table
$query = "CREATE TABLE IF NOT EXISTS user (
    userid int(11) AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    phonenumber varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    PASSWORD varchar(255) NOT NULL,
    PRIMARY KEY  (userid),
    UNIQUE  (phonenumber)
)";

// Prepare and execute the query
try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "User table created successfully";
    echo"<br>";

    $alterquery="ALTER TABLE user ADD COLUMN IF NOT EXISTS company VARCHAR(255) AFTER email";
    $stmt = $conn->prepare($alterquery);
    $stmt->execute();
    echo "column company";
    
    echo"<br>";

     
    $alterquery = "ALTER TABLE user 
    ADD COLUMN  role_id INT(11) AFTER PASSWORD,
    ADD CONSTRAINT fk_role_id FOREIGN KEY (role_id) REFERENCES user_roles(id)";
      $stmt = $conn->prepare($alterquery);
      $stmt->execute();
     echo "role_id column and alter key created successfully";






} 
catch (PDOException $e) {
    echo "Error creating user table: " . $e->getMessage();
}
echo"<br>";
// SQL query to create the Campign table
$query = "CREATE TABLE IF NOT EXISTS campaign (
    campaignid int(11) AUTO_INCREMENT,
    userid int(11) ,
    name varchar(255) NOT NULL,
    StartDate varchar(255) NOT NULL,
    EndDate varchar(255) NOT NULL,
    Status int(10),
    PRIMARY KEY  (campaignid),
    FOREIGN KEY (userid) REFERENCES user(userid)
)";

// Prepare and execute the query
try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "Campign table created successfully";
} 
catch (PDOException $e) {
    echo "Error creating Campign table: " . $e->getMessage();
}
echo"<br>";
// SQL query to create the Messge table
$query = "CREATE TABLE IF NOT EXISTS message (
    messageid int(11) AUTO_INCREMENT,
    campaignid int(11),
    userid int(11) ,
    content varchar(255) NOT NULL,
    timestamp varchar(255) NOT NULL,
    Status int(10),
    PRIMARY KEY  (messageid),
    FOREIGN KEY (campaignid) REFERENCES campaign(campaignid),
    FOREIGN KEY (userid) REFERENCES user(userid)
 
)";


// Prepare and execute the query
try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "Messge table created successfully";
  echo"<br>";

 


$query = "ALTER TABLE message
    ADD COLUMN IF NOT EXISTS messagegroup VARCHAR(250)";
$stmt = $conn->prepare($query);
$stmt->execute();
echo "Message column and fk created successfully";



  


} 
catch (PDOException $e) {
    echo "Error creating Messge table: " . $e->getMessage();
}





echo"<br>";
// SQL query to create the User Campign table
$query = "CREATE TABLE IF NOT EXISTS usercampaign (
    usercampaignid int(11) AUTO_INCREMENT,
    userid int(11),
    campaignid int(11),
    PRIMARY KEY  (usercampaignid),
    FOREIGN KEY (userid) REFERENCES user(userid),
    FOREIGN KEY (campaignid) REFERENCES campaign(campaignid)
)";

// Prepare and execute the query
try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "User Campign table created successfully";
} 
catch (PDOException $e) {
    echo "Error creating User Campign table: " . $e->getMessage();
}
echo"<br>";




//SQL query to create the user table
$query = "CREATE TABLE IF NOT EXISTS message_group (
    id int(11) AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    userid int(11),
    PRIMARY KEY  (id),
    FOREIGN KEY (userid) REFERENCES user(userid)
)";





// Prepare and execute the query
try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "Message Group created successfully";

    echo"<br>";

    $query = "ALTER TABLE message_group
    ADD COLUMN IF NOT EXISTS user_created_id INT(11),
    ADD CONSTRAINT fk_user_created_id FOREIGN KEY (user_created_id) REFERENCES user(userid)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "Message Group column created successfully";
    
}
catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

echo"<br>";



// //SQL query to create the logs table
$query = "CREATE TABLE IF NOT EXISTS logs(
    log_id int(11) AUTO_INCREMENT,
    log_type varchar(255) NOT NULL,
    operation LONGTEXT NOT NULL,
    log_timestamp varchar(255) NOT NULL,
    PRIMARY KEY  (log_id)
)";



// Prepare and execute the query
try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "logs table created successfully";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
echo"<br>";



$query = "CREATE TABLE IF NOT EXISTS user_roles(
    id int(11),
    roles_name varchar(255) NOT NULL,
    PRIMARY KEY  (id)

)";



// Prepare and execute the query
try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "user_roles table created successfully";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
echo"<br>";








?>