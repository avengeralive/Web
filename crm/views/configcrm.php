<?php 
namespace lib;
    if ((!in_array('stat', $RoleGroup) && !in_array('stat', $RoleUser)) || (!in_array('tech', $RoleGroup) && !in_array('tech', $RoleUser)) ) die();
    ?>
    <div id="top">
	<h1>Выгрузка заказов в Excel-файл
    	<i>Выгрузка заказов в Excel-файл</i>
    </h1>
    </div>
    <form action="lib/save_excel.php" method="post" name="saveExcel">
        <div class="alert alert-info">
            <div class="frm2" style="column-count: 8;-moz-column-count: 8;-webkit-column-count: 8;">
                <?php
                $connect = JBase::Get_Data('list17','*',1);
                $result = $connect->fetch_assoc();
                foreach ($result as $key => $value) {
                    if($key === 'russianpostTrack' || $key === 'goods_names' || $key === 'time' || $key === 'name') echo '<input type="checkbox" name="'.$key.'" checked>  
                    <b>'.$key.'</b><br>';
                    else echo '<input type="checkbox" name="'.$key.'">  
                    <b>'.$key.'</b><br>';

                }
                ?>

            </div>
        </div>
        <div class="alert alert-info">
            <div class="frm2" style="column-count: 8;-moz-column-count: 8;-webkit-column-count: 8;">
                <p>Выберите группу статусов<font color="red">*</font>
                <select name="status_list" id="status_list" style="height:40px;">
                    <option value="no">- Не выбрано -</option>
                    <option value="all">Все статусы</option>
                    <option value="list14">Ошибка/Спам/Дубль</option>
                    <option value="list15">Возврат</option>
                    <option value="list16">Отменен</option>
                    <option value="list17">Обработка</option>
                    <option value="list18">Принят</option>
                    <option value="list19">Отправлен</option>
                    <option value="list20">Оплачен</option>
                </select></p>
                <p>Выберите по какой дате
                <select name="date_list" id="date_list" style="height:40px;">
                    <option value="time">Дата создания</option>
                    <option value="approvedAt">Дата подтверждения</option>
                    <option value="shippedAt">Дата отправки</option>
                    <option value="canceledAt">Дата отмены</option>
                    <option value="buyoutAt">Дата выкупа</option>
                    <option value="refundedAt">Дата возврата</option>
                </select></p>
                <p>Выберите дату От:<br>
                <input type="date" name="first_date" id="first_date" placeholder="10.10.2020" ></p>
                До:<br>
                <input type="date" name="last_date" id="last_date" placeholder="10.10.2020" >
                <p>Выберите товар
                <select name="goods_names" id="goods_names" style="height:40px;">
                    <option value="no">- Не выбрано -</option>
                    <?php
                        // $goods_name = JBase::Get_Data('list22','*',1);
                        $QQ = "SELECT * FROM list22 ORDER BY BINARY(lower(name))";
                        $goods_name = JBase::Query($QQ);
                        while($res = $goods_name->fetch_assoc()){
                            echo '<option value="'.$res['id'].'">'.$res['name'];
                        }
                    ?>
                </select></p>
            </div>
        </div>
        <center><input type="submit" class="btn-primary" name='btn' id="btn" value="Скачать" style="display:none;width:100px;height:30px;"></center>
    </form>
    <script>
        var flag = {status_list:false,first_date:false,last_date:false};
        var first_date = $('#first_date');
        var last_date = $('#last_date');
        first_date.change(function(){
            if((first_date.val() != '' && last_date.val() == '') || (last_date.val() != '' && first_date.val() == '')){
               flag.first_date = false;
               flag.last_date = true;
               flagStart(flag,first_date,last_date);
            }else{
                flag.first_date = true;
                flag.last_date = true;
                flagStart(flag,first_date,last_date);
            }
        });
        last_date.change(function(){
            if((last_date.val() != '' && first_date.val() == '') || (first_date.val() != '' && last_date.val() == '')){
                flag.last_date = false;
                flag.first_date = true;
                flagStart(flag,first_date,last_date);
            }else{
                flag.last_date = true;
                flag.first_date = true;
                flagStart(flag,first_date,last_date);
            }
        });
        $( "#status_list" ).change(function() {
            if($(this).val() != 'no'){
                // $("#btn").css({'display':'inline-block'});
                flag.status_list = true;
                flagStart(flag,first_date,last_date);
            }else{
                flag.status_list = false;
                flagStart(flag,first_date,last_date);
                // $("#btn").css({'display':'none'});
            }
        });
        if(flag.status_list === true){
            if(flag.first_date == flag.last_date){
                $("#btn").css({'display':'inline-block'});
            }else{
                $("#btn").css({'display':'none'});
            }
        }

        function flagStart(flag,first_date,last_date){
            // alert('status = '+flag.status+' first_date = "('+first_date.val()+')'+flag.first_date+'" last_date = ('+last_date.val()+')'+flag.last_date+'"');
            if(flag.status_list === true){
                if(flag.first_date == flag.last_date){
                    $("#btn").css({'display':'inline-block'});
                }else{
                    $("#btn").css({'display':'none'});
                }
            }
        }
    </script>