<link id="bsdp-css" href="./templates/<?php echo $template; ?>/lib/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="./templates/<?php echo $template; ?>/lib/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="./templates/<?php echo $template; ?>/lib/datepicker/locales/bootstrap-datepicker.ru.min.js" charset="UTF-8"></script>


<!--<script type="text/javascript" src="./templates/<?php echo $template; ?>/js/moment.min.js"></script>
<script src="./templates/<?php echo $template; ?>/js/range.js"></script>
<link rel="stylesheet" type="text/css" href="./templates/<?php echo $template; ?>/css/daterangepicker.css" />-->
<?php
// Подгружаем необходимые для работы функции
// Loads the necessary features to work
include 'zakaz_functions.php';
?>
<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1>Заказы</h1>
        </div>
        <? include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>
    <script>
        $(function() {    
            $('.input-daterange').datepicker({
                todayBtn: "linked",
                language: "ru",
                todayHighlight: true
            });
        });
    </script>
    <form method="get" id="filter_form" action="./zakaz.php">
        <div class="row grow">  
            <div class="col-md-3 input-daterange input-group" id="datepicker">
                <label class="" for=""><b><?php echo $loc['zakaz.php']['t122']; ?>&nbsp;</b></label>
                <p>
                    <input type="text" class="datefield form-control" name="date1" value="<?php if ( !isset( $_GET['date1'] ) ) {echo date('d.m.Y',strtotime($dat1));} else {echo $_GET['date1'];} ?>" readonly>
                    <input type="text" class="datefield form-control" name="date2" value="<?php if ( !isset( $_GET['date2'] ) ) {echo date('d.m.Y',strtotime($dat2));} else {echo $_GET['date2'];} ?>" readonly>
                </p>
            </div>
            <div class="col-md-3">
                <label class="" for=""><b><?php echo $loc['zakaz.php']['t14']; ?>&nbsp;</b></label>
                <div class="custom_select">                            
                    <select name="status" class="form-control">
                        <option class="options" value="-1" <?php if (isset($_GET['status']) && $_GET['status']=="-1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t123'];?></option>
                        <option class="options" value="1" <?php if (!isset($_GET['status']) || $_GET['status']=="1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t124']; ?></option>
                        <option class="options" value="3" <?php if (isset($_GET['status']) && $_GET['status']=="3") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t126']; ?></option>
                        <option class="options" value="0" <?php if (isset($_GET['status']) && $_GET['status']=="0") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t127']; ?></option>
                        <option class="options" value="5" <?php if (isset($_GET['status']) && $_GET['status']=="5") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['r1']; ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="" for=""><b><?php echo $loc['zakaz.php']['t13']; ?>&nbsp;</b></label>
                <div class="custom_select">                            
                     <select name="offer" class="form-control" style="">
                        <option class="options" value="-1"><?php echo $loc['zakaz.php']['t123']; ?></option>
                        <?php
                            $sql_offer_view = "SELECT DISTINCT offer_id FROM zakaz where user_id = '$user_id'";
                            $result_offer_view = $mysqli->query($sql_offer_view);
                            if (mysqli_num_rows($result_offer_view)>0) {
                                while($res_offer_view=mysqli_fetch_array($result_offer_view)) {
                                                        $of_id=htmlentities($res_offer_view['offer_id']);
                                                        $sql_offer_name = "SELECT name,allow_success_status_zakaz,deystvie FROM offers WHERE `id`='$of_id'";
                                                        $result_offer_name = $mysqli->query($sql_offer_name);
                                                        $res_offer_name=mysqli_fetch_array($result_offer_name);
                                                        $of_name=html_entity_decode($res_offer_name['name']);
                        ?>
                        <option class="options" value="<?php echo $of_id; ?>"<?php if (isset($_GET['offer']) && $_GET['offer']==$of_id) {echo 'selected="selected"';} ?>><?php echo $of_name; ?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <h3 class="empty"></h3>
                <input type="hidden" name="count" id="count" value="<?php if (isset($_GET['count'])) {echo intval($_GET['count']);}else{ echo 20;} ?>">
                <input value="<?php echo $loc['button']['t02']; ?>" class="btn button" type="submit">
                <a href="./zakaz.php"><button type="button" class="btn button reset"><?php echo $loc['zakaz.php']['t128']; ?></button></a>
            </div>
        </div>
    </form>
    <div class="row grow">
        <?php
            // инициируем обработчик запросов для вычисления количества заказов во всех статусах
            // Initiate the query processor to calculate the number of orders in all statuses
            $zp=new zakaz_processor($mysqli);
                        
                        
            $zp->filter_fields['user_id']= $user_id;
            $zp->filter_fields['owner_id']=intval($user_id);
            $zp->filter_fields['offer']=isset($_GET['offer']) ? intval($_GET['offer']) : -1;
                        
                        $zp->filter_fields['landing_id']=isset($_GET['landing_id']) ? intval($_GET['landing_id']) : -1;
                        $zp->filter_fields['prelanding_id']=isset($_GET['prelanding_id']) ? intval($_GET['prelanding_id']) : -1;
                        $zp->filter_fields['subid1']=isset($_GET['subid1']) ? htmlentities($_GET['subid1']) : -1;
                        $zp->filter_fields['subid2']=isset($_GET['subid2']) ? htmlentities($_GET['subid2']) : -1;
                        $zp->filter_fields['subid3']=isset($_GET['subid3']) ? htmlentities($_GET['subid3']) : -1;
                        $zp->filter_fields['subid4']=isset($_GET['subid4']) ? htmlentities($_GET['subid4']) : -1;
                        $zp->filter_fields['subid5']=isset($_GET['subid5']) ? htmlentities($_GET['subid5']) : -1;
                        $zp->filter_fields['country']=isset($_GET['country']) ? htmlentities($_GET['country']) : -1;
                        $zp->filter_fields['stream']=isset($_GET['stream']) ? htmlentities($_GET['stream']) : -1;
                        
            $zp->filter_fields['count']=isset($_GET['count']) ? intval($_GET['count']) : 20;
            $zp->filter_fields['page']=isset($_GET['page']) ? intval($_GET['page']) : 1;
            $zp->filter_fields['sum']=isset($_GET['sum']) ? intval($_GET['sum']) : -1; 
            $zp->filter_fields['date_z']=isset($_GET['date_z']) ? intval($_GET['date_z']) : -1; 
            $zp->filter_fields['date_i']=isset($_GET['date_i']) ? intval($_GET['date_i']) : -1; 
            $zp->filter_fields['date1']=$dat1.' '.$DT;
            $zp->filter_fields['date2']=$dat2.' '.$NT;
                        
            $zp->filter_fields['status']='-1';
            $k_zakaz_all=$zp->get_count(true);
                        
            $zp->filter_fields['status']=1;
            $k_zakaz_wait=$zp->get_count(true);
            $zp->filter_fields['status']=2;
            $k_zakaz_hold=$zp->get_count(true);
            $zp->filter_fields['status']=3;
            $k_zakaz_ok=$zp->get_count(true);
            $zp->filter_fields['status']=0;
            $k_zakaz_cancel=$zp->get_count(true);
            $zp->filter_fields['status']=5;
            $k_zakaz_trash=$zp->get_count(true);
            
                            
        ?>
        <div class="col-md-12">
            <div class="block mb30">
                <div class="row irow">
                    <div class="col-md-12">
                        <div class="link_wait_place col  <?php if (!isset($_GET['status']) or $_GET['status'] == '-1') echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => -1, 'page' => 1))?>">Все&nbsp;<?php if (isset($k_zakaz_all) && $k_zakaz_all>0) {echo "(".$k_zakaz_all.")";} ?></a></div>
                        <div class="link_wait_place col  <?php if (isset($_GET['status']) && $_GET['status'] == 1) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 1, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t07']; ?>&nbsp;<?php if (isset($k_zakaz_wait) && $k_zakaz_wait>0) {echo "(".$k_zakaz_wait.")";} ?></a></div>
                        <div class="link_wait_place col  <?php if (isset($_GET['status']) && $_GET['status'] == 3) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 3, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t129']; ?>&nbsp;<?php if (isset($k_zakaz_ok) && $k_zakaz_ok>0) {echo "(".$k_zakaz_ok.")";} ?></a></div>
                        <div class="link_wait_place col  <?php if (isset($_GET['status']) && $_GET['status'] == 0) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 0, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t130']; ?>&nbsp;<?php if (isset($k_zakaz_cancel) && $k_zakaz_cancel>0) {echo "(".$k_zakaz_cancel.")";} ?></a></div>
                        <div class="link_wait_place col  <?php if (isset($_GET['status']) && $_GET['status'] == 5) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 5, 'page' => 1))?>"><?php echo $loc['zakaz.php']['r1']; ?>&nbsp;<?php if (isset($k_zakaz_trash) && $k_zakaz_trash>0) {echo "(".$k_zakaz_trash.")";} ?></a></div>
                    </div>
                </div>
                <div class="row irow">
                    <div class="col-md-12">
                        <?php
        if($k_zakaz_all > 0){
        // передаем значения из фильтра
        // Pass the values ​​of the filter
        $zp->filter_fields['status']=isset($_GET['status']) ? intval($_GET['status']) : '-1';
        $zp->filter_fields['addstatus']=isset($_GET['addstatus']) ? intval($_GET['addstatus']) : -1;
        // задаем limit и offset
        // We set limit and offset

        $show_pages = $zp->filter_fields['count']; // Сколько новостей покажем посетителям // How many news show visitors
        $zp->page_size=$show_pages;
        $zp->offset=$show_pages*(isset($_GET['page']) ? (intval($_GET['page'])-1) : 0);
        $rows_max=$zp->get_count(true);

        if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) ) $this_page = filter_var( $_GET['page'], FILTER_SANITIZE_NUMBER_INT ); // Номер текущей страницы
        else $this_page = 1;

        // Вывод количества страниц (буферизируем html-код переключалки страниц в $paging_html)
        // Display the number of pages (html-code buffering switcher pages in $paging_html)
        $paging_html='';
        $col = '';
        $col_end = '';
        // Первая и предыдущая страницы
        // First & previous pages
        if ($this_page != 1) {
            $paging_html.='<div id="pagination-before-after"><a class="left" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ($this_page-1))).'"></a></div>';
        }

        if ( $rows_max > $show_pages ){

            if($this_page >= 3){
                $col = '<div class="col-12 mb-10">';
                $col_end = '</div>';
                $paging_html.= '<div id="pagination"><a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => 1)).'">1</a></div>';
                $paging_html.= '<div id="pagination"> ... </div>';                                
                for ($r = 1; $r <= ceil( $rows_max/$show_pages ); $r++) {   
                    if($r < ($this_page-1)){
                        continue;
                    }  
                    if($r > ($this_page+1) && $this_page < ($rows_max - 1)){
                        $paging_html.= '<div id="pagination"> ... </div>';
                        $paging_html.= '<div id="pagination"><a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ceil( $rows_max/$show_pages))).'">'.ceil( $rows_max/$show_pages).'</a></div>';
                        break;
                    }    
                    $paging_html.='<div id="pagination">';
                    if ( $r != $this_page ){
                        $paging_html.='<a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => $r)).'">'.$r.'</a>'; 
                    }else{
                        $paging_html.='<span class=act>'.$r.'</span>';
                    }
                    $paging_html.='</div>';
                }                              
            }elseif($this_page < 3){
                $col = '<div class="col-12 mb-10">';
                $col_end = '</div>';
                for ($r = 1; $r <= ceil( $rows_max/$show_pages ); $r++) {            
                    if($r > 3){
                        $paging_html.= '<div id="pagination"> ... </div>';
                        $paging_html.= '<div id="pagination"><a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ceil( $rows_max/$show_pages))).'">'.ceil( $rows_max/$show_pages).'</a></div>';
                        break;
                    }
                    $paging_html.='<div id="pagination">';
                    if ($r != $this_page) {
                        $paging_html.='<a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => $r)).'">'. $r .'</a>';
                    } else {
                        $paging_html.='<span class=act>'.$r.'</span>';
                    }
                    $paging_html.='</div>';
                }  
            }
            if ($this_page != ceil( $rows_max/$show_pages )) {
                $paging_html.='<div id="pagination-before-after"><a class="right" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ($this_page+1))).'"></a></div>';
            }                           

        }

        // Конец вывода количества страниц
        // End of the output number of pages
        ?>  
                    <table class="table table-bordered text-center zakaz_table">
                        <tr class="tableHead" style="text-align: left;">
                                    <th colspan="2"><?php echo $loc['zakaz.php']['t132']; ?></th>
                                    <th>Статус</th>
                                    <th width="75">
                                            <a href="./zakaz.php?<?php 
                                            if (isset($_GET['date_z']) && $_GET['date_z']=='1')
                                                    {
                                                    $zp->filter_fields['date_z']='2';
                                                    $zp->filter_fields['date_i']='-1';
                                                    $zp->filter_fields['sum']='-1';
                                                    }
                                            elseif (isset($_GET['date_z']) && $_GET['date_z']=='2')
                                                    {
                                                    $zp->filter_fields['date_z']='1';
                                                    $zp->filter_fields['date_i']='-1';
                                                    $zp->filter_fields['sum']='-1';                         
                                                    }
                                            else
                                                    {
                                                    $zp->filter_fields['date_z']='1';
                                                    }                       
                                            echo prepare_get_query($_GET,Array('status' => $zp->filter_fields['status'], 'page' => $zp->filter_fields['page'], 'date_z' => $zp->filter_fields['date_z'], 'date_i' => $zp->filter_fields['date_i'], 'sum' => $zp->filter_fields['sum']))?>"><?php echo $loc['zakaz.php']['t133']; ?></a>                 
                                    </th>
                    <th width="75">
                        <a href="./zakaz.php?<?php 
                        if (isset($_GET['date_i']) && $_GET['date_i']=='1')
                            {
                            $zp->filter_fields['date_i']='2';
                            $zp->filter_fields['date_z']='-1';
                            $zp->filter_fields['sum']='-1';                         
                            }
                        elseif (isset($_GET['date_i']) && $_GET['date_i']=='2')
                            {
                            $zp->filter_fields['date_i']='1';
                            $zp->filter_fields['date_z']='-1';
                            $zp->filter_fields['sum']='-1';                                                     
                            }
                        else
                            {
                            $zp->filter_fields['date_i']='1';
                            }                       
                        echo prepare_get_query($_GET,Array('status' => $zp->filter_fields['status'], 'page' => $zp->filter_fields['page'], 'date_z' => $zp->filter_fields['date_z'], 'date_i' => $zp->filter_fields['date_i'], 'sum' => $zp->filter_fields['sum']))?>"><?php echo $loc['zakaz.php']['t134']; ?></a>                 
                    </th>
                    <th><?php echo $loc['zakaz.php']['t136']; ?></th>
                    <th class="zakaz_table_view_summ">
                        <a href="./zakaz.php?<?php 
                        if (isset($_GET['sum']) && $_GET['sum']=='1')
                            {
                            $zp->filter_fields['sum']='2';
                            $zp->filter_fields['date_z']='-1';
                            $zp->filter_fields['date_i']='-1';                                                  
                            }
                        elseif (isset($_GET['sum']) && $_GET['sum']=='2')
                            {
                            $zp->filter_fields['sum']='1';
                            $zp->filter_fields['date_z']='-1';
                            $zp->filter_fields['date_i']='-1';                                                                          
                            }
                        else
                            {
                            $zp->filter_fields['sum']='1';
                            }                       
                        echo prepare_get_query($_GET,Array('status' => $zp->filter_fields['status'], 'page' => $zp->filter_fields['page'], 'date_z' => $zp->filter_fields['date_z'], 'date_i' => $zp->filter_fields['date_i'], 'sum' => $zp->filter_fields['sum']))?>"><?php echo $loc['zakaz.php']['t169']; ?></a> 
                    </th>
                </tr>           

            <?php
            // получаем результат и вызываем файл zakaz_sql.php, в котором выводится результат
            // Get the result and call zakaz_sql.php file in which the result is output
            $result_to_display=$zp->get_result();
            include('zakaz_sql.php');
            ?>
                                
                    </table>
                </div>
            </div>
        </div>       
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col">
                    <?php echo $paging_html; ?>
                </div>
                <div class="col float-right text-right" style="height: 45px;">
                    <p>
                        <div class="custom_select">
                            <select id="count-inp">
                                <option value="20" <?php if (isset($_GET['count']) && $_GET['count']=='20') {echo 'selected="selected"';} ?>>20 / страница</option>
                                <option value="50" <?php if (isset($_GET['count']) && $_GET['count']=='50') {echo 'selected="selected"';} ?>>50 / страница</option>
                                <option value="100" <?php if (isset($_GET['count']) && $_GET['count']=='100') {echo 'selected="selected"';} ?>>100 / страница</option>
                            </select>
                        </div>
                    </p>
                    <script>
                                $(document).ready(function () {
                                    $('.act').parent().addClass('active');
                                    $(document).on('change', '#count-inp', function () {
                                        var count = $(this).val();
                                        $('#count').val(count);
                                        $('#filter_form').submit();
                                    })
                                });
                    </script>
                </div>
            </div>
        </div>
        <?php }else{ ?>
            <div class="col-12 text-center">
                <p class="">Нет результатов</p>
            </div>
            <?php } ?>      
    </div>
</main>


