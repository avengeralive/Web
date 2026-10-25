$(document).ready(function(){
 
    /* Делаем ПЛАВНУЮ ПРОКРУТКУ к элементам */
    $(function(){ // плавный скролл
            $("a[href^='#']").click(function(){
                    var _href = $(this).attr("href");
                    $("html, body").animate({scrollTop: $(_href).offset().top+"px"});
                    return false;
            });
    });
    /* Конец Делаем ПЛАВНУЮ ПРОКРУТКУ к элементам */
 
    

});