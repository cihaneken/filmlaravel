
/* Hazır olunca */
$(document).ready(function () {
    

    

    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 6
            },
            600: {
                items: 6
            },
            1000: {
                items: 6
            }
        }
    });
});