if ($(window).width() < 767) {
    $('.owl-carousel.sdf').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 3
            }
        }
    });
    $(document).ready(function () {
        $("footer h4").click(function () {
            $("footer ul").slideUp();
            $(this).next("ul").slideToggle();
        });
    });
}
$(document).ready(function () {
    $('.blog-sec').css('display', 'none');
    //        -------------load more-------------
    $(".blog-sec").slice(0, 2).show();
    if ($(".blog-sec").length < 2) {
        $(".blog-more").fadeOut('slow');
    }
    $(".blog-more a").on('click', function (e) {
        e.preventDefault();
        $(".blog-sec:hidden").slice(0, 2).slideDown();
        if ($(".blog-sec:hidden").length === 0) {
            $(".blog-more").fadeOut('slow');
        }
    });
});


$('.owl-carousel.case-study').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
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

/**/

// $(document).ready(function () {
//   var maxHeight = Math.max.apply(null, $("div.story-table-head").map(function ()
// {
//     return $(this).height();
// }).get());
// alert(maxHeight);
// });
