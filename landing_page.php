<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="css/landing-page.css" />
        <link rel="stylesheet" href="css/style.css" />
        <script defer src="scripts/landing_page.js"></script>
        <title>CCS Merch Site</title>
    </head>
    <body>
       
        <?php include "includes/header.html" ?>
        <main>
            <div class="banner-slider">
                <!-- <a class="btn-view-merch" href="">View Merch</a> -->
                <a class="banner" href="/CCS_merch_site/archive-product.php?seller=progden"><img src="Assets/banner/progden-banner.jpg" alt=""></a>
                <a class="banner" href="/CCS_merch_site/archive-product.php?seller=jpcs"><img src="Assets/banner/jpcs-banner.png" alt=""></a>
                <a class="banner" href="/CCS_merch_site/archive-product.php?seller=ssite"><img src="Assets/banner/ssite-banner.jpg" alt=""></a>
                <a class="banner" href="/CCS_merch_site/archive-product.php?seller=csc"><img src="Assets/banner/csc-banner.jpg" alt=""></a>
                <button class="btn-slider btn-slider-left" type="button"><img src="Assets/icons/arrow_right.svg" alt=""></button>
                <button class="btn-slider btn-slider-right" type="button"><img src="Assets/icons/arrow_right.svg" alt=""></button>
            </div> 
            <!-- Responsive icons, removing the slider -->
            <div class="container-org-icons-responsive">

                <a class="org-icon" id="org-icon-csc" href="/CCS_merch_site/archive-product.php?seller=csc" ></a>
                <a class="org-icon" id="org-icon-jpcs" href="/CCS_merch_site/archive-product.php?seller=jpcs" ></a>
                <a class="org-icon" id="org-icon-ssite" href="/CCS_merch_site/archive-product.php?seller=ssite" ></a>
                <a class="org-icon" id="org-icon-progden" href="/CCS_merch_site/archive-product.php?seller=progden" ></a>
            </div>

            <!-- <div class="exclusive-bundles">
                <h1 class="header-product">Exclusive Bundles</h1>
                <ul class="container-product">
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                </ul>
                <a class="btn-view-all btn-view-all-exclusive-product" href=""
                    >View All</a
                >
            </div>

            <div class="apparel">
                <h1 class="header-product">Apparel</h1>
                <ul class="container-product">
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                </ul>
                <a class="btn-view-all btn-view-all-apparel" href=""
                    >View All</a
                >
            </div>

            <div class="accessories">
                <h1 class="header-product">Accessories</h1>
                <ul class="container-product">
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                    <li class="product-li">
                        <img
                            class="product-img"
                            src="Assets/products/csc-bundle.jpg"
                            alt=""
                        />
                        <p>TSU CCS Shirt (2024)</p>
                        <p>₱ 269</p>
                    </li>
                </ul>
                <a class="btn-view-all btn-view-all-accessories" href=""
                    >View All</a
                >
            </div> -->
        </main>

        <?php include "includes/footer.html" ?>
    </body>
</html>
