<link rel="stylesheet" type="text/css" href="./templates/default/css/daterangepicker.css" />
<script type="text/javascript" src="/templates/default/js/jquery.form.min.js"></script>
<script type="text/javascript" src="/templates/default/js/bootstrap.typehead.js"></script>
<script type="text/javascript" src="/templates/default/js/moment.min.js"></script>
<script src="/templates/default/js/range.js"></script>
<script src="/templates/<?php echo $template; ?>/modules/bookkeeper/assets/js/list.js"></script>

<style>

    .dropdown-menu {
        font-size: 14px;
    }
    
    .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {
        color: #fff;
        text-decoration: none;
        background-color: #337ab7;
        outline: 0;
    }
    .dropdown-menu > li > a {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
    }
    
    #js-result table{
        width: 100%;
        margin-top:20px;
        background: #fafafa;
        
    }
    #js-result table td, #js-result table th{
        background: white;
        padding: 5px;
        font-size: 80%;
        
    }
    #js-result table td{
        border:1px solid #f0f0f0;
    }
    #js-result table th{
        padding: 10px;
        background: #dae8ff;
        border-bottom: 2px solid #a3c6fc;
        font-size: 90%;
            
    }
    
    .col-lg-12{
        width: 100%;
        float: left;
    }
    .col-lg-6{
        width: 49%;
        float: left;
        box-sizing: border-box;
        border: 1px solid #9e9ea6;
        border-radius: 10px;
        margin-right: 1%;
        height: auto;
    }
    .form-group{
        width: 100%;
        clear: both;
        margin-bottom: 10px;
    }
    .form-group label{

        width: 200px;
        float: left;
        display: block;
    }
    .form-control{
        width: 300px;
        padding: 3px;
        box-sizing: border-box;

    }
    #js-result tr.details td {
        background: #d0d0d0;
        font-size: 75%;
    }
    #js-result table tr.date td{
        background: white;
        border-bottom: 1px solid #ccc;
        
    }
    tr.date.active td{
        background: #ffffcc !important;
    }

</style>

<div class="row main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25">Бухгалтерия</p></div>

    <div class="col-12">
        
<div class="pull-left col-lg-6" style="background: #fafafa;padding:10px; height: auto;">
    <h4>Выборка:</h4>
    <form action="?" id='js-form' method="post">
        <input type="hidden" name="action" value="search">
        
        <div class="form-group">
            <label>Период:</label>
            <input type="text" name=dates class="form-control autosubmit" id="datepicker">
        </div>
        <?php
        if($user_tip == 70){
        ?>
        <div class="form-group">
            <label>Тип:</label>
            <select name="type" class="form-control autosubmit">
                <option value="0">Все</option>
                <option value="10">Расход</option>
                <option value="40">Приход</option>
            </select>

        </div>

        <div class="form-group">
            <label>Пользователь:</label>
            <input type="text" autocomplete="off" class="form-control" id="users">
            <input name=userid type="text" class="form-control autosubmit" id="users-value" style="display: none">
        </div>

        <?php
        }
        ?>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php
            if($user_tip == 70){
            ?>
            <button class="btn btn-info" name='action' value='run'>Показать</button>
            <?php
            }
            ?>
        </div>
    </form>
</div>

<div class="pull-left col-lg-6" style="background: #fafafa;padding:10px; height: auto;">
    <h4>Выгрузка в Excel:</h4>
    <form action="?" method="post">
        <input type="hidden" name="action" value="excel">
        
        <div class="form-group">
            <label>Период:</label>
            <input type="text" name=dates class="form-control autosubmit" id="datepicker2">
        </div>
        <?php
        if($user_tip == 70){
        ?>
        <div class="form-group">
            <label>Тип:</label>
            <select name="type" class="form-control autosubmit">
                <option value="0">Все</option>
                <option value="10">Расход</option>
                <option value="40">Приход</option>
            </select>

        </div>

        <div class="form-group">
            <label>Пользователь:</label>
            <input type="text" autocomplete="off" class="form-control" id="users">
            <input name=userid type="text" class="form-control autosubmit" id="users-value" style="display: none">
        </div>

        <?php
        }
        ?>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php
            if($user_tip == 70){
            ?>
            <button class="btn btn-info">Выгрузить в excel</button>
            <?php
            }
            ?>
        </div>
    </form>
</div>
        
        
        
        <?php
        if($user_tip == 70){
        ?>
<div class="pull-left col-lg-6" style="background: #fafafa;padding:10px;">
    <h4>Создать операцию:</h4>
    <form action="?" id='js-form-create' method="post">
        <input type="hidden" name="action" value="run">


        <div class="form-group">
            <label>Пользователь:</label>
            <input type="text" autocomplete="off"  required="" class="form-control" id="users-create">
            <input name=userid type="text" class="form-control autosubmit" id="users-value-create" style="display: none">
        </div>
        <div class="form-group">
            <label>Сумма:</label>
            <input type="text" value="0" required="" class="form-control" name="amount">
        </div>
        <div class="form-group">
            <label>Тип операции:</label>
            <select class="form-control" required="" name="type">
                <option value="">Выбрать</option>
                <option value="-4">Вывод средств из системы</option>
                <option value="2">Пополнение баланса</option>
                <option value="-20">Снятие с баланса</option>
                <option value="-30">Снятие с реферального баланса</option>
            </select>

        </div>     
        <div class="form-group">
            <label>Комментарий:</label>
            <input name=comments type="text" required="" class="form-control" placeholder="Номер кошелька, иная причина">
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <button class="btn" onclick="if($('#users-value-create').val()=='') return alert('Нужно выбрать пользователя'); $('#confirm').show();
                    setTimeout(function () {
                        $('#confirm').hide()
                    }, 2000);" type="button" >Создать</button>
            <button class="btn btn-warning" style="display:none" id=confirm type="submit" name='action' value='run'>Подтвердить операцию</button>

        </div>
    </form>
</div>
        <?php
        }
        ?>

</div> 
    
<div class="col-12">    
    <div id='js-result'>

    </div>
</div>
    
</div>
<div class="row main mt-50 mb-50">

    

     
    
<div class="col-12">    
<table class="table">
    <tr>
        <th>Вебмастер</th>
        <th>Баланс</th>
        <th>Заработано</th>
        <th>Выведено</th>
    </tr>
<?php

$sql_users = "SELECT id, email, balance FROM users WHERE tip = 10";
$result_users = $mysqli->query($sql_users);
while($res_users=mysqli_fetch_array($result_users))  {
    $sql_finances = "SELECT SUM(summ) as total FROM finances_log WHERE operation = 1 AND `user_id`=".$res_users['id'];
    $result_finances = $mysqli->query($sql_finances);
    $res_finances=mysqli_fetch_array($result_finances);

    $sql_finances = "SELECT SUM(summ) as total FROM finances_log WHERE operation = 2 AND `user_id`=".$res_users['id'];
    $result_finances = $mysqli->query($sql_finances);
    $res_finances2=mysqli_fetch_array($result_finances);
    ?>
    <tr>
        <td><?php echo $res_users['id']; ?>, <?php echo $res_users['email']; ?></td>
        <td><?php echo $res_users['balance']; ?></td>
        <td><?php echo ($res_finances['total'])?$res_finances['total']:0; ?></td>
        <td><?php echo ($res_finances2['total'])?$res_finances2['total']:0; ?></td>
    </tr>
    <?php
}
?>
</table>
</div>
    
</div>
