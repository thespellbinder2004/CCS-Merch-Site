<?php include "includes/db.php" ?>
<?php include "includes/session.php"; ?>
<?php 


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
    <link rel="stylesheet" href="css/admin.css">
    <script defer src="scripts/admin.js"></script>
    <title>Add product</title>

</head>
<body>
    <main>
        <?php include "includes/admin-sidebar.html" ?>
        <form action="admin-server.php" method="post" name="product" class="container-add-product" enctype="multipart/form-data">
            <div class="toolbar">
                <input name="save-post" class="btn-save" type="submit" value="Save">
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
                    <input class="input-title" type="text" name="title" maxlength="50" required>
                </div>
                <div class="container-add-function">
                    <label for="">Stock</label>
                    <input class="input-stock" type="number" name="stock" min="0" max="199" step="1" value="" required>
                </div>
                <div class="container-add-function">
                    <label for="price">Price</label>
                    <div class="container-input-number">
                        <p class="peso-sign">₱</p>
                        <input class="input-number" type="number" name="price" min="1" step=".01" required>
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
</html>