<?php include "includes/db.php" ?>
<?php 
    $productUploaded = false;
    // Checks if images are valid, if yes, $imagesValid = true
    
    $imageSizeValid = false;
    $imagesValid = false;
    $maxSize = 5 * 1024 * 1024;

    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0 ){

        for ($i = 0; $i < count($_FILES['images']['name']); $i++){
            $imageName = $_FILES['images']['name'][$i];
            $imageSize = $_FILES['images']['size'][$i];
            $imageError = $_FILES['images']['error'][$i];
            if($imageSize < $maxSize && $imageError === 0){
                $imageSizeValid = true;
            }else{
                $imageSizeValid = false;
                echo "<script>alert('The file {$imageName} is too large (>5mb) or there was an error with the upload.<br>')</script>";
                header("Location: admin-add-product.php");
                break;
            }
           
        }
        if($imageSizeValid === true){
            foreach($_FILES['images']['name'] as $name){
                $targetFile = $targetDir . basename($name);
                if(file_exists($targetFile)){
                    echo "<script>alert(`File name {$name} already exists`)</script>";
                    $imagesValid = false;
                    break;
                }else{
                    $imagesValid = true;
                }
            }
        }
    }
    // checks if variations are valid
    $variationValid = false;
    $productVariation;
    if (!empty($_POST['variation'])){
        $variationValid = true;
    }else{
        header("Location: admin-add-product.php");
    }
 
    // Execute mysql Query
    if(isset($_POST["save-post"]) && $variationValid && $imagesValid){
        $productSeller = $_POST['seller'];
        $productTitle = $_POST["title"];
        $productPrice = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $productVariation = $_POST["variation"];
        $productStock = $_POST['stock'];
        if (!is_numeric($productPrice)) {
            echo "<script>alert('Invalid price value.')</script>";
            exit;
        }
        $productPrice = (float) $productPrice;

        $sql = "INSERT INTO products (name, price, seller, variations, inventory) VALUES ( ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sdssi", $productTitle, $productPrice, $productSeller, $productVariation, $productStock);

        
        if ($stmt->execute()) {
            $productUploaded = true;
            $productID = $stmt->insert_id;
            $stmt->close();
            uploadImages($productID);
            
            echo "<script>alert('Product Saved!')</script>";
            
            header("Location: admin-product-listing.php"); 
            exit;

        } else {
            echo "<script>alert('Error saving file to database: {$connection->error}')</script>";
            header("Location: " . $_SERVER['HTTP_REFERER']); 
            exit;
        }
    }
    function uploadImages($productID){
        $targetDir = "images/";
        global $connection;
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $imageName = $_FILES['images']['name'][$i];
            $imageTmpName = $_FILES['images']['tmp_name'][$i];
            $targetFile = $targetDir . basename($imageName);
            if (move_uploaded_file($imageTmpName, $targetFile)) {
                // Insert file details into the database
                $sql = "INSERT INTO images (dir, position, product_id) VALUES (?,?,?)";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("sii", $targetFile, $i, $productID);
                
                if ($stmt->execute()) {
                    echo "File " . $imageName . " uploaded and saved to database successfully!<br>";
                    echo "<script>alert('File {$imageName} uploaded and saved to database successfully!')</script>";
                } else {
                    echo "<script>alert('Error saving file to database: " . $connection->error . "')</script>";
                }
                // Close the prepared statement
                $stmt->close();
            } else {
                echo "<script>alert('Error moving the file " . $imageName . ".')</script>";
            }
        }
    }

?>