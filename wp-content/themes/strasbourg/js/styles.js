jQuery(document).ready(function () {

    $("#my-slider").sliderPro({
        width: "100%",
        height: 400,
        arrows: !0,
        buttons: !1,
        waitForLayers: !0,
        fade: !0,
        autoplay: !0,
        imageScaleMode: "cover"
    });


    $("#menu-main-menu-1").sticky({
        topSpacing: 0
    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 1) {
            $(".fixed-nav-bar").addClass("border-bottom");
        } else {
            $(".fixed-nav-bar").removeClass("border-bottom");
        }
    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $("#menu-main-menu-1").addClass("border-bottom");
        } else {
            $("#menu-main-menu-1").removeClass("border-bottom");
        }
    });

    $(document).ready(function () {

        $(".cross").hide();
        $("#menu-main-menu").hide();
        $(".hamburger").click(function () {
            $("#menu-main-menu").slideToggle("slow", function () {
                $(".hamburger").hide();
                $(".cross").show();
            });
        });

        $(".cross").click(function () {
            $("#menu-main-menu").slideToggle("slow", function () {
                $(".cross").hide();
                $(".hamburger").show();
            });
        });

    });

    $('.hero-slider').slick({
        slidesToShow: 1,
        autoplay: true,
        arrows: false,
        dots: true
    });

    $('.strasbourg-passes').slick({
        slidesToShow: 1,
        autoplay: true,
        arrows: false,
        dots: true
    });


    // init controller
    var controller = new ScrollMagic.Controller();

    $('.js .section').each(function () {


        var ourScene = new ScrollMagic.Scene({
                triggerElement: this.children[0],
                triggerHook: 0.9
            })

            .setClassToggle(this, 'fade-in')
            .addTo(controller);
    })

    $(function () {
        $('.box-slider').bxSlider({
            mode: 'fade',
            touchEnabled: true,
            swipeEnabled: true,
            autoHover: true,
            slideWidth: 464,
            pager: false
        });
    });

    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 50
        }, 700);
    });


    window.onscroll = function () {
        document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 ? document.getElementById("backTop").style.display = "block" : document.getElementById("backTop").style.display = "none";
    }

    $("#backTop").click(function () {
        $("body,html").animate({
            scrollTop: 0
        }, 800);
    })
    
        /*
    var selectedValue = $('.searchandfilter').find('select').val();

    if (selectedValue == '0') {
        $(".searchandfilter :submit").attr("disabled", true);
        $('.searchandfilter input[type="submit"]').css("cursor", "auto");
    }

    $(document).on('change', 'select', function () {
        var selectedValue = $('.searchandfilter').find('select').val();

        if (selectedValue == '0') {
            $(".searchandfilter :submit").attr("disabled", true);
            $('.searchandfilter input[type="submit"]').css("cursor", "auto");
        } else {
            $(".searchandfilter :submit").attr("disabled", false);
            $('.searchandfilter input[type="submit"]').css("cursor", "pointer");
        }



    });
    */



});
