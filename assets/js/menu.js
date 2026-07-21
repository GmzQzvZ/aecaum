function toggleMenu(event) {
    console.log("Toggle menu called");
    event.preventDefault();
    event.stopPropagation();
    
    const overlay = document.getElementById("custom-menu-overlay");
    if (overlay) {
        console.log("Opening menu");
        overlay.style.display = "block";
        setTimeout(() => {
            overlay.classList.add("active");
        }, 10);
    }
}

function closeMenu(event) {
    console.log("Close menu called");
    event.preventDefault();
    event.stopPropagation();
    
    const overlay = document.getElementById("custom-menu-overlay");
    if (overlay) {
        console.log("Closing menu");
        overlay.classList.remove("active");
        setTimeout(() => {
            overlay.style.display = "none";
        }, 300);
    }
}