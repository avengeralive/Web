
<?php
// Подключаем дополнительные функции для работы статистики
// Connect additional functions for statistics
include './includes/stats/index_10.php';  

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
        'country' => ( isset($_GET['country']) ) ? $_GET['country'] : '',
        'landings' => ( isset($_GET['landings']) ) ? $_GET['landings'] : '',
        'prelandings' => ( isset($_GET['prelandings']) ) ? $_GET['prelandings'] : '',
        'subidS' => ( isset($_GET['subidS']) ) ? $_GET['subidS'] : '',
        'subid1' => ( isset($_GET['subid1']) ) ? $_GET['subid1'] : '',
        'subid2' => ( isset($_GET['subid2']) ) ? $_GET['subid2'] : '',
        'subid3' => ( isset($_GET['subid3']) ) ? $_GET['subid3'] : '',
        'type' => ( isset($_GET['type']) ) ? $_GET['type'] : ''
    );
    return '?' . http_build_query($parameters);
}
    
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
					<input type="text" name="date" id="datepicker" style="text-align: center; width: 169px; height: 18px;" readonly />
				</span>
				<span>
					<b><?php echo $loc['stats.php']['t03']; ?>&nbsp;</b>
                                        <select name="offer" style="text-align: left; width: 300px; height: 25px;">
                                            <option <?php if (!$getRequest->offer) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                            <?php
						// Получаем и выводим список офферов
						// Get and display a list of offers
						$offers = get_offers($user_id);
						if ($offers!=null)
							{
							foreach($offers as $offer)
								{
								$of_id=htmlentities($offer['id']);
								$of_name=htmlentities($offer['name']);
								echo '<option value="'.$of_id.'" ';
								if ($getRequest->offer == $of_id) echo 'selected';
								echo '>'.html_entity_decode($of_name, ENT_QUOTES, 'utf-8').'</option>';
								}
							}
                                            ?>
                                        </select>                                        
				</span>
				<span>
					<b>Страна:&nbsp;</b>
                                        <select name="country" style="text-align: left; height: 25px;text-align: center;">
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
			</p>
                        
			<div>

                            <input id="namesubid1" name="subid1" onkeyup="autocomplet(1);" type="text"  placeholder="<?php echo $loc['stats.php']['t05']; ?>" style="text-align: left; width: 200px;padding:0 3px; height: 25px;" autocomplete="off">
                            <ul id="namesubid1_list" class="listAutoComplete"></ul>

                            <input id="namesubid2" name="subid2" onkeyup="autocomplet(2);"  type="text" placeholder="<?php echo $loc['stats.php']['t06']; ?>" style="text-align: left; width: 200px;padding:0 3px; height: 25px;" autocomplete="off">
                            <ul id="namesubid2_list" class="listAutoComplete" style="margin-left: 216px;"></ul>				

                            <input id="namesubid3" name="subid3" onkeyup="autocomplet(3);" type="text" placeholder="<?php echo $loc['stats.php']['t07']; ?>" style="text-align: left; width: 200px;padding:0 3px; height: 25px;" autocomplete="off">
                            <ul id="namesubid3_list" class="listAutoComplete"  style="margin-left: 432px;"></ul>					
				
			</div>
		</div>
            <input type="hidden" name="type" id="types" value="0">
            <input type="hidden" name="landings" id="landings" value="0">
            <input type="hidden" name="prelandings" id="prelandings" value="0">
            <input type="hidden" name="subidS" id="subidS" value="0">
	</form>
	<!-- Конец блока с фильтром -->
	<!-- End unit with filter -->
	<p class="clear"></p>
                              
        
</p>

<div id="js-ajax-content">

                            <form class="js-ajax-filter2" action="?" method="get" style="margin:30px auto;">
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
                                <option <?php if (!$getRequest->prelanding) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                <?php
                                    $prelandings = $offer->getPrelandings();
                                    if (is_array($prelandings) && count($prelandings) > 0) {                            
                                        foreach($prelandings as $landing){
                                            echo '<option value="'.$landing->id.'" ';
                                            if ($getRequest->prelanding == $landing->id) echo 'selected';
                                            echo '>'.$landing->name.'</option>';
                                        }
                                    }
                                }else{
                                    echo '<option value="">Выберите оффер</option>';
                                }                    
                                ?>
                            </select>            
                        </form>	     
    
    
