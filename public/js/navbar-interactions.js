const burger = document.getElementById("navbar-burger");
const sidebar = document.getElementsByClassName("sidebar")[0];
const sidebarShadow = document.getElementsByClassName("sidebar-shadow")[0];
const arrow = document.getElementsByClassName("d-show-sx")[0];
const text = document.getElementsByClassName("d-show-sx")[1];

burger.addEventListener("click", () => {
    sidebar.classList.add("sidebar-show");
    sidebarShadow.classList.add("sidebar-show");
})

function toggleSidebarSx() {
    sidebar.classList.toggle("sidebar-show");
    sidebarShadow.classList.toggle("sidebar-show");
}

arrow.addEventListener("click", toggleSidebarSx);
text.addEventListener("click", toggleSidebarSx);