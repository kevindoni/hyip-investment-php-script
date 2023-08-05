
// preloader_area
var preloader = document.getElementById("preloader");
function preloder_function(){
    preloader.style.display= "none";
}

$(document).ready(function () {
    // faq_area_start
    $("button.accordion_title").click(function () {
        $(this).next().slideToggle();
        if (this.firstElementChild.classList.contains("fa-plus")) {
            this.firstElementChild.classList.replace("fa-plus", "fa-minus");
        } else {
            this.firstElementChild.classList.replace("fa-minus", "fa-plus");
        }
    });

    // testimonial_area
    $('.testimonial_carousel').owlCarousel({
        loop: true,
        autoplay: true,
        center: true,
        margin: 10,
        nav: false,
        dots: true,
        // rtl:true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // plan_area payment_slider
    $('.payment_slider').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 1000,
        margin: 30,
        nav: false,
        dots: false,
        // rtl:true,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 6
            },
            1000: {
                items: 10
            }
        }
    });

    // Feature_area
    $('.feature_counter').counterUp({
        delay: 10,
        time: 1000
    });

    // referrel_area
    $('.refarrel_counter').counterUp({
        delay: 10,
        time: 1000
    });

    // scroll_up
    $(".scroll_up").fadeOut();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $(".scroll_up").fadeIn();
        } else {
            $(".scroll_up").fadeOut();
        }
    });

});

// about_area_start magnific_video
$('.magnific_video').magnificPopup({
    type: 'iframe'
});

