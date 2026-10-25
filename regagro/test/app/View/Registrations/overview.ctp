<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Просмотр записи №'. $registration['Registration']['code'] .' от '. date_format(date_create($registration['Registration']['date']), 'd.m.Y H:i'), ''); ?>

<div class="row">
	<div class="col-md-12">
		<h2>
			<?php echo 'Просмотр записи №'. $registration['Registration']['code'] .' от '. date_format(date_create($registration['Registration']['date']), 'd.m.Y H:i') ?>
			
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-cog"></span> Редактировать запись',
			array('controller'=>'registrations', 'action'=>'edit', $registration['Registration']['id']),
			array('escape'=>false, 'class'=>'btn btn-primary','style'=>'float: right;')
		); ?>
		</h2>
	</div>
</div>

<table class="table table-hover table-bordered small super journal">
	<tr>
		<th colspan="4">Общие данные</th>
		<th colspan="3">Сопроводительный документ</th>
		<th colspan="4">Данные о происхождении продукции<br></th>
	</tr>
	<tr>
		<th>Код</th>
		<th>Дата</th>
		<th>Сотрудник</th>
		<th>Состояние транспорта</th>
		<th>Название</th>
		<th>Номер</th>
		<th>Дата</th>
		<th>Владелец</th>
		<th>Регион</th>
		<th>Район</th>
		<th>Нас. пункт</th>
	</tr>
	<tr>
		<td><?php echo $registration['Registration']['code']?></td>
		<td><?php echo date_format(date_create($registration['Registration']['date']), 'd.m.Y H:i')?></td>
		<td><?php echo $registration['User']['displayname']?></td>
		<td><?php echo $registration['Registration']['transport_condition']?></td>
		<td><?php echo $registration['Registration']['doc_form']?></td>
		<td><?php echo $registration['Registration']['doc_num']?></td>
		<td><?php echo $registration['Registration']['doc_date']?></td>
		<td><?php echo $registration['Registration']['owner']?></td>
		<td><?php echo $registration['Region']['name']?></td>
		<td><?php echo $registration['District']['name']?></td>
		<td><?php echo $registration['Registration']['locality']?></td>
	</tr>
</table>

