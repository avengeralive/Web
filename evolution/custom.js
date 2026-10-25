$(function () {
$("#header-search").on('click', function(){
        if ($("#search-form").hasClass('active')) 
        {
            $("#header-search i").addClass('fa-search');
            $("#header-search i").removeClass('fa-close');
            $("#search-form").removeClass('active');
        }
        else 
        {
            $("#header-search i").removeClass('fa-search');
            $("#header-search i").addClass('fa-close');
            $("#search-form").addClass('active');
        }
    });
    var $hs = $('.top-menu-holder');

    $(document).scroll(function () {
        var y = $(this).scrollTop();
        if (y > 150) {
            $hs.addClass("hold-top");
        } else {
            $hs.removeClass("hold-top");
        }
    });

    var onSubmenu = false;

    $('.tm-dropdown-menu').mouseenter(function () {
        onSubmenu = true;
    }).mouseleave(function () {
        onSubmenu = false;
        $(this).removeClass('open');
    });

    $('.tm-dropdown').mouseenter(function () {
        $('.tm-dropdown-menu').removeClass('open');
        var $target = $($(this).prop('target'));
        $target.addClass('open');
    }).mouseleave(function () {
        var self = this;
        setTimeout(function () {
            if (!onSubmenu) {
                var $target = $($(self).prop('target'));
                $target.removeClass('open');
            }
        }, 100);
    });

    jQuery("#zoominout").bannerscollection_zoominout({
        skin:"opportune",
        width:1920,
        height:600,
        width100Proc:true,
        height100Proc:false,
        responsive:true,
        responsiveRelativeToBrowser:true,
        setAsBg:false,
        autoPlay:10,
        loop:true,
        fadeSlides:true,
        horizontalPosition:"center",
        verticalPosition:"center",
        initialZoom:1,
        finalZoom:0.8,
        duration:20,
        durationIEfix:30,
        zoomEasing:"ease",
        target:"_blank",
        pauseOnMouseOver:false,
        showAllControllers:true,
        showNavArrows:true,
        showOnInitNavArrows:true,
        autoHideNavArrows:true,
        showBottomNav:true,
        showOnInitBottomNav:true,
        autoHideBottomNav:false,
        showPreviewThumbs:true,
        enableTouchScreen:true,
        absUrl:"",
        scrollSlideDuration:0.8,
        scrollSlideEasing:"swing",
        defaultEasing:"swing",
        myloaderTime:1,
        showCircleTimer:true,
        circleRadius:13,
        circleLineWidth:2,
        circleColor:"#ffffff",
        circleAlpha:100,
        behindCircleColor:"##ffffff",
        behindCircleAlpha:20,
        numberOfThumbsPerScreen:0,
        thumbsWrapperMarginTop:30,
        thumbsOnMarginTop:0,
        defaultExitLeft:0,
        defaultExitTop:0,
        defaultExitFade:1,
        defaultExitDuration:0,
        defaultExitDelay:0,
        defaultExitEasing:"swing",
        defaultExitOFF:true
    });

    $('#order-btn').click(function (e) {
        e.preventDefault();
        $('#order-btn-form').toggleClass("hidden");
    });

    $('.close-form').click(function (e) {
        e.preventDefault();
        $('#order-btn-form').addClass("hidden");
    });




    $('#review-btn').click(function (e) {
        e.preventDefault();
        $('#review-btn-form').toggleClass("hidden");
    });

    $('.close-form').click(function (e) {
        e.preventDefault();
        $('#review-btn-form').addClass("hidden");
    });




    // fancybox
    $(".fancy").fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic',

        helpers: {
            title: {
                type: 'inside'
            }
        }
    });



});
