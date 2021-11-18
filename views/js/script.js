if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("sw.js").then(registration => {
        console.log("Registered!");
        console.log(registration);
    }).catch(error => {
        console.log("Registrations Failed!");
        console.log(error);
    });
}

function goBack() {
    window.history.back();
}

function helpMessage() {
    messagehelp = document.querySelector('#messagehelp');
    if (messagehelp) {
        if (messagehelp.className.match(/(?:^|\s)hide(?!\S)/)) {
            messagehelp.className = "";
        } else {
            messagehelp.className = messagehelp.className += "hide";
        }
    }
}
