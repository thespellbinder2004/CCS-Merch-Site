let localCartCheckout = JSON.parse(localStorage.getItem("cart")) ?? [];
const itemsInput = document.querySelector("#items-input");

function landingPage() {
    window.open(css / landing_page.php);
}
console.log(typeof localStorage.getItem("cart"));
if (localCartCheckout === null || localCartCheckout.length === 0) {
    window.location.href = "/CCS_merch_site/landing_page.php";
}

// This is for displaying cart items

let subtotalCheckout = localCartCheckout.reduce((total, item) => {
    return total + item.productPrice * item.quantity;
}, 0);
subtotalCheckout = Math.round(subtotalCheckout * 100) / 100;
document.querySelector("#total-price").value = subtotalCheckout;
const cartTotal = document.querySelector("#cart-total");
const containerCheckOutItems = document.querySelector(
    ".container-cart-items-checkout"
);
function refresh() {
    localCartCheckout.forEach((element) => {
        containerCheckOutItems.insertAdjacentHTML(
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
    cartTotal.innerHTML = `₱ ${subtotalCheckout}`;

    // This is for adding items in input type hidden
    let itemsOrdered = Array.from(document.querySelectorAll(".cart-item"));
    itemsOrdered = itemsOrdered.map((val) => {
        return { ...val.dataset };
    });
    itemsOrdered = itemsOrdered.map((val) => {
        return {
            ...val,
            price: +val.price,
            quantity: +val.quantity,
            productid: +val.productid,
        };
    });
    console.log();
    console.log(itemsOrdered);
    itemsInput.value = JSON.stringify(itemsOrdered);
}
refresh();
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
        <li class="cart-item" data-name="${name}" data-variation="${variation}" data-quantity="${quantity}" data-price="${price}" data-seller="${productSeller}" data-productId="${productID}">
            <div class="cart-item-description">
                <img
                    class="cart-item-img"
                    src="${thumbnail}"
                    alt=""
                />
                <div class="cart-item-text">
                    <p class="cart-item-title">
                        ${name}
                    </p>
                    <p class="cart-item-seller">by ${productSeller}</p>
                    <p class="cart-item-variation">${variation}</p>
                    <div class="cart-item-amount">
                        <p>x ${quantity}</p>
                    </div>
                </div>
            </div>
            <p class="cart-item-price">$ ${price}</p>
        </li>
    `;

    return markupCartItem;
}
