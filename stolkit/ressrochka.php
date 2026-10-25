<?
/*
Template name: Resel
*/
get_header(); ?>
<? the_post(); ?>
<div class="es1_rassr_bg">
        <div class="container">     
           
           <div class="es1_rassr__girl"></div>     

           <div class="es1_rassr__left_col">
              
              <div class="es1_rassr_skidkaznach"><img src="<? echo get_template_directory_uri(); ?>/img/nullproc.png" alt=""></div>
              
              <div class="es1_rassr__okna">Изделия</div>
              
              <div class="es1_rassr__vrassr">В РАССРОЧКУ</div>
              
              <div class="es1_rassr__bezpereplaty">Без переплаты</div>                          
              <div class="es1_rassr__icotext"><img src="<? echo get_template_directory_uri(); ?>/img/ico1.png" alt="">На срок от 6 до 36 месяцев</div>

              <div class="es1_rassr__icotext"><img src="<? echo get_template_directory_uri(); ?>/img/ico2.png" alt="">Оформление за 15 минут</div>

              <div class="es1_rassr__icotext"><img src="<? echo get_template_directory_uri(); ?>/img/ico3.png" alt="">Без предоплаты</div>   

           </div><!-- /.es1_rassr__left_col -->
           
           <br><br>
           <div class="row">
               <div class="col-md-6 es1_rassr__bankleft">Сотрудничество с банками "Альфа-Банк" и "Кредит Европа Банк" на протяжении долгих лет позволило создать для Вас <span>выгодные условия по кредитованию</span></div>
               <div class="col-md-6 es1_rassr__bankright">
                  <img src="<? echo get_template_directory_uri(); ?>/img/bank1.png" alt="">
                  <img src="<? echo get_template_directory_uri(); ?>/img/bank2.png" alt="">
               </div>
           </div>
           
        </div>
     </div>
   <div class="b-rassr">
   
      
         <div class="container">
            
            <div class="b-rassr__zag">условия по рассрочке и кредиту</div>
            
            <div class="row b-rassr__row">
               <div class="col-md-1"></div>
               <div class="col-md-2 b-rassr__ico"><img src="<? echo get_template_directory_uri(); ?>/img/1_ico.png" alt=""></div>
               <div class="col-md-8">
                  <div class="b-rassr__b1">Вы получаете новые Изделия, даже не имея в данный момент 
необходимой суммы на их приобретение и установку.</div>

                  <div class="b-rassr__b2">Вы сразу знаете размер ежемесячного платежа и можете, при желании, погашать платежи досрочно или по мере поступления такой возможности.</div>
               </div>
               <div class="col-md-1"></div>
            </div>
            
            
            
            <div class="row b-rassr__row">
               <div class="col-md-1"></div>
               <div class="col-md-2 b-rassr__ico"><img src="<? echo get_template_directory_uri(); ?>/img/2_ico.png" alt=""></div>
               <div class="col-md-8">
                  <div class="b-rassr__b1">Вы сами выбираете оптимальный вариант рассрочки или 
кредитования. Наши специалисты всегда готовы помочь 
Вам в этом вопросе.</div>

                  <div class="b-rassr__b2">Вы экономите свое время, не тратя его на посещения банков с целью выяснения возможности получения кредита, так как все это мы сделаем за Вас!</div>
               </div>
               <div class="col-md-1"></div>
            </div>
            
            
            <div class="row b-rassr__row">
               <div class="col-md-1"></div>
               <div class="col-md-2 b-rassr__ico"><img src="<? echo get_template_directory_uri(); ?>/img/3_ico.png" alt=""></div>
               <div class="col-md-8">
                  <div class="b-rassr__b1">Банк рассматривает анкету заявителя<br>
всего 10-15 минут! </div>

                  <div class="b-rassr__b2">Вы дополнительно экономите свое время, так как процесс рассмотрения и оформления заявки на выдачу кредита или приобретение изделий в рассрочку займет минимум Вашего времени!</div>
               </div>
               <div class="col-md-1"></div>
            </div>
            
            
            <br>
            
            <div class="b-rassr__text">Дополнительную информацию о приобретении изделий в рассрочку или получении кредита 
               Вы можете получить, обратившись по телефону: <a style="text-decoration:none;color: #1a1918" href="tel:+7 (499) 340 60 25"><span class="comagic_phone">+7 (499) 340 60 25</span></a></div>
            
            
         </div>
         
     </div>       
<? get_template_part('templates/common/calculator'); ?>
<? get_template_part('templates/common/timer'); ?>
<? get_template_part('templates/common/textures'); ?>
<? get_template_part('templates/common/claim'); ?>
<? get_template_part('templates/common/reviews'); ?>
<? get_template_part('templates/common/portfolio'); ?>
<? get_template_part('templates/common/free_consultation'); ?>
<? get_template_part('templates/common/contacts'); ?>
<? get_footer(); ?>