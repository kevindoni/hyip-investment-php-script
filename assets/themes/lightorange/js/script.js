(function ($) {
    "user strict";

    $(document).ready(function () {

        // preloader
        $("#preloader").delay(300).animate({
            "opacity": "0"
        }, 500, function () {
            $("#preloader").css("display", "none");
        });

    });

    // scrollTop
    var fixed_top = $("#header-section");
    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 50) {
            fixed_top.addClass("animated fadeInDown header-fixed");
        } else {
            fixed_top.removeClass("animated fadeInDown header-fixed");
        }
    });

    // navbar-click
    $(".navbar li a").on("click", function () {
        var element = $(this).parent("li");
        if (element.hasClass("show")) {
            element.removeClass("show");
            element.find("li").removeClass("show");
        } else {
            element.addClass("show");
            element.siblings("li").removeClass("show");
            element.siblings("li").find("li").removeClass("show");
        }
    });

    // popup video

    $('.popupvideo').magnificPopup({
        type: 'video'
    });

    // plan-offer-carousel
    $('.plan-offer-carousel').slick({
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // choose-us-carousel
    $('.choose-us-carousel').slick({
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    // choose-us-carousel
    $('.choose-us-carousel-rtl').slick({
        rtl: true,
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

//investor-carousel
    $('.investor-carousel').slick({
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.investor-carousel-rtl').slick({
        rtl: true,
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // testmonial-carousel
    $('.testmonial-carousel').slick({
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // testmonial-carousel
    $('.testmonial-carousel-rtl').slick({
        rtl: true,
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // payment-carousel
    $('.payment-carousel').slick({
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // payment-carousel
    $('.payment-carousel-rtl').slick({
        rtl: true,
        infinite: true,
        autoplay: false,
        focusOnSelect: true,
        speed: 1000,
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icofont-arrow-left\"  aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icofont-arrow-right\"  aria-hidden='true'></i></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
            var slideNumber = (i + 1),
                totalSlides = slider.slideCount;
            return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
            {
                breakpoint: 1205,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });

// rounded class add remove
    $('.btn-header-link').click(function () {
        $('.btn-header-link').parents('.card').removeClass('card-rounded');
        if (!$(this).hasClass('collapsed')) {
            $(this).parents('.card').removeClass('card-rounded');
        } else {
            $(this).parents('.card').addClass('card-rounded');
        }
    });

    // Comment reply hide show
    $(".reply-btn").click(function () {
        $(".reply-form").slideToggle("active");
    });

    // wow Animation
    wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100,
        }
    );
    wow.init();


    $('.language').flagStrap({
        buttonSize: "btn-sm",
        buttonType: "btn-lg",
        labelMargin: "5px",
        scrollable: false,
        scrollableHeight: "350px",
        placeholder: {
            value: "",
            text: ""
        }
    });


})(jQuery);