<p>		
        <div class="v_odin_ryad sorts">
           <div class="link_wait_place stats  <?php if (!isset($getRequest->type) or $getRequest->type == 0) echo "active"; ?> navigation-page"><a class="viewstats" data-type="0" href="<?php echo build_pagination_url(1); ?>&type=0">По дням</a></div>
           <div class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 1) echo "active"; ?> navigation-page"><a class="viewstats" data-type="1" href="<?php echo build_pagination_url(1); ?>&type=1">По офферам</a></div>
           <div class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 2) echo "active"; ?> navigation-page"><a class="viewstats" data-type="2" href="<?php echo build_pagination_url(1); ?>&type=2">По субаккаунтам</a></div>   
           <div class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 3) echo "active"; ?> navigation-page"><a class="viewstats" data-type="3" href="<?php echo build_pagination_url(1); ?>&type=5">По странам</a></div>
           <div class="link_wait_place stats  <?php if (isset($getRequest->type) && $getRequest->type == 4) echo "active"; ?> navigation-page"><a class="viewstats" data-type="4" href="<?php echo build_pagination_url(1); ?>&type=6">По потокам</a></div>
        </div>
        <div class="clear"></div>
        
        <div id="buttonsSort" style="margin:0px auto 25px; <?php if($getRequest->type != 2) {echo 'display:none;';}else{echo 'display:block;';} ?>" class="v_odin_ryad">
            <div class="link_wait_place statsSub allsub <?php if (!isset($getRequest->subidS) or $getRequest->subidS == 0){ echo "active";} ?>">
                <a class="viewstatsSub" data-sub="0" href="<?php echo build_pagination_url(1); ?>&subidS=0">Все SubId</a>
            </div>
            <div class="link_wait_place statsSub <?php if (!isset($getRequest->subidS) or $getRequest->subidS == 1){ echo "active";} ?>">
                <a class="viewstatsSub" data-sub="1" href="<?php echo build_pagination_url(1); ?>&subidS=1">SubId 1</a>
            </div>
            <div class="link_wait_place statsSub <?php if (!isset($getRequest->subidS) or $getRequest->subidS == 2){ echo "active";} ?>">
                <a class="viewstatsSub" data-sub="2" href="<?php echo build_pagination_url(1); ?>&subidS=2">SubId 2</a>
            </div>
            <div class="link_wait_place statsSub <?php if (!isset($getRequest->subidS) or $getRequest->subidS == 3){ echo "active";} ?>">
                <a class="viewstatsSub" data-sub="3" href="<?php echo build_pagination_url(1); ?>&subidS=3">SubId 3</a>
            </div>
        </div>	
       
    <a style="text-align:center;float:right;margin:20px 0;" href="./stats.php"><?php echo $loc['stats.php']['t08']; ?></a>
</p>		

