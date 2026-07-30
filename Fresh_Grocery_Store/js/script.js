function sendOTP() {
    let mobile = document.getElementById("mobile").value;

    if (mobile == "") {
        alert("Please enter mobile number");
        return;
    }

    if (mobile.length != 10) {
        alert("Enter valid 10 digit number");
        return;
    }

    document.getElementById("otpBox").style.display = "block";
    alert("OTP Box Opened 👍");
}

function verifyOTP() {
    let otp = document.getElementById("otp").value;

    if (otp == "") {
        alert("Please enter OTP");
        return;
    }

    if (otp == "1234") {
        alert("Login Successful 🚀");
        window.location.href = "home.html";
    } else {
        alert("Wrong OTP ❌");
    }
}