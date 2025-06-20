<?php include "includes/db.php" ?>
<?php

// Set the filename for the downloaded file
$fileName = "receipt.html";
$transactionID = $_GET["id"];
$queryTransaction = "SELECT * FROM transactions WHERE transaction_id = {$transactionID}";
$productQuery = mysqli_query($connection, $queryTransaction);
if($row = mysqli_fetch_assoc($productQuery)){
    $firstName = $row["first_name"];
    $lastName = $row["last_name"];
    $section = $row["section"];
    $phoneNumber = $row["phone_number"];
    $email = $row["email"];
    $items = json_decode($row["items"], true);
    $totalPrice = $row["total_price"];
}

$receiptItems = "";
foreach($items as $item){
    $amount = $item['price']*$item['quantity'];
    $receiptItems .= "
        <tr>
            <td class='td-qty'>{$item['quantity']}</td>
            <td class='td-description'>{$item['name']}</td>
            <td class='td-unit-price'>₱ {$item['price']}</td>
            <td class='td-amount'>₱ {$amount}</td>
        </tr>
    ";
}

// Dynamically generate the HTML content
$htmlContent = "
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <title>Receipt</title>
    </head>
    <body>
        <main>
            <p class='receipt-title'>Official Receipt of TSU Merch Shop</p>
            <div class='receipt-buyer-info'>
                <p>Name: Joseph Gabriel Castro</p>
                <p>Order Number: 13</p>
                <p>Phone: 09158842192</p>
                <p>Email: blahblah@student.tsu.edu.ph</p>
            </div>
            <table>
                <tr>
                    <th class='th-qty'>QTY</th>
                    <th class='th-description'>Description</th>
                    <th class='th-unit-price'>Unit Price</th>
                    <th class='th-amount'>Amount</th>
                </tr>
                {$receiptItems}
                <tr>
                    <td class='td-qty'></td>
                    <td class='td-description'></td>
                    <th class='th-unit-price'>Subtotal:</th>
                    <th class='th-amount'>₱ {$totalPrice}</th>
                </tr>
            </table>
        </main>
    </body>
    <script>
        window.print();
    </script>
    <style>
    * {
        box-sizing: border-box;
        font-family: Inter;
    }
    html {
        width: 49.5625rem;
        min-height: 100vh;
        margin: auto;
    }
    body {
        margin: 0;
        border: 0;
        padding: 0;
        width: 49.5625rem;
        height: 100%;
    }

    main {
        width: 49.5625rem;
        height: 100%;
        background: #d9d9d9;
        display: flex;
        flex-direction: column;
        align-items: start;
        gap: 3rem;
        padding: 2rem;
        color: #000;
    }
    .receipt-title {
        margin: 0;
        text-align: center;

        font-size: 2rem;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    table {
        align-self: center;
        width: 100%;
        border-collapse: collapse;
    }
    th,
    td {
        padding: 0 0.5rem 0 0.5rem;
    }
    tr {
        height: 2.625rem;
    }
    .receipt-buyer-info p {
        margin: 0.2rem;
    }
    tr:nth-child(even) {
        background: #b8b8b8;
    }
    .th-qty {
        width: 5%;
    }
    .th-description {
        width: 65%;
    }
    .th-unit-price {
        width: 15%;
    }
    .th-amount {
        width: 15%;
    }

    .td-qty {
        text-align: center;
    }
    .td-unit-price {
        text-align: center;
    }
    .td-amount {
        text-align: center;
    }
</style>
</html>
";

// Set headers to force the file download
header('Content-Type: text/html'); // Content type as HTML
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Length: ' . strlen($htmlContent));

echo $htmlContent;

exit;
?>


