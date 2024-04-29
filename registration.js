function validForm() {
    const a = document.getElementById('firstName').value.trim();
    const b = document.getElementById('lastName').value.trim();
    const c = document.getElementById('email').value.trim();
    const d = document.getElementById('phoneNumber').value.trim();
    const e = document.getElementById('userName').value.trim();
    const f = document.getElementById('password').value.trim();

    // Error message elements
    const fname_error = document.getElementById('fname_error');
    const lname_error = document.getElementById('lname_error');
    const email_error = document.getElementById('email_error');
    const phone_error = document.getElementById('phone_error');
    const user_error = document.getElementById('user_error');
    const pass_error = document.getElementById('pass_error');

    // Regular expressions for validation
    const emailPattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    ;
    const phonePattern = /^\d{10}$/;
    const passPattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;

    // Reset error messages
    fname_error.innerText = "";
    lname_error.innerText = "";
    email_error.innerText = "";
    phone_error.innerText = "";
    user_error.innerText = "";
    pass_error.innerText = "";

    // Validate first name
    if (a === "" || b === "" || c === "" || d === "" || e === "" || f === "") {
        alert("You must complete the fields");
        return false;
    }
    if (a === "" ) {
        fname_error.innerText = "Please Enter your first name.";
        return false;
    }

    // Validate last name
    if (b === "") {
        lname_error.innerText = "Please enter your last name.";
        return false;
    }

    // Validate email
    if (c === "") {
        email_error.innerText = "Please Enter an email address.";
        return false;
    } else if (!emailPattern.test(c)) {
        email_error.innerText = "Invalid email.";
        return false;
    }

    // Validate phone number
    if (d === "") {
        phone_error.innerText = "Please enter a phone number.";
        return false;
    } else if (!phonePattern.test(d)) {
        phone_error.innerText = "Invalid phone number";
        return false;
    }

    // Validate username
    if (e === "") {
        user_error.innerText = "Please enter a username.";
        return false;
    }

    // Validate password
    if (f === "") {
        pass_error.innerText = "Please enter a password.";
        return false;
    }
    else if (!passPattern.test(f)){
        pass_error.innerText = "Invalid password. Password must at least one capital letter, one lowercase letter and 8 or more characters"
    }

    // If all validations pass, return true to submit the form
    return true;

}
