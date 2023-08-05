
// preloader_area
var preloader = document.getElementById("preloader");
function preloder_function(){
    preloader.style.display= "none";
}

$(document).ready(function () {

    // testimonial_area
    $('.testimonial_carousel').owlCarousel({
        loop: true,
        autoplay: false,
        margin: 30,
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
                items: 2
            }
        }
    });

    // plan_area payment_slider
    $('.payment_slider').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 1000,
        margin: 10,
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

    // Investor_area
    $('.investor_carousel').owlCarousel({
        loop: true,
        autoplay: false,
        margin: 5,
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

    // statistics_area
    $('.statistics_counter').counterUp({
        delay: 10,
        time: 1000
    });

    // statistics_area
    $('.affiliate_counter').counterUp({
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

