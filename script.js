const form = document.querySelector("#form-msg"),
statusTxt = form.querySelector(".button-area span");

form.onsubmit = (e) => {
    e.preventDefault();
    statusTxt.style.color = "#0D6EFD";
    statusTxt.style.display = "block";
    statusTxt.textContent = "Sending your message...";

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "message.php", true);
    xhr.onload = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.response;
            if (
                response.indexOf("Email and message fields are required!") != -1 ||
                response.indexOf("Enter a valid email address!") != -1 ||
                response.indexOf("Sorry, failed to send your message!") != -1
            ) {
                statusTxt.style.color = "red";
            } else {
                form.reset();
                setTimeout(() => {
                    statusTxt.style.display = "none";
                }, 3000);
            }
            statusTxt.innerText = response;
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
};
