// manage the toggling to open the settings when clicking on the user infos
// let usersettings = document.querySelector('header.dash-header .user-data .user-settings ');
// let userOpenSett = document.querySelectorAll('header.dash-header .user-info .user-name, header.dash-header .user-info .user-avatar');
// let arrowDownUser = document.querySelector('header.dash-header .user-info .user-name i')
var createPostBtn = document.querySelector('.create-post-cont .create-post'); // userOpenSett.forEach(ele=>{
//     ele.addEventListener('click',()=>{
//         usersettings.classList.toggle('active');
//         arrowDownUser.classList.toggle('active');
//         createPostBtn.classList.toggle('mb')
//     })
// })
// // manage the logout of each user
// let logoutManage = document.querySelector('.logout-manage a');
// logoutManage.addEventListener('click',(e)=>{
//     e.preventDefault();
//     document.querySelector('.user-settings .logout-manage #logout-form').submit();
// })
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
} // manage the file input action


var fileInput = document.querySelector('.post-images-adding #post-images-input');

if (fileInput) {
  var fileInputDiv = document.querySelector('.add-post-form .post-images-adding .fa-images');
  var imagesPreview = document.querySelector('.images-preview');
  fileInputDiv.addEventListener('click', function (e) {
    fileInput.click();
  });

  fileInput.onchange = function () {
    var images = [];
    var image = fileInput.files;

    for (var i = 0; i < image.length; i++) {
      images.push({
        'name': image[i].name,
        'url': URL.createObjectURL(image[i]),
        'file': image[i]
      });
    }

    images.forEach(function (img) {
      var imgContainer = document.createElement('div');
      var pImg = document.createElement('img');
      pImg.src = img.url;
      imgContainer.appendChild(pImg);
      imagesPreview.appendChild(imgContainer);
    });
  };
} // manage side bar openinng and closing


var arrowToggleSideBar = document.querySelector('div.toggle-aside i');
var sideBar = document.querySelector('aside.dash-aside');
var dashbaordLanding = document.querySelector('.dash-landing');
arrowToggleSideBar.addEventListener('click', function () {
  dashbaordLanding.classList.toggle('inert');
  arrowToggleSideBar.classList.toggle('active');
  sideBar.classList.toggle('active');
});
document.addEventListener('click', function (e) {
  if (e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")) {
    dashbaordLanding.classList.toggle('inert');
    arrowToggleSideBar.classList.toggle('active');
    sideBar.classList.toggle('active');
  }
}); // manage search users

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
}); // handle adding post

var formPopUp = document.querySelector('.adding-post-form');
var mainLandingdashboard = document.querySelector('.ov-h');

if (createPostBtn) {
  createPostBtn.addEventListener('click', function () {
    if (formPopUp.classList.contains("active")) {
      formPopUp.classList.toggle("active");
      formPopUp.classList.toggle("inert");
      mainLandingdashboard.classList.toggle('inert');
    } else if (formPopUp.classList.contains("inert")) {
      formPopUp.classList.toggle("inert");
      formPopUp.classList.toggle("active");
      mainLandingdashboard.classList.toggle('inert');
    } else {
      formPopUp.classList.toggle("active");
      mainLandingdashboard.classList.toggle('inert');
    }
  });
}

document.addEventListener('click', function (e) {
  if (e.target !== formPopUp && e.target !== createPostBtn && formPopUp.classList.contains("active") && e.target !== document.querySelector('.adding-post-form form')) {
    formPopUp.classList.toggle("active");
    formPopUp.classList.toggle("inert");
    mainLandingdashboard.classList.toggle('inert');
  }
}); // manage popup clicking items problem

var popupPostItems = document.querySelector('.adding-post-form form').children;

for (var i = 0; i < popupPostItems.length; i++) {
  popupPostItems[i].addEventListener('click', function (e) {
    e.stopPropagation();
  });
} // validation of adding a post


var addingPostsFields = [];
addingPostsFields.push(popupPostItems[3], popupPostItems[4]);

document.querySelector('.adding-post-form form').onsubmit = function (e) {
  if (!addingPostsFields[0].value || !addingPostsFields[1].value) {
    e.preventDefault();
    document.querySelector('.adding-post-form form .adding-post-err').style.display = 'block';
  } else {
    document.querySelector('.adding-post-form form .adding-post-err').style.display = 'none';
  }
};

addingPostsFields.forEach(function (field) {
  field.oninput = function () {
    document.querySelector('.adding-post-form form .adding-post-err').style.display = 'none';
  };
});
