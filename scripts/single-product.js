// Infors about the product
let quantity = 1;
let variation = "";
let productID = document.querySelector(".container-product").dataset.productid;
const productStock =
    +document.querySelector(".product-inventory").dataset.stock;
console.log(productStock);
// DOMS
const containerQuantityControl = document.querySelector(
    ".product-quantity-control"
);
const containerQuantityAmount = document.querySelector(
    ".quantity-control-amount"
);
const containerVariation = document.querySelector(
    ".container-product-variation"
);
const btnAddToCart = document.querySelector(".btn-product-add-to-cart");

const thumbnailPhoto =
    document.querySelector(".container-product").dataset.thumbnail;
const productName =
    document.querySelector(".container-product").dataset.productName;
const productSeller =
    document.querySelector(".container-product").dataset.productSeller;
const productPrice =
    +document.querySelector(".container-product").dataset.productPrice;

const containerPhotosChoose = document.querySelector(
    ".container-product-photos-choose"
);
const productCurrentPhoto = document.querySelector(".product-current-photo");

const modalAddedToCart = document.querySelector(".modal");

// Event Listeners
containerQuantityControl.addEventListener("click", (e) => {
    const quantityControl = e.target;
    if (
        quantityControl.classList.contains("quantity-control-minus") &&
        quantity > 1
    ) {
        console.log("This is minus");
        quantity--;
    }
    if (
        quantityControl.classList.contains("quantity-control-plus") &&
        quantity < productStock
    ) {
        console.log("This is plus");
        quantity++;
    }
    console.log(quantity);
    updateUI();
});
updateUI();
function updateUI() {
    containerQuantityAmount.innerHTML = quantity;
}

containerVariation.addEventListener("click", (e) => {
    const allVariationControl = Array.from(containerVariation.children);
    allVariationControl.forEach((element) => {
        element.classList.remove("active");
    });
    if (e.target.classList.contains("product-variation")) {
        const variationControl = e.target;
        console.log(typeof variationControl.dataset.variation);
        variationControl.classList.add("active");
        variation = variationControl.dataset.variation;
    }
});
// This is for choosing photo
const choosePhotos = Array.from(containerPhotosChoose.children);
choosePhotos[0].classList.add("product-photos-choose-active");
containerPhotosChoose.addEventListener("click", (e) => {
    if (e.target.classList.contains("img-product-choose")) {
        choosePhotos.forEach((val) => {
            console.log(val);
            val.classList.remove("product-photos-choose-active");
            console.log(val);
        });
        const curImage = e.target;
        const curImageDiv = e.target.closest(".product-photos-choose");
        curImageDiv.classList.add("product-photos-choose-active");
        productCurrentPhoto.src = curImage.dataset.src;

        // product-photos-choose-active
    }
});

// This is for add to cart
btnAddToCart.addEventListener("click", () => {
    if (!variation) {
        alert("Please select a variation");
    } else if (productStock < 1) {
        alert("Product is out of stock!");
    } else {
        const localCart = localStorage.getItem("cart")
            ? JSON.parse(localStorage.getItem("cart"))
            : [];
        console.log(localCart);
        const item = {
            productID,
            productSeller,
            productName,
            productPrice,
            quantity,
            variation,
            thumbnailPhoto,
            productStock,
        };
        localCart.push(item);
        localStorage.setItem("cart", JSON.stringify(localCart));
        openModal();
    }
});
function openModal() {
    modalAddedToCart.classList.add("modal-active");
    setTimeout(() => {
        modalAddedToCart.classList.remove("modal-active");
        location.reload();
    }, 1000);
}