<ul class="nav nav-tabs" role="tablist">
	<li class="active"><a href="#expertises" role="tab" data-toggle="tab">Экспертизы</a></li>
	<li><a href="#researches" role="tab" data-toggle="tab">Исследования</a></li>
	<li><a href="#bans" role="tab" data-toggle="tab">Снято с реализации</a></li>
	<li><a href="#distributions" role="tab" data-toggle="tab">Распределено по точкам</a></li>
	<li><a href="#samples" role="tab" data-toggle="tab">Отбор проб</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane fade in active" id="expertises">
		<table id="expertisesTable" class="table table-condensed table-hover table-bordered small tablesorter super journal">
			<thead>
				<tr>
					<th style="width:60px"><b>№</b></th>
					<th style="width:100px"><b>Продукция</b></th>
					<th style="width:60px"><b>Кол-во экспертиз</b></th>
					<th style="width:60px"><b>Наличие внутренних органов</b></th>
					<th style="width:95px"><b>Термическое состояние</b></th>
					<th style="width:80px"><b>Общий вес в кг (объем в л, яйцо в шт.)</b></th>
					<th style="width:60px"><b>Отработанный материал</b></th>
					<th style="width:100px"><b>Выявления</b></th>
					<th style="width:65px"><b>Сумма (руб.)</b></th>
					<th style="width:60px"><b>№ чека</b></th>
					<th style="width:60px"><b>Количество проб</b></th>
					<th style="width:95px"><b>Дата заключения</b></th>
					<th style="width:60px"><b>Номер заключения</b></th>
					<th style="width:60px"><b>Заключение</b></th>
					<th style="width:60px"><b>Выпущено без ограничений</b></th>
					<th style="width:60px"><b>Примечание</b></th>
					<th style="width:20px" class="sorter-false"></th>
				</tr>
			</thead>
			<?php
				foreach ($registration['Expertise'] as $exp) {
					echo '<tr>
						<td>'.$this->Html->link($registration['Registration']['code'].'/'.$exp['num'], array('controller'=>'expertises', 'action'=>'edit', $exp['id'])).'</td>
						<td><span>'.$exp['Production']['name'].'<br/>
						Изготовитель: '.$exp['manufacturer'].'
						<span></td>
						<td>'.$exp['count'].'</td>
						<td>'.($exp['viscera']?'Да':'Нет').'</td>
						<td>'.$exp['thermal_state'].'</td>
						<td>Отеч. пр-я: '.$this->Number->precision($exp['domestic_weight'],2).'<br />
						Зар. пр-я: '.$this->Number->precision($exp['foreign_weight'],2).'</td>
						<td>'.$exp['samples_weight'].'</td>
						<td>'.(count($exp['Detection'])>=1?implode(', ',Hash::extract($exp['Detection'],'{n}.name')):'').'</td>
						<td>'.$this->Number->precision($exp['price'],2).'</td>
						<td>'.$exp['check_number'].'</td>
						<td>'.$exp['samples_count'].'</td>
						<td>'.(isset($exp['conclusion_date'])?date_format(date_create($exp['conclusion_date']), 'd.m.Y'):'').'</td>
						<td>'.$exp['conclusion_number'].'</td>
						<td>'.(isset($exp['сonclusion'])?$exp['сonclusion']:'').'</td>
						<td>'.$exp['conclusion_weight'].'</td>
						<td>'.$exp['note'].'</td>
						<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>',
												array('controller'=>'expertises', 'action'=>'delete', $exp['id']),
												array('escape'=>false)).'</td>
					</tr>';
				}
			?>
		</table>
		<?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Добавить',
			array('controller'=>'expertises', 'action'=>'add', $registration['Registration']['id']),
			array('escape'=>false, 'class'=>'btn btn-primary')
		); ?>
	</div>
	<div class="tab-pane fade" id="researches">
		<table class="table table-hover table-bordered small tablesorter super journal">
			<thead>
				<tr>
					<th class="sorter-false"></th>
					<th><b>Продукция</b></th>
					<th><b>Вид исследований</b></th>
					<th><b>Количество исследований</b></th>
					<th><b>Результат исследований</b></th>
					<th><b>Показатели</b></th>
					<th><b>Подтверждение лаборатории</b></th>
					<th class="sorter-false"></th>
				</tr>
			</thead>
			<?php
				foreach ($registration['Research'] as $res) {
					echo '<tr>
						<td>'.$this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
							array('controller'=>'researches', 'action'=>'edit', $res['id']),
							array('escape'=>false)).'</td>
						<td>'.$res['Production']['name'].'</td>
						<td>'.$res['ResearchType']['name'].'</td>
						<td>'.$res['count'].'</td>
						<td>'.$res['research_result'].'</td>
						<td>'.$res['indicators'].'</td>
						<td>'.($res['confirmed']?'да':'нет').'</td>
						<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>',
							array('controller'=>'researches', 'action'=>'delete', $res['id']),
							array('escape'=>false)).'</td>
					</tr>';
				}
			?>
		</table>
		<?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Добавить',
			array('controller'=>'researches', 'action'=>'add', $registration['Registration']['id']),
			array('escape'=>false, 'class'=>'btn btn-primary')
		);?>
	</div>
	<div class="tab-pane fade" id="bans">
		<table class="table table-hover table-bordered small tablesorter super journal">
			<thead>
				<tr>
					<th class="sorter-false"></th>
					<th><b>Продукция</b></th>
					<th><b>Снятая продукция</b></th>
					<th><b>Вес снятой продукции в кг (объем в л, яйцо в шт.)</b></th>
					<th><b>Причины</b></th>
					<th><b>Примечание</b></th>
					<th><b>Порядок использования</b></th>
					<th class="sorter-false"></th>
				</tr>
			</thead>
			<?php
				foreach ($registration['Ban'] as $ban) {
					echo '<tr>
						<td>'.$this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
							array('controller'=>'bans', 'action'=>'edit', $ban['id']),
							array('escape'=>false)).'</td>
						<td>'.$ban['Production']['name'].'</td>
						<td>'.$ban['BanType']['name'].'</td>
						<td>'.$ban['weight'].'</td>
						<td>'.(isset($ban['BanReason']['name'])?$ban['BanReason']['name']:'').'</td>
						<td>'.$ban['note'].'</td>
						<td>'.$ban['use_order'].'</td>
						<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>',
							array('controller'=>'bans', 'action'=>'delete', $ban['id']),
							array('escape'=>false)).'</td>
					</tr>';
				}
			?>
		</table>
		<?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Добавить',
			array('controller'=>'bans', 'action'=>'add', $registration['Registration']['id']),
			array('escape'=>false, 'class'=>'btn btn-primary'));?> <?php
		echo $this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Акт выбраковки',
			array('controller'=>'registrations', 'action'=>'ban_doc', $registration['Registration']['id'], '?'=>array('date'=>date('U'))),
			array('escape'=>false, 'class'=>'btn btn-primary'))?>
		<a href='/files/vetsan.pps' class='btn btn-primary'><span class="glyphicon glyphicon-floppy-open"></span> Ветсаноценка</a>
	</div>
	<div class="tab-pane fade" id="distributions">
		<table class="table table-hover table-bordered small tablesorter super journal">
			<thead>
				<tr>
					<th class="sorter-false" style="width:140px"></th>
					<th><b>Торгующему</b></th>
					<th><b>Продукция</b></th>
					<th><b>Количество туш (тушек, партий, т/мест)</b></th>
					<th><b>Вес в кг (объем в л, яйцо в шт.)</b></th>
					<th><b>Количество мест</b></th>
					<th><b>Примечание</b></th>
					<th class="sorter-false"></th>
				</tr>
			</thead>
			<?php
				foreach ($registration['Distribution'] as $dis) {
					echo '<tr>
						<td buttons>'.$this->Html->link('<span class="glyphicon glyphicon-pencil"></span> Редактировать',
								array('controller'=>'distributions', 'action'=>'edit', $dis['id']),
								array('escape'=>false,'class'=>'btn btn-primary btn-xs', 'style'=>'margin-top: 4px;')).'<br>'.
							// $this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Заключение',
