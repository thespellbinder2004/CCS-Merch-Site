const modalDetails = document.querySelector(".modal-sale-details");
const main = document.querySelector("main");
const containerSales = document.querySelector(".container-sales");
let isModalOpen = false;
// Adding Event Listeners ----------------------------------
document.addEventListener("click", (e) => {
    if (!modalDetails.contains(e.target)) {
        closeModalDetails();
    }
});
containerSales.addEventListener("click", (e) => {
    if (e.target.classList.contains("sales-button")) {
        if (isModalOpen) {
            return;
        }
        e.stopPropagation();
        openModalDetails(e.target.dataset);
    }
});

// These are the functions ---------------------------------------
// Fore Open and Close Modal
function closeModalDetails() {
    main.style.filter = "";
    modalDetails.style.display = "none";
    console.log("closed");
    isModalOpen = false;
}
function openModalDetails(dataset) {
    const email = dataset.email;
    const fullName = `${dataset.firstname} ${dataset.lastname}`;
    const section = dataset.section;
    const phoneNumber = dataset.phonenumber;
    const total = +dataset.totalprice;
    const receipt = dataset.receipt;
    const items = JSON.parse(dataset.items);
    const received = +dataset.received;
    const transactionID = +dataset.transactionid;

    let modalItems = "";
    items.forEach((val) => {
        modalItems += `
            <li class="modal-detail">
                <div class="modal-detail-col1">
                    <p>${val.name}</p>
                    <p>by ${val.seller}</p>
                    <p class="modal-detail-box">${val.variation}</p>
                    <p class="modal-detail-box">x ${val.quantity}</p>
                </div>
                <p class="modal-detail-price">$ ${val.price * val.quantity}</p>
            </li>
        `;
    });
    const markup = `
         <div class="container-modal-header">
            <div>
                <p>Order Numer: ${transactionID}</p>
                <p>Name: ${fullName}</p>
                <p>Section: ${section}</p>
                <p>Total: $ ${total}</p>
                <p>Phone Number: 0${phoneNumber}</p>
                <p>Email: ${email}</p>
            </div>
            <a class="btn-receipt" type="button" href="${receipt}" target="_blank">Receipt</a>

        </div>
        <ul class="container-modal-details">
            ${modalItems}
        </ul>
    `;
    modalDetails.innerHTML = markup;
    console.log("opened");
    modalDetails.style.display = "block";
    main.style.filter = "brightness(50%)";
    isModalOpen = true;
}
