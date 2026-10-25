<?php
namespace lib;

trait CStatexUtils {
	/**
	 * Выдаём ошибку
	 * @param $arrResult - массив с общими данными, к которым надо дописать ошибку, можно []
	 * @param $errors - строки или массивы с описанием ошибки, например __FUNCTION__
	 */
	function addError($arrResult, ...$errors){
		$arrRes["message"] = "<h4>Error:</h4>\n";
		foreach ($errors as $value) {
			if (is_array($value)) {
				$log_a = "";
				foreach ($value as $key => $val) {
					if (is_array($val)) {
						foreach ($val as $k2 => $v2) {
							$log_a .= "--[".$k2."] => ".$v2." <br>\n";
						}
					} else {
					 	$log_a .= "[".$key."] => ".$val." <br>\n";
					}
				}
				$arrRes["message"] .= $log_a;
			} else {
				$arrRes["message"] .= $value." <br>\n";
			}
		}

		$arrRes = array_merge($arrRes, $arrResult);

		return $arrRes;
	}

	/**
	 * --------------------
	 *		 ОТЛАДКА
	 * --------------------
	 */

	 /**
	  * Выдаёт HTML-табличку с значением переменной $data
	  * даже если она массив
	  */
	function dd($data, $bHtml = true){
		if(is_null($data)){
			 $str = ($bHtml) ? "<i>NULL</i>" : "<NULL>\n";
		}elseif($data == ""){
			 $str = ($bHtml) ? "<i>&lt;empty&gt;</i>" : "<empty>\n";
		}elseif(is_array($data)){
			 if(count($data) == 0){
				  $str = ($bHtml) ? "<i>&lt;empty array.&gt;</i>" : "<empty array>\n";
			 }else{
				  $str = ($bHtml) ? "<table style=\"border-bottom:0px solid #000;\" cellpadding=\"0\" cellspacing=\"0\">" : "";
				  foreach ($data as $key => $value) {
						$str .= ($bHtml) ?
						"<tr><td style=\"background-color:#008B8B; color:#FFF;border:1px solid #000;\">" . $key . "</td><td style=\"border:1px solid #000;\">" . self::dd($value, $bHtml) . "</td></tr>" :
						$key.": ".self::dd($value, $bHtml)."\n";
				  }
				  $str .= ($bHtml)? "</table>" : "\n\n";
			 }
		}/*elseif(is_resource($data)){
			 while($arr = mysql_fetch_array($data)){
				  $data_array[] = $arr;
			 }
			 $str = self::dd($data_array);
		}
		*/elseif(is_object($data)){
			 $str = self::dd(get_object_vars($data), $bHtml)."\n";
		}elseif(is_bool($data)){
			 $str = "<i>" . ($data ? "True" : "False") . "</i>";
		}else{
			 $str = $data;
			 if ($bHtml) $str = preg_replace("/\n/", "<br>\n", $str);
		}
		return $str;
  }

}
?>