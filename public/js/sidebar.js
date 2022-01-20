// document.addEventListener("DOMContentLoaded", function () {
//     let sidebar = document.querySelector(".sidebar");

//     localStorage.setItem("sidebar", false);
//     sidebar.classList.add("animate__slideOutLeft");
// });

// document.addEventListener("click", (e) => {
//     let sidebar = document.querySelector(".sidebar");
//     const sidebarOpen = localStorage.getItem("sidebar");

//     if (!e.target.classList.contains("menu")) {
//         return;
//     }

//     if (sidebarOpen === "false") {
//         sidebar.classList.add("animate__slideInLeft");

//         sidebar.classList.remove("animate__slideOutLeft");
//         localStorage.setItem("sidebar", true);
//     } else {
//         sidebar.classList.add("animate__slideOutLeft");
//         localStorage.setItem("sidebar", false);

//         sidebar.classList.remove("animate__slideInLeft");
//     }
// });

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".menu");
sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if (sidebar.classList.contains("animate__slideOutLeft")) {
        sidebar.classList.remove("animate__animated", "animate__slideOutLeft")
    }
    sidebar.classList.add("animate__animated", "animate__slideInLeft");
});

let closeBtn = document.querySelector(".close-btn");
closeBtn.addEventListener("click", () => {

    if (sidebar.classList.contains("animate__slideInLeft")) {
        sidebar.classList.remove("animate__animated", "animate__slideInLeft")
    }
    sidebar.classList.add("animate__animated", "animate__slideOutLeft");

    setTimeout(() => {
        sidebar.classList.toggle("close");
    }, 500);
});
