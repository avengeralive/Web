<?php
date_default_timezone_set('Europe/Moscow');
require("header.php");
?>
<body>
	<div id="wrapper">
		<header id="header">
			<div class="header-row">
				<div class="container clear">
					<a href="#" class="nav-opener">
						<span></span>
					</a>
					<div class="lang-switch">
						<ul class="lang-list">
<?php
    if($site->current_part->sid=="en") echo '<li><a href="/">РУС</a></li><li class="active"><a href="/en/">ENG</a></li>';
    else echo '<li class="active"><a href="/">РУС</a></li><li><a href="/en/">ENG</a></li>';
?>                        
							
						</ul>
					<!-- 	<form action="#" class="lang-form">
							<fieldset>
								<select>
									<option value="Hours">Выбрать язык</option>
									<option value="Days">Days</option>
									<option value="Weeks">Weeks</option>
									<option value="Months">Months</option>
									<option value="Years">Years</option>
								</select>
							</fieldset>
						</form> -->
					</div> 
<?php
if($site->current_part->sid=="en") echo '<form action="/en/search/" method="post" class="search"><fieldset><label class="input-holder"><input name="query" type="text" placeholder="Search" /></label><button class="srch-btn"></button></fieldset></form>';
else echo '<form action="/search/" method="post" class="search"><fieldset><label class="input-holder"><input name="query" type="text" placeholder="Поиск" /></label><button class="srch-btn"></button></fieldset></form>';

if($site->current_part->sid=="main")  echo '<div class="menu-frame">
						<div class="col hasdrop">
							<a href="#">Климатическим компаниям</a>
                            <div class="menu-drop">
								<ul>
									<li><a href="/proekti_apik/">Проекты АПИК</a></li>
									<li><a href="/vozmozhnosti_apik/">Возможности АПИК</a></li>
									<li><a href="http://climatexpo.ru/participants/request/" target="_blank">Принять участие в выставке Мир Климата </a></li>
									<li><a href="/partneri_apik/iszs_proekt/">СРО ПРОЕКТ</a></li>
									<li><a href="/partneri_apik/iszs_montazh/">СРО МОНТАЖ</a></li>
								</ul>
							</div>
						</div>
						<div class="col hasdrop">
							<a href="#">Профессионалам климатического рынка</a>
                            <div class="menu-drop">
								<ul>
									<li><a href="/vozmozhnosti_apik/standards/">Госты, СП и СНиПы</a></li>
                                    <li><a href="/vozmozhnosti_apik/exhibitions/">Календарь выставок</a></li>
                                    <li><a href="/proekti_apik/vistavka_mir_klimata/">Выставка Мир Климата</a></li>
                                    <li><a href="/proekti_apik/magazine_mir_klimata/">Журнал Мир Климата</a></li>
                                    <li><a href="/vozmozhnosti_apik/marketing/">Маркетинг</a></li>
                                    <li><a href="/proekti_apik/ukc_universitet_klimata/">Обучение</a></li>
    								<li><a href="/vozmozhnosti_apik/obuchenie_trudoustroistvo/">Трудоустройство</a></li>
                                </ul>
							</div>
						</div>
						<div class="col">
							<a href="/buy/">Подбор оборудования</a>
							<a href="/members/object/">Подбор подрядчика</a>
						</div>
					</div>
				<!--	<ul class="user-menu">
						<li><a href="#">Авторизоваться</a></li>
						<li><a href="#">Зарегистрироваться</a></li>
					</ul> -->';
?>                    
				</div>
			</div>
			<div class="header-frame">
				<div class="container clear">
<?php
if($site->current_part->sid=="en") echo '<strong class="logo en"><a href="/en/">Guarantee of good business climate</a></strong>';
else echo '<strong class="logo"><a href="/">АПИК Гарант надежности в климатическом бизнесе</a></strong>';
?>                
					
					<div class="info-block">
						<div class="visual"><img src="/images/img01.jpg" width="139" height="132" alt="АПИК" /></div>
						<div class="frame">
<?php
if($site->current_part->sid=="en") include($inc_path."banners/config/en_header.php");
else include($inc_path."banners/config/ru_header.php");
?>                         
						</div>
					</div>
<?php
if($site->current_part->sid=="en") include($inc_path."output/en_subscribe.php");
else include($inc_path."output/subscribe.php");
?>                      
				</div>
			</div>
			<div class="container">
<?php
include($inc_path."output/menu_top.php");
if($part->sid=="en") include($inc_path."banners/config/en_top.php");
else include($inc_path."banners/config/ru_top.php");
?>            
			</div>
		</header>
		<div id="main">
			<div class="container">
<?php
if(empty($site->current_object) && empty($site->current_rubric) && empty($global_mode) && empty($global_mode1))
{
    /*if($site->current_part->sid=="eng") include($inc_path."sliders/en-index-top.php");
    else include($inc_path."sliders/ru-index-top.php");
    include($inc_path."output/index_news.php");
    include($inc_path."output/index_projects.php");
    include($inc_path."sliders/index-bottom.php");*/
    echo $textile->TextileThis($site->current_part->get_text());
}
else 
{
    //include($inc_path."output/menu_left.php");
    echo '<div class="content-flex"><section id="content">';
    include($inc_path."output/select.php");
    echo '</section>';
    include($inc_path."output/menu_right.php");
    echo '</div>';    
}
?>
				</div>
<?php
if($site->current_part->sid=="main" && !($site->open[0]["sid"]=="members" && !empty($action[1]))) include($inc_path."output/apic_news.php");
elseif($site->current_part->sid=="main" && $site->open[0]["sid"]=="members" && !empty($action[1]) && $site->open[1]["sid"]!="news") include($inc_path."output/members_news.php");

if($site->current_part->sid=="main") include($inc_path."output/pz.php");

if($site->current_part->sid=="main" && !($site->open[0]["sid"]=="members" && !empty($action[1]))) include($inc_path."output/members_news.php");
elseif($site->current_part->sid=="main" && $site->open[0]["sid"]=="members" && !empty($action[1])) include($inc_path."output/apic_news.php");

if(empty($site->current_object) && empty($site->current_rubric) && empty($global_mode) && empty($global_mode1)) include($inc_path."output/partners.php");

if(empty($site->current_object) && empty($site->current_rubric) && empty($global_mode) && $site->current_part->sid=="main") include($inc_path."output/mk.php");
?>              
		
        
		<div class="container banners-bottom">
<?php
if($part->sid=="en") include($inc_path."banners/config/en_top.php");
else include($inc_path."banners/config/ru_top.php");
?>            
		</div>
        
        </div>       
        
		<footer id="footer">
			<div class="container">
				<div class="footer-frame">
<?php
include($inc_path."output/menu_bottom.php");
?>
				</div>
			</div>

<div class="counters">            
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='http://counter.yadro.ru/hit?t14.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодн\я' "+
"border=0 width=88 height=31><\/a>")//--></script><!--/LiveInternet-->

<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-17776070-1']);
_gaq.push(['_setDomainName', '.apic.ru']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

</script>

<!-- Yandex.Metrika -->
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<div style="display:none;"><script type="text/javascript">
try { var yaCounter1249817 = new Ya.Metrika(1249817); } catch(e){}
</script></div>
<noscript><div style="position:absolute"><img src="//mc.yandex.ru/watch/1249817" alt="" /></div></noscript>
<!-- /Yandex.Metrika -->
</div>
            
		</footer>
	</div>
</body>
</html>
