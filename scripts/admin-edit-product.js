// This is for variation
const inputVariation = document.querySelector(".input-variation");
const btnAddVariation = document.querySelector(".btn-add-variation");
const intputVariationStore = document.querySelector("#input-variation-store");
const variationList = document.querySelector(".variation-list");
let variationsArray = [];
const containerFormProduct = document.querySelector(".container-add-product");
intputVariationStore.value = "";

btnAddVariation.addEventListener("click", () => {
    addVariation();
});
inputVariation.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        e.preventDefault();
        addVariation();
    }
});
const addVariation = function () {
    const variation = inputVariation.value.trim();
    if (variation && !variationsArray.includes(variation)) {
        variationsArray.push(variation);
        updateUI();
    }
};
function updateUI() {
    variationList.innerHTML = "";
    variationsArray.forEach((item, index, arr) => {
        variationList.insertAdjacentHTML(
            "beforeend",
            `
            <li class="variation" data-index="${index}">
            ${
                index > 0
                    ? `<button type="button" class="move-variation move-variation-left" data-index="${
                          index - 1
                      }"><p><</p></button>`
                    : ""
            }
                <p class="variation-content">${item}</p>
            ${
                index < arr.length - 1
                    ? `<button type="button" class="move-variation move-variation-right" data-index="${
                          index + 1
                      }"><p>></p></button>  `
                    : ""
            }
            </li>
            `
        );
    });
    inputVariation.value = "";
    intputVariationStore.value = JSON.stringify(variationsArray); // Store as JSON in hidden field
}
variationList.addEventListener("click", (event) => {
    if (event.target.closest(".move-variation")) {
        const btnMoveVariation = event.target.closest(".move-variation");
        const parentVariation = btnMoveVariation.closest(".variation");
        [
            variationsArray[parentVariation.dataset.index],
            variationsArray[btnMoveVariation.dataset.index],
        ] = [
            variationsArray[btnMoveVariation.dataset.index],
            variationsArray[parentVariation.dataset.index],
        ];
    } else if (event.target.closest(".variation-content")) {
        const btnRemoveVariation = event.target.closest(".variation-content");
        const parentVariationRemove = btnRemoveVariation.closest(".variation");
        variationsArray = variationsArray.filter(
            (_, i) => i != parentVariationRemove.dataset.index
        );
    }
    updateUI();
});

// This is for imgages ---------------------------------------------------------------------
const inputImage = document.querySelector(".upload-photos");
const containerPreviewImage = document.querySelector(".photos-list");
let listImages = document.querySelectorAll("image-preview");
let imagesToUpload = [];
inputImage.addEventListener("change", (event) => {
    const imageFiles = Array.from(event.target.files);
    containerPreviewImage.innerHTML = "";
    imageFiles.forEach((file, index) => {
        if (
            file.type.startsWith("image/") &&
            !imagesToUpload.some((val) => val.name === file.name)
        ) {
            imagesToUpload.push(file);
        } else {
            alert(`${file.name} is not a valid image.`);
        }
    });
    inputImage.value = "";

    updatePhotos(imagesToUpload);
});

containerPreviewImage.addEventListener("click", function (event) {
    const deleteBtn = event.target.closest(".btn-delete-image");
    if (deleteBtn) {
        const index = deleteBtn.dataset.index;
        // Remove the file from filesToUpload array
        imagesToUpload = imagesToUpload.filter((_, i) => i != index);
        updatePhotos(imagesToUpload);
    }
});

// Override the form's file input before submitting the form
containerFormProduct.addEventListener("submit", function (event) {
    const dataTransfer = new DataTransfer();

    // Add the files that were not removed by the user
    imagesToUpload.forEach((file) => dataTransfer.items.add(file));

    // Update the input element's files property with the selected files
    inputImage.files = dataTransfer.files;
});

async function updatePhotos(photosArr) {
    // Clear the container first
    containerPreviewImage.innerHTML = "";

    for (let index = 0; index < photosArr.length; index++) {
        const file = photosArr[index];
        const result = await readFileAsync(file); // Wait for each file to be read
        const previewHTML = `
            <div class="image-preview" data-index="${index}">
                <img class="photo-image-preview" src="${result}" alt="Image Preview of product">
                <div class="container-move-image">
                    ${
                        index > 0
                            ? `<button type="button" class="move-image" data-index="${
                                  index - 1
                              }"><p><</p></button>`
                            : ""
                    }
                    ${
                        photosArr.length - 1 > index
                            ? `<button type="button" class="move-image" data-index="${
                                  index + 1
                              }"><p>></p></button>`
                            : ""
                    }
                </div>
                <button type="button" class="btn-delete-image" data-index="${index}"><p>X</p></button>
            </div>
        `;
        // Insert the preview into the container
        containerPreviewImage.insertAdjacentHTML("beforeend", previewHTML);
    }

    // Handle empty case
    if (photosArr.length <= 0) {
        containerPreviewImage.innerHTML = "";
    }
}

// Helper function to read files using Promises
function readFileAsync(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            resolve(e.target.result); // Resolve with the file's data URL
        };
        reader.onerror = function (error) {
            reject(error); // Reject on errors
        };
        reader.readAsDataURL(file); // Read the file
    });
}

// This will make images moveable by index

containerPreviewImage.addEventListener("click", (e) => {
    e.preventDefault();
    if (e.target.closest(".move-image")) {
        const btnMoveImage = e.target.closest(".move-image");
        const parentImagePreview = btnMoveImage.closest(".image-preview");
        [
            imagesToUpload[parentImagePreview.dataset.index],
            imagesToUpload[btnMoveImage.dataset.index],
        ] = [
            imagesToUpload[btnMoveImage.dataset.index],
            imagesToUpload[parentImagePreview.dataset.index],
        ];
        updatePhotos(imagesToUpload);
    }
});
