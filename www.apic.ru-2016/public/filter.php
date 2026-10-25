<!DOCTYPE html>
<html>
<head>
	<meta name="referrer" content="unsafe-url" />
	<meta http-equiv="X-UA-Compatible" content="IE=10" />
	<link rel="stylesheet" href="/css/all.css?{{PAGE.modified}}" type="text/css" />
	<meta name="viewport" content="width=device-width">
    <script src="/js/jquery-1.12.4.min.js"></script>
	<script src="/js/cascading.js"></script>
</head>
<body style="background: #fff; padding: 0px; margin: 0px;">

<div _class="content-flex" style="background: #fff; padding: 0px; margin: 0px;" >
	<section id="content" style="background: #fff; padding: 0px; margin: 0px;"> 

    <form name="demo1" onsubmit="return urlredirector()" class="content-form" style="_padding: 0px; margin: 0px;">
	
        <fieldset>
								<div class="form-frame">
									<div class="col col01">
										<div class="form-row">
											<label class="control-label">Оборудование</label>
											<div class="input-block">

	  <select id="s1" name="section_id" style="width: 300px;"></select>
	  
	  
                    </div>
										</div>
										<div class="form-row">
											<div class="input-block">
                    
	  <select id="s2" style="width: 300px;"></select>

                                </div>
										</div>
									</div>
									<div class="col col02">
										<div class="form-row">
											<label class="control-label">Бренд</label>
											<div class="input-block">
                
	 <select id="s3" style="width: 200px;"></select>
                  
                  </div>
										</div>
										<div class="form-row">
											<label class="control-label">Город</label>
											<div class="input-block">
                  
	 <select id="s4" style="width: 200px;"></select>
                  
                  </div>
										</div>
									</div>
									<div class="btn-holder">
										<button class="btn red-btn" type="submit"><span class="icon"><img src="/images/srch-ico.png" width="11" height="11" alt="image description"></span>Подобрать</button>
									</div>
								</div>
							</fieldset>

            </form>  
			
			
			




      

      

      



	 
	 <!--
	  <input type="submit" class="button" value="найти поставщика">
	  -->
    </form>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	
    <script>
	function urlredirector(){
//			alert(  $('#s1').val()+'['+$('#s2').val()+']'+$('#s3').val() );
		if ($('#s4').val()){
			top.window.location.replace(	$('#s4').val() ); return false;
			};
		if ($('#s3').val()){
			top.window.location.replace(	$('#s3').val() ); return false;
			};
		if ($('#s2').val()){
			top.window.location.replace(	$('#s2').val() ); return false;
			};
		if ($('#s1').val()){
			top.window.location.replace(	$('#s1').val() ); return false;
			};
		}

<?
// https://github.com/uqix/jquery-cascading-select
// https://www.jqueryscript.net/form/jQuery-Cascading-Dropdown-Select.html
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');

$m = new ice_mysql();

$level1 = $m->selectManyRows("select id, url, name from ".MYSQL_DB.".tree where status=\"active\" and type=\"folder_catalog\" and parent_id=".ID_CATALOG." order by ordering DESC", NULL,NULL,NULL);
$l=array();
//alid($level1);

// список брендов у которых есть подключенные компании
	$brand_have_firm = $m->selectManyRowsByID("SELECT distinct MID( pname, 13, 10 ) AS brand_id FROM ".MYSQL_DB.".params WHERE pname LIKE  'brand_assoc_%' AND pvalue =  '1'",
	"brand_id",NULL,NULL,NULL);
	//alid($brand_have_firm);
	//exit();

