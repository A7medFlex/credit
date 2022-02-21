// manage local storage
if (localStorage.getItem('darkLight')) {
    if(localStorage.getItem('darkLight') == "light"){
        document.documentElement.style.setProperty(
                "--dominant-wmode-color",
                '#FFFFFF'
        );
        document.documentElement.style.setProperty(
            "--dominant-bmode-color",
            '#000000'
        );
    }else{
        document.documentElement.style.setProperty(
                "--dominant-bmode-color",
                '#FFFFFF'
        );
        document.documentElement.style.setProperty(
            "--dominant-wmode-color",
            '#000000'
        );
    }

}
if(localStorage.getItem('dominantColor')){
    document.documentElement.style.setProperty(
        "--compl-2",
        localStorage.getItem('dominantColor')
    );
}

let hamburger = document.querySelector("section.landing header #nav-icon1");
let mainWelcome = document.querySelector("section.landing main");
let shadows = document.querySelectorAll("section.landing main .shadow");
let loginNav = document.querySelector("section.landing nav");
hamburger.onclick = (e)=>{
    e.currentTarget.classList.toggle("open");
    mainWelcome.classList.toggle("active");
    shadows.forEach(sh=>{
        sh.classList.toggle("active");
    });
    loginNav.classList.toggle("active");
}
