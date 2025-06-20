<?php session_start() ?>

<?php 

if (!isset($_SESSION["password"])){
    header("Location: /CCS_merch_site/login.php");
    die();
    
}
$username = $_SESSION["username"];
$query = "SELECT * FROM users WHERE username ='{$username}'";
$select_user_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_array($select_user_query)){
    $db_id = $row['userID'];
    $db_username = $row['username'];
    $db_password = $row['password'];
    $db_role = $row['role'];
}
if($_SESSION["password"] != $db_password){
    header("Location: /CCS_merch_site/login.php");
    die();
}
    
?>