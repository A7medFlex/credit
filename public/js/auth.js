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

var errorsCont = document.querySelector("section.auth form .errors"); // manage user profile image adding

var profileIcon = document.querySelector('.field.user-image-filed i');
var profileImageInput = document.querySelector('.field.user-image-filed input');
var profileImageInputCont = document.querySelector('.field.user-image-filed');

if (!profileImageInput) {} else {
  profileImageInput.onchange = function () {
    var image = profileImageInput.files[0];
    profileIcon.style.display = 'none';
    var imgContainer = document.createElement('div');
    imgContainer.classList.add('user-prof-image-preview');
    var pImg = document.createElement('img');
    pImg.src = URL.createObjectURL(image);
    imgContainer.appendChild(pImg);
    profileImageInputCont.prepend(imgContainer);
  };
} //////////
/////////


if (!profileIcon) {} else {
  profileIcon.addEventListener('click', function () {
    profileImageInput.click();
  });
}

function animateForm() {
  var arrows = document.querySelectorAll('.fa-arrow-down');
  var backArrow = document.querySelector('form .back');
  var firstInput = document.querySelector('form .auth_form').firstElementChild; // const firstInput = document.querySelector('form .auth_form').firstElementChild

  setInterval(function () {
    if (firstInput.classList.contains('active')) {
      backArrow.style.display = 'none';
    } else {
      backArrow.style.display = 'block';
    }
  }, 100);
  arrows.forEach(function (arr) {
    var currentInput = arr.previousElementSibling;
    var currentParent = arr.parentElement;
    var nextParent = currentParent.nextElementSibling;
    var prevParent = currentParent.previousElementSibling;
    arr.addEventListener('click', function (e) {
      if (e.currentTarget == arrows[arrows.length - 1]) {
        var submitbtn = document.querySelector('.auth_form .field button');
        submitbtn.removeAttribute('disabled');
      }

      if (currentInput.type == 'text' && validateUser(currentInput)) {
        nextField(currentParent, nextParent);
      } else if (currentInput.type == 'email' && validateEmail(currentInput)) {
        nextField(currentParent, nextParent);
      } else if (currentInput.type == 'password' && currentInput.name == 'password' && validatePassword(currentInput)) {
        nextField(currentParent, nextParent);
      } else if (currentInput.name == 'password_confirmation' && confirmPass(currentInput, prevParent)) {
        nextField(currentParent, nextParent);
      } else if (currentInput.name == 'user_profile_image' && checkProfImg(currentInput, currentParent)) {
        nextField(currentParent, nextParent);
      } else if (currentInput.name == 'description' && checkNabza(currentInput, currentParent)) {
        nextField(currentParent, nextParent);
      } else if (currentInput.tagName == 'SELECT' && validateSelect(currentInput)) {
        nextField(currentParent, nextParent);
      } else {
        currentParent.style.animation = 'shake .5s ease';
      }

      currentParent.addEventListener('animationend', function () {
        currentParent.style.animation = '';
      });
    });

    currentInput.oninput = function (e) {
      error(getComputedStyle(document.documentElement).getPropertyValue('--dominant-wmode-color'));
      errorsCont.innerHTML = '';
      document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--compl-2');
      return true;
    };

    if (document.querySelector('html').lang == 'ar') {
      currentInput.dir = "rtl";
    }

    currentInput.addEventListener('keyup', function (e) {
      if (e.keyCode === 13) {
        if (arr == arrows[arrows.length - 1]) {
          var submitbtn = document.querySelector('.auth_form .field button');
          submitbtn.removeAttribute('disabled');
        }

        if (currentInput.type == 'text' && validateUser(currentInput)) {
          nextField(currentParent, nextParent);
        } else if (currentInput.type == 'email' && validateEmail(currentInput)) {
          nextField(currentParent, nextParent);
        } else if (currentInput.type == 'password' && currentInput.name == 'password' && validatePassword(currentInput)) {
          nextField(currentParent, nextParent);
        } else if (currentInput.name == 'password_confirmation' && confirmPass(currentInput, prevParent)) {
          nextField(currentParent, nextParent);
        } else if (currentInput.name == 'user_profile_image' && checkProfImg(currentInput, currentParent)) {
          nextField(currentParent, nextParent);
        } else if (currentInput.name == 'nabza' && checkNabza(currentInput, currentParent)) {
          nextField(currentParent, nextParent);
        } else if (currentInput.tagName == 'SELECT' && validateSelect(currentInput)) {
          nextField(currentParent, nextParent);
        } else {
          currentParent.style.animation = 'shake .5s ease';
        }

        currentParent.addEventListener('animationend', function () {
          currentParent.style.animation = '';
        });
      }
    });
  });
  backArrow.addEventListener('click', function () {
    var currfiled = document.querySelector('form .auth_form .field.active');
    var prev = document.querySelector('form .auth_form .field.active').previousElementSibling;
    console.log(document.querySelector('form .auth_form .field.active').previousElementSibling);
    currfiled.classList.remove('active');
    currfiled.classList.add('inactive');
    prev.classList.remove('inactive');
    prev.classList.add('active');
  });
}

