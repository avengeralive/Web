<script src="/templates/<?php echo $template; ?>/modules/mailing/assets/js/groups.js"></script>
<link rel="stylesheet" href="/templates/<?php echo $template; ?>/modules/mailing/assets/css/list.css"/>

<div class="col-12 mb-10">

    <table class="table table-bordered">
        <thead>
            <Tr class="table_zagolovki">
                <th>Название группы</th>
                <Th>Количество участников</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($var_list)) {
                echo "<tr><Td colspan=3><i>Групп еще нет</i></td></tr>";
            } else {
                foreach ($var_list as $mailGroup) {
                    echo "<tr><td>" . $mailGroup->name . "</td><td>" . $mailGroup->getTotalUsers() . "</td>"
                    . "<Td>"
                    . "[<a href=?action=group&edit=" . $mailGroup->id . ">Редактировать</a>] "
                    . "[<a class='delete_group' href=?action=group&delete=" . $mailGroup->id . ">Удалить</a>] "
                    . "</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>    
    
<div class="col-4 mb-10 mt-30">
    <p>
        <b>Новая группа пользователей</b>
    </p>
    
    <form action="?">
        <input type="hidden" name="action" value="group">
        <input type="hidden" name="add" value="1">
        
        <div class="form-group">
          <label for="name">Название группы</label>
          <input type="text" name="name" class="form-control" id="name" required placeholder="Название группы">
        </div>
        <div class="form-group">
          <input type="submit" class="btn button" style="padding:10px; font-size: 18px" value="Создать">
        </div>
    </form>

</div>