<?php
require_once('init.php');
$is_index = true;
$title = "Ассоциация Предприятий Индустрии Климата (АПИК)";
require_once("Polls.class.php");
$plh = new Polls();
?>
<?php /* ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<?php */ ?>
<?php
require_once ("header.php");
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td width="50%" valign="top">
                <?php 
				$top = array();
				$not_in = '';
   $news = $dbh->getArray('SELECT * FROM `apic_news` WHERE  `is_top` AND `is_active` = 1  ORDER BY `date` DESC LIMIT 0,3');
     if(is_array($news) && (count($news) > 0)) {
?>

 <table cellspacing=0 cellpadding=0 width=100% border=0>
                <tr>
                  <td><table cellspacing=0 cellpadding=0 width="100%" border=0>
                      <tbody>
                        <tr>
                          <td class=title-mainr id=dgray valign=bottom nowrap 
                bgcolor=#ffffff><img 
                  height=7 alt="" 
                  src="images/more_dred.gif" 
                  width=7 border=0>&nbsp;топ-новости&nbsp;</td>
                          <td width="99%" bgcolor=#ffffff>
                            <table height=9 cellspacing=0 cellpadding=0 width="100%" 
                  border=0>
                              <tbody>
                                <tr>
                                  <td height="9" bgcolor=#e23304><span 
                        class=rubrik>&nbsp;&nbsp;&nbsp;</span></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td valign=top bgcolor="#E23304"><img src="images/tp.gif" width="1" height="1"></td>
                </tr>
                <?php 
        $i = 1;
        $ncount = count($news);
		
        foreach($news as $new) { 
		   $top[] = $new['id'];
		?>
                <tr>
                  <td valign=top class="pad"><a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>" class="menu">
                    <?= $new['header'] ?>
                    </a>
                      <?php if($new['is_an'] && $new['announcement'])   { ?>
                      <br>
                      <a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>" class="small">
                      <?=  $new['announcement'] ?>
                      </a> <a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>"><img src="images/menu_folder.gif" alt="Подробнее" width="9" height="9" border="0"></a>                      <?php } ?>
                  </td>
                </tr>
                <?php if($i++ < $ncount) { ?>
                <tr>
                  <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td background="images/background_dots_horizontal.gif"><img src="images/tp.gif" alt="" width="1" height="1" border="0"></td>
                      </tr>
                  </table></td>
                </tr>
                <?php }} 
			  if (count($top) > 0) {
			       $not_in = ' AND id NOT IN('.join(',',$top).')';				   
			  }
			  unset($top);
                
                ?>
            </table>
<?php 
   $news = $dbh->getArray('SELECT * FROM `apic_news` WHERE  `is_active` = 1 and category_id = 2 '. $not_in.' ORDER BY `date` DESC LIMIT 0,2');
     if(is_array($news) && (count($news) > 0)) {
?>						  
              <table cellspacing=0 cellpadding=0 width=100% border=0>
                <tr>
                  <td><table cellspacing=0 cellpadding=0 width="100%" border=0>
                      <tbody>
                        <tr>
                          <td class=title-main id=dgray valign=bottom nowrap 
                bgcolor=#ffffff><img 
                  height=7 alt="" 
                  src="images/more_dgray.gif" 
                  width=7 border=0>&nbsp;Новости АПИК&nbsp;</td>
                          <td width="99%" bgcolor=#ffffff>
                            <table height=9 cellspacing=0 cellpadding=0 width="100%" 
                  border=0>
                              <tbody>
                                <tr>
                                  <td height="9" bgcolor=#336699><span 
                        class=rubrik>&nbsp;&nbsp;&nbsp;</span></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td valign=top bgcolor="#336699"><img src="images/tp.gif" width="1" height="1"></td>
                </tr>
				<?php 
        $i = 1;
        $ncount = count($news);
        foreach($news as $new) { ?>
                <tr>
                  <td valign=top class="pad"><a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>" class="menu"><?= $new['header'] ?></a>
				 <?php if($new['is_an'] && $new['announcement'])   { ?>
				 <br>
                  <a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>" class="small"><?=  $new['announcement'] ?></a>	<a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>"><img src="images/menu_folder.gif" alt="Подробнее" width="9" height="9" border="0"></a>                  <?php } ?>				  
				  </td>
                </tr>
				 <?php if($i++ < $ncount) { ?>
                <tr>
                  <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td background="images/background_dots_horizontal.gif"><img src="images/tp.gif" alt="" width="1" height="1" border="0"></td>
                      </tr>
                  </table></td>
                </tr>
				<?php }} ?>
              </table>
			  <?php } ?>		  
<?php 
   $news = $dbh->getArray('SELECT * FROM `news` WHERE  `is_active` = 1 ORDER BY `date` DESC LIMIT 0,5');
     if(is_array($news) && (count($news) > 0)) {
?>			
              <table cellspacing=0 cellpadding=0 width=100% border=0>
                <tr>
                  <td bgcolor="#336699"><table cellspacing=0 cellpadding=0 width="100%" border=0>
                      <tbody>
                        <tr>
                          <td class=title-main id=dgray valign=bottom nowrap 
                bgcolor=#ffffff><img 
                  height=7 alt="" 
                  src="images/more_dgray.gif" 
                  width=7 border=0>&nbsp;Новости членов АПИК&nbsp;</td>
                          <td width="99%" bgcolor=#ffffff>
                            <table height=9 cellspacing=0 cellpadding=0 width="100%" 
                  border=0>
                              <tbody>
                                <tr>
                                  <td height="9" bgcolor=#336699><span 
                        class=rubrik>&nbsp;&nbsp;&nbsp;</span></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>				
                <tr>
                  <td valign=top bgcolor="#336699"><img src="images/tp.gif" width="1" height="1"></td>
                </tr>
				<?php 
        $i = 1;
        $ncount = count($news);
        foreach($news as $new) { ?>
                <tr>
                  <td valign=top class="pad"><a href="news/full.php?firm=<?= $new['firm_id'] ?>&id=<?= $new['id'] ?>" class="menu"><?= $new['header'] ?></a>
				  </td>
                </tr>
				 <?php if($i++ < $ncount) { ?>
                <tr>
                  <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td background="images/background_dots_horizontal.gif"><img src="images/tp.gif" alt="" width="1" height="1" border="0"></td>
                      </tr>
                  </table></td>
                </tr>
				<?php }} ?>
              </table>
			  <?php } ?>

              <table cellspacing=0 cellpadding=0 width=100% border=0>
                <tr>
                  <td><table cellspacing=0 cellpadding=0 width="100%" border=0>
                      <tbody>
                        <tr>
                          <td class=title-main id=dgray valign=bottom nowrap 
                bgcolor=#ffffff><img 
                  height=7 alt="" 
                  src="images/more_dgray.gif" 
                  width=7 border=0>&nbsp;реклама &nbsp;</td>
                          <td width="99%" bgcolor=#ffffff>
                            <table height=9 cellspacing=0 cellpadding=0 width="100%" 
                  border=0>
                              <tbody>
                                <tr>
                                  <td height="9" bgcolor=#336699><span 
                        class=rubrik>&nbsp;&nbsp;&nbsp;</span></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td bgcolor="#336699"><img src="images/tp.gif" width="1" height="1"></td>
                </tr>
                <tr>
                  <td height="51"><img height=10 src="images/spacer.gif" 
            width=1><br>
                      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="240" height="100">
                        <param name="movie" value="240_100_podbor31.swf">
                        <param name="quality" value="high">
                        <embed src="240_100_podbor31.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="240" height="100"></embed>
                      </object></td>
                </tr>
              </table>
              <br>
<table cellspacing=0 cellpadding=0 width=100% border=0>
                <tr>
                  <td><table cellspacing=0 cellpadding=0 width="100%" border=0>
                      <tbody>
                        <tr>
                          <td class=title-main id=dgray valign=bottom nowrap 
                bgcolor=#ffffff><img 
                  height=7 alt="" 
                  src="images/more_dgray.gif" 
                  width=7 border=0>&nbsp;голосование&nbsp;</td>
                          <td width="99%" bgcolor=#ffffff>
                            <table height=9 cellspacing=0 cellpadding=0 width="100%" 
                  border=0>
                              <tbody>
                                <tr>
                                  <td height="9" bgcolor=#336699><span 
                        class=rubrik>&nbsp;&nbsp;&nbsp;</span></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td bgcolor="#336699"><img src="images/tp.gif" width="1" height="1"></td>
                </tr>
                <tr>
                  <td height="51">
				      <?php $plh->showCurrentPoll(); ?>
              </td>
                </tr>
              </table>
              <br>			                
      <?php 
        $vacs = $dbh->getArray('SELECT * FROM `vacancies` WHERE `term` >= NOW() AND `is_active` = \'1\' ORDER BY `id` DESC LIMIT 0,3');
        if(is_array($vacs) && (count($vacs) > 0)) {       
       ?>  
              <table cellspacing=0 cellpadding=0 width=100% border=0>
                <tr>
                  <td><table cellspacing=0 cellpadding=0 width="100%" border=0>
                      <tbody>
                        <tr>
                          <td class=title-main id=dgray valign=bottom nowrap 
                bgcolor=#ffffff><img 
                  height=7 alt="" 
                  src="images/more_dgray.gif" 
                  width=7 border=0>&nbsp;вакансии членов АПИК&nbsp;</td>
                          <td width="99%" bgcolor=#ffffff>
                            <table height=9 cellspacing=0 cellpadding=0 width="100%" 
                  border=0>
                              <tbody>
                                <tr>
                                  <td height="9" bgcolor=#336699><span 
                        class=rubrik>&nbsp;&nbsp;&nbsp;</span></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td valign=top bgcolor="#336699"><img src="images/tp.gif" width="1" height="1"></td>
                </tr>
				<?php 
        $i = 1;
        $ncount = count($news);
         foreach($vacs as $vac) { ?>
                <tr>
                  <td valign=top class="pad"><a href="job/index.php?firm=<?= $vac['firm_id'] ?>#v<?= $vac['id'] ?>" class="menu"><?= $vac['position'] ?></a></td>
                </tr>
				 <?php if($i++ < $ncount) { ?>
                <tr>
                  <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td background="images/background_dots_horizontal.gif"><img src="images/tp.gif" alt="" width="1" height="1" border="0"></td>
                      </tr>
                  </table></td>
                </tr>
				<?php }} ?>
              </table>
			  <?php } ?>			  			  
          </td>
          <td width="50%" valign="top">
<?php 
   $news = $dbh->getArray('SELECT * FROM `apic_news` WHERE  `is_active` = 1 and category_id = 1  '. $not_in.' ORDER BY `date` DESC LIMIT 0,13');
     if(is_array($news) && (count($news) > 0)) {
 } 		  
			  ?>		  
            <table cellspacing=0 cellpadding=0 width=100% border=0>
                <tr>
                  <td><table cellspacing=0 cellpadding=0 width="100%" border=0>
                      <tbody>
                        <tr>
                          <td class=title-main id=dgray valign=bottom nowrap 
                bgcolor=#ffffff><img 
                  height=7 alt="" 
                  src="images/more_dgray.gif" 
                  width=7 border=0>&nbsp;Мировые новости&nbsp;</td>
                          <td width="99%" bgcolor=#ffffff>
                            <table height=9 cellspacing=0 cellpadding=0 width="100%" 
                  border=0>
                              <tbody>
                                <tr>
                                  <td height="9" bgcolor=#336699><span 
                        class=rubrik>&nbsp;&nbsp;&nbsp;</span></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td valign=top bgcolor="#336699"><img src="images/tp.gif" width="1" height="1"></td>
                </tr>
				<?php 
        $i = 1;
        $ncount = count($news);
        foreach($news as $new) { ?>
                <tr>
                  <td valign=top class="pad"><a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>" class="menu"><?= $new['header'] ?></a>
				 <?php if($new['is_an'] && $new['announcement'])   { ?>
				 <br>
                  <a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>" class="small"><?=  $new['announcement'] ?></a>	<a href="apic-news/full.php?categ=<?= $new['category_id'] ?>&id=<?= $new['id'] ?>"><img src="images/menu_folder.gif" alt="Подробнее" width="9" height="9" border="0"></a>                  <?php } ?>				  
				  </td>
                </tr>
				 <?php if($i++ < $ncount) { ?>
                <tr>
                  <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td background="images/background_dots_horizontal.gif"><img src="images/tp.gif" alt="" width="1" height="1" border="0"></td>
                      </tr>
                  </table></td>
                </tr>
				<?php }} ?>
            </table>
			  <?php } ?>		  </td>
        </tr>
      </table>
        <p>&nbsp;</p></td>
    <td width="120" align="center" valign="top" bgcolor="#e3e3e3" style="border-right:#FFFFFF 1px solid"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="120" height="600">
        <param name="movie" value="banners/mir_klimata_120_600.swf">
        <param name="quality" value="high">
        <embed src="banners/mir_klimata_120_600.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="120" height="600"></embed>
      </object>
    </td>
  </tr>  
  <tr>
    <td align="center" valign="bottom" bgcolor="#e3e3e3" style="border-right:#FFFFFF 1px solid">&nbsp;</td>
    <td align="center" valign="bottom" bgcolor="#e3e3e3" style="border-right:#FFFFFF 1px solid">
    <?php require_once ("banners.php"); ?>
    </td>
  </tr>   
</table>
<?php
require_once ("footer.php");
?>