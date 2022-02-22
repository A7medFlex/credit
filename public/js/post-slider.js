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
} // manage search users


var searchIcon = document.querySelector('div.search-users i');
searchIcon.addEventListener('click', function (e) {
  document.querySelector('div.search-users input').classList.toggle('active');
});
var searchInput = document.querySelector('.search-users input');
searchInput.addEventListener('click', function (e) {
  e.stopPropagation();
});
document.querySelectorAll('ul.search-results li').forEach(function (li) {
  li.addEventListener('click', function (e) {
    e.stopPropagation();
  });
});
var usersArr = [];

searchInput.oninput = function (e) {
  if (searchInput.value) {
    document.querySelector('ul.search-results').style.display = 'block';
    var filtering = new RegExp(e.currentTarget.value, "i");
    document.querySelectorAll('ul.search-results li').forEach(function (li) {
      usersArr.push(li);
    });
    document.querySelectorAll("ul.search-results li").forEach(function (el) {
      el.remove();
    });
    var matchedUser = usersArr.filter(function (el) {
      return el.textContent.match(filtering);
    });
    matchedUser.forEach(function (user) {
      document.querySelector('ul.search-results').appendChild(user);
    });
  } else {
    document.querySelectorAll("ul.search-results li").forEach(function (el) {
      el.remove();
    });
  }
};

document.addEventListener('click', function (e) {
  if (e.currentTarget != searchInput) {
    document.querySelectorAll("ul.search-results li").forEach(function (el) {
      if (e.currentTarget != el) {
        document.querySelectorAll("ul.search-results li").forEach(function (el) {
          document.querySelector('ul.search-results').style.display = 'none';
        });
      }
    });
  }
}); // manage side bar toggling

var arrowToggleSideBar = document.querySelector('div.toggle-aside i');
var sideBar = document.querySelector('aside.dash-aside');
var postPage = document.querySelector('.single-post-layout');
arrowToggleSideBar.addEventListener('click', function () {
  postPage.classList.toggle('inert');
  document.querySelector('header.dash-header').classList.toggle('inert');
  arrowToggleSideBar.classList.toggle('active');
  sideBar.classList.toggle('active');
});
document.addEventListener('click', function (e) {
  if (e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")) {
    postPage.classList.toggle('inert');
    document.querySelector('header.dash-header').classList.toggle('inert');
    arrowToggleSideBar.classList.toggle('active');
    sideBar.classList.toggle('active');
  }
});
var carsoulImages = document.querySelectorAll('.images-slider img');
var mainCarsoul = document.querySelector('.post-images-carsoul');
var carsoulSlider = document.querySelector('.images-slider');
var nextBtn = document.querySelector('#nextBtn');
var prevBtn = document.querySelector('#prevBtn');
carsoulSlider.style.width = "".concat(carsoulImages.length * 100, "%");
carsoulImages.forEach(function (img) {
  img.style.width = "".concat(mainCarsoul.clientWidth, "px");
});
var counter = 1;
carsoulSlider.style.transform = "translateX(-".concat(mainCarsoul.clientWidth * counter, "px)");
nextBtn.addEventListener('click', function () {
  if (counter >= carsoulImages.length - 1) return false;
  carsoulSlider.style.transition = "transform 0.6s ease-in-out";
  counter++;
  carsoulSlider.style.transform = "translateX(-".concat(mainCarsoul.clientWidth * counter, "px)");
});
prevBtn.addEventListener('click', function () {
  if (counter <= 0) return false;
  carsoulSlider.style.transition = "transform 0.6s ease-in-out";
  counter--;
  carsoulSlider.style.transform = "translateX(-".concat(mainCarsoul.clientWidth * counter, "px)");
});
carsoulSlider.addEventListener('transitionend', function () {
  if (carsoulImages[counter].id === "last-clone") {
    carsoulSlider.style.transition = "none";
    counter = carsoulImages.length - 2; //

    carsoulSlider.style.transform = "translateX(".concat(-mainCarsoul.clientWidth * counter, "px)");
  }

  if (carsoulImages[counter].id === "first-clone") {
    carsoulSlider.style.transition = "none";
    counter = carsoulImages.length - counter;
    carsoulSlider.style.transform = "translateX(".concat(-mainCarsoul.clientWidth * counter, "px)");
  }
});
var prevX = -1;
carsoulSlider.addEventListener('dragstart', function (e) {
  if (prevX == -1) {
    prevX = e.pageX;
    return false;
  } // dragged left


  if (prevX > e.pageX) {
    if (counter <= 0) return false;
    carsoulSlider.style.transition = "transform 0.6s ease-in-out";
    counter--;
    carsoulSlider.style.transform = "translateX(-".concat(mainCarsoul.clientWidth * counter, "px)");
  } else if (prevX < e.pageX) {
    // dragged right
    if (counter >= carsoulImages.length - 1) return false;
    carsoulSlider.style.transition = "transform 0.6s ease-in-out";
    counter++;
    carsoulSlider.style.transform = "translateX(-".concat(mainCarsoul.clientWidth * counter, "px)");
  }

  prevX = e.pageX;
}, false);
