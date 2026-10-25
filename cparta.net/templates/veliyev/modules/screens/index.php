<script src="/templates/<?php echo $template; ?>/modules/screens/assets/js/list.js"></script>
<style>
    table.last{
        width: 100%;
        background: white;
        border: 1px solid #ccc;
    }
    table.last td, table.last th{
        padding: 5px;
        border:1px solid #f0f0f0;
        font-size: 12px;
    }
    table.
    .col-lg-3{
        width: 25%;
        float: left;
    }
    .col-lg-6{
        width: 49%;
        float: left;
        box-sizing: border-box;
        border: 1px solid #9e9ea6;
        border-radius: 10px;
        margin-right: 1%;


    }
    .form-group{
        width: 100%;
        clear: both;
        margin-bottom: 10px;
    }
    .form-group label{
        font-weight: bold;
        width: 150px;
        float: left;
        display: block;
    }
    .form-control{
        width: 300px;
        padding: 3px;

    }

</style>

<style>

</style>
<p>
    <b>Мобильные скриншоты лендингов</b>
</p>
<div class="pull-left col-lg-6" style="background: #fafafa;padding:10px; ">
    <h4>Добавить в обработку лендинг:</h4>
    <form action="?" id='js-form' method="post">

        <div class="form-group">
            <label>Офер:</label>
            <select class="form-control" id='js-offers'>
                <option value='0'>Выбрать</option>
                <?php
                foreach (Offer::getAll('id desc') as $offer) {
                    echo "<option value=" . $offer->id . ">" . $offer->id . " | " . $offer->name . '</option>' . PHP_EOL;
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Лендинг:</label>
            <select name='landing' class="form-control" id='js-landings'>
                <option value='0'>Выбрать</option>
            </select>
        </div>
        <div class="form-group">
            <label>Устройства:</label>
            <select name=devices[] class="form-control" multiple="" rows='10' style='height: 150px'>
                <option value=189 selected>Apple iPhone 5</option>
                <option value=21>Apple iPad 1</option>
                <option value=161>Apple iPad 2</option>
                <option value=190  selected>Apple iPad 3</option>
                <option value=162  selected >Android Nexus S</option>
                <option value=184 >Android Nexus 7</option>
                <option value=275 >Android Galaxy Note II</option>
                <option value=274  selected>Android Galaxy Note 10.1</option>
            </select>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>

            <button name='action' value='run'>Добавить в обработку</button>

        </div>
    </form>
</div>
<div class="pull-left col-lg-6" style="background: #fafafa;padding:10px;">
    <h4>Состояние сервиса</h4>
    <table class='last'>
        <thead>
            <tr>
                <th>Офер</th>
                <th>Лендинг</th>
                <th>Устройство</th>
                <th>Скриншот</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "select * from langings_screenshots order  by id desc limit 10";
                $stmt = DB::getInstance()->query($sql);
                while($row= $stmt->fetchObject()){
                    echo "<TR><Td>".Offer::getById( Offer_Landing::getById( $row->landing_id)->offer_id)->name."</td>";
                    echo "<td><A href=\"".Offer_Landing::getById( $row->landing_id)->url."\" target=_blank>".Offer_Landing::getById( $row->landing_id)->name."</a></td>";
                    echo "<td>".$row->device."</td>";
                    echo "<td>";
                    if( $row->status == 'done'){
                        echo "<a target=_Blank href=\"".preg_replace("/(scale=(.*))/i", "", $row->url)."\">Скрин</a>";
                    }
                    else{
                        echo "<font color=#ccc>".$row->status;
                        if( $row->status == 'error'){
                            echo ' / <a href=?action=run&landing='.$row->landing_id.'&devices[]='.$row->instance.'>retry</a>';
                        }
                    }
                    echo "</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>
<div style='clear:both'></div>
<div id='js-result'>

</div>