<?
if (!defined('GAME')) {
    die();
}
if ($u->room['file'] == 'ab/ahram') {
    ?>
    <script type="text/javascript" src="/js/jquery.locations.js"></script>
    <style type="text/css">

        .pH3 {
            COLOR: #8f0000;
            FONT-FAMILY: Arial;
            FONT-SIZE: 12pt;
            FONT-WEIGHT: bold;
        }

        .class_ {
            font-weight: bold;
            color: #C5C5C5;
            cursor: pointer;
        }

        .class_st {
            font-weight: bold;
            color: #659BA3;
            cursor: pointer;
        }

        .class__ {
            font-weight: bold;
            color: #FFFFFF;
            cursor: pointer;
            background-color: #659BA3;
        }

        .class__st {
            font-weight: bold;
            color: #FFFFFF;
            cursor: pointer;
            background-color: #659BA3;
            font-size: 10px;
        }

        .class_old {
            font-weight: bold;
            color: #919191;
            cursor: pointer;
        }

        .class__old {
            font-weight: bold;
            color: #FFFFFF;
            cursor: pointer;
            background-color: #838383;
            font-size: 10px;
        }

    </style>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="250" valign="top">
                <? $usee = $u->getInfoPers($u->info['id'], 0);
                if ($usee != false) {
                    echo $usee[0];
                } else {
                    echo 'information is lost.';
                } ?>
            </td>
            <td width="230" valign="top" style="padding-top:19px;padding-left: 4px;"><? include('modules_data/stats_loc.php'); ?></td>
            <td valign="top">
                <div align="right">
                    <? if ($u->error != '') {
                        echo '<font color="red"><b>' . $u->error . '</b></font>';
                    } ?>
                    <table width="500" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <td><div style="position:relative; cursor: pointer;" id="ione"> <img src="//img.testcombats.ru/city/ap_bg13_1.jpg" alt="" name="img_ione" width="500" height="268" border="1" id="img_ione"/>
                                    <div id="buttons_on_image"
                                         style="cursor:pointer; font-weight:bold; color:#D8D8D8; font-size:10px;">&nbsp;
                                        <span onmousemove="this.runtimeStyle.color = 'white';"
                                              onmouseout="this.runtimeStyle.color = this.parentElement.style.color;"
                                              onclick="window.open('//ourcombats.ru/forum', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')">Форум</span>
                                        &nbsp;
                                    </div>
                                    <script language="javascript" type="text/javascript">
                                        <!--
                                        if (document.getElementById('ione')) {
                                            document.getElementById('ione').appendChild(document.getElementById('buttons_on_image'));
                                            document.getElementById('buttons_on_image').style.position = 'absolute';
                                            document.getElementById('buttons_on_image').style.bottom = '8px';
                                            document.getElementById('buttons_on_image').style.right = '23px';
                                        } else {
                                            document.getElementById('buttons_on_image').style.display = 'none';
                                        }
                                        -->
                                    </script>
                                    <div style="position: absolute; left: 191px; top: 12px; width: 75px; height: 68px; z-index: 94;">
                                        <img onclick="location.href='main.php?talk=11'"
                                             src="//img.testcombats.ru/city/abp/ap_keeper1.gif" width="120" height="220"
                                             class="aFilter" title="Диалог с Арквиерро"/></div>
                                    <div style="position: absolute; left: 437px; top: 96px; width: 48px; height: 33px; z-index: 94;"><img <? thisInfRm('3.180.0.267'); ?> src="//img.testcombats.ru/city/ap_exit.gif" width="57" height="26" class="aFilter" /></div>
								<div style="position: absolute; left: 191px; top: 12px; width: 75px; height: 68px; z-index: 94;"></div>
								<div style="position: absolute; left: 30px; top: 127px; width: 48px; height: 33px; z-index: 94;"><img <? thisInfRm('3.180.0.486'); ?> src="//img.testcombats.ru/city/ap_altar1.gif" width="147" height="93" class="aFilter" /></div>
								<div style="position: absolute; left: 333px; top: 129px; width: 48px; height: 33px; z-index: 94;"><img <? thisInfRm('3.180.0.485'); ?> title="Алтарь Рун" src="//img.testcombats.ru/city/ap_altar2.gif" width="147" height="93" class="aFilter" /></div>
								<div style="position: absolute; left: 437px; top: 96px; width: 48px; height: 33px; z-index: 94;"><img <? thisInfRm('3.180.0.267'); ?> src="//img.testcombats.ru/city/ap_exit.gif" width="57" height="26" class="aFilter" /></div>



                                    <div id="snow"></div>
                                    <? echo $goline; ?> </div>
                            </td>
                        </tr>
                    </table>
                    <div style="display:none; height:0px " id="moveto"></div>
            </td>
            <td>
                <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
            </td>
        </tr>
    </table>
    <small>
        <BR>

        </div></td>
        </tr>
        </table>
    <?php
}