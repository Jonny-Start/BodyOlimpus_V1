if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("sw.js").then(registration => {
        console.log("Registered!");
        console.log(registration);
    }).catch(error => {
        console.log("Registrations Failed!");
        console.log(error);
    });
} else {
    console.log("PWA Failed!");
}

function bodyActive() {
    const bo_body = document.body.id;
    if (bo_body == 'bo_myaccount') {
        const elementFooter = document.getElementById('footerHome');
        elementFooter.classList.add('active');
    } else if (bo_body == 'bo_profile') {
        const elementFooter = document.getElementById('footerProfile');
        elementFooter.classList.add('active');
    } else if (bo_body == 'bo_settings') {
        const elementFooter = document.getElementById('footerSettings');
        elementFooter.classList.add('active');
    }
}

function footerActive() {
    const list = document.querySelectorAll('.list');
    if (list) {
        // function activeLink() {
        list.forEach((item) =>
            item.classList.remove('active'));
        // this.classList.add('active');
        // }
        // list.forEach((item) =>
        //     item.addEventListener('click', activeLink));
    }
}

function goBack() {
    footerActive();
    const footerBack = document.getElementById('footerBack');
    footerBack.classList.add('active');
    setInterval(() => window.history.back(), 200);

}

function helpMessage() {
    const messagehelp = document.querySelector('#messagehelp');
    const btnHelp = document.getElementById('footerHelp');
    if (messagehelp) {
        if (messagehelp.className.match(/(?:^|\s)hide(?!\S)/)) {
            messagehelp.className = "";
            footerActive();
            btnHelp.classList.add('active');
        } else {
            messagehelp.className = messagehelp.className += "hide";
            btnHelp.classList.remove('active');
            bodyActive();
        }
    }
}


document.addEventListener("DOMContentLoaded", () => {
    bodyActive();
});