( function( $ ) {
    'use strict';


/*
* Menu anchor smooth animation
*/

    // Cache selectors
    var lastId,
        topMenu = $("#menu-list"),
        topMenuHeight = topMenu.outerHeight() + 15,
        // All list items
        menuItems = topMenu.find("li > a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
            var item = $($(this).attr("href"));
            if (item.length) { return item; }
        });

    // Bind click handler to menu items
    menuItems.on('click', function(e){
        if( $('#navbar-menu-collapse').hasClass('in'))
        {
            $(".navbar-collapse").collapse('hide');
        }

        var href = $(this).attr("href");
            var offsetTop = href === "#" ? 0 : $(href).offset().top - topMenuHeight + 1;
        $('html, body').stop().animate({ 
            scrollTop: offsetTop
        }, 700);

        e.preventDefault();
    });

    // Bind to scroll
    $(window).on('scroll', function(){
        
        // Get container scroll position
        var fromTop = $(this).scrollTop() + topMenuHeight;
        
        // Get id of current scroll item
        var cur = scrollItems.map(function(){
            if ($(this).offset().top < fromTop)
            return this;
        });

        // Get the id of the current element
        cur = cur[cur.length-1];
        var id = cur && cur.length ? cur[0].id : "";
        
        if (lastId !== id) {
            lastId = id;

            // Set/remove active class
            menuItems
                .parent().removeClass("active")
                .end().filter("[href='#"+id+"']").parent().addClass("active");
        }                 
    });


    // On Scrolling Action
    $(window).on('scroll', function() {

        // jQuery to collapse the navbar on scroll
        if ($('.navbar').offset().top > 50) {
            $('.navbar-fixed-top').addClass('top-nav-collapse');
        } else {
            $('.navbar-fixed-top').removeClass('top-nav-collapse');
        }

        // Show & Hide Scroll Top Button
        if ($('.navbar').offset().top > 197) {
            $('.button-scroll-top').fadeIn(1000);
        } else {
            $('.button-scroll-top').fadeOut(100);
        }
        
    });


    /* Smooth scrolling for scroll to top button & on logo */
    $('.to-top').on('click', function(){
        $('body, html').animate({scrollTop: 0},1000);
    });

    /* Smooth scrolling for cover button  */
    $('.coverButton').on('click', function(e){
        e.preventDefault();

        var link = $(this).attr('href');
        var posiCover = $(link).offset().top;

        $('body, html').animate({scrollTop: posiCover}, 700);
    });

    


/*
* Owl Carousel Set Up 
*/
    var owl = $('.owl-carousel');

    owl.owlCarousel({
        items: 3,
        loop: false,
        margin: 20,
        dots: false,
        transitionStyle : 'fade',
        responsiveRefreshRate : 25,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    // Custom Navigation Events
    $('.pr-testimonial-prev').on('click', function(){
        owl.trigger('prev.owl.carousel');
    });
    $('.pr-testimonial-next').on('click', function(){
        owl.trigger('next.owl.carousel');
    });




/*
* Chart JS Set Up 
*/
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var chartItems = $('.pr-vitamins-items');
    var chartItemsColor = chartItems.find('[data-ci-color]');
    var chartItemsCount = chartItems.find('[data-ci-count]');
    var labelItems = chartItems.find('h4');//$('.pr-vitamins-item');

    var chartColors = [];
    var chartData = [];
    var labelData = [];

    chartItemsColor.each( function( i, item ) {
        chartColors.push( item.getAttribute('data-ci-color') );
        item.style.backgroundColor = item.getAttribute('data-ci-color');
    });

    chartItemsCount.each( function( i, item ) {
        chartData.push( item.getAttribute('data-ci-count') );
    });

    labelItems.each( function( i, item ) {
        labelData.push( item.innerText );
    } );


    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: chartData,
                backgroundColor: chartColors
            }],
            labels: labelData
        },
        options: {
            responsive: true,
            legend: {
                display: false,
                position: 'top',
            },
            title: {
                display: false,
                text: 'Chart Title'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            cutoutPercentage: 50,
            tooltips: {
                enabled: true,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var currentValue = dataset.data[tooltipItem.index];
                        var labelData = data.labels[tooltipItem.index];

                        return labelData + ": " + currentValue + "%";
                    }
                }
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myDoughnut = new Chart(ctx, config);
    };




/*
* Contact Form And Newsletter - Validation & Submit
*/
    onBlurValidator(formName, formEmail, formMessage);

    // Contact Form - Send Data
    $('.pr-contact-form').on('submit', function (e) {
        e.preventDefault();

        if (e.isDefaultPrevented()) {
            var valid;

            valid = validateContact(formName, formEmail, formMessage);
            if(valid) {
                jQuery.ajax({
                    url: "/wp-admin/admin-post.php?action=ring",
                    data: $(this).serialize(),
                    type: "POST",
                    success:function(data){
                        if( data === "true" ) {
                            // Show Success Message 
                            swal({
                                title: "Отправлено!", 
                                text: "Сообщение успешно доставлено!", 
                                type: "success",
                                confirmButtonColor: "#40D900",
                            });

                            // Empty Fields
                            emptyFields(formName, formEmail, formMessage);
                        } else {
                            swal({
                                title: "Ошбика!",
                                text: "<span style='color:#f0ad4e'>Пожалуйста, попробуйте снова.<span>",
                                html: true,
                                confirmButtonColor: "#40D900",
                            });
                        }
                    },
                    error:function (err){
                        swal({
                            title: "Ошибка сервера!",
                            text: "<span style='color:#d9534f'>Bad request<span>",
                            html: true,
                            confirmButtonColor: "#40D900",
                        });
                    }
                });
            }
        }
    });

    // Newsletter - Subscribe
    $(nlEmail).on('blur', function() {
        validateEmail(nlEmail);
    });

     $('.pr-newsletter-form').on('submit', function (e) {
        e.preventDefault();

        if (e.isDefaultPrevented()) {
            var valid;

            valid = validateEmail(nlEmail);
            if(valid) {
                jQuery.ajax({
                    url: "mail/mailchimp.php",
                    data: $(this).serialize(),
                    type: "POST",
                    success:function(data){
                        if( data === "true" ) {
                            // Show Success Message 
                            swal({
                                title: "Success!", 
                                text: "Your are successful subscribed!", 
                                type: "success",
                                confirmButtonColor: "#40D900",
                            });

                            // Empty Fields
                            $(nlEmail).val('');
                            $(nlEmail).css('border-color','#D0D0D0');
                        } else {
                            swal({
                                title: "Please try again!",
                                text: "Error: <span style='color:#f0ad4e'>" + data + "<span>",
                                html: true,
                                confirmButtonColor: "#40D900",
                            });
                        }
                    },
                    error:function (err){
                        swal({
                            title: "Server error!",
                            text: "<span style='color:#d9534f'>Bad request<span>",
                            html: true,
                            confirmButtonColor: "#40D900",
                        });
                    }
                });
            }
        }
    });  


} )( jQuery );