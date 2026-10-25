<script src="/templates/<?php echo $template; ?>/modules/mailing/assets/js/groups.js"></script>

<div class="col-4">

    <form action="?" method="post">
        <input type="hidden" name="action" value="group">
        <input type="hidden" name="edit" value="<?php echo $var_group->id; ?>">
        <div class="form-group">
          <label for="name">Название группы</label>
          <input type="text" name="data[name]" class="form-control" id="name" required value="<?php echo htmlspecialchars($var_group->name); ?>">
        </div>
        <div class="form-group mt-30 mb-10">
          <input type="text" id="search" placeholder="Быстрый поиск" class="form-control">
        </div>
</div>
<div class="col-12 mb-10">

        <table id="users" class="table table-bordered">
            <thead>
                <Tr class="table_zagolovki">
                    <td>

                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        Имя
                    </td>
                    <td>
                        Дата регистрации
                    </td>
                    <td>
                        Баланс
                    </td>
                </tr>
            </thead>

            <tbody>

                <?php
                foreach ($var_group->getUsers() as $_user) {
                    echo "<tr><td> <input type=checkbox name=users[] value=" . $_user->id . " " . ($_user->in_group ? 'checked' : '') . "></td>";
                    echo "<td>" . $_user->email . "</td>";
                    echo "<td>" . $_user->name . "</td>";
                    echo "<td>" . $_user->date_registration . "</td>";
                    echo "<td>" . $_user->balance . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    
    <div class="form-group">
        <input type="submit" class="btn button" value="Сохранить"/>
    </div>    
    </form>
</div>