function validateUser(name) {
  if (!name.value) {
    errorsCont.innerHTML = '';
    error('#b13a3a');
    var msg = document.createElement('div');
    var msgText = document.createTextNode('Please complete the field.');

    if (document.querySelector('html').lang == 'ar') {
      msgText = document.createTextNode('برجاء إكمال الحقل.');
    } else if (document.querySelector('html').lang == 'gr') {
      msgText = document.createTextNode('Bitte füllen Sie das Feld aus.');
    }

    msg.appendChild(msgText);
    errorsCont.appendChild(msg);
  } else {
    error(getComputedStyle(document.documentElement).getPropertyValue('--dominant-wmode-color'));
    errorsCont.innerHTML = '';
    document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--compl-2');
    return true;
  }
}

function validateEmail(email) {
  validation = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

  if (validation.test(email.value)) {
    error(getComputedStyle(document.documentElement).getPropertyValue('--dominant-wmode-color'));
    errorsCont.innerHTML = '';
    document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--compl-2');
    return true;
  } else {
    errorsCont.innerHTML = '';
    error('#b13a3a');
    var msg = document.createElement('div');
    var msgText = document.createTextNode('Please add a vaild email.');

    if (document.querySelector('html').lang == 'ar') {
      msgText = document.createTextNode('برجاء إضافة بريد إلكتروني صحيح.');
    } else if (document.querySelector('html').lang == 'gr') {
      msgText = document.createTextNode('Bitte fügen Sie eine gültige E-Mail hinzu.');
    }

    msg.appendChild(msgText);
    errorsCont.appendChild(msg);
  }
}

function validatePassword(password) {
  if (!password.value) {
    errorsCont.innerHTML = '';
    error('#b13a3a');
    var msg = document.createElement('div');
    var msgText = document.createTextNode('Please complete the field');

    if (document.querySelector('html').lang == 'ar') {
      msgText = document.createTextNode('برجاء إكمال الحقل.');
    } else if (document.querySelector('html').lang == 'gr') {
      msgText = document.createTextNode('Bitte füllen Sie das Feld aus.');
    }

    msg.appendChild(msgText);
    errorsCont.appendChild(msg);
  } else {
    error(getComputedStyle(document.documentElement).getPropertyValue('--dominant-wmode-color'));
    errorsCont.innerHTML = '';
    document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--compl-2');
    return true;
  }
}

