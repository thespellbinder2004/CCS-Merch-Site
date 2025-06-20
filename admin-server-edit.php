<?php include "includes/db.php" ?>
<?php 




    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        if (isset($_POST["save-post"])){
            $action = $_POST["save-post"];
    
            $productID = $_POST["product-id"];
            if ($action == 'Delete'){

                $sql = "DELETE FROM products WHERE product_id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("i", $productID);
        
                if ($stmt->execute()) {
                    $stmt->close();
                    echo "<script>alert('Product Deleted!')</script>";
                    header("Location: admin-product-listing.php"); 
                    exit;
        
                } else {
                    echo "<script>alert('Error deleting file to database: {$connection->error}')</script>";
                    header("Location: admin-product-listing.php"); 
                    exit;
                }

                die();
            }

            if ($action == 'Save'){

                if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0 ){
                    $productUploaded = false;
                    // Checks if images are valid, if yes, $imagesValid = true
                    $targetDir = "images/";
                    $imageSizeValid = false;
                    $imagesValid = false;
                    $maxSize = 5 * 1024 * 1024;

                    for ($i = 0; $i < count($_FILES['images']['name']); $i++){
                        $imageName = $_FILES['images']['name'][$i];
                        $imageSize = $_FILES['images']['size'][$i];
                        $imageError = $_FILES['images']['error'][$i];
                        if($imageSize < $maxSize && $imageError === 0){
                            $imageSizeValid = true;
                        }else{
                            $imageSizeValid = false;
                            echo "<script>alert('The file {$imageName} is too large (>5mb) or there was an error with the upload.<br>')</script>";
                            break;
                        }
                    
                    }
                    if($imageSizeValid === true){
                        foreach($_FILES['images']['name'] as $name){
                            $targetFile = $targetDir . basename($name);
                            if(file_exists($targetFile)){
                                echo "<script>alert(`File name {$name} already exists, file name will be changed to unique one.`)</script>";
                                $imagesValid = true;
                                
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
                }
            
                // Execute mysql Query
                if(isset($_POST["save-post"]) && $variationValid && $imagesValid){
                    $productSeller = $_POST['seller'];
                    $productTitle = $_POST["title"];
                    $productPrice = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $productVariation = $_POST["variation"];
                    $productStock = $_POST["stock"];
                    if (!is_numeric($productPrice)) {
                        echo "<script>alert('Invalid price value.')</script>";
                        exit;
                    }
                    $productPrice = (float) $productPrice;
            
                    $sql = "UPDATE products SET name = ?, price = ?, seller = ?, variations = ?, inventory = ? WHERE product_id = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("sdssii", $productTitle, $productPrice, $productSeller, $productVariation, $productStock, $productID);
            
                    
                    if ($stmt->execute()) {
                        $productUploaded = true;
                        $stmt->close();
                        uploadImages($productID);
                        
                        echo "<script>alert('Product Saved!')</script>";
                        
                        header("Location: admin-product-listing.php "); 
                        exit;
            
                    } else {
                        echo "<script>alert('Error saving file to database: {$connection->error}')</script>";
                        header("Location: " . $_SERVER['HTTP_REFERER']); 
                        exit;
                    }
                }

                
                die();
            }
        }
    }
    function uploadImages($productID){

        $targetDir = "images/";
        global $connection;
        // This will delete current photos
        $queryImages = "SELECT * FROM images WHERE product_id = {$productID}";
        $imagesQuery = mysqli_query($connection, $queryImages);
        $images = [];
        while($row = mysqli_fetch_assoc($imagesQuery)){
            array_push($images, ["id"=>$row["image_id"],"dir"=>$row["dir"], "position"=>$row['position']]);
        }
        usort($images, function($a, $b) {
            return $a['position'] - $b['position'];
        });

        $imagesDir = [];
        foreach ($images as $image){
            array_push($imagesDir, $image["dir"]);
        }
        $sql = "DELETE FROM images WHERE product_id= ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $productID);
        
        if ($stmt->execute()) {
            $stmt->close();
            foreach ($imagesDir as $imageDir){
                unlink($imageDir);
            }
            echo "<script>alert('Editing product will delete images in database, please upload them again.')</script>";
            
    
        } else {
            echo "<script>alert('Error saving file to database: {$connection->error}')</script>";
            
        }

        // This will upload current photos
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $imageName = $_FILES['images']['name'][$i];
            $imageTmpName = $_FILES['images']['tmp_name'][$i];
            $targetFile = $targetDir . basename($imageName);
            if(file_exists($targetFile)){
                $targetFile = $targetDir . time() . basename($imageName);
            }
            
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