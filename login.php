<?php include "includes/db.php" ?>
<?php 
session_start();
session_destroy();
session_start();
?>

<?php 

if(isset($_POST['login'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username ='{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query){
        die("QUERY FAILED". mysqli_error($connection));  
    }
    while($row = mysqli_fetch_array($select_user_query)){
        $db_id = $row['userID'];
        $db_username = $row['username'];
        $db_password = $row['password'];
        $db_role = $row['role'];
    }
    if ($username !== $db_username && $password !== $db_password){
        header("Location: login.php");
    }else if ($username == $db_username && $password == $db_password){
        $_SESSION["username"] = $db_username;
        $_SESSION["password"] = $db_password;
        $_SESSION["role"] = $db_role;
        $_SESSION["user_id"] = $db_id;
        header("Location: admin-product-listing.php");
    }else {
        header("Location: landing_page.php");
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Road+Rage&family=Saira+Stencil+One&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <script defer src="scripts/login.js"></script>
    <title>Log In</title>
</head>
<body>
    <main>
        <form action="login.php" method="POST">
            <div class="container-header-logo">
                <img class="red-hawks-logo" src="Assets/Red_Hawks_Logo.png" alt="" />
                <p id="ccs-logo-text">CCS Merch Shop</p>

            </div>
            <div class="container-container-input">
                <div class="container-input">
                    <label for="username">User Name</label>
                    <input class="login-input" name="username" type="text">
                </div>
                <div class="container-input">
                    <label for="password">Password</label>
                    <div class="container-input-password">
                        <input class="login-input" id="password-input" name="password" type="password">
                        <button class="btn-show-password" type="button"><img class="eye-icon" src="Assets/icons/eye-open.svg" alt="eye icon"></button>
                    </div>
                    
                </div>
            </div>
            <input class="btn-login" type="submit" value="Log In" name="login">
        </form>
    </main>
</body>
</html>