function studentMode() {
    // Change the hidden flag for the post request
    document.getElementById("mode").value = "student";
    // Swap the button color
    document.getElementById("studentLoginButton").style.backgroundColor = "#42A5F5";
    document.getElementById("staffLoginButton").style.backgroundColor = "#90CAF9";

    document.getElementById("loginTitle").innerText = "Student Enrollment Records Login";
    /*
    // Hide all extra fields used for signing up
    const elements = document.getElementsByClassName("signup");
    for (let index in elements) {
        if (elements.hasOwnProperty(index)) {
            elements[index].style.display = "none";
        }
    }
    */
}

function staffMode() {
    // Change the hidden flag for the post request
    document.getElementById("mode").value = "staff";
    // Swap the button color
    document.getElementById("studentLoginButton").style.backgroundColor = "#90CAF9";
    document.getElementById("staffLoginButton").style.backgroundColor = "#42A5F5";

    document.getElementById("loginTitle").innerText = "Staff Enrollment Records Login";
    /*
    // Show all extra fields used for signing up
    const elements = document.getElementsByClassName("signup");
    for (let index in elements) {
        if (elements.hasOwnProperty(index)) {
            elements[index].style.display = "block";
        }
    }
    */
}