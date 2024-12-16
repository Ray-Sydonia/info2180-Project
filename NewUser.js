document.getElementById("addUserForm").onsubmit = function(event) {
    // Get form elements
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var role = document.getElementById("role").value;

    // Check for empty fields
    if (firstname === "" || lastname === "" || email === "" || password === "" || role === "") {
        alert("All fields are required.");
        event.preventDefault();  // Prevent form submission
        return false;
    }


    // Check if email is valid
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();  // Prevent form submission
        return false;
    }

    // Check password complexity
    var passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[A-Z]).{8,}$/;
    if (!passwordPattern.test(password)) {
        alert("Password must be at least 8 characters long and contain at least one letter, one number, and one uppercase letter.");
        event.preventDefault();  // Prevent form submission
        return false;
    }

    // If all validations pass, allow form submission
    return true;
};