<p>

	<table class="stats_table" id="stats_table" width="100%">
		<tr class="table_zagolovki">
                        <td id="titleTable" colspan="<?php if(isset($getRequest->type) && $getRequest->type == 2){echo 25;}else{echo 25;} ?>"><?php echo $loc['stats.php']['t09']; ?></td>
		</tr>		
		<tr style="background: #e1ecf5;">
                        <td id="emptTd" <?php if(isset($getRequest->type) && $getRequest->type == 2){echo 'colspan="3"';} ?>>&nbsp;</td>
			<td colspan="2"><?php echo $loc['stats.php']['t10']; ?></td>
			<td colspan="4"><?php echo $loc['stats.php']['t11']; ?></td>
			<td colspan="4"><?php echo $loc['stats.php']['t12']; ?></td>
			<td colspan="3"><?php echo $loc['stats.php']['t13']; ?></td>
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
                    }elseif(isset($getRequest->type) && $getRequest->type == 2 && (!isset($getRequest->subidS) or $getRequest->subidS == 0)){                          
                    ?>     
                    <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 1</nobr></td>
                    <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 2</nobr></td>
                    <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 3</nobr></td>
                    <?php    
                    }
                    if(isset($getRequest->subidS) && $getRequest->subidS == 1){
                    ?>
                    <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 1</nobr></td>
                    <?php    
                    }
                    if(isset($getRequest->subidS) && $getRequest->subidS == 2){
                    ?>
                    <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 2</nobr></td>    
                    <?php    
                    }
                    if(isset($getRequest->subidS) && $getRequest->subidS == 3){
                    ?>
                    <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 3</nobr></td>  
                    <?php
                    }
                    ?>       
                    <td style="width: 75px;" title="<?php echo $loc['stats.php']['t64']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_click=<?php if (isset($getRequest->sort_click) && $getRequest->sort_click == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t15']; ?></a></nobr></td>
                    <td style="width: 75px;" title="<?php echo $loc['stats.php']['t65']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_hosts=<?php if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t16']; ?></a></nobr></td>
                    <td style="width: 75px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_zakaz_wait=<?php if (isset($getRequest->sort_zakaz_wait) && $getRequest->sort_zakaz_wait == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/wait.gif" border="0" title="<?php echo $loc['stats.php']['t68']; ?>"></a></td>
                    <td style="width: 75px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_zakaz_all=<?php if (isset($getRequest->sort_zakaz_all) && $getRequest->sort_zakaz_all == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/accept.gif" border="0" title="<?php echo $loc['stats.php']['t66']; ?>"></a></td>
                    <td style="width: 75px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_zakaz_cancel=<?php if (isset($getRequest->sort_zakaz_cancel) && $getRequest->sort_zakaz_cancel == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/deny.gif" border="0" title="<?php echo $loc['stats.php']['t69']; ?>"></a></td>
                    <td style="width: 75px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_zakaz_trash=<?php if (isset($getRequest->sort_zakaz_trash) && $getRequest->sort_zakaz_trash == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/trash.png" border="0" title="<?php echo $loc['stats.php']['r1']; ?>"></a></td>	
                    <td style="width: 100px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_comission_wait=<?php if (isset($getRequest->sort_comission_wait) && $getRequest->sort_comission_wait == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/wait.gif" border="0" title="<?php echo $loc['stats.php']['t68']; ?>"></a></td>
                    <td style="width: 100px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_comission_all=<?php if (isset($getRequest->sort_comission_all) && $getRequest->sort_comission_all == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/accept.gif" border="0" title="<?php echo $loc['stats.php']['t70']; ?>"></a></td>
                    <td style="width: 100px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_comission_cancel=<?php if (isset($getRequest->sort_comission_cancel) && $getRequest->sort_comission_cancel == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/deny.gif" border="0" title="<?php echo $loc['stats.php']['t73']; ?>"></a></td>	
                    <td style="width: 100px;"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_comission_trash=<?php if (isset($getRequest->sort_comission_trash) && $getRequest->sort_comission_trash == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><img src="./templates/<?php echo $template; ?>/img/trash.png" border="0" title="<?php echo $loc['stats.php']['r1']; ?>"></a></td>				
                    <td style="width: 75px;" title="<?php echo $loc['stats.php']['t21']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_cr=<?php if (isset($getRequest->sort_cr) && $getRequest->sort_cr == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t23']; ?></a></nobr></td>
                    <td style="width: 75px;" title="<?php echo $loc['stats.php']['t22']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_epc=<?php if (isset($getRequest->sort_epc) && $getRequest->sort_epc == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t24']; ?></a></nobr></td>
                    <td style="width: 90px;" title="<?php echo $loc['stats.php']['t83']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_approove=<?php if (isset($getRequest->sort_approove) && $getRequest->sort_approove == 'desc'){echo 'asc';}else{echo 'desc';} ?>"><?php echo $loc['stats.php']['t74']; ?></a></nobr></td>
                </tr> 

<?php

    if(isset($getRequest->type) && $getRequest->type == 1){
        if (isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != '') {
            $statsManager->where('`id`', htmlentities($getRequest->offer));
        }
        if(!isset($getRequest->subid1) && !isset($getRequest->subid2) && !isset($getRequest->subid3)){
            $statsManager->subsId = '';
        }
        
        if(empty($_GET['landings'])){
            $statsManager->landing = '';
        }else{
            $statsManager->landing = " and `landing_id` = '". htmlentities($_GET['landings'])."'";
        }
        if(empty($_GET['prelandings'])){
            $statsManager->prelanding = '';
        }else{
             $statsManager->prelanding = " and `prelanding_id` = '". htmlentities($_GET['prelandings'])."'";
        }      
      
        if(empty($getRequest->country)){
            $statsManager->country = '';
        }elseif(isset($getRequest->country) && $getRequest->country != 'all'){
            $statsManager->country = " and `short_country` ='". htmlentities($getRequest->country)."'";
        }elseif(isset($getRequest->country) && $getRequest->country == 'all'){
            $statsManager->country = " and `short_country` not in ('RU','UA','BY','KZ','KG','MD','AM','GE')";
        }
        
        if (isset($getRequest->subid1) && $getRequest->subid1 != '') {
            $statsManager->subsId = " and `subid1` ='". htmlentities($getRequest->subid1)."'";
        }   
        if (isset($getRequest->subid2) && $getRequest->subid2 != '') {
            $statsManager->subsId = " and `subid2` ='". htmlentities($getRequest->subid2)."'";
        } 
        if (isset($getRequest->subid3) && $getRequest->subid3 != '') {
            $statsManager->subsId = " and `subid3` ='". htmlentities($getRequest->subid3)."'";
        } 
        $statsManager->dates =  " and `date` BETWEEN '". htmlentities($statsManager->dat1)." ".$DT."' AND '".htmlentities($statsManager->dat2)." ".$NT."'";        
    }elseif(isset($getRequest->type) && $getRequest->type == 2){
        $subs ='';
        $subs2 = '';
        if(!empty($getRequest->subidS) && $getRequest->subidS == 1){
            $subs .= 'subid1 as s1,';
            $subs2 .= ' and subid1 = s1';
            $statsManager->groupBy = 's1';
        }
        if(!empty($getRequest->subidS) && $getRequest->subidS == 2){
            $subs .= 'subid2 as s2,';
            $subs2 .= ' and subid2 = s2';
            $statsManager->groupBy = 's2';
        } 
        if(!empty($getRequest->subidS) && $getRequest->subidS == 3){
            $subs .= 'subid3 as s3,';
            $subs2 .= ' and subid3 = s3';
            $statsManager->groupBy = 's3';
        } 

        if (!isset($getRequest->subidS) or $getRequest->subidS == 0) {
            $statsManager->bySubs =  'subid1 as s1,subid2 as s2,subid3 as s3,';
            $statsManager->bySubs2 =  ' and subid1 = s1 and subid2 = s2 and subid3 = s3';
            $statsManager->groupBy = 's1,s2,s3';
        }else{
            $statsManager->bySubs = $subs;
            $statsManager->bySubs2 = $subs2;
        }
        
        if (isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != '') {
            $statsManager->where('`offer_id`', htmlentities($getRequest->offer));
        }   
        if (isset($getRequest->country) && !empty($getRequest->country)) {
            $statsManager->where('`short_country`', htmlentities($getRequest->country));
        } 
        if (!empty($_GET['landings'])) {
            $statsManager->where('`landing_id`', htmlentities($_GET['landings']));
        } 
        if (!empty($_GET['prelandings'])) {
            $statsManager->where('`prelanding_id`', htmlentities($_GET['prelandings']));
        }         
        if (isset($getRequest->subid1) && $getRequest->subid1 != '') {
            $statsManager->where('`subid1`', htmlentities($getRequest->subid1));
        }   
        if (isset($getRequest->subid2) && $getRequest->subid2 != '') {
            $statsManager->where('`subid2`', htmlentities($getRequest->subid2));
        } 
        if (isset($getRequest->subid3) && $getRequest->subid3 != '') {
            $statsManager->where('`subid3`', htmlentities($getRequest->subid3));
        }  
        
        $statsManager->byDate =  htmlentities($statsManager->dat1)." ".$DT."' AND '".htmlentities($statsManager->dat2).' '.$NT;        
    }else{
        if (isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != '') {
            $statsManager->where('`offer_id`', htmlentities($getRequest->offer));
        }   
        if (isset($getRequest->country) && !empty($getRequest->country)) {
            $statsManager->where('`short_country`', htmlentities($getRequest->country));
        } 
        if (!empty($_GET['landings'])) {
            $statsManager->where('`landing_id`', htmlentities($_GET['landings']));
        } 
        if (!empty($_GET['prelandings'])) {
            $statsManager->where('`prelanding_id`', htmlentities($_GET['prelandings']));
        }         
        if (isset($getRequest->subid1) && $getRequest->subid1 != '') {
            $statsManager->where('`subid1`', htmlentities($getRequest->subid1));
        }   
        if (isset($getRequest->subid2) && $getRequest->subid2 != '') {
            $statsManager->where('`subid2`', htmlentities($getRequest->subid2));
        } 
        if (isset($getRequest->subid3) && $getRequest->subid3 != '') {
            $statsManager->where('`subid3`', htmlentities($getRequest->subid3));
        }    
        $statsManager->byDate =  htmlentities($statsManager->dat1)." ".$DT."' AND '".htmlentities($statsManager->dat2).' '.$NT;        
    }

    
  
    
    /////
    /////   СОРТИРОВКА
    /////
    
    if (isset($getRequest->sort_dates) && $getRequest->sort_dates != '') {
        $statsManager->sortBy('d', htmlentities($getRequest->sort_dates));
    } 
    
    if (isset($getRequest->sort_click) && $getRequest->sort_click != '') {
        $statsManager->sortBy('clicks', htmlentities($getRequest->sort_click));
    }  
        if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts != '') {
        $statsManager->sortBy('host', htmlentities($getRequest->sort_hosts));
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
    
    
    
     
    //$statsManager->where('id', $getRequest->offer);
    if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {
        if($getRequest->type == 1){
            $result = $statsManager->getByOffers();
            $cvet = 0;
            if (is_array($result) && count($result) > 0) {
                foreach ($result as $d => $res) { 

                    ?> 

                    <tr class="<?php if ( $cvet & 1 ) {echo 'col2';} $cvet++;?>">
                        <td><nobr><?=$res['name']; ?></nobr></td>
                        <td><nobr><?=$res['clicks']; ?></nobr></td>
                        <td><nobr><?=$res['host']; ?></nobr></td>
                        <td><nobr><?=$res['zakaz_wait']; ?></nobr></td>
                        <td><nobr><?=$res['zakaz_all']; ?></nobr></td>
                        <td><nobr><?=$res['zakaz_cancel']; ?></nobr></td>
                        <td><nobr><?=$res['zakaz_trash']; ?></nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_wait']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_all']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_cancel']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_trash']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?php if(!empty($res['cr'])){echo round($res['cr'], 2);}else{echo 0;} ?></nobr></td>
                        <td><nobr><?php if(!empty($res['epc'])){echo round($res['epc'], 2);}else{echo 0;} ?></nobr></td>
                        <td><nobr><?php if(!empty($res['approove'])){echo round($res['approove'], 2);}else{echo 0;} ?></nobr></td>
                    </tr>                 

                    <?php         
                }
            }  
        }elseif($getRequest->type == 2){
            $result = $statsManager->getBySubsId();
            $cvet = 0;
            if (is_array($result) && count($result) > 0) {
                foreach ($result as $d => $res) { 

                    ?> 

                    <tr class="<?php if ( $cvet & 1 ) {echo 'col2';} $cvet++;?>">
                        <?php
                        if(!isset($getRequest->subidS) or $getRequest->subidS == 0){
                        ?> 
                        <td><nobr><?=$res['s1']; ?></nobr></td>
                        <td><nobr><?=$res['s2']; ?></nobr></td>
                        <td><nobr><?=$res['s3']; ?></nobr></td>                            
                        <?php    
                        }
                        if(isset($getRequest->subidS) && $getRequest->subidS == 1){
                        ?>
                        <td><nobr><?=$res['s1']; ?></nobr></td>    
                        <?php    
                        }
                        if(isset($getRequest->subidS) && $getRequest->subidS == 2){
                        ?>
                        <td><nobr><?=$res['s2']; ?></nobr></td>    
                        <?php    
                        }
                        if(isset($getRequest->subidS) && $getRequest->subidS == 3){
                        ?>
                        <td><nobr><?=$res['s3']; ?></nobr></td>    
                        <?php
                        }
                        ?>
                        <td><nobr><?=$res['clicks']; ?></nobr></td>
                        <td><nobr><?=$res['host']; ?></nobr></td>
                        <td><nobr><?=$res['zakaz_wait']; ?></nobr></td>
                        <td><nobr><?=$res['zakaz_all']; ?></nobr></td>
                        <td><nobr><?=$res['zakaz_cancel']; ?></nobr></td>
                        <td><nobr><?=$res['zakaz_trash']; ?></nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_wait']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_all']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_cancel']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?= sprintf("%.2f",$res['comission_trash']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                        <td><nobr><?php if(!empty($res['cr'])){echo round($res['cr'], 2);}else{echo 0;} ?></nobr></td>
                        <td><nobr><?php if(!empty($res['epc'])){echo round($res['epc'], 2);}else{echo 0;} ?></nobr></td>
                        <td><nobr><?php if(!empty($res['approove'])){echo round($res['approove'], 2);}else{echo 0;} ?></nobr></td>
                    </tr>                 

                    <?php         
                }
            }  
        }
    }else{   
        $result = $statsManager->getByDates();
        $cvet = 0;
        if (is_array($result) && count($result) > 0) {
            foreach ($result as $d => $res) { 
                       
?> 
     
                <tr class="<?php if ( $cvet & 1 ) {echo 'col2';} $cvet++;?>">
                    <td><nobr><?=$res['d']; ?></nobr></td>
                    <td><nobr><?=$res['clicks']; ?></nobr></td>
                    <td><nobr><?=$res['host']; ?></nobr></td>
                    <td><nobr><?=$res['zakaz_wait']; ?></nobr></td>
                    <td><nobr><?=$res['zakaz_all']; ?></nobr></td>
                    <td><nobr><?=$res['zakaz_cancel']; ?></nobr></td>
                    <td><nobr><?=$res['zakaz_trash']; ?></nobr></td>
                    <td><nobr><?= sprintf("%.2f",$res['comission_wait']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                    <td><nobr><?= sprintf("%.2f",$res['comission_all']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                    <td><nobr><?= sprintf("%.2f",$res['comission_cancel']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                    <td><nobr><?= sprintf("%.2f",$res['comission_trash']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                    <td><nobr><?php if(!empty($res['cr'])){echo round($res['cr'], 2);}else{echo 0;} ?></nobr></td>
                    <td><nobr><?php if(!empty($res['epc'])){echo round($res['epc'], 2);}else{echo 0;} ?></nobr></td>
                    <td><nobr><?php if(!empty($res['approove'])){echo round($res['approove'], 2);}else{echo 0;} ?></nobr></td>
                </tr>                 
                
<?php   
            }
        }else{
            ?>
                <tr height="80" class="<?php if ( $cvet & 1 ) {echo 'col2';} $cvet++;?>">
                    <td colspan="14"> Нет результатов по выбранным параметрам.</td>
                </tr>  
            <?php
        }
    }   
?>
  		
	</table>
	
</div>	
</div>
</p>

<?php
include ('./templates/'.$template.'/checkform/datepicker_addscript_10.php');
?>
