// manage the toggling to open the settings when clicking on the user infos
// let usersettings = document.querySelector('header.dash-header .user-data .user-settings ');
// let userOpenSett = document.querySelectorAll('header.dash-header .user-info .user-name, header.dash-header .user-info .user-avatar');
// let arrowDownUser = document.querySelector('header.dash-header .user-info .user-name i')
let createPostBtn = document.querySelector('.create-post-cont .create-post');
// userOpenSett.forEach(ele=>{
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
// manage the file input action
let fileInput = document.querySelector('.post-images-adding #post-images-input');
if(fileInput){
    let fileInputDiv = document.querySelector('.add-post-form .post-images-adding .fa-images');
    let imagesPreview = document.querySelector('.images-preview');
    fileInputDiv.addEventListener('click',(e)=>{
        fileInput.click();
    })

    fileInput.onchange = ()=>{
        let images = [];
        let image = fileInput.files;
        for (let i = 0; i < image.length; i++) {
            images.push({
                'name':image[i].name,
                'url':URL.createObjectURL(image[i]),
                'file':image[i]
            })
        }
        images.forEach(img=>{
            let imgContainer = document.createElement('div')
            let pImg = document.createElement('img')
            pImg.src = img.url;
            imgContainer.appendChild(pImg)
            imagesPreview.appendChild(imgContainer)
        })
    }
}

// manage side bar openinng and closing
let arrowToggleSideBar = document.querySelector('div.toggle-aside i');
let sideBar = document.querySelector('aside.dash-aside');
let dashbaordLanding = document.querySelector('.dash-landing')
arrowToggleSideBar.addEventListener('click',()=>{
    dashbaordLanding.classList.toggle('inert')
    arrowToggleSideBar.classList.toggle('active');
    sideBar.classList.toggle('active');
})
document.addEventListener('click',(e)=>{
    if(e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")){
        dashbaordLanding.classList.toggle('inert');
        arrowToggleSideBar.classList.toggle('active');
        sideBar.classList.toggle('active');
    }
})
// manage search users
let searchIcon = document.querySelector('div.search-users i')
searchIcon.addEventListener('click',(e)=>{
    document.querySelector('div.search-users input').classList.toggle('active')
})
let searchInput =  document.querySelector('.search-users input');
searchInput.addEventListener('click',(e)=>{
    e.stopPropagation()
})
document.querySelectorAll('ul.search-results li').forEach(li=>{
    li.addEventListener('click',(e)=>{
        e.stopPropagation()
    })
})
let usersArr = []
searchInput.oninput = (e)=>{
    if(searchInput.value){
        document.querySelector('ul.search-results').style.display = 'block'
        let filtering = new RegExp(e.currentTarget.value, "i");
        document.querySelectorAll('ul.search-results li').forEach(li=>{
            usersArr.push(li)
        })
        document.querySelectorAll("ul.search-results li").forEach(el=>{
            el.remove()
        })
        let matchedUser = usersArr.filter(el=>{
            return el.textContent.match(filtering)
        })
        matchedUser.forEach(user=>{
            document.querySelector('ul.search-results').appendChild(user)
        })
    }else{
        document.querySelectorAll("ul.search-results li").forEach(el=>{
            el.remove()
        })
    }
}
document.addEventListener('click',(e)=>{
    if(e.currentTarget != searchInput){
        document.querySelectorAll("ul.search-results li").forEach(el=>{
            if(e.currentTarget != el){
                document.querySelectorAll("ul.search-results li").forEach(el=>{
                    document.querySelector('ul.search-results').style.display = 'none'
                })
            }
        })
    }
})

// handle adding post
let formPopUp = document.querySelector('.adding-post-form')
let mainLandingdashboard = document.querySelector('.ov-h')
if(createPostBtn){
    createPostBtn.addEventListener('click',()=>{
        if(formPopUp.classList.contains("active")){
            formPopUp.classList.toggle("active");
            formPopUp.classList.toggle("inert");
            mainLandingdashboard.classList.toggle('inert')
        }else if(formPopUp.classList.contains("inert")){
            formPopUp.classList.toggle("inert");
            formPopUp.classList.toggle("active");
            mainLandingdashboard.classList.toggle('inert')
        }else{
            formPopUp.classList.toggle("active");
            mainLandingdashboard.classList.toggle('inert')
        }
    })
}
document.addEventListener('click',(e)=>{
    if(e.target !== formPopUp && e.target !== createPostBtn && formPopUp.classList.contains("active") && e.target !== document.querySelector('.adding-post-form form')){
        formPopUp.classList.toggle("active");
        formPopUp.classList.toggle("inert");
        mainLandingdashboard.classList.toggle('inert')
    }
})
// manage popup clicking items problem
let popupPostItems = document.querySelector('.adding-post-form form').children;
for (let i = 0; i < popupPostItems.length; i++){
    popupPostItems[i].addEventListener('click',(e)=>{
        e.stopPropagation();
    })
}
// validation of adding a post
let addingPostsFields = [];
addingPostsFields.push(
    popupPostItems[3],
    popupPostItems[4]
)
document.querySelector('.adding-post-form form').onsubmit = (e)=>{
    if(!addingPostsFields[0].value || !addingPostsFields[1].value){
        e.preventDefault()
        document.querySelector('.adding-post-form form .adding-post-err').style.display = 'block'
    }else{
        document.querySelector('.adding-post-form form .adding-post-err').style.display = 'none'
    }
}
addingPostsFields.forEach(field=>{
    field.oninput = ()=>{
        document.querySelector('.adding-post-form form .adding-post-err').style.display = 'none'
    }
})

