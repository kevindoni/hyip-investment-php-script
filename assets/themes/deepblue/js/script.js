"use strict";
var $ = $.noConflict();
$(document).ready(function(){
    var x, i, j, selElmnt, a, b, c;
    x = document.getElementsByClassName("select-redesign");
    for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 0; j < selElmnt.length; j++) {
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        for (k = 0; k < y.length; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.on('click',);
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
            this.classList.add("tick-active");
        });
    }
    function closeAllSelect(elmnt) {
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }
    document.addEventListener("click", closeAllSelect);

    var bootstrapButton = $.fn.button.noConflict();
    $.fn.bootstrapBtn = bootstrapButton;

    new WOW().init();

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

    $(".login-signup a").on('click', function(e) {
        e.preventDefault();
        $("#modal-login").toggleClass("modal-open");
    });
    $(".modal-login-body").on('click',function(e){
        e.stopPropagation();
    });
    $(".modal-wrapper").on('click', function(e) {
        e.preventDefault();
        $("#modal-login").removeClass("modal-open");
    });
    $(".btn-close").on('click',function(){
        $("#modal-login").removeClass("modal-open");
    });
    $(".btn-forget").on('click',function(){
        $(".signin").css("display","none");
        $(".reset-password").fadeIn();
    });
    $(".btn-signup").on('click',function(){
        $(".signin").css("display","none");
        $(".reset-password").css("display","none");
        $(".register").fadeIn();
    });
    $(".btn-login-back").on('click',function(){
        $(".reset-password").css("display","none");
        $(".register").css("display","none");
        $(".signin").fadeIn();
    });


    $('.navbar-toggler').on('click',function(){
        $(this).toggleClass('custom-toggler');
    });

    $('.das-nav').on('click',function(){
        $(this).parent('.dashboard-nav').find('.active').removeClass('active');
        $(this).addClass('active');
    });
    $('.sidenavbar-toggler').on('click',function(){
        $('#sidenavbar').css('left', '0');
    });
    $('.sidenav-close').on('click',function(){
        $('#sidenavbar').css('left', '-330px');
    });

    $(".btn-play").on('click', function(e) {
        e.preventDefault();
        $("#modal-video").toggleClass("modal-open");
    });
    $(".modal-content").on('click',function(e){
        e.stopPropagation();
    });
    $(".modal-wrapper").on('click', function(e) {
        e.preventDefault();
        $("#modal-video").removeClass("modal-open");
    });
    $(".btn-close").on('click',function(){
        $("#modal-video").removeClass("modal-open");
    });

    $('.slider-testimonial').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        arrows: false,
        adaptiveHeight: true,
        infinite: true,
        useTransform: true,
        speed: 1000,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        fade: false,
        asNavFor: '.slider-nav',
    });
    $('.slider-nav').on('init', function(event, slick) {
        $('.slider-nav .slick-slide.slick-current').addClass('is-active');
    })
        .slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-testimonial',
            autoplay: false,
            autoplaySpeed: 2000,
            arrows: true,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            infinite: true,
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                }
            }]
        });

    $('.slider-testimonial').on('afterChange', function(event, slick, currentSlide) {
        $('.slider-nav').slick('slickGoTo', currentSlide);
        var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
        $('.slider-nav .slick-slide.is-active').removeClass('is-active');
        $(currrentNavSlideElem).addClass('is-active');
    });

    $('.slider-nav').on('click', '.slick-slide', function(event) {
        event.preventDefault();
        var goToSingleSlide = $(this).data('slick-index');
        $('.slider-testimonial').slick('slickGoTo', goToSingleSlide);
    });

    $('.slider-testimonial-rtl').slick({
        rtl: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        arrows: false,
        adaptiveHeight: true,
        infinite: true,
        useTransform: true,
        speed: 1000,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        fade: false,
        asNavFor: '.slider-nav-rtl',
    });
    $('.slider-nav-rtl').on('init', function(event, slick) {
        $('.slider-nav-rtl .slick-slide.slick-current').addClass('is-active');
    })
        .slick({
            rtl: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-testimonial-rtl',
            autoplay: false,
            autoplaySpeed: 2000,
            arrows: true,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            infinite: true,
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                }
            }]
        });

    $('.slider-testimonial-rtl').on('afterChange', function(event, slick, currentSlide) {
        $('.slider-nav-rtl').slick('slickGoTo', currentSlide);
        var currrentNavSlideElem = '.slider-nav-rtl .slick-slide[data-slick-index="' + currentSlide + '"]';
        $('.slider-nav-rtl .slick-slide.is-active').removeClass('is-active');
        $(currrentNavSlideElem).addClass('is-active');
    });

    $('.slider-nav-rtl').on('click', '.slick-slide', function(event) {
        event.preventDefault();
        var goToSingleSlide = $(this).data('slick-index');
        $('.slider-testimonial-rtl').slick('slickGoTo', goToSingleSlide);
    });

    $('.slider-controls').slick({
        arrows: false,
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsiveClass: true,
        responsive: [
            {
                breakpoint: 1200000,
                settings: 'unslick',
            },
            {
                breakpoint: 992,
                settings: {
                    settings: "slick",
                    dots: true,
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    settings: "slick",
                    dots: true,
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 401,
                settings: {
                    settings: "slick",
                    dots: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });

    $(document).on('click', '.btn-faq', function(e){
        e.preventDefault();
        $(this).parents('.faq-card').find('.card-body').slideToggle();
        if($(this).parents('.faq-card').find('.card-body').hasClass('preview')) {
            $('.btn-faq').removeClass('rotate-icon');
            $(this).parents('.faq-card').find('.card-body').toggleClass('preview');

        }else{
            $('.btn-faq').not(this).removeClass('rotate-icon');
            $(this).toggleClass('rotate-icon');
            $('.btn-faq').not(this).parents('.faq-card').find('.card-body').removeClass('preview');
            $('.btn-faq').not(this).parents('.faq-card').find('.card-body').css('display', 'none');
            $(this).parents('.faq-card').find('.card-body').addClass('preview')
        }
    });

    $(".carousel-investor").each(function() {
        $(this).owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            margin: 30,
            autoplay: false,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    dots: true
                },
                575:{
                    items: 1,
                    nav: false,
                    dots: true,
                },
                576:{
                    items: 2,
                },
                767:{
                    items: 2,
                },
                991:{
                    items: 2,
                },
                992:{
                    items: 3,
                },
                1200:{
                    items: 4,
                }
            }
        });
    });
    $(".carousel-investor-rtl").each(function() {
        $(this).owlCarousel({
            rtl: true,
            loop: true,
            nav: true,
            dots: false,
            margin: 30,
            autoplay: false,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    dots: true
                },
                575:{
                    items: 1,
                    nav: false,
                    dots: true,
                },
                576:{
                    items: 2,
                },
                767:{
                    items: 2,
                },
                991:{
                    items: 2,
                },
                992:{
                    items: 3,
                },
                1200:{
                    items: 4,
                }
            }
        });
    });

    $(".carousel-shareoffer").each(function() {
        $(this).owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            margin: 30,
            autoplay: false,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    dots: true
                },
                575:{
                    items: 1,
                    nav: false,
                    dots: true,
                },
                767:{
                    items: 1,
                },
                991:{
                    items: 2,
                },
                992:{
                    items: 3,
                },
                1200:{
                    items: 3,
                }
            }
        });
    });
    $(".carousel-shareoffer-rtl").each(function() {
        $(this).owlCarousel({
            rtl: true,
            loop: true,
            nav: true,
            dots: false,
            margin: 30,
            autoplay: false,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    dots: true
                },
                575:{
                    items: 1,
                    nav: false,
                    dots: true,
                },
                767:{
                    items: 1,
                },
                991:{
                    items: 2,
                },
                992:{
                    items: 3,
                },
                1200:{
                    items: 3,
                }
            }
        });
    });

    $(".carousel-payment").each(function() {
        $(this).owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            margin: 30,
            autoplay: false,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    dots: true
                },
                575:{
                    items: 1,
                    nav: false,
                    dots: true,
                },
                767:{
                    items: 2,
                },
                991:{
                    items: 3,
                },
                992:{
                    items: 4,
                },
                1200:{
                    items: 4,
                }
            }
        });
    });
    $(".carousel-payment-rtl").each(function() {
        $(this).owlCarousel({
            rtl: true,
            loop: true,
            nav: true,
            dots: false,
            margin: 30,
            autoplay: false,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    dots: true
                },
                575:{
                    items: 1,
                    nav: false,
                    dots: true,
                },
                767:{
                    items: 2,
                },
                991:{
                    items: 3,
                },
                992:{
                    items: 4,
                },
                1200:{
                    items: 4,
                }
            }
        });
    });

    $('.btn-reply').on('click',function(e){
        e.preventDefault();
        $(this).parents('.media-body').find('.reply').slideToggle();
    });

    // new PerfectScrollbar('.account-dropdown .scrolling-i');
    // new PerfectScrollbar('.account-dropdown .scrolling-ii');
    // new PerfectScrollbar('.account-dropdown .scrolling-iii');
    // new PerfectScrollbar('.account-dropdown .scrolling-iv');
});






