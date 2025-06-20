<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="css/check-out.css" />
        <link rel="stylesheet" href="css/style.css">
        <script defer src="scripts/check-out-cart.js"></script>
        <title>CCS Merch Site</title>
    </head>

    <body>
        <?php include "includes/header.html" ?>
        <div class="sectionContainer">
            <div class="containerBoxPad">
                <section>
                    <div class="customerInfoContainer">
                        <p class="customerInfo">Customer Information</p>

                        <form action="check-out-server.php" method="post" name="order" class="form" enctype="multipart/form-data">
                            <label class="formStyle">Email</label><br />
                            <input
                                id="emailTextBox"
                                type="text"
                                placeholder="Enter Email"
                                name="email"
                                title="Please enter a valid TSU email ending with @student.tsu.edu.ph"
                                required
                            />
                            <!-- <script>
                                if(document.querySelector('.form')){
                                    document.querySelector('.form').addEventListener('submit', function (e) {
                                     
                                    var emailInput = document.getElementById('emailTextBox');
                                    var emailPattern = /^[a-zA-Z0-9._%+-]+@student\.tsu\.edu\.ph$/;
                                    if (!emailPattern.test(emailInput.value)) {
                                        e.preventDefault();  // Prevent form submission
                                        alert("Please enter a valid TSU email ending with @student.tsu.edu.ph");
                                    }
                                });
                                }
                                
                            </script> -->
                            <br />

                            <div class="containerBoxPad">
                                <div class="boxPad">
                                    <label class="formStyle">First Name</label
                                    ><br />
                                    <input
                                        id="textAreaSmall"
                                        type="text"
                                        placeholder="Enter First Name"
                                        name="first_name"
                                        required
                                    /><br />
                                </div>

                                <div class="boxPad">
                                    <label class="formStyle">Last Name</label
                                    ><br />
                                    <input
                                        id="textAreaSmall"
                                        type="text"
                                        placeholder="Enter Last Name"
                                        name="last_name"
                                        required
                                    />
                                    <br />
                                </div>
                            </div>

                            <div class="containerBoxPad">
                                <div class="boxPad">
                                    <label class="formStyle"
                                        >Course, Yr & Section</label
                                    ><br />
                                    <input
                                        id="textAreaSmall"
                                        type="text"
                                        placeholder="Enter Course, Yr & Section"
                                        name="section"
                                        required
                                    /><br />
                                </div>
                                <div class="boxPad">
                                    <label class="formStyle">Phone Number</label
                                    ><br />
                                    <input
                                        id="textAreaSmall"
                                        type="number"
                                        
                                        placeholder="Enter Phone Number"
                                        name="phone"
                                        required
                                    /><br />
                                </div>
                            </div>

                            <p class="customerInfo">Upload Gcash Receipt
                                <br>
                                09158842192
                            </p>
                            
                            <div class="paymentContainerBoxPad">
                                <div class="paymentBoxPad">
                                    <input type="file" name="receipt" accept="image/*" required/>
                                </div>
                                <input type="hidden" name="items" id="items-input">
                                <input type="hidden" name="total-price" id="total-price">
                            </div>
                            <input type="submit" value="Check Out" class="btn-cart-checkout">
                            <p class="backToMain">
                                <a
                                    class="backToMain"
                                    href="landing_page.php"
                                    target="_self"
                                    title="Go back"
                                >
                                    <- Return to Home</a
                                >
                            </p>
                        </form>
                    </div>
                    <div class="line"></div>
                </section>
            </div>

            <div class="checkoutContainer">
                <div class="containerCheckOutListBoxPad">
                    <section>
                        <div class="customerContainerlist">
                            <p class="cart">Your Cart</p>
                            <div id="cart-items">
                                <ul class="container-cart-items-checkout" style="color: #000; font-family: Poppins">
                                    <!-- <li>You have no Items in the Cart!</li> -->
                                    <!-- <li class="cart-item">
                                        <div class="cart-item-description">
                                            <img
                                                class="cart-item-img"
                                                src="product_images/1.jpg"
                                                alt=""
                                            />
                                            <div class="cart-item-text">
                                                <p class="cart-item-title">
                                                    Merch of 2024
                                                </p>
                                                <p class="cart-item-seller">by College Student Council</p>
                                                <p class="cart-item-variation">variation</p>
                                                <div class="cart-item-amount">
                                                    <p>x 6</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="cart-item-price">$ 500</p>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </section>
                    <div class="line"></div>
                    <div class="customerContainerTotal">
                        <div class="containerBoxPad">
                            <div class="totalText">
                                <strong>Total:</strong>
                            </div>

                            <div class="totalValue">
                                <span id="cart-total">₱ 00</span>
                            </div>

                            <!--
                              <span>
                            <strong class="totalText">Total:</strong> <strong class="totalValue">$0</strong>
                            </span>
                        
                        --></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "includes/footer.html" ?>
        
    </body>

    <!--<header>
    <div class="container-header-logo">
        <img class="red-hawks-logo" src="Assets/Red_Hawks_Logo.png" alt="" />
        <p id="ccs-logo-text">CCS Merch Shop</p>
        <p class="email">Email</p>
        <p class="firstN">First Name</p>
        <p class="lastN">last Name</p>
        <p class="yrAndSec">Yr & Section</p>
        <p class="phoneNum">Phone Number</p>
        <p class="payment">Payment</p>
    </div>
    
</header>
<body>

    <div class="leftContainer">
        <h4 class="CustomerInfo">Customer Information</h4>
        <form>
            <label class="formStyle">Email</label><br>
            <input id="containerBoxInput" type="text" placeholder="Enter Email" required> <br>

            <label class="formStyle">First Name</label><br>
            <input id="containerBoxInput" type="text" placeholder="Enter First Name" required> <br>

            <label class="formStyle">Last Name</label><br>
            <input id="containerBoxInput" type="text" placeholder="Last Name" required> <br>

            <label class="formStyle">Yr & Section</label><br>
            <input id="containerBoxInput" type="text" placeholder="Yr & Section" required><br>

            <label class="formStyle">Phone Number</label><br>
            <input id="containerBoxInput" type="text" placeholder="Phone Number" required> <br>

        </form>
    </div>

</body>-->
</html>
