localStorage.getItem("darkLight")&&("light"==localStorage.getItem("darkLight")?(document.documentElement.style.setProperty("--dominant-wmode-color","#FFFFFF"),document.documentElement.style.setProperty("--dominant-bmode-color","#000000")):(document.documentElement.style.setProperty("--dominant-bmode-color","#FFFFFF"),document.documentElement.style.setProperty("--dominant-wmode-color","#000000"))),localStorage.getItem("dominantColor")&&document.documentElement.style.setProperty("--compl-2",localStorage.getItem("dominantColor"));var searchIcon=document.querySelector("div.search-users i");searchIcon.addEventListener("click",(function(e){document.querySelector("div.search-users input").classList.toggle("active")}));var searchInput=document.querySelector(".search-users input");searchInput.addEventListener("click",(function(e){e.stopPropagation()})),document.querySelectorAll("ul.search-results li").forEach((function(e){e.addEventListener("click",(function(e){e.stopPropagation()}))}));var usersArr=[];searchInput.oninput=function(e){if(searchInput.value){document.querySelector("ul.search-results").style.display="block";var t=new RegExp(e.currentTarget.value,"i");document.querySelectorAll("ul.search-results li").forEach((function(e){usersArr.push(e)})),document.querySelectorAll("ul.search-results li").forEach((function(e){e.remove()})),usersArr.filter((function(e){return e.textContent.match(t)})).forEach((function(e){document.querySelector("ul.search-results").appendChild(e)}))}else document.querySelectorAll("ul.search-results li").forEach((function(e){e.remove()}))},document.addEventListener("click",(function(e){e.currentTarget!=searchInput&&document.querySelectorAll("ul.search-results li").forEach((function(t){e.currentTarget!=t&&document.querySelectorAll("ul.search-results li").forEach((function(e){document.querySelector("ul.search-results").style.display="none"}))}))}));var arrowToggleSideBar=document.querySelector("div.toggle-aside i"),sideBar=document.querySelector("aside.dash-aside"),postPage=document.querySelector(".single-post-layout");arrowToggleSideBar.addEventListener("click",(function(){postPage.classList.toggle("inert"),document.querySelector("header.dash-header").classList.toggle("inert"),arrowToggleSideBar.classList.toggle("active"),sideBar.classList.toggle("active")})),document.addEventListener("click",(function(e){e.target!==sideBar&&e.target!==arrowToggleSideBar&&sideBar.classList.contains("active")&&(postPage.classList.toggle("inert"),document.querySelector("header.dash-header").classList.toggle("inert"),arrowToggleSideBar.classList.toggle("active"),sideBar.classList.toggle("active"))}));var carsoulImages=document.querySelectorAll(".images-slider img"),mainCarsoul=document.querySelector(".post-images-carsoul"),carsoulSlider=document.querySelector(".images-slider"),nextBtn=document.querySelector("#nextBtn"),prevBtn=document.querySelector("#prevBtn");carsoulSlider.style.width="".concat(100*carsoulImages.length,"%"),carsoulImages.forEach((function(e){e.style.width="".concat(mainCarsoul.clientWidth,"px")}));var counter=1;carsoulSlider.style.transform="translateX(-".concat(mainCarsoul.clientWidth*counter,"px)"),nextBtn.addEventListener("click",(function(){if(counter>=carsoulImages.length-1)return!1;carsoulSlider.style.transition="transform 0.6s ease-in-out",counter++,carsoulSlider.style.transform="translateX(-".concat(mainCarsoul.clientWidth*counter,"px)")})),prevBtn.addEventListener("click",(function(){if(counter<=0)return!1;carsoulSlider.style.transition="transform 0.6s ease-in-out",counter--,carsoulSlider.style.transform="translateX(-".concat(mainCarsoul.clientWidth*counter,"px)")})),carsoulSlider.addEventListener("transitionend",(function(){"last-clone"===carsoulImages[counter].id&&(carsoulSlider.style.transition="none",counter=carsoulImages.length-2,carsoulSlider.style.transform="translateX(".concat(-mainCarsoul.clientWidth*counter,"px)")),"first-clone"===carsoulImages[counter].id&&(carsoulSlider.style.transition="none",counter=carsoulImages.length-counter,carsoulSlider.style.transform="translateX(".concat(-mainCarsoul.clientWidth*counter,"px)"))}));var prevX=-1;carsoulSlider.addEventListener("dragstart",(function(e){if(-1==prevX)return prevX=e.pageX,!1;if(prevX>e.pageX){if(counter<=0)return!1;carsoulSlider.style.transition="transform 0.6s ease-in-out",counter--,carsoulSlider.style.transform="translateX(-".concat(mainCarsoul.clientWidth*counter,"px)")}else if(prevX<e.pageX){if(counter>=carsoulImages.length-1)return!1;carsoulSlider.style.transition="transform 0.6s ease-in-out",counter++,carsoulSlider.style.transform="translateX(-".concat(mainCarsoul.clientWidth*counter,"px)")}prevX=e.pageX}),!1);