// 							array('controller'=>'registrations', 'action'=>'distributor_doc', $registration['Registration']['id'], $dis['distributor'], '?'=>array('date'=>date('U'))),
// 							array('escape'=>false, 'class'=>'btn btn-primary btn-xs', 'style'=>'margin-top: 4px;')).'<br>'.
							$this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Заключение',
							array('controller'=>'registrations', 'action'=>'distributor_doc', $registration['Registration']['id'], $dis['distributor'], '1', '?'=>array('date'=>date('U'))),
							array('escape'=>false, 'class'=>'btn btn-primary btn-xs', 'style'=>'margin-top: 4px;')).
						'</td>
						<td>'.$dis['distributor'].'</td>
						<td>'.$dis['Production']['name'].'</td>
						<td>'.$dis['count'].'</td>
						<td>'.$dis['weight'].'</td>
						<td>'.$dis['places'].'</td>
						<td>'.$dis['note'].'</td>
						<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>',
							array('controller'=>'distributions', 'action'=>'delete', $dis['id']),
							array('escape'=>false)).'</td>
					</tr>';
				}
			?>
		</table>
		<?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Добавить',
				array('controller'=>'distributions', 'action'=>'add', $registration['Registration']['id']),
				array('escape'=>false, 'class'=>'btn btn-primary'))?>

		<?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Автоматически',
				array('controller'=>'distributions', 'action'=>'autofill', $registration['Registration']['id']),
				array('escape'=>false, 'class'=>'btn btn-primary'))?>
	</div>
	<div class="tab-pane fade" id="samples">
		<table class="table table-hover table-bordered small tablesorter super journal">
			<thead>
				<tr>
					<th style="min-width:145px"><b>Код</b></th>
					<th><b>Продукция</b></th>
					<th><b>Вес партии</b></th>
					<th><b>Проба направляется в</b></th>
					<th><b>Нормативный документ</b></th>
					<th style="min-width:170px"><b>Пробы</b></th>
					<th style="min-width:170px"><b>Материалы</b></th>
					<th><b>Пробег</b></th>
					<th><b>Цели отбора проб</b></th>
					<th><b>Маркировка</b></th>
					<th><b>Хранение контрольной пробы</b></th>
					<th><b>Вид упаковки</b></th>
					<th><b>Номер печати, пломбы</b></th>
					<th class="sorter-false"></th>
				</tr>
			</thead>
			<?php
				foreach ($registration['Sample'] as $sam) {
					echo '<tr>
						<td>'.$this->Html->link($sam['code'],
							array('controller'=>'samples', 'action'=>'edit', $sam['id']),
							array('escape'=>false,'class'=>'btn btn-default btn-xs')).' '.
							$this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Направление',
							array('controller'=>'registrations', 'action'=>'sample_doc', $registration['Registration']['id'], $sam['id'], '?'=>array('date'=>date('U'))),
							array('escape'=>false, 'class'=>'btn btn-primary btn-xs')).'<br/>'.
							$this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Акт отбора проб',
							array('controller'=>'registrations', 'action'=>'sample_act_doc', $registration['Registration']['id'], $sam['id'], '?'=>array('date'=>date('U'))),
							array('escape'=>false, 'class'=>'btn btn-primary btn-xs', 'style'=>'margin: 4px 0 0px 0;')).
						'</td>
						<td>'.$sam['production'].'</td>
						<td>'.$sam['total_weight'].'</td>
						<td>'.$sam['Vetlab']['name'].'</td>
						<td>'.$sam['doc'].'</td>
						<td>
								Кол-во: '.$sam['count'].'<br/>
							Вес: '.$sam['samples_weight'].'</td>
						<td>Сейф-пакет: '.$sam['packages'].'<br/>
							Перчатки одноразовые: '.$sam['gloves'].'<br/>
							Бутылка пластиковая: '.$sam['bottles'].'<br/>
							Пластиковый контейнер: '.$sam['containers'].'<br/>
							Прочее: '.$sam['other'].'</td>
						<td>'.$sam['auto'].'</td>
						<td>';
												$first = true;
												foreach ($sam['SamplePurpose'] as $purpose) {
														echo ($first?'':';<br/>').($purpose['SampleSamplePurpose']['positive']?'&#9745;':'').$purpose['name'];
														$first = false;
												}
												echo '</td>
						<td>'.$sam['mark'].'</td>
						<td>'.$sam['control_sample'].'</td>
						<td>'.$sam['package_type'].'</td>
						<td>'.$sam['mark_number'].'</td>
						<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>',
							array('controller'=>'samples', 'action'=>'delete', $sam['id']),
							array('escape'=>false)).'</td>
					</tr>';
				}
			?>
		</table>
		<?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Добавить',
				array('controller'=>'samples', 'action'=>'add', $registration['Registration']['id']),
				array('escape'=>false, 'class'=>'btn btn-primary'))?>
	</div>	
</div>

<script type="text/javascript">
$(function () {
	//$('table').tablesorter();
});
</script>

