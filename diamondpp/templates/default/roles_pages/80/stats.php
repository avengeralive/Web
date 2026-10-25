<style>
    .link_wait_place {
        width: 140px;
    }  
    .stats.active {
        width: 175px;
        font-size: 17px;
        margin-top: 14px;
    }
            div.preview{
                display: inline;
                padding-left:10px;
            }
            div.preview:hover img.preview{
                display: block;
            }

            div.preview img.preview{
                display: none;
                max-width: 250px;
                position: absolute;
            }    
</style>

<?php
// Подключаем дополнительные функции для работы статистики
// Connect additional functions for statistics
include './includes/stats/index.php';  

$statsManager = new Stats_Manager(DB::getInstance());
$statsManager->byUserId = $user_id;
$getRequest = new Request($_GET);

if(isset($getRequest->date) and $getRequest->date != 0 and $getRequest->date != ''){
    $dd = explode(' - ', $getRequest->date);
}else{
    $dd = array(0=>date('d.m.Y', (time() - 60*60*24*6)),1=>date('d.m.Y', time()));
}
    
    $dat1 = $dd[0];
    $dat2 = $dd[1];
    $statsManager->dat1 = date( 'Y-m-d', strtotime( $dat1 ) );
    $statsManager->dat2 = date( 'Y-m-d', strtotime( $dat2 ) );    
    $statsManager->tdat1 = date( 'Ymd', strtotime( $dat1 ) );
    $statsManager->tdat2 = date( 'Ymd', strtotime( $dat2 ) ); 

function build_pagination_url($page = 1) {
    $parameters = array(
        'date' => ( isset($_GET['date']) ) ? $_GET['date'] : '',
        'offer' => ( isset($_GET['offer']) ) ? $_GET['offer'] : '',
        'webmaster' => ( isset($_GET['webmaster']) ) ? $_GET['webmaster'] : '',
        'country' => ( isset($_GET['country']) ) ? $_GET['country'] : '',
        'landings' => ( isset($_GET['landings']) ) ? $_GET['landings'] : '',
        'prelandings' => ( isset($_GET['prelandings']) ) ? $_GET['prelandings'] : '',
        'type' => ( isset($_GET['type']) ) ? $_GET['type'] : '',
        'landings' => ( isset($_GET['landings']) ) ? $_GET['landings'] : '',
        'prelandings' => ( isset($_GET['prelandings']) ) ? $_GET['prelandings'] : '',
        'device' => (isset($_GET['device']) ? $_GET['device'] : '-1'),
    );
    return '?' . http_build_query($parameters);
}
$where = [];
    
?>

<script type="text/javascript" src="./templates/<?php echo $template; ?>/js/moment.min.js"></script>
<script src="./templates/<?php echo $template; ?>/js/range.js"></script>
<link rel="stylesheet" type="text/css" href="./templates/<?php echo $template; ?>/css/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="./templates/<?php echo $template; ?>/css/bootstrap.css" />
<script src="./templates/<?php echo $template; ?>/js/main.js"></script>

<h1><?php echo $loc['stats.php']['t01']; ?></h1>

<p>
	<!-- Блок с фильтром -->
	<!-- Block filter -->
