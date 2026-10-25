<?php 
/**
*		Модель для работы с XML файлами подготовленными из 1С в формате "русские буквы в названиях тегов"
*		Мы латинизируем названия тегов,
*		Храним названия исходных тегов и их замену.
*		Публичные функции позволяют удобно получать массивы данных используя оригинальные "русские" названия,
*		причем мы получаем в видем массивов а не обьектов.
*		Собственно реализация анг. внутри функционала, снаружи данные не доступны о заменах.
*/

class model_russian_xml{
protected $dom = NULL;
private $rawdata = NULL;
private	$patterns = array('ё','й','ц','у','к','е','н','г','ш','щ','з','х','ъ','ф','ы','в','а','п','р','о','л','д','ж','э','я','ч','с','м','и','т','ь','б','ю',' ',':',
					  'Ё','Й','Ц','У','К','Е','Н','Г','Ш','Щ','З','Х','Ъ','Ф','Ы','В','А','П','Р','О','Л','Д','Ж','Э','Я','Ч','С','М','И','Т','Ь','Б','Ю',);
private	$replace = array('yo','y','c','u','k','e','n','g','sh','sch','z','h','_','f','i','v','a','p','r','o','l','d','zh','e','ya','ch','s','m','i','t','_','b','yu','_','_',
					 'yo','y','c','u','k','e','n','g','sh','sch','z','h','_','f','i','v','a','p','r','o','l','d','zh','e','ya','ch','s','m','i','t','_','b','yu',);

// что на что меняем: массив вида ['ВидНоменклатуры'] => 'vidnomenklaturi' ; ['ВладелецОбъекта'] => 'vladelecob_ekta'
// используется только внутри класса для того чтоб работать с DOM документом 
private $map = NULL;

public $xml;

private $multiples;

// в какой кодировке у нас исходный 1С файл
public $FROM_ENCODING = "UTF-8";

// в какой кодировке работаем 
public $TO_ENCODING   = "cp1251";

function __construct(){
	}


/**
*		Загрузить исходный XML переданный строкой
*/
public function load_string($rawdata){
	// загрузим карту замен
	$englified = $this->convert_xml(	$rawdata	);
//	echo $englified;
	$this->dom = new domDocument('1.0','Windows-1251');
//	alid(	$englified	);
	$this->xml = $englified;
	$this->dom->loadXML(	$englified	);
//	alid(	$this->map	);

	}



/**
*    $xp  = родительский контейнер
*	$multiples  =  теги которых может быть много внутри родительского контейнера
*   пример
*   $nodes = $this->rusxml->get_array_rus(	'//v8msg:message/v8msg:body/actions_info', array('actions')	);
*/
public  function get_array_rus($xp,$multiples=array()){
	$xp = $this->ruslat($xp);
	return $this->get_array($xp,$multiples);
	}


/**
*	Возвращает массив массивов произвольной вложенности. 
*   пример вызова 
*      
*      $nodes = $this->rusxml->get_array(	'//v8msg_message/v8msg_body/actions_info', array('actions')	);
*/
public  function get_array($xp, $multiples=array()){
	$this->multiples = $multiples;
	$xp = '//'.$xp;
	$xpath = new DOMXpath(	$this->dom	);
	$nodes = $xpath->query($xp);
	$return = array();
	$i=0;
	foreach ($nodes as $node) {
//		alid($node);
		$value = $this->get_value($node);
		$return[$i] = $value['value'];
		$i++;
		};
//		alid($return);
	return $return;
	}







private function get_value($node){
	$nodes = $node->childNodes;
	$length = (isset($nodes->length))?$nodes->length:0;
	if ($length > 2){
			$j=0;
			foreach ($nodes as $subnode) {
				$subname = $subnode->nodeName;
				$subvalue = $this->get_value($subnode);
				if (in_array($subvalue['name'], $this->multiples)){
					$subvalue['name'] = $subvalue['name'].$j;
					}

				if (is_array($subvalue['value']) && sizeof($subvalue['value'])==1){
					$return[$subvalue['name']] = $subvalue['value'];
					}
				else {
					$return[$subvalue['name']] = $subvalue['value'];
					};
				$j++;
				};
			}
	elseif ($length == 1){
			foreach ($nodes as $subnode) {
				$subname = $subnode->nodeName;
				$subvalue = $this->get_value($subnode);
				$return = $subvalue['value'];
				};
		}
	elseif (isset($node->nodeValue)){
		$return =  iconv($this->FROM_ENCODING, $this->TO_ENCODING.'//TRANSLIT//IGNORE', $node->nodeValue);
		}
	else {
		$return ='*';
		};
	if (is_array($return) && isset($return['#text'])) {
		unset($return['#text']);
		};

	return array('name'=>$node->nodeName, 'value'=>$return);
	}





/**
*	Получить массив перекодировки 
*/
public function map() {
	return $this->map;
	}


/**
*		Создать карту замены, а также заменить русские теги на английские. 
*		На скорость не оптимизировалось совсем!
*/
private function convert_xml($rawdata){
	// найдем все названия тегов и построим карту замен
	preg_match_all("/(<\/?)([a-zA-Zа-яА-Я0-9\.\:\_]*)([^>]*>)/e", $rawdata, $m);
	$original = array_unique(array_values($m[2]));

	// совершенно дурацкий и грязных хак из за того что регекспы работают кривовато и кто то успел заменить ДокументОснование на documentОснование
	$original[]='dokumentОснование';
	$original[]='dokumentПродажи';
	while(list(,$v)=each($original)){
		$english = $this->ruslat($v);
		$this->map[$v] = $english;
		};
	unset($this->map['']);
//	alid(	$this->map	);
//	exit();
	// заменим в исходном DOM русские теги на английские приведенные к нижнему регистру
	$search=array();
	$replace=array();
	$i=0;
	$englified = $rawdata;
	while(list($k,$v)=each($this->map)){
		$search[$i]='|<'.$k.'|i';
		$replace[$i]='<'.$v.'';
		$search[1+$i]='|<\/'.$k.'|i';
		$replace[1+$i]='</'.$v.'';
		$i=$i+2;
		};
	$englified = preg_replace(	$search,$replace,$rawdata	);
	return $englified;
	}





/**
*		Переконвертировать русскую строчку в латинскую
*/
public function ruslat($text) {
	$out = trim(strtolower(str_replace($this->patterns, $this->replace, $text)));
	return $out;
	}

}
?>