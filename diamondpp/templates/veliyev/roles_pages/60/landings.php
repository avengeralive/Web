<div class="row main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['landings.php']['t01']; ?></p></div>
    
    <?php 
    if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = $loc['landings.php']['t02'];$error_type = 'success';} 
    if (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = $loc['landings.php']['t03'];$error_type = 'error';} 
    if (isset($_GET['xtext']) && $_GET['xtext']=='3') {$error_message = $loc['landings.php']['t04'];$error_type = 'success';} 
    ?>

    <?php
    // Выводим форму добавления лендинга
    // Display the form of adding landing
    include ('./templates/' . $template . '/blocks/landings_form.php');
    ?>

    
    <div class="col-12 mt-30">
    
    
    
<p>
    <b><?php echo $loc['landings.php']['t16']; ?></b>
</p>

<table class="table table-bordered">
    <tr class="tableHead">
        <th class="text-center" colspan=2 style="width: 40px;"><?php echo $loc['landings.php']['t17']; ?></th>
        <th style="width: 250px;"><?php echo $loc['landings.php']['t07']; ?></th>	
        <th><?php echo $loc['landings.php']['t08']; ?></th>
        <th style="width: 400px;"><?php echo $loc['landings.php']['t09']; ?></th>
        <th style="width: 200px;"><?php echo $loc['landings.php']['t18']; ?></th>
        <th style="width: 70px;"><?php echo $loc['landings.php']['t19']; ?></th>
    </tr>
<?php
$sql_landings = "SELECT * FROM landings ORDER BY `id` DESC";
$result_landings = $mysqli->query($sql_landings);
$cvet = 0;
if (mysqli_num_rows($result_landings) > 0) {
    while ($res_landings = mysqli_fetch_array($result_landings)) {
        $landing_id = htmlentities($res_landings['id']);
        $landing_name = htmlentities($res_landings['name']);
        $landing_url = str_replace('&amp;', '&', htmlentities($res_landings['url']));
        $landing_offer_id = htmlentities($res_landings['offer_id']);
        ?> 
     
            <tr>
                <td class="text-center" width="40" style="width: 40px;"><?php echo $landing_id; ?></td>
                <td class="text-center" width=100 style="width: 100px;"><?
                    if (($res_landings['type'] & 2) == 2) {
                        echo '<img src="/templates/default/img/helpers/mobile.png" width=32 title="Мобильный ленд">';
                    }
                    if (($res_landings['type'] & 4) == 4) {
                        echo '<img src="/templates/default/img/helpers/adaptive.png" width=32 title="Адаптивный ленд">';
                    }
                    if (($res_landings['type'] & 8) == 8) {
                        echo '<img src="/templates/default/img/helpers/own.png" width=32 title="Авторский ленд">';
                    }
                    ?>
                </td>
                <td width=250 style="width: 250px; text-align: left;"><?php echo html_entity_decode($landing_name, ENT_QUOTES, 'utf-8'); ?></td>
                <td width=400 style="text-align: left;"><a target="_blank" href="<?php echo $landing_url; ?>"><?php echo $landing_url; ?></a></td>
                <td width=150 style="text-align: left; width: 400px;">
                    <?php
                    // Получаем буквенное название оффера и его статус
                    // Get the name of the letter and its status offer
                    $sql_viewoffer = "SELECT id,name,active FROM offers WHERE `id`='$landing_offer_id'";
                    $result_viewoffer = $mysqli->query($sql_viewoffer);
                    if (mysqli_num_rows($result_viewoffer) > 0) {
                        $res_viewoffer = mysqli_fetch_array($result_viewoffer);
                        $id_of = htmlentities($res_viewoffer['id']);
                        $name_of = htmlentities($res_viewoffer['name']);
                        $active_of = htmlentities($res_viewoffer['active']);
                        echo '<a target="_blank" href="./offers.php?offer=' . $id_of . '">' . html_entity_decode($name_of, ENT_QUOTES, 'utf-8') . '</a>';
                    } else {
                        echo '<font color=red>' . $loc['landings.php']['t10'] . '</font>';
                    }
                    ?>
                </td>
                    <?php
                    if (isset($active_of)) {
                        if ($active_of == '0') {
                            echo '<td style="width: 100px; background: red; color: white;">' . $loc['landings.php']['t20'] . '</td>';
                        }
                        if ($active_of == '1') {
                            echo '<td style="width: 100px; background: green; color: white;">' . $loc['landings.php']['t21'] . '</td>';
                        }
                        if ($active_of == '2') {
                            echo '<td style="width: 100px; background: yellow; color: red;">' . $loc['landings.php']['t22'] . '</td>';
                        }
                    } else {
                        echo '<td style="background: red; color: white;">' . $loc['landings.php']['t23'] . '</td>';
                    }
                    ?>
                </td>
                <td style="width: 70px;"><a href="./landings.php?delete=<?php echo $landing_id; ?>" onclick="if (!confirm('<?php echo $loc['landings.php']['t24']; ?>&nbsp;<?php echo html_entity_decode($landing_name, ENT_QUOTES, 'utf-8'); ?>?'))
                                                            return false;"><?php echo $loc['landings.php']['t25']; ?></a></td> 
            </tr>
        			
        <?php
    }
}
?>  
</table>
    </div>
