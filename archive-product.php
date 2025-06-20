<?php include "includes/db.php";
         
    // query stuff, will never be used again

    
    $queryProduct = "SELECT * FROM products WHERE seller = '{$_GET['seller']}'";
    
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
    $orgName = "";
    switch ($_GET['seller']){
        case "csc":
            $orgName = "College Student Council";
            break;
        case "progden":
            $orgName = "Programmers Den";
            break;
        case "ssite":
            $orgName = "Student Society of Information Technology Education";
            break;
        case "jpcs":
            $orgName = "Junior Philippine Computer Society";
            break;    
        }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/archive-product.css">
    <script defer src="scripts/archive-product.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $orgName ?></title>
</head>
<body>
    <?php include "includes/header.html" ?>
    <main>
        <?php
        
        if (empty($products)){
            ?>
            <h1 class="no-items">NO ITEMS HERE</h1>
            <?php
        }else{

        ?>
        <div class="container-archive" data-products="<?php echo json_encode($products) ?>">
            <h1 class="header-product">
                <?php 
                    switch ($_GET['seller']){
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
                ?>
            </h1>
            <ul class="container-product">
                <?php 
                for ($i = 0; $i < count($products); $i++) {
                
                    $markup = "
                        <a href='/CCS_merch_site/single-product.php?id={$products[$i]["product_id"]}'>
                            <li class='product-li'>
                                <img
                                    class='product-img'
                                    src='{$products[$i]["thumbnail"]}'
                                    alt=''
                                />
                                <p>{$products[$i]['name']}</p>
                                <p>₱ {$products[$i]['price']}</p>
                            </li>                   
                        </a>
                    ";
                    echo $markup;
                }
                ?>
            </ul>
        </div>
    </main>
    <?php } include "includes/footer.html" ?>
</body>
</html>