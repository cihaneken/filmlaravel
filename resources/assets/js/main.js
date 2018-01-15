
/* Hazır olunca */
$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
        autoplay: true,
        loop: true,
        margin: 10,
        nav: true,
        autoplayTimeout:2000,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 6
            }
        }
    });
});