/*============= Login, Registration & Reset Password Request Modal  ===============*/


function selectedCountryCode() {
    $('input[name=country_code]').val($('.country_code').find(':selected').data("code"))
}
selectedCountryCode();

$(document).on('change', ".country_code", function () {
    selectedCountryCode();
});

$(document).on('change keyup', "input, select, textarea", function () {
    $(this).siblings(".text-danger").text(``);
});

$(document).on('change keyup', "input[name=phone]", function () {
    $(this).parents(".form-group").find('.text-danger').text(``);
});


$(document).on('submit', '#login-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var formData = new FormData($(this)[0]);

    $('.emailError').text(``);
    $('.usernameError').text(``);
    $('.passwordError').text(``);

    $.ajax({
        type: "post",
        url: url,
        data: formData,
        cache: false,
        async: false,
        processData: false,
        contentType: false,
        success: function (data) {
            $('.login-auth-btn').html(`<i class="fa fa-spinner"></i> Processing..`);
            setTimeout(function () {
                location.href = data;
                $('.login-auth-btn').text(`Success`);
            }, 2000);
        },
        error: function (res) {
            if (res.status == 422) {
                $('.emailError').text(res.responseJSON.errors.email);
                $('.usernameError').text(res.responseJSON.errors.username);
                $('.passwordError').text(res.responseJSON.errors.password);
            }
            if (res.status == 429) {
                $('.emailError').text(res.responseJSON.errors.email);
                $('.usernameError').text(res.responseJSON.errors.username);
            }
            else if (res.status == 401) {
                $('.usernameError').text(res.responseJSON);
            }
        }
    })
});


