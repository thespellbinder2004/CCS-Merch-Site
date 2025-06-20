<?php include "includes/db.php" ?>
<?php include "includes/session.php"; ?>

<?php 
    $productID = $_GET["id"];
    $productName;
    $productPrice;
    $productSeller;
    $productStock;
    $productVariations = [];
    $queryProduct = "SELECT * FROM products WHERE product_id = {$productID}";
    $queryImages = "SELECT * FROM images WHERE product_id = {$productID}";
    $productQuery = mysqli_query($connection, $queryProduct);
    $imagesQuery = mysqli_query($connection, $queryImages);

    $images = [];
    // getting PRODUCT variables
    if($row = mysqli_fetch_assoc($productQuery)){
        $productName = $row["name"];
        $productPrice = $row["price"];
        $productSeller = $row["seller"];
        $productStock = $row["inventory"];
        $productVariations = json_decode($row["variations"]);
    }

    // while($row = mysqli_fetch_assoc($imagesQuery)){
    //     array_push($images, ["id"=>$row["image_id"],"dir"=>$row["dir"], "position"=>$row['position']]);
    // }
    // usort($images, function($a, $b) {
    //     return $a['position'] - $b['position'];
    // });

    // $imagesDir = [];
    // foreach ($images as $image){
    //     array_push($imagesDir, $image["dir"]);
    // }
    // $sql = "DELETE FROM images WHERE product_id= ?";
    // $stmt = $connection->prepare($sql);
    // $stmt->bind_param("i", $productID);
    
    // if ($stmt->execute()) {
    //     $stmt->close();
    //     foreach ($imagesDir as $imageDir){
    //         unlink($imageDir);
    //     }
    //     echo "<script>alert('Editing product will delete images in database, please upload them again.')</script>";
        

    // } else {
    //     echo "<script>alert('Error saving file to database: {$connection->error}')</script>";
        
    // }

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
    <link rel="stylesheet" href="css/admin-edit-product.css">
    <script defer src="scripts/admin-edit-product.js"></script>
    <title>Edit product</title>

</head>
<body>
    <script> 
        const arrVariation = <?php echo json_encode($productVariations) ?>
    </script>
    <?php 
        
    ?>
    <main>
        
    <?php include "includes/admin-sidebar.html" ?>
        <form action="admin-server-edit.php" method="post" name="product" class="container-add-product" enctype="multipart/form-data">
            <input name="product-id" type="hidden" value="<?php echo (int)$productID  ?>">
            <div class="toolbar">
                <div class="container-btn-save">
                    <input name="save-post" class="btn-save-delete" type="submit" value="Delete">
                    <input name="save-post" class="btn-save" type="submit" value="Save">
                </div>
                
            </div>
            <div class="container-add-product-functions">
                <div class="container-add-function">
                    <label for="options">Product Seller</label>
                    <select id="options" name="seller">
                        <option value="csc">College Student Council</option>
                        <option value="jpcs">Junior Philippine Computer Science</option>
                        <option value="ssite">SSITE</option>
                        <option value="progden">Porgrammers Den</option>
                    </select>
                </div>
                <div class="container-add-function">
                    <label for="title">Title</label>
                    <input class="input-title" type="text" name="title" maxlength="50" value="<?php echo $productName ?>" required>
                </div>
                <div class="container-add-function">
                    <label for="">Stock</label>
                    <input class="input-stock" type="number" name="stock" min="0" max="199" step="1" value="<?php echo $productStock?>" required>
                </div>
                <div class="container-add-function">
                    <label for="price">Price</label>
                    <div class="container-input-number">
                        <p class="peso-sign">₱</p>
                        <input class="input-number" type="number" name="price" min="1" step=".01" value="<?php echo $productPrice ?>" required>
                    </div>

                </div>
                <div class="container-add-funnction">
                    <label for="">Variation</label>
                    <div class="variation-control">
                        <input class="input-variation" type="text" name="variation" maxlength="20">
                        <input class="btn-add-variation" type="button" name="variation" value="+">
                    </div>
                    <input id="input-variation-store" type="hidden" name="variation" required>
                    <ul class="variation-list">

                    </ul>
                </div>
                <div class="container-add-funnction">
                    <div class="photos-control">
                        <label for="">Photos</label>
                        <input class="upload-photos" type="file" name="images[]" accept=".jpg, .jpeg, .png, .webp" multiple>
                    </div>
                    <div class="photos-list">
            
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>
<script>
        window.addEventListener('resize', function() {
            let containerWidth = document.querySelector('.container-add-product').offsetWidth;
            document.querySelector('.toolbar').style.width = containerWidth + 'px';
        });
        let containerWidth = document.querySelector('.container-add-product').offsetWidth;
        document.querySelector('.toolbar').style.width = containerWidth + 'px';
        // Set width on load
        window.dispatchEvent(new Event('resize'));
    </script>
</html>