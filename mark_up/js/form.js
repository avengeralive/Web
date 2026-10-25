/**
 * Created by kashtanoff on 13.10.2014.
 */
$(document).ready(function(){
    $('.email-us-btn').click(function(){
        $('.form-email-us').show();
        $('.modal.old-form').show();
        $('.wrapper-overlay').show();
        var ymParam = $(this).attr('ymParam');
        if(ymParam) $('.form-email-us input[name=ymparam]').val(ymParam);
        return false;
    });

    $('.call-button').click(function(){

        $('.form-call-us').show();
        $('.modal.old-form').show();
        $('.wrapper-overlay').show();
        var ymParam = $(this).attr('ymParam');
        if(ymParam) $('.form-call-us input[name=ymparam]').val(ymParam);
        return false;
    });


    $('.form-email-us .close-link').click(function(){
        $('.form-email-us').hide();
        $('.modal.old-form').hide();
        $('.wrapper-overlay').hide();
        $('.form-email-us input[name=ymparam]').val('default');
        return false;
    });



    $('.form-call-us .close-link').click(function(){
        $('.form-call-us').hide();
        $('.modal.old-form').hide();
        $('.wrapper-overlay').hide();
        $('.form-call-us input[name=ymparam]').val('default');
        return false;
    });
});