while (list(,$v)=each(	$level1	)){
	$level2 = $m->selectManyRows("select id, url, name from ".MYSQL_DB.".tree where status=\"active\" and parent_id=".$v['id']." order by ordering DESC", NULL,NULL,NULL);
	//alid($level2);
	$l[	$v['id']	]=array(
		'text'=>$v['name'],
		//'text'=>$v['id'],
		'value'=>$v['url']."#supplierslist"
		);
	//if (	sizeof($level2)>0){
	// на 2 уровне у нас каталог 
		while (list(,$vv)=each(	$level2	)){
			$brands = $m->selectManyRows("select substring(pname,7) as id  from ".MYSQL_DB.".params where doc_id=".$vv['id']." and pvalue=\"1\" and pname like \"b_c_a_%\" ",NULL,NULL,NULL);
	
			$l[	$v['id']	]['children'][	$vv['id']	]=array(
				'text'=>$vv['name'],
				//'text'=>$vv['id'],
				'value'=>$vv['url']."#supplierslist"
				);
			// почистим получившиеся бренды от тех у кого нет фирм 
			
			
			// не будем показывать бренды у которых нет ни одной подключенной фирмы. пройдем по всем брендам и отключим те у которых нет ни одной фирмы.
			reset($brands);
			while (list($kkk,$vvv)=each(	$brands	)){
				if (!isset($brand_have_firm[$vvv['id']])){
					unset($brands[$kkk]);
					};
				};
			
	
			// на 3 уровне бренды 
			//$level3=array();
			reset($brands);
			while (list(,$vvv)=each(	$brands	)){
				$b = $m->selectOneRow("select url, name, status from ".MYSQL_DB.".tree where status=\"active\" and id=".$vvv['id'],NULL,NULL,NULL);
							$l[	$v['id']	]['children'][	$vv['id']	]['children'][	$b['name']	]=array(
								'text'=>$b['name'],
								'value'=>$vv['url']."?action=".$vvv['id']
								);
					};
				$tmp = $l[	$v['id']	]['children'][	$vv['id']	]['children'];
				asort($tmp);
				$l[	$v['id']	]['children'][	$vv['id']	]['children'] = $tmp;


					//alid(  $l[	$v['id']	]['children'][	$vv['id']	]['children']  );
				
					while (list($vk,$vz)=each(	$l[	$v['id']	]['children'][	$vv['id']	]['children']	)){
				      	// на 4 уровне города 
						// по хорошему нужно отобрать города в которых есть члены которые занимаются марками. но это очень много подзапросов. 
						// поэтому мы выведем список всех активных городов членов АПИК
						// а проверку на есть ли кто то в этом городе с этим брендом делаем на уровне вьющки и там выводим что можем показать
						
						$citys = $m->selectManyRows("select id, name from  ".MYSQL_DB.".tree where parent_id=".ID_CITYS." and status=\"active\" order by name ",NULL,NULL,NULL);						
					
						while (list(,$v4)=each(  $citys	)){	
							$l[	$v['id']	]['children'][	$vv['id']	]['children'][	$vk	]['children'][$v4['id']] =array(
								'text'=>$v4['name'],
								'value'=>$vz['value'].'&subID='.$v4['id']
								);
							};
						};
				
			};

	
	
	};

	
	//alid($l);
	//echo json_encode($l);
	$str = '';
	while (list(,$v)=each(	$l	)){
		$str .= "{\r\n";
         $str .= "text: '".$v['text']."',\r\n";
         $str .= "value: '".HTTP_BASE.$v['value']."',\r\n";

		if (sizeof($v['children']>0)) {
			 $str .= "	children: [\r\n";
			while (list(,$vv)=each(	$v['children']	)){
				$str .= "	{\r\n";
				$str .= "	text: '".$vv['text']."',\r\n";
				$str .= "	value: '".HTTP_BASE.$vv['value']."',\r\n";
				
				if (sizeof($vv['children']>0)) {
					$str .= "		children: [\r\n";
						while (list(,$vvv)=each(	$vv['children']	)){
							$str .= "	{\r\n";
							$str .= "	text: '".$vvv['text']."',\r\n";
							$str .= "	value: '".HTTP_BASE.$vvv['value']."',\r\n";


							if (sizeof($vvv['children']>0)) {
								$str .= "		children: [\r\n";
									while (list(,$v4)=each(	$vvv['children']	)){
										$str .= "	{\r\n";
										$str .= "	text: '".$v4['text']."',\r\n";
										$str .= "	value: '".HTTP_BASE.$v4['value']."',\r\n";
										$str .= "	},\r\n";
										};
								$str .= "		]\r\n";
								};


							$str .= "	},\r\n";
							
							};
					$str .= "		]\r\n";
					};
				
				$str .= "	},\r\n";
				
			
				};
			 $str .= "	]\r\n";
			};
		$str .= "},\r\n";
		};
?>
	
     (function() {
       var data = [ <? echo $str; ?> ];
	   
       $('#s1').cascadingSelect({
         subSelects: ['#s2', '#s3', '#s4'],
         data: data,
         placeholder: 'Выберите',
         placeholderWhenEmpty: '-'
       });

	   
     })();
    </script>
	
	
	
	
</body>
</html>