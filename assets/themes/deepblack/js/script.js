// pre loader
const preloader = document.getElementById("preloader");
window.addEventListener("load", () => {
   setTimeout(() => {
      preloader.style.cssText = `opacity: 0; visibility: hidden;`;
   }, 1000);
});

// add bg to nav
window.addEventListener("scroll", function () {
   let scrollpos = window.scrollY;
   const header = document.querySelector("nav");
   const headerHeight = header.offsetHeight;

   if (scrollpos >= headerHeight) {
      header.classList.add("active");
   } else {
      header.classList.remove("active");
   }
});

// active nav item
const navItem = document.getElementsByClassName("nav-link");
for (const element of navItem) {
   element.addEventListener("click", () => {
      for (const ele of navItem) {
         ele.classList.remove("active");
      }
      element.classList.add("active");
   });
}

// tab
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

// tab 2
const transactionTabs = document.getElementsByClassName("transaction-tab");
const transactionContents = document.getElementsByClassName(
   "transaction-content"
);
for (const element of transactionTabs) {
   const tabId = element.getAttribute("data-id");
   const content = document.getElementById(tabId);
   element.addEventListener("click", () => {
      for (const t of transactionTabs) {
         t.classList.remove("active");
      }
      for (const c of transactionContents) {
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
   $(".investors").owlCarousel({
      loop: true,
      margin: 25,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
         0: {
            items: 1,
         },
         768: {
            items: 2,
         },
         992: {
            items: 3,
         },
      },
   });
   $(".investors-rtl").owlCarousel({
        rtl: true,
      loop: true,
      margin: 25,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
         0: {
            items: 1,
         },
         768: {
            items: 2,
         },
         992: {
            items: 3,
         },
      },
   });
   $(".client-testimonials").owlCarousel({
      loop: true,
      margin: 25,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
         0: {
            items: 1,
         },
         992: {
            items: 2,
         },
      },
   });
   $(".client-testimonials-rtl").owlCarousel({
        rtl: true,
      loop: true,
      margin: 25,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
         0: {
            items: 1,
         },
         992: {
            items: 2,
         },
      },
   });
   // OWL CAROUSEL
   $(".partners").owlCarousel({
      loop: true,
      margin: 50,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
         0: {
            items: 3,
         },
         576: {
            items: 5,
         },
         768: {
            items: 8,
         },
      },
   });
   $(".partners-rtl").owlCarousel({
        rtl: true,
      loop: true,
      margin: 50,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
         0: {
            items: 3,
         },
         576: {
            items: 5,
         },
         768: {
            items: 8,
         },
      },
   });

   // AOS ANIMATION
   AOS.init();

   // COUNTER UP
   $(".counter").counterUp({
      delay: 10,
      time: 3000,
   });

   // SCROLL TOP
   $(".scroll-top").fadeOut();
   $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
         $(".scroll-top").fadeIn();
      } else {
         $(".scroll-top").fadeOut();
      }
   });
});



