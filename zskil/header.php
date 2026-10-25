<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<? echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
      <link rel="stylesheet" href="<? echo get_template_directory_uri(); ?>/style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="<? echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
      <script src="<? echo get_template_directory_uri(); ?>/js/calendar.js"></script>
      <script type="text/javascript">
         $(function(){
            if ($(".menu" ).offset().top > 100) $("header" ).addClass('bs-scroll');
            else $("header" ).removeClass('bs-scroll');
            $(window).on('scroll', function(){
               if ($(".menu" ).offset().top > 100) $("header" ).addClass('bs-scroll');
               else $("header" ).removeClass('bs-scroll');
            });
            $("#calendar").calendar({'31-01-2018': ['b'], '09-09-2018': ['b', 'p', 'l']});
            $('.burger').on('click', function(){ $('.mobile_menu').toggleClass('active');  return false; });
         });
      </script>
   </head>
   <body <? body_class(); ?>>
      <header>
         <div class="container-custom">
            <div class="row">
               <div class="col-md-2">
                  <a href="/"><img src="<? echo get_template_directory_uri(); ?>/images/qub.png" class="logoimg"></a>
                  <a href="#" class="burger"><i class="fas fa-bars fa-3x"></i></a>
                  <div class="mobile_menu">
                     <ul>
                        <li><a href="/o-proekte/" class="bordered">О проекте</a></li>
                        <li><a href="/meropriyatiya/">Мероприятия</a></li>
                        <li><a href="/kontakty/" class="bordered">Контакты</a></li>
                     </ul>
                     <a href="#" class="login-btn">Вход / Регистрация</a>
                  </div>
               </div>
               <div class="col-md-7 col-lg-8">
                  <div class="row menu">
                     <div class="col-md-8 col-lg-7">
                        <div class="row">
                           <div class="col-md-6">
                              <a href="/o-proekte/" class="bordered">О проекте</a>
                           </div>
                           <div class="col-md-6">
                              <a href="/meropriyatiya/" class="bordered">Мероприятия</a>
                           </div>
                        </div>
                     </div>
                     <!--<div class="col-md-3 col-lg-2">
                        <img src="<? echo get_template_directory_uri(); ?>/images/glass.png" class="glass">
                     </div>-->
                     <div class="col-md-4 col-lg-5">
                        <div class="row">
                           <div class="col-md-6">
                              <a href="/kontakty/" class="bordered">Контакты</a>
                           </div>
                           <div class="col-md-6">
                              <a href="#" class="search"><i class="fas fa-search fa-2x"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-lg-2">
                  <a href="#" class="login-btn">Вход / Регистрация</a>
               </div>
            </div>
         </div>
      </header>