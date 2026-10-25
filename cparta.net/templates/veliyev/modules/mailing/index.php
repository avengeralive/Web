<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script src="/templates/<?php echo $template; ?>/modules/mailing/assets/js/list.js"></script>
<script src="/templates/<?php echo $template; ?>/modules/mailing/assets/js/jquery.form.js"></script>
<link rel="stylesheet" href="/templates/<?php echo $template; ?>/modules/mailing/assets/css/list.css"/>

<div class="col-12 mb-10">
    <p class="pageTitle mb-25">
    <?php
    if (!isset($var_mailing)) {
        echo '<b>Создание рассылки</b>';
    } else {
        echo '<b>Редактирование рассылки</b>';
    }
    ?>
    </p>
</div>

<div class="col-12 mb-10">

<form method=post action="?" class="new-mailing">
    <input type="hidden" name="action" value="save">
    <?php
    if (isset($var_mailing)) {
        echo "<input type=hidden name=id value=" . $var_mailing->id . "/>";
    }
    ?>

    <div class="form-group mail-subject">
      <label for="name">Тема письма</label>
      <input type="text" name="subject" class="form-control" id="name" required value="<?php if (isset($var_mailing)) echo $var_mailing->subject; ?>" placeholder="Тема письма">
    </div>
    
    <div class="mail-group form-group mb-20">
        <label for="public_news">Группа пользователей:</label>
        <select name="group" class="form-control">
            <option <?php if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL && $var_mailing->group_id == 10) echo 'selected'; ?> value="1-10">Вебмастер (<?php echo intval(DB::getInstance()->query("select count(*) from users where tip=10 and active=1 and notify=1")->fetchColumn()); ?>)</option>
            <option <?php if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL && $var_mailing->group_id == 20) echo 'selected'; ?>value="1-20">Колл-центр рекламодателя (<?php echo intval(DB::getInstance()->query("select count(*) from users where tip=20 and active=1 and notify=1")->fetchColumn()); ?>)</option>
            <option <?php if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL && $var_mailing->group_id == 30) echo 'selected'; ?>value="1-30">Менеджер рекламодателя (<?php echo intval(DB::getInstance()->query("select count(*) from users where tip=30 and active=1 and notify=1")->fetchColumn()); ?>)</option>
            <option <?php if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL && $var_mailing->group_id == 40) echo 'selected'; ?>value="1-40">Рекламодатель (<?php echo intval(DB::getInstance()->query("select count(*) from users where tip=40 and active=1 and notify=1")->fetchColumn()); ?>)</option>
            <option <?php if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL && $var_mailing->group_id == 50) echo 'selected'; ?>value="1-50">Колл-центр сети (<?php echo intval(DB::getInstance()->query("select count(*) from users where tip=50 and active=1 and notify=1")->fetchColumn()); ?>)</option>
            <option <?php if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL && $var_mailing->group_id == 60) echo 'selected'; ?>value="1-60">Менеджер сети (<?php echo intval(DB::getInstance()->query("select count(*) from users where tip=60 and active=1 and notify=1")->fetchColumn()); ?>)</option>
            <option <?php if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL && $var_mailing->group_id == 70) echo 'selected'; ?>value="1-70">Администратор сети (<?php echo intval(DB::getInstance()->query("select count(*) from users where tip=70 and active=1 and notify=1")->fetchColumn()); ?>)</option>
            <option <?php if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL && $var_mailing->group_id == 80) echo 'selected'; ?>value="1-80">Оператор тех.поддержки (<?php echo intval(DB::getInstance()->query("select count(*) from users where tip=80 and active=1 and notify=1")->fetchColumn()); ?>)</option>
            <?php
            $gm = new Mailing_Group_Manager(DB::getInstance());
            $list = $gm->get();
            foreach ($list as $gr) {
                $s = '';
                if (isset($var_mailing) && $var_mailing->group_type == Mailing_Group::GROUP_TYPE_CUSTOM && $var_mailing->group_id == $gr->id) {
                    $s = 'selected';
                }
                echo "<option $s value='2-" . $gr->id . "'>" . $gr->name . " (" . count($gr->getUsers(true)) . ") </option>";
            }
            ?>

        </select>
        <a class="" href="?action=group&list">Управление группами</a>
    </div>
    
    <div class="form-group">
        <textarea style="width:100%;height: 600px" rows=10 id=mailBody name="body"><?php if (isset($var_mailing)) echo $var_mailing->body; ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="when">Дата и время отправки:</label>
        <input type="text" class="new-input" id=when name="date" class="form-control" value="<?php
        if (isset($var_mailing)) {
            echo $var_mailing->sendAt;
        } else {
            echo date("Y-m-d H:i:s", time() + 60 * 60 * 1);
        }
        ?>">
        [<a onclick="document.getElementById('when').value = '<?php echo date("Y-m-d"); ?> 18:00:00'">Сегодня 18:00</a>] 
        [<a onclick="document.getElementById('when').value = '<?php echo date("Y-m-d", time() + 60 * 60 * 24 * 1); ?> 10:00:00'">Завтра 10:00</a>] 
        [<a onclick="document.getElementById('when').value = '<?php echo date("Y-m-d", time() + 60 * 60 * 24 * 2); ?> 10:00:00'">Послезавтра 10:00</a>] 

        <a class="btn btn-info" style="float:right;color: #fff !important;" href="#" onclick="window.open('?action=templates', 't', 'width=700px,height=500px')">Из шаблонов</a>
    </div>

    <input type="hidden" name="save">
    
    <div class="row mb-30">
        <div class="col-auto">
            <button type="button" class="btn button" value="db">Сохранить</button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn button" value="db" onclick="document.getElementById('when').value = '<?php echo date("Y-m-d H:i:s"); ?>'">Отправить сейчас</button>
        </div>
    </div>

    <div class="form-group">
      <p>Отправить тест письма на адрес:</p>
      <input type="text" name="test" value="<?php echo $user->email; ?>"> <button type=button value="test">Отправить тест</button> <span id="status"></span>
    </div>
    
    <hr>
    
