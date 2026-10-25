<script src="./templates/<?php echo $template; ?>/js/main.js"></script>
<div id="loader"><img src="./templates/<?php echo $template; ?>/img/2.gif" border="0" class=""></div>	
<p class="pageTitle"><span><?php echo $loc['utms.php']['t01']; ?></span></p>

<?php
$usersManager = new Users_Manager(DB::getInstance());
$getRequest = new Request($_GET);

function build_pagination_url($page = 1) {
    $parameters = array(
        'utm' => ( isset($_GET['utm']) ) ? $_GET['utm'] : ''
    );
    return '?' . http_build_query($parameters);
} 
?>

<style>
    a.type{
        margin-left: 20px;
    }
    a.type.active{
        color: #2d5ea3;

        border-bottom-style: solid;
        border-bottom-color: #2d5ea3;
    }
</style> 

<div id="js-ajax-content">

<div style="margin:30px 0;">              
    <p>
        <b><?php echo $loc['utms.php']['t02']; ?>&nbsp;</b>
        <a class="type <?php if (!isset($getRequest->utm) or $getRequest->utm == 'all') echo "active"; ?> viewstats" href="<?php echo build_pagination_url(1); ?>&utm=all"><?php echo $loc['offers.php']['filter_field_type_all']; ?></a>                 
        <a class="type <?php if (isset($getRequest->utm) && $getRequest->utm == 'utm_source') echo "active"; ?> viewstats" href="<?php echo build_pagination_url(1); ?>&utm=utm_source">utm source</a>
        <a class="type <?php if (isset($getRequest->utm) && $getRequest->utm == 'utm_medium') echo "active"; ?> viewstats" href="<?php echo build_pagination_url(1); ?>&utm=utm_medium">utm medium</a>
        <a class="type <?php if (isset($getRequest->utm) && $getRequest->utm == 'utm_campaign') echo "active"; ?> viewstats" href="<?php echo build_pagination_url(1); ?>&utm=utm_campaign">utm campaign</a>
        <a class="type <?php if (isset($getRequest->utm) && $getRequest->utm == 'utm_term') echo "active"; ?> viewstats" href="<?php echo build_pagination_url(1); ?>&utm=utm_term">utm term</a>
        <a class="type <?php if (isset($getRequest->utm) && $getRequest->utm == 'utm_content') echo "active"; ?> viewstats" href="<?php echo build_pagination_url(1); ?>&utm=utm_content">utm content</a>
    </p>                
</div>

