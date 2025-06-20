// DOMS
const btnMenu = document.querySelector(".btn-menu-a");
const navMenu = document.querySelector(".container-navigation-responsive");
const windowOverlay = document.querySelector(".window-overlay");
const containerCart = document.querySelector(".container-cart");
const btnCart = document.querySelector("#btn-cart");
const btnCloseCart = document.querySelector(".btn-close-cart");
const navMenuSize = navMenu.getBoundingClientRect();

// Variables
let isCartOpen = false;
// Add Event Listeners
btnMenu.addEventListener("click", (e) => {
    e.preventDefault();
    toggleNavMenu();
});
document.addEventListener("keydown", (e) => {
    if (e.code === "Escape") {
        if (isCartOpen) {
            closeCart();
        } else toggleNavMenu();
    }
});
windowOverlay.addEventListener("click", (e) => {
    closeCart();
});
btnCart.addEventListener("click", (e) => {
    e.preventDefault();
    openCart();
});
btnCloseCart.addEventListener("click", (e) => {
    e.preventDefault();
    closeCart();
});

// This is for transition end
windowOverlay.addEventListener("transitionend", (e) => {
    if (e.propertyName === "opacity") {
        if (isCartOpen) return;
        windowOverlay.classList.add("window-overlay-closed");
    }
});
// Functions
function toggleNavMenu() {
    navMenu.classList.toggle("hide-menu");
}
function openCart() {
    document.body.classList.add("no-scroll");
    windowOverlay.classList.remove("window-overlay-closed");
    windowOverlay.classList.add("window-overlay-opened");

    containerCart.classList.add("container-cart-active");
    isCartOpen = true;
}
function closeCart() {
    document.body.classList.remove("no-scroll");
    windowOverlay.classList.remove("window-overlay-opened");
    containerCart.classList.remove("container-cart-active");
    isCartOpen = false;
}
