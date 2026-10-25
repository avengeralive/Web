<?
if(!defined('GAME')) { die(); }

class battleClass {

    public function maginfoattack( $u1 , $u2 , $type )
	{
        /* 1 - огонь,
		2 - воздух,
		3 - вода,
		4 - земля */
		//Визуализация урона

		//Подавление защиты в зависимости от уровня игрока
		if($this->users[$this->uids[$u1]]['level']==8)  $level_koef = 1.00;
        elseif($this->users[$this->uids[$u1]]['level']==9)   	$level_koef = 1.00;
        elseif($this->users[$this->uids[$u1]]['level']==10)  	$level_koef = 1.00;
        elseif($this->users[$this->uids[$u1]]['level']>=11) 	$level_koef = 1.00;
		else $level_koef = 1;

		$v_l = str_replace(' ','&nbsp;',$this->users[$this->uids[$u1]]['login']);
        $v_z = 0+$this->stats[$this->uids[$u2]]['zm'.$type]; //защита цели
        $v_p = floor(0+($this->stats[$this->uids[$u1]]['pzm'.$type] + $this->stats[$this->uids[$u1]]['pzm'])/$level_koef); //подавление защиты от магии
        $v_m = 0+$this->stats[$this->uids[$u1]]['pm'.$type]; //мощность мага
        $r = ' magelogin='.$v_l.' onMouseOver=top.hi(this,maginfo('.$v_z.','.$v_p.','.$v_m.',this),event,3,1,1,1,null); onMouseOut=top.hic(); onMouseDown=top.hic(); ';

        return $r;
    }

    public $contr_mf = false;
	public $mncolor = array(1=>'006699',2=>'006699',3=>'006699',4=>'006699',5=>'006699',6=>'006699',7=>'006699'); //не крит
    public $mcolor = array(1=>'A00000',2=>'008080',3=>'0000FF',4=>'A52A2A',5=>'006699',6=>'006699',7=>'006699'); //не крит
    public $mname = array('огонь' => 1 , 'вода' => 3 , 'воздух' => 2 , 'земля' => 4 , 'свет' => 5 , 'тьма' => 6 , 'серая' => 7 );
    public $prm = array(
        /* act:	1 - когда персонаж получает повреждение
					2 - когда персонаж наносит удар
			type_of:	1 - уворот
						2 - крит
						3 - атака
						4 - защита
						5 - прочее */
        1   => array( 'name'	=> 'Прикрыться', 'act'	=> 1 , 'type_of' => 5 ),
        2   => array( 'name'	=> 'Вломить', 'act'	=> 2 , 'type_of' => 3 ),
        4   => array( 'name'	=> 'Сильный удар', 'act' => 2 , 'type_of' => 3 ),
        7   => array( 'name'	=> 'Активная защита', 'act'	=> 1 , 'type_of' => 4 ),


        290   => array('name'	=> 'Вытягивание души', 'act'	=> 1 , 'type_of' => 4 ),

        //Излом хаоса
        291 => array( 'name'	=> 'Грация Боя', 'act' => 2, 'type_of' => 4 ),

        //Канализация
        294	=> array( 'name'	=> 'Зловонная Вода', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
        295	=> array( 'name'	=> 'Проткнуть', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
        296	=> array( 'name'	=> 'Гнилая Кровь', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
        297 => array( 'name'	=> 'Собраться', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
        298   => array( 'name'	=> 'Приказ Слабости', 'act'	=> 2 , 'type_of' => 3 ),

        141 => array( 'name'	=> 'Призрачная защита', 'act' => 2, 'type_of' => 4 ),
        147 => array( 'name'	=> 'Призрачный кинжал', 'act' => 2, 'type_of' => 4 ),
        148 => array( 'name'	=> 'Призрачный топор', 'act' => 2, 'type_of' => 4 ),
        149 => array( 'name'	=> 'Призрачный удар', 'act' => 2, 'type_of' => 4 ),
        150 => array( 'name'	=> 'Призрачное лезвие', 'act' => 2, 'type_of' => 4 ),
       	

        142 => array( 'name'	=> 'Призрачный огонь', 'act' => 2, 'type_of' => 4 ),
        144 => array( 'name'	=> 'Призрачный воздух', 'act' => 2, 'type_of' => 4 ),
        146 => array( 'name'	=> 'Призрачная земля', 'act' => 2, 'type_of' => 4 ),
        145 => array( 'name'	=> 'Призрачная вода', 'act' => 2, 'type_of' => 4 ),

        8   => array( 'name'	=> 'Танец ветра', 'act'	=> 1 , 'type_of' => 1 ),
        9	=> array( 'name'	=> 'Дикая удача', 'act'	=> 2 , 'type_of' => 3 ),
        10  => array( 'name'	=> 'Предвидение', 'act'	=> 1 , 'type_of' => 1 ),
        11  => array( 'name'	=> 'Удачный удар', 'act' => 2 , 'type_of' => 3 ),

        45  => array( 'name'	=> 'Полная защита', 'act' => 1, 'type_of' => 4 ),

        47  => array( 'name'	=> 'Слепая удача', 'act'	=> 2 , 'type_of' => 2 ),
        48  => array( 'name'	=> 'Танец лезвий', 'act'	=> 1 , 'type_of' => 1 ),
        49  => array( 'name'	=> 'Второе дыхание', 'act'	=> 1 , 'type_of' => 1 ),
        138 => array( 'name'	=> 'Сокрушающий удар', 'act'	=> 2 , 'type_of' => 3 ),
        140 => array( 'name'	=> 'Абсолютная защита', 'act' => 1 , 'type_of' => 4 ),
        193 => array( 'name'	=> 'Усиленные удары', 'act' => 2 , 'type_of' => 3 ),
        204 => array( 'name'	=> 'Обречённость', 'act'	=> 2 , 'type_of' => 0 ),
        211 => array( 'name'	=> 'Агрессивная защита', 'act' => 1 , 'type_of' => 4 ),
        213 => array( 'name'	=> 'Коварный Уход', 'act'	=> 1 , 'type_of' => 4 ),
        215 => array( 'name'	=> 'Скрытая ловкость', 'act'	=> 1 , 'type_of' => 1 ),
        216 => array( 'name'	=> 'Скрытая сила', 'act'	=> 2 , 'type_of' => 2 ),
        217 => array( 'name'	=> 'Разгадать тактику', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
        219 => array( 'name'	=> 'Точный удар', 'act' => 2 , 'type_of' => 3 ),
        220 => array( 'name'	=> 'Ставка на опережение', 'act'	=> 2 , 'type_of' => 0 ),
        222 => array( 'name'	=> 'Последний удар', 'act'	=> 2 , 'type_of' => 3 ),
        225 => array( 'name'	=> 'Магическая защита', 'act' => 1 , 'type_of' => 4 ),
        226 => array( 'name'	=> 'Возмездие', 'act' => 1 , 'type_of' => 4 ),
		231 => array( 'name'	=> 'Глухая защита', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
		234 => array( 'name'	=> 'Осторожность', 'act' => 2, 'type_of' => 4 ),
        235 => array( 'name'	=> 'Шокирующий удар', 'act'	=> 2 , 'type_of' => 3 ),
        189 => array( 'name'	=> 'Ошеломить', 'act'	=> 2 , 'type_of' => 3 ),
        342   => array( 'name' => 'Круговая Защита', 'act' => 0 , 'type_of' => 0 ),
        343   => array( 'name' => 'Натиск', 'act' => 0 , 'type_of' => 0 ),
        344 => array( 'name'	=> 'Украсть душу', 'act' => 2, 'type_of' => 5 ),

        237 => array( 'name'	=> 'Разведка боем', 'act'	=> 2 , 'type_of' => 3 /*, 'moment' => 3*/ ),

        239 => array( 'name'	=> 'Поступь смерти [9]', 'act' => 2 , 'type_of' => 3 ),
        450 => array( 'name'	=> 'Поступь смерти [7]', 'act' => 2 , 'type_of' => 3 ),
        240	=> array( 'name'	=> 'Хлебнуть крови', 'act' => 2 , 'type_of' => 5 )

        //Оледенение
    ,21	=> array( 'name'	=> 'Оледенение [4]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,73	=> array( 'name'	=> 'Оледенение [5]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,74	=> array( 'name'	=> 'Оледенение [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,75	=> array( 'name'	=> 'Оледенение [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,76	=> array( 'name'	=> 'Оледенение [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,77	=> array( 'name'	=> 'Оледенение [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,78	=> array( 'name'	=> 'Оледенение [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,79	=> array( 'name'	=> 'Оледенение [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )

        //Отравление
    ,22	=> array( 'name'	=> 'Отравление [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,80	=> array( 'name'	=> 'Отравление [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,81	=> array( 'name'	=> 'Отравление [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,82	=> array( 'name'	=> 'Отравление [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,83	=> array( 'name'	=> 'Отравление [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,84	=> array( 'name'	=> 'Отравление [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )

        //Регенерация
    ,36	=> array( 'name'	=> 'Регенерация [5]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,85	=> array( 'name'	=> 'Регенерация [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,86	=> array( 'name'	=> 'Регенерация [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,87	=> array( 'name'	=> 'Регенерация [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,88	=> array( 'name'	=> 'Регенерация [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,89	=> array( 'name'	=> 'Регенерация [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,90	=> array( 'name'	=> 'Регенерация [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )

        //Ядовитое облако
    ,23	=> array( 'name'	=> 'Ядовитое Облако [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,70	=> array( 'name'	=> 'Ядовитое Облако [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,71	=> array( 'name'	=> 'Ядовитое Облако [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,72	=> array( 'name'	=> 'Ядовитое Облако [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )

        //Иней
    ,269 => array( 'name'	=> 'Иней [7]', 'act' => 2, 'type_of' => 9 )
    ,276 => array( 'name'	=> 'Иней [8]', 'act' => 2, 'type_of' => 9 )
    ,277 => array( 'name'	=> 'Иней [9]', 'act' => 2, 'type_of' => 9 )

        //Духи Льда
    ,270 => array( 'name'	=> 'Духи Льда', 'act'	=> 2 , 'type_of' => 5 , 'type_sec' => 5 )

        //Хватка Льда
    ,280 => array( 'name'	=> 'Хватка Льда', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )

        //Жертва Воде
    ,281 => array( 'name'	=> 'Жертва Воде', 'act' => 2, 'type_of' => 5 )

        //Ледяное спасение
    ,282 => array( 'name'	=> 'Ледяное Спасение', 'act' => 2, 'type_of' => 5 )

        //Медитация
    ,24 => array( 'name'	=> 'Медитация', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 )

        //Магический барьер
    ,210 => array( 'name'	=> 'Магический Барьер [4]', 'act' => 2, 'type_of' => 8 )
    ,209 => array( 'name'	=> 'Магический Барьер [7]', 'act' => 2, 'type_of' => 8 )
    ,208 => array( 'name'	=> 'Магический Барьер [8]', 'act' => 2, 'type_of' => 8 )
    ,207 => array( 'name'	=> 'Магический Барьер [9]', 'act' => 2, 'type_of' => 8 )
    ,206 => array( 'name'	=> 'Магический Барьер [10]', 'act' => 2, 'type_of' => 8 )
    ,284 => array( 'name'	=> 'Магический Барьер [11]', 'act' => 2, 'type_of' => 8 )

        //Силовое поле
    ,175 => array( 'name'	=> 'Магический Барьер [7]', 'act' => 2, 'type_of' => 8 )
    ,176 => array( 'name'	=> 'Магический Барьер [8]', 'act' => 2, 'type_of' => 8 )
    ,177 => array( 'name'	=> 'Магический Барьер [9]', 'act' => 2, 'type_of' => 8 )
    ,178 => array( 'name'	=> 'Магический Барьер [10]', 'act' => 2, 'type_of' => 8 )
    ,179 => array( 'name'	=> 'Магический Барьер [11]', 'act' => 2, 'type_of' => 8 )

        //Метеорит
    ,42		=> array( 'name'	=> 'Метеорит [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,121	=> array( 'name'	=> 'Метеорит [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,122	=> array( 'name'	=> 'Метеорит [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,123	=> array( 'name'	=> 'Метеорит [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,124	=> array( 'name'	=> 'Метеорит [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,125	=> array( 'name'	=> 'Метеорит [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
	,116	=> array( 'name'	=> 'Булыжник [11]', 'act'	=> 2 , 'type_of' => 1 )
        //Каменный Щит
    ,249 => array( 'name'	=> 'Каменный Щит', 'act' => 2, 'type_of' => 4 )
	//,254 => array( 'name'	=> 'Каменный Щит', 'act' => 2, 'type_of' => 4 )
        //Песчанный щит
    ,248 => array( 'name'	=> 'Песчаный Щит', 'act' => 2, 'type_of' => 4 )

        //Заземление
    ,251 => array( 'name'	=> 'Заземление: Плюс', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,252 => array( 'name'	=> 'Заземление: Минус', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )

        //Туманный образ
    ,273 => array( 'name'	=> 'Туманный Образ [10]', 'act'	=> 1 , 'type_of' => 4 )
    ,286 => array( 'name'	=> 'Туманный Образ [9]', 'act'	=> 1 , 'type_of' => 4 )
    ,287 => array( 'name'	=> 'Туманный Образ [8]', 'act'	=> 1 , 'type_of' => 4 )
    ,288 => array( 'name'	=> 'Туманный Образ [7]', 'act'	=> 1 , 'type_of' => 4 )

    ,255 => array( 'name'	=> 'Воздушный Щит', 'act' => 2, 'type_of' => 8 )

        //Пещерные приемы
    ,337 => array( 'name'	=> 'Выпить Душу', 'act'	=> 2 , 'type_of' => 5 )

        //Пожирающее Пламя
    ,33	=> array( 'name'	=> 'Пожирающее Пламя [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,56	=> array( 'name'	=> 'Пожирающее Пламя [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,57	=> array( 'name'	=> 'Пожирающее Пламя [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,58	=> array( 'name'	=> 'Пожирающее Пламя [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,59	=> array( 'name'	=> 'Пожирающее Пламя [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,60	=> array( 'name'	=> 'Пожирающее Пламя [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )

        //Огненный Щит
    ,245 => array( 'name'	=> 'Огненный Щит', 'act' => 2, 'type_of' => 9 )
       
	   //Эффекты
    ,327	=> array( 'name'	=> 'Живая Вода', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 )
    ,328 => array( 'name'	=> 'Сушеный Мухомор', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,329 => array( 'name'	=> 'Мешочек Пыли', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,330 => array( 'name'	=> 'Отвар когтей ПГ', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,331 => array( 'name'	=> 'Отвар Василиска', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
        //1 сентября, квест
    ,299 => array( 'name'	=> 'Ядовитые язвы', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,300 => array( 'name'	=> 'Элементарный заряд', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,301 => array( 'name'	=> 'Темное ранение', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,302 => array( 'name'	=> 'Подлечиться', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,303 => array( 'name'	=> 'Шкура поглощения', 'act' => 2, 'type_of' => 4 )
    ,304 => array( 'name'	=> 'Особенное проклятье!', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    ,305 => array( 'name'	=> 'Кровожадность', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
    );


    public function hphe( $uid , $hp , $false_t7 = false ) {
        global $u;
        if( !isset($this->stats[$this->uids[$uid]]) ) {
            echo 'WARNING! ОШИБКА! ПОТЕРЯНА ПЕРЕМЕННАЯ ЗДОРОВЬЯ ПЕРСОНАЖА!';
        }else{
            $hpnow = floor($this->stats[$this->uids[$uid]]['hpNow']);
            $hpall = $this->stats[$this->uids[$uid]]['hpAll'];
            if( $hp > 0 ) {
                //Хиляем
                if( $hpnow + $hp > $hpall ) {
                    $hpli = $hpnow+$hp-$hpall;
                    $hp -= $hpli;
                }
                if( isset($this->stats[$this->uids[$uid]]['min_heal_proc']) && $this->stats[$this->uids[$uid]]['min_heal_proc'] < -99 ) {
                    $hp = 0;
                }else{
                    $hp = $hp/100*(100+$this->stats[$this->uids[$uid]]['min_heal_proc']);
                }
                //Отнимаем тактику
                if( $false_t7 == false ) {
                    if( $this->users[$this->uids[$uid]]['tactic7'] <= 0 ) {
                        $hp = 0;
                        $this->users[$this->uids[$uid]]['tactic7'] = 0;
                        $this->stats[$this->uids[$uid]]['tactic7'] = $this->users[$this->uids[$uid]]['tactic7'];
                    }else{
                        $gdhh = round($hp/$this->stats[$this->uids[$uid]]['hpAll']*10,2);
                        if($gdhh > 0)$gdhd = round($this->users[$this->uids[$uid]]['tactic7']/$gdhh*100);
                        //else $gdhd = 0;
                        $this->users[$this->uids[$uid]]['tactic7'] = round(($this->users[$this->uids[$uid]]['tactic7']-$gdhh),2);
                        if( $this->users[$this->uids[$uid]]['tactic7'] < 0 ) {
                            $this->users[$this->uids[$uid]]['tactic7'] = 0;
                        }
                        $this->stats[$this->uids[$uid]]['tactic7'] = $this->users[$this->uids[$uid]]['tactic7'];
                        if( $gdhd < 100 ) {
                            $hp = floor($hp/100*$gdhd);
                        }
                    }
                }
            }elseif( $hp < 0 ) {
                //Отнимаемф
                if( $hpnow + $hp < 0) {
                    $hpli = $hpnow + $hp;
                    $hp += -($hpli);
                }
            }

            if( $this->stats[$this->uids[$uid]]['hpNow'] < 1 ) {
                $hp = 0;
            }

            $this->stats[$this->uids[$uid]]['last_hp'] = -$hp;
            mysql_query('UPDATE `stats` SET
			`last_hp` = "'.$this->users[$this->uids[$uid]]['last_hp'].'",
			`tactic7` = "'.$this->users[$this->uids[$uid]]['tactic7'].'"
			WHERE `id` = "'.$uid.'" LIMIT 1');

        }

        return floor($hp);
    }

    public function deleffm($pid , $uid , $id)
	{
        if( $id > 0 )
		{
            if(!mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.mysql_real_escape_string($id).'" AND `v1` = "priem" AND `v2` != "0" LIMIT 1'))
			{
                echo '[*Ошибка удаления прием['.$id.','.$pid.','.$uid.']]';
            }
        }else{
            	if(!mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `v1` = "priem" AND `v2` = "'.$pid.'"'))
				{
                	//echo '[*Ошибка удаления прием['.$id.','.$pid.','.$uid.']]';
            	}
        	}
        //if($pid==219) unset($this->stats[$this->uids[$uid]]['pza']);//не раб
    }


    public $e,                 //Ошибка (текст)
        $cached = false,	   //Кэширование данных
        $expCoef    = 1	,    # % опыта в бою
        $aBexp      = 0,    //Добавочный опыт в боях
        $mainStatus = 1,    //Отображаем главное окно (1 - можно бить, 2 - ожидаем ход противника, 3 - Проиграли. Ожидаем завершения поединка)
        $info = array(),    //Информация о поединке
        $users = array(),   //Информация о пользователях в этом бою
        $stats = array(),   //Информация о статах пользователей в этом бою
        $uids = array(),    //Список пользователей и их id в stats или users пример id пользователя = 555 , то $uids[555] выдаст его порядковый номер в массиве users \ stats
        $atacks = array(),  //Список ударов в этом бою (действующих)
        $ga = array(),      //Список uid кто нанес удар и по кому  $ga[ {id кто ударил} ][ {id кого ударил} ]
        $ag = array(),      //Список uid кто нанес удар и по кому  $ga[ {id кого ударили} ][ {id кто ударил} ]
        $na = 1,            //возможность использовать удар
        $np = 1,            //возможность использовать приемы
        $nm = 1,            //возможность использовать заклятия
        $hodID = 0,
        $stnZbVs = 0,
        $bots = array(),    // ID ботов
        $iBots = array(),   // i бота
        $stnZb = array(),
        $uAtc = array('id'=>0,'a'=>array(1=>0,2=>0,3=>0,4=>0,5=>0),'b'=>0), //Если игрок нанес удар
        $lg_itm = array(0 => array('грудью','ребром руки','лбом','кулаком','ногой','левой ногой','правой ногой','коленом'),1 => array('ножом','тыльной стороной лезвия ножа','рукоятью ножа','лезвием ножа'),2 => array('сучковатой палкой','поленом','тяжелой дубиной','дубиной','рукоятью молота'),3 => array('секирой','топором','лезвием секиры','алебардой','тяжелым держаком','длинной секирой'),4 => array('ножнами','гардой','мечом','лезвием меча','рукоятью меча','тупым лезвием','острой стороной меча','огромным мечом'),5 => array('сучковатой палкой','посохом','тяжелой тростью','корявым посохом','основанием посоха'), 22=> array('костылем')), // Чем лупили
        $lg_zon = array(1 => array ('в нос','в глаз','в челюсть','по переносице','в кадык','по затылку','в правый глаз','в левый глаз','в скулу'),2 => array ('в грудь','в корпус','в солнечное сплетение','в сердце','в область лопаток'),3 => array ('в бок','по желудку','по левой руке','по правой руке'),4 => array ('по <вырезано цензурой>','в пах','в промежность','по левой ягодице','по правой ягодице'),5 => array ('по ногам','в область правой пятки','в область левой пятки','по коленной чашечке','по икрам')); // Куда лупили
    public $is = array(),$items = array();

    //Очистка кэша - cbcntvf кеширования статов для GetStats! - сейчас не используется
    public $uclearc = array(),$ucleari = array();
    public function clear_cache($uid)
	{
        if( $uid > 0 && !isset($this->uclearc[$uid]) ) {
            $this->uclearc[$uid] = true;
            $this->ucleari[] = $uid;
        }
    }

    public function clear_cache_start()
	{
        $i = 0;
        while( $i < count($this->ucleari) ) {
            mysql_query('DELETE FROM `battle_cache` WHERE `uid` = "'.mysql_real_escape_string($this->ucleari[$i]).'"');
            $i++;
        }
    }

    //Проверка урон приемов над защитными
    public function testYronPriemAttack( $pid , $u1 , $u2 , $hp, $id = 0 )
	{
        //Игрок 1 бьет по Игроку 2 при помощи приема № pid на hp ед. здоровья
		//pr('uhod1:'.$this->stats[$this->uids[$u1]]['yhod']);
        //pr('uhod2:'.$this->stats[$this->uids[$u2]]['yhod']);
        //pr($u2);

		//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 && $id > 0)
		//{
			//pr($u2);
			//нужен id!
			//$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
            //pr($u2);
        //}
		//pr($eff);
        //Получаем приемы и смотрим когда какой действует
        $eff = $this->stats[$this->uids[$u2]]['effects'];
		//pr($eff);

        $j = 0;
        while( $j <= count($eff) )
		{
            //Проверяем, что прием не удален
			if(isset($eff[$j]['id']))$prm = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `id`="'.$eff[$j]['id'].'" AND `delete` = 0 LIMIT 1'));
            //pr('p:'.$j.': '.$prm['id']);
			if(isset($prm['id']) && isset($eff[$j]) && isset($eff[$j]['id_eff']) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0 )
			{
                //pr('t:'.$j.': '.$eff[$j]['name']);
				if( $eff[$j]['v2'] == 140 || $eff[$j]['v2'] == 45 || $eff[$j]['v2'] == 211 )
				{
                    //Приемы от которых урон = 1 , то есть выдаем 0
                    //$hp = array('y'=>1, 'r'=>-1,'k'=>1, 'm_k'=>1, 'm_y'=>1);
                    $hp['y'] = -1;
                    $hp['r'] = 1;
                    $hp['k'] = 1;
                    $hp['m_y'] = 1;
                    $hp['m_k'] = 1;
					//echo 'okkk';
                }
                elseif( $eff[$j]['v2'] == 141)
				{
                    //Приемы от которых урон/4
                    //$hp = array('y'=>1, 'r'=>-1,'k'=>1, 'm_k'=>1, 'm_y'=>1);
                    $hp['y'] = round($hp['y']/4);
                    $hp['r'] = round($hp['r']/4);
                    $hp['k'] = round($hp['k']/4);
                    $hp['m_y'] = round($hp['m_y']/4);
                    $hp['m_k'] = round($hp['m_k']/4);
                }
                elseif( $eff[$j]['v2'] == 7 ||  $eff[$j]['v2'] == 147 || $eff[$j]['v2'] == 148 || $eff[$j]['v2'] == 149 || $eff[$j]['v2'] == 150 )
				{
                    //Приемы от которых урон/2
                    $hp['y'] = round($hp['y']/2);
                    $hp['r'] = round($hp['r']/2);
                    $hp['k'] = round($hp['k']/2);
                    $hp['m_y'] = round($hp['m_y']/2);
                    $hp['m_k'] = round($hp['m_k']/2);
                }
            } elseif(!isset($prm['id'])) unset($eff[$j]);
            $j++;
        }
        unset($eff);

        return $hp;
    }

	public function testProboiPriem($pid,$uid)
	{
        //Игрок 1 бьет по Игроку 2 при помощи приема № pid
        $eff = $this->stats[$this->uids[$uid]]['effects'];
        $j = 0;

        while( $j <= count($eff) )
		{
            if( isset($eff[$j]) && is_array($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem'
			&& $eff[$j]['v2'] > 0 && ( $eff[$j]['v2'] == 47 || $eff[$j]['v2'] == 216 )) {return true;}

            $j++;
        }
        unset($eff);

        return false;
    }

	public function testZachPriem($pid,$uid, $no_pari=false)
	{
        //Игрок 1 бьет по Игроку 2 при помощи приема № pid
        $eff = $this->stats[$this->uids[$uid]]['effects'];
        $j = 0;
		$count = 0;

        while( $j <= count($eff) )
		{
			if( isset($eff[$j]) && is_array($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0)
			{
			  	if($eff[$j]['v2'] == 215 || $eff[$j]['v2'] == 48 || $eff[$j]['v2'] == 8 ) {$count++;}
				if(!$no_pari && ($eff[$j]['v2'] == 49 || $eff[$j]['v2'] == 10)) {$count++;}
			}
            $j++;
        }
		if($count>0) return $count;
        unset($eff);

        return false;
    }

/*public function testYronContrAttack( $pid , $u1 , $u2 , $hp ) {

        //Игрок 1 бьет по Игроку 2 при помощи приема № pid на hp ед. здоровья

        //Получаем приемы и смотрим когда какой действует
        $eff = $this->stats[$this->uids[$u2]]['effects'];
        $j = 0;
        while( $j <= count($eff) )
		{
            if( isset($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0 )
			{
                if( $eff[$j]['v2'] == 141)
				{
                    //Приемы от которых урон/4
                    $hp['y'] = round($hp['y']/4);
                    $hp['r'] = round($hp['r']/4);
                    $hp['k'] = round($hp['k']/4);
                    $hp['m_y'] = round($hp['m_y']/4);
                    $hp['m_k'] = round($hp['m_k']/4);
                }
                elseif( $eff[$j]['v2'] == 7 ||  $eff[$j]['v2'] == 147 || $eff[$j]['v2'] == 148 || $eff[$j]['v2'] == 149 || $eff[$j]['v2'] == 150 )
				{
                    //Приемы от которых урон/2
                    $hp['y'] = round($hp['y']/2);
                    $hp['r'] = round($hp['r']/2);
                    $hp['k'] = round($hp['k']/2);
                    $hp['m_y'] = round($hp['m_y']/2);
                    $hp['m_k'] = round($hp['m_k']/2);
                }
            }
            $j++;
        }
        unset($eff);

        return $hp;
    }*/

    //Расчет маг.крита
    public function magKrit($l2,$t)
    {
        $r = 0;
        $r = $l2*2-7;
        if($r>$t)
        {
            $r = 0;
        }else{
            //каждая владелка дает 3% шанс крита
            $r = ceil($t*0.75);
            if($r>30)
            {
                $r = 30;
            }
            if(rand(0,10000)<$r*100)
            {
                //крит удар
                $r = 1;
            }else{
                $r = 0;
            }
        }
        return $r;
    }
    //Расчет опыта
    /* public function testExp($y,$s1,$s2,$id1,$id2)
    {
        global $u,$c;

        if($y < 0){$y = 0;}
        //error_log('hpNow:'.$s2['hpNow'].' : '.$y);
		if( $s2['hpNow'] < 0){$y = $y - abs($s2['hpNow']);}
        //if( $s2['hpNow'] < $y && $s2['hpNow'] > 0){$y = $s2['hpNow'];}
        if($y < 0){$y = 0;}

        if($s2['hpAll']>0) $addExp = 0+(($y/$s2['hpAll'])*100);
		else $addExp = 0;
        if( $s2['hpAll']-$y <= 0){$addExp = 100;}

		//error_log('t1:'.$id1.' => '.$id2.' : '.$addExp.' : '.$y);
        //error_log('hpAll'.$s2['hpAll']);

        if($addExp < 0){$addExp = 0;}

        if( $s2['levels']!='undefined' && $this->users[$this->uids[$s2['id']]]['pass'] != 'saintlucia' )
		{
            if( $doexp < 0 ) {$doexp = 0;}
            //$addExp = $addExp*(1+($s2['levels']['expBtlMax']+$s2['irka'])+($doexp*1.01/10))/100;

            $bmxx = $s2['levels']['expBtlMax'];
            //error_log('bmxx:'.$bmxx);

            if($s2['levels']['bprice']!=0) $bmxx = round( $bmxx  * ( $s2['prckr'] / $s2['levels']['bprice'] ) );
			//error_log('prckr: '.$s1['prckr']);
            //error_log('bmxx2:'.$bmxx);

            if( $bmxx < $s2['levels']['expBtlMax']/2 )
			{
                $bmxx = round($s2['levels']['expBtlMax']/5);
            }

            if( $this->info['type'] == 1 )
			{
                $addExp = $addExp*($bmxx/10)/100;
            }else{
                //$xty = 0;
                //$addExp = $addExp*(($bmxx+$xty))/100;
                $addExp = $addExp*$bmxx/100;
            }

            $addExp = round($addExp);//Надо?
            //error_log('addExp4: '.$addExp.' : '.$y);

            if($this->info['razdel'] != 5 && $c['exp_limit_many'] == true)
			{
				$texp = mysql_fetch_array(mysql_query('SELECT COUNT(`a`.`id`) FROM `battle_users` AS `a` WHERE `a`.`uid` = "'.$id1.'"
				AND `a`.`battle` IN ( SELECT `b`.`battle` FROM `battle_users` AS `b` WHERE `b`.`uid` = "'.$id2.'"
				AND `b`.`team` != `a`.`team` AND `b`.`time_enter` > "'.(time()-86400).'" ) LIMIT 1'));//Возможно тяжелый запрос...
                $texp = $texp[0];
                //
                if($texp > 5) {
                    $addExp = $addExp;
                }elseif($texp > 4) {
                    $addExp = $addExp;
                }elseif($texp > 3) {
                    $addExp = $addExp;
                }elseif($texp > 2) {
                    $addExp = $addExp;
                }elseif($texp > 1) {
                    $addExp = $addExp;
                }else{
                    $addExp = $addExp;
                }
            }
            unset($doexp);
        } else {
            $addExp = 0;
        }

        return $addExp;
    } */
	
	public function testExp($y,$s1,$s2,$id1,$id2) {
			
			if($y<0){ $y = 0; }
			
			$addExp = 0+($y/$s2['hpAll']*100);
			
			if( $s2['hpAll']-$y < 0){
				$addExp = 100;
			}
			
			if($this->users[$this->uids[$s2['id']]]['host_reg'] == 'real_bot_user') {
				$addExp = floor($addExp*0.76);
			}
			
			if($addExp<0){ $addExp = 0; }						
			if( $s2['levels']!='undefined' ){
				if($doexp[0]>0) {
					$doexp = floor($doexp[0]/15);
				}else{
					$doexp = 0;
				}
					//Не артник
					$doexp = floor(($this->users[$this->uids[$id2]]['btl_cof']));
				//}
				if( $this->users[$this->uids[$id2]]['bot'] == 0 || $this->users[$this->uids[$id2]]['clone'] > 0 ) {
					$baseexp = array(
						5,
						10,
						20,
						30,
						60,
						120,
						180,
						300, //7
						450, //8
						600, //9
						1200, //10
						2400, //11
						3600 //12			
					);
					$doexp += $baseexp[$this->users[$this->uids[$s2['id']]]['level']];
										
				}
				
				if( $doexp < 0 ) {
					$doexp = 0;
				}
				$addExp = $addExp*(1+($s2['levels']['expBtlMax'])+$doexp)/100;
				if( $this->users[$this->uids[$s2['id']]]['bot'] > 0 ) {
					//$addExp = round($addExp/5);
				}
				unset($doexp);
			}else{
				$addExp = 0;
			}
			
			if( $this->info['typeBattle'] == 9 ) {
				//Нападение
				//за 8 и ниже не дают опыт
				if( $this->users[$this->uids[$s1['id']]]['level'] > $this->users[$this->uids[$s2['id']]]['level'] ) {
					if( $this->users[$this->uids[$s2['id']]]['level'] <= 8 ) {
						$addExp = 0;
					}
				}
			}
						
	if( $this->users[$this->uids[$id2]]['clone'] == 0 ) {
    	$procitm = 100;			
		$itmodet = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `inOdet` > 0 AND `inOdet` < 18 AND `uid` = "'.$s2['id'].'" LIMIT 1'));
		$itmodet = $itmodet[0];
	if( $itmodet < 0 ) { $itmodet = 0; }
	if( $itmodet > 17 ) { $itmodet = 17; }			
		$procitm = $itmodet/17*100;
	if( $procitm < 10 ) {
		$procitm = 10;
	}
		$addExp = $addExp/100*$procitm;
	}
			
			if( $this->users[$this->uids[$s1['id']]]['level'] <= $this->users[$this->uids[$s2['id']]]['level'] - 2 ) {
				//+40
				$addExp += $addExp/100*40;
			}elseif( $this->users[$this->uids[$s1['id']]]['level'] == $this->users[$this->uids[$s2['id']]]['level'] - 1 ) {
				//+20
				$addExp += $addExp/100*20;
			}elseif( $this->users[$this->uids[$s1['id']]]['level'] == $this->users[$this->uids[$s2['id']]]['level'] ) {
				//0
				
			}elseif( $this->users[$this->uids[$s1['id']]]['level'] - 1 == $this->users[$this->uids[$s2['id']]]['level'] ) {
				//-20
				$addExp -= $addExp/100*20;
			}elseif( $this->users[$this->uids[$s1['id']]]['level'] - 2 == $this->users[$this->uids[$s2['id']]]['level'] ) {
				//-40
				$addExp -= $addExp/100*40;
			}else{
				//-100 
				$addExp = 0;
			}
			
			return $addExp;
		}
	
    //Добавляем опыт \ нанесенный урон
    public function takeExp($id,$y,$id1,$id2,$mgregen = false,$nobattle_uron = false)
	{
        global $u;
        if(isset($this->users[$this->uids[$id]]))
		{
            $s1 = $this->stats[$this->uids[$id1]];
            $s2 = $this->stats[$this->uids[$id2]];
			//dVar($s1);
            if($id1!=$id2){
                $e = $this->testExp($y,$s1,$s2,$id1,$id2);
            }else{
                $e = 0;
            }

            if( $this->users[$this->uids[$id1]]['level'] > $this->users[$this->uids[$id2]]['level'] )
			{
                $rez = $this->users[$this->uids[$id1]]['level']-$this->users[$this->uids[$id2]]['level'];
                $e = round($e/100*(21-$rez*3));
                if( $e < 0 ) {
                    $e = 0;
                }
            }

            if( (int)$this->users[$this->uids[$id1]]['bot_id'] == 0 && $this->users[$this->uids[$id1]]['dnow'] != 0 && $this->info['dungeon'] != 1 )
			{
                $dun_limitForLevel = array( // Максимум для каждого уровня.
                    0 => 100,
					1 => 120,
					2 => 220,
					3 => 230,
					4 => 350,
                    5 => 750,
                    6 => 1400,
                    7 => 8100,
                    8 => 27000,
                    9 => 44000,
                    10 => 84000,
                    11 => 120000,
                    12 => 215000
                );
                $dun_expFactor = array( // Максимум для каждого уровня.
                    4 => 5,
                    5 => 5,
                    6 => 5,
                    7 => 5,
                    8 => 5,
                    9 => 3,
                    10 => 1,
                    11 => 583,
                    12 => 1
                );

                if( isset($dun_expFactor[(int)$this->users[$this->uids[$id1]]['level']]) )
				{
                    $e = $e * $dun_expFactor[(int)$this->users[$this->uids[$id1]]['level']];
                }

                if($this->info['dungeon'] > 1 && $this->users[$this->uids[$id1]]['battle'] > 0 )
				{ // пещерный лимит
                    $dun_exp = array(); // Текущий лимит опыта игрока в подземельях.
                    $rep = mysql_fetch_array(mysql_query('SELECT `dungeonexp`,`id` FROM `rep` WHERE `id` = "'.$this->users[$this->uids[$id1]]['id'].'" LIMIT 1'));
                    $rep = explode(',',$rep['dungeonexp']);
                    foreach ($rep as $key=>$val) {
                        $val = explode('=',$val);
                        if( isset($val[0]) && isset($val[1]) && $val[0] !='' && $val[1] != 0 ) $dun_exp[(int)$val[0]] = (int)$val[1]; // текущий лимит опыта в подземке
                    } unset($rep);

                    if( !isset($dun_exp[$this->info['dungeon']]) ) $dun_exp[$this->info['dungeon']] = 0;
                    if( !isset($dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']]) ){ // Если лимит не задан, опыт не даем.
                        $e = 0;
                    } elseif(
                        isset($dun_exp[$this->info['dungeon']]) &&
                        $dun_exp[$this->info['dungeon']] >= $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']]
                    ) { // Если лимит уже достигнут, опыт не даем.
                        $e = 0;
                    } elseif(
                        isset($dun_exp[$this->info['dungeon']]) &&
                        $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']] > $dun_exp[$this->info['dungeon']]
                    ) { // Если текущая репутация не достигла лимита.
                        if( ( $dun_exp[$this->info['dungeon']] + $e ) > $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']] ) {
                            // Если опыта набрано достаточно, для достижения лимита.
                            $e = abs($e - abs( $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']] - ( $e + $dun_exp[$this->info['dungeon']] ) ));
                            $dun_exp[$this->info['dungeon']] += $e;
                        } elseif( $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']] > ( $dun_exp[$this->info['dungeon']] + $e ) ) {
                            // Если опыта недостаточно, для достижения лимита.
                            $e = $e;
                            $dun_exp[$this->info['dungeon']] += $e;
                        } else {
                            $e = 0;
                        }
                    } else { // В любой непонятной ситуцаии.
                        $e = 0;
                    }
                } else $e = $e; // Опыт в пещерах.
                if( $this->info['dungeon'] == 102 && (int)$this->users[$this->uids[$id1]]['bot_id'] == 0 ) {
                    $e = floor($e * 0.002);
                }
            }

            if( (int)$this->users[$this->uids[$id1]]['bot_id'] == 0 && $this->users[$this->uids[$id1]]['dnow'] != 0 && $this->info['dungeon'] != 1 ) {
                if($this->users[$this->uids[$id1]]['level'] >= 7 ) {
                    $itmsCfc = ($s1['itmsCfc']+$s2['itmsCfc'])/26;
                    $itmsCfc = round($itmsCfc,5);
                    $e = $e*$itmsCfc;
                }
            }

            $this->users[$this->uids[$id1]]['battle_exp'] += round($e,5);
            
            //
            if($mgregen == false && $nobattle_uron == false) {
                $this->users[$this->uids[$id1]]['battle_yron'] += floor($y);
                if($this->stats[$this->uids[$id1]]['notactic'] != 1) {
                    if( $s2['hpAll'] <= 1000 ) {
                        if( $this->stats[$this->uids[$id2]]['this_animal'] == 0 ) {
                            $this->users[$this->uids[$id1]]['tactic6'] += round(0.1*(floor($y)/$s2['hpAll']*100),10);
                        }else{
                            $this->users[$this->uids[$id1]]['tactic6'] += round(0.1*(floor($y)/$s2['hpAll']*100),10)/3;
                        }
                    }else{
                        if( $this->stats[$this->uids[$id2]]['this_animal'] == 0 ) {
                            $this->users[$this->uids[$id1]]['tactic6'] += round(0.1*(floor($y)/1000*100),10);
                        }else{
                            $this->users[$this->uids[$id1]]['tactic6'] += round(0.1*(floor($y)/1000*100),10)/3;
                        }
                    }
                }
            }
            $upd = mysql_query('UPDATE `stats` SET `last_hp` = "'.$this->users[$this->uids[$id1]]['last_hp'].'",`tactic6` = "'.$this->users[$this->uids[$id1]]['tactic6'].'",`battle_yron` = "'.$this->users[$this->uids[$id1]]['battle_yron'].'",`battle_exp` = "'.$this->users[$this->uids[$id1]]['battle_exp'].'" WHERE `id` = "'.((int)$id1).'" LIMIT 1');
            if(!$upd){
                echo '[не удача при использовании приема]';
            }else{
                $this->stats[$this->uids[$id1]]['battle_exp'] = $this->users[$this->uids[$id1]]['battle_exp'];
                $this->clear_cache( $id1 );
                $this->stats[$this->uids[$id1]]['tactic6'] = $this->users[$this->uids[$id1]]['tactic6'];
                if($id1==$u->info['id'])
                {
                    $u->info['tactic6'] = $this->users[$this->uids[$id1]]['tactic6'];
                    $u->stats['tactic6'] = $this->users[$this->uids[$id1]]['tactic6'];
                    $u->info['battle_exp'] = $this->users[$this->uids[$id1]]['battle_exp'];
                    $u->info['battle_yron'] = $this->users[$this->uids[$id1]]['battle_yron'];
                    $u->info['notactic'] = $this->users[$this->uids[$id1]]['notactic'];
                    $u->stats['notactic'] = $this->users[$this->uids[$id1]]['notactic'];

					for($n=1; $n<6; $n++)
					{
						$u->info['notactic'.$n] = $this->users[$this->uids[$id1]]['notactic'.$n];
                    	$u->stats['notactic'.$n] = $this->users[$this->uids[$id1]]['notactic'.$n];
					}
                }
            }
            unset($s1,$s2);
        }
    }
    //Добавляем нанесенный урон
    public function takeYronNow($uid,$y)
	{
        global $u;
        $this->users[$this->uids[$uid]]['battle_yron'] += floor($y);
        $this->stats[$this->uids[$uid]]['battle_yron'] += floor($y);
        if( $uid == $u->info['id'] )
		{
            $u->info['battle_yron'] += floor($y);
            $u->stats['battle_yron'] += floor($y);
        }
        mysql_query('UPDATE `stats` SET `battle_yron` = `battle_yron` + "'.mysql_real_escape_string(floor($y)).'"
		WHERE `id` = "'.mysql_real_escape_string($uid).'" LIMIT 1');
    }

    //JS информация о игроке
    public function myInfo($id,$t)
    {
        global $c,$u;
        if(isset($this->users[$this->uids[$id]]) || $u->info['id'] == $id)
        {
            if($u->info['id'] == $id || ($u->info['enemy'] == $id && $id > 0)) {
                //Всегда обновляем
                $this->users[$this->uids[$id]] = mysql_fetch_array(mysql_query('SELECT 
					
					`u`.`zag`,`u`.`id`,`u`.`login`,`u`.`login2`,`u`.`online`,`u`.`admin`,`u`.`city`,`u`.`cityreg`,`u`.`align`,`u`.`align_lvl`,`u`.`align_exp`,`u`.`clan`,
					`u`.`level`,`u`.`money`,`u`.`money3`,`u`.`money2`,`u`.`money4`,`u`.`battle`,`u`.`sex`,`u`.`obraz`,`u`.`win`,`u`.`win_t`,
					`u`.`lose`,`u`.`lose_t`,`u`.`nich`,`u`.`timeMain`,`u`.`invis`,`u`.`bot_id`,`u`.`animal`,`u`.`type_pers`,
					`u`.`notrhod`,`u`.`bot_room`,`u`.`inUser`,`u`.`inTurnir`,`u`.`inTurnirnew`,`u`.`activ`,`u`.`stopexp`,`u`.`real`,
										
					`st`.*
					
					FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`id` = "'.$id.'" LIMIT 1'));
                $this->stats[$this->uids[$id]] = $u->getStats($this->users[$this->uids[$id]],0,0,false,false,true);
                $this->stats[$this->uids[$id]]['items'] = $this->stats[$this->uids[$id]]['items'];
                $this->stats[$this->uids[$id]]['effects'] = $this->stats[$this->uids[$id]]['effects'];
            }
            $ur   = $this->users[$this->uids[$id]];
            $st   = $this->stats[$this->uids[$id]];
            $itm  = $this->stats[$this->uids[$id]]['items'];
            $eff  = $this->stats[$this->uids[$id]]['effects'];
            $ef   = '';
            $i    = 0;
            while($i!=-1)
            {
                $nseef = 0;
                if($this->users[$this->uids[$ur['id']]]['id'] != $u->info['id'] && $ur['id'] != 0)
                {
                    if($this->stats[$this->uids[$ur['id']]]['seeAllEff'] != 1) {
                        $nseef = 1;
                        if($eff[$i]['v1']=='priem')
                        {
                            $eff[$i]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$eff[$i]['v2'].'" LIMIT 1'));
                        }
                        if(isset($eff[$i]['priem']['id']) && $eff[$i]['priem']['neg']==1)
                        {
                            $nseef = 0;
                        }
                    }
                }

                if(isset($eff[$i]) && $eff[$i] != 'delete')
                {
                    if($nseef == 0)
                    {

                        $ei = '<b><u>'.$eff[$i]['name'].'</u></b>';
                        if($eff[$i]['x']>1)
                        {
                            $ei .= ' x'.$eff[$i]['x'].' ';
                        }
                        if($eff[$i]['type1']>0 && $eff[$i]['type1']<7)
                        {
                            $ei .= ' (Эликсир)';
                        }elseif(($eff[$i]['type1']>6 && $eff[$i]['type1']<11) || $eff[$i]['type1']==16)
                        {
                            $ei .= ' (Заклятие)';
                        }elseif($eff[$i]['type1']==14)
                        {
                            $ei .= ' (Прием)';
                        }elseif($eff[$i]['type1']==15)
                        {
                            $ei .= ' (Изучение)';
                        }elseif($eff[$i]['type1']==17)
                        {
                            $ei .= ' (Проклятие)';
                        }elseif($eff[$i]['type1']==18 || $e['type1']==19)
                        {
                            $ei .= ' (Травма)';
                        }elseif($eff[$i]['type1']==20)
                        {
                            $ei .= ' (Пристрастие)';
                        }elseif($eff[$i]['type1']==22)
                        {
                            $ei .= ' (Ожидание)';
                        }else{
                            $ei .= ' (Эффект)';
                        }
                        $ei .= '<br>';

                        $out = '';
                        $time_still = ($eff[$i]['timeUse']+($eff[$i]['timeAce']-$eff[$i]['timeUse'])+$eff[$i]['actionTime']);
                        if($eff[$i]['timeAce'] == 0) {
                            $time_still += $eff[$i]['timeUse'];
                        }
                        $time_still -= time();
                        if($eff[$i]['bp']==0 && $eff[$i]['timeUse']!=77)
                        {
                            if($eff[$i]['type1']!=13)
                            {
                                $ei .= 'Осталось: '.$u->timeOut($time_still).'';
                            }
                        }else{
                            if($eff[$i]['timeUse']!=77 && $eff[$i]['hod'] < 1)
                            {
                                $ei .= 'Осталось: '.$u->timeOut($time_still).'';
                                //$ei .= 'Зарядов: '.$out.'<br>';
                            }elseif($eff[$i]['hod']>=0)
                            {
                                $ei .= 'Зарядов: '.$eff[$i]['hod'].'';
                            }
                        }

                        if($eff[$i]['user_use']!='')
                        {
                            if($this->users[$this->uids[$eff[$i]['user_use']]]['login2']!='') {
                                $ei .= '<br>Автор: <b>'.$this->users[$this->uids[$eff[$i]['user_use']]]['login2'].'</b>';
                            }elseif($this->users[$this->uids[$eff[$i]['user_use']]]['login']!='') {
                                $ei .= '<br>Автор: <b>'.$this->users[$this->uids[$eff[$i]['user_use']]]['login'].'</b>';
                            }
                        }

                        //Действие эффекта
                        $tr = '';
                        $ti = $u->items['add'];
                        $x = 0; $ed = $u->lookStats($eff[$i]['data']);
                        while($x<count($ti))
                        {
                            $n = $ti[$x];
                            if(isset($ed['add_'.$n],$u->is[$n]) && $n!='pog')
                            {
                                $z = '';
                                if($ed['add_'.$n]>0)
                                {
                                    $z = '+';
                                }
                                $tr .= '<br>'.$u->is[$n].': '.$z.''.$ed['add_'.$n];
                            }
                            $x++;
                        }

                        if( $ed['add_mib1'] != 0  ) {
                            if( $ed['add_mab1'] != 0 ) {
                                $tr .= '<br>Броня головы: '.$ed['add_mib1'].'-'.$ed['add_mab1'].'';
                            }else{
                                $m1l = $ed['add_mib1'];
                                if( $m1l > 0 ) {
                                    $m1l = '+'.$m1l;
                                }
                                $tr .= '<br>Броня головы: '.$m1l.'';
                            }
                        }
                        if( $ed['add_mib2'] != 0  ) {
                            if( $ed['add_mab2'] != 0 ) {
                                $tr .= '<br>Броня корпуса: '.$ed['add_mib2'].'-'.$ed['add_mab2'].'';
                            }else{
                                $m1l = $ed['add_mib2'];
                                if( $m1l > 0 ) {
                                    $m1l = '+'.$m1l;
                                }
                                $tr .= '<br>Броня корпуса: '.$m1l.'';
                            }
                        }
                        if( $ed['add_mib3'] != 0  ) {
                            if( $ed['add_mab3'] != 0 ) {
                                $tr .= '<br>Броня пояса: '.$ed['add_mib3'].'-'.$ed['add_mab3'].'';
                            }else{
                                $m1l = $ed['add_mib3'];
                                if( $m1l > 0 ) {
                                    $m1l = '+'.$m1l;
                                }
                                $tr .= '<br>Броня пояса: '.$m1l.'';
                            }
                        }
                        if( $ed['add_mib4'] != 0  ) {
                            if( $ed['add_mab4'] != 0 ) {
                                $tr .= '<br>Броня ног: '.$ed['add_mib4'].'-'.$ed['add_mab4'].'';
                            }else{
                                $m1l = $ed['add_mib4'];
                                if( $m1l > 0 ) {
                                    $m1l = '+'.$m1l;
                                }
                                $tr .= '<br>Броня ног: '.$m1l.'';
                            }
                        }

                        $efix = 0;
                        if( isset($ed['add_pog2']) && $ed['add_pog2'] > 0 ) {
                            $efix = $ed['add_pog2'];
                        }
                        if(isset($ed['add_pog']))
                        {
                            $tr .= '<br>Магический барьер способен поглотить еще <b>'.$ed['add_pog'].'</b> ед. урона';
                        }
                        if(isset($ed['add_pog2']))
                        {
                            $tr .= '<br>Магический барьер способен поглотить еще <b>'.$ed['add_pog2'].'</b> ед. урона <small>('.$ed['add_pog2p'].'%)</small>';
                        }

                        if($tr!='')
                        {
                            $ei .= $tr;
                        }
                        if($eff[$i]['info']!='')
                        {
                            $ei .= '<br><i>Информация:</i><br>'.$eff[$i]['info'];
                        }

                        //$ef .= '<img width=\"38\" style=\"margin:1px;display:block;float:left;\" src=\"//img.testcombats.ru/i/eff/'.$eff[$i]['img'].'\" onMouseOver=\"top.hi(this,\''.$ei.'\',event,0,1,1,1,\'\');\" onMouseOut=\"top.hic();\" onMouseDown=\"top.hic();\" />';
                        $ef .= '<div class=\"pimg\" pog=\"'.$efix.'\" col=\"'.$eff[$i]['x'].'\" stl=\"0\" stt=\"'.$ei.'\"><img src=\"//img.testcombats.ru/i/eff/'.$eff[$i]['img'].'\"/></div>';
                        unset($efix);
                    }
                }elseif($eff[$i]!='delete')
                {
                    $i = -2;
                }
                $i++;
            }

            if( $st['itmslvl'] == 0 && $ur['bot_id'] == 0) {
                $ef .= '<div class=\"pimg\" pog=\"0\" col=\"0\" stl=\"0\" stt=\"<b><u>Легкое вооружение</u></b> (Эффект)<br>Осталось: <i>Бесконечно</i>\"><img src=\"//img.testcombats.ru/i/eff/light_armor.gif\"/></div>';
            }

            $ca = '';
            if($ur['clan']>0)
            {
                $cl = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$ur['clan'].'" LIMIT 1'));
                if(isset($cl['id']))
                {
                    $ca = '<img src=\"//img.testcombats.ru/i/clan/'.$cl['name_mini'].'.gif\" title=\"'.$cl['name'].'\">';
                }
            }
            if($ur['align']>0)
            {
                $ca = '<img src=\"//img.testcombats.ru/i/align/align'.$ur['align'].'.gif\">'.$ca;
            }
            if($ur['login2']=='')
            {
                $ur['login2'] = $ur['login'];
            }
            if(floor($st['hpNow'])>$st['hpAll'])
            {
                $st['hpNow'] = $st['hpAll'];
            }
            if(floor($st['mpNow'])>$st['mpAll'])
            {
                $st['mpNow'] = $st['mpAll'];
            }
            $stsua  = '<b>'.$ur['login2'].'</b>';
            $stsua .= '<br>Сила: '.$st['s1'];
            $stsua .= '<br>Ловкость: '.$st['s2'];
            $stsua .= '<br>Интуиция: '.$st['s3'];
            $stsua .= '<br>Выносливость: '.$st['s4'];
            if($st['s5'] != 0) {
                $stsua .= '<br>Интелект: '.$st['s5'];
            }
            if($st['s6'] != 0) {
                $stsua .= '<br>Мудрость: '.$st['s6'];
            }
            if($st['s7'] != 0) {
                $stsua .= '<br>Духовность: '.$st['s7'];
            }
            if($u->info['admin']>0){
                if(isset($ur['align']) && $ur['align'] == 9){
                    $align = $ur['align'];
                } else {
                    $align = $ur['align'];
                }
            }
            $tp_img = array(
                1 => 4,
                2 =>5,
                14 => 6,
                3 => 7,
                5 => 8,
                7 => 9,
                17 => 10,
                16 => 11,
                13 => 12,
                10 => 13,
                9 => 14,
                8 => 15,
                11 => 17, //кольцо 2
                12 => 18 //кольцо 3
            );
            $info = 'info_reflesh('.$t.','.$ur['id'].',"'.$ca.'<a href=\"javascript:void(0)\" onclick=\"top.chat.addto(\''.$ur['login2'].'\',\'to\');return false;\">'.$ur['login2'].'</a> ['.$ur['level'].']<a href=\"info/'.$ur['id'].'\" target=\"_blank\"><img src=\"//img.testcombats.ru/i/inf_'.$ur['cityreg'].'.gif\" title=\"Инф. о '.$ur['login2'].'\"></a>&nbsp;","'.$ur['obraz'].'",'.floor($st['hpNow']).','.floor($st['hpAll']).','.floor($st['mpNow']).','.floor($st['mpAll']).',0,'.$ur['sex'].',"'.$ef.'","'.$stsua.'", "'.$align.'", "'.$ur['zag'].'");shpb();';
            $i = 0;
            while($i<count($itm))
            {
                //
                if(isset($st['items_img'][$tp_img[$itm[$i]['inOdet']]])) {
                    $itm[$i]['img'] = $st['items_img'][$tp_img[$itm[$i]['inOdet']]];
                }
                //генерируем предметы
                $ttl = '<b>'.$itm[$i]['name'].'</b>';
				if($u->info['admin']>0) $ttl .= ' [слот:'.$tp_img[$itm[$i]['inOdet']].']';
                $td = $u->lookStats($itm[$i]['data']);
                $lvar = '';
                if($td['add_hpAll']>0)
                {
                    if($td['add_hpAll']>0)
                    {
                        $td['add_hpAll'] = '+'.$td['add_hpAll'];
                    }
                    $lvar .= '<br>Уровень жизни: '.$td['add_hpAll'].'';
                }
                if($td['sv_yron_max']>0 || $td['sv_yron_min']>0)
                {
                    $lvar .= '<br>Урон: '.(0+$td['sv_yron_min']).'-'.(0+$td['sv_yron_max']).'';
                }
                if($td['add_mab1']>0)
                {
                    if($td['add_mib1']==$td['add_mab1'] && $pl['geniration']==1)
                    {
                        $m1l = '+'; if($td['add_mab1']<0){ $m1l = ''; }
                        $lvar .= '<br>Броня головы: '.$m1l.''.(0+$td['add_mab1']).'';
                    }else{
                        $lvar .= '<br>Броня головы: '.(0+$td['add_mib1']).'-'.(0+$td['add_mab1']).'';
                    }
                }
                if($td['add_mab2']>0)
                {
                    if($td['add_mib2']==$td['add_mab2'] && $pl['geniration']==1)
                    {
                        $m1l = '+'; if($td['add_mab2']<0){ $m1l = ''; }
                        $lvar .= '<br>Броня корпуса: '.$m1l.''.(0+$td['add_mab2']).'';
                    }else{
                        $lvar .= '<br>Броня корпуса: '.(0+$td['add_mib2']).'-'.(0+$td['add_mab2']).'';
                    }
                }
                if($td['add_mab3']>0)
                {
                    if($td['add_mib3']==$td['add_mab3'] && $pl['geniration']==1)
                    {
                        $m1l = '+'; if($td['add_mab3']<0){ $m1l = ''; }
                        $lvar .= '<br>Броня пояса: '.$m1l.''.(0+$td['add_mab3']).'';
                    }else{
                        $lvar .= '<br>Броня пояса: '.(0+$td['add_mib3']).'-'.(0+$td['add_mab3']).'';
                    }
                }
                if($td['add_mab4']>0)
                {
                    if($td['add_mib4']==$td['add_mab4'] && $pl['geniration']==1)
                    {
                        $m1l = '+'; if($td['add_mab4']<0){ $m1l = ''; }
                        $lvar .= '<br>Броня ног: '.$m1l.''.(0+$td['add_mab4']).'';
                    }else{
                        $lvar .= '<br>Броня ног: '.(0+$td['add_mib4']).'-'.(0+$td['add_mab4']).'';
                    }
                }
                if($itm[$i]['iznosMAX']>0)
                {
                    if($itm[$i]['iznosMAXi'] == 999999999) {
                        $lvar .= '<br>Долговечность: <font color=brown>неразрушимо</font>';
                    }else{
                        $lvar .= '<br>Долговечность: '.floor($itm[$i]['iznosNOW']).'/'.floor($itm[$i]['iznosMAX']);
                    }
                }
                $ttl .= $lvar;
                $ccv = '';

                if($itm[$i]['magic_inci']!='' || $itm[$i]['magic_inc']!='') {
                    if($itm[$i]['magic_inc'] == '') {
                        $itm[$i]['magic_inc'] = $itm[$i]['magic_inci'];
                    }
                    $mgi = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$itm[$i]['magic_inc'].'" AND `type1` = "12345" LIMIT 1'));
                    if(isset($mgi['id2'])) {
                        $mgilog = '';
                        $ccv .= 'top.useMagicBattle(\''.$mgi['mname'].'\','.$itm[$i]['id'].',\''.$mgi['img'].'\',1,2);';
                    }
                }

                $info .= 'abitms('.(0+$t).','.(0+$itm[$i]['uid']).','.(0+$itm[$i]['id']).','.(0+$itm[$i]['inOdet']).',"'.$itm[$i]['name'].'","'.$ttl.'","'.$itm[$i]['img'].'","'.$ccv.'");';
                $i++;
            }

            return $info;
        }else{
            return false;
        }
    }

    //Проверка на выживших
    public function testUsersLive() {
        $r = false;
        $tl = 0;
        $i = 0;
        $j = 0;
        while($i<count($this->uids))
        {
            if($this->stats[$i]['id']>0)
            {
                if( floor($this->stats[$i]['hpNow']) < 1 ) {
                    $this->stats[$i]['hpNow'] = 0;
                }
                $hp[$this->users[$i]['team']] += floor($this->stats[$i]['hpNow']);
                if(!isset($tml[$this->users[$i]['team']]) && floor($this->stats[$i]['hpNow']) >= 1)
                {
                    $tml[$this->users[$i]['team']] = 1;
                    $tmv[$j] = $this->users[$i]['team'];
                    $tl++;
                }
            }
            $i++;
        }
        if( $tl > 1 ) {
            $r = true;
        }
        return $r;
    }

    //Мини лог
    public function miniLogAdd( $user , $text )
	{
        //$txt = $text;
		//$vLog = 'at1=00000||at2=00000||zb1=0||zb2=0||bl1=0||bl2=0||time1='.time().'||time2='.time().'||s1='.$user['sex'].'||t1='.$user['team'].'||login1='.$user['login'].'||';
        $vLog = 'zb1=0||zb2=0||bl1=0||bl2=0||time1='.time().'||time2='.time().'||s1='.$user['sex'].'||t1='.$user['team'].'||login1='.$user['login'].'||';
        $mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$text,'vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
        //$mas1['text'] = $txt;
        $this->add_log($mas1);
    }

    //Проверяем завершение боя
    public function testFinish()
    {
        global $u;
        //
        mysql_query('START TRANSACTION;');
        //
        $test = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$this->info['id'].'" AND `team_win` = -1 LIMIT 1 FOR UPDATE'));
		//mysql_query('UPDATE `battle` SET `testfinish` = "'.$u->info['id'].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
        //
        mysql_query('COMMIT;');
        //
        if($this->info['team_win'] == -1 && isset($test['id']))
        {
            //error_log($this->info['team_win'].' : '.$test['id']);
			$hp = array();
            $tml = array();
            $tmv = array();
            $tl = 0;
            $i = 0;
            $j = 0;

            while($i<count($this->uids))
            {
                if($this->stats[$i]['id']>0)
                {
                    if( floor($this->stats[$i]['hpNow']) < 1 )
					{
                        $this->stats[$i]['hpNow'] = 0;
                    }
                    $hp[$this->users[$i]['team']] += floor($this->stats[$i]['hpNow']);
                    if(!isset($tml[$this->users[$i]['team']]) && floor($this->stats[$i]['hpNow']) >= 1)
                    {
                        $tml[$this->users[$i]['team']] = 1;
                        $tmv[$j] = $this->users[$i]['team'];
                        $tl++;
                    }
                }
                $i++;
            }

            if($tl<=1)
			{
                //Доп.проверка
                $tmHpNow = array();
                $tmNow = array();

				$sp = mysql_query('SELECT `u`.`login`,`u`.`id`,`u`.`battle`,`s`.`team`,`s`.`hpNow` FROM `users` AS `u`
				LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `u`.`battle` = "'.$this->info['id'].'"');

				while( $pl = mysql_fetch_array($sp) )
				{
                    if( !isset($tmHpNow[$pl['team']]))
					{
                        $tmHpNow[$pl['team']] = 0;
                        $tmNow[] = $pl['team'];
                    }
                    $hpTm = floor($pl['hpNow']);
                    if( $hpTm < 0 ) {
                        $hpTm = 0;
                    }
                    if( $hpTm > 0 ) {
                        $tmHpNow[$pl['team']] += $pl['hpNow'];
                    }
                }
                $gdj = 0;
                $i = 0;
                while( $i < count($tmNow) )
				{
                    if( isset($tmNow[$i]) )
					{
                        $j = $tmNow[$i];
                        if( $tmHpNow[$j] > 0 ) {
                            $gdj++;
                        }
                    }
                    $i++;
                }
                if( $gdj > 1 )
				{
                    $tl = $gdj;
                    //echo 'Поединок может завершиться не корректно... (Сообщите Администрации об этом)';
					//eLog('Battle: '.$this->info['id']);
                }
            }

            if($tl <= 1)
			{
				//завершаем поединок, кто-то один победил, либо ничья
                $i = 0; $tmwin = 0;
                while($i<count($tmv))
                {
                    if($tmv[$i]>=1 && $tml[$tmv[$i]]>0)
                    {
                        $tmwin = $tmv[$i];
                    }
                    $i++;
                }

                if($this->info['izlom'] == 0)
				{
					$rs = ''; $ts = array(); $tsi = 0;
                    if($this->info['id']>0)
                    {
                        //данные о игроках в бою
                        unset($this->users,$this->stats,$this->uids,$this->bots,$this->iBots);
                        $trl = mysql_query('SELECT `u`.`no_ip`,`u`.`id`,`u`.`notrhod`,`u`.`login`,`u`.`login2`,`u`.`sex`,`u`.`online`,`u`.`admin`,
						`u`.`align`,`u`.`align_lvl`,`u`.`align_exp`,`u`.`clan`,`u`.`level`,`u`.`battle`,`u`.`obraz`,`u`.`win`,`u`.`lose`,`u`.`nich`,`u`.`animal`,`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`exp`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,`st`.`battle_exp`,`st`.`enemy`,`st`.`battle_text`,`st`.`upLevel`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`bot`,`st`.`lider`,`st`.`btl_cof`,`st`.`tactic1`,`st`.`tactic2`,`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`battleEnd`,`st`.`priemslot`,`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`res_x`,`st`.`res_y`,`st`.`res_s`,`st`.`id`,`st`.`last_hp`,`st`.`last_pr`,`u`.`sex`,`u`.`money`,`u`.`money3`,`u`.`money2`,`u`.`bot_id` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = "'.$this->info['id'].'" ORDER BY `st`.`bot` DESC');

						$ir = 0; $bi = 0;
                        $this->users = NULL;
                        $this->stats = NULL;
                        $this->uids = NULL;
                        $this->bots = NULL;
                        $this->iBots = NULL;

						while($pl = mysql_fetch_array($trl))
                        {
                            //записываем данные
                            if($pl['login2']=='')
                            {
                                $pl['login2'] = $pl['login'];
                            }
                            $this->users[$ir] = $pl;
                            $this->uids[$pl['id']] = $ir;
                            if($pl['bot']>0)
                            {
                                $this->bots[$bi] = $pl['id'];
                                $this->iBots[$pl['id']] = $bi;
                                $bi++;
                            }
                            //записываем статы
							//pr('ttt');
                            $this->stats[$ir] = $u->getStats($pl,0,0,false,false,true);
                            $ir++;
							//pr('ttt');
                        }
                    }
                }
				elseif(!isset($this->uids[$u->info['id']]))
				{
					$rs = ''; $ts = array(); $tsi = 0;
                    if($this->info['id']>0)
                    {
                        //данные о игроках в бою
                        $trl = mysql_query('SELECT `u`.`no_ip`,`u`.`id`,`u`.`notrhod`,`u`.`login`,`u`.`login2`,`u`.`sex`,`u`.`online`,`u`.`admin`,`u`.`align`,
						`u`.`align_lvl`,`u`.`align_exp`,`u`.`clan`,`u`.`level`,`u`.`battle`,`u`.`obraz`,`u`.`win`,`u`.`lose`,`u`.`nich`,`u`.`animal`,
						`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`exp`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,`st`.`battle_exp`,`st`.`enemy`,
						`st`.`battle_text`,`st`.`upLevel`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`bot`,`st`.`lider`,`st`.`btl_cof`,`st`.`tactic1`,`st`.`tactic2`,
						`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`battleEnd`,`st`.`priemslot`,
						`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`res_x`,`st`.`res_y`,`st`.`res_s`,`st`.`id`,
						`st`.`last_hp`,`st`.`last_pr`,`u`.`sex`,`u`.`money`,`u`.`bot_id`,`u`.`money3`,`u`.`money2` FROM `users` AS `u`
						LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`id` = "'.$this->info['id'].'" LIMIT 1');

						$pl = mysql_fetch_array($trl);
                        //записываем данные
                        if($pl['login2']=='') $pl['login2'] = $pl['login'];

                        $this->users[count($this->users)] = $pl;
                        $this->uids[$pl['id']] = $ir;
                        if($pl['bot']>0)
                        {
                            $this->bots[count($this->bots)] = $pl['id'];
                            $this->iBots[$pl['id']] = $bi;
                        }
                        //записываем статы
                        //pr();
                        $this->stats[count($this->stats)] = $u->getStats($pl,0,0,false,false,true);
                        //pr();
                    }
                }


                if($this->info['izlom']>0 && $tmwin==1)
                {
					// выкидываем ботов из боя
                    $i = 0; $dlt = ''; $dlt2 = '';
                    $sp = mysql_query('SELECT `users`.`id`,`stats`.`bot`,`stats`.`team` FROM `users`,`stats`
					WHERE `users`.`battle` = "'.$this->info['id'].'" AND `stats`.`id` = `users`.`id` LIMIT 10000');

					while($pl = mysql_fetch_array($sp))
                    {
                        if($pl['bot']==1 &&$pl['team'] != $u->info['team'])
                        {
                            $dlt .= ' `id`="'.$pl['id'].'" OR';
                            $dlt2 .= ' `uid`="'.$pl['id'].'" OR';
                            $i++;
                        }

                    }

                    if($i > 0)
					{
                        $dlt = trim($dlt,'OR');
                        $dlt2 = trim($dlt2,'OR');
                        mysql_query('DELETE FROM `users` WHERE '.$dlt.' LIMIT '.$i);
                        mysql_query('DELETE FROM `stats` WHERE '.$dlt.' LIMIT '.$i);
                        mysql_query('DELETE FROM `items_users` WHERE '.$dlt2.' LIMIT '.($i*100));
                        mysql_query('DELETE FROM `eff_users` WHERE '.$dlt2.' LIMIT '.($i*100));
                    }

                    unset($i,$dlt,$dlt2);

                    $j = 0; $k = 0; $obr = 0;

                    //Это излом, добавляем еще ботов
                    if (rand(1, 100) <= 5)//if( $this->get_chanse(3) == true )//Босс
					{
						//Уникальные монстры
                        if( $this->info['izlomLvl'] == 8 )
						{
                            $bots = array( 'Валентайский Охотник','Шипокрыл Хаоса','Шипокрыл','Лик Хаоса','Фанатик Хаоса' );
                        }
                        $logins_bot = array();
                        //
                        echo '<center><b><font color=red>Приближается нечто...</font></b></center>';
                        
                        //
                        $id2 = rand(0,(count($bots)-1));
                        $id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'"
						AND (`pishera` = "" OR `pishera` = "NULL") AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
                        $bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,round($this->info['izlomRoundSee']));

						if(isset($id['id']) && $bot != false)
						{
                            //
                            $btxt = '';
                            if( $id['align'] > 0 ) {
                                $btxt = $btxt.'<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$id['align'].'.gif >';
                            }
                            if( $id['clan'] > 0 ) {
                                $btxt = $btxt.'<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$id['clan'].'.gif >';
                            }
                            $btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=/info/'.$id['id'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
                            if( $id['sex'] == 1 ) {
                                $btxt = $btxt.' вмешалась в поединок.';
                            }else{
                                $btxt = $btxt.' вмешался в поединок.';
                            }
                            $this->miniLogAdd(array(
                                'login' => $id['login'],
                                'sex'	=> $id['sex'],
                                'team'	=> 0
                            ),'{tm1} '.$btxt);
                            //
                            $logins_bot = $bot['logins_bot'];
                            mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                            mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                            if(rand(0,10000) < 1500){ $obr++; }
                            $j++;
                        }
                    }else{
                        //Обычные монстры
                        if( $this->info['izlomLvl'] == 8 )
						{
                            $bots = array('Литейщик', 'Проклятие Глубин','Пустынник Маньяк','Пустынник Убийца','Рабочий Мглы','Смотритель Мглы','Сторож Мглы' );
                        }
                        $logins_bot = array();
                        //
                        $id2 = rand(0,(count($bots)-1));
                        $id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot`
						WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'"
                        AND (`pishera` = "" OR `pishera` = "NULL")
						AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
						
                        $bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,$this->info['izlomRoundSee']);

                        if(isset($id['id']) && $bot != false)
						{
                            //
                            $btxt = '';
                            if( $id['align'] > 0 ) {
                                $btxt = $btxt.'<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$id['align'].'.gif >';
                            }
                            if( $id['clan'] > 0 ) {
                                $btxt = $btxt.'<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$id['clan'].'.gif >';
                            }
                            $btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=info/'.$id['id'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
                            if( $id['sex'] == 1 ) {
                                $btxt = $btxt.' вмешалась в поединок.';
                            }else{
                                $btxt = $btxt.' вмешался в поединок.';
                            }
                            $this->miniLogAdd(array(
                                'login' => $id['login'],
                                'sex'	=> $id['sex'],
                                'team'	=> 0
                            ),'{tm1} '.$btxt);
                            //
                            $logins_bot = $bot['logins_bot'];
                            mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                            mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                            if(rand(0,10000) < 1500){ $obr++; }
                            $j++;
                        }
                        //
                        $id2 = rand(0,(count($bots)-1));
                        $id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot`
                        WHERE `login` = "'.$bots[$id2].'"
                        AND `level` <= "'.$u->info['level'].'"
                        AND (`pishera` = "" OR `pishera` = "NULL")
                        AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));

                        $bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,$this->info['izlomRoundSee']);
                        if(isset($id['id']) && $bot != false) {
                            //
                            $btxt = '';
                            if( $id['align'] > 0 ) {
                                $btxt = $btxt.'<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$id['align'].'.gif >';
                            }
                            if( $id['clan'] > 0 ) {
                                $btxt = $btxt.'<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$id['clan'].'.gif >';
                            }
                            $btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=info/'.$id['id'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
                            if( $id['sex'] == 1 ) {
                                $btxt = $btxt.' вмешалась в поединок.';
                            }else{
                                $btxt = $btxt.' вмешался в поединок.';
                            }
                            $this->miniLogAdd(array(
                                'login' => $id['login'],
                                'sex'	=> $id['sex'],
                                'team'	=> 0
                            ),'{tm1} '.$btxt);
                            //
                            $logins_bot = $bot['logins_bot'];
                            mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                            mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                            if(rand(0,10000) < 1500){ $obr++; }
                            $j++;
                        }
                        //
                        if( rand(0,100) < 70 )
                        {
                            $id2 = rand(0,(count($bots)-1));
                            $id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot`
                            WHERE `login` = "'.$bots[$id2].'"
                            AND `level` <= "'.$u->info['level'].'"
                            AND (`pishera` = "" OR `pishera` = "NULL")
                            AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));

                            $bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,$this->info['izlomRoundSee']);
                            if(isset($id['id']) && $bot != false) {
                                //
                                $btxt = '';
                                if( $id['align'] > 0 ) {
                                    $btxt = $btxt.'<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$id['align'].'.gif >';
                                }
                                if( $id['clan'] > 0 ) {
                                    $btxt = $btxt.'<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$id['clan'].'.gif >';
                                }
                                $btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=info/'.$id['id'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
                                if( $id['sex'] == 1 ) {
                                    $btxt = $btxt.' вмешалась в поединок.';
                                }else{
                                    $btxt = $btxt.' вмешался в поединок.';
                                }
                                $this->miniLogAdd(array(
                                    'login' => $id['login'],
                                    'sex'	=> $id['sex'],
                                    'team'	=> 0
                                ),'{tm1} '.$btxt);
                                //
                                $logins_bot = $bot['logins_bot'];
                                mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                                mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                                if(rand(0,10000) < 1500){ $obr++; }
                                $j++;
                            }
                        }
                        //Каждые 10 вол = +1 монстр
                        $irb = floor($this->info['izlomRoundSee']/10);
                        while( $irb > 0 )
                        {
                            //
                            if( rand(0,100) < 20 )
                            {
                                $id2 = rand(0,(count($bots)-1));
                                $id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot`
                                WHERE `login` = "'.$bots[$id2].'"
                                AND `level` <= "'.$u->info['level'].'"
                                AND (`pishera` = "" OR `pishera` = "NULL")
                                AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
                                $bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,$this->info['izlomRoundSee']);
                                if(isset($id['id']) && $bot != false) {
                                    //
                                    $btxt = '';
                                    if( $id['align'] > 0 ) {
                                        $btxt = $btxt.'<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$id['align'].'.gif >';
                                    }
                                    if( $id['clan'] > 0 ) {
                                        $btxt = $btxt.'<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$id['clan'].'.gif >';
                                    }
                                    $btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=info/'.$id['id'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
                                    if( $id['sex'] == 1 ) {
                                        $btxt = $btxt.' вмешалась в поединок.';
                                    }else{
                                        $btxt = $btxt.' вмешался в поединок.';
                                    }
                                    $this->miniLogAdd(array(
                                        'login' => $id['login'],
                                        'sex'	=> $id['sex'],
                                        'team'	=> 0
                                    ),'{tm1} '.$btxt);
                                    //
                                    $logins_bot = $bot['logins_bot'];
                                    mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                                    mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
                                    if(rand(0,10000) < 1500){ $obr++; }
                                    $j++;
                                }
                            }
                            $irb--;
                        }
                    }
                    //
                    unset($logins_bot);

                    if($j==0)
                    {
                        //конец излома
                        $this->finishBattle($tml,$tmv,NULL,$tl);
                        $fin1 = mysql_query('INSERT INTO `izlom_rating` (`uid`,`time`,`voln`,`level`,`bots`,`rep`,`obr`,`btl`) VALUES ("'.$u->info['id'].'","'.time().'","'.$this->info['izlomRoundSee'].'","'.$this->info['izlomLvl'].'","0","0","'.($this->info['izlomObr']-$this->info['izlomObrNow']).'","'.$this->info['id'].'")');
                    }else{
                        $this->info['izlomRound'] = $iz['round'];
                        mysql_query('UPDATE `battle` SET `izlomObrNow` = '.$obr.',`izlomObr` = `izlomObr` + '.$obr.',`timeout` = (`timeout`+5),`izlomRound` = "'.($this->info['izlomRound']+1).'",`izlomRoundSee` = `izlomRoundSee`+1 WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
                        $this->stats[$this->uids[$u->info['id']]]['hpNow'] += $this->stats[$this->uids[$u->info['id']]]['hpAll']*0.25;
                        $this->stats[$this->uids[$u->info['id']]]['mpNow'] += $this->stats[$this->uids[$u->info['id']]]['mpAll']*0.25;
                        $this->users[$this->uids[$u->info['id']]]['hpNow'] = $this->stats[$this->uids[$u->info['id']]]['hpAll'];
                        $this->users[$this->uids[$u->info['id']]]['mpNow'] = $this->stats[$this->uids[$u->info['id']]]['mpAll'];
                        //$vLog = 'zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$this->stats[$this->uids[$u2]]['zonb'].'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$b].'||time1='.$this->atacks[$id]['time'].'||time2='.$this->atacks[$id]['time2'].'||s2='.$this->users[$this->uids[$u2]]['sex'].'||s1='.$this->users[$this->uids[$u1]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u->info['id']]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';
                        $vLog = 'zb1=||zb2=||bl1=||bl2=||time1='.time().'||time2='.time().'||s2=||s1='.$u->info['sex'].'||t2=||t1=||login1='.$this->users[$this->uids[$u->info['id']]]['login2'].'||login2=';
                        $mas = array(
                            'text' => '',
                            'time' => time(),
                            'vars' => '',
                            'battle' => $this->info['id'],
                            'id_hod' => ($this->hodID+1),
                            'vars' => $vLog,
                            'type' => 1
                        );
                        if( $u->info['sex'] == 1 ) {
                            $mas['text'] = '<span class=date>{tm1}</span> <b>'.$u->info['login'].'</b> воспользовалась приемом &quot;<b>Передышка</b>&quot;.';
                        }else{
                            $mas['text'] = '<span class=date>{tm1}</span> <b>'.$u->info['login'].'</b> воспользовался приемом &quot;<b>Передышка</b>&quot;.';
                        }
                        if( $u->stats['hpNow'] < $u->stats['hpAll'] ) {
                            $hpSks = floor(($u->stats['hpAll']*((rand(15,25))/100)));
                            if( $hpSks > floor($u->stats['hpAll'] - $u->stats['hpNow']) ) {
                                $hpSks = floor($u->stats['hpAll'] - $u->stats['hpNow']);
                            }
                            $mas['text'] .= ' <font color=#0066aa><b>+'.$hpSks.'</b></font>';
                        }else{
                            $hpSks = 0;
                            $mas['text'] .= ' <font color=#0066aa><b>--</b></font>';
                        }
                        $mas['text'] .= ' ['.floor($u->info['hpNow']+$hpSks).'/'.$u->stats['hpAll'].']';
                        $this->add_log($mas);
                        mysql_query('UPDATE `stats` SET `hpNow` = "'.($u->info['hpNow']+($u->stats['hpAll']*((rand(15,25))/100))).'",`mpNow` = "'.($u->info['mpNow']+($u->stats['mpAll']*0.25)).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
                    }
                }else{
                    //завершаем бой
                    $this->finishBattle($tml,$tmv,NULL,$tl);
                    if($this->info['izlom']>0)
                    {
                        $fin1 = mysql_query('INSERT INTO `izlom_rating` (`uid`,`time`,`voln`,`level`,`bots`,`rep`,`obr`,`btl`) VALUES ("'.$u->info['id'].'","'.time().'","'.$this->info['izlomRoundSee'].'","'.$this->info['izlomLvl'].'","0","0","'.($this->info['izlomObr']-$this->info['izlomObrNow']).'","'.$this->info['id'].'")');
                        $izlom = mysql_fetch_array(mysql_query('SELECT SUM(`voln`) FROM `izlom_rating` WHERE `uid` = "'.$u->info['id'].'" LIMIT 500'));
                        $izlom = $izlom[0];
                        mysql_query('UPDATE `rep` SET `repizlom` = "'.$izlom.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
                    }
                }
                if(isset($fin1))
                {
                    mysql_query('INSERT INTO `eff_users` (`no_Ace`,`id_eff`,`overType`,`uid`,`name`,`data`,`timeUse`) VALUES ("1","31","23","'.$u->info['id'].'","Касание Хаоса","nofastfinisheff=1","'.time().'")');
                    mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','Вы создали предмет &quot;Образец&quot;x".($this->info['izlomObr']-$this->info['izlomObrNow'])."','".time()."','3','0')");
                    $i01 = 1;
                    while($i01<=($this->info['izlomObr']-$this->info['izlomObrNow']))
                    {
                        $u->addItem(1226,$u->info['id'],'|sudba='.$u->info['login']);
                        $i01++;
                    }
                    unset($fin1);
                }
            }
        }else{
            mysql_query('START TRANSACTION;');
            $test = mysql_fetch_array(mysql_query('SELECT `id`,`team_win` FROM `battle` WHERE `id` = "'.$this->info['id'].'" AND `team_win` != -1 LIMIT 1 FOR UPDATE'));
            mysql_query('COMMIT;');
            if(isset($test['id'])) {
                $this->finishBattle(NULL,NULL,10,$tl);
            }
        }
        //
        //mysql_query('UPDATE `battle` SET `testfinish` = "0" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
    }

    //завершение поединка
    public function finishBattle($t,$v,$nl,$tl)
    {
        global $magic, $u, $q, $c, $CRON_CORE, $save_exp, $save_exp_arr, $save_time, $FAST_STAT_END;//, $FAST_STAT;

        $frtu = false;
		
        $tjor_id = mysql_fetch_array(mysql_query('SELECT `uid`, `hpAll` FROM `battle_users` WHERE `battle`="'.$this->info['id'].'"
		AND (`uid` = "50932" OR `uid` = "50933") LIMIT 1'));

		/*if(isset($tjor_id['uid']))//Логирование
		{
			$save_exp = true;//dg - опыт
            $save_time2 = true;//dg - finishBattle
		}*/
		//if($u->info['id']==1) $save_exp = true;//dg

		$save_exp_arr = array();

        if($frtu == false)
		{
            $relbf = $this->info['team_win'];
            if($nl!=10)
            {
                $i = 0; $dnr = 0;
                if($this->info['team_win']==-1)
                {
                    $this->info['team_win'] = 0;
                    while($i<count($v))
                    {
                        if($v[$i]>=1 && $t[$v[$i]]>0)$this->info['team_win'] = $v[$i];
                        $i++;
                    }
                }
            }

			if($save_time2) dStart();
            //данные о игроках в бою
            $t = mysql_query('SELECT `u`.`stopexp`,`u`.`twink`,`u`.`city`,`u`.`room`,`u`.`no_ip`,`u`.`pass`,`u`.`id`,`u`.`notrhod`,`u`.`login`,
			`u`.`login2`,`u`.`sex`,`u`.`online`,`u`.`admin`,`u`.`align`,`u`.`align_lvl`,`u`.`align_exp`,`u`.`clan`,`u`.`level`,`u`.`battle`,`u`.`obraz`,
			`u`.`win`,`u`.`lose`,`u`.`nich`,`u`.`animal`,`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`exp`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,
			`st`.`battle_exp`,`st`.`enemy`,`st`.`battle_text`,`st`.`upLevel`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`bot`,`st`.`lider`,`st`.`btl_cof`,
			`st`.`tactic1`,`st`.`tactic2`,`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`battleEnd`,
			`st`.`priemslot`,`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`res_x`,`st`.`res_y`,`st`.`res_s`,
			`st`.`id`,`st`.`last_hp`,`st`.`last_pr`,`u`.`sex`,`u`.`money`,`u`.`bot_id`,`u`.`money3`,`u`.`money2`
			FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = "'.$this->info['id'].'"');
            if($save_time2) dStart();

			$i = 0; $bi = 0;
            while($pl = mysql_fetch_array($t))
            {
                //записываем данные
                if($pl['login2']=='') $pl['login2'] = $pl['login'];

                $this->users[$i] = $pl;
                $this->uids[$pl['id']] = $i;

				if($pl['bot'] > 0)
                {
                    $this->bots[$bi] = $pl['id'];
                    $this->iBots[$pl['id']] = $bi;
                    $bi++;
                }
                //записываем статы
                if($save_time2 && $i<3) dStart();
                $this->stats[$i] = $u->getStats($pl,0,0,false,false,true);//Нагрузка ОВ?
                if($save_time2 && $i<3) dStart();
                $i++;
            }
			if($save_time2) dStart();
            unset($pl,$t);
            

            if($this->info['time_over']==0)
            {
                $tststrt = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$this->info['id'].'" AND `time_over` = "0" LIMIT 1'));
                if(isset($tststrt['id']))
				{
                    if( $this->info['inTurnir'] == 0 )
					{
                        mysql_query('UPDATE `battle` SET `time_over` = "'.time().'",`team_win` = "'.$this->info['team_win'].'"
						WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
                    }
                    mysql_query('UPDATE `battle_stat` SET `team_win` = "'.$this->info['team_win'].'" WHERE `battle_id` = "'.$this->info['id'].'"');
                    //Заносим данные о завершении боя
                    $i = 0; $vl = ''; $vtvl = ''; $tjor_team = 0;
                    if($save_time2) dStart();
					//Нагрузка ОВ?
					while($i<count($this->users))
                    {
						//Нулевой опыт - ловим...
                        if($this->users[$i]['stopexp']==0 && $this->users[$i]['bot'] == 0)
						{
							$exp_last = mysql_fetch_array(mysql_query('SELECT `exp` FROM `battle_last`
							WHERE `exp` > "0" AND `uid` = "'.$this->users[$i]['id'].'" ORDER BY `exp` DESC LIMIT 1'));

							if(isset($exp_last['exp']) && $this->users[$i]['exp'] < $exp_last['exp'])
							{
								eLog('Игрок: '.$this->users[$i]['id'].' Опыт за бой: '.$this->users[$i]['battle_exp'].' Опыт текущий: '.$this->users[$i]['exp'].' Предыдущий: '.$exp_last['exp']);
								$this->users[$i]['exp'] = round($exp_last['exp'] + $this->users[$i]['battle_exp']);
							}
						}
                        //Нулевой опыт - ловим...

      					if( $this->users[$i]['no_ip'] == 'trupojor' ) $tjor_team = $this->users[$i]['team'];//команда трупожора

                        $vl .= '("'.$this->users[$i]['login'].'","'.$this->users[$i]['city'].'","'.$this->info['id'].'","'.$this->users[$i]['id'].'","'.time().'","'.$this->users[$i]['team'].'","'.$this->users[$i]['level'].'","'.$this->users[$i]['align'].'","'.$this->users[$i]['clan'].'","'.$this->users[$i]['exp'].'","'.$this->users[$i]['bot'].'","'.$this->users[$i]['money'].'","'.$this->users[$i]['money2'].'","'.$this->users[$i]['money3'].'"),';
                        if($this->users[$i]['team'] == $this->info['team_win'] && $this->info['team_win'] > 0) $vtvl .= '<b>'.$this->users[$i]['login'].'</b>, ';

						$i++;
                    }
					//Нагрузка ОВ?
                    if($save_time2) dStart();

                    $this->info['players_c'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `login` NOT LIKE "%(зверь%" AND `battle` = "'.$this->info['id'].'" LIMIT 1'));
                    $this->info['players_c'] = $this->info['players_c'][0];

                    mysql_query('UPDATE `battle` SET `players_c` = "'.$this->info['players_c'].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');

                    if($vtvl != '')
					{
                        $vtvl = rtrim($vtvl,', ');
                        $vtvl = str_replace('"','\\\\\"',$vtvl);
                        $this->hodID++;
                        $vLog = 'time1='.time();
						$vtvl = 'Бой закончен, победа за '.$vtvl.'.';
                        $mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>$vtvl,'vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
                        $this->add_log($mass);
                    }else{
                        $this->info['players_cc'] = mysql_fetch_array(mysql_query('SELECT COUNT(`u`.`id`) FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `s`.`hpNow` > 0 AND `u`.`battle` = "'.$this->info['id'].'" AND `s`.`team` != "'.$u->info['team'].'" LIMIT 1'));
                        $this->info['players_cc'] = $this->info['players_cc'][0];
                        $this->info['players_cc2'] = mysql_fetch_array(mysql_query('SELECT COUNT(`u`.`id`) FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `s`.`hpNow` >= 1 AND `u`.`battle` = "'.$this->info['id'].'" AND `s`.`team` != "'.$u->info['team'].'" LIMIT 1'));
                        $this->info['players_cc2'] = $this->info['players_cc2'][0];
                        $inf_test = ', users: '.$this->info['players_cc'].' and '.$this->info['players_cc2'].'';
                        $this->hodID++;
                        $vLog = 'time1='.time();
						$vtvl = 'Бой закончен, ничья.';
                        $mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>$vtvl,'vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
                        $this->add_log($mass);
                   }
                   if($save_time2) dStart();

                    if( $this->info['type'] == 99 )
					{
                        //$this->hodID++;
                        //$this->expCoef += 50;

						$vLog = 'time1='.time();
						$vtvl = 'И победители стали калечить проигравших...';
                        $mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>$vtvl,'vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
                        $this->add_log($mass);

                        $i = 0; $vtvl = '';
                        $tr_nm = array(1 => 'легкую', 2 => 'среднюю', 3 => 'тяжелую', 4 => 'легкую', 5 => 'среднюю', 6 => 'тяжелую');
						$tr_nm2 = ($this->info['dark']==1 ? ' неизлечимую' : '');
                        if($save_time2) dStart();

                        while($i<count($this->users))
						{
                            if( $this->users[$i]['team'] != $this->info['team_win'] )
							{
                                $tr_pl = mysql_fetch_array(mysql_query('SELECT `id`,`v1` FROM `eff_users` WHERE `id_eff` = 4 AND `uid` = "'.$this->users[$i]['id'].'" AND `delete` = "0" ORDER BY `v1` DESC LIMIT 1'));
                                if( !isset($tr_pl['id']) || $tr_pl['v1'] < 3 || ($this->info['dark']==1 && $tr_pl['v1'] < 6) )
								{
                                    if($this->info['dark']==1)
									{
										if(isset($tr_pl['id'])) $tr_tp = ($tr_pl['v1'] < 4 ? rand(($tr_pl['v1']+3),6) : rand(($tr_pl['v1']+1),6));
                                        else $tr_tp = rand(4,6);
									} else $tr_tp = (isset($tr_pl['id']) ? rand(($tr_pl['v1']+1),3) : rand(1,3));

									$gen_end = ($this->users[$i]['sex'] == 1 ? 'а' : '');

                                    $vtvl = '<b>'.$this->users[$i]['login'].'</b> получил'.$gen_end.' повреждение: <font color=red>'.$tr_nm[$tr_tp].$tr_nm2.' травму</font>.<br>'.$vtvl;

                                    $this->addTravm($this->users[$i]['id'],$tr_tp,rand(3,5));
                                }
                            }
                            $i++;
                        }
                        if($save_time2) dStart();

						$mass['text'] = $vtvl;
                        $this->add_log($mass);
					}
					elseif($this->info['travmChance'] == 98)
					{
                        //$this->expCoef += 75;
                        $vLog = 'time1='.time();
						$vtvl = 'И победители стали калечить проигравших...';
                        $mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>$vtvl,'vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
                        $this->add_log($mass);
                        $i = 0; $vtvl = '';
                        if($save_time2) dStart();

                        while($i<count($this->users))
						{
                            if( $this->users[$i]['team'] != $this->info['team_win'] ) {
                                $tr_pl = mysql_fetch_array(mysql_query('SELECT `id`,`v1` FROM `eff_users` WHERE `id_eff` = 4 AND `uid` = "'.$this->users[$i]['id'].'" AND `delete` = "0" ORDER BY `v1` DESC LIMIT 1'));
                                if( !isset($tr_pl['id']) || $tr_pl['v1'] < 4 ) {
                                    if( $this->users[$i]['sex'] == 1 ) {
                                        $vtvl = '<b>'.$this->users[$i]['login'].'</b> получила повреждение: <font color=red>Неизлечимую травму</font>.<br>'.$vtvl;
                                    }else{
                                        $vtvl = '<b>'.$this->users[$i]['login'].'</b> получил повреждение: <font color=red>Неизлечимую травму</font>.<br>'.$vtvl;
                                    }
                                    //добавляем травму
                                    $insert = 1;
                                    $name='Неизлечимая травма';
                                    $stat=rand(1, 3); // пока без духовности
                                    $timeEnd=rand(2,5);// время травмы от 2 до 5 часов
                                    $data='add_s'.$stat.'=-'.($this->users[$i]['level']*3);
                                    $v1=4;
                                    $img = 'eff_travma3.gif';
                                    $timeEnd = $timeEnd*3600;
                                    $ztr = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `name` LIKE "%Защита от травм%" AND `delete` = 0 LIMIT 1'));
                                    if(isset($ztr['id']))
									{
                                        $insert = 0;
                                        $vtvl = '<font color=green><b>Персонаж '.$this->users[$i]['login'].' защищен магией...</b></font>';
                                    }elseif($insert > 0)
									{
                                        mysql_query('INSERT INTO `eff_users` (`overType`,`timeUse`,`hod`,`name`,`data`,`uid`, `id_eff`, `img2`, `timeAce`, `v1`) VALUES ("0","'.time().'","-1","'.$name.'","'.$data.'","'.$this->users[$i]['id'].'", "4", "'.$img.'","'.$timeEnd.'", "'.$v1.'")');
                                        $ins = mysql_query('INSERT INTO `eff_users` (`overType`,`timeUse`,`hod`,`no_Ace`,`name`,`data`,`uid`, `id_eff`, `img2`, `timeAce`, `v1`) VALUES ("0","'.time().'","-1","1","Иммунитет: Защита от травм","add_notravma=1","'.$this->users[$i]['id'].'", "263", "cure1.gif","10800", "")');
                                    }
                                }
                            }
                            $i++;
                        }
                        if($save_time2) dStart();
                        $mass['text'] = $vtvl;
                        $this->add_log($mass);
                	}

                    if($vl!='')
                    {
						$vl = rtrim($vl,',');
                        mysql_query('INSERT INTO `battle_last` (`login`,`city`,`battle_id`,`uid`,`time`,`team`,`lvl`,`align`,`clan`,`exp`,`bot`,`money`,`money2`,`money3`) VALUES '.$vl.'');
						
                    }
                    if($save_time2) dStart();
                }


                $vLog = 'time1='.time();
                $mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>$vtvl,'vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
                $this->add_log($mass);

				$i = 0; $vtvl = '';
                $tr_nm = array(
                    1 => 'легкую',
                    2 => 'среднюю',
                    3 => 'тяжелую'
                );
                if($save_time2) dStart();
                while($i<count($this->users))
				{
                    if( $this->users[$i]['team'] != $this->info['team_win'] && $this->info['team_win'] > 0 )
					{
                        $tr_pl = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `v1` = "priem" AND `v2` = 292 AND `uid` = "'.$this->users[$i]['id'].'" AND `delete` = "0" LIMIT 1'));

                        if( isset($tr_pl['id']) )
						{
                            if( rand(0,100) < $tr_pl['data'] )
							{
                                $tr_tp = rand(1,3);
                                if( isset($tr_pl['id']) ) {
                                    $tr_tp = rand(($tr_pl['v1']+1),3);
                                }
                                if( $this->users[$i]['sex'] == 1 ) {
                                    $vtvl = '<b>'.$this->users[$i]['login'].'</b> получила повреждение (Искалечить, автор: <b>'.$this->users[$this->uids[$tr_pl['user_use']]]['login'].'</b>): <font color=red>'.$tr_nm[$tr_tp].' травму</font>.<br>'.$vtvl;
                                }else{
                                    $vtvl = '<b>'.$this->users[$i]['login'].'</b> получил повреждение (Искалечить, автор: <b>'.$this->users[$this->uids[$tr_pl['user_use']]]['login'].'</b>): <font color=red>'.$tr_nm[$tr_tp].' травму</font>.<br>'.$vtvl;
                                }
                                $this->addTravm($this->users[$i]['id'],$tr_tp,rand(3,5));
                            }
                        }
                    }
                    $i++;
                }
                if($save_time2) dStart();

                if( $vtvl != '' )
				{
                    if( $this->info['type'] != 99 )
					{
                        $vtvl2 = 'И победители стали калечить проигравших...';
                        $mass['text'] = $vtvl2;
                        $this->add_log($mass);
                    }
                    $mass['text'] = $vtvl;
                    $this->add_log($mass);
                }

                //Турнир БС
                if( $this->info['inTurnir'] > 0 && $this->info['dungeon'] != 15 && $u->info['room'] != 413 )
				{
                    $bs = mysql_fetch_array(mysql_query('SELECT * FROM `bs_turnirs` WHERE `id` = "'.$this->info['inTurnir'].'" LIMIT 1'));
                    $i = 0; $j = 0;
                    if($save_time2) dStart();
                    while($i<count($this->users))
					{
                        if( $this->stats[$i]['hpNow'] < 1 && $this->users[$i]['clone'] == 0 && $this->stats[$i]['clone'] == 0 )
						{
                            //Удаляем из БС
                            //Добавляем в лог БС
                            if( $this->users[$i]['sex'] == 0 ) {
                                $text .= '{u1} повержен и выбывает из турнира';
                            }else{
                                $text .= '{u1} повержена и выбывает из турнира';
                            }
                            //Выкидываем предметы с персонажа
                            $spik = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `delete` ="0"');
                            while( $plik = mysql_fetch_array($spik) )
							{
                                mysql_query('INSERT INTO `dungeon_items` (`dn`,`item_id`,`time`,`x`,`y`) VALUES (
									"'.$this->users[$i]['dnow'].'","'.$plik['item_id'].'","'.(time()-600).'","'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'"
								)');
                            }
                            unset($spik,$plik);
                            //
                            $usrreal = '';
                            $usr_real = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`align`,`clan`,`battle`,`level` FROM `users` WHERE `login` = "'.$this->users[$i]['login'].'" AND `inUser` = "'.$this->users[$i]['id'].'" LIMIT 1'));
                            if( !isset($usr_real['id']) ) {
                                $usr_real = $this->users[$i];
                            }
                            if( isset($usr_real['id'])) {
                                $usrreal = '';
                                if( $usr_real['align'] > 0 ) {
                                    $usrreal .= '<img src=//img.testcombats.ru/i/align/align'.$usr_real['align'].'.gif width=12 height=15 >';
                                }
                                if( $usr_real['clan'] > 0 ) {
                                    $usrreal .= '<img src=//img.testcombats.ru/i/clan/'.$usr_real['clan'].'.gif width=24 height=15 >';
                                }
                                $usrreal .= '<b>'.$usr_real['login'].'</b>['.$usr_real['level'].']<a target=_blank href=//'.$c['host'].'/info/'.$usr_real['id'].' ><img width=12 hiehgt=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
                            }else{
                                $mereal = '<i>Невидимка</i>[??]';
                            }
                            $text = str_replace('{u1}',$usrreal,$text);
                            mysql_query('INSERT INTO `bs_logs` (`type`,`text`,`time`,`id_bs`,`count_bs`,`city`,`m`,`u`) VALUES (
								"1", "'.mysql_real_escape_string($text).'", "'.time().'", "'.$bs['id'].'", "'.$bs['count'].'", "'.$bs['city'].'",
								"'.round($bs['money']*0.85,2).'","'.$i.'"
							)');
                            //
                            //Удаление клона
                            mysql_query('DELETE FROM `users` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                            mysql_query('DELETE FROM `stats` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                            mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$this->users[$i]['id'].'"');
                            mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'"');
                            mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'"');
                            mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$this->users[$i]['id'].'"');
                            //Обновление персонажа
                            mysql_query('UPDATE `users` SET `inUser` = "0" WHERE `login` = "'.$this->users[$i]['login'].'" OR `inUser` = "'.$this->users[$i]['id'].'" LIMIT 1');
                            //Обновляем заявку
                            mysql_query('UPDATE `bs_zv` SET `off` = "'.time().'" WHERE `inBot` = "'.$this->users[$i]['id'].'" AND `off` = "0" LIMIT 1');
                            unset($text,$usrreal,$usr_real);
                            if( $this->users[$i]['pass'] != 'bstowerbot' ) {
                                $bs['users']--;
                                $bs['users_finish']++;
                            }else{
                                $bs['arhiv']--;
                            }
                            $j++;
                        }
                        $i++;
                    }
                    if($save_time2) dStart();
                    if( $j > 0 ) {
                        mysql_query('UPDATE `bs_turnirs` SET `arhiv` = "'.$bs['arhiv'].'",`users` = "'.$bs['users'].'",`users_finish` = "'.$bs['users_finish'].'" WHERE `id` = "'.$bs['id'].'" LIMIT 1');
                    }
                    unset($bs,$j);
                }
				
                //Награда за события
                if( $this->info['type'] == 500 && isset($tststrt['id']) )
				{
					//Предметы которые выпадают в центр
                    $i = 0;
					$tjor = 0;
                    if($save_time2) dStart();

                    while($i<count($this->users))
					{
						if( $this->users[$i]['no_ip'] == 'trupojor' )
						{
                            $tjor = 1;
							$mon = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_monsters` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1'));
                            if( isset($mon['id']) )
							{
                                if( $this->info['team_win'] == 0 )
								{
                                    //Ничья
                                    mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$i]['hpAll'].'",`mpNow` = "'.$this->stats[$i]['mpAll'].'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                                    mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`)
									VALUES ("<font color=red>Внимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$this->users[$i]['login'].'</b> ['.$this->users[$i]['level'].']<a target=_blank href=/info/'.$this->users[$i]['id'].' ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>',$mon['nich_text'])).' ","'.$this->users[$i]['city'].'","","3","1","'.time().'")');
                                }
								elseif( $this->info['team_win'] != $this->users[$i]['team'] )//Выиграли у трупожора
								{
                                    $j = 0; $usrwin = '';
                                    if($save_time2) dStart();
                                    while($j < count($this->users))
									{
                                        if( $this->users[$j]['no_ip'] != 'trupojor' && $this->users[$j]['bot'] == 0 )
										{
                                            //Выдаем предметы
                                            if($save_time2) dStart();
                                            $this->addGlobalItems($this->users[$i]['id'],$this->users[$j]['id'],$mon['win_itm'],$mon['win_eff'],$mon['win_ico'],$mon['win_exp'],$mon['win_money1'],$mon['win_money2']);
											if($save_time2) dStart();
											if( $this->stats[$j]['hpNow'] > 0 )
											{
                                                $usrwin .= ', ';
                                                if( $this->users[$j]['align'] > 0 ) {
                                                    $usrwin .= '<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$this->users[$j]['align'].'.gif >';
                                                }
                                                if( $this->users[$j]['clan'] > 0 ) {
                                                    $usrwin .= '<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$this->users[$j]['clan'].'.gif >';
                                                }
                                                $usrwin .= '<b>'.$this->users[$j]['login'].'</b> ['.$this->users[$j]['level'].']<a target=_blank href=/info/'.$this->users[$j]['id'].' ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
                                            }
										}
                                        $j++;
                                    }
                                    
									//Выдаем предметы рандомно, случайным игрокам, кроме ботов
									if($mon['win_itm_rand'])
									{
	                                    $arr_items = explode(',', $mon['win_itm_rand']);
	                                    $arr_users = array();
										foreach ($this->users as $win_user) if(!$win_user['bot']) $arr_users[] = $win_user;
										foreach($arr_items as $r_item)
										{
	                                    	$arr = explode('@', $r_item);
											if(count($arr_users) < $arr[1]) $arr[1] = count($arr_users);
											$rand_keys = array_rand($arr_users, $arr[1]);
											if(!is_array($rand_keys)) $rand_keys = array(0=>$rand_keys);//Если указано кол-во=1

	                                        $r_item_name = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($arr[0]).'" LIMIT 1'));
	                                        if($save_time2) dStart();
											foreach($rand_keys as $r_key)
											{
	                                            $u->addItem($arr[0], $arr_users[$r_key]['id']);
	                                            //eLog('Кожу получил: '.$arr_users[$r_key]['login']);
	                                            //if($save_exp && $arr_users[$r_key]['id']==$u->info['id']) $save_exp_arr[$arr_users[$r_key]['id']][1] = __LINE__.' Кожу получил.';

	                                            mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
												VALUES ('1','".$arr_users[$r_key]['city']."','".$this->users[$r_key]['room']."','','".$arr_users[$r_key]['login']."','<font color=#cb0000><b>Вы получили предметы:</b> ".mysql_real_escape_string($r_item_name['name'])."</font>','-1','3','0')");
											}
											if($save_time2) dStart();
										}
									}
                                    
                                    
                                    $usrwin = ($usrwin != '' ? ltrim($usrwin, ', ') : '<i>Команда героев</i>');

									//Интервал рестарта бота
                                    $time_restart = ($mon['time_start'] ? $mon['time_start'] + 60*$mon['time_restart'] : time() + 60*$mon['time_restart']);
                                    $this->users[$i]['battle'] = 0;

                                    mysql_query('UPDATE `users` SET `room` = "303", battle="0" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                                    mysql_query('UPDATE `stats` SET `res_x` = "'.$time_restart.'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                                    mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 100');
                                    mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`)
									VALUES ("<font color=red>Внимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$this->users[$i]['login'].'</b> ['.$this->users[$i]['level'].']<a target=_blank href=info/'.$this->users[$i]['id'].' ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>', str_replace('{u}',$usrwin,$mon['win_text'])  )).' ","'.$this->users[$i]['city'].'","","3","1","'.time().'")');

									if($save_time2) dStart();
									unset($usrwin);
                                }else{
                                    //Проиграли трупожору
                                    if( $mon['win_back'] == 1 ) mysql_query('UPDATE `users` SET `room` = "303" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');

                                    //
                                    $j = 0; $usrwin = '';
                                    while($j < count($this->users))
									{
                                        if( $this->users[$j]['no_ip'] != 'trupojor' && $this->users[$j]['bot'] == 0 )
										{
                                            if( $this->stats[$j]['hpNow'] <= 0 )
											{
                                                $usrwin .= ', ';
                                                if( $this->users[$j]['align'] > 0 )
												{
                                                    $usrwin .= '<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$this->users[$j]['align'].'.gif >';
                                                }
                                                if( $this->users[$j]['clan'] > 0 )
												{
                                                    $usrwin .= '<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$this->users[$j]['clan'].'.gif >';
                                                }
                                                $usrwin .= '<b>'.$this->users[$j]['login'].'</b> ['.$this->users[$j]['level'].']<a target=_blank href=/info/'.$this->users[$j]['id'].' ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
											}
                                        }
                                        $j++;
                                    }

									mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`)
         							VALUES ("<font color=red>Внимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$this->users[$i]['login'].'</b> ['.$this->users[$i]['level'].']<a target=_blank href=/info/'.$this->users[$i]['id'].' ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>', str_replace('{u}',$usrwin,$mon['lose_text'])  )).' ","'.$this->users[$i]['city'].'","","3","1","'.time().'")');
                                    unset($usrwin);
                                }
                            }

                            //if($save_exp) $save_exp_arr[$this->users[$i]['id']][2] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' battle_yron: '.round($this->users[$i]['battle_yron']).' uid: '.$this->users[$i]['id'];

                        } else {
                                if($tjor_team != 0)//Исправляем команду пользователя для логов - работает!
								{
									$my_team = mysql_fetch_array(mysql_query('SELECT `team` FROM `battle_users`
									WHERE `battle`="'.$this->info['id'].'" AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 1'));

                                    if($my_team['team'] == $tjor_team || $my_team['team'] == 0)
									{
                                        //eLog('Исправляем команду: btl:'.$this->info['id'].' my_team: '.$my_team['team'].' tjor: '.$tjor_team.' uid: '.$this->users[$i]['id']);
										
										$my_team_new = ($tjor_team==1 ? 2 : 1);
                                    	mysql_query('UPDATE `battle_users` SET `team` = "'.$my_team_new.'"
										WHERE `battle`="'.$this->info['id'].'" AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
									}
								}
							 }
                             $i++;
                    }
                    if($save_time2) dStart();
                }
            }

            // выкидываем ботов из боя
            if(!isset($tjor_id['uid']))
			{
				$i = 0; $botsi = 0;
	            if($save_time2) dStart();

	            while($i<count($this->users))
				{
	                if($save_time2) dStart();
					if($this->users[$i]['bot'] > 0)
					{
                        if($this->users[$i]['bot']==1)
						{
		                    $botsi++;
		                    mysql_query('DELETE FROM `users` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
		                    mysql_query('DELETE FROM `stats` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
		                    mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 100');
		                    if($save_time2) dStart();
						} else {
							$this->users[$i]['battle'] = 0;
	                    	mysql_query('UPDATE `users` SET `battle` = "0" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
	                    	mysql_query('UPDATE `stats` SET `zv` = "0",`team` = "0",`exp` = `exp` + `battle_exp`,`battle_exp` = "0",`timeGo` = "'.time().'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
						}

						mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 100');
	                    mysql_query('DELETE FROM `item_tactic` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
	                    if($save_time2) dStart($this->users[$i]['id']);
					
						if($this->users[$i]['clone'] > 0 && isset($this->users[$this->uids[$this->users[$i]['clone']]]['id'])
						&& $this->users[$this->uids[$this->users[$i]['clone']]]['team']!=$this->users[$i]['team'])
						{
                            if($save_time2) dStart();
							//Добавляем что клон побежден
		                    if($this->users[$this->uids[$this->users[$i]['clone']]]['team']==$this->info['team_win']) $u->addAction(time(),'win_bot_clone','',$this->users[$i]['clone']);
		                    elseif($this->info['team_win']==0) $u->addAction(time(),'nich_bot_clone','',$this->users[$i]['clone']);
		                    else $u->addAction(time(),'lose_bot_clone','',$this->users[$i]['clone']);

		                    if($save_time2) dStart();
		                }
						elseif($this->users[$i]['bot_id'] > 0)
						{
		                    if($save_time2) dStart();
							//Добавляем что бота победили
		                    $j = 0;
		                    while($j<count($this->users))
							{
		                        if($this->users[$j]['bot']==0 && $this->users[$j]['team']!=$this->users[$i]['team'])
								{
		                            if($this->users[$j]['team']==$this->info['team_win'])
									{
		                                $u->addAction(time(),'win_bot_'.$this->users[$i]['bot_id'],'',$this->users[$j]['id']);

		                                mysql_query('UPDATE `dialog_act` SET `now` = `now` + 1 WHERE `uid` = "'.$this->users[$j]['id'].'" AND
										( `btl_bot` LIKE "'.$this->users[$i]['bot_id'].'!%" OR `btl_bot` LIKE "%!'.$this->users[$i]['bot_id'].'!%" )
										AND `val` != 1 LIMIT 1');
		                            }
									elseif($this->info['team_win']==0) $u->addAction(time(),'nich_bot_'.$this->users[$i]['bot_id'],'',$this->users[$j]['id']);
		                            else $u->addAction(time(),'lose_bot_'.$this->users[$i]['bot_id'],'',$this->users[$j]['id']);
		                        }
		                        $j++;
		                    }
		                    if($save_time2) dStart();
		                }
                    }

	                $i++;
	            }
			}
			if($save_time2) dStart();
			
            $botss = array();
            if(true==true)
			{
                if($nl!=10)
				{
					$jbx = 0;
                    //Из бота падают предметы
                    if($save_time2) dStart();
                    if($this->info['dungeon']>0)
					{
                        if($this->info['team_win']==$u->info['team'] && $this->info['dungeon'] == 102)
						{
                            $j1 = mysql_fetch_array(mysql_query('SELECT * FROM `laba_obj` WHERE `type` = 2 AND `lib` = "'.$this->info['dn_id'].'"
							AND `x` = "'.$this->info['x'].'" AND `y` = "'.$this->info['y'].'" LIMIT 1'));

							if( isset($j1['id']) )
							{
                                mysql_query('DELETE FROM `laba_obj` WHERE `id` = "'.$j1['id'].'" LIMIT 1');
                                //Выпадает шмотка
                                mysql_query('INSERT INTO `laba_obj` (`use`,`lib`,`time`,`type`,`x`,`y`,`vars`) VALUES (
									"0","'.$j1['lib'].'","'.time().'","6","'.$j1['x'].'","'.$j1['y'].'","'.(0+$botsi).'"
								)');
                            }
                        }
						elseif($this->info['team_win']==$u->info['team'])
						{
							//выйграли люди, выкидываем предметы из мобов
                            $j1 = mysql_query('SELECT * FROM `dungeon_bots` WHERE `dn` = "'.$this->info['dn_id'].'" AND `for_dn` = "0" AND `x` = "'.$this->info['x'].'" AND `delete` = "0" AND `y`= "'.$this->info['y'].'" LIMIT 500');
                            while($tbot = mysql_fetch_array($j1))
							{
                               $jbx += $tbot['colvo'];
							   $j2 = 0;
                                while( $j2 < $tbot['colvo'] )
								{
                                    if( isset($tbot['id2']) )
									{
                                        $tbot2 = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id` = "'.$tbot['id_bot'].'" LIMIT 1'));
                                        $itms = explode('|',$tbot2['p_items']);
                                        $tii = 0;
                                        while($tii<count($itms))
										{
                                            $itmz = explode('=',$itms[$tii]);
                                            $tou = 0; //какому юзеру предназначено
											$onlyfor = 0;//кому показывать

											if($itmz[0]>0)
											{
                                                if( isset($itmz[2]) && $itmz[2] != '' )// $itmz[2] == quest888
												{ 
                                                    $questDrop = mysql_fetch_array(mysql_query('SELECT * FROM `actions` WHERE `vars` LIKE "%'.$itmz[2].'%" AND `vals` = "go" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
                                                    
													//if(in_array($itmz[2], array('quest369')))//Кости
													//{
														$tou = $u->info['id'];//Предмет не разыгрывается
														$onlyfor = $u->info['id'];//Видит только один
													//}
												}

												if( isset($questDrop['id']) ){}  // Если квест есть, предмет имеет шанс выпасть
                                                elseif( isset($itmz[2]) && $itmz[2] != '' ) $itmz[1]=0; // Если предмет квестовый, а квеста у игрока нет, то предмет выпадет с вероятностью 0
                                                unset($questDrop);

                                                //Добавляем этот предмет в зону Х и У
                                                if( $itmz[1] * 100000 >= rand(1,10000000) )
												{
                                                    $itmnm = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itmz[0].'" LIMIT 1'));
                                                    $itmnm = $itmnm['name'];

                                                    if($onlyfor>0) $rtxt = 'У <b>'.$tbot2['login'].'</b> был предмет &quot;'.$itmnm.'&quot; и вы можете поднять его';
													else $rtxt = 'У <b>'.$tbot2['login'].'</b> был предмет &quot;'.$itmnm.'&quot; и кто угодно может поднять его';
                                                    $to_login = ($onlyfor>0 ? $this->users[0]['login'] : '');

													mysql_query("INSERT INTO `chat` (`dn`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`,`new`)
													VALUES ('".$this->info['dn_id']."','".$this->users[0]['city']."','".$this->users[0]['room']."','','".$to_login."','".$rtxt."','".time()."','3','0','1','1')");

                                                    $ins = do_query('INSERT INTO `dungeon_items` (`dn`,`user`,`item_id`,`time`,`x`,`y`,`onlyfor`) VALUES (
													"'.$this->info['dn_id'].'",
													"'.$tou.'",
													"'.$itmz[0].'",
													"'.time().'",
													"'.$this->info['x'].'",
													"'.$this->info['y'].'",
													"'.$onlyfor.'")');
                                                }
                                            }
                                            $tii++;
                                        }
                                    }
                                    $j2++;
                                }
								// Ачивки
								//$this->info['botx'] = $j2;
								/* $i = 0;
								while($i < count($this->users))
								{
									if($this->users[$i]['bot']==0)
									{
                                        $arch = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1'));
										if(isset($arch['id']))
										{
											if( $this->info['dungeon'] > 0 ) $arch['a5'] += $j2;

											//mysql_query('UPDATE `achiev` SET `a5` = "'.$arch['a5'].'" WHERE `id` = "'.$arch['id'].'" LIMIT 1');
										}
									}
									$i++;
								} */

                                //
                                //Квест 1-15 сентября,
                                if( date('m') == 9 && date('d') < 15 )
								{
                                    if($this->get_chanse(99) == true) {
                                        //Не выпало
                                    }elseif($this->info['dungeon'] == 12 || $this->info['dungeon'] == 101 || $this->info['dungeon'] == 3 || $this->info['dungeon'] == 9 || $this->info['dungeon'] == 10 ) {
                                        $tou = 0; //какому юзеру предназначено
                                        /* выделяем случайного юзера из команды */
                                        $itmz = array(
                                            rand(4745,4751) , 100
                                        );
                                        //
                                        $itmnm = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itmz[0].'" LIMIT 1'));
                                        $itmnm = $itmnm['name'];

                                        $rtxt = 'У <b>'.$tbot2['login'].'</b> был предмет &quot;'.$itmnm.'&quot; и кто угодно может поднять его';
                                        mysql_query("INSERT INTO `chat` (`dn`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`,`new`) VALUES ('".$this->info['dn_id']."','".$this->users[0]['city']."','".$this->users[0]['room']."','','','".$rtxt."','".time()."','3','0','1','1')");

                                        $ins = mysql_query('INSERT INTO `dungeon_items` (`dn`,`user`,`item_id`,`time`,`x`,`y`) VALUES (
										"'.$this->info['dn_id'].'",
										"'.$tou.'",
										"'.$itmz[0].'",
										"'.time().'",
										"'.$this->info['x'].'",
										"'.$this->info['y'].'")');
                                    }
                                }
                                //
                            }

						$j51 = 0;
				    	while($j51 < count($this->users))
						{
							if($this->users[$j51]['bot']==0 && $this->info['team_win']==$this->users[$j51]['team'])
							{
								mysql_query('UPDATE `dailybonus` SET `dun_kill` = `dun_kill` + "'.$jbx.'"  WHERE `date_finish` != "'.date('d.m.Y').'" AND `uid` = "'.$this->users[$j51]['id'].'" LIMIT 1');
							}
						$j51++;
						}
                        mysql_query('UPDATE `dungeon_bots` SET `delete` = "'.time().'" WHERE `inBattle` = "'.$this->info['id'].'" AND `dn` = "'.$this->info['dn_id'].'" AND `for_dn` = "0" AND `delete` = "0" ');

                        }else{
                            //выкидываем всех игроков в клетку RESTART
                            $dnr = 1;
                            if( $this->info['dungeon'] != 102 ) {
                                mysql_query('UPDATE `dungeon_bots` SET `inBattle` = "0" WHERE `dn` = "'.$this->info['dn_id'].'" AND `for_dn` = "0" AND `x` = "'.$this->info['x'].'" AND `y`= "'.$this->info['y'].'"');
                            }
                        }
                    }
                    if($save_time2) dStart();
                }

                $gm = array(); $gms = array();
                $bm = array(); $bms = array();

                //Квестовый раздел
                $i = 0;
                if($save_time2) dStart();
                while($i < count($this->users))
				{
                    if($this->users[$i]['bot']==0 && $this->users[$i]['id'] == $u->info['id']) $q->bfinuser($this->users[$i],$this->info['id'],$this->info['team_win']);
                    $i++;
                }
                if($save_time2) dStart();
                //Квестовый раздел

                //завершаем поединок
                $i = $this->uids[$u->info['id']];
                if($save_exp) $save_exp_arr[$this->users[$i]['id']][7] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' battle_yron: '.round($this->users[$i]['battle_yron']);

			    if( $this->info['team_win'] >= 0 )
				{

				if(date('n')==1 && date('j') > 19 && date('j') < 23)//Опыт ДР клуба
				{
			        $this->expCoef += 200;
				}
				elseif( (date('n')==12 && date('j') > 24) || (date('n')==1 && date('j') < 9))//Опыт Новый Год
				{
			        $this->expCoef += 200;
				}
				elseif( $this->info['razdel'] == 5 && ($c['w'] == 0 || $c['w'] == 6))//Опыт Выходные дни
				{
			        $this->expCoef += 100;
				}

				if($save_exp) $save_exp_arr[$this->users[$i]['id']][8] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' battle_yron: '.round($this->users[$i]['battle_yron']);

				//Опыт за Премиум
				/* $premium = mysql_fetch_array(mysql_query('SELECT `type` FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete`>"'.time().'" LIMIT 1'));

				if($premium['type'] == 3)
				{
					$this->expCoef += 50;
				} */

				if($save_exp) $save_exp_arr[$this->users[$i]['id']][9] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' battle_yron: '.round($this->users[$i]['battle_yron']);

				//Опыт за VIP
				if($u->info['vip'] == 3)
				{
					$this->expCoef += 50;
				}
			    if($save_exp) $save_exp_arr[$this->users[$i]['id']][10] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' battle_yron: '.round($this->users[$i]['battle_yron']);


			    $this->stats[$i]['exp'] += $this->expCoef;
			    $this->stats[$i]['exp'] += $this->aBexp + $c['exp'];

				if($save_exp) $save_exp_arr[$this->users[$i]['id']][11] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' aBexp: '.$this->aBexp;

			    if( $this->stats[$i]['os4'] > 0)//Сообразительность
				{
			        $this->stats[$i]['exp'] += $this->stats[$i]['os4'];
			    }
			    if($save_exp) $save_exp_arr[$this->users[$i]['id']][12] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];

				$act01 = 0;
                if($save_time2) dStart();

				//Расчет опыта
			    $this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*(1+$this->info['addExp']+$this->stats[$i]['exp'])));
			    if($save_exp) $save_exp_arr[$this->users[$i]['id']][13] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];

			    //Опыт за статус битвы
                $buron = $u->BattleYron($this->info['id']);
			    $bType = $u->BattleType($buron);

				$btlstatus = ($this->info['type'] == 99 ? $bType[4] : $bType[3]);
			    $btlCoef = ($this->info['type'] == 99 ? $bType[2] : $bType[1]);
			    $this->users[$i]['battle_exp'] += $this->users[$i]['battle_exp'] * ($btlCoef - 1);

				if($save_time2) dStart();
			    if($save_exp) $save_exp_arr[$this->users[$i]['id']][14] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' dun: '.$this->info['dungeon'];

				if( $this->info['type'] == 564 )
				{
			    	//Бой с копией
			        $this->users[$i]['battle_exp'] = 0;
			    }

			    if( $this->info['dungeon'] == 10 || $this->info['dungeon'] == 12 || $this->info['dungeon'] == 101 || $this->info['dungeon'] == 7 || $this->info['dungeon'] == 3)
				{
			        $this->users[$i]['battle_exp'] = ($u->info['level']*5)*(count($this->uids)-1);
			    }
				elseif($this->info['dungeon'] > 0 && $this->users[$i]['dnow'] != 0 && $this->info['dungeon'] != 1  && $this->users[$i]['team']==$this->info['team_win'])
				{
			        $dun_limitForLevel = array( 8 => 150000, 9 => 300000, 10 => 500000, 11 => 750000);
			    	// Максимум для каждого уровня.

					    if( $this->users[$i]['battle_exp'] > 0 )
						{
					        $dun_exp = array(); // Текущий лимит опыта игрока в подземельях.
					        $rep = mysql_fetch_array(mysql_query('SELECT `dungeonexp`,`id` FROM `rep` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1'));
					        $rep = explode(',',$rep['dungeonexp']);
					    	foreach ($rep as $key=>$val)
							{
					        	$val = explode('=',$val); // текущий лимит опыта в подземке
					    		if( isset($val[0]) && isset($val[1]) && $val[0] !='' && $val[1] != 0 ) $dun_exp[(int)$val[0]] = (int)$val[1];
					    	}
					        unset($rep);
					    }

					    if( !isset($dun_exp[$this->info['dungeon']]) ) $dun_exp[$this->info['dungeon']] = 0;

					    if( !isset($dun_limitForLevel[(int)$this->users[$i]['level']]) )
						{ // Если лимит не задан, опыт не даем.
					        $this->users[$i]['battle_exp'] = 0;
					    } elseif(isset($dun_exp[$this->info['dungeon']]) &&
					        $dun_exp[$this->info['dungeon']] >= $dun_limitForLevel[(int)$this->users[$i]['level']]) { // Если лимит уже достигнут, опыт не даем.
					        $this->users[$i]['battle_exp'] = 0;
					    } elseif(isset($dun_exp[$this->info['dungeon']]) &&
					        $dun_limitForLevel[(int)$this->users[$i]['level']] > $dun_exp[$this->info['dungeon']])
							{ // Если текущая репутация не достигла лимита.
					    if( ( $dun_exp[$this->info['dungeon']] + $this->users[$i]['battle_exp'] ) > $dun_limitForLevel[(int)$this->users[$i]['level']] ) {
					    // Если опыта набрано достаточно, для достижения лимита.
					        $this->users[$i]['battle_exp'] = abs($this->users[$i]['battle_exp'] - abs( $dun_limitForLevel[(int)$this->users[$i]['level']] - ( $this->users[$i]['battle_exp'] + $dun_exp[$this->info['dungeon']] ) ));
					        $dun_exp[$this->info['dungeon']] += $this->users[$i]['battle_exp'];
					    }
						elseif( $dun_limitForLevel[(int)$this->users[$i]['level']] > ( $dun_exp[$this->info['dungeon']] + $this->users[$i]['battle_exp'] ) )
						{
					    	// Если опыта недостаточно, для достижения лимита.
					        $this->users[$i]['battle_exp'] = $this->users[$i]['battle_exp'];
					        $dun_exp[$this->info['dungeon']] += $this->users[$i]['battle_exp'];
					    } else {
					        $this->users[$i]['battle_exp'] = 0;
					    }
					    } else { // В любой непонятной ситуцаии.
					        $this->users[$i]['battle_exp'] = 0;
					    }


			            if( $this->users[$i]['battle_exp'] > 0 && isset($dun_exp[$this->info['dungeon']]) && $dun_exp[$this->info['dungeon']] > 0 )
						{
			                $dunexp = array();
			                foreach ($dun_exp as $key=>$val)
							{
			                    $dunexp[$key] = $key.'='.$val; // текущий лимит опыта в подземке
			                }
			                $dun_exp = implode(",",$dunexp);
			                mysql_query('UPDATE `rep` SET `dungeonexp` = "'.$dun_exp.'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
			                unset($dunexp,$dun_exp);
			            }
			            unset($dun_limitForLevel);
			    }
                	if($save_time2) dStart();
    				if($save_exp) $save_exp_arr[$this->users[$i]['id']][15] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];

                    $sinf = '';

                    if( $c['exp_mega'] == true )
					{
                        $this->users[$i]['battle_exp'] += floor($this->users[$i]['battle_exp']/100*$c['exp_mega_val'][$this->users[$i]['level']]);
                    }

					if($this->info['team_win']==0 && $this->info['type'] != 564)
					{
	                    if($this->users[$i]['level'] <= 1){
	                            $this->users[$i]['battle_exp'] = floor($this->users[$i]['battle_exp']*0.50);
	                    }else{
	                        $this->users[$i]['battle_exp'] = ceil($this->users[$i]['battle_exp']*0.10);
	                    }
						if( $this->info['razdel'] == 5 ) {
							$this->users[$i]['bonus_db']['haot_daily']++;
						if( $this->users[$i]['bonus_db']['haot'] > 0 ) {
							$this->users[$i]['bonus_db']['haot']--;
						}
						}
						if( $this->info['razdel'] > 0 ) {
							$this->users[$i]['bonus_db']['fight_daily']++;
						}
	                        $this->users[$i]['nich'] += 1;
                    }
					elseif($this->users[$i]['team']==$this->info['team_win'] && $this->info['type'] != 564)
					{
                        $gm[$i] = $this->info['money'];
                        $gms[$i] = $this->info['money3'];
                        $this->users[$i]['win'] += 1;
						if( $this->info['razdel'] == 5 )
						{
					    	$this->users[$i]['bonus_db']['haot_daily']++;
							$this->users[$i]['bonus_db']['winhaot_daily']++;
							if( $this->users[$i]['bonus_db']['haot'] < 200 )
							{
								$this->users[$i]['bonus_db']['haot']++;
							}
						}
						if( $this->info['razdel'] >= 0 )
						{
							$this->users[$i]['bonus_db']['winfight_daily']++;
						}
                        $act01 = 1;
                    }
					elseif( $this->info['type'] != 564 )
					{
                        if($this->users[$i]['level']<=1){
                            $this->users[$i]['battle_exp'] = ceil($this->users[$i]['battle_exp']*0.33);
	                    }else{
	                        $this->users[$i]['battle_exp'] = ceil($this->users[$i]['battle_exp']*0.10);
	                    }
	                        $bm[$i] = $this->info['money'];
	                        $bms[$i] = $this->info['money3'];
	                        $this->users[$i]['lose'] += 1;
						if( $this->info['razdel'] == 5 ) {
							$this->users[$i]['bonus_db']['haot_daily']++;
						if( $this->users[$i]['bonus_db']['haot'] > 0 ) {
							$this->users[$i]['bonus_db']['haot']--;
						}
						}
						if( $this->info['razdel'] > 0 ) {
							$this->users[$i]['bonus_db']['fight_daily']++;
						}
                        $act01 = 2;
                    }
                    if($save_exp) $save_exp_arr[$this->users[$i]['id']][16] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' battle-type:'.$this->info['type'];

                if($save_time2) dStart();

				//Ачивки
				/* if($this->users[$i]['team']==$this->info['team_win'])
				{
					//Для бс и турниров - выбор uid реального пользователя
					$usr_real = mysql_fetch_array(mysql_query('SELECT `id`,`room` FROM `users`
					WHERE `login` = "'.$this->users[$i]['login'].'" AND `inUser` = "'.$this->users[$i]['id'].'" LIMIT 1'));

					$uid_bs = (isset($usr_real['id']) ? $usr_real['id'] : $this->users[$i]['id']);

					$arch = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$uid_bs.'" LIMIT 1'));
					if(isset($arch['id']))
					{
						if( $this->info['razdel'] == 1 || $this->info['razdel'] == 2 )
						{
							$arch['a1']++;
						}
						if( $this->info['razdel'] == 5 )
						{
							$arch['a6']++;
						}
						if( $this->info['priz'] == 1 )
						{
							$arch['a9']++;
						}
                        if( ($this->info['inTurnir'] > 0 || $this->info['inTurnirnew']>0) && $this->info['dungeon'] == 6)//if($this->info['dungeon'] != 17 && $u->info['room'] != 413)
						{
                            $arch['a10']++;
						}
                        elseif($usr_real['room'] == 414)//Руины
						{
                            $arch['a7']++;
						}

						$arch['a2']++;

						$result = mysql_query('UPDATE `achiev` SET `a1` = "'.$arch['a1'].'",`a2` = "'.$arch['a2'].'",`a6` = "'.$arch['a6'].'",
						`a7` = "'.$arch['a7'].'",`a9` = "'.$arch['a9'].'",`a10` = "'.$arch['a10'].'",`a11` = "'.$arch['a11'].'"
						WHERE `id` = "'.$arch['id'].'" LIMIT 1');
					}
				} */
                	if($save_time2) dStart();
                	if($save_exp) $save_exp_arr[$this->users[$i]['id']][17] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];

					if(isset($this->users[$i]['bonus_db']['winhaot_daily']))
					{
						mysql_query('UPDATE `dailybonus` SET `haot` = `haot` + 1 , `winhaot` = `winhaot` + 1 WHERE `date_finish` != "'.date('d.m.Y').'" AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
					}
					elseif(isset($this->users[$i]['bonus_db']['haot_daily']))
					{
						mysql_query('UPDATE `dailybonus` SET `haot` = `haot` + 1 WHERE `date_finish` != "'.date('d.m.Y').'" AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
					}
					if(isset($this->users[$i]['bonus_db']['winfight_daily']))
					{
						mysql_query('UPDATE `dailybonus` SET `fight` = `fight` + 1 , `winfight` = `winfight` + 1 WHERE `date_finish` != "'.date('d.m.Y').'" AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
					}
					elseif(isset($this->users[$i]['bonus_db']['fight_daily']))
					{
						mysql_query('UPDATE `dailybonus` SET `fight` = `fight` + 1 WHERE `date_finish` != "'.date('d.m.Y').'" AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
					}
                    if($save_time2) dStart();
                    //Рассчитываем кол-во выигрышных сумм и кто сколько получил (для екр.)
                    if( $this->info['money3'] > 0 && isset($gms[$i])  && $this->info['type'] != 564 )
					{
                        $mn = array(
                            'l'  => 0, //сколько проигравших игроков
                            'w'  => 0, //сколько выигрывших игроков
                            'm' => 0   //сумма выигрыша (общая)
                        );
                        if( $act01 == 1 )
						{
                            $mn['l'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `battle_users` WHERE `battle` = "'.$this->info['id'].'" AND `team` != "'.$this->users[$i]['team'].'" LIMIT 1'));
                            $mn['l'] = $mn['l'][0];
                            $mn['w'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `battle_users` WHERE `battle` = "'.$this->info['id'].'" AND `team` = "'.$this->users[$i]['team'].'" LIMIT 1'));
                            $mn['w'] = $mn['w'][0];
                            $mn['m'] = round(($mn['l']*$this->info['money3'])/100*87,2);
                            $gms[$i] = round(($mn['m']/$mn['w']),2);
                        }
                    }
                    if($save_time2) dStart();
                    //
                    //заносим данные в БД
                    //Поломка предметов
                    if($act01==1) {
                        $lom = 0;
                    }elseif($act01==2){
                        //поражение
                        $lom = 0.75;
                    }else{
                        //ничья
                        $lom = 0.50;
                    }
                    $nlom = array(0=>rand(0,18),1=>rand(0,18),2=>rand(0,18),3=>rand(0,18));
                    if($this->info['type'] == 564) $lom = 0;

                    mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW`+'.$lom.' WHERE `inOdet` < "18" AND `inOdet` > "0"
					AND `uid` = "'.$this->users[$i]['id'].'" AND `inOdet`!="0" AND `inOdet`!='.$nlom[0].' AND `inOdet`!='.$nlom[1].'
					AND `inOdet`!='.$nlom[2].' AND `inOdet`!='.$nlom[3].' LIMIT 18');
                    if($save_time2) dStart();
                    $prc = '';

					if($save_exp) $save_exp_arr[$this->users[$i]['id']][18] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];

                    //Восстановление потеряного опыта c Трупожором
					if($tjor_id['uid'] && $tjor_id['uid'] != $this->users[$i]['id'] && $this->users[$i]['stopexp']==0 && $this->users[$i]['battle_yron'] > 0)
					{
	                    $mon = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_monsters` WHERE `uid` = "'.$tjor_id['uid'].'" LIMIT 1'));
	                    $hpAll_1pr = $tjor_id['hpAll'] / 100;
		            	$exp_1pr = $mon['win_exp'] / 100;
                        if($save_exp) $save_exp_arr[$this->users[$i]['id']][19] = __LINE__.' tjor_id[hpAll]: '.$tjor_id['hpAll'].' hpAll_1pr: '.$hpAll_1pr.' exp_1pr: '.$exp_1pr.' battle_exp: '.$this->users[$i]['battle_exp'];

						if($hpAll_1pr > 0)
						{
		            		$hpAll_pr = $this->users[$i]['battle_yron']/$hpAll_1pr;
							if($hpAll_pr > 100) $hpAll_pr = 100;
							$exp_rec = round($hpAll_pr * $exp_1pr);
                            if($save_exp) $save_exp_arr[$this->users[$i]['id']][20] = __LINE__.' hpAll_pr: '.$hpAll_pr.' hpAll_1pr: '.$hpAll_1pr.' exp_1pr: '.$exp_1pr.' exp_rec: '.$exp_rec.' battle_exp: '.$this->users[$i]['battle_exp'];

                            if(round($this->users[$i]['battle_exp']) < $exp_rec)
							{
                                if($save_exp) $save_exp_arr[$this->users[$i]['id']][21] = __LINE__.' fixed exp! hpAll_pr: '.$hpAll_pr.' hpAll_1pr: '.$hpAll_1pr.' exp_1pr: '.$exp_1pr.' exp_rec: '.$exp_rec.' battle_exp: '.$this->users[$i]['battle_exp'].' battle_yron: '.round($this->users[$i]['battle_yron']);
								$this->users[$i]['battle_exp'] = $exp_rec;
							}
						}
					}
                    if($save_time2) dStart();
	                //Восстановление потеряного опыта c Трупожором

					if($this->users[$i]['align'] == 2) $this->users[$i]['battle_exp'] = floor($this->users[$i]['battle_exp']/2);//Хаос - повтор ниже

                    if($save_exp) $save_exp_arr[$this->users[$i]['id']][22] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' align: '.$this->users[$i]['align'];

                    if($this->users[$i]['animal'] > 0)//Опыт зверю
					{
                        $ulan = $u->testAction('`uid` = "'.$this->users[$i]['id'].'" AND `vars` = "animal_use'.$this->info['id'].'" LIMIT 1',1);
                        if(isset($ulan['id']) && $this->users[$i]['team']==$this->info['team_win'] && $this->users[$i]['level'] > $ulan['vals'])
						{
                            $a004 = mysql_fetch_array(mysql_query('SELECT `max_exp`,`name` FROM `users_animal` WHERE `uid` = "'.$this->users[$i]['id'].'"
							AND `id` = "'.$this->users[$i]['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));

							//33% от опыта переходит зверю, но не более максимума
                            $aexp = round($this->users[$i]['battle_exp']/100*33);
                            if($aexp > $a004['max_exp']) $aexp = $a004['max_exp'];
                            unset($ulan);
                            //
                            mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`
								) VALUES (
								'1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."'
								,'Ваш питомец &quot;".$a004['name']."&quot; получил опыт: <b>".$aexp."</b>','-1','3','0')");
                            //
                            $upd = mysql_query('UPDATE `users_animal` SET `exp` = `exp` + '.$aexp.' WHERE `id` = "'.$this->users[$i]['animal'].'"
							AND `level` < '.$this->users[$i]['level'].' LIMIT 1');

							if($upd)
							{
                                $this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']/100*67);
                                $this->info['addExp'] -= 33.333;
                            }
                            if($save_exp) $save_exp_arr[$this->users[$i]['id']][23] = __LINE__.' Питомец: '.$a004['name'].' Опыт: '.$aexp.' battle_exp:'.$this->users[$i]['battle_exp'].'  battle_yron: '.round($this->users[$i]['battle_yron']);
                        }
                    }
                    if($save_time2) dStart();

                    if($save_exp) $save_exp_arr[$this->users[$i]['id']][24] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' animal: '.$this->users[$i]['animal'];

					//Опыт за рейтинг клана
                    if( $this->stats[$i]['clanpos'] > 0 && $this->stats[$i]['clanpos'] < 6)
					{
						$clanpos_exp = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0);
                        $this->info['addExp'] += $clanpos_exp[$this->stats[$i]['clanpos']];
                    }
                    if($save_exp) $save_exp_arr[$this->users[$i]['id']][25] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' clanpos: '.$this->stats[$i]['clanpos'];

                    //if($this->users[$i]['align']==2 || $this->users[$i]['haos'] > time()) $this->stats[$i]['exp'] = -($this->info['addExp']+50);

                    if($save_exp) $save_exp_arr[$this->users[$i]['id']][26] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];

				    if($this->info['addExp']+$this->stats[$i]['exp'] != 0) $prc = ' ('.((100+$this->info['addExp']+$this->stats[$i]['exp']) + $btlCoef*100-100).'%)';//проценты в скобках

				    if($this->info['money'] > 0)
					{
					    if(isset($gm[$i]))
						{
					        $prc .= ' Вы выйграли <b>'.$gm[$i].' кр.</b> за этот бой.';
					        $u->addDelo(4,$this->users[$i]['id'],'&quot;<font color="olive">System.battle</font>&quot;: Персонаж выйграл <b>'.$gm[$i].' кр.</b> (В бою №'.$this->info['id'].').',time(),$this->info['city'],'System.battle',0,0);
					        $this->users[$i]['money'] += $gm[$i];
					    }
						elseif(isset($bm[$i]))
						{
					        $prc .= ' Вы заплатили <b>'.$bm[$i].' кр.</b> за этот бой.';
					        $u->addDelo(4,$this->users[$i]['id'],'&quot;<font color="olive">System.battle</font>&quot;: Персонаж <i>проиграл</i> <b>'.$gm[$i].' кр.</b> (В бою №'.$this->info['id'].').',time(),$this->info['city'],'System.battle',0,0);
					        $this->users[$i]['money'] -= $bm[$i];
					    }
					}
    
                    if( $c['money_haot'] == true )
					{
                        if( $act01 == 1 && $this->info['razdel'] == 5 && $this->users[$i]['level'] >= 6 )
						{
                            //Сколько нужно опыта набить
                            $trexp = array(
								7 => 1000,
                                8 => 1500,
                                9 => 2000,
                                10 => 5000,
                                11 => 12000,
                                12 => 20000
                            );
                            $trexp = $trexp[$this->users[$i]['level']];

                            //Какая цена фулла должна быть
                            $trmn = array(
								7 => 1000,
                                8 => 1600,
                                9 => 2000,
                                10 => 2500,
                                11 => 3000,
                                12 => 3000
                            );
                            $trmn = $trmn[$this->users[$i]['level']];

                            //Сколько екр дается
                            $admn = array(
								7 => 0.00,
                                8 => 0.00,
                                9 => 0.00,
                                10 => 0.00,
                                11 => 0.00,
                                12 => 0.00,
                                13 => 0.00
                            );
                            $admn = $admn[$this->users[$i]['level']];

                            if( $c['m'] >= 6 && $c['m'] <= 8 ) {
                                $admn = $admn * 2;//Летний период
                            }elseif( $c['w'] == 0 || $c['w'] == 6 ) {
                                $admn = $admn * 2;//Выходные дни
                            }elseif((date('n')==12 && date('j') > 24) || (date('n')==1 && date('j') < 9)){
			        			$admn = $admn * 2;//Новый Год
							}elseif($this->users[$i]['stopexp'] > 0 || $this->users[$i]['twink'] > 0) {
                                $admn = 0;
                            }

							if( $this->info['priz'] == 1 )//призовой
							{
							    if($this->users[$i]['team']==$this->info['team_win'])
								{
	                                $admn = $admn * 2;

									//Призовая монетка
									$priz_money = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "priz_money'.$this->info['id'].'" LIMIT 1', 2);
									if(!$priz_money[0])//Иначе дает 2 монетки при юзе кольца алтаря 3135
									{
										$u->addItem(7532, $u->info['id'], null, null, null, 1);
                                    	$u->addAction(time(), 'priz_money'.$this->info['id'], '', $u->info['id']);
										//eLog($this->users[$i]['id']);
									}
								} else $admn = $admn * 1;
                        	}
                            if( $this->users[$i]['battle_exp'] < $trexp )
							{
                                $prc .= ', Награда за этот бой (Мало опыта набили).';
                            }
							elseif( $this->stats[$i]['prckr'] < $trmn )
							{
                                $prc .= ', Награда за этот бой.';
                            }
							elseif($this->users[$i]['stopexp'] > 0)
							{
                                $prc .= ', Награда за этот бой (У вас активировна заморозка опыта).';
                            }
							elseif( $admn > 0 )
							{
                                $prc .= ', Награда  за этот бой.';
                                $u->addDelo(4,$this->users[$i]['id'],'&quot;<font color="olive">System.battle</font>&quot;: Персонаж получил Призовой Жетон</b> (В бою №'.$this->info['id'].').',time(),$this->info['city'],'System.battle',0,0);
                                //$this->users[$i]['money2'] += $admn;
                            }
                        }
                    }
                    if($save_time2) dStart();
					
					//Благословение [ID:4466]
					//Отключать лимит при свитке в определенных комнатах
					//$limited_rooms = array(2,4,5,7,16,233,343,342,376,220,344,402,340,375,339);

					//if(in_array($this->users[$i]['room'], $limited_rooms))
					if($this->info['razdel'] == 5) $has_svit = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE
					`id_eff`=36 AND `uid` = "' . $this->users[$i]['id'] . '" AND `delete` = "0" LIMIT 1'));

                    //if($this->users[$i]['id']==1) $this->users[$i]['battle_exp'] *= 10000;//dg!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                    if($save_exp) $save_exp_arr[$this->users[$i]['id']][27] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];
                    
					//Занижение опыта в 2 раза для победителей и в 10 - для проигравших
                    if($this->users[$i]['team'] != $this->info['team_win']) $this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']/10);
					//elseif(!isset($tjor_id['uid'])) $this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']/100*50);

					if($save_exp) $save_exp_arr[$this->users[$i]['id']][28] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];

					//лимит опыта
					if(!isset($has_svit['id']))
					{
						$exp_limit = array(0 => 100, 1 => 120, 2 => 220, 3 => 230, 4 => 350, 5 => 750, 6 => 1400, 7 => 8100, 8 => 27000, 9 => 42000, 10 => 84000, 11 => 120000, 12 => 215000,);
                        if($this->users[$i]['level'] < 12) $exp_limit2 = $btlCoef * $exp_limit[$this->users[$i]['level']];
						//else $exp_limit2 = $btlCoef * $exp_limit[12];

						if($this->users[$i]['battle_exp'] > $exp_limit2) $this->users[$i]['battle_exp'] = $exp_limit2;
					}

                    if($save_exp) $save_exp_arr[$this->users[$i]['id']][29] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' btlCoef: '.$btlCoef;

					//x2 опыт если поединок на улице
                    //if(in_array($this->users[$i]['room'], array(9,11,323))) $this->users[$i]['battle_exp'] += round($this->users[$i]['battle_exp']);
                    
                    if( $this->users[$i]['stopexp'] == 1 )$this->users[$i]['battle_exp'] = 0;//заморозка опыта

					if($save_exp) $save_exp_arr[$this->users[$i]['id']][30] = __LINE__.' expcoef: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'];

					//$prc .= ' ('.$btlstatus.')';
                    //if($save_time2) dStart();
                   /*  if($this->info['dungeon'] == 1 && $this->users[$i]['team']==$this->info['team_win'])
					{
                        //канализация лимит
                        $rep = mysql_fetch_array(mysql_query('SELECT `dl1`,`id` FROM `rep` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1'));
                        if($rep['dl'.$this->info['dungeon']] > 0)
						{
                            $this->users[$i]['battle_exp'] += 3*count($this->users);
                            if($rep['dl'.$this->info['dungeon']] > $this->users[$i]['battle_exp'])
							{
                                $rep['dl'.$this->info['dungeon']] -= $this->users[$i]['battle_exp'];
                            }else{
                                $this->users[$i]['battle_exp'] = $rep['dl'.$this->info['dungeon']];
                                $rep['dl'.$this->info['dungeon']] = 0;
                            }
                            mysql_query('UPDATE `rep` SET `dl'.$this->info['dungeon'].'` = "'.$rep['dl'.$this->info['dungeon']].'" WHERE `id` = "'.$rep['id'].'" LIMIT 1');
                        }else{
                            $this->users[$i]['battle_exp'] = 0;
                        }
                    }
                    if($save_time2) dStart();

					if($this->users[$i]['battle_exp'] < 0)//Отрицательный опыт
					{
						$this->users[$i]['battle_exp'] = abs($this->users[$i]['battle_exp']);
						if($save_exp) $save_exp_arr[$this->users[$i]['id']][34] = __LINE__.' Отрицательный опыт. Битва: '.$this->info['id'].' Игрок: '.$u->info['login'].' battle_exp: '.$this->users[$i]['battle_exp'];
                    }*/

					if($this->users[$i]['battle_exp'] < 1) $this->users[$i]['battle_exp'] = 0;

					if($this->users[$i]['battle_exp'] < 1 && $this->users[$i]['twink'] == 0 && $this->info['money'] == 0
					&& $this->info['money3'] == 0 && $this->info['kingfight'] == 0 && (!isset($admnb) || $admnb == 0))
					{
                        $prc = '';
                    } 

                    if($this->users[$i]['host_reg'] == 'real_bot_user') $this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']/3);
                    
                    if($save_exp) $save_exp_arr[$this->users[$i]['id']][31] = __LINE__.' '.$u->info['login'].':  battle_exp: '.$this->users[$i]['battle_exp'].'  battle_yron: '.round($this->users[$i]['battle_yron']).' stop_exp: '.$this->users[$i]['stopexp'].' level: '.$this->users[$i]['level'].' team: '.$this->users[$i]['team'].' = '.$this->info['team_win'];

					//Запись в лог выбранных пользователей
					if($save_exp && is_array($save_exp_arr))
					{
						foreach($save_exp_arr as $key => $value)
						{
							if($this->users[$i]['battle_exp'] < 500 || $c['test_server']==1)
							{
	                            $count = count($value);
                                //$log_lines = array(0,1,9,14,16,19,20,22,23,24,25,29,30,31,33,34);
                                $log_lines = array(31);

								if($count) eLog('===============================uid:'.$key.'===============================');
								foreach($value as $key2 => $value2 )
								{
									if(in_array($key2, $log_lines)) eLog($value2);
								}
		                        if($count) eLog('===============================uid:'.$key.'===============================');
							}
						}
					}
					//eLog($save_exp_arr);
                    if($save_time2) dStart();
                    //Запись в лог урона для выбранных пользователей

					if( $sinf != '' ) $sinf = ' ( '.$sinf.' )';

					if($this->info['razdel'] != 5 && $this->users[$i]['stopexp'] > 0 && $this->users[$i]['battle_yron']) $prc .= ' (У вас активировна заморозка опыта)';
					//eLog($this->info['razdel'].' : '.$this->users[$i]['stopexp'].' : '.$this->users[$i]['battle_yron']);

                    $this->users[$i]['battle_text'] = 'Бой закончен. Всего вами нанесено урона: <b>'.floor($this->users[$i]['battle_yron']).' HP</b>. Получено опыта: <b>'.(0+$this->users[$i]['battle_exp']).'</b>'.$prc.'.'.$sinf;; //stats
					do_query('DELETE FROM `item_tactic` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
					do_query('DELETE FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "sanich3" LIMIT 1');
					do_query('DELETE FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "sanich1" LIMIT 1');
					do_query('DELETE FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "sanich2" LIMIT 1');
					
					
                    if( $this->info['kingfight'] == 1 )
					{
                        $tmon = array(
                            7 => 2,
							8 => 2,
                            9 => 2,
                            10 => 2,
                            11 => 2,
                            12 => 2,
                        );
                    	$tmon = $tmon[$this->users[$i]['level']];
					}
					//Кровавый рубин
					if($save_time2) dStart();
					$bloodring2 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `blood_battle` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1'));
					$bloodring2 = $bloodring2[0];

					if( $bloodring2 > 0 )
					{
						if($this->users[$i]['team']==$this->info['team_win'])
						{
							$i = 0;
							while( $i < $bloodring2 )
							{
								$u->addItem(3136,$u->info['id'],'|sudba='.$u->info['login']);
								$i++;
							}
							if( $bloodring2 > 1 ) $bloodring2 = ' (x'.$bloodring2.')';
							else $bloodring2 = '';

							mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
							VALUES ('1','".$u->info['city']."','0','','".$u->info['login']."','Вы получили предмет &quot;<b>Кровавый Рубин</b>".$bloodring2."&quot;','".time()."','6','0')");
						}
						mysql_query('DELETE FROM `blood_battle` WHERE `uid` = "'.$u->info['id'].'"');
					}
                    if($save_time2) dStart();

                    if( $this->info['razdel'] == 5 || $this->info['razdel'] == 4)
					{
                        if( date('d.m') == '31.10' || (date('m') == 11 && date('d') < 8) )
						{
                            //Хэллоуин
                            $this->users[$i]['battle_text'] .= ' Вы получаете <b>Тыква (x1)</b>.';
                            $u->addItem(4504,$this->users[$i]['id']);
                        }
                    }
					else
                    if($save_time2) dStart();
 					if($this->users[$i]['dnow'] > 0)
					{
                        if( date('d.m') == '31.10' || (date('m') == 11 && date('d') < 8) )
						{
                            //Хэллоуин
                            $this->users[$i]['battle_text'] .= ' Вы получаете <b>Семена (x1)</b>.';
                            $u->addItem(6703,$this->users[$i]['id']);
                        }elseif($this->info['dungeon'] == 15 && $this->users[$i]['team']==$this->info['team_win'])
						{
                            mysql_query('UPDATE `items_users` SET `uid` = "'.$this->users[$i]['id'].'" WHERE `item_id` = 4910 AND `delete` = 0 LIMIT 1');
                        }
						elseif($this->info['dungeon'] == 15 && $this->users[$i]['team']!=$this->info['team_win'])
						{
                            mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`img2`) VALUES ("2","'.$this->users[$i]['id'].'","Путы","puti='.(time()+20).'","1","'.(time()+20).'","chains.gif") ');
                        }
                    }
					if($save_time2) dStart();
					//Хаоты
					if( $this->info['razdel'] == 5 && $this->users[$i]['battle_yron'] > 0)//Хаоты Череп Врага
					{
						$chance = ($this->users[$i]['team']==$this->info['team_win'] ? 100 : 10);

						 if(( rand(0,100) <= $chance))
						{
                        	$this->users[$i]['battle_text'] .= ' Вы получаете <b>Череп Врага (x1)</b>.';
                        	$u->addItem(8531,$this->users[$i]['id'],'|nosale=1|sudba=1|usefromfile=1|musor=1|noremont=1|notransfer=1|sudba='.$u->info['login']);
                        }
                    }
                    if($save_time2) dStart();

						//}

                    if( $this->stats[$i]['hpNow'] >= 1 )
					{
                        $this->stats[$i]['test_heal'] = mysql_fetch_array(mysql_query('SELECT SUM(`yrn`) FROM `battle_stat` WHERE `uid2` = "'.$this->users[$i]['id'].'" AND `battle` = "'.$this->info['id'].'" LIMIT 1'));
                        $this->stats[$i]['test_heal'] = $this->stats[$i]['test_heal'][0];
                        $this->stats[$i]['test_start'] = mysql_fetch_array(mysql_query('SELECT `hpStart` FROM `battle_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `battle` = "'.$this->info['id'].'" LIMIT 1'));
                        $this->stats[$i]['test_start'] = $this->stats[$i]['test_start']['hpStart'];
                        //
                        $this->stats[$i]['hpNow'] = ( $this->stats[$i]['test_start']-$this->stats[$i]['test_heal'] );
                        if( $this->stats[$i]['hpNow'] < 1 ) {
                            $this->stats[$i]['hpNow'] = 1;
                        }
                    }else{
                        $this->stats[$i]['hpNow'] = 0;
                    }
                    unset($this->stats[$i]['test_heal']);
                    if($save_time2) dStart();

                    $this->users[$i]['last_b'] = $this->info['id']; //stats
                    $this->users[$i]['last_a'] = $act01;
                    $this->users[$i]['battle'] = -1; //users

                    $this->users[$i]['exp']  += $this->users[$i]['battle_exp']; //users
                    //Добавляем клан опыт (Все кроме пещер)

                    if($this->users[$i]['clan'] > 0)
					{
                        $cpr = 1;

						if($this->info['typeBattle'] == 9) $cpr = 25;
                        elseif($this->info['typeBattle'] == 50)$cpr = 65;

						//if( $this->stats[$i]['vip'] >= 5 ) $cpr = floor($cpr/100*150);
						$clan_exp = round($this->users[$i]['battle_exp']/100*$cpr);

                        mysql_query('UPDATE `clan` SET `exp` = `exp` + "'.$clan_exp.'" WHERE `id` = "'.$this->users[$i]['clan'].'" LIMIT 1');

						//За сегодня
                        $edd = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_exp` WHERE `clan` = "'.$this->users[$i]['clan'].'" AND `dd` = "'.ceil(date('d')).'" AND `mm` = "'.ceil(date('m')).'" AND `yyyy` = "'.ceil(date('Y')).'"'));
						if(isset($edd['id'])) mysql_query('UPDATE `clan_exp` SET `exp` = `exp` + "'.$clan_exp.'" WHERE `id` = "'.$edd['id'].'" LIMIT 1');
						else {
                        		mysql_query('INSERT INTO `clan_exp` (`clan`,`time`,`uid`,`exp`,`type`,`dd`,`mm`,`yyyy`,`ww`)
								VALUES ("'.$this->users[$i]['clan'].'",'.time().',"'.$this->users[$i]['clan'].'","'.$clan_exp.'",0,"'.date('d').'",
								"'.date('m').'","'.date('Y').'","'.date('W').'")');
							}
                    }

                    $this->users[$i]['battle_exp'] = 0; //stats

                    if($this->users[$i]['team']==$this->info['team_win']) {
                        mysql_query('UPDATE `rep` SET `n_capitalcity` = `n_capitalcity` + '.$this->users[$i]['bn_capitalcity'].' ,`n_demonscity` = `n_demonscity` + '.$this->users[$i]['bn_demonscity'].' ,`n_demonscity` = `n_demonscity` + '.$this->users[$i]['bn_suncity'].' WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                    }
                    if($save_time2) dStart();

                    //репутация
                    $this->users[$i]['bn_demonscity'] = 0;
                    $this->users[$i]['bn_capitalcity'] = 0;
                    $this->users[$i]['bn_suncity'] = 0;
                    //завершение эффектов с финишем
                    $spe = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `file_finish` != "" AND `v1` = "priem" LIMIT 30');
                    while($ple = mysql_fetch_array($spe))
					{
                        if(file_exists($c['doc_root'].'/_incl_data/class/priems/'.$ple['file_finish'].'.php'))
						{
                            require($c['doc_root'].'/_incl_data/class/priems/'.$ple['file_finish'].'.php');
                        }
                    }
                    if($save_time2) dStart();
                    //обновляем данные
                    mysql_query('DELETE FROM `eff_users` WHERE `v1` = "priem" AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 50');
                    if($save_time2) dStart();
                    if($dnr==1)
					{
                        if( $this->users[$i]['room'] == 370 )
						{
                            $dies = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `dungeon_actions` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `dn` = "'.$this->users[$i]['dnow'].'" AND `vars` = "dielaba" LIMIT 1'));
                            $dies = $dies[0];
                            mysql_query('INSERT INTO `dungeon_actions` (`dn`,`uid`,`x`,`y`,`time`,`vars`,`vals`) VALUES (
									"'.$this->users[$i]['dnow'].'","'.$this->users[$i]['id'].'","'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'","'.time().'","dielaba",""
								)');
                        }else{
                            $dies = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `dungeon_actions` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `dn` = "'.$this->users[$i]['dnow'].'" AND `vars` = "die" LIMIT 1'));
                            $dies = $dies[0];
                            mysql_query('INSERT INTO `dungeon_actions` (`dn`,`uid`,`x`,`y`,`time`,`vars`,`vals`) VALUES (
									"'.$this->users[$i]['dnow'].'","'.$this->users[$i]['id'].'","'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'","'.time().'","die",""
								)');
                        }
                        if( $dies < 2 /* || $this->info['dungeon'] == 15 */ )
						{
                            //
                            /* $tshbn = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `delete` = 0 AND `item_id` = "4910" LIMIT 1'));
                            if(isset($tshbn['id']))
							{
                                //выбрасываем шайбу
                                mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$tshbn['id'].'" LIMIT 1');
                                //
                                mysql_query('INSERT INTO `dungeon_obj` (
										`name`,`dn`,`x`,`y`,`img`,`delete`,`action`,`for_dn`,
										`type`,`w`,`h`,`s`,`s2`,`os1`,`os2`,`os3`,`os4`,`type2`,`top`,`left`,`date`
									) VALUES (
										"Шайба","'.$this->info['dn_id'].'","'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'","shaiba.png","0","fileact:15/shaiba","0",
										"0","120","220","0","0","5","8","12","0","0","0","0","{use:\'takeit\',rt1:69,rl1:-47,rt2:74,rl2:126,rt3:76,rl3:140,rt4:80,rl4:150}"
									)');
                                //
                            } */
                            //Телепортируем в рестарт
                            /* if($this->info['dungeon'] == 20)//Ледяная Пещера
							{
                                $this->users[$i]['x'] = 0;
                            	$this->users[$i]['y'] = 0;
                            	$this->users[$i]['s'] = 4;
							}
                            elseif($this->info['dungeon'] == 7)//Туманные низины
							{
                                $this->users[$i]['x'] = -3;
                            	$this->users[$i]['y'] = 2;
                            	$this->users[$i]['s'] = 3;
							} else*/ {
                             	//(координата 0х0)
								$this->users[$i]['x'] = $this->users[$i]['res_x'];
                            	$this->users[$i]['y'] = $this->users[$i]['res_y'];
                            	$this->users[$i]['s'] = $this->users[$i]['res_s'];
							} 
							/* $r_n = mysql_fetch_array(mysql_query('SELECT `name` FROM `room` WHERE `id` = "'.(int)$this->users[$i]['room'].'" LIMIT 1'));

							if( $this->users[$i]['room'] == 370 )
							{
                                if( $this->users[$i]['sex'] == 0 )
								{
                                    $rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погиб и находится в начале лабиринта';
                                }else{
                                    $rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погибла и находится в начале лабиринта';
                                }
                            }else{ */
                                if( $this->users[$i]['sex'] == 0 )
								{
                                    $rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погиб и находится в комнате &quot;'.$u->room['name'].'&quot;';
                                }else{
                                    $rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погибла и находится в комнате &quot;'.$u->room['name'].'&quot;';
                                }
                            //}
                        }
						/* elseif( $this->info['dungeon'] == 102 )
						{
                            $nld = '';
                            $lab = mysql_fetch_array(mysql_query('SELECT `id`,`users` FROM `laba_now` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1'));
                            if( $lab['users'] < 2 )
							{
                                //Удаляем подземелье
                                mysql_query('DELETE FROM `laba_now` WHERE `id` = "'.$lab['id'].'" LIMIT 1');
                                mysql_query('DELETE FROM `laba_map` WHERE `id` = "'.$lab['id'].'" LIMIT 1');
                                mysql_query('DELETE FROM `laba_obj` WHERE `lib` = "'.$lab['id'].'"');
                                mysql_query('DELETE FROM `laba_act` WHERE `lib` = "'.$lab['id'].'"');
                                mysql_query('DELETE FROM `laba_itm` WHERE `lib` = "'.$lab['id'].'"');
                            }else{
                                $lab['users']--;
                                mysql_query('UPDATE `laba_now` SET `users` = "'.$lab['users'].'" WHERE `id` = "'.$lab['id'].'" LIMIT 1');
                            }
                            mysql_query('UPDATE `stats` SET `dnow` = "0" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                            mysql_query('UPDATE `users` SET `room` = "369" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                            //удаляем все предметы которые пропадают после выхода из пещеры
                            mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `delete` = "0" AND `inShop` = "0" AND (`dn_delete` = "1" OR `data` LIKE "%fromlaba=1%")');// AND `delete` < 1234567890
                            if( $this->users[$i]['login'] != '' )
							{
                                if( $this->users[$i]['sex'] == 0 ) {
                                    $rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погиб без права на воскрешение и покидает подземелье'.$nld;
                                }else{
                                    $rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погибла без права на воскрешение и покидает подземелье'.$nld;
                                }
                            }
                        } */else{
                            $tinf = mysql_fetch_array(mysql_query('SELECT `uid` FROM `dungeon_now` WHERE `id` = "'.$this->info['dn_id'].'" LIMIT 1'));
                            $nld = '';
                            if( $tinf['uid'] == $this->users[$i]['id'] ) {
                                $tinf = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `dnow` = "'.$this->info['dn_id'].'" AND `hpNow` >= 1 LIMIT 1'));
                                if( isset($tinf['id']) ) {
                                    $tinf = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `id` = "'.$tinf['id'].'" LIMIT 1'));
                                    $nld .= ', новым лидером становится &quot;'.$tinf['login'].'&quot;';
                                    mysql_query('UPDATE `dungeon_now` SET `uid` = "'.$tinf['id'].'" WHERE `id` = "'.$this->info['dn_id'].'" LIMIT 1');
                                }
                            }
                            /*$rooms = array(
                                374 => 372,		//ПТП (Кэпитал сити)
                                189 => 188,		//Водосток (Кэпитал сити)
                                392 => 393,		//Шахты (Кэпитал сити)

                                398 => 397,		//Шахты (Ангелс сити)
                                243 => 395,		//Водосток (Ангелс сити)
                                360 => 242,		//Бездна (Ангелс сити)

                                19 => 293		//Катакомбы
                            );*/
							//	$n_rm = $rooms[$this->users[$i]['room']];

							//if($this->users[$i]['room']==304) $n_rm = 209;//ледяная пещера
                            //elseif($this->users[$i]['room']==304) $n_rm = 263;//БС
							//else $n_rm = 321;
                            
                            //mysql_query('UPDATE `stats` SET `dnow` = "0" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                           // mysql_query('UPDATE `users` SET `room` = "'.$n_rm.'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                            //удаляем все предметы которые пропадают после выхода из пещеры
                            //mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `delete` = "0" AND `dn_delete` = "1" LIMIT 1000');
                            
                            if( $this->users[$i]['login'] != '' )
							{
								if( $this->users[$i]['sex'] == 0 ) {
	                                $rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погиб без права на воскрешение и покидает подземелье'.$nld;
	                            }else{
	                                $rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погибла без права на воскрешение и покидает подземелье'.$nld;
	                            }
							}
                        }
                        if( $rtxt != '' )
						{
                            mysql_query("INSERT INTO `chat` (`dn`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`,`new`)
							VALUES ('".$this->info['dn_id']."','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','','".$rtxt."','".time()."','3','0','1','1')");
                        }
                    }
                    if($save_time2) dStart();

					//Данные для рейтинга
					$all_rating = array(0,0,0,0,0);
                    if($this->info['team_win'] > 0)
					{
						if($this->users[$i]['team']==$this->info['team_win']) $this->info['dungeon'] > 0 ? $all_rating[1] = 1 : $all_rating[0] = 1;
						else $this->info['dungeon'] > 0 ? $all_rating[3] = 1 : $all_rating[2] = 1;
                    } else  $all_rating[4] = 1;

                    mysql_query('UPDATE `users` SET `login2` = "" WHERE `battle` = "'.$this->info['id'].'"');
                    if($save_time2) dStart();

					$upd  = mysql_query('UPDATE `users`
					SET `login2` = "", `money` = "'.$this->users[$i]['money'].'", `money2` = "'.$this->users[$i]['money2'].'",
					`win` = "'.$this->users[$i]['win'].'", `win_rating` = `win_rating` + '.$all_rating[0].',
					`win_rating_d` = `win_rating_d` + '.$all_rating[1].', `lose` = "'.$this->users[$i]['lose'].'",
					`lose_rating` = `lose_rating` + '.$all_rating[2].', `lose_rating_d` = `lose_rating_d` + '.$all_rating[3].',
                    `nich_rating` = `nich_rating` + '.$all_rating[4].',
					`nich` = "'.$this->users[$i]['nich'].'", `battle` = "-1" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');

                    if( $u->info['id'] == $this->users[$i]['id'] ) {
                        $u->info['battle_text'] = $this->users[$i]['battle_text'];
                    }
                    if($save_time2) dStart();
					//Сохранение опыта
                    $upd2 = mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$i]['hpNow'].'",`mpNow` = "'.$this->stats[$i]['mpNow'].'",
					`bn_capitalcity` = 0,`bn_demonscity` = 0,`smena` = 3, `x`="'.$this->users[$i]['x'].'",`y`="'.$this->users[$i]['y'].'",
					`priems_z`="0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0",`last_pr`="0",`tactic1`="0",`tactic2`="0",
					`tactic3`="0",`tactic4`="0",`tactic5`="0",`tactic6`="0.00000000",`tactic7`="10",`exp` = "'.$this->users[$i]['exp'].'",
					`battle_exp` = "'.$this->users[$i]['battle_exp'].'",`battle_text` = "'.$this->users[$i]['battle_text'].'",`battle_yron` = "0",
					`enemy` = "0",`last_b`="'.$this->info['id'].'",`regHP` = "'.time().'",`regMP` = "'.time().'"
					WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');

					if($this->info['turnir'] == 0)
					{
                        //пишем в чат
                        mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
						VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$this->users[$i]['battle_text']."','-1','6','0')");
                    }else{
                        mysql_query('UPDATE `turnirs` SET `winner` = "'.$this->info['team_win'].'" WHERE `id` = "'.$this->info['turnir'].'" LIMIT 1');
                    }
                    if($save_time2) dStart();
                    //завершаем сам бой
                    $upd3  = mysql_query('UPDATE `battle` SET `time_over` = "'.time().'",`team_win` = "'.$this->info['team_win'].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
                    if($save_time2) dStart();
                    // Жрать хочет
                    if($this->users[$i]['animal'] > 0)
					{
                        $a = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `id` = "'.$this->users[$i]['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));
                        if(isset($a['id']))
						{
                            if($a['eda']<1)
							{
                                $u->send('',$this->users[$i]['room'],$this->users[$i]['city'],'',$this->users[$i]['login'],'<font color=red>Внимание!</font> <b>'.$a['name'].'</b> нуждается в еде...',time(),3,0,0,0,1);
                            }
                        }
                    }
                    if($save_time2) dStart();
                    mysql_query('UPDATE `stats` SET `battle_text` = "",`last_b`="0" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                    mysql_query('UPDATE `battle_users` SET `finish` = 1 WHERE `uid` = "'.$this->users[$i]['id'].'"');

                    if( $u->info['battle'] != 0 && !isset($u->info['battle_lsto'])&& !isset($CRON_CORE))
					{
                        echo '<script>document.getElementById(\'teams\').style.display=\'none\';var battleFinishData = "'.$u->info['battle_text'].'<br>";</script>';
                    }
                }else{
                    //error_log('<font color=red><b>Поединок завершился, но вы поймали баг с 0-ым опытом, сообщите Администрации! UID: '.$u->info['id'].'</b></font>');
                }
            }
            //mysql_query('UPDATE `battle` SET `testfinish` = "-1" WHERE `id` = "'.$test['id'].'" LIMIT 1');

			//Клановые войны - счет в пределах войны
			if($this->info['noinc']==2)
			{
				$wid = mysql_fetch_array(mysql_query('SELECT `id`,`clan1`,`clan2` FROM `clan_wars` WHERE
				(`clan1` = "'.$this->users[$i]['clan'].'" OR `clan2` = "'.$this->users[$i]['clan'].'") AND `time_finish` > "'.time().'"
				AND `last_battle` != "'.$this->info['id'].'" LIMIT 1'));

                if(isset($wid['id']))
				{
					if($this->users[$i]['clan']==$wid['clan1']) $winner = ($this->info['team_win'] == $this->users[$i]['team'] ? 'win1' : 'win2');
					else $winner = ($this->info['team_win'] == $this->users[$i]['team'] ? 'win2' : 'win1');

					mysql_query('UPDATE `clan_wars` SET `'.$winner.'` = `'.$winner.'` + 1, `last_battle` = "'.$this->info['id'].'"
					WHERE `id` = "'.$wid['id'].'" LIMIT 1');
				}
			}

			//Великие битвы сохраняем отдельно
			/* if($bType[1] > 1)
			{
                $gbtl = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_great` WHERE `battle` = "'.$this->info['id']. '" LIMIT 1'));
				if(!isset($gbtl['id'])) mysql_query('INSERT INTO `battle_great` (`battle`,`yron`,`time`) VALUES ("'.$this->info['id']. '","'.$buron.'","'.time().'")');
			}

			//Рейтинг клана
            $user_min_yron = ($bType[1] > 1 ? 10000 : 5000);
            //el($this->users[$i]['id'],$this->users[$i]['clan'],$this->info['team_win'],$this->users[$i]['team'],$this->users[$i]['battle_yron'],$user_min_yron);
			if($this->users[$i]['room'] == 9 && $this->users[$i]['clan'] > 0 && $this->info['team_win'] == $this->users[$i]['team']
			&& $this->users[$i]['battle_yron'] > $user_min_yron)
			{
				$clan_r = ($this->info['type'] == 99 ? 0.5 : 0.2);//Кровавый бой - 99
                if($bType[1] > 1) $clan_r *= $bType[1];

				do_query('UPDATE `clan` SET `rating_t` = `rating_t` + "'.$clan_r.'" WHERE `id` = "'.$this->users[$i]['clan'].'" LIMIT 1');
                //el($this->users[$i]['clan'], $clan_r, $bType[1]);
			} */

			$this->users[$i]['battle_yron'] = 0; //stats

			$FAST_STAT_END = true;
            if($save_time2) dStart();
        }

		/* if($save_time2)
		{
			eLog('==============finishBattle: '.$this->users[$i]['login'].'['.$this->users[$i]['id'].']==============');
			dPrint();
            eLog('==============finishBattle: '.$this->users[$i]['login'].'['.$this->users[$i]['id'].']==============');
		} */
    }

    //Выдаем предметы
    public $ainm = array();
    public function addGlobalItems($bid,$uid,$itm,$eff,$ico,$exp,$cr,$ecr)//Используется только для Общего Врага и ботов на ЦП?
	{
        global $u, $save_exp, $save_exp_arr;

		//Выпадение дропа на ЦП
    	/* if( $bid == 1004 )
		{
            mysql_query('INSERT INTO `items_local`
					( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
					(
						"'.$this->users[$this->uids[$uid]]['room'].'",
						"'.time().'",
						"4459",
						"srok=2592000",
						"'.$this->users[$this->uids[$uid]]['login'].'",
						"1"
					)');
        }
 */
        if( $exp > 0 )//Расчет опыта
		{
			if(!$this->stats[$this->uids[$bid]]['hpAll'])//Есть случаи потери hpAll
			{
				$row = mysql_fetch_array(mysql_query('SELECT `hpAll` FROM `battle_users`
				WHERE `battle`="'.$this->info['id'].'" AND `uid` = "'.$bid.'" LIMIT 1'));

				$ehpAll = $row['hpAll'];
                //eLog('uid:'.$uid.' - enemy hpall fixed: '.$ehpAll);
			} else $ehpAll = $this->stats[$this->uids[$bid]]['hpAll'];

			$hpAll_1pr = $ehpAll / 100;
            $exp_1pr = $exp / 100;
            $hpAll_pr = $this->users[$this->uids[$uid]]['battle_yron']/$hpAll_1pr;
			if($hpAll_pr>100) $hpAll_pr = 100;
			$this->users[$this->uids[$uid]]['battle_exp'] = round($hpAll_pr * $exp_1pr);

            //if($save_exp) $save_exp_arr[$uid][] = __LINE__.'#32# hpAll_1pr: '.$this->expCoef.' stats['.$i.'][exp]: '.$this->stats[$i]['exp'].' battle_exp: '.$this->users[$i]['battle_exp'].' addExp: '.$this->info['addExp'].' battle_yron: '.round($this->users[$i]['battle_yron']);
			//eLog('uid:'.$uid.' battle_exp: '.$this->users[$this->uids[$uid]]['battle_exp'].' battle_yron: '.$this->users[$this->uids[$uid]]['battle_yron'].' hpall_pr: '.round($hpAll_pr,6).'% bid:'.$bid.' hpall: '.$this->stats[$this->uids[$bid]]['hpAll'].' exp: '.$exp);

            mysql_query('UPDATE `stats` SET `battle_exp` =  "'.$this->users[$this->uids[$uid]]['battle_exp'].'" WHERE `id` = "'.$uid.'" LIMIT 1');
		}

        /* if( $cr != '' && $cr > 0 )
		{
            if( $this->stats[$this->uids[$uid]]['hpNow'] > 0 )
			{
                mysql_query('UPDATE `users` SET `money` = (`money` + '.mysql_real_escape_string($cr).')
				WHERE `id` = "'.mysql_real_escape_string($uid).'" LIMIT 1');

				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
				VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы получили кредиты:</b> ".mysql_real_escape_string($cr)." <b>кр.</b></font>','-1','6','0')");
            }
        } */
    
        /* if( $ecr != '' && $ecr > 0 )
		{
            if( $this->stats[$this->uids[$uid]]['hpNow'] > 0 )
			{
                //	$bnkt = mysql_fetch_array(mysql_query('SELECT `id` FROM `bank` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `block` = "0" ORDER BY `id` DESC LIMIT 1'));
                if(mysql_query('UPDATE `users` SET `money2` = `money2` + "'.mysql_real_escape_string($ecr).'" WHERE `id` = "'.mysql_real_escape_string($uid).'" LIMIT 1')) {
                    mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
					VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы получили Евро-кредиты:</b> ".mysql_real_escape_string($ecr)." <b>екр.</b> (Счет №".$bnkt['id'].")</font>','-1','6','0')");
                }else{
                    mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
					VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы могли получили Евро-кредиты за этот бой, но у Вас нет банковского счета.</b> Его можно создать на Страшилкиной ул. в здании Банка за небольшое количество кредитов.</font>','-1','6','0')");
                }
            }
        } */
 
        if( $ico != '' )
		{
            /*
				0(тип, 1 - значок, 2 - подвиг)@
				1(время в минутах)@
				2(название картинки)@
				3(название)@
				4(требует остаться в живых 0 или 1, либо игрок умер -1)@
				5(требует набить с ботам урона в % Например 0.001)@
				6(действия например: add_s1=5|add_hpAll=50)@
				7(Требует другой значок, название картинки)@
				8(плюсует значок 0 или 1)@
				9(удаляем прошлый значок 0 or 1)
				*/
            $i = 0;
            $txt = '';
            $ico = explode('#',$ico);
            while( $i < count($ico) ) {
                $ico_e = explode('@',$ico[$i]);
                if(isset($ico_e[3])) {
                    //
                    $add = 1;
					//даем награду пока всем, даже погибшим
                    //if($ico_e[4] == 1 && floor($this->stats[$this->uids[$uid]]['hpNow']) < 1) {
                    //    $add = 0;
                    //}
                    if( $add == 1 ) {
                        $ins = false;
                        if( $ico_e[8] == 0 ) {
                            $ins = true;
                            if( $ico_e[9] == 1 ) {
                                mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `img` = "'.mysql_real_escape_string($ico_e[2]).'"');
                            }
                        }else{
                            $old_ico = mysql_fetch_array(mysql_query('SELECT `id` FROM `users_ico` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND (`endTime` > "'.time().'" OR `endTime` = 0) AND `img` = "'.mysql_real_escape_string($ico_e[2]).'" LIMIT 1'));
                            if( !isset($old_ico['id'])) {
                                $ins = true;
                            }else{
                                if( $old_ico['id'] > 0 ) {
                                    $txt .= ', &quot;'.$ico_e[3].' (<small>Обновление</small>)&quot;';
                                    mysql_query('UPDATE `users_ico` SET `x` = `x` + 1,`endTime` = "'.mysql_real_escape_string(time()+$ico_e[1]*60).'" WHERE `id` = "'.$old_ico['id'].'" LIMIT 1');
                                }else{
                                    $ins = true;
                                }
                            }
                            unset($old_ico);
                        }
                        if($ins == true) {
                            if( $ico_e[9] == 1 ) {
                                mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `img` = "'.mysql_real_escape_string($ico_e[2]).'"');
                            }
                            mysql_query('INSERT INTO `users_ico` (`uid`,`time`,`text`,`img`,`endTime`,`type`,`bonus`) VALUES (
									"'.mysql_real_escape_string($uid).'",
									"'.time().'",
									"'.mysql_real_escape_string($ico_e[3]).'",
									"'.mysql_real_escape_string($ico_e[2]).'",
									"'.mysql_real_escape_string(time()+$ico_e[1]*60).'",
									"'.mysql_real_escape_string($ico_e[0]).'",
									"'.mysql_real_escape_string($ico_e[6]).'"
								)');
                            $txt .= ', &quot;'.$ico_e[3].'&quot;';
                        }
                    }
                    //
                }
                $i++;
            }
            if( $txt != '' ) {
                $txt = ltrim($txt,', ');
                mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы совершили подвиг:</b> ".mysql_real_escape_string($txt)."</font>','-1','6','0')");
            }
        }
        //выдача предеметов
        if( $itm != '' && $this->users[$this->uids[$uid]]['battle_yron'] > 49)
		{
			$i = 0;
            $txt = '';
            $itm = explode(',',$itm);
            while($i < count($itm))
			{
                $itm_e = explode('@',$itm[$i]);
                if($itm_e[0] > 0)
				{
                    $j = 0;
                    while( $j < $itm_e[1] )
					{
                        $u->addItem($itm_e[0],$uid,'|'.$itm_e[2]);
                        $j++;
						//eLog('Чек: '.$this->users[$this->uids[$uid]]['login'].'. battle_yron: '.round($this->users[$this->uids[$uid]]['battle_yron']));
                        if($save_exp) $save_exp_arr[$uid][0] = __LINE__.' Чек.  battle_yron: '.round($this->users[$this->uids[$uid]]['battle_yron']);

                    }
                    if( !isset($this->ainm[$itm_e[0]]) )
					{
                        $this->ainm[$itm_e[0]] = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($itm_e[0]).'" LIMIT 1'));
                    }
                    if( isset($this->ainm[$itm_e[0]]['id']) )
					{
                        //Добавляем текст о добавлении предмета
                        $txt .= ', '.$this->ainm[$itm_e[0]]['name'];
                        if( $itm_e[1] > 1 ) $txt .= ' <b>(x'.$itm_e[1].')</b>';
                    }
                }
                $i++;
            }
            if( $txt != '' )
			{
                $txt = ltrim($txt,', ');
                mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
				VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы получили предметы:</b> ".mysql_real_escape_string($txt)."</font>','-1','6','0')");
            }
        }
        //
    }

    //Проводим удар
    public function addNewAtack()
    {
        global $u, $c;
        $save_time4 = false;
        if($save_time4) dStart();//dg

	        if(!isset($this->ga[$u->info['id']][$u->info['enemy']]))
	        {
	            if($this->stats[$this->uids[$u->info['id']]]['hpNow']>0)
	            {
	                $us = $this->stats[$this->uids[$u->info['id']]];
	                $i = 1; $no = 0;

					if($us['weapon1']!=1 && $us['weapon2']==1)
	                {
	                    $uz['zona'] += 1;
	                }

					while($i<=$uz['zona'])
	                {
	                    if($this->uAtc['a'][$i]==0)
	                    {
	                        $no = 1;
	                    }
	                    $i++;
	                }

	                if($this->uAtc['b']==0)
	                {
	                    $no = 1;
	                }
                    if($save_time4) dStart();//dg
	                if($no==0)
	                {
	                    //наносим удар
	                    if($u->info['enemy'] > 0)
	                    {
	                        if(!isset($this->ga[$u->info['enemy']][$u->info['id']]))
	                        {
	                            if($this->stats[$this->uids[$u->info['id']]]['hpNow']>=1 && $this->stats[$this->uids[$u->info['enemy']]]['hpNow']>=1)
	                            {
                                    if($save_time4) dStart();//dg
									//наносим новый удар
	                                $a = $this->uAtc['a'][1].''.$this->uAtc['a'][2].''.$this->uAtc['a'][3].''.$this->uAtc['a'][4].''.$this->uAtc['a'][5];
	                                $b = $this->uAtc['b'];
									$minitime = round(microtime(true) * 1000);
	                                mysql_query('DELETE FROM `battle_act` WHERE `battle` = "'.$this->info['id'].'" AND ((`uid2` = "'.$u->info['id'].'" AND `uid1` = "'.$u->info['enemy'].'") OR (`uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$u->info['enemy'].'")) LIMIT 2');
	                                $d = mysql_query('INSERT INTO `battle_act` (`battle`,`time`,`minitime`,`uid1`,`uid2`,`a1`,`b1`)
									VALUES ("'.$this->info['id'].'","'.time().'", "'.$minitime.'", "'.$u->info['id'].'","'.$u->info['enemy'].'","'.$a.'","'.$b.'")');

									if(!$d)
	                                {
	                                    $this->e = 'Не удалось нанести удар по противнику...';
	                                }else{
	                                    $this->ga[$u->info['id']][$u->info['enemy']] = mysql_insert_id();
	                                }
                                    if($save_time4) dStart();//dg
	                            }
	                        }else{
                            
	                            //отвечаем на удар противника
	                            if($this->stats[$this->uids[$u->info['id']]]['hpNow']>=1 && $this->stats[$this->uids[$u->info['enemy']]]['hpNow']>=1)
	                            {
	                                if(isset($this->atacks[$this->ga[$u->info['enemy']][$u->info['id']]]['id']))
	                                {
	                                    $this->atacks[$this->ga[$u->info['enemy']][$u->info['id']]]['a2'] = $this->uAtc['a'][1].''.$this->uAtc['a'][2].''.$this->uAtc['a'][3].''.$this->uAtc['a'][4].''.$this->uAtc['a'][5];
	                                    $this->atacks[$this->ga[$u->info['enemy']][$u->info['id']]]['b2'] = $this->uAtc['b'];
										if($save_time4) dStart();//dg
										$this->startAtack($this->atacks[$this->ga[$u->info['enemy']][$u->info['id']]]['id']);
                                        if($save_time4) dStart();//dg
	                                }
	                            }
                                
	                        }
	                    }else{
	                        //ожидание хода противника (нет подходящего противника)
	                    }
	                }else{
	                    $this->e = 'Выберите зоны удара и блока';
	                }
	            }else{
	                $this->e = 'Для вас поединок закончен, ожидайте пока завершат другие...';
	            }
	        }else{
	            //уже ударили противника, ожидание хода
	        }
            /* if($save_time4) dStart();//dg
            if($save_time4==true && in_array($GLOBALS['u']->info['id'], $c['admins']))
			{
				eLog('===============================uid:'.$GLOBALS['u']->info['id'].'===============================');
				dPrint();//dg
		    	eLog('===============================uid:'.$GLOBALS['u']->info['id'].'===============================');
			} */
    }

    //Запускаем магические предметы, если в них что-то встроено
    public function magicItems($uid1,$uid2,$end)
    {
        global $u,$priem,$c,$code;
        if(isset($this->stats[$this->uids[$uid1]]))
        {
            $i = 0;
            while($i<count($this->stats[$this->uids[$uid1]]['items']))
            {
                $itm = $this->stats[$this->uids[$uid1]]['items'][$i];
                if(isset($itm['id']))
                {
                    $e = $u->lookStats($itm['data']);
                    if(isset($e['bm_a1']))
                    {
                        if( $end > 0 ) {
                            if(file_exists($c['doc_root'].'/_incl_data/class/priems/'.$e['bm_a1'].'.end.php'))
                            {
                                require($c['doc_root'].'/_incl_data/class/priems/'.$e['bm_a1'].'.end.php');
                            }
                        }else{
                            if(file_exists($c['doc_root'].'/_incl_data/class/priems/'.$e['bm_a1'].'.php'))
                            {
                                require($c['doc_root'].'/_incl_data/class/priems/'.$e['bm_a1'].'.php');
                            }
                        }
                    }
                }
                $i++;
            }
            unset($itm);
        }
    }

    	public $rehodeff = array();

    	//Поглощение урона
		public $poglast = array();
		
		public function testPogB($uid, $yr, $pliid, $test = 0)
		{
            global $u, $priem;

			//$yr2 - урон, $j['y'] - осталось урона для поглощения
            
			$yr2 = $yr;
			if($yr <= 0) return $yr2;

			$i = 0;			
			
			while($i < count($this->stats[$this->uids[$uid]]['set_pog2']))
			{			
				$j = $this->stats[$this->uids[$uid]]['set_pog2'][$i];

				if(is_array($this->stats[$this->uids[$uid]]['effects'][$j['id']-1])) $prm_id = $this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['id'];
				else $prm_id = 0;

				if( ($prm_id == $pliid || $test == 1) & $yr2 > 1  )//Если есть прием и урон > 1
				{
					if(isset($j['id']) && isset($this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']))
					{
						$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'] = str_replace('add_pog2='.$j['y'],'add_pog2=$',$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);//Обновление оставшегося поглощения в статсах
						$dt3 = $u->lookStats($this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
					}

					$dt30 = $j['y']/($yr2/100);//Сколько % урона можем погасить оставшимся уроном
					if( $dt30 < $dt3['add_pog2p'] ){$dt3['add_pog2p'] = $dt30;}//Если % урона доступный меньше add_pog2p
                    unset($dt30);

					$mana_minus = round($yr2/100*$dt3['add_pog2p']*$dt3['add_pog2mp']);//Сколько маны отнимаем
                    $mana_max = round($this->stats[$this->uids[$uid]]['mpNow']);//Мана игрока

					//pr('<br>Мана игрока:'.$mana_max.' Урон до: '.$yr2.' Урона для погл до:'.$j['y'].'<br>');//dg
					
					if($dt3['add_pog2mp'] && $mana_max > 0 && $mana_minus > $mana_max)////Если поглощаем большем, чем есть маны
					{
                        $mana_minus = $mana_max;
						$dt3['add_pog2p'] = round($mana_max/$dt3['add_pog2mp']/($yr2/100));//Сколько процентов поглощаем
					}	

					if(isset($dt3['add_pog2p']) && $test == 1)//Есть кол-во % поглощения, например, 60%
					{
                        $priem->minMana($uid,$mana_minus,0,1);//Отнимает ману

						//pr('[Поглощаем: '.round($dt3['add_pog2p']).'% ( '.round($yr2/100*$dt3['add_pog2p']).'  от '.$yr2.' ед. урона )
						//за '.$mana_minus.' MP , остаток МР: '.$this->stats[$this->uids[$uid]]['mpNow'].'] ->');//dg

						$yr2 = round($yr2/100*(100-$dt3['add_pog2p']));

                        //pr('<br>Урон после:'.$yr2.' ');//dg
					}
                    
					$this->poglast[$uid] = $yr - $yr2;

                    if( $test == 1 ) $j['y'] -= $this->poglast[$uid];//Осталось для поглощения
					//if( $test == 1 ) pr(' Поглощено:'.$this->poglast[$uid].' Урона для погл после:'.$j['y'].'<br><br>');//dg

					if($j['y'] <= 0 || ($this->stats[$this->uids[$uid]]['mpNow'] <= 0 && $dt3['add_pog2mp'] > 0))//Если нечем поглощать или больше нет маны
					{					
						$dt2 = $u->lookStats($this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
						if(isset($dt2['endPog']) && $dt2['endPog'] == 1)
						{
							//Удаляем прием
							mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'"
							WHERE `uid`="'.$uid.'" AND `delete` = "0" AND `v2` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['v2'].'" LIMIT 1');

							$this->priemAddLogFast( $uid, 0, $this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['name'],
							'{tm1} Закончилось действие эффекта &quot;<b>'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['name'].'</b>&quot; для {u1}.',
							1, time() );//Лог

							
                            //$this->delPriem($pvr['pl'],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],100);
							//$this->delPriem($eff[$i],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],3,$this->atacks[$id]['uid'.$jn],'',0,0,0);
							$this->stats[$this->uids[$uid]]['effects'][$j['id']-1] = 'delete';
                            //pr('tttt');
						}

						unset($dt2);
						$j['y'] = 0;
					}

					if($this->stats[$this->uids[$uid]]['effects'][$j['id']-1] != 'delete')
					{
						//$this->stats[$this->uids[$uid]]['set_pog'][$i]['y'] = $j['y']//Нужно ли?
						$this->stats[$this->uids[$uid]]['set_pog2'][$i]['y'] = $j['y'];
						if(isset($this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']))
						{
							$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'] = str_replace('add_pog2=$','add_pog2='.$j['y'],$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);//Обновление оставшегося поглощения в статсах
							mysql_query('UPDATE `eff_users` SET `data` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['id'].'" LIMIT 1');
						}
					}
				}
				$i++;
			}
            
			return $yr2;
		}


    //Проверка как бьем - не используется?
    public function testHowRazmen($id)
	{
        $r = array(
            1 => 0, 2 => 0
        );
        if(isset($this->atacks[$id])) {
            if($this->atacks[$id]['out1']>0 && $this->atacks[$id]['out2']>0)
            {
                //игрок 1 пропустил ход
                if($this->atacks[$id]['out1'] == 100) {
                    //на магию
                    $r[1] = -2;
                }else{
                    //время
                    $r[1] = -1;
                }
                //игрок 2 пропустил ход
                if($this->atacks[$id]['out2'] == 100) {
                    //на магию
                    $r[2] = -2;
                }else{
                    //время
                    $r[2] = -1;
                }
            }elseif($this->atacks[$id]['out1']>0)
            {
                //игрок 1 пропустил ход
                if($this->atacks[$id]['out1'] == 100) {
                    //Пропустил ход на магию
                    $r[1] = -2;
                }else{
                    //Пропустил ход по тайму
                    $r[1] = -1;
                }
                //игрок 2 бьет
                $r[2] = 1;
            }elseif($this->atacks[$id]['out2']>0)
            {
                //игрок 2 пропустил ход
                if($this->atacks[$id]['out2'] == 100) {
                    //Пропустил ход на магию
                    $r[2] = -2;
                }else{
                    //Пропустил ход по тайму
                    $r[2] = -1;
                }
                //игрок 1 бьет
                $r[1] = 1;
            }else{
                //размен игрок 1 бьет по игрок 2 , и игрок 2 бьет по игрок 1
                $r[1] = 1;
                $r[2] = 1;
            }
        }
        return $r;
    }

    //Тестируем удары и т.д
    public function newRazmen($id,$at)
	{

        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];

        if( $this->atacks[$id]['out1'] == 0 ) {
            $at[1] = $this->usersTestAtack($id,$uid1,$uid2);
        }else{
            //echo '['. $this->users[$this->uids[$uid1]]['login'] .' пропустил ход]';
            $at[1] = array( 0 );
        }
        if( $this->atacks[$id]['out2'] == 0 ) {
            $at[2] = $this->usersTestAtack($id,$uid2,$uid1);
        }else{
            //echo '['. $this->users[$this->uids[$uid2]]['login'] .' пропустил ход]';
            $at[2] = array( 0 );
        }

        return $at;
    }

    //Игрок1 наносит удар Игрок2
    public function usersTestAtack($id,$uid1,$uid2)
	{
        $r = array();
        $block = array(
            0,
            0,
            0,
            0,
            0,
            0
        );
		$b1 = $this->atacks[$id]['b1'];
        $b2 = $this->atacks[$id]['b2'];

        //Проверка блоков
        $i = 1;
        if( $uid1 == $this->atacks[$id]['uid1'] )
		{
            if( $this->stats[$this->uids[$uid2]]['yhod'] > 0 ) $b2 = $b1;//зоны блоков - верно!

			$a = 2;
            $j = $b2;

            $atack = array(
                0,
                $this->atacks[$id]['a1'][0],
                $this->atacks[$id]['a1'][1],
                $this->atacks[$id]['a1'][2],
                $this->atacks[$id]['a1'][3],
                $this->atacks[$id]['a1'][4]
            );
        }
		elseif( $uid2 == $this->atacks[$id]['uid1'] )
		{
            if( $this->stats[$this->uids[$uid2]]['yhod'] > 0 ) $b1 = $b2;//зоны блоков - верно!

			$a = 1;
            $j = $b1;

            $atack = array(
                0,
                $this->atacks[$id]['a2'][0],
                $this->atacks[$id]['a2'][1],
                $this->atacks[$id]['a2'][2],
                $this->atacks[$id]['a2'][3],
                $this->atacks[$id]['a2'][4]
            );
        }

        if( $this->atacks[$id]['out' . $a ] == 0 )
		{
			while( $i <= $this->stats[$this->uids[$uid2]]['zonb'] )
			{
                $block[$j] = 1;
                $j++;
                if( $j > 5 || $j < 1 )
				{
                    $j = 1;
                }
                $i++;
            }
        }
        //Проверка ударов
        $i = 1;
        while( $i <= $this->stats[$this->uids[$uid1]]['zona'] )
		{
            if( !isset($atack[$i]) || $atack[$i] == 0 ) {
                $atack[$i] = rand(1,5);
            }
            if( $atack[$i] > 0 ) {
                if( $block[$atack[$i]] == 1 ) {
                    //удар был заблокирован
                    // КУДА БИЛ , ТИП УДАРА
					//pr('блок');//dg
                    $r['atack'][] = array( $atack[$i] , 3 , 0 );
                }else{
                    //Удар прошел
                    // КУДА БИЛ , ТИП УДАРА
                    $r['atack'][] = array( $atack[$i] , 1 , 0 );
                }
            }
            $i++;
        }

        return $r;
    }

    //Проверка зоны и блока
    public function testRazmenblock1($id,$uid1,$uid2,$atack)
	{
        $r = false;
        //Проверка блоков
        $i = 1;
        
        if( $uid1 == $this->atacks[$id]['uid1'] )
		{
            $j = $this->atacks[$id]['b2'];
        }elseif( $uid2 == $this->atacks[$id]['uid1'] )
		{
            $j = $this->atacks[$id]['b1'];
        }
        if( $this->atacks[$id]['out2'] == 0 )
		{
            while( $i <= $this->stats[$this->uids[$uid2]]['zonb'] )
			{
                //echo '{'.$j.'}';
                $block[$j] = 1;
                $j++;
                if( $j > 5 || $j < 1 ) {
                    $j = 1;
                }
                $i++;
            }
        }
        //Проверка ударов
        if( $atack > 0 ) {
            if( $block[$atack] == 1 ) {
                //удар был заблокирован
                // КУДА БИЛ , ТИП УДАРА
                $r = true;
            }else{
                //Удар прошел
                // КУДА БИЛ , ТИП УДАРА
                $r = false;
            }
        }
        return $r;
    }

    //Первичный расчет мф. эффектов (пример) - не используется
    public function firstRazmen($id,$at)
	{

        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];

        $i = 1;
        while( $i <= 2 ) {
            if( $i == 1 ) {
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            }else{
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }

            //Расчет уворота Цели от Атакующего


            $i++;
        }

        return $at;
    }

    //Проверка ухода удара в игрока
	public function yhod_user( $actid, $uid1, $uid2, $type )
	{
		// 1 - кто бьет .  2 - в кого бьют . тип
  		//pr ('['.$uid1.'->'.$uid2.'->'.$type.']');
		//Удар летит прямо в противника

        if( $type == 0 )
		{
			$r = $uid2;
		}
		elseif($this->import_user[$actid][$uid1][$uid2] == 0 )
		{
            //pr('test3');
			$r = $uid1;
			$rand_user = false;

			if( $type == 2 )
			{
				//Случайный персонаж из своей команды (в том числе игрок)
				$i = 0;
				while( $i < count( $this->users ) )
				{
					if( $this->users[$i]['team'] == $this->users[$this->uids[$uid2]]['team'] ) {
						if( $this->stats[$i]['hpNow'] >= 1 ) {
							$rand_user[] = $this->users[$i]['id'];
						}
					}
					$i++;
				}
			}elseif( $type == 4 ) {
				//Случайный персонаж, любой
				$i = 0;
				while( $i < count( $this->users ) ) {
					//if( $this->users[$i]['team'] == $this->users[$this->uids[$uid1]]['team'] ) {
						if( $this->stats[$i]['hpNow'] >= 1 ) {
							$rand_user[] = $this->users[$i]['id'];
						}
					//}
					$i++;
				}
			}elseif( $type == 5 ) {
				//Случайный персонаж, любой (кроме игрока)
				$i = 0;
				while( $i < count( $this->users ) ) {
					if( $this->users[$i]['team'] == $this->users[$this->uids[$uid2]]['team'] && $uid2 != $this->users[$i]['id'] ) {
						if( $this->stats[$i]['hpNow'] >= 1 ) {
							$rand_user[] = $this->users[$i]['id'];
						}
					}
					$i++;
				}
			}elseif( $type == 6 ) {
				//Случайный персонаж из команды противника
				$i = 0;
				while( $i < count( $this->users ) ) {
					if( $this->users[$i]['team'] != $this->users[$this->uids[$uid2]]['team'] ) {
						if( $this->stats[$i]['hpNow'] >= 1 ) {
							$rand_user[] = $this->users[$i]['id'];
						}
					}
					$i++;
				}
			}elseif( $type > 100 ) {
				//Удар идет в конкретного игрока
				if( !isset($this->users[$this->uids[$type]]) || $this->users[$this->uids[$type]]['id'] != $type ) {
					$r = $uid2;	
				}else{
					$r = $type;
				}
			}
			if( $rand_user != false && count($rand_user) > 0 ) {
				$r = $rand_user[rand(0,( count($rand_user) - 1 ))];
			}
			$this->import_user[$actid][$uid1][$uid2] = $r;
		}else{
			$r = $this->import_user[$actid][$uid1][$uid2];
		}
		//pr($actid.' : '.$r);
		return $r;
	}

    //Расчет уворота игроков
    public function mf1Razmen($id,$at,$v)
	{
        global $u;

        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];

        //echo '*3';
        $i = 1;
        while( $i <= 2 )
		{
            if( $i == 1 )
			{
                $a = 1;
                $b = 2;
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            }else{
                $a = 2;
                $b = 1;
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }

        	if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )
			{
				$no_mf = ($this->stats[$this->uids[$u2]]['no_mf']!=0 ? 1 : 0);
                $u2b = $u2;
				$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
				$b = $a;
        	}
            //pr($u1.' : '.$this->stats[$this->uids[$u1]]['no_mf']);

			//pr('u1:'.$u1.' u2:'.$u2);
            //Расчет уворота Цели (u2) от Атакующего (u1)
            $j = 0; $wp01 = 3; $k01 = 0;
            while($j < count($at[$a]['atack']) && $j < 8)
			{
				// КУДА БИЛ, ТИП УДАРА
                if( $k01 == 0 && isset($this->stats[$this->uids[$u1]]['wp3id']) )
				{
                    //Левая рука
                    $wp01 = 3;
                    $k01 = 1;
                }else{
                    //Правая рука
                    if( isset($this->stats[$this->uids[$u1]]['wp14id'])
					&& $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp14id']]['type'] != 13 ) {
                        $wp01 = 14;
                    }else{
                        if( isset($this->stats[$this->uids[$u1]]['wp3id']) )
						{
                            $wp01 = 3;
                        }else{
                            //нет оружия
                            $wp01 = 3;
                        }
                    }
                    $k01 = 0;
                }
                $witm01 = 0;
                $witm_type01 = 0;
                if( $wp01 > 0 )
				{
                    $witm01 = $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp' . $wp01 . 'id']];
                    $witm_data01 = $u->lookStats($witm01['data']);
                    //$r['wt'] = $witm['type'];
                }
				//pr('');
				//pr('удар: '.$j.' u1: '.$u1.' u2: '.$u2);
                //pr('v: '.$v.' = atack: '.$at[$a]['atack'][$j][2].' a:'.$a.' j:'.$j);

                if( $at[$a]['atack'][$j][2] == $v )
				{
                    //pr('t2: уворот: '.$at[$a]['atack'][$j][1].' u1: '.$u1.' u2:'.$u2);//dg}

					$tyv = $this->mfs( 2 , array( 'mf' => $this->stats[$this->uids[$u2]]['m4'] ,
					'amf' => $this->stats[$this->uids[$u1]]['m5'] + $witm_data01['sv_m5']  ) );

					$priemDoMf = ($j==0 ? $this->PriemDoMf($u2) : false);
					
                    if(isset($this->stats[$this->uids[$u2]]['m4a'])  && $this->stats[$this->uids[$u2]]['m4a']!=0) $tyv = ($this->stats[$this->uids[$u2]]['m4a']==1 ? 1 : 0);//выключатели МФ
                    if(isset($this->stats[$this->uids[$u2]]['m4a1']) && $this->stats[$this->uids[$u2]]['m4a1']!=0 && $j==0) $tyv = ($this->stats[$this->uids[$u2]]['m4a1']==1 ? 1 : 0);//выключатели МФ
                    if(isset($this->stats[$this->uids[$u2]]['m4a2']) && $this->stats[$this->uids[$u2]]['m4a2']!=0 && $j==1) $tyv = ($this->stats[$this->uids[$u2]]['m4a2']==1 ? 1 : 0);//выключатели МФ
                    if(isset($this->stats[$this->uids[$u2]]['m4a3']) && $this->stats[$this->uids[$u2]]['m4a3']!=0 && $j==2) $tyv = ($this->stats[$this->uids[$u2]]['m4a3']==1 ? 1 : 0);//выключатели МФ

					if($no_mf!=0 && $u2b!=$u1 && $j==0) $tyv = 0;//Коварный уход
					//pr($u2b .' : '.$u2.' : '.$u1);
					//pr($u1.' nomf: '.$this->stats[$this->uids[$u1]]['no_mf'].' j: '.$j.' tyv: '.$tyv);
					//pr('u2 m4a: '.$this->stats[$this->uids[$u2]]['m4a'].' out: '.$this->atacks[$id]['out'.$b].' tyz: '.$tyv.' prdonmf: '.$priemDoMf);

					if( $tyv == 1 && $this->atacks[$id]['out'.$b] == 0 && $priemDoMf==false)
					{
						//увернулся, гад :)
                        //pr('atack: '.$at[$a]['atack'][$j][1]);
                        $this->stats[$this->uids[$u1]]['nopryh'] = floor(0+(int)$this->stats[$this->uids[$u1]]['nopryh']);
                        if( ((!isset($this->stats[$this->uids[$u1]]['nopryh']) || $this->stats[$this->uids[$u1]]['nopryh'] <= 0)
						&&  (!isset($this->stats[$this->uids[$u1]]['nopryh['.$j.']']) || $this->stats[$this->uids[$u1]]['nopryh['.$j.']'] <= 0))
                        || $j > 0)
						{
							if( !isset($this->stats[$this->uids[$u1]]['nopryh['.$j.']']) )
							{
								$at[$a]['atack'][$j][1] = 2;
								//pr('t1: уворот МФ:'.$at[$a]['atack'][$j][1].' a: '.$a.' j: '.$j);//.$j." ".$a.'<br>');
							}
                        } else {
                            		$this->stats[$this->uids[$u1]]['nopryh['.$j.']']++;
                            		$this->stats[$this->uids[$u1]]['nopryh']--;
                        	}
                    }
                    unset($tyv);
                }
                $j++;
            }

            $i++;
        }
        unset($witm01,$witm_type01,$wp01,$k01);

        return $at;
    }

    //Расчет крита игроков
    public function mf2Razmen($id,$at,$v)
	{
        global $u;

        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];

        //echo '*4';

        $i = 1;
        while( $i <= 2 )
		{
            if( $i == 1 ) {
                $a = 1;
                $b = 2;
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            }else{
                $a = 2;
                $b = 1;
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }

        	if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )
			{
            	$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
                $b = $a;
        	}

            //Расчет крита Атакующего (u1) по Цели (u2)
            $j = 0; $wp01 = 0; $k01 = 0;
            while($j < count($at[$a]['atack']) && $j < 8)
			{
				if($at[$a]['atack'][$j][1]!=2)//Если был уворот, не считать крит!!! $at[$a]['atack'][$j][1]!=1 &&
				{
					// КУДА БИЛ , ТИП УДАРА
	                if( $k01 == 0 && isset($this->stats[$this->uids[$u1]]['wp3id']) )
					{
	                    //Левая рука
	                    $wp01 = 3;
	                    $k01 = 1;
	                }else {
	                    //Правая рука
	                    if( isset($this->stats[$this->uids[$u1]]['wp14id'])
						&& $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp14id']]['type'] != 13 )
						{
	                        $wp01 = 14;
	                    }else{
	                        if( isset($this->stats[$this->uids[$u1]]['wp3id']) )
							{
	                            $wp01 = 3;
	                        }else{
	                            //нет оружия
	                            $wp01 = 3;
	                        }
	                    }
	                    $k01 = 0;
	                }
	                $witm01 = 0;
	                $witm_type01 = 0;
	                if( $wp01 > 0 )
					{
	                    $witm01 = $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp' . $wp01 . 'id']];
	                    $witm_data01 = $u->lookStats($witm01['data']);
	                    //$r['wt'] = $witm['type'];
	                }
	                //
	                if( $at[$a]['atack'][$j][2] == $v )
					{
						$atype = ($at[$a]['atack'][$j][1] == 6 ? 7 : 1);//Крит в парир или нет

						$tyv = $this->mfs( $atype , array( 'mf' => $this->stats[$this->uids[$u1]]['m1'] + $witm_data01['sv_m1'] ,
						'amf' => $this->stats[$this->uids[$u2]]['m2']  ) );

						if(isset($this->stats[$this->uids[$u1]]['m1a']) && $this->stats[$this->uids[$u1]]['m1a']!=0)
						{
							$tyv2 = ($this->stats[$this->uids[$u1]]['m1a']==1 ? 1 : 0);//выключатели МФ
							$tyv = $tyv2;
						}
                        if(isset($this->stats[$this->uids[$u1]]['m1a1']) && $this->stats[$this->uids[$u1]]['m1a1']!=0 && $j==0)
						{
							$tyv2 = ($this->stats[$this->uids[$u1]]['m1a1']==1 ? 1 : 0);//выключатели МФ
                            $tyv = $tyv2;
						}
                        if(isset($this->stats[$this->uids[$u1]]['m1a2']) && $this->stats[$this->uids[$u1]]['m1a2']!=0 && $j==1)
						{
							$tyv2 = ($this->stats[$this->uids[$u1]]['m1a2']==1 ? 1 : 0);//выключатели МФ
                            $tyv = $tyv2;
						}
                        if(isset($this->stats[$this->uids[$u1]]['m1a3']) && $this->stats[$this->uids[$u1]]['m1a3']!=0 && $j==2)
						{
							$tyv2 = ($this->stats[$this->uids[$u1]]['m1a3']==1 ? 1 : 0);//выключатели МФ
                            $tyv = $tyv2;
						}

						$krit_chance = rand(0,100);
						$priemDoMf = ($j==0 ? $this->PriemDoMf($u2) : false);

						if(($krit_chance  > $this->stats[$this->uids[$u2]]['enemy_am1'] || $tyv2 == 1) && $tyv == 1 && $priemDoMf == false)
						{
	                        //кританул, гад :)
	                        if( $at[$a]['atack'][$j][1] == 3 || $at[$a]['atack'][$j][1] == 6)
							{
	                            $at[$a]['atack'][$j][1] = 4;//в блок или парир
	                            //pr('t3: крит в блок - уворот: '.$at[$a]['atack'][$j][1].'<br>');//dg
	                        }else{
	                            $at[$a]['atack'][$j][1] = 5;//обычный крит
	                            //pr('t3: крит - уворот: '.$at[$a]['atack'][$j][1].'<br>');//dg
	                        }
                            //pr('atack:'.$at[$a]['atack'][$j][1]);
	                    }
	                }
					//pr('krit'.$j.':'.$at[$a]['atack'][$j][1]);
				}
                $j++;
            }
            $i++;
        }
        unset($witm01,$witm_type01,$k01,$wp01, $krit_chance, $tyv, $tyv2);

        return $at;
    }

    //Расчет парирования игроков
    public function mf3Razmen($id,$at,$v)
	{
        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];

        //echo '*5';
        $i = 1;

        while( $i <= 2 )
		{
			if( $i == 1 )
			{
                $a = 1;
                $b = 2;
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            } else {
                $a = 2;
                $b = 1;
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }

        	if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )
			{
            	$no_mf = ($this->stats[$this->uids[$u2]]['no_mf']!=0 ? 1 : 0);
                $u2b = $u2;
				$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
                $b = $a;
        	}
            //pr('u1['.$u1.'] - u2['.$u2.']<br>');//dg
            //pr('m7:'.$this->stats[$this->uids[$u2]]['m7'].'<br>');

            //Расчет парирования Цели (u2) от Атакующего (u1)
            $j = 0;
            while($j < count($at[$a]['atack']) && $j < 8)
			{
                if( $at[$a]['atack'][$j][2] == $v )
				{
                    //dvar($this->stats[$this->uids[$u1]]['effects']);

					$tyv = $this->mfs( 3 , array( '1' => $this->stats[$this->uids[$u2]]['m7'],
					'2' => $this->stats[$this->uids[$u1]]['m7'], 'u1' => $u2, 'u2' => $u1  ) );

					if(isset($this->stats[$this->uids[$u2]]['m7a'])  && $this->stats[$this->uids[$u2]]['m7a']!=0) $tyv = ($this->stats[$this->uids[$u2]]['m7a']==1 ? 1 : 0);//выключатели МФ
                    if(isset($this->stats[$this->uids[$u2]]['m7a1']) && $this->stats[$this->uids[$u2]]['m7a1']!=0 && $j==0) $tyv = ($this->stats[$this->uids[$u2]]['m7a1']==1 ? 1 : 0);//выключатели МФ
                    if(isset($this->stats[$this->uids[$u2]]['m7a2']) && $this->stats[$this->uids[$u2]]['m7a2']!=0 && $j==1) $tyv = ($this->stats[$this->uids[$u2]]['m7a2']==1 ? 1 : 0);//выключатели МФ
                    if(isset($this->stats[$this->uids[$u2]]['m7a3']) && $this->stats[$this->uids[$u2]]['m7a3']!=0 && $j==2) $tyv = ($this->stats[$this->uids[$u2]]['m7a3']==1 ? 1 : 0);//выключатели МФ

					if($no_mf!=0 && $u2b!=$u1 && $j==0) $tyv = 0;//Коварный уход

					$priemDoMf = ($j==0 ? $this->PriemDoMf($u2) : false);
					//pr($priemDoMf.':'.$u2);

                    if($tyv==1 && $this->atacks[$id]['out'.$b]==0 && $priemDoMf==false)
					{
                        //парировал, гад :)
                        //pr('Парир МФ');//dg
                        $this->stats[$this->uids[$u1]]['nopryh'] = floor(0+(int)$this->stats[$this->uids[$u1]]['nopryh']);

						if( ((!isset($this->stats[$this->uids[$u1]]['nopryh']) || $this->stats[$this->uids[$u1]]['nopryh'] <= 0)
						&&  (!isset($this->stats[$this->uids[$u1]]['nopryh['.$j.']']) || $this->stats[$this->uids[$u1]]['nopryh['.$j.']'] <= 0))
                        || $j > 0)
						{
							//print 'Парир МФ<br>';//dg
							$at[$a]['atack'][$j][1] = 6;
                            $at[$a]['atack'][$j]['parir'] = 1;
                            //$this->stats[$this->uids[$u1]]['nopryh['.$j.']']++;
                            //$this->stats[$this->uids[$u1]]['nopryh']--;
                        } else {
                            		$this->stats[$this->uids[$u1]]['nopryh['.$j.']']++;
                            		$this->stats[$this->uids[$u1]]['nopryh']--;
                        	   }
                    }
					unset($tyv);
                }
                $j++;
            }

            $i++;
        }

        return $at;
    }

    //Расчет блока щитом игроков
    public function mf4Razmen($id,$at,$v) {

        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];

        //echo '*6';

        $i = 1;
        while( $i <= 2 )
		{
            if( $i == 1 ) {
                $a = 1;
                $b = 2;
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            }else{
                $a = 2;
                $b = 1;
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }

        	if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )
			{
            	$no_mf = ($this->stats[$this->uids[$u2]]['no_mf']!=0 ? 1 : 0);
                $u2b = $u2;
				$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
                $b = $a;
        	}

            if( $this->stats[$this->uids[$u2]]['sheld1'] > 0 )
			{
                //Расчет блока щитом Цели (u2) от Атакующего (u1)
                //dvar( $at[$i] );
                $j = 0;
                while($j < count($at[$a]['atack']) && $j < 8)
				{
                    // КУДА БИЛ , ТИП УДАРА
                    if( $at[$a]['atack'][$j][1] != 3 )
					{
                        if( $at[$a]['atack'][$j][2] == $v )
						{
                            $tyv = $this->mfs( 5 , ($this->stats[$this->uids[$u2]]['m8']/2) );
                            $priemDoMf = ($j==0 ? $this->PriemDoMf($u2) : false);
                            
                            if(isset($this->stats[$this->uids[$u2]]['m8a'])  && $this->stats[$this->uids[$u2]]['m8a']!=0) $tyv = ($this->stats[$this->uids[$u2]]['m8a']==1 ? 1 : 0);//выключатели МФ
                            if(isset($this->stats[$this->uids[$u2]]['m8a1']) && $this->stats[$this->uids[$u2]]['m8a1']!=0 && $j==0) $tyv = ($this->stats[$this->uids[$u2]]['m8a1']==1 ? 1 : 0);//выключатели МФ
                    		if(isset($this->stats[$this->uids[$u2]]['m8a2']) && $this->stats[$this->uids[$u2]]['m8a2']!=0 && $j==1) $tyv = ($this->stats[$this->uids[$u2]]['m8a2']==1 ? 1 : 0);//выключатели МФ
                    		if(isset($this->stats[$this->uids[$u2]]['m8a3']) && $this->stats[$this->uids[$u2]]['m8a3']!=0 && $j==2) $tyv = ($this->stats[$this->uids[$u2]]['m8a3']==1 ? 1 : 0);//выключатели МФ

							if($no_mf!=0 && $u2b!=$u1 && $j==0) $tyv = 0;//Коварный уход

							if($tyv == 1 && $this->atacks[$id]['out'.$b] == 0 && $priemDoMf==false)
							{
                                //блокировал щитом, гад :)
								//pr($this->stats[$this->uids[$u1]]['nopryh']);
                                if( (!isset($this->stats[$this->uids[$u1]]['nopryh']) || $this->stats[$this->uids[$u1]]['nopryh'] == 0
								&& (!isset($this->stats[$this->uids[$u1]]['nopryh['.$j.']']) || $this->stats[$this->uids[$u1]]['nopryh['.$j.']'] <= 0))
								|| $j > 0 )
								{
                                    $at[$a]['atack'][$j][1] = 7;
                                    $this->stats[$this->uids[$u1]]['nopryh']--;
                                    //pr($this->stats[$this->uids[$u1]]['nopryh']);
                                }
                            }
                            unset($tyv);
                        }
                    }
                    $j++;
                }
            }

            $i++;
        }

        return $at;
    }

    //Расчет контрудара игроков
    public function mf5Razmen($id,$at,$v)
	{

		$uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];

        //echo '*7';

        $i = 1;
        while( $i <= 2 )
		{
            if( $i == 1 ) {
                $a = 1;
                $b = 2;
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            }else{
                $a = 2;
                $b = 1;
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }

        	if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )
			{
            	$no_mf = ($this->stats[$this->uids[$u2]]['no_mf']!=0 ? 1 : 0);
                $u2b = $u2;
				$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
                $b = $a;
        	}

            //Расчет контрудара Цели (u2) по Атакующему (u1)
            $j = 0;
            while($j < count($at[$a]['atack']) && $j < 8)
			{
                //pr($uid1.' : '.$u1);
				// КУДА БИЛ , ТИП УДАРА
                if( $at[$a]['atack'][$j][2] == $v )
				{
					if( $at[$a]['atack'][$j][1] == 2 || (isset($this->stats[$this->uids[$u2]]['m6a']) && $this->stats[$this->uids[$u2]]['m6a']!=0))
					{
                        $priemDoMf = ($j==0 ? $this->PriemDoMf($u2) : false);

						$tyv = $this->mfs( 6 , $this->stats[$this->uids[$u2]]['m6'] );
						
                        if(isset($this->stats[$this->uids[$u2]]['m6a'])  && $this->stats[$this->uids[$u2]]['m6a']!=0) $tyv = ($this->stats[$this->uids[$u2]]['m6a']==1 ? 1 : 0);//выключатели МФ
                        if(isset($this->stats[$this->uids[$u2]]['m6a1']) && $this->stats[$this->uids[$u2]]['m6a']!=0 && $j==0) $tyv = ($this->stats[$this->uids[$u2]]['m6a1']==1 ? 1 : 0);//выключатели МФ
                    	if(isset($this->stats[$this->uids[$u2]]['m6a2']) && $this->stats[$this->uids[$u2]]['m6a']!=0 && $j==1) $tyv = ($this->stats[$this->uids[$u2]]['m6a2']==1 ? 1 : 0);//выключатели МФ
                    	if(isset($this->stats[$this->uids[$u2]]['m6a3']) && $this->stats[$this->uids[$u2]]['m6a']!=0 && $j==2) $tyv = ($this->stats[$this->uids[$u2]]['m6a3']==1 ? 1 : 0);//выключатели МФ

                        if($no_mf!=0 && $u2b!=$u1 && $j==0) $tyv = 0;//Коварный уход

						if($tyv == 1 && $priemDoMf==false)
						{
                            //контрудар, гад :)
                            //pr('Контрудар МФ');//dg
							$this->contr_mf = true;//dg
							$at[$a]['atack'][$j][1] = 8;
							//pr('contr mf a: '.$a.' j:'.$j);
                            $rnd_a = rand(1,5);

                            if( $this->testRazmenblock1($id,$u2,$u1,$rnd_a) == false )
							{
                                $at[$b]['atack'][] = array( $rnd_a , 1 , 1 , 1 );
                            }else{
                                $at[$b]['atack'][] = array( $rnd_a , 3 , 1 , 1 );
                            }
                            $at = $this->contrRestart($id,$at,1);
                        }
                        unset($tyv);
                    }
                }
                $j++;
            }

            $i++;
        }

        return $at;
    }

    //Просмотр (для админов)
    public function seeRazmen($id,$at)
	{
        $r = '';

        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];

        $i = 1;

		while($i <= 2)
		{
            if( $i == 1 ) {
                $a = 1;
                $b = 2;
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            }else{
                $a = 2;
                $b = 1;
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }

            if( !isset($at[$a]['atack']) )
			{
                $s .= 'u1 пропустил свой ход<br>';
            }else{
                $j = 0;
                while($j < count($at[$a]['atack']) && $j < 8)
				{
					$s = '';

					if( $at[$a]['atack'][$j][1] == 1 ) {
                        //u1 ударил обычным ударом u2
                        $s .= 'u1 ударил обычным ударом u2';
                    }elseif( $at[$a]['atack'][$j][1] == 2 ) {
                        //u2 увернулся от u1
                        $s .= 'u2 увернулся от u1';
                    }elseif( $at[$a]['atack'][$j][1] == 3 ) {
                        //u2 заблокировал удар u1
                        $s .= 'u2 заблокировал удар u1';
                    }elseif( $at[$a]['atack'][$j][1] == 4 && $at[$a]['atack'][$j]['parir'] == 1) {
                        //u1 пробил парир u2 критом
                        $s .= 'u1 пробил паририрование u2 критом';
                    }elseif( $at[$a]['atack'][$j][1] == 4 ) {
                        //u1 пробил блок u2 критом
                        $s .= 'u1 пробил блок u2 критом';
                    }elseif( $at[$a]['atack'][$j][1] == 5 ) {
                        //u1 ударил критическим ударом u2
                        $s .= 'u1 ударил критом u2';
                    }elseif( $at[$a]['atack'][$j][1] == 6 ) {
                        //u2 парировал удар u1
                        $s .= 'u2 парировал удар u1';
                    }elseif( $at[$a]['atack'][$j][1] == 7 ) {
                        //u2 блокировал щитом удар u1
                        $s .= 'u2 блокировал щитом удар u1';
                    }elseif( $at[$a]['atack'][$j][1] == 8 ) {
                        //u2 увернулся от удара u1 и нанес по нему контрудар
                        $s .= 'u2 увернулся и нанес u1 контрудар';
                    }
                    if( $at[$a]['atack'][$j][3] == 1 ) {
                        $s .= ' (контрудар)';
                    }
                    if( isset($at[$a]['atack'][$j]['yron']) )
					{
                        if(isset($at[$a]['atack'][$j]['yron']['r']))
						{
							$s .= ' '.($at[$a]['atack'][$j]['yron']['y'] ? $at[$a]['atack'][$j]['yron']['r'] : '--');
							$s .= ' ['.(($at[$a]['atack'][$j][1] == 5 || $at[$a]['atack'][$j][1] == 4) ? $at[$a]['atack'][$j]['yron']['m_k'] : $at[$a]['atack'][$j]['yron']['m_y']).']';
						}
                        if( $at[$a]['atack'][$j]['yron']['w'] == 3 ) {
                            $s .= ' (правая рука)';
                        }elseif( $at[$a]['atack'][$j]['yron']['w'] == 14 ) {
                            $s .= ' (левая рука)';
                        }
                    }
                    if( isset($at[$a]['atack'][$j]['yron']['hp']) ) {
                        $s .= ' ['.floor($at[$a]['atack'][$j]['yron']['hp']).'/'.floor($at[$a]['atack'][$j]['yron']['hpAll']).']';
                    }

					if( $this->stats[$this->uids[$u1]]['yhod'] > 0 && $at[$a]['atack'][$j][3] == 1)//Для контры
					{
                        $s = str_replace('u1','u2',$s);
            		}
					elseif( ($this->stats[$this->uids[$u2]]['yhod'] > 0))// && $this->stats[$this->uids[$u2]]['no_mf']==0)
					//|| ($this->stats[$this->uids[$u2]]['yhod'] > 0 && $this->stats[$this->uids[$u2]]['no_mf']==1 && $j==0)  )//Коварный уход
					{
                		$s = str_replace('u2','u1',$s);
            		}

					if($s!='') $r .= $s.',<br>';

                    $j++;

                }
            }

            $r = str_replace('u1','<b>'.$this->users[$this->uids[$u1]]['login'].'</b>',$r);
            $r = str_replace('u2','<b>'.$this->users[$this->uids[$u2]]['login'].'</b>',$r);

            //$u1 = $u1b;
            //$u2 = $u2b;

			$i++;
        }

        return $r;
    }

    //Выделение из лог текста
    public function addlt( $a , $id , $s , $rnd ) {
        global $log_text;
        if( $rnd == NULL ) {
            $rnd = rand(0,(count($log_text[$s][$id])-1));
        }
        return '{'.$a.'x'.$id.'x'.$rnd.'}';
    }

    //Добавляем статистику
    public function addNewStat($stat) {
        if( isset($stat[1]) ) {
            mysql_query('INSERT INTO `battle_stat`
				( `battle`,`uid1`,`uid2`,`time`,`type`,`a`,`b`,`ma`,`mb`,`type_a`,`type_b`,`yrn`,`yrn_krit`,`tm1`,`tm2` ) VALUES (
					"'.$this->info['id'].'",
					"'.$stat[1]['uid1'].'",
					"'.$stat[1]['uid2'].'",
					"'.$stat[1]['time'].'",
					"'.$stat[1]['type'].'",
					"'.$stat[1]['a'].'",
					"'.$stat[1]['b'].'",
					"'.$stat[1]['ma'].'",
					"'.$stat[1]['mb'].'",
					"'.$stat[1]['type_a'].'",
					"'.$stat[1]['type_b'].'",
					"'.$stat[1]['yrn'].'",
					"'.$stat[1]['yrn_krit'].'",
					"'.$stat[1]['tm1'].'",
					"'.$stat[1]['tm2'].'"
				)');
        }
        if( isset($stat[2]) ) {
            mysql_query('INSERT INTO `battle_stat`
				( `battle`,`uid1`,`uid2`,`time`,`type`,`a`,`b`,`ma`,`mb`,`type_a`,`type_b`,`yrn`,`yrn_krit`,`tm1`,`tm2` ) VALUES (
					"'.$this->info['id'].'",
					"'.$stat[2]['uid1'].'",
					"'.$stat[2]['uid2'].'",
					"'.$stat[2]['time'].'",
					"'.$stat[2]['type'].'",
					"'.$stat[2]['a'].'",
					"'.$stat[2]['b'].'",
					"'.$stat[1]['ma'].'",
					"'.$stat[2]['mb'].'",
					"'.$stat[2]['type_a'].'",
					"'.$stat[2]['type_b'].'",
					"'.$stat[2]['yrn'].'",
					"'.$stat[2]['yrn_krit'].'",
					"'.$stat[2]['tm1'].'",
					"'.$stat[2]['tm2'].'"
				)');
        }
    }

    public $prlog = array();

    //Добавляем размены в лог
    public function addlogRazmen($id,$at)
	{
        global $u;

        $r = '';

        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];
		$uid2s = $uid2;

        $this->hodID++;

        $dies = array(
            1 => 0,
            2 => 0
        );

        //массив для статистики
        $stat = array(
            1 => array(
                'uid1' => 0,
                'uid2' => 0,
                'time' => time(),
                'type' => 0,
                'a' => '00000',
                'b' => '0',
                'type_a' => '',
                'type_b' => '0',
                'yrn' => 0,
                'yrn_krit' => 0,
                'ma' => 0,
                'mb' => 0,
                'tm1' => 0,
                'tm2' => 0
            ),
            2 => array(
                'uid1' => 0,
                'uid2' => 0,
                'time' => time(),
                'type' => 0,
                'a' => '00000',
                'b' => '0',
                'type_a' => '',
                'type_b' => '0',
                'yrn' => 0,
                'yrn_krit' => 0,
                'ma' => 0,
                'mb' => 0,
                'tm1' => 0,
                'tm2' => 0
            )
        );

        $i = 1;
        while($i <= 2) {
            if( $i == 1 ) {
                $a = 1;
                $b = 2;
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            }else{
                $a = 2;
                $b = 1;
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }
			$block_u2 = $b;
			$zb2 = $this->stats[$this->uids[$u2]]['zonb'];

   			if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )
			{
				if($this->stats[$this->uids[$u2]]['no_mf']==1)//коварный уход - удаляем все зоны блока, визуалка
				{
                    if($this->stats[$this->uids[$u2]]['no_mf']==1) $no_mf = 1;//Коварный уход
					$zb2 = 0; $block_u2 = 0;
				} else $block_u2 = $a;

				$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
                if(!$no_mf) $zb2 = $this->stats[$this->uids[$u2]]['zonb'];
            }

            $s1 = $this->users[$this->uids[$u1]]['sex'];
            $s2 = $this->users[$this->uids[$u2]]['sex'];

            $stat[$a]['uid1'] = $u1;
            $stat[$a]['uid2'] = $u2;
            $stat[$a]['ma'] = $this->stats[$this->uids[$u1]]['zona'];
            $stat[$a]['mb'] = $this->stats[$this->uids[$u1]]['zonb'];
            $stat[$a]['tm1'] = $this->users[$this->uids[$u1]]['team'];
            $stat[$a]['tm2'] = $this->users[$this->uids[$u2]]['team'];
            $stat[$a]['a'] = $this->atacks[$id]['a'.$a];
            $stat[$a]['b'] = $this->atacks[$id]['b'.$a];
			//at1=00000||at2=00000||
            $vLog = 'zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$zb2.'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$block_u2].'||time1='.$this->atacks[$id]['time'].'||time2='.$this->atacks[$id]['time2'].'||s'.$a.'='.$s1.'||s'.$b.'='.$s2.'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';

            $mas = array(
                'text' => '',
                'time' => time(),
                'vars' => '',
                'battle' => $this->info['id'],
                'id_hod' => $this->hodID,
                'vars' => $vLog,
                'type' => 1
            );

            if( !isset($at[$a]['atack']) )
			{
                if( $this->atacks[$id]['tpo'.$a] == 2 )
				{
                    $mas['text'] .= '{u1} потратил свой ход на магию.';
                }else{
                    //
                    if( $this->info['razdel'] == 0 && $this->info['dn_id'] == 0 && $this->info['izlom'] == 0 ) {
                        mysql_query('INSERT INTO `battle_out` (`battle`,`uid1`,`uid2`,`time`,`out`) VALUES (
								"'.$this->info['id'].'","'.$u1.'","'.$u2.'","'.time().'","1"
							)');
                    }
                    //
                    $mas['text'] .= '{u1} пропустил свой ход.';
                }
                $mas['text'] = '{tm1} ' . $mas['text'];
                $this->add_log($mas);
                //if(isset($this->stats[$this->uids[$u2]]['login2']) && $this->stats[$this->uids[$u2]]['login2']!='') $this->add_log($mas);
				//else error_log($mas['text'].' vars:'.$vLog);
            }else{
                $j = 0;
                while($j < count($at[$a]['atack']) && $j < 8)
				{
                    
                	/*if($j > 0 && $no_mf==1)//Коварный уход
					{
						$u2 = $uid2s;
                        $block_u2 = $b;
						$zb2 = $this->stats[$this->uids[$u2]]['zonb'];
                        $stat[$a]['uid2'] = $u2;
                        $stat[$a]['tm2'] = $this->users[$this->uids[$u2]]['team'];
                        $no_mf = 0;
                        $vLog = 'zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$zb2.'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$block_u2].'||time1='.$this->atacks[$id]['time'].'||time2='.$this->atacks[$id]['time2'].'||s'.$a.'='.$s1.'||s'.$b.'='.$s2.'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';
					}*/
					//
                    $mas['text'] = '';
                    //
                    $wt = array(
                        21 => 4,
                        22 => 5,
                        20 => 2,
                        28 => 2,
                        19 => 3,
                        18 => 1,
                        26 => 22
                    );
                    $par = array(
                        'zona' => '{zn2_'.$at[$a]['atack'][$j][0].'} ',
                        'kyda' => $this->lg_zon[$at[$a]['atack'][$j][0]][rand(0,(count($this->lg_zon[$at[$a]['atack'][$j][0]])-1))],
                        'chem' => $this->lg_itm[$wt[$at[$a]['atack'][$j]['wt']]][rand(0,(count($this->lg_itm[$wt[$at[$a]['atack'][$j]['wt']]])-1))]
                    );

                    //
                    $this->atacks[$id]['uid_'.$u1.'_t'.$at[$a]['atack'][$j][1]]++;
                    //$this->asr( $u1 , $u2 , $at[$a]['atack'][$j][1] );
                    /* if( $at[$a]['atack'][$j][3]==1 ) {//Я добавил
                        //u2 увернулся от удара u1 и нанес по нему контрудар
                        $mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} <font color=#0071a3><b>' . $this->addlt($b,11,$s2,NULL) . '</b></font> '.$par['chem'].' '.$par['kyda'].' и нанес контрудар. ';
                    }else */if( $at[$a]['atack'][$j][1] == 1 ) {
                        //u1 ударил обычным ударом u2
                        $mas['text'] .= $par['zona'] . '{u2} ' . $this->addlt($b,1,$s2,NULL) . '' . $this->addlt($b,2,$s2,NULL) . '' . $this->addlt($a,3,$s1,NULL) . ' {u1} ' . $this->addlt($a,4,$s1,NULL) . '' . $this->addlt($a,5,$s1,NULL) . '' . $this->addlt($a,6,$s1,NULL) . ' ' . $this->addlt(1,7,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
                    }elseif( $at[$a]['atack'][$j][1] == 2 ) {
                        //u2 увернулся от u1
                        $mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} ' . $this->addlt($b,11,$s2,NULL) . ' '.$par['chem'].' '.$par['kyda'].'. ';
                    }elseif( $at[$a]['atack'][$j][1] == 3 ) {
                        //u2 заблокировал удар u1
                        $mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} ' . $this->addlt($b,10,$s2,NULL) . ' ' . $this->addlt(1,7,0,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
                    }elseif( $at[$a]['atack'][$j][1] == 4 && $at[$a]['atack'][$j]['parir'] == 1) {
                        //u1 пробил парир u2 критом
                        $mas['text'] .= $par['zona'] . '{u2} ' . $this->addlt($b,1,$s2,NULL) . '' . $this->addlt($b,2,$s2,NULL) . '' . $this->addlt($a,3,$s1,NULL) . ' {u1} ' . $this->addlt($a,4,$s1,NULL) . '' . $this->addlt($a,5,$s1,NULL) . ',' . $this->addlt($a,6,$s1,NULL) . ' ' . $this->addlt(1,7,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
                    }elseif( $at[$a]['atack'][$j][1] == 4 && $at[$a]['atack'][$j]['parir'] != 1 ) {
                        //u1 пробил блок u2 критом
                        $mas['text'] .= $par['zona'] . '{u2} ' . $this->addlt($b,1,$s2,NULL) . '' . $this->addlt($b,2,$s2,NULL) . '' . $this->addlt($a,3,$s1,NULL) . ' {u1} ' . $this->addlt($a,4,$s1,NULL) . '' . $this->addlt($a,5,$s1,NULL) . ',<b><font color=black>пробив блок</font></b>, ' . $this->addlt($a,6,$s1,NULL) . ' ' . $this->addlt(1,7,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
                    }elseif( $at[$a]['atack'][$j][1] == 5 ) {
                        //u1 ударил критическим ударом u2
                        $mas['text'] .= $par['zona'] . '{u2} ' . $this->addlt($b,1,$s2,NULL) . '' . $this->addlt($b,2,$s2,NULL) . '' . $this->addlt($a,3,$s1,NULL) . ' {u1} ' . $this->addlt($a,4,$s1,NULL) . '' . $this->addlt($a,5,$s1,NULL) . '' . $this->addlt($a,6,$s1,NULL) . ' ' . $this->addlt(1,7,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
                    }elseif( $at[$a]['atack'][$j][1] == 6 ) {
                        //u2 парировал удар u1
                        $mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} неожиданно парировал ' . $this->addlt(1,7,0,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
                    }elseif( $at[$a]['atack'][$j][1] == 7 ) {
                        //u2 блокировал щитом удар u1
                        $mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2}, воспользовавшись своим щитом, ' . $this->addlt($b,10,$s2,NULL) . ' ' . $this->addlt(1,7,0,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
                    }elseif( $at[$a]['atack'][$j][1] == 8 ) {
                        //u2 увернулся от удара u1 и нанес по нему контрудар
                        $mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} ' . $this->addlt($b,11,$s2,NULL) . ' '.$par['chem'].' '.$par['kyda'].' и нанес контрудар. ';
                    }
					//print 'tt:'.$at[$a]['atack'][$j][1].' - '.$at[$a]['atack'][$j][3].'<br>';
					// || $at[$a]['atack'][$j][3]!==1

                    $stat[$a]['type_a'] .= ''.$at[$a]['atack'][$j][1].'';
                    if( (!isset($this->stats[$this->uids[$u2]]['notravma']) || $this->stats[$this->uids[$u2]]['notravma'] == 0 )  && isset($at[$a]['atack'][$j]['yron']['travma']) && $at[$a]['atack'][$j]['yron']['travma'][0] > 0 && floor($at[$a]['atack'][$j]['yron']['hp']) <= 0 ) {
                        $tr_pl = mysql_fetch_array(mysql_query('SELECT `id`,`v1` FROM `eff_users` WHERE `id_eff` = 4 AND `uid` = "'.$u2.'" AND `delete` = "0" ORDER BY `v1` DESC LIMIT 1'));
                        if( !isset($tr_pl['id']) || $tr_pl['v1'] < 3 )
						{
                            //263
                            if( isset($tr_pl['id']) ) {
                                $at[$a]['atack'][$j]['yron']['travma'][0] = rand(($tr_pl['v1']+1),3);
                            }
                            $tr_pl2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$u2.'" AND `delete` = "0" AND `name` LIKE "%Защита от травм%" LIMIT 1'));
                            if( !isset($tr_pl2['id']) && $at[$a]['atack'][$j]['yron']['travma'][0] <= 3 ) {
                                $mas['text'] = rtrim($mas['text'],'. ');
                                $mas['text'] .= ', нанеся противнику <font color=red><b>';
                                if( $at[$a]['atack'][$j]['yron']['travma'][0] == 1 ) {
                                    $mas['text'] .= 'Легкую';
                                    $this->addTravm($u2,1,rand(3,5));
                                }elseif( $at[$a]['atack'][$j]['yron']['travma'][0] == 2 ) {
                                    $mas['text'] .= 'Среднюю';
                                    $this->addTravm($u2,2,rand(3,5));
                                }elseif( $at[$a]['atack'][$j]['yron']['travma'][0] == 3 ) {
                                    $mas['text'] .= 'Тяжелую';
                                    $this->addTravm($u2,3,rand(3,5));
                                }
                                $mas['text'] .= ' травму</b></font>. ';
                            }
                        }
                        unset($tr_pl);
                    }
                    if( $at[$a]['atack'][$j]['yron']['pb'] == 1 && isset($at[$a]['atack'][$j]['yron']['hp']) ) {
                        $mas['text'] = rtrim($mas['text'],'. ');
                        $mas['text'] .= '';
                    }
                    if( $at[$a]['atack'][$j][3] == 1 )
					{
						$mas['text'] .= ' контрудар ';
                    }
                    if( isset($at[$a]['atack'][$j]['yron']) ) {
                        if( $at[$a]['atack'][$j]['yron']['w'] == 3 ) {
                            $mas['textWP'] = '(правая&nbsp;рука)';
                        }elseif( $at[$a]['atack'][$j]['yron']['w'] == 14 ) {
                            $mas['textWP'] = '(левая&nbsp;рука)';
                        }else{
                            $mas['textWP'] = '(непонятно&nbsp;чем)';
                        }
                        if( $at[$a]['atack'][$j][1] == 4 || $at[$a]['atack'][$j][1] == 5 || $at[$a]['atack'][$j][1] == 1 ) {
                            if( $at[$a]['atack'][$j]['yron']['y'] < 1 ) {
                                $at[$a]['atack'][$j]['yron']['r'] = '--';
                            }
                        }
                        if( $at[$a]['atack'][$j][1] == 4 || $at[$a]['atack'][$j][1] == 5)
						{
                            $stat[$a]['yrn_krit'] += -$at[$a]['atack'][$j]['yron']['r'];
                            $mas['text'] .= ' <font title='.$mas['textWP'].' color=#ff0000><b>'.$at[$a]['atack'][$j]['yron']['r'].'</b></font>';
                        }elseif( isset($at[$a]['atack'][$j]['yron']['hp']) )//добавил: isset($at[$a]['atack'][$j]['yron']['hp'])
						{
                            $mas['text'] .= ' <font title='.$mas['textWP'].' color=#0066aa><b>'.$at[$a]['atack'][$j]['yron']['r'].'</b></font>';
                        }
                        $stat[$a]['yrn'] += -$at[$a]['atack'][$j]['yron']['r'];
                    }
                    if( isset($at[$a]['atack'][$j]['yron']['hp']) )
					{
                        if($this->users[$this->uids[$u2]]['align']==9){
                            $at[$a]['atack'][$j]['yron']['hp'] = $at[$a]['atack'][$j]['yron']['hp']/($at[$a]['atack'][$j]['yron']['hpAll']/100);
                            $at[$a]['atack'][$j]['yron']['hpAll'] = '100%';
                        }
                        $mas['text'] .= ' ['.floor($at[$a]['atack'][$j]['yron']['hp']).'/'.floor($at[$a]['atack'][$j]['yron']['hpAll']).']';
                    }
                    //
                    if( $mas['text'] != '' ) {
                        $mas['text'] = '{tm1} ' . $mas['text'];
                    }
                    if( count($at[$a]['atack'][$j]['yron']['plog']) > 0 )
					{
                        $il = 0;
                        while( $il <= count($at[$a]['atack'][$j]['yron']['plog']) )
						{
                            if( isset($at[$a]['atack'][$j]['yron']['plog'][$il]) )
							{
								eval($at[$a]['atack'][$j]['yron']['plog'][$il]);
                            }
                            $il++;
                        }
                    }

                    if( $this->stats[$this->uids[$u1]]['yhod'] > 0 && $at[$a]['atack'][$j][3] == 1)//Для контры
					{
                        $mas['text'] = str_replace('u1','u2',$mas['text']);
            		}
					elseif( ($this->stats[$this->uids[$u2]]['yhod'] > 0))// && $this->stats[$this->uids[$u2]]['no_mf']==0)
					//|| ($this->stats[$this->uids[$u2]]['yhod'] > 0 && $this->stats[$this->uids[$u2]]['no_mf']==1 && $j==0) )//Коварный уход
					{
                		$mas['text'] = str_replace('u2','u1',$mas['text']);
						pr($this->stats[$this->uids[$u2]]['no_mf']);
            		}

                    $this->add_log($mas);
                    $j++;
                }
            }
            $i++;
        }

        //Добавляем статистику + записываем в баттл_юзерс НР игроков
        $this->addNewStat( $stat );

        //Вывод в лог смерти персонажа
        if( floor($this->stats[$this->uids[$u1]]['hpNow']) < 1 ) {
            $dies[1] = 1;
        }
        if( floor($this->stats[$this->uids[$u2]]['hpNow']) < 1 ) {
            $dies[2] = 1;
        }
        if( $dies[1] > 0 || $dies[2] > 0 ) {
            //$s1 = $this->users[$this->uids[$u1]]['sex'];
            //$s2 = $this->users[$this->uids[$u2]]['sex'];
			//at1=00000||at2=00000||
            /*$vLog = 'zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$this->stats[$this->uids[$u2]]['zonb'].'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$b].'||time1='.$this->atacks[$id]['time'].'||time2='.$this->atacks[$id]['time2'].'||s2='.$this->users[$this->uids[$u2]]['sex'].'||s1='.$this->users[$this->uids[$u1]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';

            $mas = array(
                'text' => '',
                'time' => time(),
                'vars' => '',
                'battle' => $this->info['id'],
                'id_hod' => $this->hodID,
                'vars' => $vLog,
                'type' => 1
            );*/

            $rtngwin = array( 1 , 2 , 3 , 5 , 10 , 20 , 40 , 80 , 160 );
            $rtnglos = array( 0 , 0 , 0 , -1 , -2 , -5 , -10 , -20 , -40 );

            if( $this->info['typeBattle'] == 99 ) {
                if( $btlstatus[0] == 0 ) {
                    //Кровавые бои обычные
                    $rtngwin = array( 2 , 4 , 6 , 10 , 20 , 40 , 80 , 160 , 320 );
                    if( $this->info['razdel'] == 5 ) {
                        //не хаот
                        $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                    }else{
                        //хаот
                        $rtnglos = array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 );
                    }
                }elseif( $btlstatus[0] == 25 ) {
                    //Кровавая битва
                    $rtngwin = array( 3 , 6 , 9 , 15 , 30 , 60 , 120 , 240 , 480 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }elseif( $btlstatus[0] == 50 ) {
                    //Кровавая резня
                    $rtngwin = array( 4 , 8 , 16 , 32 , 64 , 128 , 256 , 512 , 1024 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }elseif( $btlstatus[0] == 75 ) {
                    //Кровавая сеча
                    $rtngwin = array( 5 , 10 , 20 , 40 , 80 , 160 , 320 , 640 , 1280 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }elseif( $btlstatus[0] == 100 ) {
                    //Кровавое побоище
                    $rtngwin = array( 6 , 12 , 24 , 48 , 98 , 196 , 392 , 784 , 1568 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }elseif( $btlstatus[0] == 150 ) {
                    //Судный день
                    $rtngwin = array( 7 , 14 , 28 , 56 , 112 , 224 , 448 , 896 , 1792 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }
            }else{
                if( $btlstatus[0] == 0 ) {
                    //Обычный поединок
                    $rtngwin = array( 1 , 2 , 3 , 5 , 10 , 20 , 40 , 80 , 160 );
                    if( $this->info['razdel'] == 5 ) {
                        //не хаот
                        $rtnglos = array( 0 , 0 , 0 , -1 , -2 , -5 , -10 , -20 , -40 );
                    }else{
                        //хаот
                        $rtnglos = array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 );
                    }
                }elseif( $btlstatus[0] == 25 ) {
                    //великая битва
                    $rtngwin = array( 2 , 4 , 6 , 10 , 20 , 40 , 80 , 160 , 320 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }elseif( $btlstatus[0] == 50 ) {
                    //величайшая битва
                    $rtngwin = array( 3 , 6 , 9 , 15 , 30 , 60 , 120 , 240 , 480 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }elseif( $btlstatus[0] == 75 ) {
                    //историческая битва сеча
                    $rtngwin = array( 4 , 8 , 16 , 32 , 64 , 128 , 256 , 512 , 1024 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }elseif( $btlstatus[0] == 100 ) {
                    //эпохальная битва
                    $rtngwin = array( 5 , 10 , 20 , 40 , 80 , 160 , 320 , 640 , 1280 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }elseif( $btlstatus[0] == 150 ) {
                    //судный день
                    $rtngwin = array( 7 , 14 , 28 , 56 , 112 , 224 , 448 , 896 , 1792 );
                    $rtnglos = array( 0 , 0 , 0 , -2 , -4 , -10 , -20 , -40 , -80 );
                }
            }
            if( $this->info['dn_id'] > 0 || $this->info['izlom'] != 0 || $this->info['turnir'] != 0 ) {
                //Пещерные бои не считаются и Изломы тоже, ну и Турниры
                $rtngwin = array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 );
                $rtnglos = array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 );
            }elseif( $cln_war['clan1'] > 0 && $cln_war['clan2'] > 0 ) {
                //Клановая война
                $rtngwin = array( 3 , 6 , 9 , 15 , 30 , 60 , 120 , 240 , 480 );
                $rtnglos = array( -1 , -2 , -4 , -8 , -16 , -32 , -64 , -128 , -256 );
            }elseif($u->stats['premium2'] == 2) {
                $rtngwin = array( 3.75 , 7.5 , 11.25 , 18.75 , 37.5 , 75 , 150 , 300 , 600 );
            }elseif($u->stats['premium3'] == 3) {
                $rtngwin = array( 6 , 12 , 18 , 30 , 60 , 120 , 240 , 480 , 960 );
            }

            if( $dies[1] == 1 ) {
					if( $this->info['dn_id'] > 0 ) {
						//не дается репутация	
					}else{
						if( $this->users[$this->uids[$u1]]['level']  >= 4 ) {
							$rtng1 += $rtnglos[$this->users[$this->uids[$u1]]['level']-4];
							$rtng2 += $rtngwin[$this->users[$this->uids[$u1]]['level']-4];
						}
				}
					//Персонаж 1 погиб от рук персонаж 2
					mysql_query('DELETE FROM `battle_act` WHERE `uid1` = "'.$u1.'" OR `uid2` = "'.$u1.'"');
					if($this->stats[$this->uids[$u1]]['hpNow'] < 1 && $this->stats[$this->uids[$u1]]['spasenie'] > 0 ) {
						//Свиток спасения
						mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u1.'" AND `id_eff` = 22 AND `v1` = "priem" AND `v2` = 324');
						//
						$this->stats[$this->uids[$u1]]['hpNow'] = floor($this->stats[$this->uids[$u1]]['hpAll']/2);
						if( $this->stats[$this->uids[$u1]]['hpNow'] < 1 ) {
							$this->stats[$this->uids[$u1]]['hpNow'] = 1;
						}
						if( $this->stats[$this->uids[$u1]]['hpNow'] > $this->stats[$this->uids[$u1]]['hpAll'] ) {
							$this->stats[$this->uids[$u1]]['hpNow'] = floor($this->stats[$this->uids[$u1]]['hpAll']);
						}
						//
						$this->stats[$this->uids[$u1]]['mpNow'] = floor($this->stats[$this->uids[$u1]]['mpAll']/2);
						if( $this->stats[$this->uids[$u1]]['mpNow'] < 1 ) {
							$this->stats[$this->uids[$u1]]['mpNow'] = 1;
						}
						if( $this->stats[$this->uids[$u1]]['mpNow'] > $this->stats[$this->uids[$u1]]['mpAll'] ) {
							$this->stats[$this->uids[$u1]]['mpNow'] = floor($this->stats[$this->uids[$u1]]['mpAll']);
						}
						//
						mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$u1]]['hpNow'].'",`mpNow` = "'.$this->stats[$this->uids[$u1]]['mpNow'].'" WHERE `id` = "'.$u1.'" LIMIT 1');
						//
						if( $this->stats[$this->uids[$u1]]['s7'] > 24 ) {
							//Даем призрачку 
							mysql_query("INSERT INTO `eff_users` 
							(`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
							(22, '".$u1."', 'Призрачная защита', '', 0, 77, 0, '".$u1."', 0, 'priem', 141, 'spirit_block25.gif', 1, 1, '0', 0, 0, '', 0, 0, 0, 0, 0);");
						}
						if( $this->stats[$this->uids[$u1]]['s7'] > 99 ) {
							//Смерть очищает вас от негативных эффектов заклинаний, проклятий, болезней и ядов в текущем бою
							
						}
						$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u1]]['login'].'</b> убит...<b>'.$this->stats[$this->uids[$u1]]['login'].'</b> был спасен. ';
						$this->add_log($mas);
						//
					}else{
						mysql_query('UPDATE `stats` SET `hpNow` = "0",`mpNow` = "0" WHERE `id` = "'.$u1.'" LIMIT 1');
						$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u1]]['login'].'</b> погиб.';
						$this->add_log($mas);
					}
				}
				if( $dies[2] == 1 ) {
					if( $this->info['dn_id'] > 0 ) {
						//не дается репутация	
					}else{
						$rtng1 += $rtngwin[$this->users[$this->uids[$u2]]['level']];
						$rtng2 += $rtnglos[$this->users[$this->uids[$u2]]['level']];
					}
					//Персонаж 2 погиб от рук персонаж 1
					mysql_query('DELETE FROM `battle_act` WHERE `uid1` = "'.$u2.'" OR `uid2` = "'.$u2.'"');
					if( $this->stats[$this->uids[$u2]]['spasenie'] > 0 ) {
						//Свиток спасения
						mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u2.'" AND `id_eff` = 22 AND `v1` = "priem" AND `v2` = 324');
						//
						$this->stats[$this->uids[$u2]]['hpNow'] = floor($this->stats[$this->uids[$u2]]['hpAll']/2);
						if( $this->stats[$this->uids[$u2]]['hpNow'] < 1 ) {
							$this->stats[$this->uids[$u2]]['hpNow'] = 1;
						}
						if( $this->stats[$this->uids[$u2]]['hpNow'] > $this->stats[$this->uids[$u2]]['hpAll'] ) {
							$this->stats[$this->uids[$u2]]['hpNow'] = floor($this->stats[$this->uids[$u2]]['hpAll']);
						}
						//
						$this->stats[$this->uids[$u2]]['mpNow'] = floor($this->stats[$this->uids[$u2]]['mpAll']/2);
						if( $this->stats[$this->uids[$u2]]['mpNow'] < 1 ) {
							$this->stats[$this->uids[$u2]]['mpNow'] = 1;
						}
						if( $this->stats[$this->uids[$u2]]['mpNow'] > $this->stats[$this->uids[$u2]]['mpAll'] ) {
							$this->stats[$this->uids[$u2]]['mpNow'] = floor($this->stats[$this->uids[$u2]]['mpAll']);
						}
						//
						mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$u2]]['hpNow'].'",`mpNow` = "'.$this->stats[$this->uids[$u2]]['mpNow'].'" WHERE `id` = "'.$u2.'" LIMIT 1');
						//
						if( $this->stats[$this->uids[$u2]]['s7'] > 24 ) {
							//Даем призрачку 
							mysql_query("INSERT INTO `eff_users` 
							(`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
							(22, '".$u2."', 'Призрачная защита', '', 0, 77, 0, '".$u2."', 0, 'priem', 141, 'spirit_block25.gif', 1, 1, '0', 0, 0, '', 0, 0, 0, 0, 0);");
						}
						if( $this->stats[$this->uids[$u2]]['s7'] > 99 ) {
							//Смерть очищает вас от негативных эффектов заклинаний, проклятий, болезней и ядов в текущем бою
							
						}
						$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u2]]['login'].'</b> убит...<b>'.$this->stats[$this->uids[$u2]]['login'].'</b> был спасен. ';
						$this->add_log($mas);
						//
					}else{
						mysql_query('UPDATE `stats` SET `hpNow` = "0",`mpNow` = "0" WHERE `id` = "'.$u2.'" LIMIT 1');
						$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u2]]['login'].'</b> погиб.';
						$this->add_log($mas);
					}					
				}

			//Записываем рейтинг
            if( $this->info['type'] != 564 && $this->stats[$this->uids[$u1]]['inTurnir'] == 0 && $this->stats[$this->uids[$u2]]['inTurnir'] == 0
			&& $this->info['dn_id'] == 0 && $this->info['izlom'] == 0 )
			{
                if( $this->users[$this->uids[$u2]]['bot'] == 0 )
				{
                    mysql_query('INSERT INTO `users_reting` (`uid`,`time`,`val`,`align`,`clan`) VALUES (
						"'.$u1.'","'.time().'","'.$rtng1.'","'.$this->users[$this->uids[$u1]]['align'].'","'.$this->users[$this->uids[$u1]]['clan'].'")');
                }
                unset($rtng);

				if( $this->users[$this->uids[$u1]]['bot'] == 0 )
				{
                    mysql_query('INSERT INTO `users_reting` (`uid`,`time`,`val`,`align`,`clan`) VALUES (
						"'.$u2.'","'.time().'","'.$rtng2.'","'.$this->users[$this->uids[$u2]]['align'].'","'.$this->users[$this->uids[$u2]]['clan'].'")');
                }
            }
            unset($rtng1,$rtng2);
        }

        return true;
    }

    //Добавляем в лог действия приема
    public function priemAddLog($id,$a,$b,$u1,$u2,$prm,$text,$hodID,$tm1 = 0, $tm2 = 0)
	{
		//pr('addlog:'.$prm);
        $text = str_replace(array('-0','+0'), '--', $text);
		if( $tm1 == 0 )
		{
            if(isset($this->atacks[$id]))
			{
                $tm1 = $this->atacks[$id]['time'];
            }else{
                $tm1 = time();
            }
        }
        if( $tm2 == 0 )
		{
            if(isset($this->atacks[$id]))
			{
                $tm2 = $this->atacks[$id]['time2'];
            }else{
                $tm2 = time();
            }
        }
		//at1=00000||at2=00000||
        $vLog = 'prm='.$prm.'||zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$this->stats[$this->uids[$u2]]['zonb'].'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$b].'||time1='.$tm1.'||time2='.$tm2.'||s'.$a.'='.$this->users[$this->uids[$u1]]['sex'].'||s'.$b.'='.$this->users[$this->uids[$u2]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';
        $mas = array(
            'text' => $text,
            'time' => time(),
            'vars' => '',
            'battle' => $this->info['id'],
            'id_hod' => $hodID,
            'vars' => $vLog,
            'type' => 1
        );
		//pr($prm);
        $this->add_log($mas);
    }

    //Добавляем в лог действия приема (без атаки)
    public function priemAddLogFast($u1,$u2,$prm,$text,$hodID,$tm)
	{
        $vLog = 'prm='.$prm.'||time1='.$tm.'||time2='.$tm.'||s1='.$this->users[$this->uids[$u1]]['sex'].'||s2='.$this->users[$this->uids[$u2]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';
		$text = str_replace(array('-0','+0'), '--', $text);
		$mas = array(
            'text' => $text,
            'time' => time(),
            'vars' => '',
            'battle' => $this->info['id'],
            'id_hod' => ($this->hodID + $hodID),
            'vars' => $vLog,
            'type' => 1
        );
        $this->add_log($mas);
    }

    //Считаем контру
    public function contrRestart($id,$at,$v,$rjd = 0)
	{
		//уворот
		//pr('contr1');
        $at = $this->mf1Razmen($id,$at,$v);
        //pr('contr2');
		//крит
        $at = $this->mf2Razmen($id,$at,$v);
		//парирование
        $at = $this->mf3Razmen($id,$at,$v);
		//блок щитом (если есть щит, конечно)
        $at = $this->mf4Razmen($id,$at,$v);
        //Проверяем урон
        $at = $this->yronRazmen($id,$at,true);

        return $at;
    }

    //Расчитываем статы для конкретной зоны атаки
    public function yronGetrazmenStats( $s , $z )
	{
        global $u;
        /*
			1     - шлем
			2     - наручи
			3     - оружие (правая рука)
			4     - рубаха
			5     - броня
			6     - плащ
			7     - пояс
			8     - серьги
			9     - амулет
			10-12 - кольца
			13    - перчатки
			14    - оружие / щит (левая рука)
			16    - поножи
			17    - ботинки
			*/
        $zi = array( //Предметы влияющие на зоны
            1 => array( 1 , 8 , 9 , 52 ), //голова
            2 => array( 4 , 5 , 6 ), //грудь
            3 => array( 2 , 4 , 5 , 6 , 13 ), //живот
            4 => array( 7 , 16 , 10 , 11 , 12 ), //пояс
            5 => array( 17 )  //ноги
        );
        //
        $zi = $zi[$z];
        $i = 0;
        //
        while( $i < count($zi) ) {
            //
            $t = $u->items['add'];
            $ii = 0;
            //
            while( $ii < count($s['items']) ) {
                if( isset($s['items'][$ii]) && $s['items'][$ii]['inOdet'] == $zi[$i] ) {
                    $po = $u->lookStats($s['items'][$ii]['data']);
                    //
                    $x = 0;
                    while( $x < count($t) ) {
                        $n = $t[$x];
                        if(isset($po['sv_'.$n])) {
                            $s[$n] += $po['sv_'.$n];
                            if( $n == 'za' ) {
                                $iii = 1;
                                while($iii <= 4) {
                                    $s['za'.$iii] += $po['sv_'.$n];
                                    $iii++;
                                }
                            }elseif( $n == 'zm' ) {
                                $iii = 1;
                                while($iii <= 4) {
                                    $s['zm'.$iii] += $po['sv_'.$n];
                                    $iii++;
                                }
                            }elseif( $n == 'zma' ) {
                                $iii = 1;
                                while($iii <= 7) {
                                    $s['zma'.$iii] += $po['sv_'.$n];
                                    $iii++;
                                }
                            }
                        }
                        $x++;
                    }
                    //
                }
                $ii++;
            }
            //
            $i++;
        }
        //
        return $s;
    }

    //Расчитываем ед. урона
    public function yronGetrazmen( $uid1,$uid2,$wp,$zona,$yhod )
	{
        global $u;
        $ditest = array();
        //$oldst1 = $this->stats[$this->uids[$uid1]];
        //$oldst2 = $this->stats[$this->uids[$uid2]];
        //Получаем статы игрока 1 и 2 для конкретной зоны
        //$this->stats[$this->uids[$uid1]] = $this->yronGetrazmenStats( $this->stats[$this->uids[$uid1]] , $zona );
        //$this->stats[$this->uids[$uid2]] = $this->yronGetrazmenStats( $this->stats[$this->uids[$uid2]] , $zona );
        //$this->a_save_stats($uid1);
        //$this->a_save_stats($uid2);
        //
        //$this->a_testing_stats($uid1,$zona);
        //$this->a_testing_stats($uid2,$zona);
        //
        //if( $yhod == 1 )
		//{
            //$uid1_rl = $uid1;
            //$uid2_rl = $uid2;
            //
            //$uid2 = $uid1_rl;
            //pr ('['.$uid1.'->'.$uid2.' ('.$uid2_rl.')]');
        //}

        $r = array(
            'y' => 0,
            'r' => '--+--'
        );
        //Определяем тип урона
        /*
            Колющий
            Рубящий
            Режущий
            Дробящий
        */
        $witm = 0;
        $witm_type = 0;


        if( $wp > 0 ) {
            $witm = $this->stats[$this->uids[$uid1]]['items'][$this->stats[$this->uids[$uid1]]['wp' . $wp . 'id']];
            $witm_data = $u->lookStats($witm['data']);
            $witm_type = $this->weaponTx($witm);
            //$r['wt'] = $witm['type'];
        }
        if( $witm_type == 0 || $witm_type == 12 ) {
            $witm_type2 = '';
        }else{
            $witm_type2 = $witm_type;
        }
        $r['t'] = $witm_type2;
        //Расчет брони
        /*
            голова
            грудь
            живот
            пояс
            ноги
        */
		//print 't:'.$this->stats[$this->uids[$uid2]]['100proboi1'];
        //if($uid1==1) pr('t:'.$this->stats[$this->uids[$uid1]]['100proboi']);

		//Игнорирование брони для приемов
        //$bron_ignore = false;
		//pr($this->stats[$this->uids[$uid1]]['nozmproc']);
		if(isset($this->stats[$this->uids[$uid1]]['100proboi1']) && $this->stats[$this->uids[$uid1]]['100proboi1']==1)
		{
            $bron = array(
			    1 => array( 0 , 0 ),
                2 => array( 0 , 0 ),
                3 => array( 0 , 0 ),
                4 => array( 0 , 0 ),
                5 => array( 0 , 0 )
            );

			//$bron_ignore = true;
		} else {
			        $bron = array(
			            1 => array( $this->stats[$this->uids[$uid2]]['mib1'] , $this->stats[$this->uids[$uid2]]['mab1'] ),
			            2 => array( $this->stats[$this->uids[$uid2]]['mib2'] , $this->stats[$this->uids[$uid2]]['mab2'] ),
			            3 => array( $this->stats[$this->uids[$uid2]]['mib2'] , $this->stats[$this->uids[$uid2]]['mab2'] ),
			            4 => array( $this->stats[$this->uids[$uid2]]['mib3'] , $this->stats[$this->uids[$uid2]]['mab3'] ),
			            5 => array( $this->stats[$this->uids[$uid2]]['mib4'] , $this->stats[$this->uids[$uid2]]['mab4'] )
			        );
		}
        //pr ('['.$uid1.'->'.$uid2.']');
		//dvar($this->stats[$this->uids[$uid1]]);
        //
        //Увеличиваем параметры от текущего оружия которым бьем
        //$witm_data
        $iii = 1;
        while($iii <= 7) {
            if(isset($witm_data['sv_a'.$iii]) && $witm_data['sv_a'.$iii] != 0) {
                $this->stats[$this->uids[$uid1]]['a'.$iii] += $witm_data['sv_a'.$iii];
            }
            if(isset($witm_data['sv_mg'.$iii]) && $witm_data['sv_mg'.$iii] != 0) {
                $this->stats[$this->uids[$uid1]]['mg'.$iii] += $witm_data['sv_mg'.$iii];
            }
            $iii++;
        }
        $iii = 1;
        while($iii <= 4) {
            if(isset($witm_data['sv_aall']) && $witm_data['sv_aall'] != 0) {
                $this->stats[$this->uids[$uid1]]['a'.$iii] += $witm_data['sv_aall'];
            }
            $iii++;
        }
        $iii = 1;
        while($iii <= 4) {
            if(isset($witm_data['sv_mall']) && $witm_data['sv_mall'] != 0) {
                $this->stats[$this->uids[$uid1]]['mg'.$iii] += $witm_data['sv_mall'];
            }
            $iii++;
        }
        $iii = 1;
        while($iii <= 7) {
            if(isset($witm_data['sv_m2all']) && $witm_data['sv_m2all'] != 0) {
                $this->stats[$this->uids[$uid1]]['mg'.$iii] += $witm_data['sv_m2all'];
            }
            $iii++;
        }

        if(isset($witm_data['sv_m3']) && $witm_data['sv_m3'] != 0) {
            $this->stats[$this->uids[$uid1]]['m3'] += $witm_data['sv_m3'];
        }

        $iii = 1;
        while($iii <= 7) {
            if(isset($witm_data['sv_pa'.$iii]) && $witm_data['sv_pa'.$iii] != 0) {
                $this->stats[$this->uids[$uid1]]['pa'.$iii] += $witm_data['sv_pa'.$iii]+$witm_data['sv_m10'];
            }
            if(isset($witm_data['sv_pm'.$iii]) && $witm_data['sv_pm'.$iii] != 0) {
                $this->stats[$this->uids[$uid1]]['pm'.$iii] += $witm_data['sv_pm'.$iii]+$witm_data['sv_m11a'];
                if( $iii < 5 ) {
                    $this->stats[$this->uids[$uid1]]['pm'.$iii] += $witm_data['sv_m11'];
                }
            }
            $iii++;
        }
        //
        //мощность + подавление мощности противником
        $wAp = 0;
        $w3p  = 0;
        $w14p = 0;
        if($witm_type==12) {
            //удар кулаком
            $wAp += $this->stats[$this->uids[$uid1]]['m10'];
            if($this->users[$this->uids[$uid1]]['align']==7) {
                $wAp += 15;
            }
        }elseif($witm_type < 5) {
            $wAp += $this->stats[$this->uids[$uid1]]['pa'.$witm_type.''] + $this->stats[$this->uids[$uid1]]['m10'] + $witm_data['sv_pa'.$witm_type.''];
            $wAp -= $this->stats[$this->uids[$uid2]]['antpa'.$witm_type.''];
        }else{
            $wAp += $this->stats[$this->uids[$uid1]]['pm'.($witm_type-4).''] + $this->stats[$this->uids[$uid1]]['m11a'] + $witm_data['sv_pm'.($witm_type-4).''];
            $wAp -= $this->stats[$this->uids[$uid2]]['antpm'.($witm_type-4).''];
        }
        //

        //
        //Владение данным оружием
        $vladenie = 0;

        //Пробой брони
        $proboi = 0;
        if( $this->mfs(4, $witm_data['sv_m9']) == 1 )
		{
            $proboi = $witm_data['sv_m9'];
            $r['pb'] = 1;
        }

		if( $this->mfs(4, $this->stats[$this->uids[$uid1]]['m9']) == 1 )
		{
            $proboi = $this->stats[$this->uids[$uid1]]['m9'];
            $r['pb'] = 1;
        }

  		$za_now = ($this->stats[$this->uids[$uid2]]['za'.$witm_type2]>1000 ? 1000 : $this->stats[$this->uids[$uid2]]['za'.$witm_type2]);
        $zm_now = ($this->stats[$this->uids[$uid2]]['zm'.($witm_type2-4)]>1800 ? 1800 : $this->stats[$this->uids[$uid2]]['zm'.($witm_type2-4)]);
        //$za_now = $this->stats[$this->uids[$uid2]]['za' . $witm_type2];
		//pr('zm:'.$zm_now);
		//pr('ttt:'.$uid1.' : '.$uid2);

        $y = $this->yrn(
            $this->stats[$this->uids[$uid1]],
            $this->stats[$this->uids[$uid2]],
            $this->users[$this->uids[$uid1]],
            $this->users[$this->uids[$uid2]],
            $this->users[$this->uids[$uid1]]['level'],
            $this->users[$this->uids[$uid2]]['level'],
            $witm_type,
            $this->stats[$this->uids[$uid1]]['minAtack'], //мин. урон (добавочный)
            $this->stats[$this->uids[$uid1]]['maxAtack'], //макс. урон
            $bron[$zona][0], //броня мин.
            $bron[$zona][1], //броня макс
            $vladenie, //владения
            (($wAp + $w3p + $w14p)*0.70), //мощность урона
            ($this->stats[$this->uids[$uid1]]['m3']), //мощность крита
            (($za_now) - $this->stats[$this->uids[$uid1]]['pza'] + $this->yronLvl($this->users[$this->uids[$uid1]]['level'],$this->users[$this->uids[$uid2]]['level'])), //защита от урона
            $this->stats[$this->uids[$uid1]]['ozash'], //подавление защиты
            $proboi, //пробой брони
            0, //хз
            ($witm_data['sv_yron_min']+$this->stats[$this->uids[$uid1]]['yron_min']),
            ($witm_data['sv_yron_max']+$this->stats[$this->uids[$uid1]]['yron_max']),
            $this->stats[$this->uids[$uid2]]['zaproc'],
            $this->stats[$this->uids[$uid2]]['zmproc'],
            (($zm_now) - $this->stats[$this->uids[$uid1]]['pzm'] + $this->yronLvl($this->users[$this->uids[$uid1]]['level'],$this->users[$this->uids[$uid2]]['level'])), //защита от урона
            $this->stats[$this->uids[$uid1]]['omzash'] //подавление защиты
        );
		//pr($this->stats[$this->uids[$uid2]]['zmproc']);

        $r['y'] = round(rand($y['min'],$y['max']));
        $r['k'] = round(rand($y['Kmin'],$y['Kmax']));

        $r['m_y'] = $y['max'];
        $r['m_k'] = $y['Kmax'];

        $r['bRND'] = $y['bRND'];

        $r['w_type'] = $witm_type;

        //Если второе оружие - урон ниже на 50%
        $wp1 = $this->stats[$this->uids[$uid1]]['items'][$this->stats[$this->uids[$uid1]]['wp3id']];
        $wp2 = $this->stats[$this->uids[$uid1]]['items'][$this->stats[$this->uids[$uid1]]['wp14id']];
        /*if( $wp == 14 ) {
            if( $wp1['level'] > $wp2['level'] ) {
                $r['y'] = floor( $r['y'] * 0.5 );
                $r['k'] = floor( $r['k'] * 0.5 );
            }
        }elseif( $wp == 3 ) {
            if( $wp2['level'] > $wp1['level'] ) {
                $r['y'] = floor( $r['y'] * 0.5 );
                $r['k'] = floor( $r['k'] * 0.5 );
            }
        }*/

        if( $r['y'] < 1 ) {
            $r['y'] = 1;
        }
        if( $r['k'] < 1 ) {
            $r['k'] = 1;
        }
        //$this->a_restart_stats($uid1,1);
        //$this->a_testing_stats($uid2,1);
        

        return $r;
    }

    //Считаем урон
    public function yronRazmen($id,$at,$pat = false)
	{
        if( $pat == true ) {
            $pat = $at;
            $at = $pat['p'];
        }else{
            unset($pat);
        }

        $uid1 = $this->atacks[$id]['uid1'];
        $uid2 = $this->atacks[$id]['uid2'];
        $uid2s = $uid2;

        $i = 1;
        while( $i <= 2 )
		{
            if( $i == 1 )
			{
                $a = 1;
                $b = 2;
                $u1 = ${'uid1'};
                $u2 = ${'uid2'};
            }else{
                $a = 2;
                $b = 1;
                $u1 = ${'uid2'};
                $u2 = ${'uid1'};
            }

			
        	if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )
			{
                //if($this->stats[$this->uids[$u2]]['no_mf']==1) $no_mf = 1;//Коварный уход
				$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
                $yhod = array( 1 => 0 , 2 => 1 );
        	}

            //Считаем свойства от предметов
            //Расчет удара (u2) по (u1)
            $j = 0; $k = 0; $wp = 3; $zach = 0;
            while($j < count($at[$a]['atack']) && $j < 8)
			{
				//if($j > 0 && $no_mf==1) {$u2 = $uid2s;$no_mf = 0;}//Коварный уход
				// КУДА БИЛ , ТИП УДАРА
                if( $k == 0 && isset($this->stats[$this->uids[$u1]]['wp3id']) ) {
                    //Левая рука
                    $wp = 3;
                    $k = 1;
                }else{
                    //Правая рука
                    if( isset($this->stats[$this->uids[$u1]]['wp14id']) && $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp14id']]['type'] != 13 ) {

                        $wp = 14;
                    }else{
                        if( isset($this->stats[$this->uids[$u1]]['wp3id']) ) {
                            $wp = 3;
                        }else{
                            //нет оружия
                            $wp = 3;
                        }
                    }
                    $k = 0;
                }
                if( $wp > 0 ) {
                    $witm = $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp' . $wp . 'id']];
                    $witm_type = $this->weaponTx($witm);
                    $at[$a]['atack'][$j]['wt'] = $witm['type'];
                }
                //
                $at[$a]['atack'][$j]['yhod'] = $yhod[$a];
                //
                if( !isset($at[$a]['atack'][$j]['yron']) && (
                        $at[$a]['atack'][$j][1] == 1 ||
                        $at[$a]['atack'][$j][1] == 4 ||
                        $at[$a]['atack'][$j][1] == 5  )
                ) {
                    //
                    $at[$a]['atack'][$j]['yron'] = $this->yronGetrazmen($u1,$u2,$wp,$at[$a]['atack'][$j][0],$yhod[$b]);
                    if( $at[$a]['atack'][$j][1] == 4 ) {
                        $at[$a]['atack'][$j]['yron']['y_old'] = $at[$a]['atack'][$j]['yron']['y'];
                        $at[$a]['atack'][$j]['yron']['y'] = round($at[$a]['atack'][$j]['yron']['k']/2);
                    }elseif( $at[$a]['atack'][$j][1] == 5 ) {
                        $at[$a]['atack'][$j]['yron']['y_old'] = $at[$a]['atack'][$j]['yron']['y'];
                        $at[$a]['atack'][$j]['yron']['y'] = $at[$a]['atack'][$j]['yron']['k'];
                    }
                    $at[$a]['atack'][$j]['yron']['2h'] = $witm['2h'];
                    $at[$a]['atack'][$j]['yron']['w'] = $wp;
                    if( $at[$a]['atack'][$j]['yron']['y'] < 1 ) {
                        $at[$a]['atack'][$j]['yron']['r'] = '--';
                    }else{
                        $at[$a]['atack'][$j]['yron']['r'] = '-' . $at[$a]['atack'][$j]['yron']['y'];
                    }
                    //
                }else{
                    //
                    $at[$a]['atack'][$j]['block'] = $this->yronGetrazmen($u1,$u2,$wp,$at[$a]['atack'][$j][0],$yhod[$b]);
                    if( $at[$a]['atack'][$j][1] == 4) {
                        $at[$a]['atack'][$j]['block']['y_old'] = $at[$a]['atack'][$j]['block']['y'];
                        $at[$a]['atack'][$j]['block']['y'] = round($at[$a]['atack'][$j]['block']['k']/2);
                    }elseif( $at[$a]['atack'][$j][1] == 5 ) {
                        $at[$a]['atack'][$j]['block']['y_old'] = $at[$a]['atack'][$j]['block']['y'];
                        $at[$a]['atack'][$j]['block']['y'] = $at[$a]['atack'][$j]['block']['k'];
                    }
                    $at[$a]['atack'][$j]['block']['2h'] = $witm['2h'];
                    $at[$a]['atack'][$j]['block']['w'] = $wp;
                    if( $at[$a]['atack'][$j]['block']['y'] < 1 ) {
                        $at[$a]['atack'][$j]['block']['r'] = '--';
                    }else{
                        $at[$a]['atack'][$j]['block']['r'] = '-' . $at[$a]['atack'][$j]['block']['y'];
                    }
                    //
                }
                
				if(isset($p_pb['id']) && isset($at[$a]['atack'][$j]['yron'])) $unset_pza = true;//При приемах пробоя удаляем pza не сразу, а на следующую руку, иначе не все приемы видят pza
                //===========================Точный удар================================//

				$j++;
            }

			unset($unset_pza);
            $i++;
        }

        if( isset($pat) && $pat != false )
		{
            $pat['p'] = $at;
            $at = $pat;
        }
        //$uid2 = $uid2s;

        return $at;
    }


    	//Обновление здоровья
		public function updateHealth($id,$at)
		{
			global $priem;

			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			$uid2s = $uid2;

			//Проба - актуальные hp и mp
			/*$stats_now = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE  `id` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1'));
			$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $stats_now['hpNow'];
            $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $stats_now['mpNow'];
            $stats_now = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE  `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1'));
			$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $stats_now['hpNow'];
            $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $stats_now['mpNow'];*/
            //Проба - актуальные hp и mp
			
			$i = 1;
			while( $i <= 2 )
			{
				if( $i == 1 )
				{
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}

				if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )//$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']
				{
					//if($this->stats[$this->uids[$u2]]['no_mf']==1) $no_mf = 1;//Коварный уход
					$u2 = $this->yhod_user($id,$u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
                    
					//$u2 = $this->yhod_user($id,$this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
				}
						
				//Рассчет дополнительных тактик
				if( $this->users[$this->uids[$u2]]['animal2'] > 0 )
				{
							
				}
				elseif( $this->atacks[$id]['out'.$b] > 0 )
				{
					//Игрок ${'u'.$a} получает тактики, возможно
					if( rand(0,100) < min(floor($this->stats[$this->uids[$u1]]['m6']/5),20) )
					{
						//выдаем тактику контрудара
						$this->users[$this->uids[$u1]]['tactic3']++;
					}
					if( rand(0,100) < min(floor($this->stats[$this->uids[$u1]]['m8']/4),20) )
					{
						//выдаем тактику щита
						$this->users[$this->uids[$u1]]['tactic4']++;
					}
				}
								
				//Расчет удара Цели (u2) по Атакующему (u1)
				//dvar( $at[$i] );
				//pr('t:'.$this->stats[$this->uids[$u1]]['notactic5']);

				$j = 0; $k = 0; $wp = 3;
				while($j < count($at[$a]['atack']) && $j < 8 )
				{
					/*if($no_mf == 1 && $j>0)//Коварный уход
					{
						$u2 = $uid2s;
						$no_mf = 0;
					}*/
					//Добавляем тактики
					//$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['tactic1']
					if( $at[$a]['atack'][$j][1] == 1 )
					{
						//u1 ударил обычным ударом u2
						if( $this->users[$this->uids[$u2]]['animal2'] > 0 )
						{
														
						}
						elseif((!isset($this->stats[$this->uids[$u1]]['notactic']) || $this->stats[$this->uids[$u1]]['notactic'] == 0)
						&& (!isset($this->stats[$this->uids[$u1]]['notactic1']) || $this->stats[$this->uids[$u1]]['notactic1'] == 0))
						{
							$this->users[$this->uids[$u1]]['tactic1']++;
							//Двуручка
							if( $at[$a]['atack'][$j]['yron']['2h'] == 1 )
							{
								$this->users[$this->uids[$u1]]['tactic1'] += 2;
							}
						}
					}elseif( $at[$a]['atack'][$j][1] == 2 ) {
						//u2 увернулся от u1
					}elseif( $at[$a]['atack'][$j][1] == 3 ) {
						//u2 заблокировал удар u1
						if( $this->users[$this->uids[$u1]]['animal2'] > 0 ) {
							
						}elseif( (!isset($this->stats[$this->uids[$u2]]['notactic']) || $this->stats[$this->uids[$u2]]['notactic'] == 0)
						&& (!isset($this->stats[$this->uids[$u2]]['notactic4']) || $this->stats[$this->uids[$u2]]['notactic4'] == 0) ) {
							$this->users[$this->uids[$u2]]['tactic4']++;
						}
					}elseif( $at[$a]['atack'][$j][1] == 4 ) {
						//u1 пробил блок u2 критом
						if( $this->users[$this->uids[$u2]]['animal2'] > 0 ) {
							
						}elseif( (!isset($this->stats[$this->uids[$u1]]['notactic']) || $this->stats[$this->uids[$u1]]['notactic'] == 0)
						&& (!isset($this->stats[$this->uids[$u1]]['notactic2']) || $this->stats[$this->uids[$u1]]['notactic2'] == 0) ) {
							$this->users[$this->uids[$u1]]['tactic2']++;
						}
					}elseif( $at[$a]['atack'][$j][1] == 5 ) {
						//u1 ударил критическим ударом u2
						if( $this->users[$this->uids[$u2]]['animal2'] > 0 ) {
							
						}elseif( (!isset($this->stats[$this->uids[$u1]]['notactic']) || $this->stats[$this->uids[$u1]]['notactic'] == 0)
						&& (!isset($this->stats[$this->uids[$u1]]['notactic2']) || $this->stats[$this->uids[$u1]]['notactic2'] == 0) ) {
							$this->users[$this->uids[$u1]]['tactic2'] += 2;
							//Двуручка
							if( $at[$a]['atack'][$j]['yron']['2h'] == 1 ) {
								$this->users[$this->uids[$u1]]['tactic2'] += 1;
							}
						}
					}elseif( $at[$a]['atack'][$j][1] == 6 || $at[$a]['atack'][$j][1] == 34 ) {
						//u2 парировал удар u1
						if( $this->users[$this->uids[$u1]]['animal2'] > 0 ) {
							
						}elseif( (!isset($this->stats[$this->uids[$u2]]['notactic']) || $this->stats[$this->uids[$u2]]['notactic'] == 0)
						&& (!isset($this->stats[$this->uids[$u2]]['notactic5']) || $this->stats[$this->uids[$u2]]['notactic5'] == 0) ) {
							$this->users[$this->uids[$u2]]['tactic5']++;
						}
					}elseif( $at[$a]['atack'][$j][1] == 7 ) {
						//u2 блокировал щитом удар u1						
					}elseif( $at[$a]['atack'][$j][1] == 8 ) {
						//u2 увернулся от удара u1 и нанес по нему контрудар
						if( $this->users[$this->uids[$u1]]['animal2'] > 0 ) {
							
						}elseif( (!isset($this->stats[$this->uids[$u2]]['notactic']) || $this->stats[$this->uids[$u2]]['notactic'] == 0)
						&& (!isset($this->stats[$this->uids[$u2]]['notactic3']) || $this->stats[$this->uids[$u2]]['notactic3'] == 0) ) {
							$this->users[$this->uids[$u2]]['tactic3']++;
						}
					}
					// КУДА БИЛ , ТИП УДАРА
					if( isset($at[$a]['atack'][$j]['yron']) && (
					$at[$a]['atack'][$j][1] == 1 ||
					$at[$a]['atack'][$j][1] == 4 ||
					$at[$a]['atack'][$j][1] == 5 ||
					$at[$a]['atack'][$j][1] == 34 )) {
						//
						if( $at[$a]['atack'][$j]['yron']['y'] < 0 )
						{
							$at[$a]['atack'][$j]['yron']['y'] = 1;
							$at[$a]['atack'][$j]['yron']['r'] = -1;
							$at[$a]['atack'][$j]['yron']['k'] = 1;
						}
						//Отнимаем НР
						$this->stats[$this->uids[$u2]]['hpNow'] -= $at[$a]['atack'][$j]['yron']['y'];
						$this->users[$this->uids[$u2]]['last_hp'] = -$at[$a]['atack'][$j]['yron']['y'];
						//Добавляем нанесенный урон и опыт
						//$this->users[$this->uids[$u1]]['battle_yron'] += $at[$a]['atack'][$j]['yron']['y'];
						$this->takeExp( $u1, $at[$a]['atack'][$j]['yron']['y'], $u1, $u2) ;
						
						//echo '['.$u1.' -> '.$u2.']';
						$at[$a]['atack'][$j]['yron']['hp'] = $this->stats[$this->uids[$u2]]['hpNow'];
						if( $at[$a]['atack'][$j]['yron']['hp'] < 1 ) {
							$at[$a]['atack'][$j]['yron']['hp'] = 0;
						}
						$at[$a]['atack'][$j]['yron']['hpAll'] = $this->stats[$this->uids[$u2]]['hpAll'];
						if( $at[$a]['atack'][$j]['yron']['hp'] > $at[$a]['atack'][$j]['yron']['hpAll'] ) {
							$at[$a]['atack'][$j]['yron']['hp'] = $at[$a]['atack'][$j]['yron']['hpAll'];
						}
						//
						//Травмирование
						if( $at[$a]['atack'][$j][1] == 4 || $at[$a]['atack'][$j][1] == 5 || $at[$a]['atack'][$j][1] == 34 ) {
							if( !isset($at[$a]['atack'][$j]['yron']['travma']) && rand(0,1000) < 500 ) {
								$trvm_chns = floor(rand(0,200)/10);
								if( $trvm_chns > 3 || $trvm_chns < 1 ) {
									$trvm_chns = 0;
								}
								$at[$a]['atack'][$j]['yron']['travma'] = array( $trvm_chns , 'Обыкновенная травма' );
								unset($trvm_chns);
							}
						}
					}
					$j++;
				}
					
				$i++;
                //$uid2 = $uid2s;
			}
			
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				$priem->testDie($uid1);
			}
			if( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$priem->testDie($uid2);
			}
			
			return $at;
		}
		
		//Добавляем новую статистику игрока
		public function addstatuser($id)
		{
			if( $id > 0 ) {
				$uid = $id;
				$id = $this->uids[$uid];
				mysql_query('INSERT INTO `battle_users`
					( `price1`,`price2`,`battle`,`uid`,`time_enter`,`login`,`level`,`align`,`clan`,`hpAll`,`hp`,`hpStart`,`team` )
				VALUES
				(
					"'.$this->stats[$id]['prckr'].'",
					"'.$this->stats[$id]['prcekr'].'",
					"'.$this->info['id'].'",
					"'.$uid.'",
					"'.time().'",
					"'.$this->users[$id]['login'].'",
					"'.$this->users[$id]['level'].'",
					"'.$this->users[$id]['align'].'",
					"'.$this->users[$id]['clan'].'",
					"'.$this->stats[$id]['hpAll'].'",
					"'.$this->stats[$id]['hp'].'",
					"'.$this->stats[$id]['hpNow'].'",
					"'.$this->users[$id]['team'].'"
				)');
			}
		}
		
		//Проверяем приемы
		public function priemsRazmen($id, $at)
		{
			if( $at == 'fast' )
			{
				$uid1 = $id[0];
				$uid2 = $id[1];
			}else{
				$uid1 = $this->atacks[$id]['uid1'];
				$uid2 = $this->atacks[$id]['uid2'];
			}
			$i = 1;
			while( $i <= 2 )
			{
				if( $i == 1 )
				{
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				//Получаем приемы и смотрим когда какой действует
				$eff = $this->stats[$this->uids[$u1]]['effects'];
				//pr($u1);
				//pr($eff);
				$this->stats[$this->uids[$u1]]['u_priem'] = array();
				$j = 0;				
				while( $j <= count($eff) )
				{
					if( isset($eff[$j]) && is_array($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0 )
					{
						$this->stats[$this->uids[$u1]]['u_priem'][] = array( $j , $eff[$j]['v2'] , $this->prm[$eff[$j]['v2']]['act'] , $eff[$j]['id'] , $this->prm[$eff[$j]['v2']]['type_of'] , $this->prm[$eff[$j]['v2']]['moment'] , $this->prm[$eff[$j]['v2']]['moment_end'] , $this->prm[$eff[$j]['v2']]['type_sec'] );
						$this->stats[$this->uids[$u1]]['u_priemUse'][$eff[$j]['v2']]++;
					}
					$j++;
				}
				$i++;
			}
			//
		}
		
		//Приемы которые используются моментально - pr_moment
		public function priemsRazmenMoment( $id, $at )
		{
			global $c;

			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			$i = 1;
			while( $i <= 2 )
			{
				
				if( $i == 1 )
				{
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}				
				if( !isset($at['p']['p_cast']) )
				{
					$at['p'] = $at;
					$at['p']['p_cast'] = true;
				}

				//Приемы ухода от удара
				if(!isset($this->stats[$this->uids[$u2]]['nopryh']) || $this->stats[$this->uids[$u2]]['nopryh'] == 0)
				{
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
					{
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0  && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 1 )
						{
							if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
								$pr_used_this = $u1;
								$pr_moment = true;
								//pr('moment-used: Приемы ухода от удара:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
								$this->stats[$this->uids[$u2]]['nopryh']--;
							}
						}
						$j++;
					}
				}
				//Приемы крита
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
				{
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 2 ) {
						if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							$pr_moment = true;
                            //pr('moment-used: Приемы крита:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Приемы атаки
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
				{
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 3 )
					{
						if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
						{
							$pr_used_this = $u1;
							$pr_moment = true;
							//pr('moment-used: Приемы атаки:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							if( isset($fx_priem) ) {
								$at = $fx_priem($id,$at,$u1,$j);
							}
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Приемы защиты
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
				{
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 4 )
					{
						if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
						{
							$pr_used_this = $u1;
							$pr_moment = true;
                            //pr('moment-used: Приемы защиты:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Прочие приемы
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 5 )
					{
						if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
						{
							$pr_used_this = $u1;
							$pr_moment = true;
                            //pr('moment-used: Прочие приемы:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//
				$i++;
			}
			//
			return $at;
		}

		//Приемы которые используются моментально (в конце хода) - $pr_moment
		public function priemsRazmenMomentEnd( $id, $at )
		{
			global $c;

			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			$i = 1;
			while( $i <= 2 )
			{
				
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}				
				if( !isset($at['p']['p_cast']) )
				{
					$at['p'] = $at;
					$at['p']['p_cast'] = true;
				}

				//Приемы ухода от удара
				if(!isset($this->stats[$this->uids[$u2]]['nopryh']) || $this->stats[$this->uids[$u2]]['nopryh'] == 0)
				{
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
					{
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0  && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 1 )
						{
							if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
							{
								$pr_used_this = $u1;
								$pr_moment = true;
                                pr('ttt');
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
								$this->stats[$this->uids[$u2]]['nopryh']--;
							}
						}
						$j++;
					}
				}
				//Приемы крита
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
				{
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 2 )
					{
						if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
						{
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Приемы атаки
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
				{
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 3 )
					{
						if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
						{
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							if(isset($fx_priem)) {
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
							}
						}
					}
					$j++;
				}
				//Приемы защиты
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
				{
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 4 )
					{
						if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
						{
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Прочие приемы
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
				{
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 5 )
					{
						if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
						{
							$pr_used_this = $u1;
							$pr_moment = true;
                            //pr('used: Приемы ухода от удара:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//
				$i++;
			}
			//
			return $at;
		}

		//Используем приемы $pr_used_this
		public function priemsTestRazmen( $id, $at )
		{
			global $no_pr, $c;

            $yhod_priems = array(213,273,286,287,288);

			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
            $uid2b = $uid2;

			//if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 )
			//{
				//$this->atacks[$id]['uid1'] = $this->yhod_user($id, $this->atacks[$id]['uid2'], $this->atacks[$id]['uid1'], $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
				//$uid1 = $this->atacks[$id]['uid1'];
			//}

			$i = 1;
			while( $i <= 2 )
			{
				if( $i == 1 )
				{
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}

                //pr($this->stats[$this->uids[$u2]]['yhod']);
				if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )//$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']
				{
					$this->atacks[$id]['uid2'] = $this->yhod_user($id, $this->atacks[$id]['uid1'], $this->atacks[$id]['uid2'], $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
					$u2 = $this->atacks[$id]['uid2'];
				}
				
				if( !isset($at['p']['p_cast']) )
				{
					$at['p'] = $at;
					$at['p']['p_cast'] = true;
				}

                //dvar($this->stats[$this->uids[$u1]]['u_priem']);//dg
                //dvar($this->stats[$this->uids[$u2]]['u_priem']);//dg
                //pr($i.': '.$u1.' = '.$u2.' :: '.$this->stats[$this->uids[$u2]]['yhod']);

				if($no_pr[$i]==false)//Обреченность
				{
					//Приемы ухода от удара
					if(!isset($this->stats[$this->uids[$u2]]['nopryh']) || $this->stats[$this->uids[$u2]]['nopryh'] == 0)
					{
						$j = 0;
						while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
						{
							if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0  && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 1
							&& $this->stats[$this->uids[$u1]]['yhod'] == 0)
							{
								if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
								{
									$pr_used_this = $u1;
	                                //pr('used: Приемы ухода от удара:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
									$this->stats[$this->uids[$u2]]['nopryh']--;
								}
							}
							$j++;
						}
					}

					//Приемы крита
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
					{
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 2 )
						{
							if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
							{
								$pr_used_this = $u1;
	                            //pr('used: Приемы крита:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
							}
						}
						$j++;
					}

					//Приемы атаки
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
					{
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 3 )
						{
							if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
							{
								$pr_used_this = $u1;
	                            //pr('used: Приемы атаки:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$this->atacks[$id]['uid2'], $i);
	                			//dvar($this->stats[$this->uids[$u2]]['u_priem']);//dg
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								if( isset($fx_priem) )
								{
									$at = $fx_priem($id,$at,$u1,$j);
								}
								unset(${'fx_priem'});
							}
						}
						$j++;
					}

					//Приемы защиты
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
					{
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 4
						&& ($this->stats[$this->uids[$u1]]['yhod'] == 0 || in_array($this->stats[$this->uids[$u1]]['u_priem'][$j][1], $yhod_priems)))
						{
							if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
							{
								$pr_used_this = $u1;
	                            //pr('used: Приемы защиты:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$this->atacks[$id]['uid2'], $i);
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								if( isset($fx_priem) )
								{
									$at = $fx_priem($id,$at,$u1,$j);
								}
								unset(${'fx_priem'});
							}
						}
						$j++;
					}

					//Прочие приемы
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
					{
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 5 )
						{
							if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
							{
								$pr_used_this = $u1;
	                            //pr('used: Приемы прочие:'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								if( isset($fx_priem) ) {
									$at = $fx_priem($id,$at,$u1,$j);
								}
								unset(${'fx_priem'});
							}
						}
						$j++;
					}
				}
                $i++;
                $this->atacks[$id]['uid2'] = $uid2b;
				//$uid2 = $uid2b;
			}
			
			$i = 1;
			while( $i <= 2 )
			{
				if( $i == 1 )
				{
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}

                if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )//$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']
				{
                    //if($this->stats[$this->uids[$u2]]['no_mf']==1) $no_mf = 1;//Коварный уход
					$this->atacks[$id]['uid2'] = $this->yhod_user($id, $this->atacks[$id]['uid1'], $this->atacks[$id]['uid2'], $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
					$u2 = $this->atacks[$id]['uid2'];
				}
				
				if( !isset($at['p']['p_cast']) )
				{
					$at['p'] = $at;
					$at['p']['p_cast'] = true;
				}

				if($no_pr[$i]==false)//Обреченность
				{
					//Прочие приемы
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
					{
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 8
						&& $this->stats[$this->uids[$u1]]['yhod'] == 0)
						{
							if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
							{
								$pr_used_this = $u1;
	                            //pr('used: Приемы прочие: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' u1:'.$u1.' uid2:'.$uid2, $i);
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
							}
						}
						$j++;
					}

					//Прочие приемы
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
					{
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 9
						&& $this->stats[$this->uids[$u1]]['yhod'] == 0 )
						{

							if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
							{
								$pr_used_this = $u1;
	                            //pr('used: Приемы прочие: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' uid:'.$u1, $i);
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
							}
						}
						$j++;
					}
				}

				$i++;
                $this->atacks[$id]['uid2'] = $uid2b;
				//$uid2 = $uid2b;
			}
			
			return $at;
		}
		
		//Повторная проверка приемов - $pr_tested_this
		public function priemsRestartRazmen( $id, $at )
		{
            global $no_pr, $c;
            $yhod_priems = array(213,273,286,287,288);

			if( isset($at['p']) )
			{
				$uid1 = $this->atacks[$id]['uid1'];
				$uid2 = $this->atacks[$id]['uid2'];
                $uid2b = $uid2;

				/*
					Если возникнут проблемы с приемами, придется переписать алгоритм, сейчас он выглядит так:					
						Цикл 1. Проверяем пользователя
						Цикл 2 внутри Цикла 1. Проверяем приемы которые пользователь использовал
					Придется сделать:
						Цикл 1. Проверяем пользователя
						Цикл 2 внутри Цикла 1. Проверяем приемы уворота
						Цикл 3. Проверяем пользователя
						Цикл 4 внутри Цикла 3. Проверяем приемы крита
						и т.д.
				*/

				$i = 1;
				while( $i <= 2 )
				{
					if( $i == 1 )
					{
						$a = 1;
						$b = 2;
						$u1 = ${'uid1'};
						$u2 = ${'uid2'};
					}else{
						$a = 2;
						$b = 1;
						$u1 = ${'uid2'};
						$u2 = ${'uid1'};
					}
					
					if( !isset($at['p']['p_cast']) )
					{
						$at['p'] = $at;
						$at['p']['p_cast'] = true;
					}

					if( $this->stats[$this->uids[$u2]]['yhod'] > 0 )//$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']
					{
						$this->atacks[$id]['uid2'] = $this->yhod_user($id, $this->atacks[$id]['uid1'], $this->atacks[$id]['uid2'], $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
						$uid2 = $this->atacks[$id]['uid2'];
					}

					if($no_pr[$i]==false)//Обреченность
					{
						//Приемы ухода от удара
						if(!isset($this->stats[$this->uids[$u2]]['nopryh']) || $this->stats[$this->uids[$u2]]['nopryh'] == 0)
						{
							$j = 0;
							while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
							{
								if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0  && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 1
								&& $this->stats[$this->uids[$u1]]['yhod'] == 0)
								{
									if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
									{
										$pr_tested_this = $u1;
	                                    //pr('tested: Приемы ухода от удара: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' uid:'.$u1, $i);
										require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
										$at = $fx_priem($id,$at,$u1,$j);
										unset(${'fx_priem'});
										$this->stats[$this->uids[$u2]]['nopryh']--;
									}
								}
								$j++;
							}
						}

						//Приемы крита
						$j = 0;
						while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
						{
							if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 2 )
							{
								if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
								{
									$pr_tested_this = $u1;
	                                //pr('tested: Приемы крита: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' uid:'.$u1, $i);
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								}
							}
							$j++;
						}

						//Приемы атаки
						$j = 0;
						while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
						{
							if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 3 )
							{
								if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
								{
									$pr_tested_this = $u1;
	                                //pr('tested: Приемы атаки: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' uid:'.$u1, $i);
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								}
							}
							$j++;
						}

						//Приемы защиты
						$j = 0;
						while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
						{
							if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 4
							&& ($this->stats[$this->uids[$u1]]['yhod'] == 0 || in_array($this->stats[$this->uids[$u1]]['u_priem'][$j][1], $yhod_priems)))
							{
								if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
								{
									$pr_tested_this = $u1;
	                                //pr('tested: Приемы защиты: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' uid:'.$u1, $i);
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								}
							}
							$j++;
						}

						//Прочие приемы
						$j = 0;
						while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
						{
							if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 5 )
							{
								if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
								{
									$pr_tested_this = $u1;
	                                //pr('tested: Приемы прочие: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' uid:'.$u1, $i);
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								}
							}
							$j++;
						}

						//Прочие приемы
						$j = 0;
						while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) )
						{
							if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 8 )
							{
								if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php'))
								{
									$pr_tested_this = $u2;
	                                //pr('tested: Приемы прочие: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' uid:'.$u1, $i);
									require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u2,$j);
									unset(${'fx_priem'});
								}
							}
							$j++;
						}

						//Прочие приемы
						$j = 0;
						while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) )
						{
							if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 9 )
							{
								if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php'))
								{
									$pr_tested_this = $u2;
	                                //pr('tested: Приемы прочие: '.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].' uid:'.$u1, $i);
									require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u2,$j);
									unset(${'fx_priem'});
								}
							}
							$j++;
						}
					}

					$this->atacks[$id]['uid2'] = $uid2b;
					$uid2 = $uid2b;
					$i++;
				}
                
				//
				$at = $at['p'];				
				unset($at['p']);
			}

			return $at;
		}
		
    //Проверка урона приемов
    public $um_priem  = array();
    public function testYronPriem( $uid1, $uid2, $priem, $yron, $profil, $stabil, $test = false, $inlog = 0, $no_zmproc = 0 )
	{
			global $c;
		  /*
			profil = {
				-1 - урон оружием
				-2 - урон магией
				 0 - неизвестно
				 1-4  - профильный оружия
				 5-12 - профильный магия
			}
			stabil - урон не подвержен мощностям и т.д
		*/
        //Проверка
        $a = 1;
        $b = 2;
        $u1 = ${'uid1'};
        $u2 = ${'uid2'};

		if( $this->stats[$this->uids[$u1]]['yhod'] > 0 )
		{
			$u1 = $this->yhod_user($id,$u2,$u1,$this->stats[$this->uids[$u1]]['yhod']);//иначе:  туман + испепеление -> агрессивная - дает -30 админу!
		}
        
		if( $this->stats[$this->uids[$u2]]['zmproc'] > 0 && $no_zmproc==0 )
		{
			$yron = floor($yron/50*(57.5-$this->stats[$this->uids[$u2]]['zmproc']));//$p = floor($p/100*(100/*-$s2['zmproc']*/-$s2['zm'.$t.'proc']));
			if( $yron < 1 ) {$yron = 1;}
		}
        //Проверяем приемы защиты игрока $u1 на урон игрока $u2
        //Получаем приемы и смотрим когда какой действует
        if(!isset($this->stats[$this->uids[$u2]]['u_priem']))
		{
			$eff = $this->stats[$this->uids[$u2]]['effects'];
            $j = 0;
            while( $j <= count($eff) )
			{
                if( isset($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0 )
				{
                    $this->stats[$this->uids[$u2]]['u_priem'][] = array( $j , $eff[$j]['v2'] , $this->prm[$eff[$j]['v2']]['act'] , $eff[$j]['id'] , $this->prm[$eff[$j]['v2']]['type_of'] , $this->prm[$eff[$j]['v2']]['moment'] );
                }
                $j++;
            }
            unset($eff);
        }

		//Приемы защиты
        $j = 0;
        while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) )
		{

			if( $this->stats[$this->uids[$u2]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 4 )
			{
                if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php'))
				{
                    $pr_momental_this = $u2;
                    require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
                    $yron = $fx_moment($u2,$u1,$j,$yron,$profil);
                    unset(${'fx_moment'});
                }
            }
            $j++;
        }
        //print 't4:';
		//dvar($this->stats[$this->uids[$u2]]['u_priem']);//dg
        //$ef = mysql_fetch_array(mysql_query('SELECT `id`,`uid`,`v2` FROM `eff_users` WHERE `uid` = "'.$u2.'" AND `delete` = 0'));
    	//dvar($ef);

        //Прочие приемы
        $j = 0;
        while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
		{
            if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 5 )
			{
                if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
                    $pr_momental_this = $u1;
                    require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
                    if( isset($fx_moment) ) {
                        $yron = $fx_moment($u1,$u2,$j,$yron,$profil,$inlog);
                    }
                    unset(${'fx_moment'});
                }
            }
            $j++;
        }

        //Прочие приемы (влияет на урон от моментальных приемов)
        $j = 0;
        while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) )
		{
            if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][7] == 5 )
			{
                if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php'))
				{
                    $pr_momental_this_seven = $u1;
                    require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
                    if( isset($fx_moment_seven) ) {
                        $yron = $fx_moment_seven($u1,$u2,$j,$yron,$profil,$inlog);
                    }
                    unset(${'fx_moment_seven'});
                }
            }
            $j++;
        }

        //Прочие приемы
        $j = 0;
        while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) )
		{
            if( $this->stats[$this->uids[$u2]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 8 )
			{
                if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php'))
				{
                    $pr_momental_this = $u2;
                    require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
                    if( isset($fx_moment) ) {
                        $yron = $fx_moment($u2,$u1,$j,$yron,$profil,$inlog);
                    }
                    unset(${'fx_moment'});
                }
            }

			if( $this->stats[$this->uids[$u2]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 9 )
			{
                if(file_exists($c['doc_root'].'/_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php'))
				{
                    $pr_momental_this = $u2;
                    require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
                    if( isset($fx_moment) ) {
                        $yron = $fx_moment($u2,$u1,$j,$yron,$profil,$inlog);
                    }
                    unset(${'fx_moment'});
                }
            }
            $j++;
        }

		//==================Приемы удаляют другие приемы при использовании====================================//
		$priem_mag = array(97,98,99,100,101,411,261,92,93,94,95,96,412,259,39,108,109,110,413,112,113,114,115,116,414,
		44,151,152,153,415,40,117,118,119,120,416,122,123,124,125,418,127,128,129,130,131,419,169,170,171,172,173,420,
		34,67,68,69,421,244,243,241,161,162,163,56,57,58,59,60,422,51,52,53,54,55,423,160,155,156,157,158,159,408,
		265,23,70,71,72,404,267,75,76,77,78,79,403,80,81,82,83,84,402,164,227,189,226,227);//Приемы, которые сбрасывают другие приемы

		$priem_del = array(7,45,211);//Приемы, которые нужно удалить
		//pr($this->stats[$this->uids[$u1]]['effects']);

		if(in_array($priem, $priem_mag) && is_array($this->stats[$this->uids[$u2]]['effects']))
		{
            foreach ($this->stats[$this->uids[$u2]]['effects'] as $u2_priems)
			{
		    	if(isset($u2_priems['v2']) && in_array($u2_priems['v2'], $priem_del))
				{
					mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$u2_priems['id'].'" LIMIT 1');//Удаляем прием
					
					$this->priemAddLogFast( $u1, $u2, $u2_priems['name'],
					'{tm1} Закончилось действие эффекта &quot;<b>'.$u2_priems['name'].'</b>&quot; для {u2}.', 1, time() );//Лог
				}
			}
		}
        //==================Приемы удаляют другие приемы при использовании====================================//

        return $yron;
    }

    //Опыт + набитый урон за удар приемом\магией
    public function priemYronSave($u1,$u2,$yron,$type)
	{
        //$type 0 - урон , 1 - хил

        /* $this->testUserInfoBattle($u1);
        $this->testUserInfoBattle($u2); */

        if( isset($this->uids[$u1]) )
		{

            if( $this->stats[$this->uids[$u2]]['hpAll'] <= 1000 )
			{
				$hpAlld = ($this->stats[$this->uids[$u2]]['hpAll'] ? $this->stats[$this->uids[$u2]]['hpAll'] : 1);
				$adt6 = round(0.1*(floor($yron)/$hpAlld*100),10);
            }else{
                $adt6 = round(0.1*(floor($yron)/1000*100),10);
            }

            if( $yron > $this->stats[$this->uids[$u2]]['hpNow'] )
			{
                $yron = $this->stats[$this->uids[$u2]]['hpNow'];
            }

            if( $yron > 0 )
			{
                $this->users[$this->uids[$u1]]['battle_yron'] += $yron;
                $this->users[$this->uids[$u1]]['battle_exp'] += round(1*$this->testExp($yron,$this->stats[$this->uids[$u1]],$this->stats[$this->uids[$u2]],$u1,$u2));
                if( $this->stats[$this->uids[$u2]]['this_animal'] == 0 ) {
                    $this->users[$this->uids[$u1]]['tactic6'] += $adt6;
                    $this->stats[$this->uids[$u1]]['tactic6'] += $adt6;
                }else{
                    $this->users[$this->uids[$u1]]['tactic6'] += $adt6/3;
                    $this->stats[$this->uids[$u1]]['tactic6'] += $adt6/3;
                }
            }else{
                $adt6 = 0;
            }
            //
            $this->users[$this->uids[$u2]]['last_hp'] = -$yron;
            //
            mysql_query('UPDATE `stats` SET	
					`tactic6`	  = `tactic6` + "'.$adt6.'",
					`battle_yron` = `battle_yron` + "'.$yron.'",
					`battle_exp`  = `battle_exp` + "'.round($this->testExp($yron,$this->stats[$this->uids[$u1]],$this->stats[$this->uids[$u2]],$u1,$u2)).'"					
				WHERE `id` = "'.$u1.'" LIMIT 1');
            //
            mysql_query('UPDATE `stats` SET	
					`last_hp` 	  = "'.$this->users[$this->uids[$u2]]['last_hp'].'"					
				WHERE `id` = "'.$u2.'" LIMIT 1');
        }
        $this->addNewStat(
            array(
                1 => array(
                    'battle'	=> $this->info['id'],
                    'uid1'		=> $this->users[$this->uids[$u1]]['id'],
                    'uid2'		=> $this->users[$this->uids[$u2]]['id'],
                    'time'		=> time(),
                    'type'		=> 0,
                    'a'			=> '10000',
                    'b'			=> 0,
                    'type_a'	=> 1,
                    'type_b'	=> 0,
                    'ma'		=> 1,
                    'mb'		=> 1,
                    'yrn'		=> $yron,
                    'yrn_krit'	=> 0,
                    'tm1'		=> $this->users[$this->uids[$u1]]['team'],
                    'tm2'		=> $this->users[$this->uids[$u2]]['team']
                )
            )
        );

    }

    //Наносим удар между игроками
    public $restart_stats_data = array();

    public function a_restart_stats($uid1,$glob) {
        if($uid1 > 0 && isset($this->restart_stats_data[$uid1])) {
            $this->stats[$this->uids[$uid1]] = $this->restart_stats_data[$uid1];
            if($glob == 1) {
                unset($this->restart_stats_data[$uid1]);
            }
        }
    }

    public function a_save_stats($uid1) {
        if($uid1 > 0) {
            $this->restart_stats_data[$uid1] = $this->stats[$this->uids[$uid1]];
        }
    }

    public function a_testing_stats($uid1,$zona) {
        //$this->stats[$this->uids[$uid1]] = $this->yronGetrazmenStats( $this->stats[$this->uids[$uid1]] , $zona );
        if($uid1 > 0) {
            $this->stats[$this->uids[$uid1]] = $this->yronGetrazmenStats( $this->stats[$this->uids[$uid1]] , $zona );
        }
    }

    public $import_atack = array();
    public $contr = array();
    public $import_user = array(0);//dg было 0

	public function startAtack($id)
    {
        global $c,$u,$log_text,$priem;
        //
        $save_time5 = false;
		if($save_time5) dStart();//dg

		$this->prlog = array();
        $this->import_user = array(0);//dg было 0

        if($save_time5) dStart();//dg
		if(isset($this->atacks[$id]) && $this->atacks[$id]['lock'] == 0)
		{
				//Прием Ставка на Опережение
				$i = 1; $j = 2; $k = 0; $rest =0;
				$unpr = '';
                $post_arr = array(11=>450,11=>239);//Поступь смерти

				while( $i <= 2 )
				{
					$untac = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "220" AND `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `delete` = 0 LIMIT 1'));
					$untac2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "211" AND `uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `delete` = 0 LIMIT 1'));
                    
					if(isset($untac['id']) && !isset($untac2['id']))
					{
						$pvr['sp'] = mysql_query('SELECT `a`.* FROM `eff_users` AS `a` WHERE `a`.`uid` = "'.$this->atacks[$id]['uid'.$j].'"
						AND `a`.`delete` = 0 AND `a`.`v1` = "priem"
                        AND `a`.`v2` NOT IN (201,211,233,238,245,248,249,254,255,260,284,285,29,180,283,267,32,257,30,139,342,343,251,250,252,31,
						188,229,269,276,277,278,279,228,229,222,296,297)
						AND `a`.`v2` NOT IN ( SELECT `id` FROM `priems` WHERE `neg` > 0 AND `seebtl` = "0" )
						AND `a`.`name` NOT LIKE "%Силовое поле%"
						AND `a`.`name` NOT LIKE "%Туманный образ%"
						AND `a`.`name` NOT LIKE "%Каменный страж%"
                        AND `a`.`name` NOT LIKE "%Спасение%"
						AND `a`.`name` NOT LIKE "%Очищение%"
						AND `name` NOT LIKE "%Отвар%"
						AND `name` NOT LIKE "%Мешочек%"
						AND `name` NOT LIKE "%Сушеный%"
						AND `a`.`name` NOT LIKE "%Магический барьер%"
						LIMIT 30');
						
                        $post_sm = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` IN (239,450)
						AND `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `delete` = 0 LIMIT 1'));

						while($pvr['pl'] = mysql_fetch_array($pvr['sp']))
						{
							$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pvr['pl']['v2'].'" LIMIT 1'));
							if( isset($pvr['pl']['priem']['id']) && $pvr['pl']['priem']['neg'] == 0 )
							{
								$tst6 = mysql_fetch_array(mysql_query('SELECT `id`,`v2` FROM `eff_users` WHERE `uid` = "'.$this->atacks[$id]['uid'.$i].'"
								AND `v2` = "'.$pvr['pl']['v2'].'" AND `delete` = 0 LIMIT 1'));

								$post_sts = $u->lookStats($pvr['pl']['priem']['tr']);//Поступь смерти
                                if(in_array($pvr['pl']['v2'], $post_arr)) $st2 = $u->getStats($this->atacks[$id]['uid'.$i], $i1);//Поступь смерти

								if( (isset($tst6['id']) && !in_array($pvr['pl']['v2'], $post_arr))
								||  (in_array($pvr['pl']['v2'], $post_arr) && $st2['s2'] < $post_sts['tr_s2']) || $pvr['pl']['v2']==17 )
								{
									mysql_query('UPDATE `eff_users` SET `uid` = "0" , `delete` = "'.time().'" WHERE `id` = "'.$pvr['pl']['id'].'" LIMIT 1');
								} else {
											if(isset($post_sm['id']) && in_array($pvr['pl']['v2'], $post_arr))//Поступь смерти
											{
		                                        mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `v1` = "priem"
												AND `v2` IN (450) AND `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `delete` = "0"');
											}

											mysql_query('UPDATE `eff_users` SET `uid` = "'.$this->atacks[$id]['uid'.$i].'" WHERE `id` = "'.$pvr['pl']['id'].'" LIMIT 1');

											if(in_array($pvr['pl']['v2'], $post_arr) && $post_arr[$st2['lvl']] != $pvr['pl']['v2'])//Поступь смерти
											{
												$p_data = 'add_maxAtack='.($pvr['pl']['x']*$st2['lvl']).'|step='.$pvr['pl']['x'].'|';

												$result = mysql_query('UPDATE `eff_users` SET `name`="Поступь смерти ['.$st2['lvl'].']", data="'.$p_data.'",
												`v2`="'.$post_arr[$st2['lvl']].'" WHERE `id` = "'.$pvr['pl']['id'].'" LIMIT 1');
												//pr();
											}
								}
								$this->priemAddLogFast( $this->atacks[$id]['uid'.$i], 0, "Ставка на опережение",
								'{tm1} {u1} украл прием <b>'.$pvr['pl']['name'].'</b>.',
								1, time() );
								$rest++;
							}
						}
						$k++;
					}
					$j--;
					$i++;
				}
                if($save_time5) dStart();//dg
				
				//
				if( $rest > 0 )
				{
					$this->stats[$this->uids[$this->atacks[$id]['uid1']]] = $u->getStats($this->atacks[$id]['uid1'],0,0,false,false,true);
					$this->stats[$this->uids[$this->atacks[$id]['uid2']]] = $u->getStats($this->atacks[$id]['uid2'],0,0,false,false,true);
				}
				//
                if($save_time5) dStart();//dg
				//Прием разгадать тактику
				$i = 1; $j = 2; $k = 0;
				$unpr = '';
				while( $i <= 2 )
				{
					$untac = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "217" AND `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `delete` = 0 LIMIT 1'));
					$untac2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "211" AND `uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `delete` = 0 LIMIT 1'));
					if(isset($untac['id']) && !isset($untac2['id']))
					{
						$pvr['sp'] = mysql_query('SELECT `a`.* FROM `eff_users` AS `a`
						WHERE `a`.`uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `a`.`delete` = 0 AND `a`.`v1` = "priem"
       					AND `a`.`v2`NOT IN (238,228,229,139,188,211,233,220,191,201,206,207,208,209,273,284,210,261,260,262,263,258,29,30,31,32,256,
						249,248,187,245,175,176,177,178,179,285,36,85,86,87,88,89,90,269,276,270,174,324,217,253,254,342,343,406)
						AND `name` NOT LIKE "%Иммунитет%"
						AND `name` NOT LIKE "%Магический барьер%"
						AND `name` NOT LIKE "%Иней%"
						AND `name` NOT LIKE "%Отвар%"
						AND `name` NOT LIKE "%Мешочек%"
						AND `name` NOT LIKE "%Сушеный%"
						AND `name` NOT LIKE "%Туманный образ%" LIMIT 30');

						while($pvr['pl'] = mysql_fetch_array($pvr['sp']))
						{
							$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pvr['pl']['v2'].'" LIMIT 1'));
							if( $pvr['pl']['priem']['id'] == 217 )
							{
								$this->priemAddLogFast( $this->atacks[$id]['uid'.$i], 0, "Разгадать тактику",
									'{tm1} {u1} защищен от &quot;Разгадать тактику&quot;. (Агрессивная защита)',
								1, time() );	
								$rest++;
							}
							elseif( isset($pvr['pl']['priem']['id']) && $pvr['pl']['priem']['neg'] == 0 )
							{
								$this->delPriem($pvr['pl'],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],100);
								$rest++;
							}
						}
						//
						$k++;
					}
					$j--;
					$i++;
				}
                if($save_time5) dStart();//dg
				
				if( $rest > 0 )
				{
					$this->stats[$this->uids[$this->atacks[$id]['uid1']]] = $u->getStats($this->atacks[$id]['uid1'],0,0,false,false,true);
					$this->stats[$this->uids[$this->atacks[$id]['uid2']]] = $u->getStats($this->atacks[$id]['uid2'],0,0,false,false,true);
				}
				unset($untac, $untac2);

				if($save_time5) dStart();//dg
				//=================Обреченность==================//
		        $i = 1; $j = 2; $k = 0; $rest = 0; $no_pr = array(1=>false, 2=>false);
		        while( $i <= 2 )
				{
                    $untac1 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "204"
					AND `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `delete` = 0 LIMIT 1'));

					$untac2  = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem"
					AND `v2` IN ("215", "48", "8", "49", "10") AND `uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `delete` = 0 LIMIT 1'));

					if(isset($untac1['id']) && isset($untac2['id']))
					{
						$pvr['sp'] = mysql_query('SELECT `a`.* FROM `eff_users` AS `a`
						WHERE `a`.`uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `a`.`delete` = 0 AND ( `a`.`v1` = "priem"
						AND `a`.`v1` = "priem" AND `a`.`v2` IN ("215", "48", "8", "49", "10") )
						ORDER BY FIND_IN_SET (`a`.`v2`,"215,48,8,49,10") LIMIT 30');

						while($pvr['pl'] = mysql_fetch_array($pvr['sp']))
						{
							$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pvr['pl']['v2'].'" LIMIT 1'));

							if( isset($pvr['pl']['priem']['id']) && $pvr['pl']['priem']['neg'] == 0 && $rest==0)
							{
								//Log
								$this->priemAddLogFast( $this->atacks[$id]['uid'.$j], 0, $pvr['pl']['name'],
								'{tm1} '.$this->addlt(1 , 17 , $this->users[$this->atacks[$id]['uid'.$j]]['sex'] , NULL).' <b>(Приём подавлен обречённостью)</b>',
								1, time() );

								$this->delPriem($pvr['pl'],$this->users[$this->uids[$this->atacks[$id]['uid'.$i]]],98,
								$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],'Обреченность',0,0,0);

								$rest++;
                                $no_pr[$j] = true;
							}
						}
						$k++;
					}
		        	$j--;
					$i++;
				}
                if($save_time5) dStart();//dg
				//if( $rest > 0 ) - отключил 17.01.20
				//{
					//$this->stats[$this->uids[$this->atacks[$id]['uid1']]] = $u->getStats($this->atacks[$id]['uid1'],0,0,false,false,true);
					//$this->stats[$this->uids[$this->atacks[$id]['uid2']]] = $u->getStats($this->atacks[$id]['uid2'],0,0,false,false,true);
				//}
                unset($untac1, $untac2);
				//=================Обреченность==================//

				//=================Защитить==================//
				if($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 100 || $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 100)
				{
					$pr_uid =  ($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 100 ? $this->atacks[$id]['uid1'] : $this->atacks[$id]['uid2']);
	                $pr_yhod = ($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 100 ? $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] : $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);

					$this->priemAddLog( $id, 1, 2, $pr_yhod, $pr_uid, 'Защитить','{tm1} '.$this->addlt(1 , 17 , $this->users[$this->uids[$this->atacks[$id][$pr_uid]]]['sex'] , NULL).' на {u2}. ', ($this->hodID + 1));
				}
	            //=================Защитить==================//

			if($save_time5) dStart();//dg

            $this->stats[$this->uids[$this->atacks[$id]['uid1']]] = $u->getStats($this->atacks[$id]['uid1'],0,0,false,false,true);
            $this->stats[$this->uids[$this->atacks[$id]['uid2']]] = $u->getStats($this->atacks[$id]['uid2'],0,0,false,false,true);

            if($save_time5) dStart();//dg

			//Флаг при включении статусного боя
        	$bType = $u->BattleType($u->BattleYron($this->info['id']));
			if($bType[1] > 1)
			{
                $lider = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `lider` = "'.$this->info['id'].'"
				AND `team`="'.$u->info['team'].'" LIMIT 1'));
				
				if(!isset($lider['id']))//У команды нет лидера
				{
					$sp3 = mysql_query('SELECT `u`.`id` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`)
					WHERE `u`.`battle` = "'.$this->info['id'].'" AND `team`="'.$u->info['team'].'" AND `st`.`hpNow`>"0" AND `u`.`bot_id`="0"
					AND `u`.`pass`!="saintlucia"');

					$liders = array();
					while( $btl_users = mysql_fetch_array($sp3) ){$liders[] = $btl_users['id'];}
					$lkey = array_rand($liders, 1);

                    mysql_query('UPDATE `stats` SET `lider` = "'.$this->info['id'].'" WHERE `id` = "'.$liders[$lkey].'" LIMIT 1');
				}

			}

			//Восстановление манны 1% за ход
            if( $this->atacks[$id]['out1'] == 0 )
			{
                if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['s6']/4 < $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['level'] ) {
                    $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] += floor($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['level'] + $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hod_minmana'] );
                }else{
                    $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] += floor($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['s6']/4 + $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hod_minmana'] );
                }
                $this->users[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'];
            }
          
            if( $this->atacks[$id]['out2'] == 0 )
			{
                if( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['s6']/4 < $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['level'] ) {
                    $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] += floor($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['level'] + $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hod_minmana'] );
                }else{
                    $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] += floor($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['s6']/4 + $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hod_minmana'] );
                }
                $this->users[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'];
            }
            
            $last_yrn = array(
                1 => $this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_yron'],
                2 => $this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_yron']
            );
            if($save_time5) dStart();//dg

            //Расчет количества блоков и противников
            $this->testZonb($id,$this->atacks[$id]['uid1'],$this->atacks[$id]['uid2']);

            //Запускаем магию предметов
            $this->magicItems($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],0);
            $this->magicItems($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],0);

            //Проба - актуальные hp и mp
			/*$stats_now = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE  `id` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1'));
			$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $stats_now['hpNow'];
            $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $stats_now['mpNow'];
            $stats_now = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE  `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1'));
			$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $stats_now['hpNow'];
            $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $stats_now['mpNow'];*/
            //Проба - актуальные hp и mp

            // Получаем приемы игроков
            $this->priemsRazmen($id,$at);
            $this->priemsRazmenMoment($id,$at);
            $this->priemsRazmen($id,$at);
            if($save_time5) dStart();//dg
            // Тестируем размены (получаем куда игрок ударил, куда попал, куда блок)
            $at = $this->newRazmen($id,$at);

			
            //Проба - актуальные hp и mp
			/*$stats_now = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE  `id` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1'));
			$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $stats_now['hpNow'];
            $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $stats_now['mpNow'];
            $stats_now = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE  `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1'));
			$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $stats_now['hpNow'];
            $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $stats_now['mpNow'];*/
            //Проба - актуальные hp и mp

            /*Функции действуют так - следующая перезаписыват предыдущую,
            если нужно, чтобы уворот был первым, он должен быть последним,
            т.к. он выполнится посленим и перезапишет предыдущие*/

			/*Порядок МФ - новый*/
            $at = $this->mf1Razmen($id,$at, 0); //уворот
            $at = $this->mf3Razmen($id,$at, 0); //парирование
			$at = $this->mf2Razmen($id,$at, 0); //крит
            $at = $this->mf4Razmen($id,$at, 0); //блок щитом
            $at = $this->mf5Razmen ($id,$at, 0); //контрудар
            if($save_time5) dStart();//dg

            //Проба - актуальные hp и mp
			/*$stats_now = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE  `id` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1'));
			$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $stats_now['hpNow'];
            $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $stats_now['mpNow'];
            $stats_now = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE  `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1'));
			$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $stats_now['hpNow'];
            $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $stats_now['mpNow'];*/
            //Проба - актуальные hp и mp

            $at = $this->yronRazmen($id,$at);  //расчет урона
			
            if($save_time5) dStart();//dg
			// Проверяем приемы
            // Получаем приемы игроков
            $at = $this->priemsTestRazmen($id,$at);
			//pr($this->atacks);
            if($save_time5) dStart();//dg
            // Собираем размен (пересчитываем и расчитываем урон и т.д)
            $at = $this->priemsRestartRazmen($id,$at); //Повторная проверка приемов (если требуется)
            if($save_time5) dStart();//dg
			//pr($at);
			//pr($at['fiz']);
			//pr($this->atacks[$id]['uid2']);
            //dvar($at);
			//

            //Минусуем поглощенный урон
            if( count($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['set_pog']) > 0 ) $this->testPogB($this->atacks[$id]['uid1'],1,$id,1);
            if( count($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['set_pog']) > 0 ) $this->testPogB($this->atacks[$id]['uid2'],1,$id,1);

            if($save_time5) dStart();//dg
            // Обновляем НР и добавляем тактики
            $at = $this->updateHealth($id,$at);
            if($save_time5) dStart();//dg
            //$priem->testDie[$id]['uid1'];//Так надо??? $priem->testDie($this->atacks[$id]['uid1']);
            //$priem->testDie[$id]['uid2'];//Так надо??? $priem->testDie($this->atacks[$id]['uid1']);
            $priem->testDie($this->atacks[$id]['uid1']);//Проба!
        	$priem->testDie($this->atacks[$id]['uid2']);//Проба!
            if($save_time5) dStart();//dg
            // Заносим в логи + записываем статистику боя
            $this->addlogRazmen($id,$at);
            if(in_array($u->info['id'], $c['admins']) || $ADMIN==1) echo $this->seeRazmen($id,$at).'<br>';
            // NEW BATTLE SYSTEM
            if($save_time5) dStart();//dg
            //Запускаем магию предметов
            $this->magicItems($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$id);
            $this->magicItems($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$id);
            if($save_time5) dStart();//dg
            //
            //Возращаем зоны блока
            $this->restZonb($id, $this->atacks[$id]['uid1'],$this->atacks[$id]['uid2']);
            //обновляем задержки приемов
            $zd1 = explode('|',$this->users[$this->uids[$this->atacks[$id]['uid1']]]['priems_z']);
            $zd2 = explode('|',$this->users[$this->uids[$this->atacks[$id]['uid2']]]['priems_z']);
            $zd1id = explode('|',$this->users[$this->uids[$this->atacks[$id]['uid1']]]['priems']);
            $zd2id = explode('|',$this->users[$this->uids[$this->atacks[$id]['uid2']]]['priems']);
            //
            $prmos = array();
            //
            $i5 = 0;

            while($i5 < 51)
			{
                if(isset($zd1[$i5]) && $zd1[$i5]>0)
				{
                    $zd1[$i5] -= 1;
                }else{
                    $zd1[$i5] = 0;
                }
                if(isset($zd2[$i5]) && $zd2[$i5]>0)
				{
                    //Если приемы не требуют ход
                    $zd2[$i5] -= 1;
                }else{
                    $zd2[$i5] = 0;
                }
                $i5++;
            }
            if($save_time5) dStart();//dg
            unset($prmos);

            if( $this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'] == $this->users[$this->uids[$this->atacks[$id]['uid2']]]['id'] )
			{
                $this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'] = -$this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'];
            }

            if( $this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'] == $this->users[$this->uids[$this->atacks[$id]['uid1']]]['id'] )
			{
                $this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'] = -$this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'];
            }

            $this->users[$this->uids[$this->atacks[$id]['uid1']]]['priems_z'] = implode('|',$zd1);
            $this->users[$this->uids[$this->atacks[$id]['uid2']]]['priems_z'] = implode('|',$zd2);
            if($this->atacks[$id]['uid1']==$u->info['id'])
			{
                $u->info['priems_z'] = implode('|',$zd1);
            } elseif($this->atacks[$id]['uid2']==$u->info['id'])
			{
                $u->info['priems_z'] = implode('|',$zd2);
            }
            //

			//Проверяем тактики
            $i = 1;
            while( $i <= 6 )
			{
				if( $this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] > 25
				&& $this->users[$this->uids[$this->atacks[$id]['uid1']]]['admin']==0 )
				{
                    $this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] = 25;
                }
				elseif( $this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] <= 0 )
				{
                    $this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] = 0;
                }

				if( $this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] > 25
				&& $this->users[$this->uids[$this->atacks[$id]['uid2']]]['admin']==0 )
				{
                    $this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] = 25;
                }
				elseif( $this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] <= 0 )
				{
                    $this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] = 0;
                }
                $i++;
            }
            if($save_time5) dStart();//dg
            //
            //Обновляем задержки предметов
            if ($this->info['id'] && $u->TJBAttle($this->info['id'])) $table_iu = 'items_users_fast';
			else $table_iu = 'items_users';

            mysql_query('UPDATE `'.$table_iu.'` SET `btl_zd` = `btl_zd` - 1 WHERE `uid` IN("'.$this->atacks[$id]['uid1'].'", "'.$this->atacks[$id]['uid2'].'") AND `btl_zd` > 0 AND `inOdet` > 0 LIMIT 100');

            mysql_query('UPDATE `users` SET `notrhod` = "-1" WHERE `id` IN("'.$this->atacks[$id]['uid1'].'", "'.$this->atacks[$id]['uid2'].'") LIMIT 2');

            //Обновляем задержки пирожков
            mysql_query('UPDATE `pirogi` SET `hod` = `hod` - 1 WHERE `btl` = "'.$this->info['id'].'" AND `uid` IN("'.$this->atacks[$id]['uid1'].'", "'.$this->atacks[$id]['uid2'].'")');
            mysql_query('UPDATE `tactic` SET `hod` = `hod` - 1 WHERE `btl` = "'.$this->info['id'].'" AND `uid` IN("'.$this->atacks[$id]['uid1'].'", "'.$this->atacks[$id]['uid2'].'")');

            //Тактики
            mysql_query('DELETE FROM `pirogi` WHERE `btl` = "'.$this->info['id'].'" AND `hod` < 1');
            mysql_query('DELETE FROM `tactic` WHERE `btl` = "'.$this->info['id'].'" AND `hod` < 1');

            //Обновляем задержки пирожков
            mysql_query('UPDATE `spells` SET `hod` = `hod` - 1 WHERE `btl` = "'.$this->info['id'].'" AND `uid` IN("'.$this->atacks[$id]['uid1'].'", "'.$this->atacks[$id]['uid2'].'")');
            mysql_query('DELETE FROM `spells` WHERE `btl` = "'.$this->info['id'].'" AND `hod` < 1');

            //Обновляем данные в battle_users
            mysql_query('UPDATE `battle_users` SET `hp` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'].'"
			WHERE `battle` = "'.$this->info['id'].'" AND `uid` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1');

			mysql_query('UPDATE `battle_users` SET `hp` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'].'"
			WHERE `battle` = "'.$this->info['id'].'" AND `uid` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1');

			if($save_time5) dStart();//dg
            $last_yrn = array(
                1  => $last_yrn[1],
                2  => $last_yrn[2],
                10 => $this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_yron'],
                20 => $this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_yron']
            );

            $last_yrn[100] = floor($last_yrn[10]-$last_yrn[1]);
            $last_yrn[200] = floor($last_yrn[20]-$last_yrn[2]);

            if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 )
			{
                $this->save_stats( $this->yhod_user($id, $this->atacks[$id]['uid2'], $this->atacks[$id]['uid1'], $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] ) );
            }elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 )
			{
                $this->save_stats( $this->yhod_user($id, $this->atacks[$id]['uid1'], $this->atacks[$id]['uid2'], $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] ) );
            }
            if($save_time5) dStart();//dg
            mysql_query('UPDATE `stats` SET
				
					`hpNow` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'].'",
					`mpNow` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'].'",
					`tactic1` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic1'].'",
					`tactic2` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic2'].'",
					`tactic3` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic3'].'",
					`tactic4` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic4'].'",
					`tactic5` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic5'].'",
					`tactic6` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic6'].'",
					`tactic7` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic7'].'",
					
					`enemy` 	  = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'].'",
					`battle_yron` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_yron'].'",
					`last_hp` 	  = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['last_hp'].'",
					`battle_exp`  = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_exp'].'",
					`priems_z`  = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['priems_z'].'"
					
				WHERE `id` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1');
            //
            if($save_time5) dStart();//dg
            mysql_query('UPDATE `stats` SET
				
					`hpNow` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'].'",
					`mpNow` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'].'",
					`tactic1` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic1'].'",
					`tactic2` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic2'].'",
					`tactic3` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic3'].'",
					`tactic4` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic4'].'",
					`tactic5` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic5'].'",
					`tactic6` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic6'].'",
					`tactic7` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic7'].'",
					
					`enemy` 	  = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'].'",
					`battle_yron` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_yron'].'",
					`last_hp` 	  = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['last_hp'].'",
					`battle_exp`  = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_exp'].'",
					`priems_z`  = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['priems_z'].'"
					
				WHERE `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1');
            //
            if($save_time5) dStart();//dg
            $this->priemsRazmenMomentEnd($id,$at);
            if($save_time5) dStart();//dg
            $priem->testDie($this->atacks[$id]['uid1']);
            $priem->testDie($this->atacks[$id]['uid2']);
            if($save_time5) dStart();//dg
            //Минусуем заряд приема \ эффекта
            $j = 1; $jn = 1;
            while($j<=2)
			{
				$eff = $this->stats[$this->uids[$this->atacks[$id]['uid'.$j]]]['effects'];
                $i = 0;
                while($i<count($eff))
				{
                    if(isset($eff[$i]))
					{
						//dvar($eff[$i]);
						if(isset($eff[$i]['timeUse']) && $eff[$i]['timeUse']==77 && $eff[$i]['hod']>-1)
						{
                            $eff[$i]['hod']--;
                            $eff[$i]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$eff[$i]['v2'].'" LIMIT 1'));
                            if( round($eff[$i]['priem']['minmana'] * $eff[$i]['x']) != 0 ) {
                                //Отнимаем ману у того кто кастовал
                                $priem->minMana($eff[$i]['user_use'],round($eff[$i]['priem']['minmana'] * $eff[$i]['x']));
                                if( $this->stats[$this->uids[$eff[$i]['user_use']]]['mpNow'] <= 0 ) {
                                    $eff[$i]['hod'] = 0;
                                }
                            }
                            if( strripos( $eff[$i]['data'] , 'minprocmanahod') == true ) {
                                $pvr = array(
                                    'x1'	=> 0,
                                    'x2'	=> 0,
                                    'd'		=> '',
                                    'i'		=> 0,
                                    'uid'	=> $eff[$i]['uid'],
                                    'color' => '',
                                    'color2'=> '',
                                    'effx'	=> '',
                                    'x'		=> $eff[$i]['name']
                                );
                                $pvr['d'] = explode('|',$eff[$i]['data']);
                                while( $pvr['i'] < count($pvr['d']) ) {
                                    if( isset($pvr['d'][$pvr['i']])) {
                                        $pvr['d1'] = explode('=',$pvr['d'][$pvr['i']]);
                                        if( $pvr['d1'][0] == 'minprocmanahod' )
										{
                                            $pvr['d1'] = explode('x',$pvr['d1'][1]);
                                            $pvr['x1'] = $pvr['d1'][0];
                                            $pvr['x2'] = $pvr['d1'][1];
                                        }
                                    }
                                    $pvr['i']++;
                                }

                                $pvr['mp'] = round($this->stats[$this->uids[$pvr['uid']]]['mpAll']/100*rand($pvr['x1'],$pvr['x2']));
                                $pvr['mpSee'] = 0;
                                $pvr['mpNow'] = floor($this->stats[$this->uids[$pvr['uid']]]['mpNow']);
                                $pvr['mpAll'] = $this->stats[$this->uids[$pvr['uid']]]['mpAll'];
                                $pvr['mpTr'] = $pvr['mpAll'] - $pvr['mpNow'];
                                if( $pvr['mpTr'] > 0 ) {
                                    //Требуется хилл
                                    if( $pvr['mpTr'] < $pvr['mp'] ) {
                                        $pvr['mp'] = $pvr['mpTr'];
                                    }
                                    $pvr['mpSee'] = '+'.$pvr['mp'];
                                    $pvr['mpNow'] += $pvr['mp'];
                                }
                                if( $pvr['mpNow'] > $pvr['mpAll'] ) {
                                    $pvr['mpNow'] = $pvr['mpAll'];
                                }elseif( $pvr['mpNow'] < 0 ) {
                                    $pvr['mpNow'] = 0;
                                }
                                if( $pvr['mpSee'] == 0 ) {
                                    $pvr['mpSee'] = '--';
                                }

                                $btl->stats[$btl->uids[$pvr['uid']]]['mpNow'] = $pvr['mpNow'];
                                $btl->users[$btl->uids[$pvr['uid']]]['mpNow'] = $pvr['mpNow'];
                                mysql_query('UPDATE `stats` SET `mpNow` = "'.$btl->stats[$btl->uids[$pvr['uid']]]['mpNow'].'" WHERE `id` = "'.$pvr['uid'].'" LIMIT 1');

                                $pvr['text'] = $this->addlt(1 , 21 , $this->users[$this->uids[$pvr['uid']]]['sex'] , NULL);
                                $pvr['text2'] = '{tm1} '.$pvr['text'].' на <font Color=#006699><b>'.$pvr['mpSee'].'</b></font> ['.$pvr['mpNow'].'/'.$pvr['mpAll'].'] (Мана)';
                                $this->priemAddLog( $id, 1, 2, $pvr['uid'], 0,
                                    '<font color^^^^#'.$pvr['color2'].'>'.$pvr['x'].'</font>',
                                    $pvr['text2'],
                                    ($this->hodID + 0)
                                );
                                unset($pvr);
                            }
                            if(isset($this->rehodeff[$eff[$i]['id']])) {
                                $eff[$i]['hod'] = $this->rehodeff[$eff[$i]['id']];
                            }
                            if($eff[$i]['hod']>0) {
                                $this->stats[$this->uids[$this->atacks[$id]['uid'.$j]]]['effects']['hod'] = $eff[$i]['hod'];
                                mysql_query('UPDATE `eff_users` SET `hod` = "'.$eff[$i]['hod'].'" WHERE `id` = "'.$eff[$i]['id'].'" LIMIT 1');
                            }else{
                                //удаляем прием
                                if($eff[$i]['v2']>0) {
                                    if($j==1) {
                                        $jn = 2;
                                    }else{
                                        $jn = 1;
                                    }
                                    $this->delPriem($eff[$i],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],3,$this->atacks[$id]['uid'.$jn],'',0,0,0);
                                }
                            }
                        }elseif(isset($eff[$i]['timeUse']) && $eff[$i]['timeUse']==77 && $eff[$i]['hod']==-2) {
                            $eff[$i]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$eff[$i]['v2'].'" LIMIT 1'));
                            $priem->hodUsePriem($eff[$i],$eff[$i]['priem']);
                        }else{
                            if(isset($eff[$i]['v2'])) $eff[$i]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$eff[$i]['v2'].'" LIMIT 1'));
                            if( isset($eff[$i]['priem']['minmana']) && round($eff[$i]['priem']['minmana'] * $eff[$i]['x']) != 0 ) {
                                //Отнимаем ману у того кто кастовал
                                $priem->minMana($eff[$i]['user_use'],round($eff[$i]['priem']['minmana'] * $eff[$i]['x']));
                                if( $this->stats[$this->uids[$eff[$i]['user_use']]]['mpNow'] <= 0 ) {
                                    $eff[$i]['hod'] = 0;
                                    if(isset($this->rehodeff[$eff[$i]['id']])) {
                                        $eff[$i]['hod'] = $this->rehodeff[$eff[$i]['id']];
                                    }
                                    if($eff[$i]['v2']>0) {
                                        if($j==1) {
                                            $jn = 2;
                                        }else{
                                            $jn = 1;
                                        }
                                        $this->delPriem($eff[$i],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],3,$this->atacks[$id]['uid'.$jn]);
                                    }
                                }
                            }elseif(isset($eff[$i]['timeUse']) && $eff[$i]['timeUse'] > 100 && $eff[$i]['hod']>-1 && $c['effz'] > 0) {

                                $eff[$i]['hod']--;
                                if(isset($this->rehodeff[$eff[$i]['id']])) {
                                    $eff[$i]['hod'] = $this->rehodeff[$eff[$i]['id']];
                                }
                                if($eff[$i]['hod']>0) {
                                    $this->stats[$this->uids[$this->atacks[$id]['uid'.$j]]]['effects']['hod'] = $eff[$i]['hod'];
                                    mysql_query('UPDATE `eff_users` SET `hod` = "'.$eff[$i]['hod'].'" WHERE `id` = "'.$eff[$i]['id'].'" LIMIT 1');
                                }else{
                                    //удаляем прием
                                    if($eff[$i]['v2']>0) {
                                        if($j==1) {
                                            $jn = 2;
                                        }else{
                                            $jn = 1;
                                        }
                                        $this->delPriem($eff[$i],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],3,$this->atacks[$id]['uid'.$jn]);
                                    }
                                }
                            }
                            //
                        }
                    }
                    $i++;
                }
                $j++;
            }
            if($save_time5) dStart();//dg
            //
            //

			//Проверяем на смерть из-за пропусков хода
            if( $c['propsk_die'] > 0 && $this->info['razdel'] == 0 && $this->info['dn_id'] == 0 && $this->info['izlom'] == 0 && $u->info['room']!=9)
			{
                $cn1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `battle_out` WHERE `battle` = "'.$this->info['id'].'" AND `uid1` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1'));
                $cn2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `battle_out` WHERE `battle` = "'.$this->info['id'].'" AND `uid1` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1'));
                if( $cn1[0] > 3 )
				{
                    //
                    $pvr['text2'] = '{tm1} Персонаж {u1} был убит из-за большого количества пропусков хода.';
                    $this->priemAddLog( $id, 1, 2, $this->atacks[$id]['uid1'], 0, '',
                        $pvr['text2'],
                        ($this->hodID + 0)
                    );
                    unset($pvr);
                    mysql_query('UPDATE `stats` SET `hpNow` = 0 WHERE `id` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1');
                }
                if( $cn2[0] > $c['propsk_die'] )
				{
                    $pvr['text2'] = '{tm1} Персонаж {u1} был убит из-за большого количества пропусков хода.';
                    $this->priemAddLog( $id, 1, 2, $this->atacks[$id]['uid2'], 0, '',
                        $pvr['text2'],
                        ($this->hodID + 0)
                    );
                    unset($pvr);
                    mysql_query('UPDATE `stats` SET `hpNow` = 0 WHERE `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1');
                }
            }
            if($save_time5) dStart();//dg
            //
            //Обновляем текущего противника
            if( $u->info['id'] == $this->atacks[$id]['uid1'] )
			{
                $u->info['enemy'] = $this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'];
            }
            if( $u->info['id'] == $this->atacks[$id]['uid2'] )
			{
                $u->info['enemy'] = $this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'];
            }
            //Удаляем размен из базы
            mysql_query('DELETE FROM `battle_act` WHERE ( `uid1` = "'.$this->atacks[$id]['uid1'].'" AND `uid2` = "'.$this->atacks[$id]['uid2'].'" ) OR
			( `uid2` = "'.$this->atacks[$id]['uid1'].'" AND `uid1` = "'.$this->atacks[$id]['uid2'].'" )');

            unset($old_s1,$old_s2);
            unset($this->ga[$this->atacks[$id]['uid1']][$this->atacks[$id]['uid2']],$this->ga[$this->atacks[$id]['uid2']][$this->atacks[$id]['uid1']]);
            unset($this->ag[$this->atacks[$id]['uid1']][$this->atacks[$id]['uid2']],$this->ag[$this->atacks[$id]['uid2']][$this->atacks[$id]['uid1']]);
            unset($this->atacks[$id]);
            mysql_query('DELETE FROM `battle_act` WHERE `id` = "'.$id.'" LIMIT 1');
            unset($old_s1,$old_s2);

            if($save_time5==true && in_array($u->info['id'], $c['admins']))
			{
				eLog('===============================startAtack: uid:'.$u->info['id'].'===============================');
				dPrint();//dg
			    eLog('===============================startAtack: uid:'.$u->info['id'].'===============================');
			}
            //
        }
    }

    //Сохранение данные
    public function save_stats( $uid )
	{
        mysql_query('UPDATE `stats` SET
				
					`hpNow` = "'.$this->stats[$this->uids[$uid]]['hpNow'].'",
					`mpNow` = "'.$this->stats[$this->uids[$uid]]['mpNow'].'",
					`tactic1` = "'.$this->users[$this->uids[$uid]]['tactic1'].'",
					`tactic2` = "'.$this->users[$this->uids[$uid]]['tactic2'].'",
					`tactic3` = "'.$this->users[$this->uids[$uid]]['tactic3'].'",
					`tactic4` = "'.$this->users[$this->uids[$uid]]['tactic4'].'",
					`tactic5` = "'.$this->users[$this->uids[$uid]]['tactic5'].'",
					`tactic6` = "'.$this->users[$this->uids[$uid]]['tactic6'].'",
					`tactic7` = "'.$this->users[$this->uids[$uid]]['tactic7'].'",
					
					`enemy` 	  = "'.$this->users[$this->uids[$uid]]['enemy'].'",
					`battle_yron` = "'.$this->users[$this->uids[$uid]]['battle_yron'].'",
					`last_hp` 	  = "'.$this->users[$this->uids[$uid]]['last_hp'].'",
					`battle_exp`  = "'.$this->users[$this->uids[$uid]]['battle_exp'].'",
					`priems_z`  = "'.$this->users[$this->uids[$uid]]['priems_z'].'"
					
				WHERE `id` = "'.$uid.'" LIMIT 1');
    }

    //Отображение НР
    public function hpSee($now,$all,$type = 1) {
        $r = '['.$now.'/'.$all.']';
        if($all > 10000) {
            $type = 2;
        }
        if($type == 1) {

        }elseif($type == 2) {
            $p1 = floor($now/$all*100);
            $r = '['.$p1.'/100%]';
        }
        return $r;
    }

    //Быстрый лог
    public function addFlog($t,$u1,$u2)
    {
        $vLog = '';
        if(isset($this->info[$this->uids[$u1]]['id']))
        {
            $vLog .= 'time1='.time().'||s1='.$this->users[$this->uids[$u1]]['id']['sex'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login'].'||';
        }
        if(isset($this->info[$this->uids[$u2]]['id']))
        {
            $vLog .= 'time2='.time().'||s2='.$this->users[$this->uids[$u2]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||login2='.$this->users[$this->uids[$u2]]['login'].'';
        }
        $vLog = rtrim($vLog,'||');
        $mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
        $mas1['text'] = $t;
        $this->add_log($mas1);
    }


    //Выводим лог боя
    public function logCache()
    {
        global $c,$u,$log_text;
        $thishodID = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
        if(isset($hodID['id'])) {
            $hodID = $hodID['id'];
        }else{
            $hodID = 0;
        }
        if( $hodID > $this->info['hod'] )
		{
            //unlink($c['doc_root']."/battle_logs/btl_".$this->info['id'].".js");
            $this->info['hod'] = $hodID;
            mysql_query('UPDATE `battle` SET `hod` = "'.$hodID.'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
            if( $u->info['design'] == 1 ) {
                $js = ''; $pll = 0;
                if($_POST['idlog']<1){ $_POST['idlog'] = 0; }
                //
                $qq = ($_POST['idlog']>0 ? ' AND `id` > '.mysql_real_escape_string($_POST['idlog']) : '');
                $sp = mysql_query('SELECT 
					`id`,`type`,`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zona2`,`zonb1`,`zonb2`
					FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'"'.$qq.' AND `id_hod` > '.($this->hodID-7).' LIMIT 100');
                $jin = 0; $forYou2 = 0;
                while($pl = mysql_fetch_array($sp))
                {
                    $jin++;
                    $rt = $pl['text'];
                    $pl['vars'] = str_replace('^^^^','rvnO',$pl['vars']);
                    $rt = str_replace('{tm1}','<span class=\"date {fru}\">'.($u->info['admin']>0 ? date('H:i:s',$pl['time']) : date('H:i',$pl['time'])).'</span>',$rt);
                    $rt = str_replace('{tm2}','<span class=\"date {fru}\">'.($u->info['admin']>0 ? date('H:i:s',$pl['time']) : date('H:i',$pl['time'])).'</span>',$rt);
                    $rt = str_replace('{tm3}','<span class=\"date {fru}\">'.date('d.m.Y H:i',$pl['time']).'</span>',$rt);
                    $rt = str_replace('{tm4}','<span class=\"date {fru}\">'.date('d.m.Y H:i',$pl['time']).'</span>',$rt);
                    $pl['text'] = $rt;
                    unset($rt);
                    if($pll < $pl['id']) {
                        $pll = $pl['id'];
                    }
                    $js = 'add_log('.$pl['id'].','.$forYou2.',"'.$pl['text'].'",'.$pl['id_hod'].',0,0,"'.str_replace('"','&quot;',$pl['vars']).'");'.$js;
                }
                $js .= 'id_log='.$pll.';';
            }else{
                $js = ''; $pll = 0;
                //if($_POST['idlog']<1){ $_POST['idlog'] = 0; }
                //
                $sp = mysql_query('SELECT 
					`id`,`type`,`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zona2`,`zonb1`,`zonb2`
					FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id_hod` > '.($this->hodID-7).' LIMIT 100');//AND `id` > '.mysql_real_escape_string($_POST['idlog']).'
                $jin = 0; $forYou2 = 0;
                while($pl = mysql_fetch_array($sp))
                {
                    $jin++;
                    $rt = $pl['text'];
                    //$rt = str_replace('^^^^','=',$rt);
                    $pl['vars'] = str_replace('^^^^','rvnO',$pl['vars']);
                    $rt = str_replace('{tm1}','tt<span class=\"date {fru}\">'.date('H:i',$pl['time']).'</span>',$rt);
                    $rt = str_replace('{tm2}','tt<span class=\"date {fru}\">'.date('H:i',$pl['time']).'</span>',$rt);
                    $rt = str_replace('{tm3}','tt<span class=\"date {fru}\">'.date('d.m.Y H:i',$pl['time']).'</span>',$rt);
                    $rt = str_replace('{tm4}','tt<span class=\"date {fru}\">'.date('d.m.Y H:i',$pl['time']).'</span>',$rt);
                    $pl['text'] = $rt;
                    unset($rt);
                    if($pll < $pl['id']) {
                        $pll = $pl['id'];
                    }
                    $js = 'add_log('.$pl['id'].','.$forYou2.',"'.$pl['text'].'",'.$pl['id_hod'].',0,0,"'.str_replace('"','&quot;',$pl['vars']).'");'.$js;
                }
                $js .= 'id_log='.$pll.';';
            }
            //
            //$fp = fopen($c['doc_root']."/battle_logs/btl_".$this->info['id'].".js", "w");
            //fwrite($fp, 'var vlogid = '.$this->info['hod'].';var loadingLogNow = true;function logRefleshedCache(){ '.$js.' }');
            //fclose($fp);
            //
        }
        return true;
    }

    //Выводим лог боя
    public function lookLog()
    {
        global $c,$u,$log_text;
        $hodID = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
        if(isset($hodID['id'])) {
            $hodID = $hodID['id'];
        }else{
            $hodID = 0;
        }
        $updt = 0;
        if( $hodID > $this->info['hod'] )
		{
            //if(file_exists($c['doc_root']."/battle_logs/btl_".$this->info['id'].".js")) unlink($c['doc_root']."/battle_logs/btl_".$this->info['id'].".js");
            $this->info['hod'] = $hodID;
            mysql_query('UPDATE `battle` SET `hod` = "'.$hodID.'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
            $updt = 1;
        }
        if( $u->info['design'] == 1 )
		{
            $js = ''; $pll = 0;
            
            $sp = mysql_query('SELECT 
			`id`,`type`,`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zona2`,`zonb1`,`zonb2`
			FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id_hod` > '.($this->hodID-15).' LIMIT 100');// AND `id` > '.mysql_real_escape_string($_POST['idlog']).'

			$jin = 0; $forYou2 = 0;
            while($pl = mysql_fetch_array($sp))
            {
                $jin++;
                $rt = $pl['text'];
                $pl['vars'] = str_replace('^^^^','rvnO',$pl['vars']);
                $rt = str_replace('{tm1}','<span class=\"date {fru}\">'.date('H:i',$pl['time']).'</span>',$rt);
                $rt = str_replace('{tm2}','<span class=\"date {fru}\">'.date('H:i',$pl['time']).'</span>',$rt);
                $rt = str_replace('{tm3}','<span class=\"date {fru}\">'.date('d.m.Y H:i',$pl['time']).'</span>',$rt);
                $rt = str_replace('{tm4}','<span class=\"date {fru}\">'.date('d.m.Y H:i',$pl['time']).'</span>',$rt);
                $pl['text'] = $rt;
                unset($rt);
                if($pll < $pl['id']) {
                    $pll = $pl['id'];
                }
                $js = 'add_log('.$pl['id'].','.$forYou2.',"'.$pl['text'].'",'.$pl['id_hod'].',0,0,"'.str_replace('"','&quot;',$pl['vars']).'");'.$js;
            }
            $js .= 'id_log='.$pll.';';
            //$js = bzcompress($js,9);
        }else{
            $js = ''; $pll = 0;
            if($_POST['idlog']<1){ $_POST['idlog'] = 0; }//надо?
            
			$qq = ($_POST['idlog']>0 ? ' AND `id` > '.mysql_real_escape_string($_POST['idlog']) : '');
            $sp = mysql_query('SELECT 
				`id`,`type`,`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zona2`,`zonb1`,`zonb2`
				FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'"'.$qq.' AND `id_hod` > '.($this->hodID-7).' ORDER BY `id` ASC LIMIT 100');
            $jin = 0; $forYou2 = 0;
            while($pl = mysql_fetch_array($sp))
            {
                $jin++;
                $rt = $pl['text'];
                $pl['vars'] = str_replace('^^^^','rvnO',$pl['vars']);
                $rt = str_replace('{tm1}','<span class=\"date {fru}\">'.($u->info['admin']>0 ? date('H:i:s',$pl['time']) : date('H:i',$pl['time'])).'</span>',$rt);
                $rt = str_replace('{tm2}','<span class=\"date {fru}\">'.($u->info['admin']>0 ? date('H:i:s',$pl['time']) : date('H:i',$pl['time'])).'</span>',$rt);
                $rt = str_replace('{tm3}','<span class=\"date {fru}\">'.date('d.m.Y H:i',$pl['time']).'</span>',$rt);
                $rt = str_replace('{tm4}','<span class=\"date {fru}\">'.date('d.m.Y H:i',$pl['time']).'</span>',$rt);
                $pl['text'] = $rt;
                unset($rt);
                if($pll < $pl['id']) {
                    $pll = $pl['id'];
                }
                $js = 'add_log('.$pl['id'].','.$forYou2.',"'.$pl['text'].'",'.$pl['id_hod'].',0,0,"'.str_replace('"','&quot;',$pl['vars']).'");'.$js;
            }
            $js .= 'id_log='.$pll.';';
        }
        //
        //if( $updt == 1 ) {
            //$fp = fopen($c['doc_root']."/battle_logs/btl_".$this->info['id'].".js", "w");
            //fwrite($fp, 'var vlogid = '.$this->info['hod'].';var loadingLogNow = true;function logRefleshedCache(){ '.$js.' }');
            //fclose($fp);
        //}
        //
        return $js;
    }

    //Добавляем в лог
    public function add_log($mass)
    {
		if($mass['time']!='' && $mass['text'] != '')
        {
			$m_repeat = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_logs`
			WHERE `battle`="'.$mass['battle'].'" AND `time` > "'.(time()-5).'" AND `text` = "'.$mass['text'].'" AND `vars` NOT LIKE "prm=%" LIMIT 1'));

			if(!isset($m_repeat['id']))
			{
				$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`)
				VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
			}
		}
    }

    ///Комментатор
    public function get_comment(){
        $boycom = array ('А танцуешь ты лучше.','А мы что, в прятки тут играем?','А вы разве пингвинов никогда не видели?','А, ведь когда-то, вы были красивыми… А теперь? Ну и рожи! Жуть!','А потом еще труп пинать будут.','А я вчера ночью за соседями подглядывал. Они точно так же кувыркались','А ведь вы живых людей дубасите...','А вот я вчера в зоопарке был...','А вы в стройбате не служили?','А вы видели, чтобы так на улице делали!?','А вы знали что ёжики размножаются в интернете?','А жить-то, как хочется:','А из-за чего вы собственно дерётесь?','А чего ржёте, вы ещё остальных не видели','А что произойдёт если ты испугаешся до полусмерти дважды?!','Больше так не делай. Ты же не садист?','Без комментариев...','Больно ведь!','Быстро ты за монитор спрятался!','Все хотят попасть в рай, но никто не хочет умирать!','Вчера с такой девчонкой познакомился.','Всего 5 минут знакомы, а дерутся, словно супруги с 20-ти летним стажем...','Все. Я так больше не могу.','В конце концов, кто-то победит?','Вы чего, с дерева упали?','Возятся как сонные мухи... давайте я вам лучше анекдот расскажу: ...','Вот видишь, как полезно чистить зубы на ночь?','Вот вы все руками махаете, а за вами уже очередь','Вот попадёте вы в плен и вас там будут долго бить. Но вы ничего не расскажете... и не потому, что вы такой стойкий, просто вы ничего не знаете','Вы бы лучше пошли потренировались!','Вы все еще разминаетесь? Позовите, когда кости в муку друг другу разминать будете.','Вы же бойцы! Имейте совесть!','Гаси недоумка!','Да, если бы я смог это остановить, то получил бы нобелевскую премию `За мир` ','Да куда они бьют?!','Давайте быстрее! За вами уже очередь образовалась.','Давайте обойдемся сегодня таймаутом. А? А то мне уже кошмары скоро будут сниться.','Дерутся как девчонки!','Дети, посмотрите налево... Ой!.. Нет, туда лучше не смотреть.','Если так будет продолжаться, то скоро мы заснем!','Если бы у меня было кресло-качалка, я бы в нём качался...','Если вы что-то сказать хотите, то лучше молчите :)','Жестокость не порок.','Жизнь вне нашего клуба - это пустая трата кислорода!!!','Жми! Дави! Кусай! Царапай!','За такие бои надо в хаос отправлять!','Знаете откуда в комиссионном магазине столько вещей? Это я после ваших гулянок собираю и сдаю туда. Иногда вместе с частями тела, застрявшими в них.','Здесь люди так близки друг к другу. Просто иначе ударить нельзя.','И пролитая кровь еще пульсирует...','Инвалидов развелось...','Какой бой!!!','Кто!? Кто здесь?!','Кто вас этому научил?','Кузнечик, блин...','Куплю импортный проигрыватель грампластинок.','Лошадью ходи!','Лучше враг, чем друг - враг.','Ладно, вы тут пока друг друга за волосы таскайте, а я пойду, пообедаю.','Мне ваш балет уже надоел!','Может, начнется-таки настоящий бой???','Мысли лезут в голову изнутри, а удары снаружи.','Ну и где ваши коронные удары? Где живописные падения я спрашиваю!','Ну, нельзя же так наотмашь лупить!','Надо раньше было думать, теперь смертельно поздно...','На такое зрелище билеты продавать можно. Народ ухохочется!','Нет! Не надо драки! А... ладно деритесь, все равно не умеете.','Нет, ну должен быть повод, должен же быть повод?','Нет, я отказываюсь это комментировать!','Не таких обламывали!','Ну выпили вы рюмку, ну две... ну литр, ну два... так зачем же после этого драку затевать?!','Ну и кто за этот погром платить будет?','Ну и оскал у вас. Из вашей улыбки кастеты делать можно.','Ну, что же ты..? Не печалься. Выше голову, так по ней удобней попасть.','Ничего... Блок тоже удар.','Обернись!!!.... Поздно...','Ого! Научите меня так не делать.','Осторожно! Сделаешь дырочку, уже не запломбируешь!','Оно вам надо???','Обычное дело...там что-то отклеилось.','Ой, и заболтался я с вами...','Он же не промахнётся если ты не отойдёшь!','По-моему, кому-то светит инвалидность.','Подкинь ему грабли, на которые он еще не наступал.','Прав был кот Леопольд, давайте жить дружно?','При ударе в живот нарушается кислотно-щелочной баланс.','Проверь, не торчит ли у тебя нож из живота.','Перестаньте мне орать!','Подкинь ему грабли, на которые он еще не наступал.','Прыгают тут как блохи... Все, я пошел за дихлофосом!','Разбудите меня когда эта порнография закончится...','Ребенок сильнее ударил бы!','Славно вмазал!','Славно они веселятся','Смотрю вот на вас, и слезы наворачиваются.','Сначала учатся ходить, а потом только в драку лезут.','Так они друг другу что-нибудь сломают.','Так ты ему все кости переломаешь!','У меня в подъезде точно так же соседа отмудохали','Убогих развелось...','Ух ты, какой прыткий!','Фашист!! Надо ж, так по больному месту врезать...','Хватит бить его об угол моей кабинки! Мне же потом ее чинить.','Хулиганы, прекратите немедленно!','Хочешь, подскажу, куда он ударит?','Хорошо, что у меня ловкости больше чем у вас всех, а то б вы и меня в инвалидную коляску посадили бы.','Хороший бой!','Хороший удар!','Хиляк-разрядник!','Что ты его за волосы схватил?! Отпусти немедленно!','Щас я вас настигну, вот тогда мы и похохочем','Это была какая-то неизвестная мне техника...','Это же противник, а не глина! Хватит мяться!','Это не бой, это издевательское избиение.','Это поубавит спеси','Это и был твой план `Б` ?','Это была какая-то неизвестная мне техника...','Я же предупреждал, - будет больно.','Я не страдаю безумием. Я наслаждаюсь им каждую минуту :)','Я красивый, я сильный, я умный, я добрый. А вот вы? Вы себя-то видели?!','Я тоже умею драться, но не буду...','(тревожно озираясь) я вам по секрету скажу... за вами наблюдают!','<вырезано цензурой> после боя я этих <вырезано цензурой> обоих в <вырезано цензурой> и <вырезано цензурой>','<вырезано цензурой> каратисты фиговы');
        $act_com = array();
        if(rand(1,6) == rand(1,6))
        {
            $txt = '{tm1} <i>Комментатор: '.$boycom[rand(0,count($boycom)-1)].'</i>';
            $vLog = 'time1='.time().'';
            $mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
            $mas1['text'] = $txt;
            $this->add_log($mas1);

        } else {
            return false;
        }
    }

    //Расчет типа удара от оружия
    public function weaponTx($item)
    {
        global $u;

		$tp = 0;
        $itm = $u->lookStats($item['data']);
        //рубящий урон
        $t[2] = round(0+$itm['tya2']);
        //колящий урон
        $t[1] = round(0+$itm['tya1']);
        //дробящий урон
        $t[3] = round(0+$itm['tya3']);
        //режущий урон
        $t[4] = round(0+$itm['tya4']);
        //урон огня
        $t[5] = round(0+$itm['tym1']);
        //урон воды
        $t[7] = round(0+$itm['tym3']);
        //урон земли
        $t[8] = round(0+$itm['tym4']);
        //урон воздуха
        $t[6] = round(0+$itm['tym2']);
        //урон света
        $t[9] = round(0+$itm['tym5']);
        //урон тьмы
        $t[10] = round(0+$itm['tym6']);
        //урон серой магией
        $t[11] = round(0+$itm['tym7']);

        //Мешаем элементы массива

        $inr = array();
        $i = 1;
        while( $i <= 11 ) {
            if( $t[$i] > 0 ) {
                $j = 0;
                while( $j < $t[$i] ) {
                    if( isset($itm['tya'.$i]) && $itm['tya'.$i] > 0 ) {
                        $inr[] = $i;
                        $rk .= '*'.$i.'='.$j.'%*|';
                    }else{
                        $rk .= ''.$i.'='.$j.'%|';
                    }
                    $j++;
                }
            }
            $i++;
        }
        $tp = $inr[rand(0,count($inr)-1)];
        /*if( !isset($itm['tya'.$tp]) || $itm['tya'.$tp] < 1 ) {
            if(isset($item['id'])) {
                $this->error($u->info['id'],'battle::weaponTx. Код ошибки: id предмета: -'.$item['id'].'-b<a href="/logs.php?log='.$this->info['id'].'" target="_blank">'.$this->info['id'].'</a>.(Тип атаки: tya'.$tp.'['.$itm['tya'.$tp].']).(Возможные типы атаки: '.$rk.').(Количество вариантов атак: '.count($inr).')');
            }
        }*/
		//pr($item['id'].' : '.$item['type']);
        //тип от оружия
        if( $item['type'] == 18 ) {
            $tp = 1;
        }elseif( $item['type'] == 19 ) {
            $tp = 2;
        }elseif( $item['type'] == 20 ) {
            $tp = 3;
        }elseif( $item['type'] == 21 ) {
            $tp = 4;
        }else{
            //$tp = 0;
        }
		//pr($tp);

        //}else{
        //	$tp = 12;
        //}
        return $tp;
    }


    //Функция ошибки
    /*public function error($login,$t) {
			mysql_query('INSERT INTO `chat_system` (`text`,`city`,`login`,`to`,`type`,`new`,`time`) VALUES ("<font color=#cb0000>'.mysql_real_escape_string($t).'</font>","capitalcity","<font color=green>СИСТЕМА</font>","'.$login.'","3","1","'.time().'")');
		}*/


    public function domino($itm) {
        $r = 0;
        //0 - inOdet , 1 - class , 2 - class-point , 3 - anti_class , 4 - antic_lass-point	 , 5 - level , 6 level_u
        //15 предметов
        $clss = array(
            1   => 100, //шлем
            2   => 80,  //наручи
            3   => 150, //оружие
            14  => 100, //щит
            5   => 200, //броня
            7   => 50,  //пояс
            17  => 50,  //ботинки
            10  => 80,  //кольцо
            11  => 80,  //кольцо
            12  => 80,  //кольцо
            9   => 100, //амулет
            8   => 100, //серьги
            4   => 50,  //рубаха
            16  => 80,  //поножи
            6   => 50   //плащ
        );
        $r += $clss[$itm[0]];
        if($itm[10] > 0) {
            //екр.предмет
            if($itm[10] < 500) {
                //не артефакт
                $r += $clss[$itm[0]]*0.5;
            }else{
                //артефакт
                $r += $clss[$itm[0]]*0.5;
            }
        }
        return $r;
    }

    public function adomino($itm) {
        $r = 0;
        //0 - inOdet , 1 - class , 2 - class-point , 3 - anti_class , 4 - antic_lass-point	 , 5 - level , 6 level_u
        //15 предметов
        $clss = array(
            1   => 80, //шлем
            2   => 60,  //наручи
            3   => 130, //оружие
            14  => 80, //щит
            5   => 180, //броня
            7   => 30,  //пояс
            17  => 30,  //ботинки
            10  => 50,  //кольцо
            11  => 50,  //кольцо
            12  => 50,  //кольцо
            9   => 80, //амулет
            8   => 80, //серьги
            4   => 30,  //рубаха
            16  => 50,  //поножи
            6   => 30   //плащ
        );
        $r += $clss[$itm[0]];
        return $r;
    }

    public function domino_lvl($r,$lvl,$lvl_itm) {
        if($lvl < $lvl_itm) {
            $r = $r*((50-$lvl+$lvl_itm)/100);
            //расчет урона, если есть добавочные бонусы на подобии екр.вещей \ артефактов, либо легендарных предметов
            $r = ceil($r);
        }
        return $r;
    }

    public function yronLvl($lvl1,$lvl2) {
        $r = array(
            1  => array(0,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200),
            2  => array(0,600,400,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200),
            3  => array(0,1000,800,600,400,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200),
            4  => array(0,1400,1200,1000,800,600,400,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200),
            5  => array(0,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200,200,200,200,200,200,200,200,200),
            6  => array(0,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200,200,200,200,200,200,200),
            7  => array(0,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200,200,200,200,200),
            8  => array(0,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200,200,200),
            9  => array(0,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200),
            10 => array(0,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200),
            11 => array(0,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200),
            12 => array(0,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600),
            13 => array(0,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000),
            14 => array(0,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400),
            15 => array(0,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800),
            16 => array(0,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200),
            17 => array(0,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600),
            18 => array(0,7000,6800,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000),
            19 => array(0,7400,7200,7000,6800,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400),
            20 => array(0,7800,7600,7400,7200,7000,6800,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800),
            21 => array(0,8200,8000,7800,7600,7400,7200,7000,6800,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200)
        );
        $r = floor($r[$lvl1][$lvl2]/100);
        $r = 0;
        return $r;
    }
    //Расчет защиты
    public function zago($v) {
        if($v > 1000) {
            $v = 1000;
        }
        $r = round( (1-( pow(0.5, ($v/250) ) ))*100 , 2 );
        return $r;
    }
    //Расчет защиты (магия)
    public function zmgo($v)
	{
		if($v > 1800) {$v = 1800;}
        $r = ($v >= 250 ? round((1-( pow(0.5, ($v/250) ) ))*100 , 2) : round($v/5, 2));
		return $r;
	}
    //Наличие эффекта у пользователя
	/*public function HasEff($id, $uid)
	{
		$eff  = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem"
		AND `v2`="'.$id.'" AND `uid` = "'.$uid.'" AND `delete` = 0 LIMIT 1'));

        return (isset($eff['id']) ? true : false);
	}*/

    /* Расчет урона */
    public function yrn($st1, $st2, $u1, $u2, $level, $level2, $type, $min_yron, $max_yron, $min_bron, $max_bron, $vladenie, $power_yron, $power_krit, $zashita, $ozashita, $proboi, $weapom_damage, $weapom_min, $weapom_max, $za_proc, $zm_proc, $zashitam , $ozashitam )
	{
        global $u;

        //Поправка
        if( $zashita < 1 ) $zashita = 1;

		//pr('power:'.$level.' : '.$level2.' : '.$type.' : '.$min_yron.' : '.$max_yron.' : '.$power_yron.' : '.$st1['s1'].' : '.$st2['s1']);

        //Параметры для возврвата
        $r = array('min' => 0, 'max' => 0, 'type' => $type);
        $p = array(
            'Y'		=> 0,
            'B'		=> array(0 => 0, 1 => 0, 'rnd' => false),
            'L'		=> $level,
            'W'		=> array($min_yron, $max_yron, 'rnd' => false), //минимальный урон //максимальный урон добавочный
            'U'		=> $vladenie, //владение оружием
            'M'		=> $power_yron, //мощность урона
            'K'		=> $power_krit, //мощность крита
            'S'		=> 1,  //влияние статов на проф.урон
            'T'		=> 1,   //Кф. оружия
            'iT'	=> 1,	//Итоговый доп. Кф. оружия
        );

        //Умножитель 1.33 для двуручки и 1.00 для одной руки
        if ($weapom_damage == 0) { $p['T'] = 1; }elseif($weapom_damage == 1) {$p['T'] = 1.33;$p['iT'] = 1.33;}

        //Расчет типа урона
        //колющий
		if($r['type'] == 1) {		
			//$p['S'] = $st1['s1'] * 0.60 + $st1['s2'] * 0.40;
            $p['S'] = $st1['s1'] * 0.1 + $st1['s2'] * 1.4;
			$p['U'] = $st1['a1'] * 0.1; //кинжалы
			$r['min']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(0.7*$p['U']))*(1+$p['M']/100);//Верно
			$r['max']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(0.7*$p['U']))*(1+$p['M']/100);//Верно
			$r['Kmin']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(0.7*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['Kmax']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(0.7*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['min'] = floor($r['min']);
			$r['max'] = floor($r['max']);
			$r['Kmin'] = floor($r['Kmin']);
			$r['Kmax'] = floor($r['Kmax']);					
						
			//Минимальное значение урона
			$r['min_'] = floor($r['min']*0.2);
			$r['max_'] = floor($r['max']*0.2);
			$r['Kmin_'] = floor($r['Kmin']*0.2);
			$r['Kmax_'] = floor($r['Kmax']*0.2);

	    //рубящий
		}elseif($r['type'] == 2) {		
		    $p['S'] = $st1['s1'] * 0.4 + $st1['s2'] * 0.2 + $st1['s3'] * 0.7;
		    $p['U'] = $st1['a2'] * 0.1; //топоры
			$r['min']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['max']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['Kmin']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['Kmax']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['min'] = floor($r['min']);
			$r['max'] = floor($r['max']);
			$r['Kmin'] = floor($r['Kmin']);
			$r['Kmax'] = floor($r['Kmax']);					
						
			//Минимальное значение урона
			$r['min_'] = floor($r['min']*0.2);
			$r['max_'] = floor($r['max']*0.2);
			$r['Kmin_'] = floor($r['Kmin']*0.2);
			$r['Kmax_'] = floor($r['Kmax']*0.2);

		
		//дробящий
		}elseif($r['type'] == 3) {		
		    $p['S'] = $st1['s1'] * 2.2;//1.0
		    $p['U'] = $st1['a3'] * 0.1; //дубины
			$r['min']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['max']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['Kmin']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['Kmax']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['min'] = floor($r['min']);
			$r['max'] = floor($r['max']);
			$r['Kmin'] = floor($r['Kmin']);
			$r['Kmax'] = floor($r['Kmax']);					
						
			//Минимальное значение урона
			$r['min_'] = floor($r['min']*0.2);
			$r['max_'] = floor($r['max']*0.2);
			$r['Kmin_'] = floor($r['Kmin']*0.2);
			$r['Kmax_'] = floor($r['Kmax']*0.2);

		
		//режущий
		}elseif($r['type'] == 4) {		
		    $p['S'] = $st1['s1'] * 0.3 + $st1['s3'] * 0.7;
		    $p['U'] = $st1['a4'] * 0.1; //мечи
			$r['min']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['max']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['Kmin']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['Kmax']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['min'] = floor($r['min']);
			$r['max'] = floor($r['max']);
			$r['Kmin'] = floor($r['Kmin']);
			$r['Kmax'] = floor($r['Kmax']);					
						
			//Минимальное значение урона
			$r['min_'] = floor($r['min']*0.2);
			$r['max_'] = floor($r['max']*0.2);
			$r['Kmin_'] = floor($r['Kmin']*0.2);
			$r['Kmax_'] = floor($r['Kmax']*0.2);

        
		//Магиечески
        }elseif($r['type'] >= 5){		
		    $p['S'] = $st1['s1'] * 0.5 + $st1['s2'] * 0.5;
            $p['U'] = $st1['mg'.($r['type']-4)]; //магией
			$r['min']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['max']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['Kmin']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['Kmax']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['min'] = floor($r['min']);
			$r['max'] = floor($r['max']);
			$r['Kmin'] = floor($r['Kmin']);
			$r['Kmax'] = floor($r['Kmax']);					
						
			//Минимальное значение урона
			$r['min_'] = floor($r['min']*0.2);
			$r['max_'] = floor($r['max']*0.2);
			$r['Kmin_'] = floor($r['Kmin']*0.2);
			$r['Kmax_'] = floor($r['Kmax']*0.2);

        }else {
            $p['S'] = ($st1['s1']*1); 
			$p['U']=0; // для кулака(нужно переписывать
			$r['min']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['max']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
			$r['Kmin']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['Kmax']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
			$r['min'] = floor($r['min']);
			$r['max'] = floor($r['max']);
			$r['Kmin'] = floor($r['Kmin']);
			$r['Kmax'] = floor($r['Kmax']);					
						
			//Минимальное значение урона
			$r['min_'] = floor($r['min']*0.2);
			$r['max_'] = floor($r['max']*0.2);
			$r['Kmin_'] = floor($r['Kmin']*0.2);
			$r['Kmax_'] = floor($r['Kmax']*0.2);

        }

        if( $st2['s6'] > 40 ) {
            //Если маг воды
            $zashita -= round($zashita-100);
        }

        //Выставление параметров
        $r['bron'] = array($min_bron, $max_bron); //Броня зоны куда бьем
        $r['bron']['rnd'] = ($min_bron+$max_bron)/2;

        $r['za'] = ($zashita>1000 ? 1000 : $zashita); //Защита от урона
        $r['oza'] = $ozashita; //Особенность Защиты от урона

        $r['zm'] = ($zashitam>1800 ? 1800 : $zashitam); //Защита от урона
        $r['ozm'] = $ozashitam; //Особенность Защиты от урона

		//pr($ozashitam);

        //Остальные расчеты
        $p['B'][0] = 5;
        $p['B'][1] = 9;
        $p['B']['rnd'] = rand($p['B'][0],$p['B'][1]);
        $p['W']['rnd'] = rand($p['W'][0],$p['W'][1]);

        //Обычный урон
        //Урон: (базовый урон + уровень + влияние статов + урон оружия*влияние умений)*мощь урона
        //$r['min']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
        //$r['max']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.1*$p['U']))*(1+$p['M']/100);//Верно
		
		//$r['Kmin']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.2*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно
        //$r['Kmax']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.2*$p['U']))*(1+$p['M']/100)*2*(1+$p['K']/100);//Верно

        //Критический урон
        //((1+мф. мощности)*2)*базовый урон
        //$r['Kmin'] = ((($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.07*$p['U']))*(1+($p['K']+$p['M'])/100))*2;//Старая формула
        //$r['Kmax'] = ((($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.07*$p['U']))*(1+($p['K']+$p['M'])/100))*2;//Старая формула

		//$r['Kmin'] = ceil((2 * (1 + $p['K'] / 100)) * $r['min']);
        //$r['Kmax'] = ceil((2 * (1 + $p['K'] / 100)) * $r['max']);
		//(урон*2)+(урон*(мощь крита/100)=крит
        //$r['Kmin'] = ceil(($r['min']) + ($r['min'] * ($p['K'] / 100)));
        //$r['Kmax'] = ceil(($r['max']) + ($r['max'] * ($p['K'] / 100)));

		
        //pr('Krit:'.$r['Kmin'].' : '.$r['Kmax']);
		//pr('U1:'.$u1['id'].' U2:'.$u2['id']);

        //Расчет брони
        //для обычного
	if( $r['type'] < 5) {
		$r['min_abron'] = round($r['min']*0.01);
		$r['max_abron'] = round($r['max']*0.01);

    if($proboi != 0) {
        $r['bron']['rnd'] = floor($r['bron']['rnd']-$proboi);
    }			
		$r['min'] -= $r['bron']['rnd'];
		$r['max'] -= $r['bron']['rnd'];
	if($r['min'] < $r['min_abron']) {
		$r['min'] = $r['min_abron'];
	}
	if($r['max'] < $r['max_abron']) {
		$r['max'] = $r['max_abron'];
	}
					
	//для крита
	    $r['Kmin_abron'] = round($r['Kmin']/2);
		$r['Kmax_abron'] = round($r['Kmax']/2);
		$r['Kmin'] -= $r['bron']['rnd'];
		$r['Kmax'] -= $r['bron']['rnd'];
	if($r['Kmin'] < $r['Kmin_abron']) {
		$r['Kmin'] = $r['Kmin_abron'];
    }
	if($r['Kmax'] < $r['Kmax_abron']) {
		$r['Kmax'] = $r['Kmax_abron'];
	}
}
        //Особенности защиты
        $r['ozash_rnd'] = $r['oza'][$r['type']][1];

        if($r['ozash_rnd'] > 80) { $r['ozash_rnd'] = 80; }
        if($r['ozash_rnd'] < 0) { $r['ozash_rnd'] = 0; }


        $r['ozash_rnd'] = 100-$r['ozash_rnd'];

        $r['min'] -= ($r['min']/(200+$r['ozash_rnd'])*$r['ozash_rnd']);
        $r['max'] -= ($r['max']/(200+$r['ozash_rnd'])*$r['ozash_rnd']);

        $r['Kmin'] -= ($r['Kmin']/(200+$r['ozash_rnd'])*$r['ozash_rnd']);
        $r['Kmax'] -= ($r['Kmax']/(200+$r['ozash_rnd'])*$r['ozash_rnd']);

        $r['bRND'] = $p['B']['rnd'];
        //Расчет защиты (не более 80%)
        if( $r['type'] < 5 ) {
        //pr('Uron1:'.$r['min'].' : '.$r['max'].' za: '.$r['za']);
            $r['min'] = floor($r['min']/100*(100-$this->zago($r['za'])));
            $r['max'] = floor($r['max']/100*(100-$this->zago($r['za'])));
            $r['Kmin'] = floor($r['Kmin']/100*(100-$this->zago($r['za'])));
            $r['Kmax'] = floor($r['Kmax']/100*(100-$this->zago($r['za'])));

        }else{
            $r['min'] = floor($r['min']/100*(100-$this->zmgo($r['zm'])));
            $r['max'] = floor($r['max']/100*(100-$this->zmgo($r['zm'])));
            $r['Kmin'] = floor($r['Kmin']/100*(100-$this->zmgo($r['zm'])));
            $r['Kmax'] = floor($r['Kmax']/100*(100-$this->zmgo($r['zm'])));
        }
        
      
		//Круговая защита и натиск не более 67%!
		if($this->info['izlom']==0 || $this->info['dungeon']==0 || $this->info['battle']==0)
		{
			if($defd > 1 && $defd > $r['max']*0.67) $eff1  = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem"
			AND `v2`="342" AND `uid` = "'.$u2['id'].'" AND `delete` = 0 LIMIT 1'));

			if($powd > 1 && $powd > $r['max']*0.67) $eff2  = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem"
			AND `v2`="343" AND `uid` = "'.$u1['id'].'" AND `delete` = 0 LIMIT 1'));

			if(isset($eff1['id'])) $defd = $r['max']*0.67;
            if(isset($eff2['id'])) $powd = $r['max']*0.67;
			
			$defd = floor($defd - $powd);
		} else $defd = 0;

        //if(isset($eff1['id']) || isset($eff2['id']))pr($r['min'],'rmin1');
        //if(isset($eff1['id']) || isset($eff2['id']))pr($r['max'],'rmax1');

		$r['min'] -= $defd;
        $r['max'] -= $defd;
        $r['Kmin'] -= $defd*2;
        $r['Kmax'] -= $defd*2;
        $r['min_'] -= $defd;
        $r['max_'] -= $defd;
        $r['Kmin_'] -= $defd*2;
        $r['Kmax_'] -= $defd*2;

        //if(isset($eff1['id']) || isset($eff2['id']))pr($r['min'],'rmin2');
        //if(isset($eff1['id']) || isset($eff2['id']))pr($r['max'],'rmax2');

        //$min_yrn = 0; //%

		//if( $r['type'] >= 5 ) {
            //$min_yrn += $zm_proc;
        //}else{
            //$min_yrn += $za_proc;
        //}
		//pr($u->stats['zm']);

        //if( $st2['yza'] != 0 ) {
        if( $r['type'] >= 5 ) {
            $r['min'] -= floor($r['min']/100*$st2['yzm']);
            $r['max'] -= floor($r['max']/100*$st2['yzm']);
            $r['Kmin'] -= floor($r['Kmin']/100*$st2['yzm']);
            $r['Kmax'] -= floor($r['Kmax']/100*$st2['yzm']);
            $r['min_'] -= floor($r['min_']/100*$st2['yzm']);
            $r['max_'] -= floor($r['max_']/100*$st2['yzm']);
            $r['Kmin_'] -= floor($r['Kmin_']/100*$st2['yzm']);
            $r['Kmax_'] -= floor($r['Kmax_']/100*$st2['yzm']);
        }else{
            $r['min'] -= floor($r['min']/100*$st2['yza']);
            $r['max'] -= floor($r['max']/100*$st2['yza']);
            $r['Kmin'] -= floor($r['Kmin']/100*$st2['yza']);
            $r['Kmax'] -= floor($r['Kmax']/100*$st2['yza']);
            $r['min_'] -= floor($r['min_']/100*$st2['yza']);
            $r['max_'] -= floor($r['max_']/100*$st2['yza']);
            $r['Kmin_'] -= floor($r['Kmin_']/100*$st2['yza']);
            $r['Kmax_'] -= floor($r['Kmax_']/100*$st2['yza']);
        }

        /* if($r['type'] == 3) $min_yrn -= 20;

        $r['min'] -= floor($r['min']/100*$min_yrn);
        $r['max'] -= floor($r['max']/100*$min_yrn);
        $r['Kmin'] -= floor($r['Kmin']/100*$min_yrn);
        $r['Kmax'] -= floor($r['Kmax']/100*$min_yrn);
        $r['min_'] -= floor($r['min_']/100*$min_yrn);
        $r['max_'] -= floor($r['max_']/100*$min_yrn);
        $r['Kmin_'] -= floor($r['Kmin_']/100*$min_yrn);
        $r['Kmax_'] -= floor($r['Kmax_']/100*$min_yrn); */

		//Премиум
        /* $premium = mysql_fetch_array(mysql_query('SELECT `mf_yron` FROM `premium` WHERE `uid` = "'.$u1['id'].'" AND `time_delete`>"'.time().'"'));
        if(isset($premium['mf_yron']) && $premium['mf_yron']>0)
		{
			$r['min'] 	= round($r['min']+($r['min']/100)*$premium['mf_yron']);
	        $r['max'] 	= round($r['max']+($r['max']/100)*$premium['mf_yron']);
	        $r['Kmin'] 	= round($r['Kmin']+($r['Kmin']/100)*$premium['mf_yron']);
	        $r['Kmax'] 	= round($r['Kmax']+($r['Kmax']/100)*$premium['mf_yron']);
	        $r['min_'] 	= round($r['min_']+($r['min_']/100)*$premium['mf_yron']);
	        $r['max_'] 	= round($r['max_']+($r['max_']/100)*$premium['mf_yron']);
	        $r['Kmin_'] = round($r['Kmin_']+($r['Kmin_']/100)*$premium['mf_yron']);
	        $r['Kmax_'] = round($r['Kmax_']+($r['Kmax_']/100)*$premium['mf_yron']);
		} */

		//Урон за рейтинг
		/* $uron_clan_r = 0;
		$clan_r = mysql_fetch_array(mysql_query('SELECT `pos` FROM `clan_rating` WHERE `clan` = "'.$u1['clan'].'" AND `date` = "'.date('dmY').'" LIMIT 1'));
		if(isset($clan_r['pos']))
		{
			if($clan_r['pos']==1) {$uron_clan_r = 10;}
			elseif($clan_r['pos']==2) {$uron_clan_r = 5;}
	    	elseif($clan_r['pos']==3) {$uron_clan_r = 3;}

			if($uron_clan_r>0)
			{
				$r['min'] 	= round($r['min']+($r['min']/100)*$uron_clan_r);
		        $r['max'] 	= round($r['max']+($r['max']/100)*$uron_clan_r);
		        $r['Kmin'] 	= round($r['Kmin']+($r['Kmin']/100)*$uron_clan_r);
		        $r['Kmax'] 	= round($r['Kmax']+($r['Kmax']/100)*$uron_clan_r);
		        $r['min_'] 	= round($r['min_']+($r['min_']/100)*$uron_clan_r);
		        $r['max_'] 	= round($r['max_']+($r['max_']/100)*$uron_clan_r);
		        $r['Kmin_'] = round($r['Kmin_']+($r['Kmin_']/100)*$uron_clan_r);
		        $r['Kmax_'] = round($r['Kmax_']+($r['Kmax_']/100)*$uron_clan_r);
			}
		} */
		///pr('uron_r:'.$uron_clan_r.' : '.$u2['clan']);


        /* if( $r['min'] < 1 ) {
            $r['min'] = 1;
        }
        if( $r['Kmax'] < 1 ) {
            $r['Kmax'] = 1;
        }
        if( $r['min_'] < 1 ) {
            $r['min_'] = 1;
        }
        if( $r['min_'] < 1 ) {
            $r['max_'] = 1;
        }

        if( $r['Kmin'] < 2 ) {
            $r['Kmin'] = 2;
        }
        if( $r['Kmax'] < 2 ) {
            $r['Kmax'] = 2;
        }
        if( $r['Kmin_'] < 2 ) {
            $r['Kmin_'] = 2;
        }
        if( $r['Kmin_'] < 2 ) {
            $r['Kmax_'] = 2;
        } */

        if( $r['min'] > 1 ) {
            $r['min'] += $st1['maxAtack'];
            $r['max'] += $st1['maxAtack'];
            $r['Kmin'] += $st1['maxAtack']*0.2;
            $r['Kmin'] += $st1['maxAtack']*0.2;
        }

        $r['m_k'] = $r['Kmax'];

		if($this->stats[$this->uids[$u1['id']]]['m10p'] > 0)//подавление урона
		{
            $r['min']  = round($r['min']/100 * (100-$this->stats[$this->uids[$u1['id']]]['m10p']));
            $r['max']  = round($r['max']/100 * (100-$this->stats[$this->uids[$u1['id']]]['m10p']));
            $r['Kmin']  = round($r['Kmin']/100 * (100-$this->stats[$this->uids[$u1['id']]]['m10p']));
            $r['Kmax']  = round($r['Kmax']/100 * (100-$this->stats[$this->uids[$u1['id']]]['m10p']));
		}

		if($this->users[$this->uids[$u2['id']]]['bot_id']==291)//Отморозок
		{
            $r['min']  = 1;
            $r['max']  = 1;
            $r['Kmin']  = 2;
            $r['Kmax']  = 2;
		}


        return $r;
    }

    public $pr_not_use = array(),$pr_reset = array(),$pr_yrn = false,$prnt = array();
    //Завершение действия приема
    // pl прием
    // u1 инфа юзера
    // t1 тип снятия
    // 99 = очищение кровью
    // u2
    //$this->delPriem($pd[$k2][1][$k],${'p'.$k2},1,${'p'.$k2jn});
    public $del_val = array(),$re_pd = array();
    public function delPriem($pl,$u1,$t = 1,$u2 = false,$rznm = 'Очиститься Кровью',$k2nm=0,$yrn=0,$yrnt=0)
    {
        global $u,$priem, $c;

        if(isset($pl['priem']['id']) && !isset($this->del_val['eff'][$pl['priem']['id']]))
        {
			if($pl['x'] > 1) {
                $pl['name'] = $pl['name'].' x'.$pl['x'].'';
            }
            if($pl['timeUse']==77 or $t==98)
            {
                //завершаем прием
				//pr('удален: '.$pl['name']);//dg;
                mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
            }
            $vLog = 'time1='.time().'||s1='.$u1['sex'].'||t1='.$u1['team'].'||login1='.$u1['login'].'';
            if(isset($u2['id']))
			{
                $vLog .= '||s2='.$u2['sex'].'||t2='.$u2['team'].'||login2='.$u2['login'].'';
            }
            $mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
            if($t==4)
            {
                $mas1['id_hod']++;
                $t = 2;
            }
            if($t==1)
            {
                $mas1['id_hod']++;
                if($pl['priem']['file']!='0')
                {
                    if(file_exists('../../_incl_data/class/priems/'.$pl['priem']['file'].'.php'))
                    {
                        require('priems/'.$pl['priem']['file'].'.php');
                    }
                }elseif($pl['priem']['file3']!='0')
                {
                    if(file_exists('../../_incl_data/class/priems/'.$pl['priem']['file3'].'.php'))
                    {
                        require('priems/'.$pl['priem']['file3'].'.php');
                    }
                }else{
                    $mas1['text'] = '{tm1} {u1} {1x16x0} прием &quot;<b>'.$pl['name'].'</b>&quot;.';
                    $this->del_val['eff'][$pl['priem']['id']] = true;
                }
            }
			elseif($t==2)
            {
                $mas1['text'] = '{tm1} У персонажа {u1} закончилось действие магии &quot;<b>'.$pl['name'].'</b>&quot;.';
            }
			elseif($t==98)
			{//Подавление приемов противника нашим приемом, например, Обреченностью
                $mas1['id_hod']++;
            }
			elseif($t==99)
			{
                $mas1['text'] = '{u1} Снял эфект &quot;<b>'.$pl['name'].'</b>&quot; с помощью <b>'.$rznm.'</b> .';
            }else{
                if( $t == 100 ) {
                    $mas1['id_hod']++;
                }
                $mas1['text'] = '{tm1} Закончилось действие эффекта &quot;<b>'.$pl['name'].'</b>&quot; для {u1}.';
            }
            if( $pl['priem']['id'] != 24 ) {
                $this->add_log($mas1);
            }
            
            $this->stats[$this->uids[$pl['uid']]] = $u->getStats($pl['uid'],0,0,false,false,true);//не раб приемы из-за этой строки??
            //dvar($this->stats[$this->uids[$pl['uid']]]);//$this->stats[$this->uids[$pl['uid']]]
        }else{
            //не удалось удалить прием или эффект
        }
    }

    public function hodUserPriem($pl,$u1,$t = 1,$u2 = false,$rznm = 'Очиститься Кровью',$k2nm,$yrn,$yrnt)
    {
        global $u,$priem;
        if(isset($pl['priem']['id']) && !isset($this->del_val['eff'][$pl['priem']['id']]))
        {
            if($yrnt == 1)
            {
                //обычный удар
                $yrn = round($yrn);
            }elseif($yrnt == 6)
            {
                //противник увернулся от удара
                $yrn = 0;
            }elseif($yrnt == 9)
            {
                //противник парировал удар
                $yrn = 0;
            }elseif($yrnt == 3)
            {
                //вы нанесли крит-удар
                $yrn = round($yrn*0.1)+ceil($yrn/100*$this->stats[$this->uids[$u1['id']]]['m3']);
            }elseif($yrnt == 4)
            {
                //вы нанесли крит-удар через блок
                $yrn = round($yrn*0.1)+ceil($yrn/100*$this->stats[$this->uids[$u1['id']]]['m3']);
            }else{
                //неизвестный удар
                $yrn = 0;
            }

            if($pl['x'] > 1) {
                $pl['name'] = $pl['name'].' x'.$pl['x'].'';
            }
            $vLog = 'time1='.time().'||s1='.$u1['sex'].'||t1='.$u1['team'].'||login1='.$u1['login'].'';
            if(isset($u2['id'])) {
                $vLog .= '||s2='.$u2['sex'].'||t2='.$u2['team'].'||login2='.$u2['login'].'';
            }
            $mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
            if($t==4)
            {
                $mas1['id_hod']++;
                $t = 2;
            }if($t==1)
        {
            $mas1['id_hod']++;
            if($pl['priem']['file']!='0')
            {
                if(file_exists('../../_incl_data/class/priems/'.$pl['priem']['file'].'.php'))
                {
                    require('priems/'.$pl['priem']['file'].'.php');
                }
            }else{
                $mas1['text'] = '{tm1} {u1} {1x16x0} прием &quot;<b>'.$pl['name'].'</b>&quot;.';
                $this->del_val['eff'][$pl['priem']['id']] = true;
            }
        }
            $this->add_log($mas1);
            $this->stats[$this->uids[$pl['uid']]] = $u->getStats($pl['uid'],0,0,false,false,true);
        }else{
            //не удалось удалить прием или эффект
        }
    }

    //расчет защиты
    public function aPower($za,$za1,$yrn)
    {
        $z = 0;
        $z = (1-( pow(0.5, (($za+$za1)/250) ) ))*100;
        return $z;
    }

    //расчет брони
    public function bronGo($min,$max)
    {
        $v = 0;
        $v = ceil($min,$max);
        return $v;
    }

    //расчет брони (test)
    public function bronGoTest($min,$max)
    {
        $v = 0;
        $v = ceil(round($min,$max));
        return $v;
    }

    //Разбираем массив со статами
    public function lookStats($m)
    {
        $ist = array();
        $di = explode('|',$m);
        $i = 0; $de = false;
        while($i<count($di))
        {
            $de = explode('=',$di[$i]);
            $ist[$de[0]] = $de[1];
            $i++;
        }
        return $ist;
    }

    //Расчет зависимости уворота
    public function mfsgo1($a,$b) {

        $r = $this->form_mf($a,$b);
        return $r;
    }

    //Расчет зависимости крита
    public function mfsgo2($a,$b) {

        $r = $this->form_mf($a,$b);
        return $r;
    }

    //Расчет мф. (новая)
    public function form_mf($u,$au) {
        $v = $u - $au;
        if($v < 0) {
            $v = 0;
        } //testtest
        $r = (1-( pow(rand(89,90)/100, (($v)/100) ) ))*100;
        $r = round($r);
        return $r;
    }

    //Ступеньчатая формула (уворот)
    public function msf_st( $mf , $lvl1 , $lvl2 ) {
        $r = 0;

        if($lvl1 > $lvl2) {
            $lvl = $lvl1;
        }else{
            $lvl = $lvl2;
        }

        /*
			1-ый: от 0 до 100 - линейное изменение шанса от 0 до 25%
			2-ой: от 101 до 400 - линейное изменение шанса от 35% до 70%
			3-ий: от 401 до 1000 - линейное изменение шанса от 70% до 85%
			4-ый: свыше 1000 - 85% + 0,01 * (разница У и АУ - 1000)
			*/
        /* Шпаргалочка для улучшения баланса. 150 АУ у слабых критов, 350 у топовых.

			АУ	У 	Разница	Процент
			75	750	675	85
			100	750	650	70
			150	750	600
			200	750	550	55

			300	750	450	50
			350	750	400	50

			Было 700 у, поправил 750 и соотвественно разницу. Посмотрим как будут убивать У.
			*/

        if( $mf < 0 ) {
            $mf = 0;
        }
        //турнир
        if( $lvl <= 7 ) {
            //Баланс 0-7 уровня
            if( $mf <= 300 ) { //0-60
                $prc = $mf;
                $r = 35/300*$prc;
            }elseif( $mf <= 600 ) { //60-70
                $prc = $mf-375;
                $r = $prc/349*10;
                $r += 35;
            }elseif( $mf <= 775 ) { //70-75
                $prc = $mf-601;
                $r = $prc/175*5;
                $r += 55;
            }else{ //> 85
                $r = 70;
                //$r = 85 + 0.01 * abs(($mf-1000));
            }
        }elseif( $lvl <= 8 ) {
            //Баланс 0-7 уровня
            if( $mf <= 300 ) { //0-60
                $prc = $mf;
                $r = 60/300*$prc;
            }elseif( $mf <= 600 ) { //60-70
                $prc = $mf-375;
                $r = $prc/349*10;
                $r += 70;
            }elseif( $mf <= 775 ) { //70-75
                $prc = $mf-601;
                $r = $prc/175*5;
                $r += 80;
            }else{ //> 85
                $r = 76;
                //$r = 85 + 0.01 * abs(($mf-1000));
            }
        }elseif( $lvl <= 9 ) {
            //Баланс 0-7 уровня
            if( $mf <= 300 ) { //0-60
                $prc = $mf;
                $r = 60/300*$prc;
            }elseif( $mf <= 600 ) { //60-70
                $prc = $mf-375;
                $r = $prc/349*10;
                $r += 70;
            }elseif( $mf <= 775 ) { //70-75
                $prc = $mf-601;
                $r = $prc/175*5;
                $r += 80;
            }else{ //> 85
                $r = 76;
                //$r = 85 + 0.01 * abs(($mf-1000));
            }
        }elseif( $lvl <= 10 ) {
            //Баланс 0-7 уровня
             if( $mf <= 300 ) { //0-60
                $prc = $mf;
                $r = 60/300*$prc;
            }elseif( $mf <= 600 ) { //60-70
                $prc = $mf-375;
                $r = $prc/349*10;
                $r += 70;
            }elseif( $mf <= 775 ) { //70-75
                $prc = $mf-601;
                $r = $prc/175*5;
                $r += 80;
            }else{ //> 85
                $r = 76;
                //$r = 85 + 0.01 * abs(($mf-1000));
            }
        }elseif( $lvl <= 11 ) {
            //Баланс 0-7 уровня
            if( $mf <= 300 ) { //0-60
                $prc = $mf;
                $r = 60/300*$prc;
            }elseif( $mf <= 600 ) { //60-70
                $prc = $mf-375;
                $r = $prc/349*10;
                $r += 70;
            }elseif( $mf <= 775 ) { //70-75
                $prc = $mf-601;
                $r = $prc/175*5;
                $r += 80;
            }else{ //> 85
                $r = 76;
                //$r = 85 + 0.01 * abs(($mf-1000));
            }
        }/* else{
            //Баланс всех остальных уровней
            Шпаргалочка для улучшения баланса. 150 АУ у слабых критов, 350 у топовых.

			АУ	У 	Разница	Процент
			50	950		1000	85
			100	950		850
			150	950		800
			250	950		700	80

			300	950		650	75
			400	950		550	70


			Пробуем разница 100 между У и АУ - шанс 50, остальное попасть нереально. Позже искусственно завышаем АУ танку при размене.
			
            if( $mf <= 250 ) { //0-35
                $prc = $mf;
                $r = 35/250*$prc;
            }elseif( $mf <= 600 ) { //35-50
                $prc = $mf-251;
                $r = $prc/349*15;
                $r += 35;
            }elseif( $mf <= 800 ) { //50-70
                $prc = $mf-601;
                $r = $prc/199*20;
                $r += 50;
            }else{ //> 85
                $r = 75;
            }
        } */
        if($r < 0) {
            $r = 0;
        }
        return floor($r);
    }

    //Расчет МФ
    public function mfs($type, $mf)
    {
		$rval = 0;
        switch($type)
		{
            case 1:
                if($mf['amf'] < 1){ $mf['amf'] = 1; }
                if($mf['mf'] < 1){ $mf['mf'] = 1; }
				//$rval = min( (( 1 - ( ( $mf['amf']*0.8 + 50 ) / ( $mf['mf']*0.8 + 50 ) ) ) * 100), 80); //Крит. удар
                $rval = min( (( 1 - ( ( $mf['amf']*0.1 + 50 ) / ( $mf['mf']*0.1 + 50 ) ) ) * 100), 80); //Крит. удар
                if($rval < 1) {$rval = 0;}
                //elseif($rval > 80) {$rval = 80;}
                //pr ('krit: amf:'.$mf['amf'].' mf: '.$mf['mf']);
            break;
            /* case 7:
                if($mf['amf'] < 1){ $mf['amf'] = 1; }
                if($mf['mf'] < 1){ $mf['mf'] = 1; }
                $rval = min( (( 1 - ( ( $mf['amf']*0.1 + 50 ) / ( $mf['mf']*0.1 + 50 ) ) ) * 100), 15); //Крит. удар в парир
				if($rval < 1) {$rval = 0;}
                elseif($rval > 10) {$rval = 15;}
                //pr ('krit v parir: amf:'.$mf['amf'].' mf: '.$mf['mf'].' rval:'.$rval);
            break; */
            case 2:
                if($mf['amf'] < 1){ $mf['amf'] = 1; }
                if($mf['mf'] < 1){ $mf['mf'] = 1; }
                //$rval = min( ( ( 1 - ( ( $mf['amf']*0.8 + 50 ) / ( $mf['mf']*0.8 + 50 ) ) ) * 100 ), 80 ); //Уворот - оргинал
                //$rval = min( ( ( 1 - ( ( $mf['amf']*0.7 + 50 ) / ( $mf['mf']*1.2 + 50 ) ) ) * 100 ), 95 ); //Уворот
                $rval = min( ( ( 1 - ( ( $mf['amf']*0.7 + 50 ) / ( $mf['mf']*1.3 + 50 ) ) ) * 100 ), 95 ); //Уворот
                if($rval < 1) {$rval = 0;}
				//pr ('uvorot:'.$rval.'% m4: '.$mf['mf'].' m5: '.$mf['amf']);//dg
                
            break;
		    case 3:				
				if($mf[1] < 1){ $mf[1] = 1; }
				if($mf[2] < 1){ $mf[2] = 1; }
				if( $this->stats[$this->uids[$mf['u1']]]['items'][$this->stats[$this->uids[$mf['u1']]]['wp3id']]['type'] == 18 )
				{
					$rvar += floor($mf[1]);
				}
				$rval = round(($mf[1]-($mf[2]/2)));//Парирование
				if( $rval < 1 ) {$rval = 0;}
				elseif( $rval > 50 ) {$rval = 50;}
				$rnd1 = rand(0,100);
				if( $rval < $rnd1 ) {$rval = 0;}
                //pr ('parir: '.$rval.'% mf2:'.$mf[2].' mf1: '.$mf[1].'<br>');//dg
			break;
            case 4:
                $mf = round($mf*0.6);
                if($mf < 1){ $mf = 0; }
                if($mf > 100){ $mf = 100; }
                $rval = min( $mf , 100 ); //пробой брони
            break;
            case 5:
                if($mf < 1){ $mf = 0; }
                $rval = min( $mf, 40 ); //блок щитом
				//pr ('block:'.$rval);
            break;
            case 6:
                $mf = round($mf*0.8);//было 0.8
                if($mf < 1){ $mf = 0; }
                if($mf > 80){ $mf = 80; }
                $rval = min( $mf , 80 ); //Контрудар
                //pr ('Contra rval:'.$rval.' m6: '.$mf.'<br>');//dg
            break;
        }

        if($this->get_chanse_new($rval) == true) {$rval = 1;}//$this->get_chanse($rval)
		else{$rval = 0;}

        return $rval;
    }

	//Приемы до МФ
	public function PriemDoMf($uid)
	{
		$eff  = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem"
		AND `v2` IN ("215", "48", "8", "49", "10") AND `uid` = "'.$uid.'" AND `delete` = 0 LIMIT 1'));

        return (isset($eff['id']) ? true : false);
	}

    public function dodge($a, $b)
	{
        $i = 0;
        $arr = array();     //массив для записи уникальных случайных чисел
        while($i < ($b - $a)) {
            while(in_array($rand, $arr)) {
                $rand = mt_rand(1, 100);
            }
            $arr[] = $rand;
            $i++;
        }

        $n = mt_rand(1, 100);
        return(array_search($n, $arr));
    }

    public function get_chanse($percent)
    {
        $a = 101+$percent;
        $b = 100-$percent;
        $i = 1;
        if(($a-$b)>0)
		{
            while($i<=$a-$b)
			{
                $conp[] = rand(1,100);
                //$conp[] = mt_rand(1,100);
                if( $i > 1000 )
				{
                    $i = ($a-$b+1);
                }
                $i++;
            }
        }

		$t = count($conp);
        $prob = round($percent);
        if(@array_search($prob,$conp)!=false)
		{
            $critical = true;
        }else{
            $critical = false;
        }

        return $critical;
    }

    //Расчет шанса
    public function get_chanse_new($persent)
    {
        $mm = 1;
        if(rand($mm,100*$mm)<=$persent*$mm)
        {
            return true;
        }else{
            return false;
        }
    }

    //Смена противника
    public function smena($uid,$auto = false,$lastdie = false)
    {
        global $u;
		
        if($this->stats[$this->uids[$u->info['id']]]['nosmena']==0)
		{
	        if(($auto == false && $u->info['smena'] > 0) || $auto == true)
			{
	            if($this->stats[$this->uids[$u->info['id']]]['hpNow']>=1)
	            {
	                if(isset($this->uids[$uid]) && $uid!=$u->info['id'] && $this->users[$this->uids[$uid]]['team']!=$this->users[$this->uids[$u->info['id']]]['team'])
	                {
	                    if(!isset($this->ga[$u->info['id']][$uid]) || $lastdie == true)
	                    {
	                        if(ceil($this->stats[$this->uids[$uid]]['hpNow'])>=1)
	                        {
	                            //меняем противника
	                            if($auto == false) {
	                                $u->info['smena']--;
	                            }
	                            $upd = mysql_query('UPDATE `stats` SET `enemy` = "'.$uid.'",`smena` = "'.$u->info['smena'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	                            $u->info['enemy'] = $uid;
	                            $this->users[$this->uids[$uid]]['smena'] = $u->info['smena'];
	                            $this->users[$this->uids[$u->info['id']]]['enemy'] = $uid;
	                            return 1;
	                        }else{
	                            return 'Нельзя сменить, противник уже мертв';
	                        }
	                    }else{
	                        return 'Нельзя сменить на выбранную цель!';
	                    }
	                }else{
	                    return 'Нельзя сменить на выбранную цель!';
	                }
	            }else{
	                return 'Для вас поединок закончен, ожидайте пока завершат другие...';
	            }
	        }else{
	            return 'У вас закончились смены противника';
	        }
    	} else return 'Вы не можете сменить противника (Преследование)';
	}

    //авто-смена противника
    public function autoSmena()
    {
        global $u;
        $ms = array();
        $ms_all = array();
        $i = 0; $j = 0;
        while($i<count($this->users))
        {
            if(isset($this->users[$i]) && $this->users[$i]['id']!=$u->info['id'] && $this->users[$i]['team']!=$u->info['team'] && $this->stats[$i]['hpNow']>=1 && -($u->info['enemy']) != $this->users[$i]['id'])
            {
                if(!isset($this->ga[$u->info['id']][$this->users[$i]['id']]))
                {
                    $ms[$j] = $this->users[$i]['id'];
                    $j++;
                }
                if( !isset($this->uids[(-($u->info['enemy']))]) ) {
                    $ms_all[] = $this->users[$i]['id'];
                }
            }
            $i++;
        }
        $msh = array();
        if( $j == 0 ) {

            $enemydie = 0;

            if( isset($this->stats[$this->uids[$u->info['enemy']]]) ) {
                $u->info['enemy'] = 0;
                $enemydie = 1;
            }

            if( (!isset($this->uids[(-($u->info['enemy']))]) || $this->stats[$this->uids[(-($u->info['enemy']))]]['hpNow'] < 1) && ( $u->info['enemy'] < 0 || $enemydie == 1 ) ) {
                $i = 0; $j = 0;
                while($i<count($this->users))
                {
                    if(isset($this->users[$i]) && $this->users[$i]['id']!=$u->info['id'] && $this->users[$i]['team']!=$u->info['team'] && $this->stats[$i]['hpNow']>=1 && -($u->info['enemy']) != $this->users[$i]['id'])
                    {
                        $ms[$j] = $this->users[$i]['id'];
                        $msh[$ms[$j]] = true;
                        $j++;
                    }
                    $i++;
                }
            }
        }

        $ms = $ms[rand(0,$j-1)];
        if($j > 0) {
            if( isset($msh[$ms]) ) {
                $this->smena($ms,true,true);
            }else{
                $this->smena($ms,true);
            }
        }else{
            if( $u->info['enemy'] < 0 ) {
                $smnr5 = $this->smena(-($u->info['enemy']),true);
                if( $smnr5 != 1 ) {
                    if( !isset($this->uids[(-($u->info['enemy']))]) ) {
                        $u->info['enemy'] = $ms_all[rand(0,(count($ms_all)-1))];
                        mysql_query('UPDATE `stats` SET `enemy` = "'.$u->info['enemy'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
                    }
                }
                unset($smnr5);
            }
        }
    }

    //Действия бота (атака)
    public function botAtack($uid,$pl,$tp)
    {
        //$pl - удар
        $test_atack = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_act` WHERE `battle` = "'.$this->info['id'].'" AND ((
				`uid1` = "'.$pl.'" AND `uid2` = "'.$uid.'"
			) OR (
				`uid2` = "'.$pl.'" AND `uid1` = "'.$uid.'"
			)) LIMIT 1'));
        if($tp==1 && !isset($test_atack['id']))
        {
            $a = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
            $b = rand(1,5);
            $minitime = round(microtime(true) * 1000);
            $d = mysql_query('INSERT INTO `battle_act` (`battle`,`time`,`minitime`,`uid1`,`uid2`,`a1`,`b1`)
			VALUES ("'.$this->info['id'].'","'.time().'","'.$minitime.'","'.$pl.'","'.$uid.'","'.$a.'","'.$b.'")');
        }elseif($tp==2)
        {
            //бот отвечает на удар
            $bot = $this->users[$this->uids[$pl['uid2']]];
            $na = array('id'=>0,'a'=>array(1=>0,2=>0,3=>0,4=>0,5=>0),'b'=>0);
            $a222 = rand(1,5).'_'.rand(1,5).'_'.rand(1,5).'_'.rand(1,5).'_'.rand(1,5);
            $a = explode('_',$a222);
            $i = 1;
            $na['id'] = time();
            while($i<=5)
            {
                if(isset($a[$i-1]))
                {
                    $a[$i-1] = intval(round($a[$i-1]));
                    if($a[$i-1]>=1 && $a[$i-1]<=5)
                    {
                        $na['a'][$i] = $a[$i-1];
                    }else{
                        $na['a'][$i] = 0;
                    }
                }
                $i++;
            }
            $na['b'] = rand(1,5);
            //Проводим удар
            $this->atacks[$pl['id']]['a2'] = $a222;
            $this->atacks[$pl['id']]['b2'] = $na['b'];
            $this->startAtack($pl['id']);
        }
    }

    //Проверяем удары, приемы, свитки, зверей
    public function testActions()
    {
		global $c;//, $u;

		$save_time3 = false;
        if($save_time3) dStart();//dg
		//проверяем удары
        $m = mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$this->info['id'].'" ORDER BY `id` ASC LIMIT 100');
        if($save_time3) dStart();//dg
        $i = 0;
        $botA = array();
        $botR = array();
        while($pl = mysql_fetch_array($m))
        {
            mysql_query('DELETE FROM `battle_act` WHERE `battle` = "'.$this->info['id'].'" AND `uid1` = "'.$pl['uid2'].'" AND `uid2` = "'.$pl['uid1'].'"');
            if($this->stats[$this->uids[$pl['uid1']]]['hpNow']<=0 || $this->stats[$this->uids[$pl['uid2']]]['hpNow']<=0)
            {
                mysql_query('DELETE FROM `battle_act` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
            }
			elseif($pl['time']+$this->info['timeout']>time())
            {
                //удар не пропущен по тайму, просто заносим данные
                $this->atacks[$pl['id']] = $pl;
                $this->ga[$pl['uid1']][$pl['uid2']] = $pl['id'];
                $this->ag[$pl['uid2']][$pl['uid1']] = $pl['id'];
                if(isset($this->iBots[$pl['uid1']]))
                {
                    //ударил бот и нет ответа
                    $botA[$pl['uid1']] = $pl['id'];
                }
				elseif(isset($this->iBots[$pl['uid2']]))
                {
                    //ударили бота и он не ответил
                    $botR[$pl['uid2']] = $pl['id'];
                    if( $this->users[$this->uids[$pl['uid2']]]['timeGo'] < time() ) {
                        $this->botAtack($pl['uid1'],$pl,2);
                    }
                }
            }else{
                //пропуск по тайму
                /*if($pl['a1']==0 && $pl['a2']==0)
                {
                    //игрок 1 пропустил по тайму
                    $pl['out1'] = time();
                    $pl['tout1'] = 1;
                    //игрок 2 пропустил по тайму
                    $pl['out2'] = time();
                    $pl['tout2'] = 1;
                }
				else*/
				if($pl['a1']==0)
                {
                    //игрок 1 пропустил по тайму
                    $pl['out1'] = time();
                    $pl['tout1'] = 1;
                }
				/*else*/
				if($pl['a2']==0)
                {
                    //игрок 2 пропустил по тайму
                    $pl['out2'] = time();
                    $pl['tout2'] = 1;
                }
                //наносим удар по пропуску
                $this->atacks[$pl['id']] = $pl;
                $this->startAtack($pl['id']);
            }
        }

        //тест удара
		if($save_time3) dStart();//dg
        if($this->uAtc['id']>0)
        {
            if($this->na==1)
            {
                if( $pl['out1'] == 0 && $pl['out2'] == 0 )//Может разменяться только тот кто бил
				{
					if( $pl['uid1'] == $u->info['id'] || $pl['uid2'] == $u->info['id'] ) $this->addNewAtack();
                } else $this->addNewAtack();
            }
        }
        if($save_time3) dStart();//dg

		//тест использования заклятий
        //тест использования приемов

        //тест, бот делает удары
        $i = 0;
        while($i<count($this->bots))
        {
            $bot = $this->bots[$i];
            if(isset($bot) && $this->stats[$this->uids[$bot]]['hpNow'] >= 1)
            {
                //mysql_query('UPDATE `stats` SET `timeGo` = "'.$tnbot.'" WHERE `id` = "'.$this->users[$this->uids[$bot]]['id'].'" LIMIT 1');
                $j = 0;
                while($j<count($this->users))
                {
                    //$tnbot = time() + rand(3,10);
                    if( $this->info['razdel'] == 0 ) $tnbot = time(); // время размена пещерных ботов
                    else $tnbot = time() + rand(4,8); //время размена хаот. ботов

                    if( $this->users[$j]['timeGo'] >= time() || $this->users[$this->uids[$bot]]['timeGo'] >= time() )
					{
                    }
					elseif($this->users[$j]['hpNow'] >= 1 && $this->users[$this->uids[$bot]]['team'] != $this->users[$j]['team'])
					{
                        if(isset($this->users[$j]) && $this->stats[$j]['hpNow']>=1 && $this->stats[$this->uids[$bot]]['hpNow']>=1
						&& !isset($this->ga[$bot][$this->users[$j]['id']]) && !isset($this->ag[$bot][$this->users[$j]['id']])
						&& $this->users[$j]['id']!=$bot && $this->users[$j]['team']!=$this->users[$this->uids[$bot]]['team'])
                        {
                            if($this->users[$j]['timeGo'] < time() && $this->users[$this->uids[$bot]]['timeGo']<time()) {
                                $this->botAtack($this->users[$j]['id'],$bot,1);
                                mysql_query('UPDATE `stats` SET `timeGo` = "'.$tnbot.'" WHERE `id` = "'.$this->users[$this->uids[$bot]]['id'].'" LIMIT 1');
                            }
                        }
						elseif(isset($this->users[$i]) && $this->users[$i]['bot']>0 && $this->stats[$i]['hpNow']>=1
						&& $this->stats[$this->uids[$bot]]['hpNow']>=1 && $this->users[$i]['id']!=$bot
						&& $this->users[$i]['team']!=$this->users[$this->uids[$bot]]['team'])
						{
                            if($this->users[$j]['timeGo'] < time() && $this->users[$this->uids[$bot]]['timeGo']<time()) {
                                if($this->botAct($bot)==true)
                                {
                                    if(!isset($this->ga[$bot][$this->users[$i]['id']]) && $this->users[$this->uids[$bot]]['timeGo']<time() && !isset($this->ag[$bot][$this->users[$i]['id']]))
                                    {
                                        $this->botAtack($this->users[$i]['id'],$bot,1);
                                        mysql_query('UPDATE `stats` SET `timeGo` = "'.$tnbot.'" WHERE `id` = "'.$this->users[$this->uids[$bot]]['id'].'" LIMIT 1');
                                    }elseif(isset($this->ag[$bot][$this->users[$i]['id']]))
                                    {
                                    }elseif(isset($this->ga[$bot][$this->users[$i]['id']]) && $this->users[$this->uids[$bot]]['timeGo']<time())
                                    {
                                        $this->botAtack($bot,$this->users[$i]['id'],1);
                                        mysql_query('UPDATE `stats` SET `timeGo` = "'.$tnbot.'" WHERE `id` = "'.$this->users[$this->uids[$bot]]['id'].'" LIMIT 1');
                                    }
                                }
                            }
                        }else{
                            //Удары между ботами
                            //
                            if($this->users[$j]['timeGo'] < time() && $this->users[$this->uids[$bot]]['timeGo']<time())
							{
                                $this->atacks[$this->ga[$bot][$this->users[$j]['id']]]['a1'] = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
                                $this->atacks[$this->ga[$bot][$this->users[$j]['id']]]['b1'] = rand(1,5);
                                $this->atacks[$this->ga[$bot][$this->users[$j]['id']]]['a2'] = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
                                $this->atacks[$this->ga[$bot][$this->users[$j]['id']]]['b2'] = rand(1,5);
                                $this->atacks[$this->ag[$bot][$this->users[$j]['id']]]['a1'] = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
                                $this->atacks[$this->ag[$bot][$this->users[$j]['id']]]['b1'] = rand(1,5);
                                $this->atacks[$this->ag[$bot][$this->users[$j]['id']]]['a2'] = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
                                $this->atacks[$this->ag[$bot][$this->users[$j]['id']]]['b2'] = rand(1,5);
                                if(isset($this->ga[$bot][$this->users[$j]['id']]) && $this->users[$j]['bot']>0)
                                {
                                    if($this->users[$j]['timeGo'] < time() && $this->users[$this->uids[$bot]]['timeGo']<time())
                                    {
                                        //$tnbot = time() + rand(3,7);
                                        if( $this->info['type'] == 329 ) { // тестовый бой
                                            $tnbot = time()-1;
                                        }
                                        $this->startAtack($this->ga[$bot][$this->users[$j]['id']]);//Это грузит?
                                        $this->users[$this->uids[$bot]]['timeGo'] = $tnbot;
                                        mysql_query('UPDATE `stats` SET `timeGo` = "'.$tnbot.'" WHERE `id` = "'.$this->users[$this->uids[$bot]]['id'].'" LIMIT 1');
                                    }
                                }elseif(isset($this->ag[$bot][$this->users[$j]['id']]) && $this->users[$j]['bot']>0){
                                    if($this->users[$this->uids[$bot]]['timeGo']<time() && $this->users[$j]['timeGo']<time())
                                    {
                                        $this->startAtack($this->ag[$bot][$this->users[$j]['id']]);
                                        //$tnbot = time() + rand(3,7);
                                        if( $this->info['type'] == 329 ) { // тестовый бой
                                            $tnbot = time()-1;
                                        }
                                        $this->users[$this->uids[$bot]]['timeGo'] = $tnbot;
                                        mysql_query('UPDATE `stats` SET `timeGo` = "'.$tnbot.'" WHERE `id` = "'.$this->users[$this->uids[$bot]]['id'].'" LIMIT 1');
                                    }
                                }
                            }
                            //
                        }
                    }
                    $j++;
                }
            }
            $i++;
        }
        //if($save_time3) dStart();//dg

		//pr($GLOBALS['u']->info['id'].' : '.$c['admins']);
        /* if($save_time3==true && in_array($GLOBALS['u']->info['id'], $c['admins']))
		{
			eLog('===============================uid:'.$GLOBALS['u']->info['id'].'===============================');
			dPrint();//dg
		    eLog('===============================uid:'.$GLOBALS['u']->info['id'].'===============================');
		} */
    }

    //Действия бота
    public function botAct($uid)
    {
        $r = false;
        if($this->users[$this->uids[$uid]]['bot']>0)
        {
            if($this->users[$this->uids[$uid]]['online'] < time()-3)
            {
                $r = true;
                $this->users[$this->uids[$uid]]['online'] = time();
                mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.((int)$uid).'" LIMIT 1');
            }else{
                if(rand(0,2)==1)
                {
                    $r = true;
                }
            }
        }
        return $r;
    }

    //получаем данные о поединке
    public function battleInfo($id)
    {
        $b = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
        if(isset($b['id']))
        {
            $this->hodID = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$b['id'].'" ORDER BY `id` DESC LIMIT 1'));
            if(isset($this->hodID['id_hod']))
            {
                $this->hodID = $this->hodID['id_hod'];
            }else{
                $this->hodID = 0;
            }
            return $b;
        }else{
            return false;
        }
    }

    //наносим удар противнику
    public function addAtack()
    {
        global $js;
        if(isset($_POST['atack'],$_POST['block']))
        {
			$na = array('id'=>0,'a'=>array(1=>0,2=>0,3=>0,4=>0,5=>0),'b'=>0);
            $a = explode('_',$_POST['atack']);
            $i = 1;
            $na['id'] = time();
            while($i<=5)
            {
                if(isset($a[$i-1]))
                {
                    $a[$i-1] = intval(round($a[$i-1]));
                    if($a[$i-1]>=1 && $a[$i-1]<=5)
                    {
                        $na['a'][$i] = $a[$i-1];
                    }else{
                        $na['a'][$i] = 0;
                    }
                }
                $i++;
            }

            $na['b'] = intval(round($_POST['block']));
            if($na['b']<1 || $na['b']>5)
            {
                $na['b'] = 0;
            }

            $this->uAtc = $na;
            $js .= 'testClearZone();';
        }else{
            $this->e = 'Выберите зоны удара и блока';
        }
    }

    //выделяем пользователей
    public function teamsTake()
    {
        global $u, $c;
        $rs = ''; $ts = array(); $tsi = 0;
		$save_time = false;
        if($save_time) dStart();//dg

		if($this->info['id'] > 0)
        {
            //данные о игроках в бою
			//pr($u->info['id'].','.$u->info['enemy']);//
			$qq = ($u->TJBattle($this->info['id']) ? ' AND `st`.`hpNow` > "0"' : '');
			//if($qq && $u->info['id']==1) $qq .= 'AND `u`.`id` IN('.$u->info['id'].','.$u->info['enemy'].')';

            $nxtlg = array();
            $t = mysql_query('SELECT `u`.`room`,`u`.`no_ip`,`u`.`twink`,`u`.`stopexp`,`u`.`id`,`u`.`notrhod`,`u`.`login`,`u`.`login2`,`u`.`sex`,
			`u`.`online`,`u`.`admin`,`u`.`align`,`u`.`align_lvl`,`u`.`align_exp`,`u`.`clan`,`u`.`level`,`u`.`battle`,`u`.`obraz`,`u`.`win`,`u`.`lose`,
			`u`.`nich`,`u`.`animal`,`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`exp`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,`st`.`battle_exp`,
			`st`.`enemy`,`st`.`battle_text`,`st`.`upLevel`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`bot`,`st`.`lider`,`st`.`btl_cof`,`st`.`tactic1`,
			`st`.`tactic2`,`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`battleEnd`,
			`st`.`priemslot`,`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`res_x`,`st`.`res_y`,
			`st`.`res_s`,`st`.`id`, `st`.`last_hp`,`st`.`last_pr`,`u`.`sex`,`u`.`money`,`u`.`bot_id`,`u`.`money3`,`u`.`money2`
			FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = "'.$this->info['id'].'"'.$qq);
            if($save_time) dStart();//dg
			$i = 0; $bi = 0; $up = '';

			if($this->info['start2']==0)
			{
                $tststrt = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$this->info['id'].'" AND `start2` = "0" LIMIT 1'));
                if(isset($tststrt['id'])) $upd = mysql_query('UPDATE `battle` SET `start2` = "'.time().'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
                else $this->info['start2'] = time();
            }
            if($save_time) dStart();//dg
			
            while($pl = mysql_fetch_array($t))
            {
                if($save_time) dStart();//dg
				//записываем данные
                if($pl['login2']=='') $pl['login2'] = $pl['login'];

                $this->users[$i] = $pl;
                $this->uids[$pl['id']] = $i;

                if( $this->info['start2'] == 0 )
				{
                    mysql_query('UPDATE `users` SET `notrhod` = "-1" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                    $this->users[$i]['notrhod'] = -1;
                }

                if($pl['bot']>0)
                {
                    $this->bots[$bi] = $pl['id'];
                    $this->iBots[$pl['id']] = $bi;
                    $bi++;
                }
                

				//получаем статы
                //if($pl['id']==$u->info['id'] || $pl['id']==$u->info['enemy'])
                if($save_time) dStart();//dg
				$this->stats[$i] = $u->getStats($pl,0,0,false,$this->cached,true);
                if($save_time) dStart('getstats');//dg

				//Заносим старт
                if($this->info['start2'] == 0 )
                {
                    if(!isset($ts[$this->users[$i]['team']]))
                    {
                        $tsi++;
                        $ts[$this->users[$i]['team']] = $tsi;
                    }

                    if($this->users[$i]['level'] <= 7) {
                        $this->users[$i]['tactic7'] = floor(10/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
                    } elseif($this->users[$i]['level'] == 8) {
                        $this->users[$i]['tactic7'] = floor(20/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
                    } elseif($this->users[$i]['level'] == 9) {
                        $this->users[$i]['tactic7'] = floor(30/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
                    } elseif($this->users[$i]['level'] >= 10) {
                        $this->users[$i]['tactic7'] = floor((40+$this->stats[$i]['s7'])/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
                    }
					
                    if( $this->stats[$i]['s7'] > 49 && !$this->stats[$i]['spasenie'] )//Спасение
					{
						
						mysql_query("INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
						( 22, '".$this->stats[$i]['id']."', 'Спасение', 'add_spasenie=1', 0, 77, 0, '".$this->stats[$i]['id']."', 0, 'priem', 324, 'preservation.gif', 1, -1, 'спасение', 0, 0, '', 0, 0, 0, 1, 0);
						");//Вешаем спасение с add_spasenie=1
                    }
					
                    if($save_time) dStart();//dg
                    // Бафф Зверя animal_bonus
                    if($this->users[$i]['animal'] > 0)
					{
                        $a = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `id` = "'.$this->users[$i]['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));
                        if(isset($a['id']))
						{
                            if($a['eda']>=1)
							{
                                $anl = mysql_fetch_array(mysql_query('SELECT `bonus` FROM `levels_animal` WHERE `type` = "'.$a['type'].'" AND `level` = "'.$a['level'].'" LIMIT 1'));
                                $anl = $anl['bonus'];

                                $tpa = array(1=>'cat',2=>'owl',3=>'wisp',4=>'demon',5=>'dog',6=>'pig',7=>'dragon');
                                $tpa2 = array(1=>'Кота',2=>'Совы',3=>'Светляка',4=>'Чертяки',5=>'Пса',6=>'Свина',7=>'Дракона');
                                $tpa3 = array(1=>'Кошачья Ловкость',2=>'Интуиция Совы',3=>'Сила Стихий',4=>'Демоническая Сила',5=>'Друг',6=>'Полная Броня',7=>'Инферно');

                                mysql_query('INSERT INTO `eff_users` (`hod`,`v2`,`img2`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`v1`,`user_use`) VALUES ("-1","201","summon_pet_'.$tpa[$a['type']].'.gif",22,"'.$this->users[$i]['id'].'","'.$tpa3[$a['type']].' ['.$a['level'].']","'.$anl.'","0","77","priem","'.$this->users[$i]['id'].'")');

                                $anl = $u->lookStats($anl);

                                $vLog = 'time1='.time().'||s1='.$this->users[$i]['sex'].'||t1='.$this->users[$i]['team'].'||login1='.$this->users[$i]['login'].'';
                                $vLog .= '||s2=1||t2='.$this->users[$i]['team'].'||login2='.$a['name'].' (Зверь '.$this->users[$i]['login'].')';

                                $mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>1,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');

                                $ba = '';
                                $i6 = 0;
                                //dStart('prof5');//dg
                                while($i6<count($u->items['add']))
								{
                                    if(isset($anl['add_'.$u->items['add'][$i6]]))
									{
                                        if($anl['add_'.$u->items['add'][$i6]] > 0)
										{
                                            if( $u->items['add'][$i6] == 'mib1') {
                                                $ba .= 'Броня головы: +'.$anl['add_'.$u->items['add'][$i6]].', ';
                                            }elseif( $u->items['add'][$i6] == 'mib2') {
                                                $ba .= 'Броня корпуса: +'.$anl['add_'.$u->items['add'][$i6]].', ';
                                            }elseif( $u->items['add'][$i6] == 'mib3') {
                                                $ba .= 'Броня пояса: +'.$anl['add_'.$u->items['add'][$i6]].', ';
                                            }elseif( $u->items['add'][$i6] == 'mib4') {
                                                $ba .= 'Броня ног: +'.$anl['add_'.$u->items['add'][$i6]].', ';
                                            }elseif( $u->items['add'][$i6] == 'mab1' || $u->items['add'][$i6] == 'mab2' || $u->items['add'][$i6] == 'mab3' || $u->items['add'][$i6] == 'mab4' ) {

                                            }else{
                                                $ba .= $u->is[$u->items['add'][$i6]].': +'.$anl['add_'.$u->items['add'][$i6]].', ';
                                            }
                                        }
                                    }
                                    $i6++;
                                }
                                //dStart('prof6');//dg
                                $ba = trim($ba,', ');
                                if($ba == '') {
                                    $ba = 'Эффект отсутсвует';
                                }

                                $mas1['text'] = '{tm1} <img src=//img.testcombats.ru/i/eff/summon_pet_'.$tpa[$a['type']].'.gif> {u2} очнулся от медитации, и призвал заклятье &quot;<b>'.$tpa3[$a['type']].' ['.$a['level'].']</b>&quot; на {u1}. ('.$ba.')';
                                $nxtlg[count($nxtlg)] = $mas1;
                                mysql_query('UPDATE `users_animal` SET `eda` = `eda` - 1 WHERE `id` = "'.$a['id'].'" LIMIT 1');
                                //$this->add_log($mas1);
                                $this->get_comment();
                                //dStart('prof7');//dg
                            }
                        }
                    }

                    mysql_query('UPDATE `stats` SET `last_hp` = "0",`tactic1`="0",`tactic2`="0",`tactic3`="0",`tactic4`="0",`tactic5`="0",`tactic6`="0",`tactic7` = "'.($this->users[$i]['tactic7']).'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
                    if($save_time) dStart();//dg
                    $rs[$this->users[$i]['team']] .= $u->microLogin($this->users[$i],2).', ';
                }
                $up .= '`uid` = "'.$pl['id'].'" OR';
                //battle-user (статистика, начальная)
                $mybu = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_users` WHERE `battle` = "'.$this->info['id'].'" AND `uid` = "'.mysql_real_escape_string($pl['id']).'" LIMIT 1'));
                if(!isset($mybu['id']))
				{
                    //Пустое значение статистики для данного персонажа за текущий бой
                    $this->addstatuser($pl['id']);
                }
                if($save_time) dStart();//dg
                //dPrint(0);//dg
                $i++;
            }
            if($save_time) dStart();//dg

            $up = rtrim($up,' OR');

            //Заносим в лог начало поединка

            if($this->info['start1']==0)
            {
                $tststrt = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$this->info['id'].'" AND `start1` = "0" LIMIT 1'));
                if(isset($tststrt['id']))
				{
                    $upd = mysql_query('UPDATE `battle` SET `start1` = "'.time().'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
                    if($upd)
                    {
                        $i = 0; $r = '';
                        while($i <= $tsi)
                        {
                            if(isset($rs[$i]) && $rs[$i] != '') {
                                $r .= rtrim($rs[$i],', ').' и ';
                            }
                            $i++;
                        }
                        $r = rtrim($r,' и ');
                        $r = str_replace('"','\\\\\"',$r);
                        $this->hodID++;
                        $vLog = 'time1='.time();
                        $r = '{tm1} Часы показывали <span class=\\\\\"date\\\\\">'.date('d.m.Y H:i',$this->info['time_start']).'</span>, когда '.$r.' бросили вызов друг другу.';
                        $mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>$r,'vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
                        $this->add_log($mass);
                        $this->info['start1'] = time();
                    }
                }
                if($save_time) dStart();//dg

                //

                if(count($nxtlg) > 0)
				{
                    $i = 0;
                    while($i < count($nxtlg))
					{
                        $this->add_log($nxtlg[$i]);
                        $i++;
                    }
                }

                //
            }
        }
        //if($save_time) dStart();//dg
        /* if($save_time && in_array($u->info['id'], $c['admins']))
		{
			//eLog('===============================teamsTake: uid:'.$u->info['id'].'===============================');
			dPrint(0);//dg
    		//eLog('===============================teamsTake: uid:'.$u->info['id'].'===============================');
		} */
    }

    //Возращаем зоны блока по умолчанию
    public function restZonb($id, $uid1,$uid2)
    {
		//раб. без этого
		/*if( $this->stats[$this->uids[$uid2]]['yhod'] > 0)
		{
			pr('uhod:'.$this->stats[$this->uids[$uid2]]['yhod']);
			//$uid2 = $this->yhod_user($id,$uid1,$uid2,$this->stats[$this->uids[$uid2]]['yhod']);
            pr($uid2);
        }
        if( $this->stats[$this->uids[$uid1]]['yhod'] > 0)
		{
			pr('uhod:'.$this->stats[$this->uids[$uid1]]['yhod']);
			//$uid1 = $this->yhod_user($id,$uid2,$uid1,$this->stats[$this->uids[$uid1]]['yhod']);
            pr($uid1);
        }*/

		if($this->stnZbVs[$uid1]>0) $this->stats[$this->uids[$uid1]]['zonb'] = $this->stnZbVs[$uid1];
        if($this->stnZbVs[$uid2]>0) $this->stats[$this->uids[$uid1]]['zonb'] = $this->stnZbVs[$uid2];
    }

    //проверка блока (Визуальная)
    public function testZonbVis()//Форма зон блока
    {
		global $u;
        //pr('sss');

        if($this->stnZbVs==0)
        {
            $zb = $this->stats[$this->uids[$u->info['id']]]['zonb'];
            $this->stnZbVs = $zb;
        }else{
            $zb = $this->stnZb;
        }
        $eu = $this->users[$this->uids[$u->info['id']]]['enemy'];
        if($zb>3){ $zb = 3; }
        if($eu!='' && $eu!=0)
        {
            if($this->stats[$this->uids[$eu]]['weapon1']==1 || $this->stats[$this->uids[$eu]]['weapon2']==1)
            {
                if($this->stats[$this->uids[$u->info['id']]]['weapon1']!=1 && $this->stats[$this->uids[$u->info['id']]]['weapon2']!=1)
                {
                    $zb -= 1;
                }
            }
        }
        if($zb<1){ $zb = 1; }
        return $zb;
    }

    //проверка блока
    public function testZonb($id, $uid, $uid2)//Количество зон блока???
    {
        global $u;
        $zba = array(1=>0,2=>0);

		$zba[1] = $this->stats[$this->uids[$uid]]['zonb'];
        $zba[2] = $this->stats[$this->uids[$uid2]]['zonb'];

        if($this->stnZb[$uid]==0)
        {
            $zba[1] = $this->stats[$this->uids[$uid]]['zonb'];
            $this->stnZb[$uid] = $zba[1];
        }else{
            $zba[1] = $this->stnZb[$uid];
        }

        if($this->stnZb[$uid2]==0)
        {
            $zba[2] = $this->stats[$this->uids[$uid2]]['zonb'];
            $this->stnZb[$uid] = $zba[2];
        }else{
            $zba[2] = $this->stnZb[$uid2];
        }

        if($zba[1]>3){ $zba[1] = 3; }
        if($zba[2]>3){ $zba[2] = 3; }

        //Блоки игрока 1
        if($this->stats[$this->uids[$uid2]]['weapon1']==1 || $this->stats[$this->uids[$uid2]]['weapon2']==1)
        {
            if($this->stats[$this->uids[$uid]]['weapon1']!=1 && $this->stats[$this->uids[$uid]]['weapon2']!=1)
            {
                $zba[1] -= 1;
            }
        }

        //Блоки игрока 2
        if($this->stats[$this->uids[$uid]]['weapon1']==1 || $this->stats[$this->uids[$uid]]['weapon2']==1)
        {
            if($this->stats[$this->uids[$uid2]]['weapon1']!=1 && $this->stats[$this->uids[$uid2]]['weapon2']!=1)
            {
                $zba[2] -= 1;
            }
        }
		//pr($this->stats[$this->uids[$uid2]]['zonb']);

        if($zba[1]<1){ $zba[1] = 1; }
        if($zba[2]<1){ $zba[2] = 1; }
        //$zba[2] = 0;

        $this->stats[$this->uids[$uid]]['zonb'] = $zba[1];
        $this->stats[$this->uids[$uid2]]['zonb'] = $zba[2];
        if($this->stats[$this->uids[$uid]]['min_zonb']>0 && $this->stats[$this->uids[$uid]]['zonb']<$this->stats[$this->uids[$uid]]['min_zonb'])
        {
            $this->stats[$this->uids[$uid]]['zonb'] = $this->stats[$this->uids[$uid]]['min_zonb'];
        }
        if($this->stats[$this->uids[$uid2]]['min_zonb']>0 && $this->stats[$this->uids[$uid2]]['zonb']<$this->stats[$this->uids[$uid2]]['min_zonb'])
        {
            $this->stats[$this->uids[$uid2]]['zonb'] = $this->stats[$this->uids[$uid2]]['min_zonb'];
        }

        if($this->stats[$this->uids[$uid2]]['no_mf']==1) $this->stats[$this->uids[$uid2]]['zonb'] = 0;//Коварный уход - бьет через блок
    }

    //генерируем команды
    public function genTeams($you)
    {
        global $u;
        $ret = '';
        $teams = array( );
        //выделяем пользователей
        $i = 0;	 $j = 1; $tms =	array( );
        $teams[$this->users[$this->uids[$you]]['team']] = '';
        $tms[0] = $this->users[$this->uids[$you]]['team'];
		//pr($this->uids);
        while($i<count($this->users))//uids
        {
            if($this->stats[$i]['hpNow']>0)
            {
                if(!isset($teams[$this->users[$i]['team']]))
                {
                    $tms[$j] = $this->users[$i]['team'];
                    $j++;
                }
                if($this->stats[$i]['hpNow']<0){ $this->stats[$i]['hpNow'] = 0; }
                if($this->stats[$i]['hpAll']<$this->stats[$i]['hpNow']){ $this->stats[$i]['hpNow'] = $this->stats[$i]['hpAll']; }
                $a1ms = '';
                if(isset($this->ga[$this->users[$i]['id']][$you]) && $this->ga[$this->users[$i]['id']][$you]!=false)
                {
                    $a1mc = '';
                    $ac = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$this->ga[$this->users[$i]['id']][$you].'" LIMIT 1'));
                    if(isset($ac) && $ac['time']+$this->info['timeout']-15<time())
                    {
                        $a1mc = 'color:red;';
                    }
                    $a1ms = 'style=\"text-decoration: underline; '.$a1mc.'\"';
                }
				elseif(isset($this->ag[$this->users[$i]['id']][$you]) && $this->ag[$this->users[$i]['id']][$you]!=false)
                {
                    $a1mc = '';
                    $ac = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$this->ag[$this->users[$i]['id']][$you].'" LIMIT 1'));
                    if(isset($ac) && $ac['time']+$this->info['timeout']-15<time())
                    {
                        $a1mc = 'color:green;';
                    }
                    $a1ms = 'style=\"text-decoration: overline; '.$a1mc.'\"';
                }
                if($this->users[$i]['login2']=='') $this->users[$i]['login2'] = $this->users[$i]['login'];
				//if($this->users[$i]['invis']==1) $this->users[$i]['login2'] = 'Невидимка';
				//pr($this->users[$i]['invis']);
				if ($this->users[$i]['align']==9)
				{
                    $this->stats[$i]['hpNow'] = $this->stats[$i]['hpNow']/($this->stats[$i]['hpAll']/100);
                    $this->stats[$i]['hpAll'] = '100%';
                }
                
                $ldr = '';
                if( $this->users[$i]['lider'] == $this->info['id'] ) {
                    $ldr = '<img width=24 height=15 title=Лидер&nbsp;группы src=//img.testcombats.ru/i/lead'.$this->users[$i]['team'].'.gif \>';
                }
                $teams[$this->users[$i]['team']] .= ', '.$ldr.'<span '.$a1ms.' class=\"CSSteam'.$this->users[$i]['team'].'\" onClick=\"top.chat.addto(\''.$this->users[$i]['login2'].'\',\'to\'); return false;\" oncontextmenu=\"top.infoMenu(\''.$this->users[$i]['login2'].'\',event,\'main\'); return false;\">'.$this->users[$i]['login2'].'</span><small> ['.floor($this->stats[$i]['hpNow']).'/'.$this->stats[$i]['hpAll'].']</small>';
            }
            $i++;
        }

        //генерируем команды
        $i = 0;
        while($i<count($tms))
        {
            $teams[$tms[$i]] = ltrim($teams[$tms[$i]],', ');
            if( $teams[$tms[$i]] != '' ) {
                $teams[$tms[$i]] = '<img src=\"//img.testcombats.ru/i/lock3.gif\" style=\"cursor:pointer\" width=\"20\" height=\"15\" onClick=\"top.chat.addto(\'team'.$tms[$i].'\',\'private\'); return false;\"> '.$teams[$tms[$i]];
                $ret .= $teams[$tms[$i]];
                if(count($tms)>$i+1)
                {
                    $ret .= ' <span class=\"CSSvs\">&nbsp; против &nbsp;</span> ';
                }
            }
            $i++;
        }
        return 'genteam("'.$ret.'");';
    }


    public function addTravm($uid,$type,$lvl)
    {
        global $u;
        $t=$type;
        if($t==1){
            $name='Легкая травма';
            $stat=rand(1, 3); // пока без духовности
            $timeEnd=rand(3,6);// время травмы от 1.30 до 6 часов
            $data='add_s'.$stat.'=-'.$lvl;
            $img = 'eff_travma1.gif';
            $v1=1;
            //echo '<b><font color=red>'.$name.'</font></b>';
        }elseif($t==2){
            $name='Средняя травма';
            $stat=rand(1, 3); // пока без духовности
            $timeEnd=rand(3,9);// время травмы от 6 до 12 часов
            $data='add_s'.$stat.'=-'.($lvl*2);
            $v1=2;
            $img = 'eff_travma2.gif';
        }
        elseif($t==3){
            $name='Тяжелая травма';
            $stat=rand(1, 3); // пока без духовности
            $timeEnd=rand(3,12);// время травмы от 12 до 6 часов
            $data='add_s'.$stat.'=-'.($lvl*3);
            $v1=3;
            $img = 'eff_travma3.gif';
        }
        elseif($t==4){
            $name='Легкая неизлечимая травма';
            $stat=rand(1, 3); // пока без духовности
            $timeEnd=rand(3,6);// время травмы от 12 до 6 часов
            $data='add_s'.$stat.'=-'.($lvl*3);
            $v1=4;//Будет ли работать???
            $img = 'eff_travma1.gif';
        }
        elseif($t==5){
            $name='Средняя неизлечимая травма';
            $stat=rand(1, 3); // пока без духовности
            $timeEnd=rand(3,9);// время травмы от 12 до 6 часов
            $data='add_s'.$stat.'=-'.($lvl*3);
            $v1=5;//Будет ли работать???
            $img = 'eff_travma2.gif';
        }
        elseif($t==6){
            $name='Тяжелая неизлечимая травма';
            $stat=rand(1, 3); // пока без духовности
            $timeEnd=rand(3,12);// время травмы от 12 до 6 часов
            $data='add_s'.$stat.'=-'.($lvl*3);
            $v1=6;//Будет ли работать???
            $img = 'eff_travma3.gif';
        }

		$timeEnd = $timeEnd*3600;
        $ins = mysql_query('INSERT INTO `eff_users` (`overType`,`timeUse`,`hod`,`name`,`data`,`uid`, `id_eff`, `img2`, `timeAce`, `v1`)
		VALUES ("0","'.time().'","-1","'.$name.'","'.$data.'","'.$uid.'", "4", "'.$img.'","'.$timeEnd.'", "'.$v1.'")');

		if($t > 3) mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid`="'.$uid.'" AND `delete` = "0" AND `id_eff` = "4" AND `v1`<"4"');
    }

    public function testUserInfoBattle($uid) {
        global $u;
        if(!isset($this->uids[$uid])) {
            //Заносим данные об игроке снова (видимо он погиб и его стерло с инфо)
            if(!isset($this->uids[$uid])) {
                $this->uids[$uid] = count($this->users);
            }
            $this->users[$this->uids[$uid]] = mysql_fetch_array(mysql_query('SELECT
								
				`u`.`id`,`u`.`login`,`u`.`login2`,`u`.`online`,`u`.`admin`,`u`.`city`,`u`.`cityreg`,`u`.`align`,`u`.`align_lvl`,`u`.`align_exp`,`u`.`clan`,
				`u`.`level`,`u`.`money`,`u`.`money3`,`u`.`money2`,`u`.`money4`,`u`.`battle`,`u`.`sex`,`u`.`obraz`,`u`.`win`,`u`.`win_t`,
				`u`.`lose`,`u`.`lose_t`,`u`.`nich`,`u`.`timeMain`,`u`.`invis`,`u`.`bot_id`,`u`.`animal`,`u`.`type_pers`,
				`u`.`notrhod`,`u`.`bot_room`,`u`.`inUser`,`u`.`inTurnir`,`u`.`inTurnirnew`,`u`.`activ`,`u`.`stopexp`,`u`.`real`,
										
				`st`.*				
				
				FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`id` = "'.$uid.'" LIMIT 1'));
            $this->stats[$this->uids[$uid]] = $u->getStats($this->users[$this->uids[$uid]],0,0,false,false,true);
        }
    }

}

$btl = new battleClass;
?>