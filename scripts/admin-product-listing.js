const containerListing = document.querySelector(".container-product-listing");
containerListing.addEventListener("click", (e) => {
    if (e.target.classList.contains("product-button")) {
        const btnEdit = e.target;
        let confirmContinue = confirm(
            "Editing product will delete images in database, you have to upload them again. Do you wish to continue?"
        );
        if (confirmContinue) {
            window.location.href = `/CCS_merch_site/admin-edit-product.php?id=${btnEdit.dataset.id}`;
            console.log(btnEdit);
        }
    }
});
