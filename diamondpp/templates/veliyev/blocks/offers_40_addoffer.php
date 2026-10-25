<div class="col-12">
<form name="addoffer" id="addoffer" method="post" action="offers.php?<?php echo @$_SERVER['QUERY_STRING']?>">
<div class="row mb-10">
    <div class="col-6">
        <div class="card" style="min-height: auto;">
            <div class="card-body">
                <p class="postTitle mb-20"><?php echo $loc['offers.php']['t122']; ?></p>
                
                <div class="form-group">
                  <label for="name"><?php echo $loc['offers.php']['t151']; ?></label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo $loc['offers.php']['t151']; ?>" required>
                </div>
                
                <div class="form-group">
                  <label for="url"><?php echo $loc['offers.php']['t152']; ?></label>
                  <input type="text" class="form-control" name="url" id="url" required>
                </div>
                  
                <div class="form-group">
                    <label class="" for=""><?php echo $loc['offers.php']['t30']; ?></label>                            
                    <select name="uroven_dostupa" class="form-control">
                    <?php
                    $sql_checkdostup = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `tip_account`='10'";
                    $result_checkdostup = $mysqli->query($sql_checkdostup);
                    if (mysqli_num_rows($result_checkdostup) > 0) 
                            {
                            while($res_checkdostup=mysqli_fetch_array($result_checkdostup))
                                    {
                                    $checkdostup_uroven_dostupa=htmlentities($res_checkdostup['uroven_dostupa']);
                                    $checkdostup_opisanie=htmlentities($res_checkdostup['opisanie']);
                                    ?>
                                    <option value="<?php echo $checkdostup_uroven_dostupa; ?>"><?php echo $checkdostup_opisanie; ?></option>
                                    <?php
                                    }
                            }
                    ?>	
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="" for=""><?php echo $loc['offers.php']['t31']; ?></label>                            
                    <select name="deystvie" class="form-control">
                    <?php			
                    // Выводим список целевых действий
                    // Display a list of targeted actions
                    $sql_deystvie = "SELECT id,deystvie FROM deystvie_tpl";
                    $result_deystvie = $mysqli->query($sql_deystvie);
                    if (mysqli_num_rows($result_deystvie) > 0) 
                            {
                            while($res_deystvie=mysqli_fetch_array($result_deystvie)) 
                                    { 
                                    $id_deystvie=htmlentities($res_deystvie['id']);
                                    $descr_deystvie=htmlentities($res_deystvie['deystvie']);
                                    ?><option value="<?php echo $id_deystvie; ?>"><?php echo $descr_deystvie; ?></option><?php
                                    }
                            }
                    ?>	
                    </select>
                </div>
                
                <input type="hidden" class="form-control" name="vladelec" value="<?php echo $user_id; ?>" >
                
                <div class="form-group">
                  <label for="cena">Цена товара</label>
                  <input type="text" class="form-control" name="cena" id="cena" >
                </div>   
                
                <div class="form-group">
                  <label for="comission">Комиссия партнеру</label>
                  <input type="text" class="form-control" name="comission" id="comission" >
                </div>   
                
                <div class="form-group">
                  <label for="postclick"><?php echo $loc['offers.php']['t38']; ?></label>
                  <input type="text" class="form-control" name="postclick" id="postclick" >
                </div>   

                
                
                
                
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <div class="card" style="min-height: auto;">
            <div class="card-body">
                <p class="postTitle mb-20"><?php echo $loc['offers.php']['t45']; ?></p>
                <table class="table">
                    <?php
                    $sql_tip_traffic = "SELECT * FROM tip_traffic_tpl ORDER BY `tip` ASC";
                    $result_tip_traffic=$mysqli->query($sql_tip_traffic);
                    if (mysqli_num_rows($result_tip_traffic) > 0) 
                            {
                            while ($res_tip_traffic=mysqli_fetch_array($result_tip_traffic)) 
                                    {
                                    $tip_traffic=htmlentities($res_tip_traffic['tip']);
                                    $id_tip_traffic=htmlentities($res_tip_traffic['id']);
                                    ?>
                                    <tr>
                                            <td><?php echo $tip_traffic; ?></td>
                                            <td><input name="tip_traffic<?php echo $id_tip_traffic; ?>" checked type="checkbox"></td>
                                    </tr>
                                    <?php
                                    }
                            }
                    ?>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-12 form-group mt-35 text-center">
      <button type="submit" class="btn button" name="addoffer_submit"><?php echo $loc['button']['t01']; ?></button>
    </div>
</div>
</form>
</div>
<?php include_once './templates/'.$template.'/js/geo_spisok_js.php'; ?>
<script src="./templates/<?php echo $template; ?>/js/jquery.maskedinput.min.js"></script>
<script>
$(function() {
  $("#offers_end_date").mask("99.99.9999", {placeholder: "дд.мм.гггг" });
  $("#offers_end_time").mask("99:99", {placeholder: "чч:мм" });
});
</script>