(function smoothScroll() {
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

(function savePlaceholder() {
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

(function nameValidation() {
    const name = document.getElementById("name");
    name.addEventListener("blur", () => {
        if (name.value === "") {
            name.classList.add("is-invalid");
        } else {
            name.classList.remove("is-invalid");
        }
    })
})();

(function surnameValidation() {
    const surname = document.getElementById("surname");
    surname.addEventListener("blur", () => {
        if (surname.value === "") {
            surname.classList.add("is-invalid");
        } else {
            surname.classList.remove("is-invalid");
        }
    })
})();

(function emailValidation() {
    const email = document.getElementById("email");
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    email.addEventListener("blur", () => {
        if (regex.test(email.value) === false) {
            email.classList.add("is-invalid");
        } else {
            email.classList.remove("is-invalid");
        }
    })
})();

(function passwordValidation() {
    const password = document.getElementById("password");
    password.addEventListener("input", () => {
        if (password.value.length < 8 || password.value.length > 25) {
            password.classList.add("is-invalid");
        } else {
            password.classList.remove("is-invalid");
        }
    })
})();

(function confirmPasswordValidiation() {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    confirmPassword.addEventListener("input", () => {
        if (password.value !== confirmPassword.value) {
            confirmPassword.classList.add("is-invalid");
        } else {
            confirmPassword.classList.remove("is-invalid");
        }
    })
})();

(function activeFields() {
    const name = document.getElementById("name");
    const surname = document.getElementById("surname");
    const email = document.getElementById("email");
    const companyName = document.getElementById("companyName");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const address = document.getElementById("address");
    const city = document.getElementById("city");
    const state = document.getElementById("state");
    const zip = document.getElementById("zip");
    surname.addEventListener("input", () => {
        if (name.value !== "" && surname.value !== "") {
            email.removeAttribute("disabled");
            companyName.removeAttribute("disabled");
        } else {
            email.setAttribute("disabled", "disabled");
            companyName.setAttribute("disabled", "disabled");
        }
    })
    companyName.addEventListener("input", () => {
        if (email.value !== "" && companyName.value !== "") {
            password.removeAttribute("disabled");
            confirmPassword.removeAttribute("disabled");
        } else {
            password.setAttribute("disabled", "disabled");
            confirmPassword.setAttribute("disabled", "disabled");
        }
    })
    confirmPassword.addEventListener("input", () => {
        if (password.value !== "" && confirmPassword.value !== "" && password.value === confirmPassword.value) {
            address.removeAttribute("disabled");
        } else {
            address.setAttribute("disabled", "disabled");
        }
    })
    address.addEventListener("input", () => {
        if (address !== "") {
            city.removeAttribute("disabled"); 
            state.removeAttribute("disabled"); 
            zip.removeAttribute("disabled"); 
        } else {
            city.setAttribute("disabled", "disabled");
            state.setAttribute("disabled", "disabled"); 
            zip.setAttribute("disabled", "disabled");
        }
    })
})();

(function preventDefault() {
    const form = document.getElementById("form");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    form.addEventListener("submit", (event) => {
        if (password.value !== confirmPassword.value) {
            event.preventDefault();
        }
    })
})();
