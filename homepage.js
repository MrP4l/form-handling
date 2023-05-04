const scrollFromTo = (() =>  {
    const button = document.getElementById("joinUsButton");
    const formContainer = document.getElementById("formContainer");
    button.addEventListener("click", () => {
        formContainer.scrollIntoView({ 
            behavior: 'smooth' 
        })
    });
})();

const placeHolderCleaner = (() => {
    const inputs = document.querySelectorAll(".form-control");
    for (let input of inputs) {
        input.addEventListener("focus", () => {
            input.placeholder = "";
        })
        input.addEventListener("blur", () => {
            input.placeholder = input.getAttribute("data-placeholder");
        });
        input.setAttribute("data-placeholder", input.placeholder);
    }
})();



/*(() => {
    const button = document.getElementById("button");
    button.addEventListener("click", () => {
        window.location.href="registrationForm.php"
    })
})();*/