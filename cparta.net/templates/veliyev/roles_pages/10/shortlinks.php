
<h1><?php echo $loc['shortlinks.php']['t01']; ?></h1>

<p>
    <?php
    if (isset($_GET['xtext']) && $_GET['xtext'] == '1') {
        echo '<font color=red><b>' . $loc['shortlinks.php']['t02'] . '</b></font>';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '2') {
        echo '<font color=red><b>' . $loc['shortlinks.php']['t03'] . '</b></font>';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '3') {
        echo '<font color=green><b>' . $loc['shortlinks.php']['t04'] . '</b></font>';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '4') {
        echo '<font color=green><b>' . $loc['shortlinks.php']['t05'] . '</b></font>';
    }
    if (isset($_GET['xtext']) && $_GET['xtext'] == '5') {
        echo '<font color=red><b>' . $loc['shortlinks.php']['t06'] . '</b></font>';
    }
    ?>
</p>

<!-- Блок с формой -->
<!-- Block with a form -->
<p>
<form name="add_shortlink" class="report" method="post" action="./shortlinks.php?<?php echo @$_SERVER['QUERY_STRING']; ?>">
    <div style="float: left;">
        <b><?php echo $loc['shortlinks.php']['t07']; ?>&nbsp;</b>
        <input type="text" name="link" required="" class="search_pole" value="" maxlength="100" style="width: 300px; padding: 0px 8px 0px 8px;" placeholder="<?php echo $loc['shortlinks.php']['t08']; ?>" />
        <input type="text" name="alt" required="" class="search_pole" value="" maxlength="100" style="width: 150px; padding: 0px 8px 0px 8px;" placeholder="Краткое название" />
    </div>
    <div style="float: left; margin-left: 10px;">
        <b>&nbsp;</b><input name="submit_shortlinks" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit" type="submit" style="top: -9px;">
    </div>
</form>
</p>
<!-- Конец блока с формой -->
<!-- End unit with a form -->

<p>
<table class="stats_table" style="width: 100%; margin-top: 70px;">
    <tr class="table_zagolovki">
        <td><?php echo $loc['shortlinks.php']['t09']; ?></td>
        <td><?php echo $loc['shortlinks.php']['t10']; ?></td>

        <td><?php echo $loc['shortlinks.php']['t12']; ?></td>	
    </tr>
    <?php
    // Определяем какой домен используется для витрины
    // Determine which domain is used for showcase
    $sql = "select * from domains where `active`='6' or (active=5 and user_id=$user_id) ";
    $domains = [];
    $stmt = DB::getInstance()->query($sql);
    $domains = $stmt->fetchAll(PDO::FETCH_OBJ);

    $sql_domain = "SELECT * FROM domains WHERE `active`='6' or (active=5 and user_id=$user_id) ";
    $result_domain = $mysqli->query($sql_domain);
    $res_domain = mysqli_fetch_array($result_domain);

    // Назначаем переменную для полученного домена
    // Assign a variable to the resulting domain
    $domain = htmlentities($res_domain['domain']);

    // Запрашиваем необходимые данные из таблицы с короткими ссылками
    // Request the necessary data from the table with short links
    $sql = "SELECT * FROM shortlinks WHERE `user_id`='$user_id' ORDER BY `id` DESC";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($res = mysqli_fetch_array($result)) {
            // Назначаем переменные
            // Assign variables
            $shortlink_id = htmlentities($res['id']);
            $shortlink_link = htmlentities($res['link']);
            $shortlink_date = htmlentities($res['date']);
            $shortlink_alt = htmlentities($res['alt']);
            ?>  
            <tr>
                <td width=250 align="left" style="text-align: left;width: 350px"><small><?
                        foreach ($domains as $d) {
                            echo 'http://' . $d->domain . '/' . $shortlink_alt . '-' . $shortlink_id . '.html<br>';
                        }
                        ?></td>
                <td style="text-align: left">Хитов (Переходов): <b><?php echo $res['hits'];?></b>, создана: <?php echo $shortlink_date;?><small><br><u><?php echo $shortlink_link; ?></td>
                
                <td>&nbsp;<a href="shortlinks.php?delete=<?php echo $shortlink_id; ?>" onclick="if (!confirm('<?php echo $loc['shortlinks.php']['t13']; ?>'))
                                    return false;"><?php echo $loc['shortlinks.php']['t14']; ?></a>&nbsp;</td>
            </tr>  
            <?php
        }
    }
    ?>  
</table>
</p>

<p style="margin-top: 30px;">
    <?php echo $loc['shortlinks.php']['t15']; ?>&nbsp;<?php echo $settings_account_max_shortlinks; ?>&nbsp;<?php echo $loc['shortlinks.php']['t16']; ?>
</p>

<p>
    &nbsp;
</p>

