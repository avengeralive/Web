<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cc/a_clanreg')
{
	
// класс загрузки файлов 

class upload {
 
protected function __construct() { }
 
static $save_path = 'clan_prw/';
static $error = '';
 
static function saveimg($name,$max_mb = 2,$exts = 'jpg|png|jpeg|gif',$cnm = '',$mnw = 0,$mxw = 0,$mnh = 0,$mxh = 0) {
    if (isset($_FILES[$name])) {
        $f = &$_FILES[$name];
		
		if(isset($f['tmp_name'])) {
			$width = 0;
			$height = 0;
			list($width, $height) = getimagesize($f['tmp_name']);				
		}
		
        if( $mnw != 0 && $mnw > $width ) {
			self::$error = 'Минимальная ширина картинки '.$mnw.' пикселей. (Размер этой картинки '.$width.'x'.$height.')';
		}elseif( $mxw != 0 && $mxw < $width ) {
			self::$error = 'Максимальная ширина картинки '.$mxw.' пикселей. (Размер этой картинки '.$width.'x'.$height.')';
		}elseif( $mnh != 0 && $mnh > $height ) {
			self::$error = 'Минимальная высота картинки '.$mnh.' пикселей. (Размер этой картинки '.$width.'x'.$height.')';
		}elseif( $mxh != 0 && $mxh < $height ) {
			self::$error = 'Максимальная высота картинки '.$mxh.' пикселей. (Размер этой картинки '.$width.'x'.$height.')';
		}elseif (($f['size'] <= $max_mb*1024*1024) && ($f['size'] > 0)) {
            if (
                (preg_match('/\.('.$exts.')$/i',$f['name'],$ext))&&
                (preg_match('/image/i',$f['type']))
            ) {

		$ext[1] = strtolower($ext[1]);
                $fn = uniqid('f_',true).'.'.$ext[1];
                $fn2 = uniqid('f_',true).'.gif';
                if (move_uploaded_file($f['tmp_name'], self::$save_path . $fn)) {
                    // система изменения размера , требуется Rimage
                    //Rimage::resize(self::$save_path . $fn, self::$save_path . $fn2);
                    //@unlink(self::$save_path . $fn); // удаление файла
                    return array($fn2,$fn,self::$save_path . $fn);
                } else {
                    self::$error = 'Ошибка загрузки файла';
                }
            } else {
                self::$error = 'Неверный тип файла. Допустимые типы : <b>'.$exts.'</b>';
            }
        } else {
            self::$error = 'Неверный размер файла. Максимальный размер файла <b>'.$max_mb.' МБ</b>';
        }
    } else {
        self::$error = 'Файл не найден';
    }
    return false;
} // end saveimg
 
} // end class

$lzv = mysql_fetch_array(mysql_query('SELECT * FROM `_clan` WHERE `uid` = "'.$u->info['id'].'" AND `admin_time` = "0" LIMIT 1'));

/* Регистрация клана */
if(isset($_POST['clan_name'])) {
	/*if($_POST['clan_align'] != 0) {
		$_POST['clan_align'] = 0;
	}*/
	
	$tr_money = 0;
	if($_POST['clan_align'] == 1) {
		$tr_money = 5000;
		$_POST['clan_align'] = 1;
	}elseif($_POST['clan_align'] == 3) {
		$tr_money = 5000;
		$_POST['clan_align'] = 3;
	}elseif($_POST['clan_align'] == 7) {
		$tr_money = 5000;
		$_POST['clan_align'] = 7;
	}else{
		$tr_money = 2000;
		$_POST['clan_align'] = 0;
	}
	
	$clan_name = substr(htmlspecialchars($_POST['clan_name'],NULL,'cp1251'), 0, 30);
	
	$cnt = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `name` = "'.mysql_real_escape_string($clan_name).'" LIMIT 1'));
	
	if(isset($cnt['id'])) {
		$re = 'Клан с названием &quot;'.$cnt['name'].'&quot; уже зарегистрирован.';
	}elseif(true == false) {
		$re = 'Регистрация кланов временно не работает.';
	}elseif(isset($lzv['id'])) {
		$re = 'Вы уже подали заявку на регистрацию клана, ожидайте ответа от администрации';
	}elseif( $u->testAlign($_POST['clan_align'],$u->info['id']) == 0 ) {
		$re = 'Вы не можете зарегистрировать клан с данной склонностью. (Действует ограничение на выбор склонности для вашего персонажа)';
	}elseif($tr_money > $u->info['money']) {
		$re = 'У вас не хватает денег, требуется '.$tr_money.'кр.';
	}elseif($u->info['clan'] > 0){
		$re = 'Вы состоите в одном из кланов, требуется покинуть его';
	}elseif($u->info['align'] > 0){
		$re = 'Персонажи со склонностью не могут создавать клан, избавьтесь от неё';
	}else{
		/* заносим данные в базу */
		//$clan_name = str_replace('.','',$clan_name);
		//$clan_name = str_replace(' ','',$clan_name);
		//$clan_name = str_replace('	','',$clan_name);
		if(!preg_match("/^[-a-zA-Z0-9]+$/", $clan_name)) {
			$re = 'В названии клана присутствуют запрещенные символы.';
		}elseif($file = upload::saveimg('clan_img1',0.5,'gif',$clan_name,24,24,15,15)) {
			//if($file2 = upload::saveimg('clan_img2',0.5,'gif',$clan_name)) {
				if($tr_money < 0) {
					$tr_money = 0;
				}
				$u->info['money'] -= $tr_money;
				
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `_clan` (`uid`,`time`,`city`,`name`,`name2`,`site`,`img1`,`img2`,`info`,`money`,`align`) VALUES (
					"'.$u->info['id'].'","'.time().'",
					"'.$u->info['city'].'",
					"'.mysql_real_escape_string(htmlspecialchars($_POST['clan_name'],NULL,'cp1251')).'",
					"'.mysql_real_escape_string(htmlspecialchars($_POST['clan_name'],NULL,'cp1251')).'",
					"",
					"'.mysql_real_escape_string(htmlspecialchars($file[1],NULL,'cp1251')).'",
					"",
					"",
					"'.$tr_money.'",
					"'.mysql_real_escape_string(htmlspecialchars($_POST['clan_align'],NULL,'cp1251')).'"
				)');
				$lzv = array(
					'id' => mysql_insert_id(),
					'name' => htmlspecialchars($_POST['clan_name'],NULL,'cp1251'),
					'time' => time()
				);
				$re = 'Вы успешно подали заявку на регистрацию клана &quot;'.htmlspecialchars($_POST['clan_name'],NULL,'cp1251').'&quot;. ('.$tr_money.'кр.)';
			//}else{
			//	@unlink($file[2]); // удаление файла
			//	$re = 'Большой значок: '.upload::$error;
			//}
		}else{
			$re = 'Маленький значок: '.upload::$error;
		}
	}
}

?>
<style>
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div style="padding-left:0px;" align="center">
      <blockquote>
        <h3>Заявка на регистрацию клана</h3>
      </blockquote>
    </div>
        <?php
		if($re != '') {
			echo '<font style="float:left" color="red"><b>'.$re.'</b></font>';
		}
		?>
    </td>
    <td width="200"><div align="right">
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%">&nbsp;</td>
          <td><table  border="0" cellpadding="0" cellspacing="0">
              <tr align="right" valign="top">
                <td><!-- -->
                    <?php echo $goLis; ?>
                    <!-- -->
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
                            <tr>
                              <td bgcolor="#D3D3D3"><img src="//<?=$c['img'];?>/i/move/links.gif" width="9" height="7" /></td>
                              <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="javascript:void(0)" id="greyText" class="menutop" onClick="location='main.php?loc=1.180.0.11&rnd=<? echo $code; ?>';" title="<?php thisInfRm('1.180.0.11',1); ?>">Страшилкина улица</a></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
      </div></td>
  </tr>
</table>
<?php
if( $u->info['clan'] > 0 ) {
	$clan = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$u->info['clan'].'" LIMIT 1'));
