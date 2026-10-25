        <footer id="section-footer" class="footer moto-section">
            <div class="moto-widget moto-widget-block moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto" data-spacing="laaa" data-widget="block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="moto-cell col-sm-12" data-container="container">
                            <div id="wid_1524115925_rtavpmiso" data-widget-id="wid_1524115925_rtavpmiso" class="moto-widget moto-widget-social-links-extended moto-preset-default moto-align-center moto-spacing-top-small moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto  " data-widget="social_links_extended" data-preset="default">
                                <ul class="moto-widget-social-links-extended__list">
                                    <li class="moto-widget-social-links-extended__item moto-widget-social-links-extended__item-1">
                                        <a href="https://www.facebook.com/profile.php?id=100022592750374" class="moto-widget-social-links-extended__link" target="_blank" >
                                            <span class="moto-widget-social-links-extended__icon fa fa-facebook"></span>
                                        </a>
                                    </li>
                                    <li class="moto-widget-social-links-extended__item moto-widget-social-links-extended__item-3">
                                        <a href="https://www.instagram.com/bibisarachess/" class="moto-widget-social-links-extended__link" target="_blank" >
                                            <span class="moto-widget-social-links-extended__icon fa fa-instagram"></span>
                                        </a>
                                    </li>
                                    <li class="moto-widget-social-links-extended__item moto-widget-social-links-extended__item-2">
                                        <a href="https://twitter.com/@bibisarachess" class="moto-widget-social-links-extended__link" target="_blank" >
                                            <span class="moto-widget-social-links-extended__icon fa fa-twitter"></span>
                                        </a>
                                    </li>
                                    <li class="moto-widget-social-links-extended__item moto-widget-social-links-extended__item-1">
                                        <a href="https://www.youtube.com/channel/UCGhmkyATmx4-L9wCg-4z2HQ" class="moto-widget-social-links-extended__link" target="_blank" >
                                            <span class="moto-widget-social-links-extended__icon fa fa-youtube"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="moto-widget moto-widget-text moto-preset-default moto-spacing-top-small moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto" data-widget="text" data-preset="default" data-spacing="saaa" data-animation="">
                                <div class="moto-widget-text-content moto-widget-text-editable"><p style="text-align: center;" class="moto-text_system_10">&copy; | 2019. <a data-action="page" data-id="16" class="moto-link" href="/privacy-policy/">Все права защищены</a><br>Разработано в <a target="_self" rel="nofollow" data-action="url" class="moto-link" href="https://veliyev.ru">Студии Али Велиева: разработка сайтов под ключ</a></p></div>
                            </div>
                            <div data-widget-id="wid__spacer__5ad82854d1550" class="moto-widget moto-widget-spacer moto-preset-default moto-spacing-top-medium moto-spacing-right-auto moto-spacing-bottom-low moto-spacing-left-auto " data-widget="spacer" data-preset="default" data-spacing="mama" data-visible-on="mobile-v">
                                <div class="moto-widget-spacer-block" style="height:10px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </footer>
        <div data-moto-back-to-top-button class="moto-back-to-top-button">
            <a ng-click="toTop($event)" class="moto-back-to-top-button-link">
                <span class="moto-back-to-top-button-icon fa"></span>
            </a>
        </div>
        <script src="/wp-content/themes/chess/js/website.assets.min.js"></script>
        <script>
            var websiteConfig = websiteConfig || {};
            websiteConfig.address = 'https://template63463.motopreview.com/';
            websiteConfig.addressHash = '63bdff39d68001fe4732f51d007838cc';
            websiteConfig.apiUrl = '/api.php';
            websiteConfig.preferredLocale = 'en_US';
            websiteConfig.preferredLanguage = websiteConfig.preferredLocale.substring(0, 2);
                    websiteConfig.back_to_top_button = {"topOffset":300,"animationTime":500,"type":"theme"};
                    websiteConfig.popup_preferences = {"loading_error_message":"The content could not be loaded."};
            websiteConfig.lazy_loading = {"enabled":true};
            websiteConfig.cookie_notification = {"enable":false,"content":"<p class=\"moto-text_normal\" style=\"text-align: justify;\">This website uses cookies to ensure you get the best experience on our website.<\/p>","content_hash":"94404561c632a6e603b0c7479e510b68"};
                    angular.module('website.plugins', []);
        </script>
        <script src="/wp-content/themes/chess/js/website.min.js"></script>
        <script src="/wp-content/themes/chess/js/modernizr.js"></script>
        <script>
            jQuery(document).ready(function($){
                //set animation timing
                var animationDelay = 2500,
                    //loading bar effect
                    barAnimationDelay = 3800,
                    barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file
                    //letters effect
                    lettersDelay = 50,
                    //type effect
                    typeLettersDelay = 150,
                    selectionDuration = 500,
                    typeAnimationDelay = selectionDuration + 800,
                    //clip effect 
                    revealDuration = 600,
                    revealAnimationDelay = 1500;
                
                initHeadline();
                

                function initHeadline() {
                    //insert <i> element for each letter of a changing word
                    singleLetters($('.cd-headline.letters').find('b'));
                    //initialise headline animation
                    animateHeadline($('.cd-headline'));
                }

                function singleLetters($words) {
                    $words.each(function(){
                        var word = $(this),
                            letters = word.text().split(''),
                            selected = word.hasClass('is-visible');
                        for (i in letters) {
                            if(word.parents('.rotate-2').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
                            letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>': '<i>' + letters[i] + '</i>';
                        }
                        var newLetters = letters.join('');
                        word.html(newLetters).css('opacity', 1);
                    });
                }

                function animateHeadline($headlines) {
                    var duration = animationDelay;
                    $headlines.each(function(){
                        var headline = $(this);
                        
                        if(headline.hasClass('loading-bar')) {
                            duration = barAnimationDelay;
                            setTimeout(function(){ headline.find('.cd-words-wrapper').addClass('is-loading') }, barWaiting);
                        } else if (headline.hasClass('clip')){
                            var spanWrapper = headline.find('.cd-words-wrapper'),
                                newWidth = spanWrapper.width() + 10
                            spanWrapper.css('width', newWidth);
                        } else if (!headline.hasClass('type') ) {
                            //assign to .cd-words-wrapper the width of its longest word
                            var words = headline.find('.cd-words-wrapper b'),
                                width = 0;
                            words.each(function(){
                                var wordWidth = $(this).width();
                                if (wordWidth > width) width = wordWidth;
                            });
                            headline.find('.cd-words-wrapper').css('width', width);
                        };

                        //trigger animation
                        setTimeout(function(){ hideWord( headline.find('.is-visible').eq(0) ) }, duration);
                    });
                }

                function hideWord($word) {
                    var nextWord = takeNext($word);
                    
                    if($word.parents('.cd-headline').hasClass('type')) {
                        var parentSpan = $word.parent('.cd-words-wrapper');
                        parentSpan.addClass('selected').removeClass('waiting'); 
                        setTimeout(function(){ 
                            parentSpan.removeClass('selected'); 
                            $word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');
                        }, selectionDuration);
                        setTimeout(function(){ showWord(nextWord, typeLettersDelay) }, typeAnimationDelay);
                    
                    } else if($word.parents('.cd-headline').hasClass('letters')) {
                        var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
                        hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
                        showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);

                    }  else if($word.parents('.cd-headline').hasClass('clip')) {
                        $word.parents('.cd-words-wrapper').animate({ width : '2px' }, revealDuration, function(){
                            switchWord($word, nextWord);
                            showWord(nextWord);
                        });

                    } else if ($word.parents('.cd-headline').hasClass('loading-bar')){
                        $word.parents('.cd-words-wrapper').removeClass('is-loading');
                        switchWord($word, nextWord);
                        setTimeout(function(){ hideWord(nextWord) }, barAnimationDelay);
                        setTimeout(function(){ $word.parents('.cd-words-wrapper').addClass('is-loading') }, barWaiting);

                    } else {
                        switchWord($word, nextWord);
                        setTimeout(function(){ hideWord(nextWord) }, animationDelay);
                    }
                }

                function showWord($word, $duration) {
                    if($word.parents('.cd-headline').hasClass('type')) {
                        showLetter($word.find('i').eq(0), $word, false, $duration);
                        $word.addClass('is-visible').removeClass('is-hidden');

                    }  else if($word.parents('.cd-headline').hasClass('clip')) {
                        $word.parents('.cd-words-wrapper').animate({ 'width' : $word.width() + 10 }, revealDuration, function(){ 
                            setTimeout(function(){ hideWord($word) }, revealAnimationDelay); 
                        });
                    }
                }

                function hideLetter($letter, $word, $bool, $duration) {
                    $letter.removeClass('in').addClass('out');
                    
                    if(!$letter.is(':last-child')) {
                        setTimeout(function(){ hideLetter($letter.next(), $word, $bool, $duration); }, $duration);  
                    } else if($bool) { 
                        setTimeout(function(){ hideWord(takeNext($word)) }, animationDelay);
                    }

                    if($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
                        var nextWord = takeNext($word);
                        switchWord($word, nextWord);
                    } 
                }

                function showLetter($letter, $word, $bool, $duration) {
                    $letter.addClass('in').removeClass('out');
                    
                    if(!$letter.is(':last-child')) { 
                        setTimeout(function(){ showLetter($letter.next(), $word, $bool, $duration); }, $duration); 
                    } else { 
                        if($word.parents('.cd-headline').hasClass('type')) { setTimeout(function(){ $word.parents('.cd-words-wrapper').addClass('waiting'); }, 200);}
                        if(!$bool) { setTimeout(function(){ hideWord($word) }, animationDelay) }
                    }
                }

                function takeNext($word) {
                    return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
                }

                function takePrev($word) {
                    return (!$word.is(':first-child')) ? $word.prev() : $word.parent().children().last();
                }

                function switchWord($oldWord, $newWord) {
                    $oldWord.removeClass('is-visible').addClass('is-hidden');
                    $newWord.removeClass('is-hidden').addClass('is-visible');
                }
            });
        </script>
        <script>$.fn.motoGoogleMap.setApiKey('AIzaSyAk8PGBXexyvCl_XGQDHqTfrNhZ1zYHFTI');</script>
        <? wp_footer(); ?>
    </body>
</html>