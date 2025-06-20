
<?php
// Set headers to trigger the file download

$receiptFile = "download-receipt.php?id={$_GET['id']}"; // Path to the file you want to download
$fileName = "receipt.html";

?>

<!-- HTML output should only occur after the download header has been sent -->
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
        <title>Success!</title>
    </head>
    <body>
        <?php include "includes/header.html" ?>
        <script>localStorage.clear();</script>
        <div class="order-success">
            ORDER SUCCESS. RECEIVE ORDER AT TSU SAN ISIDRO CAMPUS.
        </div>

        <?php include "includes/footer.html" ?>
    </body>
    <script>
            // Trigger the file download automatically
            window.onload = function () {
                const link = document.createElement("a");
                link.href = "<?php echo $receiptFile; ?>"; // File path
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            };
    </script>
</html>
