const btnShowPassword = document.querySelector(".btn-show-password");
const passwordInput = document.getElementById("password-input");
const eyeIcon = document.querySelector(".eye-icon");
let isPasswordVisible = false;
btnShowPassword.addEventListener("click", (e) => {
    if (isPasswordVisible) {
        eyeIcon.src = "Assets/icons/eye-closed.svg";
        passwordInput.type = "password";
        isPasswordVisible = false;
    } else {
        passwordInput.type = "text";
        eyeIcon.src = "Assets/icons/eye-open.svg";
        isPasswordVisible = true;
    }
});
