document.addEventListener("DOMContentLoaded", function () {
    let sidebar = document.querySelector(".sidebar");

    localStorage.setItem("sidebar", false);
    sidebar.classList.add("animate__slideOutLeft");
});

document.addEventListener("click", (e) => {
    let sidebar = document.querySelector(".sidebar");
    const sidebarOpen = localStorage.getItem("sidebar");

    if (!e.target.classList.contains("menu")) {
        return;
    }

    if (sidebarOpen === "false") {
        sidebar.classList.add("animate__slideInLeft");

        sidebar.classList.remove("animate__slideOutLeft");
        localStorage.setItem("sidebar", true);
    } else {
        sidebar.classList.add("animate__slideOutLeft");
        localStorage.setItem("sidebar", false);

        sidebar.classList.remove("animate__slideInLeft");
    }
});
