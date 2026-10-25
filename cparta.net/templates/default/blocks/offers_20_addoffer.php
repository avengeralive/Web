<form name="addoffer" id="addoffer" method="post" class="row" action="offers.php?<?php echo @$_SERVER['QUERY_STRING']?>">

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
                    <label class="" for=""><?php echo $loc['offers.php']['t213']; ?></label>                            
                    <select name="vladelec" class="form-control">
                        <?php
                        $sql_rekl = "SELECT * FROM users WHERE `tip`='40' AND `active`='1' AND `uroven_dostupa`='2' ORDER BY `email`";
                        $result_rekl = $mysqli->query($sql_rekl);
                        if (mysqli_num_rows($result_rekl) > 0) 
                                {
                                while($res_rekl=mysqli_fetch_array($result_rekl)) 
                                        {
                                        $rekl_id=htmlentities($res_rekl['id']);
                                        $rekl_email=htmlentities($res_rekl['email']);
                                        ?>
                                        <option value="<?php echo $rekl_id; ?>"><?php echo $rekl_email; ?></option>
                                        <?php
                                        }
                                }
                        else
                                {
                                ?>
                                <option value=""><?php echo $loc['offers.php']['t214']; ?></option>
                                <?php
                                }
                        ?>
                    </select>
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
                
                <div class="form-group">
                    <label class="" for="">Тип оффера</label>                            
                    <select name="type_offer" class="form-control">
                        <option value="1">Товарный</option>
                        <option value="2">Депозитный</option>
                        <option value="3">Инсталл</option>
                    </select>
                </div>
                
                <div class="form-group">
                  <label for="postclick"><?php echo $loc['offers.php']['t38']; ?></label>
                  <input type="text" class="form-control" name="postclick" id="postclick" >
                </div>   

                <div class="form-group">
                  <label for="hold"><?php echo $loc['offers.php']['t33']; ?></label>
                  <input type="text" class="form-control" maxlength="2" name="hold" id="hold" value="7">
                </div> 
                
                <div class="custom-control custom-checkbox mt-50 text-center">
                  <input type="checkbox" name="hidehold" class="custom-control-input" id="hidehold">
                  <label class="custom-control-label" for="hidehold">
                      <?php echo $loc['offers.php']['t231']; ?>
                  </label>
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

    <div class="col-12 mt-20">
        <div class="card" style="min-height: auto;">
            <div class="card-body">
                <p class="postTitle mb-20"><?php echo $loc['offers.php']['t41']; ?></p>
                <table class="offer_table2 table table-sm" id="geotraf">

                        <tr>
                            <td width="30%" class="align-middle"><?php echo $loc['offers.php']['t42']; ?></td>
                            <td width="30%" class="text-center align-middle"><?php echo $loc['offers.php']['t43']; ?></td>
                            <td width="40%" class="text-center align-middle">
                            <table class="table text-center table-sm">
                                <tr>
                                    <td class="align-middle" colspan="3"><?php echo $loc['offers.php']['r17']; ?></td>
                                </tr>
                                <tr>
                                    <td class="align-middle" style="font-size:11px;width:33%;"><?php echo $loc['offers.php']['t28']; ?></td>
                                    <td class="align-middle" style="font-size:11px;width:33%;"><?php echo $loc['offers.php']['r18']; ?></td>
                                    <td class="align-middle" style="font-size:11px;width:33%;"><?php echo $loc['offers.php']['t184']; ?></td>
                                </tr>	
                            </table>			
                            </td>
                        </tr>		

                        <tr id="geosp" data-nextcount="2">
                                <td class="align-middle" id="countryBlock">
                                        <?php
                                        echo '<select name="country[]" class="countrys" style="width: 200px;"><option value="0">'.$loc['offers.php']['r19'].'</option>';
                                        echo '</select>';
                                        ?>																		
                                </td>
                                <td class="text-center align-middle">
                                        <?php
                                        echo '<select name="region[]" class="regions" style="width: 200px; margin-left: 20px;"><option value="0">'.$loc['offers.php']['r19'].'</option>';
                                        echo '</select>';
                                        ?>
                                </td>
                                <td class="text-center align-middle">										
                                    <table style="width:100%;">
                                        <tr>
                                            <td style="border:none;width:33%;"><input type="text" name="cena[]" style="width: 50px; text-align: center;" maxlength="10" value="">&nbsp;<span class="curr"><?php echo $loc['offers.php']['t17']; ?></span>&nbsp;</td>
                                            <td style="border:none;width:33%;">
                                            <input type="text" name="comission[]" style="width: 50px; text-align: center;" maxlength="10" value=""> 
                                            <select name="tip_comission[]">
                                                <option value="1" <?php if (isset($offer_tip_comission) && $offer_tip_comission=='1') {?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t17']; ?>&nbsp;</option>
                                                <option value="2" <?php if (isset($offer_tip_comission) && $offer_tip_comission=='2') {?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t18']; ?>&nbsp;</option>
                                            </select>											
                                            </td>
                                            <td style="border:none;width:33%;">
                                            <input type="text" name="comission_cpa[]" style="width: 50px; text-align: center;" maxlength="10" value="">
                                            <select name="tip_comission_cpa[]">
                                                <option value="1" <?php if (isset($offer_tip_comission) && $offer_tip_comission==1) {?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t17']; ?>&nbsp;</option>
                                                <option value="2" <?php if (isset($offer_tip_comission) && $offer_tip_comission==2) {?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t18']; ?>&nbsp;</option>
                                            </select>											
                                            </td>
                                        </tr>										
                                    </table>
                                </td>

                        </tr>	
                </table>
                <table class="">
                    <tr>
                        <td><input type="button" value="Добавить страну" id="addCountryAdmin" class="btn button"></td>
                    </tr>							
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-12 form-group mt-35 text-center">
      <button type="submit" class="btn button" name="addoffer_submit"><?php echo $loc['button']['t01']; ?></button>
    </div>
    
</form>
<?php include_once './templates/'.$template.'/js/geo_spisok_js.php'; ?>
<script src="./templates/<?php echo $template; ?>/js/jquery.maskedinput.min.js"></script>
<script>
$(function() {
  $("#offers_end_date").mask("99.99.9999", {placeholder: "дд.мм.гггг" });
  $("#offers_end_time").mask("99:99", {placeholder: "чч:мм" });
});
</script>