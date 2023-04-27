const sidebarToggleArrow = document.getElementsByClassName("sidebar-toggle")[0];
const sidebarToggleText = document.getElementsByClassName("sidebar-toggle")[1];
const sidebarContent = document.getElementsByClassName("sidebar-content")[0];
const sidebarArrow = document.getElementById("sidebar-arrow");
const sidebarArrowText = document.getElementById("sidebar-arrow-text");
const rotateTable = ["180deg", "0deg"];
const textTable = ["Zatrzymaj", "Schowaj"];

sidebarToggleArrow.addEventListener("click", toggleSidebar);
sidebarToggleText.addEventListener("click", toggleSidebar);

function toggleSidebar() {
    sidebarContent.classList.toggle("sidebar-content-show");
    toggleArrow()
}

function toggleArrow() {
    sidebarArrowText.innerHTML = sidebarArrowText.innerHTML === textTable[0] ? textTable[1] : textTable[0];
    sidebarArrow.style.rotate = sidebarArrow.style.rotate === rotateTable[0] ? rotateTable[1] : rotateTable[0];
}