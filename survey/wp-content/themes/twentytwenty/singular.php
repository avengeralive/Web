<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
$questions = get_field('voprosy', get_the_ID());
$sh1 = 0;
$sh2 = 0;
$sh3 = 0;
?>
<style>
		.tbl { display: none; } .t0 { display: block; }
		.disabled {pointer-events:none; color: #ccc;}
		.card { max-width: 80%;
    margin: 50px auto;
    padding: 50px;
    background: #fff;
    box-shadow: 5px 5px 15px 5px rgba(105, 105, 105, 0.08);
}
.button {
    margin: 50px auto 0px;
    display: block;
    max-width: 300px;
    width: 100%;
}
@media(max-width: 768px) {
    .card { max-width: 90%;
        margin: 20px auto;
        padding: 20px;
    }
}
#site-content { background: #f5f4f0 !important; }
	</style>
<?
if ($_POST['question']) {
foreach ($_POST['question'] as $key => $answer) {
	if ($questions[$key]['shkala'] == 'Эмоциональное истощение') $sh1+=$answer[0];
	if ($questions[$key]['shkala'] == 'Деперсонализация') $sh2+=$answer[0];
	if ($questions[$key]['shkala'] == 'Редукция профессионализма') $sh3+=$answer[0];
}
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<main id="site-content" role="main">
    <div class="card">
	<? if ($_POST['question']) { ?>
	<p style="font-weight: bold;">Спасибо за прохождение опроса! Ваш результат:</p>
	<!--<p><span style="color:#42C46D">Спасибо</span><br><span style="color:#fff;">за внимание!</span></p>-->
	<? if ($sh1 <= 15) { ?>
	<p>Ваш уровень эмоционального истощения: <span style="font-weight: bold; color: #42C46D;">низкий</span> (<?=$sh1;?> при среднем результате в 19,73)</p>
	<? } else if ($sh1 > 15 && $sh1 <= 24) { ?>
	<p>Ваш уровень эмоционального истощения: <span style="font-weight: bold; color: #FF9800;">средний</span> (<?=$sh1;?> при среднем результате в 19,73)</p>
	<? } else if ($sh1 > 24) { ?>
	<p>Ваш уровень эмоционального истощения: <span style="font-weight: bold; color: #f10757;">высокий</span> (<?=$sh1;?> при среднем результате в 19,73)</p>
	<? } ?>
	
	<? if ($sh2 <= 5) { ?>
	<p>Ваш уровень деперсонализации: <span style="font-weight: bold; color: #42C46D;">низкий</span> (<?=$sh2;?> при среднем результате в 7,78)</p>
	<? } else if ($sh2 > 5 && $sh2 <= 10) { ?>
	<p>Ваш уровень деперсонализации: <span style="font-weight: bold; color: #FF9800;">средний</span> (<?=$sh2;?> при среднем результате в 7,78)</p>
	<? } else if ($sh2 > 10) { ?>
	<p>Ваш уровень деперсонализации: <span style="font-weight: bold; color: #f10757;">высокий</span> (<?=$sh2;?> при среднем результате в 7,78)</p>
	<? } ?>
	
	<? if ($sh3 <= 30) { ?>
	<p>Ваш уровень редукции профессионализма: <span style="font-weight: bold; color: #f10757;">высокий</span> (<?=$sh3;?> при среднем результате в 32,93)</p>
	<? } else if ($sh3 > 30 && $sh3 <= 36) { ?>
	<p>Ваш уровень редукции профессионализма: <span style="font-weight: bold; color: #FF9800;">средний</span> (<?=$sh3;?> при среднем результате в 32,93)</p>
	<? } else if ($sh3 > 36) { ?>
	<p>Ваш уровень редукции профессионализма: <span style="font-weight: bold; color: #42C46D;">низкий</span> (<?=$sh3;?> при среднем результате в 32,93)</p>
	<? } ?>
	<p>Оценка уровней выгорания:</p>
	<table>
		<tr>
			<th>Субшкала</th>
			<th>Низкий уровень</th>
			<th>Средний уровень</th>
			<th>Высокий уровень</th>
		</tr>
		<tr>
			<td>Эмоциональное истощение (среднее - 19,73)</td>
			<td>0-15</td>
			<td>16-24</td>
			<td>25 и больше</td>
		</tr>
		<tr>
			<td>Деперсонализация (среднее - 7,78)</td>
			<td>0-5</td>
			<td>6-10</td>
			<td>11 и больше</td>
		</tr>
		<tr>
			<td>Редукция профессионализма (среднее - 32,93)<sup>*</sup></td>
			<td>37 и больше</td>
			<td>31-36</td>
			<td>30 и меньше</td>
		</tr>
	</table>
	<p>Источник: Водопьянова Н.Е. Старченкова Е.С. Синдром выгорания: диагностика и профилактика. - СПб.: Питер, 2008. - 358 с.</p>
	<p><sup>*</sup><small>Этому пункту соответствуют вопросы такого типа, что чем больше баллов набирает респондент, тем меньше уровень редукции профессионализма</small></p>
	<? } else { ?>
	
	<form method="POST">
	<?
		foreach ($questions as $key => $question) { 
	?>
		<div class="tbl t<?=$key;?>" style="position:relative;">
		    <div class="progress_bar" style="background: #31345c;width:100%;height:30px;margin-bottom:20px;">
		        <div class="prog" style="position: relative;height:30px;background: #59ca7a; color: #fff; padding: 0 5px;width:<?=ceil(($key)/count($questions)*100);?>%;"><p style="width:100px;position:absolute;"><?=ceil(($key)/count($questions)*100);?>%</p></div>
		    </div>
		<p style="font-weight: bold; color: #42C46D;"><?=$key+1;?>. <?=$question['vopros'];?></p>
			<? if ($question['tip_voprosa'] == 'Прямой') { ?>
			<label><input type="radio" name="question[<?=$key;?>][]" value="0" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Никогда</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="1" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Очень редко</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="2" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Редко</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="3" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Иногда</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="4" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Часто</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="5" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Очень часто</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="6" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Каждый день</label>
			<? } else { ?>
			<label><input type="radio" name="question[<?=$key;?>][]" value="6" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Никогда</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="5" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Очень редко</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="4" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Редко</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="3" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Иногда</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="2" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Часто</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="1" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Очень часто</label>
			<label><input type="radio" name="question[<?=$key;?>][]" value="0" onclick="$('.b<?=$key;?>').removeClass('disabled');"> Каждый день</label>
			<? } ?>
		<? if ($key < count($questions) - 1) { ?><a class="button b<?=$key;?> disabled" onclick="jQuery('.tbl').hide(); jQuery('.t<?=$key+1;?>').show(); return false;">Далее</a><? } else { ?>
			<button class="button b<?=$key;?> disabled">Отправить</button>
		<? } ?>
		</div>
	<?
		}
	?>
	<? } ?>
	</form>
	</div>
</main><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
