const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

console.log(togglePassword.textContent);

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type =
        password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // toggle the icon
    togglePassword.textContent =
        password.getAttribute("type") === "password"
            ? "visibility_off"
            : "visibility";
});
