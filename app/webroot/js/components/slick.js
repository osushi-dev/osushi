$('.carousel').slick({
    infinite: true,
    centerMode: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    // dots: true,
    prevArrow: '<i class="fa fa-chevron-left slick-prev"></i>',
    nextArrow: '<i class="fa fa-chevron-right slick-next"></i>',
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
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
