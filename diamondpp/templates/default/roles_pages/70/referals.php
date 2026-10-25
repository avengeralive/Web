<?php
if (isset($_POST['addref'])) {
    $web = $_POST['web_id'];
    $ref_percent = $_POST['ref_percent'];
    $type_ref = $_POST['type_ref'];
    $sql = "UPDATE users SET ref_program = 1, `ref_percent` = '".$ref_percent."', `type_ref` = '".$type_ref."' WHERE `id` = '$web'";
	$mysqli->query($sql);
}
if (isset($_GET['delete'])) {
    $sql = "UPDATE users SET ref_program = 0 WHERE `id` = '".$_GET['delete']."'";
	$mysqli->query($sql);
}

?>
<div class="row main mt-50 mb-50">
    
    <div class="col-12 mb-25">
        <p class="pageTitle"><span>Реферальная система</span></p>
    </div>

    <div class="col-12">
        <form action="/referals.php" method="post">
            <div class="row">
                <div class="col-md-3">
                    <p>Веб</p>
                    <select name="web_id">
                    <?php 
                    $sql_users = 'select * from users where tip = 10';
                    $result_web = $mysqli->query($sql_users);
                    while ($res = mysqli_fetch_array($result_web)) { ?>
                        <option value="<?php echo $res['id']; ?>"><?php echo $res['email']; ?>, <?php echo $res['id']; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <p>Реферальский процент</p>
                    <input type="number" name="ref_percent">
                </div>
                <div class="col-md-3">
                    <p>Откуда отдавать</p>
                    <p><input type="radio" name="type_ref" value="1"> Комиссия CPA сети</p>
                    <p><input type="radio" name="type_ref" value="2"> Комиссия веба</p>
                </div>
                <div class="col-md-3">
                    <button type="submit" name="addref">Подключить к программе</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12">
        <table>
            <tr>
                <th>Веб</th>
                <th>Реферальный процент</th>
                <th>Тип выплаты</th>
                <th></th>
            </tr>
        <?php $sql_users = 'select * from users where tip = 10 and ref_program = 1';
            $result_web = $mysqli->query($sql_users);
            $tpr[1] = 'Комиссия CPA сети';
            $tpr[2] = 'Комиссия веба';
            while ($res = mysqli_fetch_array($result_web)) { ?>
            <tr>
                <td><?php echo $res['email']; ?>, <?php echo $res['id']; ?></td>
                <td><?php echo $res['ref_percent']; ?>%</td>
                <td><?php echo $tpr[$res['type_ref']]; ?></td>
                <td><a href="/referals.php?delete=<?php echo $res['id']; ?>">Отключить реферальную программу</a></td>
            </tr>
        <?php } ?>
        </table>
    </div>
</div>