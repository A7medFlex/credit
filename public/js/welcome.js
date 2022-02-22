// manage local storage
if (localStorage.getItem('darkLight')) {
  if (localStorage.getItem('darkLight') == "light") {
    document.documentElement.style.setProperty("--dominant-wmode-color", '#FFFFFF');
    document.documentElement.style.setProperty("--dominant-bmode-color", '#000000');
  } else {
    document.documentElement.style.setProperty("--dominant-bmode-color", '#FFFFFF');
    document.documentElement.style.setProperty("--dominant-wmode-color", '#000000');
  }
}

if (localStorage.getItem('dominantColor')) {
  document.documentElement.style.setProperty("--compl-2", localStorage.getItem('dominantColor'));
}

var hamburger = document.querySelector("section.landing header #nav-icon1");
var mainWelcome = document.querySelector("section.landing main");
var shadows = document.querySelectorAll("section.landing main .shadow");
var loginNav = document.querySelector("section.landing nav");

hamburger.onclick = function (e) {
  e.currentTarget.classList.toggle("open");
  mainWelcome.classList.toggle("active");
  shadows.forEach(function (sh) {
    sh.classList.toggle("active");
  });
  loginNav.classList.toggle("active");
};
