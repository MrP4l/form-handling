(() =>  {
    const joinUsButton = document.getElementById("joinUsButton");
    const secondContainer = document.getElementById("secondContainer");
    joinUsButton.addEventListener("click", () => {
        secondContainer.scrollIntoView({ 
            behavior: 'smooth' 
        })
    });
    const logInButton = document.getElementById("logInButton");
    const thirdContainer = document.getElementById("thirdContainer");
    logInButton.addEventListener("click", () => {
        thirdContainer.scrollIntoView({
            behavior: 'smooth'
        })
    });
})();

(() => {
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

(() => {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    confirmPassword.addEventListener("input", () => {
        if (password.value !== confirmPassword.value) {
            confirmPassword.classList.add("is-invalid")
        } else {
            confirmPassword.classList.remove("is-invalid");
        }
    })
})();

(() => {
    const form = document.getElementById("form");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    form.addEventListener("submit", (event) => {
        if (password.value !== confirmPassword.value) {
            event.preventDefault();
        }
    })
})();
