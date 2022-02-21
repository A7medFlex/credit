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

// manage side bar toggling
let arrowToggleSideBar = document.querySelector('div.toggle-aside i');
let sideBar = document.querySelector('aside.dash-aside');
let postPage = document.querySelector('.single-post-layout')
arrowToggleSideBar.addEventListener('click',()=>{
    postPage.classList.toggle('inert')
    document.querySelector('header.dash-header').classList.toggle('inert')
    arrowToggleSideBar.classList.toggle('active');
    sideBar.classList.toggle('active');
})
document.addEventListener('click',(e)=>{
    if(e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")){
        postPage.classList.toggle('inert');
        document.querySelector('header.dash-header').classList.toggle('inert')
        arrowToggleSideBar.classList.toggle('active');
        sideBar.classList.toggle('active');
    }
})


let carsoulImages = document.querySelectorAll('.images-slider img')
let mainCarsoul = document.querySelector('.post-images-carsoul');
let carsoulSlider = document.querySelector('.images-slider')
const nextBtn = document.querySelector('#nextBtn')
const prevBtn = document.querySelector('#prevBtn')

carsoulSlider.style.width = `${carsoulImages.length * 100}%`
carsoulImages.forEach(img=>{
    img.style.width = `${mainCarsoul.clientWidth}px`
})

let counter = 1
carsoulSlider.style.transform = `translateX(-${mainCarsoul.clientWidth * counter}px)`;

nextBtn.addEventListener('click',()=>{
    if(counter >=carsoulImages.length -1)return false;
    carsoulSlider.style.transition = `transform 0.6s ease-in-out`;
    counter ++;
    carsoulSlider.style.transform = `translateX(-${mainCarsoul.clientWidth * counter}px)`;

})
prevBtn.addEventListener('click',()=>{
    if(counter <=0)return false;
    carsoulSlider.style.transition = `transform 0.6s ease-in-out`;
    counter--;
    carsoulSlider.style.transform = `translateX(-${mainCarsoul.clientWidth * counter}px)`;
})
carsoulSlider.addEventListener('transitionend',()=>{
    if(carsoulImages[counter].id==="last-clone"){
        carsoulSlider.style.transition ="none"
        counter = carsoulImages.length -2 //
        carsoulSlider.style.transform = `translateX(${-mainCarsoul.clientWidth * counter}px)`;
    }
    if(carsoulImages[counter].id==="first-clone"){
        carsoulSlider.style.transition ="none"
        counter = carsoulImages.length - counter
        carsoulSlider.style.transform = `translateX(${-mainCarsoul.clientWidth * counter}px)`;
    }
})
var prevX = -1
carsoulSlider.addEventListener('dragstart', function(e){

    if(prevX == -1) {
        prevX = e.pageX;
        return false;
    }
    // dragged left
    if(prevX > e.pageX) {
        if(counter <=0)return false;
        carsoulSlider.style.transition = `transform 0.6s ease-in-out`;
        counter--;
        carsoulSlider.style.transform = `translateX(-${mainCarsoul.clientWidth * counter}px)`;
    }
    else if(prevX < e.pageX) {
        // dragged right
        if(counter >=carsoulImages.length -1)return false;
        carsoulSlider.style.transition = `transform 0.6s ease-in-out`;
        counter ++;
        carsoulSlider.style.transform = `translateX(-${mainCarsoul.clientWidth * counter}px)`;
    }
    prevX = e.pageX;
},false);