function confirmPass(pass, prevparent) {
  var i = prevparent.firstElementChild;
  var firstPass = i.nextElementSibling;

  if (pass.value === firstPass.value) {
    error(getComputedStyle(document.documentElement).getPropertyValue('--dominant-wmode-color'));
    errorsCont.innerHTML = '';
    document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--compl-2');
    return true;
  } else if (!pass.value) {
    errorsCont.innerHTML = '';
    error('#b13a3a');
    var msg = document.createElement('div');
    var msgText = document.createTextNode('Please complete the field');

    if (document.querySelector('html').lang == 'ar') {
      msgText = document.createTextNode('برجاء إكمال الحقل.');
    } else if (document.querySelector('html').lang == 'gr') {
      msgText = document.createTextNode('Bitte füllen Sie das Feld aus.');
    }

    msg.appendChild(msgText);
    errorsCont.appendChild(msg);
  } else {
    errorsCont.innerHTML = '';
    error('#b13a3a');

    var _msg = document.createElement('div');

    var _msgText = document.createTextNode('Password doesn\'t match');

    if (document.querySelector('html').lang == 'ar') {
      _msgText = document.createTextNode('كلمة المرور غير متطابقة.');
    } else if (document.querySelector('html').lang == 'gr') {
      _msgText = document.createTextNode('Passwort stimmt nicht überein.');
    }

    _msg.appendChild(_msgText);

    errorsCont.appendChild(_msg);
  }
}

function validateSelect(select) {
  if (!select.value) {
    errorsCont.innerHTML = '';
    error('#b13a3a');
    var msg = document.createElement('div');
    var msgText = document.createTextNode('Please choose you country.');

    if (document.querySelector('html').lang == 'ar') {
      msgText = document.createTextNode('برجاء اختيار بلدك.');
    } else if (document.querySelector('html').lang == 'gr') {
      msgText = document.createTextNode('Bitte wählen Sie Ihr Land aus.');
    }

    msg.appendChild(msgText);
    errorsCont.appendChild(msg);
  } else {
    error(getComputedStyle(document.documentElement).getPropertyValue('--dominant-wmode-color'));
    errorsCont.innerHTML = '';
    document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--compl-2');
    return true;
  }
}

function checkNabza(nabza, parent) {
  if (!nabza.value) {
    errorsCont.innerHTML = '';
    error('#b13a3a');
    var msg = document.createElement('div');
    var msgText = document.createTextNode('Please add your description.');

    if (document.querySelector('html').lang == 'ar') {
      msgText = document.createTextNode('برجاء إضافة الوصف الخاص بك.');
    } else if (document.querySelector('html').lang == 'gr') {
      msgText = document.createTextNode('Bitte fügen Sie Ihre Beschreibung hinzu.');
    }

    msg.appendChild(msgText);
    errorsCont.appendChild(msg);
  } else {
    error(getComputedStyle(document.documentElement).getPropertyValue('--dominant-wmode-color'));
    errorsCont.innerHTML = '';
    document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--compl-2');
    return true;
  }
}

function checkProfImg(profImg, currentParent) {
  if (!profImg.value) {
    errorsCont.innerHTML = '';
    error('#b13a3a');
    var msg = document.createElement('div');
    var msgText = document.createTextNode('Please choose your profile image.');

    if (document.querySelector('html').lang == 'ar') {
      msgText = document.createTextNode('برجاء اختيار صورتك الشخصية.');
    } else if (document.querySelector('html').lang == 'gr') {
      msgText = document.createTextNode('Bitte wählen Sie Ihr Bild aus.');
    }

    msg.appendChild(msgText);
    errorsCont.appendChild(msg);
  } else {
    errorsCont.innerHTML = '';
    document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--compl-2');
    return true;
  }
}

function nextField(currentParent, nextParent) {
  currentParent.classList.remove('active');
  currentParent.classList.add('inactive');
  nextParent.classList.add('active');
  nextParent.classList.remove('inactive');
}

function error(color) {
  document.querySelector('section.auth').style.backgroundColor = color;
  document.querySelector('section.auth h3').style.color = getComputedStyle(document.documentElement).getPropertyValue('--dominant-wmode-color');
}

animateForm();
var countrySelect = document.querySelector('select[name="country"]');
var countryCodeSelected = document.querySelectorAll('select[name="country_code"] option');

countrySelect.onchange = function (e) {
  countryCodeSelected.forEach(function (ele) {
    if (e.currentTarget.value == ele.textContent) {
      ele.selected = 'selected';
      document.querySelector('#country_code').textContent = '';
      document.querySelector('#country_code').appendChild(document.createTextNode(ele.value));
    }
  });
};