<div style="position:relative;">
<div id="loader"><img src="./templates/<?php echo $template; ?>/img/2.gif" border="0" class=""></div>	
	<form class="js-ajax-filter" action="?" method="get" >
         
		<div class="v_odin_ryad" >
			<p>
				<span>
					<b><?php echo $loc['stats.php']['t02']; ?>&nbsp;</b>
					<input type="text" name="date" id="datepicker" style="text-align: center; width: 169px;" readonly />
				</span>
				<span>
					<b><?php echo $loc['stats.php']['t03']; ?>&nbsp;</b>
                                        <select class="width-auto" data-search-placeholder="Оффер" name="offer" style="text-align: left;">
                                            <option <?php if (!$getRequest->offer) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                            <?php
                                            $offers = new Offer;
                                            $offers_arr = $offers->getByAdmin();   
                                            if (is_array($offers_arr) && count($offers_arr) > 0) {
                                                foreach ($offers_arr as $offer){
                                                   echo '<option value="'.$offer['id'].'" ';
                                                    if ($getRequest->offer == $offer['id']) echo 'selected';
                                                   echo '>'.html_entity_decode($offer['name'], ENT_QUOTES, 'utf-8').'</option>';
                                                }                                    
                                            }
                                            ?>
                                        </select>   
				</span>
                        </p>    
                        <p>    
				<span>
					<b>Страна:&nbsp;</b>
                                        <select name="country" class="width-150" style="text-align: center;">
                                            <option <?php if (!$getRequest->country) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                            <?
                                            $countrys_arr = ['Россия'=>'RU','Украина'=>'UA','Беларусь'=>'BY','Казахстан'=>'KZ','Кыргызстан'=>'KG','Молдова'=>'MD','Армения'=>'AM','Грузия'=>'GE','Остальные'=>'all'];
                                            foreach ($countrys_arr as $k => $v) {
                                            ?>
                                            <option <?php if (isset($getRequest->country) && $getRequest->country == $v){echo ' selected ';} ?> value="<?=$v; ?>"><?=$k; ?></option>
                                            <?php
                                            }
                                            ?>                                        
                                        </select>                                        
				</span>   
                                <span>
                                        &nbsp;<b><?php echo $loc['zakaz.php']['t55']; ?>&nbsp;</b>
                                        <select  class="width-100" name="webmaster" style="height: 27px;">
                                                <option class="options" value="0"><?php echo $loc['zakaz.php']['t123']; ?></option>
                                                <?php
                                                $webmasters = get_users_admin();
                                                if ($webmasters!=null){
                                                    foreach($webmasters as $webmaster){
                                                        $webmaster_id=htmlentities($webmaster['user_id']);
                                                        echo '<option value="'.$webmaster_id.'" ';
                                                        if ((isset($_POST['webmaster']) && $_POST['webmaster'] == $webmaster_id) or isset($_GET['webmaster']) && $_GET['webmaster'] == $webmaster_id) echo 'selected';
                                                        echo '>'.$webmaster_id.'</option>';
                                                    }                                                   
                                                }
                                                ?>
                                        </select>
                                </span>        
                            
                            <b>Устройство: </b>
                            <select class="width-150" id="devicechange" name="device" style="text-align: left; height: 25px">
                                <option <?php if (isset($_GET['device']) && $_GET['device'] == -1) echo 'selected '; ?>  value="-1">Все</option>
                                <option <?php if (isset($_GET['device']) && $_GET['device'] == 0) echo 'selected '; ?> value="0">ПК</option>
                                <option <?php if (isset($_GET['device']) && $_GET['device'] == 1) echo 'selected '; ?> value="1">Мобильный</option>
                            </select>                               
			</p>

		</div>
            <input type="hidden" name="type" id="types" value="0">
            <input type="hidden" name="landings" id="landings" value="0">
            <input type="hidden" name="prelandings" id="prelandings" value="0">
	</form>
	<!-- Конец блока с фильтром -->
	<!-- End unit with filter -->
	<p class="clear"></p>
                              
        
</p>

<div id="js-ajax-content">

    <form class="js-ajax-filter2" action="?" method="get">
                            <?php
                            foreach ($_GET as $k => $v) {
                                if (in_array($k, array('landings', 'prelandings'))) {
                                    continue;
                                }
                                echo "<input type=hidden name='" . htmlentities($k, ENT_QUOTES) . "' value='" . htmlentities($v, ENT_QUOTES) . "' />" . PHP_EOL;
                            }
                            ?>                            
                            
                            <b>Лендинг:&nbsp;</b>
                            <select id="landchange" name="landings" style="text-align: left; width: 300px; height: 25px;">
                                <?php
                                if(isset($getRequest->offer) && $getRequest->offer != 0){
                                ?>
                                <option <?php if (!$_GET['landings']) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                <?php
                                    $offer = Offer::getById(htmlentities($getRequest->offer));
                                    $landings = $offer->getLandings();
                                    if (is_array($landings) && count($landings) > 0) {                            
                                        foreach($landings as $landing){
                                            echo '<option value="'.$landing->id.'" ';
                                            if ($_GET['landings'] == $landing->id) echo 'selected';
                                            echo '>'.$landing->name.'</option>';
                                        }
                                    }
                                }else{
                                    echo '<option value="">Выберите оффер</option>';
                                }
                                ?>
                            </select>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>Прелендинг:&nbsp;</b>
                            <select id="prelandchange" name="prelandings" style="text-align: left; width: 300px; height: 25px;">
                                <?php
                                if(isset($getRequest->offer) && $getRequest->offer != 0){
                                ?>
                                <option <?php if (!$_GET['prelandings']) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                <?php
                                    $prelandings = $offer->getPrelandings();
                                    if (is_array($prelandings) && count($prelandings) > 0) {                            
                                        foreach($prelandings as $landing){
                                            echo '<option value="'.$landing->id.'" ';
                                            if ($_GET['prelandings'] == $landing->id) echo 'selected';
                                            echo '>'.$landing->name.'</option>';
                                        }
                                    }
                                }else{
                                    echo '<option value="">Выберите оффер</option>';
                                }                    
                                ?>
                            </select>            
                        </form>	     
    
    
