$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 1,
        dots: true
    });
    $("#capture form").on('submit', function(){
        $.ajax({
            url: '',
            method: 'POST',
            data: {
                name: $("#name").val(),
                phone: $("#phone").val(),
                email: $("#email").val()
            },
            success: function(data) {
                $("#capture").modal('hide');
                $('#response').modal('show');
            }
        });
        return false;
    });
});