$(document).on('submit', '#signup-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var formData = new FormData($(this)[0]);
    $('.text-danger').text(``);

    $.ajax({
        type: "post",
        url: url,
        data: formData,
        cache: false,
        async: false,
        processData: false,
        contentType: false,
        success: function (data) {


            $('.login-signup-auth-btn').html(`<i class="fa fa-spinner"></i> Loading`);
            setTimeout(function () {
                location.href = data;
                $('.login-signup-auth-btn').text(`Success`);
            }, 2000);
        },
        error: function (res) {
            if (res.status == 422) {
                $('.firstnameError').text(res.responseJSON.errors.firstname);
                $('.lastnameError').text(res.responseJSON.errors.lastname);
                $('.usernameError').text(res.responseJSON.errors.username);
                $('.emailError').text(res.responseJSON.errors.email);
                $('.phoneError').text(res.responseJSON.errors.phone);
                $('.passwordError').text(res.responseJSON.errors.password);
            }
            if (res.status == 429) {
                $('.emailError').text(res.responseJSON.errors.email);
                $('.usernameError').text(res.responseJSON.errors.username);
            }
        }
    })
});


$(document).on('submit', '#reset-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var formData = new FormData($(this)[0]);
    $('.text-danger').text(``);
    $.ajax({
        type: "post",
        url: url,
        data: formData,
        cache: false,
        async: false,
        processData: false,
        contentType: false,
        success: function (data) {

            if(data.status == 200){
                Notiflix.Notify.Success(""+data.message);
                $('.login-recover-auth-btn').html(`<i class="fa fa-spinner"></i> Loading`);
                setTimeout(function () {
                    $('.login-recover-auth-btn').text(`Success`);


                    $("#modal-login").removeClass("modal-open");
                }, 2000);


            }
        },
        error: function (res) {

            if (res.status == 422) {
                $('.emailError').text(res.responseJSON.errors.email);
            }
            if (res.status == 429) {
                $('.emailError').text(res.responseJSON.errors.email);
            }
        }
    })
});