<a style="text-align:center;float:right;margin-top: -20px;" href="./stats.php"><button style="font-size: 14px;" class="others_button_sohranit"><?php echo $loc['stats.php']['t08']; ?></button></a>    
<div class="clear"></div>   

        <div class="">
            <div style="width: 110px;" class="link_wait_place stats  <?php if (!isset($getRequest->type) or $getRequest->type == 0) echo "active"; ?> navigation-page"><a class="viewstats" data-type="0" href="<?php echo build_pagination_url(1); ?>&type=0">По дням</a></div>
            <div style="width: 130px;" class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 1) echo "active"; ?> navigation-page"><a class="viewstats" data-type="1" href="<?php echo build_pagination_url(1); ?>&type=1">По офферам</a></div>
            <div style="width: 110px;" class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 3) echo "active"; ?> navigation-page"><a class="viewstats" data-type="3" href="<?php echo build_pagination_url(1); ?>&type=3">По странам</a></div>
            <div class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 4) echo "active"; ?> navigation-page"><a class="viewstats" data-type="3" href="<?php echo build_pagination_url(1); ?>&type=4">По вебмастерам</a></div>
            <div style="width: 120px;" class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 5) echo "active"; ?> navigation-page"><a class="viewstats" data-type="5" href="<?php echo build_pagination_url(1); ?>&type=5">По лендингам</a></div>
            <div style="width: 140px;" class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 6) echo "active"; ?> navigation-page"><a class="viewstats" data-type="6" href="<?php echo build_pagination_url(1); ?>&type=6">По прелендингам</a></div>
            <div style="width: 140px;" class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 7) echo "active"; ?> navigation-page"><a class="viewstats" data-type="7" href="<?php echo build_pagination_url(1); ?>&type=7">По устройствам</a></div>
            <div style="width: 130px;" class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 8) echo "active"; ?> navigation-page"><a class="viewstats" data-type="8" href="<?php echo build_pagination_url(1); ?>&type=8">По источникам</a></div>        
        </div>
        <div class="clear"></div>		

	<table class="stats_table" id="stats_table" width="100%">
		<tr class="tableHead">
                        <td id="titleTable" colspan="<?php if(isset($getRequest->type) && $getRequest->type == 2){echo 25;}else{echo 25;} ?>"><?php echo $loc['stats.php']['t09']; ?></td>
		</tr>		
		<tr style="background: #e1ecf5;">
                        <td id="emptTd">&nbsp;</td>
			<td colspan="2"><?php echo $loc['stats.php']['t10']; ?></td>
			<td colspan="5"><?php echo $loc['stats.php']['t11']; ?></td>
			<td colspan="4">Комиссия CPA-сети</td>
			<td colspan="3"><?php echo $loc['stats.php']['t13']; ?></td>
                        <td colspan="3">Комиссии (холд+апрув)</td>
		</tr>	
 
		<tr id="tablesorts" style="font-weight: bold; background: #e1ecf5;">
                    <?php
                    if (!isset($getRequest->type) or $getRequest->type == 0){                   
                    ?>
                    <td id="nameType" title="<?php echo $loc['stats.php']['t63']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_dates=<?php if (isset($getRequest->sort_dates) && $getRequest->sort_dates == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t14']; ?></a></nobr></td>
                    <?php
                    }elseif(isset($getRequest->type) && $getRequest->type == 1){                   
                    ?>  
                    <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr><?php echo $loc['offers.php']['t03']; ?></nobr></td>
                    <?php
                    }elseif(isset($getRequest->type) && $getRequest->type == 4){                   
                    ?>  
                    <td id="nameType" title="Страна"><nobr>Вебмастер</nobr></td>
                    <?php
                    }elseif(isset($getRequest->type) && $getRequest->type == 3){                   
                    ?>  
                    <td id="nameType" title="Страна"><nobr>Страна</nobr></td>
                    <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 5) {
            ?>  
            <td id="nameType" title="Поток"><nobr>Лендинг</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 6) {
            ?>  
            <td id="nameType" title="Поток"><nobr>Прелендинг</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 7) {
            ?>  
            <td id="nameType" title="Устройство"><nobr>Устройство</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 8) {
            ?>  
            <td id="nameType" title="Реферер"><nobr>Реферер</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 9) {
            ?>  
            <td id="nameType" title="Реферер"><nobr>По часам</nobr></td>
            <?php
        }
                    
                    ?>
                    <td style="width: 75px;" title="<?php echo $loc['stats.php']['t64']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_click=<?php if (isset($getRequest->sort_click) && $getRequest->sort_click == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t15']; ?></a></nobr></td>
                    <td style="width: 75px;" title="<?php echo $loc['stats.php']['t65']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_hosts=<?php if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t16']; ?></a></nobr></td>
                    <td style="width: 75px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_zakaz_wait=<?php if (isset($getRequest->sort_zakaz_wait) && $getRequest->sort_zakaz_wait == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/wait.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t68']; ?>"></a></td>
                    <td style="width: 75px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_zakaz_all=<?php if (isset($getRequest->sort_zakaz_all) && $getRequest->sort_zakaz_all == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/accept.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t66']; ?>"></a></td>
                    <td style="width: 75px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_zakaz_cancel=<?php if (isset($getRequest->sort_zakaz_cancel) && $getRequest->sort_zakaz_cancel == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/deny.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t69']; ?>"></a></td>
                    <td style="width: 75px;">&sum;</td>
                    <td style="width: 75px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_zakaz_trash=<?php if (isset($getRequest->sort_zakaz_trash) && $getRequest->sort_zakaz_trash == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/trash.png" width="25px" border="0" title="<?php echo $loc['stats.php']['r1']; ?>"></a></td>	
                    <td style="width: 100px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_comission_wait=<?php if (isset($getRequest->sort_comission_wait) && $getRequest->sort_comission_wait == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/wait.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t68']; ?>"></a></td>
                    <td style="width: 100px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_comission_all=<?php if (isset($getRequest->sort_comission_all) && $getRequest->sort_comission_all == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/accept.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t70']; ?>"></a></td>
                    <td style="width: 100px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_comission_cancel=<?php if (isset($getRequest->sort_comission_cancel) && $getRequest->sort_comission_cancel == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/deny.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t73']; ?>"></a></td>	
                    <td style="width: 100px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_comission_trash=<?php if (isset($getRequest->sort_comission_trash) && $getRequest->sort_comission_trash == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/trash.png" width="25px" border="0" title="<?php echo $loc['stats.php']['r1']; ?>"></a></td>				
                    <td style="width: 75px;" title="<?php echo $loc['stats.php']['t21']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_cr=<?php if (isset($getRequest->sort_cr) && $getRequest->sort_cr == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t23']; ?></a></nobr></td>
                    <td style="width: 75px;" title="<?php echo $loc['stats.php']['t22']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_epc=<?php if (isset($getRequest->sort_epc) && $getRequest->sort_epc == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t24']; ?></a></nobr></td>
                    <td style="width: 90px;" title="<?php echo $loc['stats.php']['t83']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_approove=<?php if (isset($getRequest->sort_approove) && $getRequest->sort_approove == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t74']; ?></a></nobr></td>
                    <td style="width: 90px;" title="Ком. Вебов"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_prof_web=<?php if (isset($getRequest->sort_prof_web) && $getRequest->sort_prof_web == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Ком. Вебов</a></nobr></td>
                    <td style="width: 90px;" title="Ком. CPA+Веб"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_prof_all=<?php if (isset($getRequest->sort_prof_all) && $getRequest->sort_prof_all == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Ком. CPA+Веб</a></nobr></td>
                </tr> 

<?php

        $where = array();
        if (isset($getRequest->webmaster) && $getRequest->webmaster != 0 && $getRequest->webmaster != '' && ($user_tip == 70 or $user_tip == 80)) {
            $where[] = ['where' => '`user_id`','type' => '=', 'values' => "'".htmlentities($getRequest->webmaster)."'"];
        } 
        if (isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != '') {
            $where[] = ['where' => '`offer_id`','type' => '=', 'values' => "'".htmlentities($getRequest->offer)."'"];
        }   
        if (!empty($_GET['landings'])) {
            $where[] = ['where' => '`landing_id`', 'type' => '=', 'values' => "'" . htmlentities($_GET['landings']) . "'"];
        }
        if (!empty($_GET['prelandings'])) {
            $where[] = ['where' => '`prelanding_id`', 'type' => '=', 'values' => "'" . htmlentities($_GET['prelandings']) . "'"];
        }
        if (isset($_GET['device'])) {
            $mob = intval($_GET['device']);
            if ($mob > -1) {
                $where[] = ['where' => '`mobile`', 'type' => '=', 'values' => "'" . $mob . "'"];
            }
        }        
        if (isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != '') {
            $where[] = ['where' => '`offer_id`','type' => '=', 'values' => "'".htmlentities($getRequest->offer)."'"];
        }         
        if (!empty($_GET['landings'])) {
            $where[] = ['where' => '`landing_id`','type' => '=', 'values' => "'".htmlentities($_GET['landings'])."'"];
        } 
        if (!empty($_GET['prelandings'])) {
            $where[] = ['where' => '`prelanding_id`','type' => '=', 'values' => "'".htmlentities($_GET['prelandings'])."'"];
        }                       
        if(isset($getRequest->country) && $getRequest->country != 'all' && $getRequest->country !='0'){
            $where[] = ['where' => '`short_country`','type' => '=', 'values' => "'".htmlentities($getRequest->country)."'"];
        }elseif(isset($getRequest->country) && $getRequest->country == 'all'){
            $where[] = ['where' => '`short_country`','type' => 'NOT IN', 'values' => "('RU','UA','BY','KZ','KG','MD','AM','GE')"];
        }

    $statsManager->byDate =  htmlentities($statsManager->dat1)." ".$DT."' AND '".htmlentities($statsManager->dat2).' '.$NT;   
  
    
    /////
    /////   СОРТИРОВКА
    /////
    
    if (isset($getRequest->sort_dates) && $getRequest->sort_dates != '') {
        $statsManager->sortBy('date_s', htmlentities($getRequest->sort_dates));
    } 
    
    if (isset($getRequest->sort_click) && $getRequest->sort_click != '') {
        $statsManager->sortBy('clicks', htmlentities($getRequest->sort_click));
    }  
        if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts != '') {
        $statsManager->sortBy('hosts', htmlentities($getRequest->sort_hosts));
    }  
        if (isset($getRequest->sort_zakaz_wait) && $getRequest->sort_zakaz_wait != '') {
        $statsManager->sortBy('zakaz_wait', htmlentities($getRequest->sort_zakaz_wait));
    }  
        if (isset($getRequest->sort_zakaz_all) && $getRequest->sort_zakaz_all != '') {
        $statsManager->sortBy('zakaz_all', htmlentities($getRequest->sort_zakaz_all));
    }  
        if (isset($getRequest->sort_zakaz_cancel) && $getRequest->sort_zakaz_cancel != '') {
        $statsManager->sortBy('zakaz_cancel', htmlentities($getRequest->sort_zakaz_cancel));
    }  
        if (isset($getRequest->sort_zakaz_trash) && $getRequest->sort_zakaz_trash != '') {
        $statsManager->sortBy('zakaz_trash', htmlentities($getRequest->sort_zakaz_trash));
    }  
        if (isset($getRequest->sort_comission_wait) && $getRequest->sort_comission_wait != '') {
        $statsManager->sortBy('comission_wait', htmlentities($getRequest->sort_comission_wait));
    }  
        if (isset($getRequest->sort_comission_all) && $getRequest->sort_comission_all != '') {
        $statsManager->sortBy('comission_all', htmlentities($getRequest->sort_comission_all));
    }
        if (isset($getRequest->sort_comission_cancel) && $getRequest->sort_comission_cancel != '') {
        $statsManager->sortBy('comission_cancel', htmlentities($getRequest->sort_comission_cancel));
    }
        if (isset($getRequest->sort_comission_trash) && $getRequest->sort_comission_trash != '') {
        $statsManager->sortBy('comission_trash', htmlentities($getRequest->sort_comission_trash));
    }
        if (isset($getRequest->sort_cr) && $getRequest->sort_cr != '') {
        $statsManager->sortBy('cr', htmlentities($getRequest->sort_cr));
    }
        if (isset($getRequest->sort_epc) && $getRequest->sort_epc != '') {
        $statsManager->sortBy('epc', htmlentities($getRequest->sort_epc));
    } 
        if (isset($getRequest->sort_approove) && $getRequest->sort_approove != '') {
        $statsManager->sortBy('approove', htmlentities($getRequest->sort_approove));
    }
        if (isset($getRequest->sort_prof_web) && $getRequest->sort_prof_web != '') {
        $statsManager->sortBy('profit_web', htmlentities($getRequest->sort_prof_web));
    }        
        if (isset($getRequest->sort_prof_all) && $getRequest->sort_prof_all != '') {
        $statsManager->sortBy('profit_cpa', htmlentities($getRequest->sort_prof_all));
    }     
    if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {
        if($getRequest->type == 1){
            $result = $statsManager->getByOffers($where,70);
        }elseif($getRequest->type == 3){
            $result = $statsManager->getByCountrys($where,70);
        }
        elseif($getRequest->type == 4){
            $result = $statsManager->getByWebmasters($where,70);
        } elseif ($getRequest->type == 5) {
            $result = $statsManager->getByLandings($where, 70);
        } elseif ($getRequest->type == 6) {
            $result = $statsManager->getByPrelandings($where, 70);
        } elseif ($getRequest->type == 7) {
            $result = $statsManager->getByDevices($where, 70);
        } elseif ($getRequest->type == 8) {
            $result = $statsManager->getByReferer($where, 70);
        } elseif ($getRequest->type == 9) {
            $result = $statsManager->getByHours($where, 70);
        }
    }else{
        $result = $statsManager->getByDates($where,70);
    }
            $cvet = 0;
                    $hosts_all = 0;
                    $clicks_all = 0;
                    $zakaz_ok_alls = 0;	
                    $zakaz_sum = 0;
                    $zakaz_wait_all = 0;
                    $zakaz_cancel_all = 0;
                    $zakaz_trash_all = 0;
                    $comission_ok_alls = 0;		
                    $comission_wait_all = 0;	
                    $comission_cancel_all = 0;	
                    $comission_trash_all = 0;    
                    $profit_web_all = 0;  
                    $profit_cpa_all = 0;  
            
            if (is_array($result) && count($result) > 0) {
                foreach ($result as $d => $res) { 
                    $clicks_all+=$res['clicks'];
                    $hosts_all+=$res['hosts'];
                    
                    $zakaz_wait_all+=$res['zakaz_wait'];
                    $zakaz_ok_alls+=$res['zakaz_all'];
                    $zakaz_cancel_all+=$res['zakaz_cancel'];
                    $zakaz_trash_all+=$res['zakaz_trash'];
                    $zakaz_sum+=$res['zakaz_all'] + $res['zakaz_cancel'] + $res['zakaz_wait'];
                    $comission_ok_alls+=$res['comission_all'];
                    $comission_wait_all+=$res['comission_wait'];
                    $comission_cancel_all+=$res['comission_cancel'];
                    $comission_trash_all+=$res['comission_trash'];         
                    $profit_web_all+=$res['profit_web'];          
                    $profit_cpa_all+=$res['profit_cpa'];          
                    
                    $url_zakaz = '';
                    $url_zakaz_wait = '';
                    $url_zakaz_all = '';
                    $url_zakaz_cancel = '';
                    $url_zakaz_trash = '';
                    if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type) ) {
                            $date_zakaz1 = $dat1;
                            $date_zakaz2 = $dat2;
                    }else{
                        $date_zakaz = explode("-", $res['date']);
                        $date_zakaz1 = $date_zakaz[2].'.'.$date_zakaz[1].'.'.$date_zakaz[0];
                        $date_zakaz2 = $date_zakaz[2].'.'.$date_zakaz[1].'.'.$date_zakaz[0];
                    }            
                    $urla = '<a target="_blank" href="/zakaz.php?date1='.$date_zakaz1.'&date2='.$date_zakaz2;
                    if($res['zakaz_wait'] != 0){$url_zakaz_wait = $urla.'&status=1';}
                    if($res['zakaz_all'] != 0){$url_zakaz_all = $urla.'&status=2';} 
                    if($res['zakaz_cancel'] != 0){$url_zakaz_cancel = $urla.'&status=0';} 
                    if($res['zakaz_trash'] != 0){$url_zakaz_trash = $urla.'&status=5';}    

                    if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type) ) {
                        
                        if($getRequest->type == 1){
                            $url_zakaz .= '&offer='.$res['offer_id'];
                        }elseif($getRequest->type == 3){
                            if (isset($res['country_iso']) && $res['country_iso'] != ''){$url_zakaz .= '&country='.$res['country_iso'];}
                        }                        
                        
                    }
                    
                    if(isset($getRequest->webmaster) && $getRequest->webmaster != 0 && $getRequest->webmaster != ''){$url_zakaz .= '&webmaster='.$getRequest->webmaster;}
                    if(isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != ''){$url_zakaz .= '&offer='.$getRequest->offer;}
                    if(!empty($_GET['landings'])){$url_zakaz .= '&landing_id='.htmlentities($_GET['landings']);}
                    if(!empty($_GET['prelandings'])){$url_zakaz .= '&prelanding_id='.htmlentities($_GET['prelandings']);}
                    if (isset($getRequest->subid1) && $getRequest->subid1 != ''){$url_zakaz .= '&subid1='.$getRequest->subid1;}
                    if (isset($getRequest->subid2) && $getRequest->subid2 != ''){$url_zakaz .= '&subid2='.$getRequest->subid2;}
                    if (isset($getRequest->subid3) && $getRequest->subid3 != ''){$url_zakaz .= '&subid3='.$getRequest->subid3;}
                    if (isset($getRequest->subid4) && $getRequest->subid4 != ''){$url_zakaz .= '&subid4='.$getRequest->subid4;}
                    if (isset($getRequest->subid5) && $getRequest->subid5 != ''){$url_zakaz .= '&subid5='.$getRequest->subid5;}
                    if(isset($getRequest->country) && $getRequest->country != 'all' && $getRequest->country !='0'){$url_zakaz .= '&country='.$getRequest->country;}
                    $url_zakaz .= '&count=100&submit=Вывести&page=1';

                    if($url_zakaz_wait != ''){$url_zakaz_wait .= $url_zakaz.'">'.$res['zakaz_wait'].'</a>';}else{$url_zakaz_wait = $res['zakaz_wait'];}
                    if($url_zakaz_all != ''){$url_zakaz_all .= $url_zakaz.'">'.$res['zakaz_all'].'</a>';}else{$url_zakaz_all = $res['zakaz_all'];}
                    if($url_zakaz_cancel != ''){$url_zakaz_cancel .= $url_zakaz.'">'.$res['zakaz_cancel'].'</a>';}else{$url_zakaz_cancel = $res['zakaz_cancel'];}
                    if($url_zakaz_trash != ''){$url_zakaz_trash .= $url_zakaz.'">'.$res['zakaz_trash'].'</a>';}else{$url_zakaz_trash = $res['zakaz_trash'];}
                    $url_zakaz_sum = $res['zakaz_wait'] + $res['zakaz_all'] + $res['zakaz_cancel'];
                    
                    
                    ?> 

                    <tr class="<?php if ( $cvet & 1 ) {echo 'col2';} $cvet++;?>">
                        <?php
                        if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {
                            if($getRequest->type == 1){
                                ?>
                                <td><nobr><?=$res['name']; ?></nobr></td>
                                <?php
                            }elseif($getRequest->type == 3){
                                ?>
                                <td><nobr><?=$res['short_country']; ?></nobr></td>    
                                <?php 
                            }
                            elseif($getRequest->type == 4){
                                ?>
       
                                <td><nobr><?=$res['webmaster']; ?></nobr></td>    
                                <?php 
                                } elseif ($getRequest->type == 5) {
                                    if($res['land']['name'] == ''){$land_view = 'Без прелендинга';}else{$land_view = $res['land']['name'];}
                                    if($res['land']['url'] == ''){$landing_url = '';}else{$landing_url = $res['land']['url'];}
                                    ?>
                                    <td><nobr><?= $land_view; ?> (<?=$res['land']['offer']; ?>)
                                    <?
                                        if( file_exists(dirname(__FILE__).'/../../../../images/screens/'.md5($landing_url).'.jpg')){
                                            echo "<div class=preview><img class=ico width=16 src=/images/eye.ico><img class=preview src=/images/screens/".md5($landing_url).".jpg></div>";
                                        }
                                    ?>                         
                                    </nobr></td>    
                                    <?php
                                } elseif ($getRequest->type == 6) {
                                    if($res['preland'] == ''){$preland_view = 'Без прелендинга';}else{$preland_view = $res['preland'];}
                                    ?>
                                    <td><nobr><?= $preland_view; ?></nobr></td>    
                                    <?php
                                } elseif ($getRequest->type == 7) {
                                    ?>
                                    <td><nobr><?= $res['mobile']; ?></nobr></td>    
                                    <?php
                                } elseif ($getRequest->type == 8) {
                                    if($res['refhost'] == ''){$ref_view = 'Без источника';}else{$ref_view = $res['refhost'];}
                                    ?>
                                    <td><nobr><?= $ref_view; ?></nobr></td>    
                                    <?php
                                } elseif ($getRequest->type == 9) {
                                    ?>
                                    <td><nobr><?= $res['date']; ?>:00:00 - <?php echo $res['date']; ?>:59:59</nobr></td>    
                                    <?php
                                }
                        }else{
                            ?>
                             <td><nobr><?=$res['date']; ?></nobr></td>
                            <?php
                        }                        
                        ?>                         
                        
        
                        <td><nobr><?=$res['clicks']; ?></nobr></td>
                        <td><nobr><?=$res['hosts']; ?></nobr></td>
                        <td><nobr><?=$url_zakaz_wait; ?></nobr></td>
                        <td><nobr><?=$url_zakaz_all; ?></nobr></td>
                        <td><nobr><?=$url_zakaz_cancel; ?></nobr></td>
                        <td><nobr><?= $url_zakaz_sum; ?></nobr></td>
                        <td><nobr><?=$url_zakaz_trash; ?></nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_wait']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_all']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_cancel']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_trash']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?php if(!empty($res['cr'])){echo round($res['cr'], 2);}else{echo 0;} ?></nobr></td>
                        <td><nobr><?php if(!empty($res['epc'])){echo round($res['epc'], 2);}else{echo 0;} ?></nobr></td>
                        <td><nobr><?php if(!empty($res['approove'])){echo round($res['approove'], 2);}else{echo 0;} ?></nobr></td>
                        <td><nobr><?php if(!empty($res['profit_web'])){echo $res['profit_web'];}else{ echo 0;} ?> р.</nobr></td>
                        <td><nobr><?php if(!empty($res['profit_cpa'])){echo $res['profit_cpa'];}else{ echo 0;} ?> р.</nobr></td>        
                    </tr>                 

                    <?php         
                }

            }else{
                ?>
                    <tr height="80" class="<?php if ( $cvet & 1 ) {echo 'col2';} $cvet++;?>">
                        <td colspan="17"> Нет результатов по выбранным параметрам.</td>
                    </tr>  
                <?php
            }  