<?php
$usersManager->limit('-1');
if (!isset($getRequest->utm) or $getRequest->utm == 'all'){
?>
<table class="stats_table" width="70%">
        <tr class="tableHead">
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_u1=<?php if (isset($getRequest->sort_u1) && $getRequest->sort_u1 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">source</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_u2=<?php if (isset($getRequest->sort_u2) && $getRequest->sort_u2 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">medium</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_u3=<?php if (isset($getRequest->sort_u3) && $getRequest->sort_u3 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">campaign</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_u4=<?php if (isset($getRequest->sort_u4) && $getRequest->sort_u4 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">term</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_u5=<?php if (isset($getRequest->sort_u5) && $getRequest->sort_u5 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">content</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_hosts=<?php if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Перех.</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_signups=<?php if (isset($getRequest->sort_signups) && $getRequest->sort_signups == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Рег.</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_clicks=<?php if (isset($getRequest->sort_clicks) && $getRequest->sort_clicks == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Кликов</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_orders=<?php if (isset($getRequest->sort_orders) && $getRequest->sort_orders == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Лидов</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_order1=<?php if (isset($getRequest->sort_order1) && $getRequest->sort_order1 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">1+</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_order10=<?php if (isset($getRequest->sort_order10) && $getRequest->sort_order10 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">10+</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_order100=<?php if (isset($getRequest->sort_order100) && $getRequest->sort_order100 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">100+</a></td>
            <td width="250px"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_profit=<?php if (isset($getRequest->sort_profit) && $getRequest->sort_profit == 'desc'){echo 'asc';}else{echo 'desc';} ?>">доход_CPA</a></td>
        </tr>
<?php
    $usersManager->u1 = 'utm_source';
    
    if (isset($getRequest->sort_u1) && $getRequest->sort_u1 != '') {
        $usersManager->sortBy('u_source', htmlentities($getRequest->sort_u1));
    }
    if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts != '') {
        $usersManager->sortBy('hosts', htmlentities($getRequest->sort_hosts));
    }
    if (isset($getRequest->sort_signups) && $getRequest->sort_signups != '') {
        $usersManager->sortBy('signups', htmlentities($getRequest->sort_signups));
    }
    if (isset($getRequest->sort_clicks) && $getRequest->sort_clicks != '') {
        $usersManager->sortBy('clicks', htmlentities($getRequest->sort_clicks));
    }
    if (isset($getRequest->sort_orders) && $getRequest->sort_orders != '') {
        $usersManager->sortBy('orders', htmlentities($getRequest->sort_orders));
    }    
    if (isset($getRequest->sort_order1) && $getRequest->sort_order1 != '') {
        $usersManager->sortBy('orders1', htmlentities($getRequest->sort_order1));
    }   
    if (isset($getRequest->sort_order10) && $getRequest->sort_order10 != '') {
        $usersManager->sortBy('orders10', htmlentities($getRequest->sort_order10));
    }   
    if (isset($getRequest->sort_order100) && $getRequest->sort_order100 != '') {
        $usersManager->sortBy('orders100', htmlentities($getRequest->sort_order100));
    }   
    if (isset($getRequest->sort_profit) && $getRequest->sort_profit != '') {
        $usersManager->sortBy('profit_cpa', htmlentities($getRequest->sort_profit));
    }       
    $result = $usersManager->getUsersUTM();
    $cvet=0;
    if (is_array($result) && count($result) > 0){ 
        
        foreach ($result as $res) {        
?>
       <tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
            <td><?=$res['u_source']; ?></td>
            <td><?=$res['utm_medium']; ?></td>
            <td><?=$res['utm_campaign']; ?></td>
            <td><?=$res['utm_term']; ?></td>
            <td><?=$res['utm_content']; ?></td>
            <td><?=$res['hosts']; ?></td>
            <td><?=$res['signups']; ?></td>
            <td><?=$res['clicks']; ?></td>
            <td><?=$res['orders']; ?></td>
            <td><?=$res['orders1']; ?></td>
            <td><?=$res['orders10']; ?></td>
            <td><?=$res['orders100']; ?></td>
            <td><?php if(empty($res['profit_cpa'])){ echo 0;}else{ echo $res['profit_cpa'];} ?></td>
        </tr>    
<?php            
        }
    }

}else{    
?>
<table class="stats_table" width="70%">
        <tr class="tableHead">
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_u1=<?php if (isset($getRequest->sort_u1) && $getRequest->sort_u1 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Метка</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_hosts=<?php if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Переходов</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_signups=<?php if (isset($getRequest->sort_signups) && $getRequest->sort_signups == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Регистраций</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_clicks=<?php if (isset($getRequest->sort_clicks) && $getRequest->sort_clicks == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Кликов</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_orders=<?php if (isset($getRequest->sort_orders) && $getRequest->sort_orders == 'desc'){echo 'asc';}else{echo 'desc';} ?>">Лидов</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_order1=<?php if (isset($getRequest->sort_order1) && $getRequest->sort_order1 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">1+</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_order10=<?php if (isset($getRequest->sort_order10) && $getRequest->sort_order10 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">10+</a></td>
            <td><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_order100=<?php if (isset($getRequest->sort_order100) && $getRequest->sort_order100 == 'desc'){echo 'asc';}else{echo 'desc';} ?>">100+</a></td>
            <td width="250px"><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_profit=<?php if (isset($getRequest->sort_profit) && $getRequest->sort_profit == 'desc'){echo 'asc';}else{echo 'desc';} ?>">доход_CPA</a></td>
       </tr>
<?php

    $usersManager->u1 = htmlentities($getRequest->utm);
    if (isset($getRequest->sort_u1) && $getRequest->sort_u1 != '') {
        $usersManager->sortBy('u_source', htmlentities($getRequest->sort_u1));
    }
    if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts != '') {
        $usersManager->sortBy('hosts', htmlentities($getRequest->sort_hosts));
    }
    if (isset($getRequest->sort_signups) && $getRequest->sort_signups != '') {
        $usersManager->sortBy('signups', htmlentities($getRequest->sort_signups));
    }
    if (isset($getRequest->sort_clicks) && $getRequest->sort_clicks != '') {
        $usersManager->sortBy('clicks', htmlentities($getRequest->sort_clicks));
    }
    if (isset($getRequest->sort_orders) && $getRequest->sort_orders != '') {
        $usersManager->sortBy('orders', htmlentities($getRequest->sort_orders));
    }       
    if (isset($getRequest->sort_u2) && $getRequest->sort_u2 != '') {
        $usersManager->sortBy('utm_medium', htmlentities($getRequest->sort_u2));
    }
    if (isset($getRequest->sort_u3) && $getRequest->sort_u3 != '') {
        $usersManager->sortBy('utm_campaign', htmlentities($getRequest->sort_u3));
    }
    if (isset($getRequest->sort_u4) && $getRequest->sort_u4 != '') {
        $usersManager->sortBy('utm_term', htmlentities($getRequest->sort_u4));
    }
    if (isset($getRequest->sort_u5) && $getRequest->sort_u5 != '') {
        $usersManager->sortBy('utm_content', htmlentities($getRequest->sort_u5));
    }    
    $result = $usersManager->getUsersUTM();
    $cvet=0;
    if (is_array($result) && count($result) > 0){ 
        
        foreach ($result as $res) { 
?>
       <tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
            <td><?=$res['u_source']; ?></td>
            <td><?=$res['hosts']; ?></td>
            <td><?=$res['signups']; ?></td>
            <td><?=$res['clicks']; ?></td>
            <td><?=$res['orders']; ?></td>
            <td><?=$res['orders1']; ?></td>
            <td><?=$res['orders10']; ?></td>
            <td><?=$res['orders100']; ?></td>
            <td><?php if(empty($res['profit_cpa'])){ echo 0;}else{ echo $res['profit_cpa'];} ?></td>
        </tr>    
<?php  
        }
    }
}
?>
        
</table>        
</div>
<p>
        &nbsp;
</p>
<p>
        &nbsp;
</p>