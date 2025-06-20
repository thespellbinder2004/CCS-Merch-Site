<?php include "includes/db.php" ?>
<?php

$productName;
$productPrice;
$productSeller;
$productVariations = [];
// query stuff, will never be used again
$productID = isset($_GET["id"]) ? $_GET["id"] : 1; 
$queryProduct = "SELECT * FROM products WHERE product_id = {$productID}";
$queryImages = "SELECT * FROM images WHERE product_id = {$productID}";
$productQuery = mysqli_query($connection, $queryProduct);
$imagesQuery = mysqli_query($connection, $queryImages);
// arryas\
$images = [];
// getting PRODUCT variables
if($row = mysqli_fetch_assoc($productQuery)){
    $productName = $row["name"];
    $productPrice = $row["price"];
    $productSeller = $row["seller"];
    $productStock = $row["inventory"];
    $productVariations = json_decode($row["variations"]);
}

while($row = mysqli_fetch_assoc($imagesQuery)){
    array_push($images, ["dir"=>$row["dir"], "position"=>$row['position']]);
}
usort($images, function($a, $b) {
    return $a['position'] - $b['position'];
});

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/single-product.css">
    <script type="module" src="scripts/single-product.js"></script>
    <title><?php echo $productName ?></title>
</head>
<body>
    <?php include "includes/header.html" ?>

    <div class="modal">
        Product Added to Cart!
        <img src="Assets/icons/check-icon.svg" alt="">
    </div>

    <main>

        <div class="container-product" data-productID="<?php echo $productID ?>" data-thumbnail="<?php echo $images[0]['dir'] ?>" data-product-name="<?php echo $productName ?>" data-product-seller="<?php echo $productSeller ?>" data-product-price="<?php echo $productPrice ?>">
            <!-- Photos Container, the Large Photo and side options photo -->
            <div class="container-product-photos">
                <!-- choosing the photo container -->
                <div class="container-product-photos-choose">
                    <?php 
                        foreach($images as $image){
                            echo "<div class='product-photos-choose' data-src='{$image["dir"]}'><img class='img-product-choose' src='{$image["dir"]}' data-src='{$image["dir"]}' data-position='{$image["position"]}' alt=''></div>";
                        }
                    ?>
                </div>
                <!-- current photo -->
                <div class="container-product-current-photo">
                    <img class="product-current-photo" src="<?php echo $images[0]["dir"] ?>" alt="">
                </div>
            </div>
            <!-- details container for text info about the product -->
            <div class="container-product-details">
                <a class="product-details-row1">
                    <img class="product-details-header-icon" src="Assets/footer-icons/<?php echo $productSeller ?>.jpg" alt="">
                    <p class="product-details-header-text">by <?php
                    switch ($productSeller){
                        case "csc":
                            echo "College Student Council";
                            break;
                        case "progden":
                            echo "Programmers Den";
                            break;
                        case "ssite":
                            echo "Student Society of Information Technology Education";
                            break;
                        case "jpcs":
                            echo "Junior Philippine Computer Society";
                            break;    
                        }
                    ?></p>
                </a>
                <div class="product-details-row2">
                    <p class="product-title"><?php echo $productName ?></p>
                    <p class="product-price">₱ <?php echo $productPrice ?></p>
                </div>
                <div class="product-details-row3">
                    <p class="product-inventory" data-stock="<?php echo $productStock ?>">Stock: <?php echo $productStock ?></p>
                    <p class="product-quantity-title">Quantity</p>
                    <div class="product-quantity-control">
                        <a class="quantity-control-minus">-</a>
                        <p class="quantity-control-amount">1</p>
                        <a class="quantity-control-plus">+</a>
                    </div>
                </div>
                <div class="product-details-row3">
                    <p class="product-variation-header">Variation</p>
                    <div class="container-product-variation">
                        <?php 
                        foreach($productVariations as $variation){
                            echo "<a class='product-variation' data-variation='{$variation}'>{$variation}</a>";
                        }
                        ?>
                    </div>
                    <input class="btn-product-add-to-cart" type="button" value="Add to Cart">
                </div>

            </div>

        </div>
    </main>

    <?php include "includes/footer.html" ?>
</body>
</html>