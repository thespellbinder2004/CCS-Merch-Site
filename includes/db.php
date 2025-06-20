<?php 
    $db_server = "localhost";
    $db_user = 'root';
    $db_pass = '';
    $dib_name = 'ccsmerch';

    $connection = mysqli_connect($db_server, $db_user, $db_pass, $dib_name);
    if($connection){
        echo '<script>
            console.log("Successfully Connected to ccsmerch database");
        </script>';
    }else{
        echo "Unable to connect to database";
        die();
    }
?>