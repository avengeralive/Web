$(document).ready(function(){
    $("ul[is-slider]").carouFredSel({
        responsive: true,
        width: "100%",
        height: 'variable',
        items: {
            height: 'variable'
        },
        scroll: {
            items: 1,
            fx: "crossfade",
            visible: {
                min: 1,
                max: 1
            }
        },
        next: ".slide-to_next",
        prev: ".slide-to_prev",
        swipe: true
    });
});