<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->set('title_for_layout','Справочники'); ?>

<h1 style="text-align: center;">Справочники</h1>

<ul class="library">
	<li><img alt src="/img/cs.svg">
		<?php echo $this->Html->link('Регионы/районы', array('controller' => 'regions', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/cs.svg">
		<?php echo $this->Html->link('Органы управления ветеринарии', array('controller' => 'organs', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/cs.svg">
		<?php echo $this->Html->link('Учреждения ветеринарии', array('controller' => 'institutions', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/flask.svg">
		<?php echo $this->Html->link('Лаборатории ЛВСЭ', array('controller' => 'labs', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/flask.svg">
		<?php echo $this->Html->link('Ветеринарные лаборатории', array('controller' => 'vetlabs', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/flask.svg">
		<?php echo $this->Html->link('Убойные пункты', array('controller' => 'up', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/ib.svg">
		<?php echo $this->Html->link('Виды продукции', array('controller' => 'production_types', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/ib.svg">
		<?php echo $this->Html->link('Продукция', array('controller' => 'productions', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/ib.svg">
		<?php echo $this->Html->link('Продукция (отчет)', array('controller' => 'report_productions', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/ib.svg">
		<?php echo $this->Html->link('Причины обезвреживания (снятия с реализации)', array('controller' => 'ban_reasons', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/ib.svg">
		<?php echo $this->Html->link('Причины обезвреживания (отчет)', array('controller' => 'report_ban_reasons', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/ib.svg">
		<?php echo $this->Html->link('Снято с реализации', array('controller' => 'ban_types', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/ib.svg">
		<?php echo $this->Html->link('Снято с реализации (отчет)', array('controller' => 'report_ban_types', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/ib.svg">
		<?php echo $this->Html->link('Цель отбора проб', array('controller' => 'sample_purposes', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/bin.svg">
		<?php echo $this->Html->link('Выявления', array('controller' => 'detections', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/bin.svg">
		<?php echo $this->Html->link('Выявления (отчет)', array('controller' => 'report_detections', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/bin.svg">
		<?php echo $this->Html->link('Виды выявлений', array('controller' => 'detection_types', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/bin.svg">
		<?php echo $this->Html->link('Исследования', array('controller' => 'research_types', 'action' => 'index'));?>
	</li>
	<li><img alt src="/img/bin.svg">
		<?php echo $this->Html->link('Исследования (отчет)', array('controller' => 'report_researches', 'action' => 'index'));?>
	</li>
</ul>
