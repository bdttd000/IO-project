let activeTheme = localStorage.getItem("theme") ?? "dark";
const toggleButton = document.getElementById("toggleButton");
const toggleCheckbox = document.getElementById("toggleCheckbox");


var theme = {
    "dark": {
        "--main-bg": "var(--grey-900)",
        "--navbar-footer-bg": "var(--grey-1000)",
        "--card-bg": "var(--grey-100)",
    },
    "light": {
        "--main-bg": "var(--grey-300)",
        "--navbar-footer-bg": "var(--grey-100)",
        "--card-bg": "var(--grey-100)",
    }
}

const applyTheme = () => {
    for (const [themeName, rootConfig] of Object.entries(theme)) {
        if (themeName !== activeTheme) continue; 
        for (const [className, value] of Object.entries(rootConfig)) {
            document.querySelector(':root').style.setProperty(className, value);
        }
    }
}

applyTheme();

const listenToggle = () => {
    activeTheme = activeTheme === "dark" ? "light" : "dark";
    localStorage.setItem("theme", activeTheme);
    applyTheme();
}

const listenToggleText = () => {
    toggleCheckbox.checked = !toggleCheckbox.checked;
    listenToggle();
}

toggleButton.addEventListener("click", listenToggle)