// Client-side validation using JavaScript
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    // Validate form fields
    var firstName = document.getElementById("user_name").value;
    if (firstName.trim() === "") {
        alert("Please enter your user name.");
        event.preventDefault();
        return;
    }

    var firstName = document.getElementById("first_name").value;
    if (firstName.trim() === "") {
        alert("Please enter your first name.");
        event.preventDefault();
        return;
    }

    var lastName = document.getElementById("last_name").value;
    if (lastName.trim() === "") {
        alert("Please enter your last name.");
        event.preventDefault();
        return;
    }

    var phoneNumber = document.getElementById("phone_number").value;
    if (phoneNumber.trim() === "") {
        alert("Please enter your phone number.");
        event.preventDefault();
        return;
    }

    var tin = document.getElementById("tin").value;
    if (tin.trim() === "" || tin.length !== 10) {
        alert("Please enter a valid Ethiopian TIN number with 10 characters.");
        event.preventDefault();
        return;
    }

    var sex = document.getElementById("sex").value;
    if (sex.trim() === "") {
        alert("Please select your sex.");
        event.preventDefault();
        return;
    }

    var incomeSource = document.getElementById("income_source").value;
    if (incomeSource.trim() === "") {
        alert("Please select your income source.");
        event.preventDefault();
        return;
    }

    var email = document.getElementById("email").value;
    if (email.trim() === "") {
        alert("Please enter your email.");
        event.preventDefault();
        return;
    }

    var placeOfWork = document.getElementById("place_of_work").value;
    if (placeOfWork.trim() === "") {
        alert("Please enter your place of work.");
        event.preventDefault();
        return;
    }

    var password = document.getElementById("password").value;
    if (password.trim() === "") {
        alert("Please enter your password.");
        event.preventDefault();
        return;
    }

    var confirmPassword = document.getElementById("confirm_password").value;
    if (confirmPassword.trim() === "") {
        alert("Please confirm your password.");
        event.preventDefault();
        return;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        event.preventDefault();
        return;
    }

    var photo = document.getElementById("photo").value;
    if (photo.trim() === "") {
        alert("Please upload your personal photo.");
        event.preventDefault();
        return;
    }

    // If all validations pass, the form will be submitted
});