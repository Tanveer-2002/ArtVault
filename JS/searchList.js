const mainBtn = document.getElementById("mainBtn");
const dropdownMenu = document.getElementById("dropdownMenu");

mainBtn.addEventListener("click", () => {
    dropdownMenu.classList.toggle("active");
});

const submenuButtons = document.querySelectorAll(".submenu-btn");

submenuButtons.forEach(button => {
    button.addEventListener("click", () => {

        const submenu = button.nextElementSibling;

        document.querySelectorAll(".submenu").forEach(item => {
            if(item !== submenu){
                item.classList.remove("active");
                item.previousElementSibling.querySelector("span").textContent = "+";
            }
        });

        submenu.classList.toggle("active");

        button.querySelector("span").textContent =
            submenu.classList.contains("active") ? "−" : "+";
    });
});