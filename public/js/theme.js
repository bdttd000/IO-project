let activeTheme = localStorage.getItem("theme") ?? "dark";

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

if (activeTheme !== "dark") {
    for (const [themeName, rootConfig] of Object.entries(theme)) {
        if (themeName !== activeTheme) continue; 
        for (const [className, value] of Object.entries(rootConfig)) {
            document.querySelector(':root').style.setProperty(className, value);
        }
    }
}
