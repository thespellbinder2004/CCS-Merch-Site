<?php include "includes/db.php" ?>
<?php include "includes/session.php"; ?>
<?php 

$querySales = "SELECT * FROM transactions";
$sales = [];
$salesQuery = mysqli_query($connection, $querySales);
while($row = mysqli_fetch_assoc($salesQuery)){
    array_push($sales, [
        "transaction_id"=>$row["transaction_id"],
        "first_name"=>$row["first_name"],
        "last_name"=>$row["last_name"],
        "section"=>$row["section"],
        "email"=>$row["email"],
        "phone_number"=>$row["phone_number"],
        "total_price" => $row["total_price"],
        "receipt" => $row["receipt_dir"],
        "items" => $row["items"],
        "received" => $row["received"]
    ]);
};

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
    <!-- <link rel="stylesheet" href="css/admin-product-listing.css"> -->
    <link rel="stylesheet" href="css/admin-sales.css">
    <script defer src="scripts/admin-sales.js"></script>
    <title>Sales</title>
</head>
<body>
    <!-- This modal will open if details is pressed -->
    <div class="modal-sale-details">
        <div class="container-modal-header">
            <div>
                <p>Order Numer: 1</p>
                <p>Name: Joseph Gabriel Castro</p>
                <p>Section: BSCS-3A</p>
                <p>Total: $ 169</p>
                <p>Phone Number: 09217398288</p>
            </div>
            <a class="btn-receipt" type="button">Receipt</a>

        </div>
        <ul class="container-modal-details">
            <li class="modal-detail">
                <div class="modal-detail-col1">
                    <p>CSC Red Hawk Merch Bundle 2024</p>
                    <p>by College Student Council</p>
                    <p class="modal-detail-box">Large</p>
                    <p class="modal-detail-box">x 3</p>
                </div>
                <p class="modal-detail-price">$ 669</p>
            </li>
        </ul>
    </div>
    <main>
        <?php include "includes/admin-sidebar.html" ?>


        <div class="container-sales">
        
            <?php 
            for($i = 0; $i < count($sales); $i++) {
                $markup = 
                
                "  <div class='sales'>
                        <div class='sales-information'>
                            <p class='sales-name'>{$sales[$i]['first_name']} {$sales[$i]['last_name']}</p>
                            <p class='sales-seller'>{$sales[$i]['email']}</p>
                            <p class='sales-seller'>{$sales[$i]['phone_number']}</p>
                            <p class='sales-price'>₱ {$sales[$i]['total_price']}</p>
                        </div>
                        <button class='sales-button' type='button' data-receipt='{$sales[$i]["receipt"]}' data-firstName='{$sales[$i]["first_name"]}' data-lastName='{$sales[$i]["last_name"]}' data-section='{$sales[$i]["section"]}' data-email='{$sales[$i]["email"]}' data-phoneNumber='{$sales[$i]["phone_number"]}' data-totalPrice='{$sales[$i]["total_price"]}' data-items='{$sales[$i]["items"]}' data-received='{$sales[$i]["received"]}' data-transactionID='{$sales[$i]["transaction_id"]}' data-section='{$sales[$i]["section"]}'>Details</button>
                    </div>
                    ";
                echo $markup;
            }
            ?>
        </div>
    </main>
</body>
</html>