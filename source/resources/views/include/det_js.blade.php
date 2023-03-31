<script src="{{asset('node_modules/blueimp-gallery/js/blueimp-gallery.min.js')}}"></script>
<script src="{{asset('node_modules/blueimp-gallery/js/blueimp-gallery-fullscreen.js')}}"></script>
<script src="{{asset('node_modules/slick-carousel/slick/slick.js')}}"></script>
<script>
    $('.center').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        slidesPerRow: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        centerPadding: '10px',
        focusOnSelect: true,
        initialSlide: 0,
        infinite: true,
        speed: 300,
        // arrows: false,
        responsive: [{
                breakpoint: 769,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3,
                    asNavFor: '.slider-for',
                    dots: false,
                    focusOnSelect: true,
                    initialSlide: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1,
                    asNavFor: '.slider-for',
                    dots: false,
                    focusOnSelect: true,
                    initialSlide: 2,
                }
            }
        ]
    });

    $('.slider-for').slick({
        // slidesToShow: 1,
        // slidesToScroll: 1,
        // fade: true,
        asNavFor: '.center',
        dots: true,
        infinite: true,
        speed: 500,
        // fade: true,
        cssEase: 'linear',
        // adaptiveHeight:true,
        responsive: [{
                breakpoint: 769,
                settings: {
                    arrows: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                }
            }
        ]
    });
</script>