</form>
    
</div>
<div class="col-12 mb-10 mt-50">
<table class="table table-bordered text-center" width="100%">
    <tr class="table_zagolovki">
        <td>Тема</td>

        <td>Отправка</td>
        <td>Статус</td>
        <td>Группа</td>
        <td>Дейтствие</td>
        <td>Сводка <bR><small>(Открытия/Отпись/Кликов)</td>
    </tr>
    <?php
    $mm = new Mailing_Manager(DB::getInstance());
    $mm->sortBy("sendAt", "desc");
    $list = $mm->get();
    foreach ($list as $mailing) {
        echo "<tr>";
        echo "<td width=300 align=left style='text-align:left'><b>" . $mailing->subject . "</b><br>";
        echo substr(strip_tags($mailing->body), 0, 200) . "...</td>";
        echo "<td>" . $mailing->sendAt . "</td>";

        if ($mailing->status == Mailing::STATUS_NEW) {
            echo "<td>В ожидании отправки</td>";
        }
        if ($mailing->status == Mailing::STATUS_DONE) {
            echo "<td><font color=green>Отослано</font></td>";
        }
        if ($mailing->status == Mailing::STATUS_SENDING) {
            echo "<td><font color=orange>Отсылается</font></td>";
        }
        echo "<td>";
        if ($mailing->group_type == Mailing_Group::GROUP_TYPE_INTERNAL) {
            echo DB::getInstance()->query("select title from users_roles_tpl where tip=" . $mailing->group_id)->fetchColumn();
        } else {
            echo Mailing_Group::getById($mailing->group_id)->name;
        }
        echo "</td>";
        echo "<td> "
        . "<a href=?action=edit&id=" . $mailing->id . ">Редактировать</a> / "
        . "<a href=?action=delete&id=" . $mailing->id . ">удалить</a>"
        . "</td>"
        . "<td>"
        . "$mailing->opened/$mailing->unsubscribe/<a href=?action=links&id=" . $mailing->id . " class=js-links data-mid=$mailing->id>" . $mailing->clicks . "</a>"
        . "</td>";
        //echo 
        echo "</tr>";
    }
    ?>

</table>
<script>
    function setHtml(html) {
        CKEDITOR.instances.mailBody.setData(html)
    }
</script>
</div>