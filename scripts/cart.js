const cartNumItems = document.querySelector(".cart-num-items");
const containerCartItems = document.querySelector(".container-cart-items");
const cartSubtotal = document.querySelector(".subtotal");
const cartLogoNumItems = document.querySelector(".cart-logo-num-items");

let localCart = JSON.parse(localStorage.getItem("cart")) ?? [];
console.log(localCart);
let subtotal = 0;

refresh();

// Functions -----------------------
function refresh() {
    containerCartItems.innerHTML = "";
    localCart = JSON.parse(localStorage.getItem("cart")) ?? [];
    // Combine Everything that has same productID and variation
    console.log(localCart);
    localCartReduced = localCart.reduce((acc, item) => {
        // Create a unique key combining productID and variation
        const key = `${item.productID}-${item.variation}`;
        console.log(item);
        // If this key doesn't exist in the accumulator object, create it
        if (!acc[key]) {
            acc[key] = {
                productID: item.productID,
                productSeller: item.productSeller,
                productName: item.productName,
                productPrice: item.productPrice, // Initialize total price
                quantity: item.quantity, // Initialize total quantity
                variation: item.variation,
                thumbnailPhoto: item.thumbnailPhoto,
                productStock: item.productStock,
            };
        } else {
            // If the key exists, update the total price and quantity
            acc[key].quantity += item.quantity;
        }

        return acc;
    }, {});

    itemsCart = Object.values(localCartReduced);
    localStorage.setItem("cart", JSON.stringify(itemsCart));
    subtotal = itemsCart.reduce((total, item) => {
        return total + item.productPrice * item.quantity;
    }, 0);
    subtotal = Math.round(subtotal * 100) / 100;
    cartSubtotal.innerHTML = `₱ ${subtotal}`;
    itemsCart.forEach((element) => {
        containerCartItems.insertAdjacentHTML(
            "afterbegin",
            generateItemMarkup(
                element.productName,
                element.productSeller,
                element.productPrice,
                element.quantity,
                element.variation,
                element.thumbnailPhoto,
                element.productID
            )
        );
    });
    cartNumItems.innerHTML = `${itemsCart.length} ${
        itemsCart.length > 1 ? "items" : "item"
    }`;
    cartLogoNumItems.innerHTML = itemsCart.reduce(
        (total, item) => total + item.quantity,
        0
    );
}
function generateItemMarkup(
    name,
    seller,
    price,
    quantity,
    variation,
    thumbnail,
    productID
) {
    let productSeller = "none";
    switch (seller) {
        case "csc":
            productSeller = "College Student Council";
            break;
        case "jpcs":
            productSeller = "Junior Philippine Computer Society";
            break;
        case "ssite":
            productSeller =
                "Student Society of Information Techonology Education";
            break;
        case "progden":
            productSeller = "Programmers Den";
            break;
        default:
            productSeller = seller;
            break;
    }
    const markupCartItem = `
        <li class="cart-item">
            <div class="cart-item-description">
                <img
                    class="cart-item-img"
                    src="${thumbnail}"
                    alt=""
                />
                <div class="cart-item-text">
                    <p class="cart-item-title">
                        ${name} (2024)
                    </p>
                    <p class="cart-item-seller">by ${productSeller}</p>
                    <p class="cart-item-variation">${variation}</p>
                    <div class="cart-item-amount">
                        <a class="cart-item-amount-control minus" data-id="${productID}">-</a>
                        <p>${quantity}</p>
                        <a class="cart-item-amount-control plus" data-id="${productID}">+</a>
                        <img class="btn-remove-item" src="Assets/trash-can.svg" data-id="${productID}" data-variation="${variation}">
                    </div>
                </div>
            </div>
            <p class="cart-item-price">₱ ${price}</p>
        </li>
    `;
    return markupCartItem;
}

// Event Listeners
containerCartItems.addEventListener("click", (e) => {
    localCart = JSON.parse(localStorage.getItem("cart")) ?? [];
    if (e.target.classList.contains("btn-remove-item")) {
        const btnDelete = e.target;
        localCart = localCart.filter((item) => {
            return (
                item.productID !== btnDelete.dataset.id ||
                item.variation !== btnDelete.dataset.variation
            );
        });
        localStorage.setItem("cart", JSON.stringify(localCart));
        refresh();
    }

    // This is for editing the amounts of a product
    if (e.target.classList.contains("cart-item-amount-control")) {
        const btnAmountControl = e.target;
        const itemProductID = e.target.dataset.id;
        if (btnAmountControl.classList.contains("plus")) {
            localCart = localCart.map((item) => {
                console.log(item);
                return item.productID === itemProductID
                    ? {
                          ...item,
                          quantity:
                              item.quantity < item.productStock
                                  ? item.quantity + 1
                                  : item.productStock,
                      }
                    : item;
            });
            localStorage.setItem("cart", JSON.stringify(localCart));
            refresh();
        }
        if (btnAmountControl.classList.contains("minus")) {
            console.log(typeof localCart);
            localCart = localCart.map((item) => {
                return item.productID === itemProductID
                    ? {
                          ...item,
                          quantity:
                              item.quantity > 1
                                  ? item.quantity - 1
                                  : item.quantity,
                      }
                    : item;
            });
            localStorage.setItem("cart", JSON.stringify(localCart));

            refresh();
        }
    }
});
