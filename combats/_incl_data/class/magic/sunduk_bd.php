<?
	if(!defined('GAME')) die();

	$i3 = array(4542=>1,3101=>1,4541=>4,5042=>10,3075=>1,4023=>100);//открытка, жажда жизни, благо звезд, Уник. тактика, Бутерброд, Восст. энергии 1500HP

	foreach($i3 as $gid=>$iznos) {$this->addItem($gid, $this->info['id'], '|nosale=1|notr=1|sudba='.$this->info['login'], NULL, $iznos);}

	if($io == '') $io = 'Какие-то предметы добавлены к Вам в инвентарь...';

	unset($i3);
?>