?>
Вы уже состоите в клане <b><?=$clan['name']?></b> и не можете подать заявку на регистрацию нового клана.<br><br>
<fieldset style="line-height:1.5em;border-color:#fff;">  
	<legend><h3>Клановые войны</h3></legend>
    <?php
	if( $u->info['clan_prava'] == 'glava' ) {
		echo 'Нет ни одной войны, но вы можете обьявить её!';
	}else{
		echo 'Нет ни одной войны, но ваш глава клана может обьявить её!';
	}
	?>
</fieldset>
<?php }else{ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td>
	И так, Вы решили зарегистрировать новый клан БК.<br>
	Но прежде чем приступить к регистрации нового клана БК,ознакомьтесь,пожалуйста, со следующими рекомендациями:<br><br>

	Каждый клан БК является уникальным сообществом игроков БК,поэтому недопустимо связывать его прямо или косвенно с ныне существующими
	или уже распущенными кланами БК (плагиат),как в символике или в названии клана,
	так и в тексте девиза клана БК. <br>Большой (герб) и маленький значок должны быть выполнены в едином стиле.<br><br>
	Требования к значку: <br><br>
	• Большой значок (герб) - размер (ВxШ в пикселях) 100x99, графический тип - GIF, форма - КРУГ, фон за кругом прозрачный;</ul><br>
	• Маленький значок - размер (ВxШ в пикселях) 24x15, графический тип - GIF, фон прозрачный;<br><br>
	Недопустимыми в названии клана, его девизе и его значках являются:<br><br>
	• Служебные термины, используемые Администрацией для создания атмосферы мира, такие как: гвардия, ангелы, паладины, и так далее;<br>
	• Так как игровой мир клуба фэнтезийный, то название клана, его девиз и значки должны соответствовать игровому миру нашего БК;<br>
	• Игровой мир БК виртуальный, а потому не приветствуется использование государственной (гербы, флаги и т.п.), и не государственной (торговые марки, знаки, названия, и т.п.) символики, названия и произведения разного вида (стихи, высказывания, цитаты, литературные произведения и т.п.) из реального мира;<br>
	• Наличие грамматических и орфографических ошибок крайне нежелательно;<br>
	• Следите за логикой и не создавайте противоречий в девизе, названии и символике своего клана.<br>
	• Будьте вежливыми и терпимыми по отношению к другим участникам проекта БК, и не используйте в названии, девизе и символике своего клана то, что может быть истолковано, как оскорбление по отношению к другим пользователям.<br><br>
	
    <p>    
   	Стоимость регистрации кланов:<br>
    <img src="//<?=$c['img'];?>/i/align/align0.gif" width="12" height="15"> серый - 2000 кр.<br>
    <img src="//<?=$c['img'];?>/i/align/align7.gif" width="12" height="15"> нейтральный - 5000 кр.<br> 
    <img src="//<?=$c['img'];?>/i/align/align1.gif" width="12" height="15"> светлый - 5000 кр.<br> 
    <img src="//<?=$c['img'];?>/i/align/align3.gif" width="12" height="15"> тёмный - 5000 кр.<br> 
    </p>
    Заявка на регистрацию подает будущий глава клана, у которого должна быть при себе необходимая сумма.<br>
	Будущий глава клана должен пройти проверку на чистоту до подачи заявки на регистрацию клана.
	
    </td>
  </tr>
  <tr>
    <td><form action="main.php?go_psh=1" method="post" enctype="multipart/form-data" name="form1" id="form1">
       
        <?php if(!isset($lzv['id'])) { ?>
        Название клана (только английские буквы или цифры, одно слово): 
        <input class="rd4" name="clan_name" type="text" value="" size="50" maxlength="50" />
        <br />
        Девиз клана:
		<input class="rd4" name="" type="text" value="" width="450" height="300"  />
		</br>
        Значок:
        <input type="file"  name="clan_img1" id="clan_img1" />
        <br />
        Склонность клана 
        <select class="rd4" name="clan_align">
          <option value="0">серый (2000 кр.)</option>
          <option value="7">нейтральный (5000 кр.)</option>
          <option value="3">темный (5000 кр.)</option>
          <option value="1">светлый (5000 кр.)</option>
        </select>
        <br />
		Политика клана 
        <select class="rd4" name="clan_align">
          <option value="2">Анархия</option>
          <option value="0">Демократия</option>
          <option value="1">Диктатура</option>
          <option value="3">Монархия</option>
        </select>
        <br />
        <input type="submit" name="button" value="Подать заявку" />
        <?php }else{ ?>
        <?=date('d.m.Y H:i',$lzv['time'])?> &nbsp; &nbsp; Вы уже подали заявку на регистрацию клана &quot;<b><?=$lzv['name']?></b>&quot;. Ожидайте ответа от Администрации.
        <?php } ?>
    </form></td>
  </tr>
</table>

<p>Примечание:</p>
<p>
При подаче заявки с вас снимается сумма необходимая для регистрации клана.<br>
В случаи отказа в регистрации клана (по любой причине), кредиты возвращаются персонажу.<br>
Администрация вправе отказать в регистрации клана без объяснения причин.<br>



</p>
<?php
}

}
?>