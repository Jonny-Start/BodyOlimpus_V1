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
    } else if (bo_body == 'bo_notifications') {
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
    const opacityNotification = document.getElementById('opacityNotification');
    if (messagehelp) {
        if (messagehelp.className.match(/(?:^|\s)hide(?!\S)/)) {
            messagehelp.classList.remove('hide');
            opacityNotification.classList.remove('hide');
            footerActive();
            btnHelp.classList.add('active');
        } else {
            messagehelp.classList.add('hide');
            btnHelp.classList.remove('active');
            opacityNotification.classList.add('hide');
            bodyActive();
        }
    }
}

function toggleMenu() {
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigationAdmin');
    let main = document.querySelector('.main');

    toggle.classList.toggle('active');
    navigation.classList.toggle('active');
    main.classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", () => {
    bodyActive();

    // Theme color
    function changeThemeColor(colorTheme) {
        var bo_body = document.body;
        console.log(bo_body);
        if (colorTheme == 1) {
            bo_body.classList.add('dark');
        } else {
            bo_body.classList.add('light');
        }
    }

    var colorTheme = localStorage.getItem('colorTheme');
    if (colorTheme) {
        changeThemeColor(colorTheme);
    } else {
        var bo_body = document.body;
        bo_body.classList.add('light');
    }

    var checkTheme = document.getElementById('switchColorInput');
    if (checkTheme) {
        var colorTheme = localStorage.getItem('colorTheme');
        if (colorTheme == 1) {
            checkTheme.checked = true;
        } else {
            checkTheme.checked = false;
        }
        checkTheme.addEventListener('click', () => {
            let light = 0;
            let dark = 1;
            if (colorTheme == light) {
                localStorage.setItem('colorTheme', dark);
                location.reload();
            } else {
                localStorage.setItem('colorTheme', light);
                location.reload();
            }
        });
    }
});

//Display subTitles navBar Admin 
function displaySubtitles(className) {
    var elements = document.querySelectorAll('.' + className);
    var elementParen = document.querySelector('.' + className + "Parent");
    elementParen.classList.toggle('active');
    elements.forEach(elementUn => {
        elementUn.classList.toggle('active');
    });
}