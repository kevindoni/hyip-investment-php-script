
// preloader_area
var preloader = document.getElementById("preloader");
function preloder_function(){
    preloader.style.display= "none";
}

const tabs = document.getElementsByClassName("tab");
const contents = document.getElementsByClassName("content");
for (const element of tabs) {
   const tabId = element.getAttribute("tab-id");
   const content = document.getElementById(tabId);
   element.addEventListener("click", () => {
      for (const t of tabs) {
         t.classList.remove("active");
      }
      for (const c of contents) {
         c.classList.remove("active");
      }
      element.classList.add("active");
      content.classList.add("active");
   });
}

// image preview on input
const previewImage = () => {
    frame.src = URL.createObjectURL(event.target.files[0]);
};

$(document).ready(function () {
   $(".js-example-basic-single").select2({
       width : '100%',
   });

   // SCROLL TOP
   $(".scroll-up").fadeOut();
   $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
         $(".scroll-up").fadeIn();
      } else {
         $(".scroll-up").fadeOut();
      }
   });
});

const toggleSideMenu = () => {
   document.getElementById("sidebar").classList.toggle("active");
   document.getElementById("content").classList.toggle("active");
   // console.log("me");
};
const hideSidebar = () => {
   document.getElementById("formWrapper").classList.remove("active");
   document.getElementById("formWrapper2").classList.remove("active");
};
const toggleClass = () => {
   document.getElementById("formWrapper").classList.add("active");
};
const callSignIn = () => {
   document.getElementById("formWrapper").classList.add("active");
   document.getElementById("formWrapper2").classList.remove("active");
};
const callSignUp = () => {
   document.getElementById("formWrapper").classList.remove("active");
   document.getElementById("formWrapper2").classList.add("active");
};

const toggleContactSidebar = () => {
   document.getElementById("addContactSidebar").classList.toggle("active");
};
