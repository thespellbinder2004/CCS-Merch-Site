<?php include "includes/db.php" ?>
<?php include "includes/session.php";?>
<?php 
    $queryProduct = "SELECT * FROM products";
        
    $productQuery = mysqli_query($connection, $queryProduct);

    $products = [];
    // getting PRODUCT variables
    while($row = mysqli_fetch_assoc($productQuery)){
        array_push($products, [
            "product_id"=>$row["product_id"],
            "name"=>$row["name"],
            "price"=>$row["price"],
            "seller"=>$row["seller"],
            "variation"=>$row["variations"]
        ]);
    };
    $productIDs = "";
    
    if (!empty($products)){
        foreach ($products as $product){
            $productIDs .= "product_id = {$product['product_id']} OR ";
        }
        $productIDs = rtrim($productIDs, ' OR ');
        $queryImages = "SELECT * FROM images WHERE ({$productIDs}) AND (position=0)";
        $imagesQuery = mysqli_query($connection, $queryImages);
        while($row = mysqli_fetch_assoc($imagesQuery)){
        // images has product_id foreign key, i want to include a "thumbnail"=> $row["dir"] if it matches the product_id inside $products array
            foreach ($products as &$product) {
                if ($product['product_id'] == $row['product_id']) {
                    $product['thumbnail'] = $row['dir']; // Add the thumbnail to the product
                    break; // Exit the loop once the product is found
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-product-listing.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Road+Rage&family=Saira+Stencil+One&display=swap"
        rel="stylesheet"
    />
    <script defer src="scripts/admin-product-listing.js"></script>
    <title>Product Listing</title>
</head>
<body>
    <main>
        <?php include "includes/admin-sidebar.html" ?>
        <div class="container-product-listing">
            <?php 
            $productSeller ;
            for ($i=0; $i < count($products); $i++) {
                switch ($products[$i]['seller']){
                        case "csc":
                            $productSeller = "College Student Council";
                            break;
                        case "progden":
                            $productSeller = "Programmers Den";
                            break;
                        case "ssite":
                            $productSeller = "Student Society of Information Technology Education";
                            break;
                        case "jpcs":
                            $productSeller = "Junior Philippine Computer Society";
                            break;    
                        }
               $markup = "
                <div class='product'>
                    <img class='product-thumbnail' src='{$products[$i]["thumbnail"]}' alt=''>
                    <div class='product-information'>
                        <p class='product-name'>{$products[$i]["name"]}</p>
                        <p class='product-seller'>by {$productSeller}</p>
                        <p class='product-price'>₱ {$products[$i]["price"]}</p>
                    </div>
                    <button class='product-button' type=button data-id='{$products[$i]['product_id']}'>Edit</button>
                </div>
               ";
               echo $markup;
            }
            ?>
            <!-- <div class="product">
                <img class="" src="images/lanyard.jpg" alt="">
                <div class="product-information">
                    <p class="product-name">CSC Red Hawk Merch Bunder (2024)</p>
                    <p class="product-seller">by College Student Council</p>
                    <p class="product-price">₱ 269</p>
                </div>
                <button class="product-button" type="button">Edit</button>
            </div> -->
        </div>
    </main>
</body>
</html>