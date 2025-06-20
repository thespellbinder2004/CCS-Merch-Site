<?php include "includes/db.php" ?>

<?php 
    $targetDir = "images-receipts/";
    print_r($_FILES["receipt"]['name']);

    $imageName = $_FILES["receipt"]['name'];
    $imageTmpName = $_FILES["receipt"]['tmp_name'];
    $targetFile = $targetDir . basename($imageName);
    
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $section = $_POST["section"];
    $phoneNumber = (int)$_POST["phone"];
    $items = $_POST["items"];
    $price = $_POST["total-price"];
    $email = $_POST["email"];
    
    if (move_uploaded_file($imageTmpName, $targetFile)) {
        $itemsArr = json_decode($items, true);
        foreach ($itemsArr as $item) {
            $sql = "UPDATE products
                    SET inventory = inventory - ?
                    WHERE product_id = ?";
            
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ii", $item["quantity"], $item["productid"]);

            if (!$stmt->execute()) {
                // Handle error (possibly log or display a message)
                echo "<script>alert('Error updating inventory: " . $connection->error . "');</script>";
                $stmt->close();
                exit; 
            }
        }
        $stmt->close(); // Close the prepared statement after the loop
        // Insert file details into the database
        $sql = "INSERT INTO transactions (first_name, last_name, section, email, phone_number, receipt_dir, total_price, items) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssisds", $firstName, $lastName, $section, $email, $phoneNumber, $targetFile, $price, $items);
        
        if ($stmt->execute()) {
            $lastInsertedId = $connection->insert_id;
            echo "<script>localStorage.clear();</script>";
            header("Location: check-out-success.php?id={$lastInsertedId}");
        } else {
            echo "<script>alert('Error saving file to database: " . $connection->error . "')</script>";
        }
        // Close the prepared statement
        $stmt->close();


    } else {
        echo "<script>alert('Error moving the file " . $imageName . ".')</script>";
    }
?>