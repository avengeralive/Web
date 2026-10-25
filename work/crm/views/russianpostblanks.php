<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>


<form action="/json.php" method="post">
<div id="top">
	<h1>Персональные бланки
			<i class="pull-right">
				<input class="btn btn-primary add" type="submit" value="Сохранить">
			</i>
		<i>Персональные бланки</i>
   </h1>
</div>
<div style="display:none"><input type="hidden" value="ac20fd278a73d52f5b200a358daaa713e5d21386" name="YII_CSRF_TOKEN"></div><table id="lv-config-table" class="table table-bordered table-forms">
  <thead>
  <tr>
    <th>Название</th>
        <th>Значение</th>
    <th>Значение по умолчанию</th>
    <!--th></th-->
  </tr>
  </thead>
  <tbody>
      <tr class=" use">      <td>
        <b>Включить использование персональных бланков</b>
              </td>
            <td id="personalblanks_use_value">
        <input id="ytpersonalblanks_use" type="hidden" value="0" name="personalblanks.use"><input id="personalblanks_use" checked="checked" type="checkbox" value="1" name="personalblanks.use">      </td>
      <td>НЕТ</td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 1">      <td>
        <b>Название бланка #1</b>
              </td>
            <td id="personalblanks_1_blankName_value">
        <input id="personalblanks_1_blankName" class="span6" placeholder="" type="text" value="Обычная" name="personalblanks.1.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 1">      <td>
        <b>ID бланка #1</b>
              </td>
            <td id="personalblanks_1_blankId_value">
        <input id="personalblanks_1_blankId" class="span6" placeholder="" type="text" value="saletop1_4928" name="personalblanks.1.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 1">      <td>
        <b>Поля бланка #1</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_1_blankConfig_value">
        <textarea id="personalblanks_1_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.1.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 2">      <td>
        <b>Название бланка #2</b>
              </td>
            <td id="personalblanks_2_blankName_value">
        <input id="personalblanks_2_blankName" class="span6" placeholder="" type="text" value="Посылка нестандартная" name="personalblanks.2.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 2">      <td>
        <b>ID бланка #2</b>
              </td>
            <td id="personalblanks_2_blankId_value">
        <input id="personalblanks_2_blankId" class="span6" placeholder="" type="text" value="saletop1_5177" name="personalblanks.2.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 2">      <td>
        <b>Поля бланка #2</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_2_blankConfig_value">
        <textarea id="personalblanks_2_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.2.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 3">      <td>
        <b>Название бланка #3</b>
              </td>
            <td id="personalblanks_3_blankName_value">
        <input id="personalblanks_3_blankName" class="span6" placeholder="" type="text" value="Посылка Онлайн" name="personalblanks.3.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 3">      <td>
        <b>ID бланка #3</b>
              </td>
            <td id="personalblanks_3_blankId_value">
        <input id="personalblanks_3_blankId" class="span6" placeholder="" type="text" value="saletop1_5181" name="personalblanks.3.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 3">      <td>
        <b>Поля бланка #3</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_3_blankConfig_value">
        <textarea id="personalblanks_3_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.3.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 4">      <td>
        <b>Название бланка #4</b>
              </td>
            <td id="personalblanks_4_blankName_value">
        <input id="personalblanks_4_blankName" class="span6" placeholder="" type="text" value="Обычная+наложка фк" name="personalblanks.4.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 4">      <td>
        <b>ID бланка #4</b>
              </td>
            <td id="personalblanks_4_blankId_value">
        <input id="personalblanks_4_blankId" class="span6" placeholder="" type="text" value="saletop1_5223" name="personalblanks.4.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 4">      <td>
        <b>Поля бланка #4</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_4_blankConfig_value">
        <textarea id="personalblanks_4_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.4.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 5">      <td>
        <b>Название бланка #5</b>
              </td>
            <td id="personalblanks_5_blankName_value">
        <input id="personalblanks_5_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.5.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 5">      <td>
        <b>ID бланка #5</b>
              </td>
            <td id="personalblanks_5_blankId_value">
        <input id="personalblanks_5_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.5.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 5">      <td>
        <b>Поля бланка #5</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_5_blankConfig_value">
        <textarea id="personalblanks_5_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.5.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 6">      <td>
        <b>Название бланка #6</b>
              </td>
            <td id="personalblanks_6_blankName_value">
        <input id="personalblanks_6_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.6.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 6">      <td>
        <b>ID бланка #6</b>
              </td>
            <td id="personalblanks_6_blankId_value">
        <input id="personalblanks_6_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.6.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 6">      <td>
        <b>Поля бланка #6</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_6_blankConfig_value">
        <textarea id="personalblanks_6_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.6.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 7">      <td>
        <b>Название бланка #7</b>
              </td>
            <td id="personalblanks_7_blankName_value">
        <input id="personalblanks_7_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.7.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 7">      <td>
        <b>ID бланка #7</b>
              </td>
            <td id="personalblanks_7_blankId_value">
        <input id="personalblanks_7_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.7.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 7">      <td>
        <b>Поля бланка #7</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_7_blankConfig_value">
        <textarea id="personalblanks_7_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.7.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 8">      <td>
        <b>Название бланка #8</b>
              </td>
            <td id="personalblanks_8_blankName_value">
        <input id="personalblanks_8_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.8.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 8">      <td>
        <b>ID бланка #8</b>
              </td>
            <td id="personalblanks_8_blankId_value">
        <input id="personalblanks_8_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.8.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 8">      <td>
        <b>Поля бланка #8</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_8_blankConfig_value">
        <textarea id="personalblanks_8_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.8.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 9">      <td>
        <b>Название бланка #9</b>
              </td>
            <td id="personalblanks_9_blankName_value">
        <input id="personalblanks_9_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.9.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 9">      <td>
        <b>ID бланка #9</b>
              </td>
            <td id="personalblanks_9_blankId_value">
        <input id="personalblanks_9_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.9.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 9">      <td>
        <b>Поля бланка #9</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_9_blankConfig_value">
        <textarea id="personalblanks_9_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.9.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 10">      <td>
        <b>Название бланка #10</b>
              </td>
            <td id="personalblanks_10_blankName_value">
        <input id="personalblanks_10_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.10.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 10">      <td>
        <b>ID бланка #10</b>
              </td>
            <td id="personalblanks_10_blankId_value">
        <input id="personalblanks_10_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.10.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 10">      <td>
        <b>Поля бланка #10</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_10_blankConfig_value">
        <textarea id="personalblanks_10_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.10.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 11">      <td>
        <b>Название бланка #11</b>
              </td>
            <td id="personalblanks_11_blankName_value">
        <input id="personalblanks_11_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.11.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 11">      <td>
        <b>ID бланка #11</b>
              </td>
            <td id="personalblanks_11_blankId_value">
        <input id="personalblanks_11_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.11.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 11">      <td>
        <b>Поля бланка #11</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_11_blankConfig_value">
        <textarea id="personalblanks_11_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.11.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 12">      <td>
        <b>Название бланка #12</b>
              </td>
            <td id="personalblanks_12_blankName_value">
        <input id="personalblanks_12_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.12.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 12">      <td>
        <b>ID бланка #12</b>
              </td>
            <td id="personalblanks_12_blankId_value">
        <input id="personalblanks_12_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.12.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 12">      <td>
        <b>Поля бланка #12</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_12_blankConfig_value">
        <textarea id="personalblanks_12_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.12.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 13">      <td>
        <b>Название бланка #13</b>
              </td>
            <td id="personalblanks_13_blankName_value">
        <input id="personalblanks_13_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.13.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 13">      <td>
        <b>ID бланка #13</b>
              </td>
            <td id="personalblanks_13_blankId_value">
        <input id="personalblanks_13_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.13.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 13">      <td>
        <b>Поля бланка #13</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_13_blankConfig_value">
        <textarea id="personalblanks_13_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.13.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 14">      <td>
        <b>Название бланка #14</b>
              </td>
            <td id="personalblanks_14_blankName_value">
        <input id="personalblanks_14_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.14.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 14">      <td>
        <b>ID бланка #14</b>
              </td>
            <td id="personalblanks_14_blankId_value">
        <input id="personalblanks_14_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.14.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 14">      <td>
        <b>Поля бланка #14</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_14_blankConfig_value">
        <textarea id="personalblanks_14_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.14.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 15">      <td>
        <b>Название бланка #15</b>
              </td>
            <td id="personalblanks_15_blankName_value">
        <input id="personalblanks_15_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.15.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 15">      <td>
        <b>ID бланка #15</b>
              </td>
            <td id="personalblanks_15_blankId_value">
        <input id="personalblanks_15_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.15.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 15">      <td>
        <b>Поля бланка #15</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_15_blankConfig_value">
        <textarea id="personalblanks_15_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.15.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 16">      <td>
        <b>Название бланка #16</b>
              </td>
            <td id="personalblanks_16_blankName_value">
        <input id="personalblanks_16_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.16.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 16">      <td>
        <b>ID бланка #16</b>
              </td>
            <td id="personalblanks_16_blankId_value">
        <input id="personalblanks_16_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.16.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 16">      <td>
        <b>Поля бланка #16</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_16_blankConfig_value">
        <textarea id="personalblanks_16_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.16.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 17">      <td>
        <b>Название бланка #17</b>
              </td>
            <td id="personalblanks_17_blankName_value">
        <input id="personalblanks_17_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.17.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 17">      <td>
        <b>ID бланка #17</b>
              </td>
            <td id="personalblanks_17_blankId_value">
        <input id="personalblanks_17_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.17.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 17">      <td>
        <b>Поля бланка #17</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_17_blankConfig_value">
        <textarea id="personalblanks_17_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.17.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 18">      <td>
        <b>Название бланка #18</b>
              </td>
            <td id="personalblanks_18_blankName_value">
        <input id="personalblanks_18_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.18.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 18">      <td>
        <b>ID бланка #18</b>
              </td>
            <td id="personalblanks_18_blankId_value">
        <input id="personalblanks_18_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.18.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 18">      <td>
        <b>Поля бланка #18</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_18_blankConfig_value">
        <textarea id="personalblanks_18_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.18.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 19">      <td>
        <b>Название бланка #19</b>
              </td>
            <td id="personalblanks_19_blankName_value">
        <input id="personalblanks_19_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.19.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 19">      <td>
        <b>ID бланка #19</b>
              </td>
            <td id="personalblanks_19_blankId_value">
        <input id="personalblanks_19_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.19.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class="tr-odd 19">      <td>
        <b>Поля бланка #19</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_19_blankConfig_value">
        <textarea id="personalblanks_19_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.19.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 20">      <td>
        <b>Название бланка #20</b>
              </td>
            <td id="personalblanks_20_blankName_value">
        <input id="personalblanks_20_blankName" class="span6" placeholder="" type="text" value="" name="personalblanks.20.blankName">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 20">      <td>
        <b>ID бланка #20</b>
              </td>
            <td id="personalblanks_20_blankId_value">
        <input id="personalblanks_20_blankId" class="span6" placeholder="" type="text" value="" name="personalblanks.20.blankId">      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
      <tr class=" 20">      <td>
        <b>Поля бланка #20</b>
        <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Каждое поле нужно вводить с новой строки" data-original-title="" title="">
          </a>      </td>
            <td id="personalblanks_20_blankConfig_value">
        <textarea id="personalblanks_20_blankConfig" class="span6" rows="4" placeholder="" name="personalblanks.20.blankConfig"></textarea>      </td>
      <td></td>
      <!--<td><a class="icon-wrench" href=""></a></td>-->
    </tr>
    </tbody>
</table></form>