?>
                <tr class="statstr" height="10px"><td colspan="17"></td></tr>

		<tr style="background: #e1ecf5;">
			<td style="width: 75px;" <?php if(isset($getRequest->type) && $getRequest->type == 2 && (!isset($getRequest->subidS) or $getRequest->subidS == 0)){echo 'colspan="5"';}?>><nobr><b><?php echo $loc['stats.php']['t27']; ?></b></nobr></td>
			<td style="width: 66px;"><nobr><?php echo $clicks_all; ?></nobr></td>
			<td style="width: 66px;"><nobr><?php echo $hosts_all; ?></nobr></td>
			<td style="width: 60px;"><nobr><?php echo $zakaz_wait_all; ?></nobr></td>
			<td style="width: 60px;"><nobr><?php echo $zakaz_ok_alls; ?></nobr></td>
			<td style="width: 60px;"><nobr><?php echo $zakaz_cancel_all; ?></nobr></td>
                        <td style="width: 60px;"><nobr><?php echo $zakaz_sum; ?></nobr></td>
                        <td style="width: 60px;"><nobr><?php echo $zakaz_trash_all; ?></nobr></td>
			<td style="width: 90px;"><nobr><?php echo sprintf("%.2f",$comission_wait_all); ?>&nbsp;<?php echo $loc['stats.php']['t26']; ?>&nbsp;</nobr></td>
			<td style="width: 90px;"><nobr><?php echo sprintf("%.2f",$comission_ok_alls); ?>&nbsp;<?php echo $loc['stats.php']['t26']; ?>&nbsp;</nobr></td>
			<td style="width: 90px;"><nobr><?php echo sprintf("%.2f",$comission_cancel_all); ?>&nbsp;<?php echo $loc['stats.php']['t26']; ?>&nbsp;</nobr></td>
                        <td style="width: 90px;"><nobr><?php echo sprintf("%.2f",$comission_trash_all); ?>&nbsp;<?php echo $loc['stats.php']['t26']; ?>&nbsp;</nobr></td>
			<td style="width: 50px;"><nobr><?php if ($hosts_all!='0'){echo round((($zakaz_ok_alls+$zakaz_cancel_all+$zakaz_wait_all+$zakaz_trash_all)/$hosts_all) * 100, 2);} else {echo '0';}?></nobr></td>
			<td style="width: 50px;"><nobr><?php if ($hosts_all!='0'){echo round(($comission_ok_alls)/$hosts_all, 2);} else {echo '0';}?></nobr></td>		
			<td style="width: 90px;"><nobr>
			<?php 
			if ($hosts_all!='0'){
                            $kolvo_zakaz_all=$zakaz_wait_all+$zakaz_ok_alls+$zakaz_cancel_all;
                            if ($kolvo_zakaz_all!='0') {echo round($approve_all=100/$kolvo_zakaz_all*($zakaz_ok_alls), 2);} else {echo '0';}
			}else{
                            echo '0';
			} 
			?>			
			</nobr></td>
                        <td style="width: 66px;"><nobr><?php echo $profit_web_all; ?> р.</nobr></td>
                        <td style="width: 66px;"><nobr><?php echo $profit_cpa_all; ?> р.</nobr></td>
		</tr>  		
        </table>
	
</div>	
</div>

<?php
include ('./templates/'.$template.'/checkform/datepicker_addscript_10.php');
?>
<br><Br><BR><BR><br><Br><BR><BR>
