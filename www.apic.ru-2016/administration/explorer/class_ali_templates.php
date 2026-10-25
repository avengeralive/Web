<?

/* ------------------
class ali_templates 
v 0.2
30 may 2002
strval bug fixed
--------------------- */

/*

Расширенный шаблон:

@@@imgsrc%%%%%% 
<b> картинка для этого товара еще сканируется :-) </b>
::: 
<img src="##imgsrc##" height="##imgheight##" width="##imgwidth##" border=0>
@@@


Разметка шаблона с мн. в. делится на три части:
а) название управляющего токена
В данном примере управляющим токеном является токен imgsrc

б) список точных значений токенов
В данном примере одно точное значение - пустая строка.

в) список значений шаблонов для всех точных значений управляющего токена 
и значение шаблона по умолчанию. 

*/

class ali_templates {

function ali_templates($template_name) {
                $template_name = PME_TEMPLATES_ROOT . $template_name;


        // разделитель токенов
        $this->token_pattern = "##";
        $this->token_pattern2 = "%%%";
        $this->token_pattern3 = ":::";
        $this->tokens = array();
        $this->template = $this->get_file($template_name);
        $this->tokens = split($this->token_pattern, $this->template);
        }

// пропарсить шаблон и отдать готовый текст
function parse($tokens_name = array(), $tokens_vars = array()) {


                if (!(count($this->tokens)>1)) {
                        // нет токенов, просто отдаем текст
                        return $this->template;
                        };

       for ($i=0; $i<count($tokens_vars); $i++){
           $tokens_vars[$i] = strval($tokens_vars[$i]);
           };

                // есть токены 1-го уровня
       $reply = "";
       $tokens = $this->tokens;
       // заменить
       for ($i=0; $i<count($tokens_name); $i++){
           for ($j=0; $j<count($this->tokens); $j++){
               if ( strcmp($tokens_name[$i], $tokens[$j]) ==0 ) {
                   $tokens[$j] = $tokens_vars[$i];
                   };
               };
           };
       // собрать шаблон с реальными переменными
       for ($i=0; $i<count($tokens); $i++){
           $reply .= $tokens[$i];
           };


        //2 шаг - управляющие токены
        $step2 = split ("@@@", $reply);
                if (!(count($step2)>1)) {
                        // нет токенов 2-го уровня, просто отдаем текст на основе токенов 1-го уровня
                        return $reply;
                        };

                // есть управляющие токены
        $reply2 = "";
        for ($m=0; $m<count($step2); $m++){
                        $tmp = split ($this->token_pattern2, $step2[$m]);
                        if (count($tmp)==3) {
                                // token 2-го уровня
                                $tname=$tmp[0];
                                $tvalues=$tmp[1];
                                $ttemplates=$tmp[2];
                $tttv = split ($this->token_pattern3, $tvalues);
                $tttt = split ($this->token_pattern3, $ttemplates);
                for ($i=0; $i<count($tokens_name); $i++){
                        // управляющ. токен
                    if ($tname==$tokens_name[$i]) {
                        $is_default = true;
                        for ($j=0; $j<count($tttv); $j++){
                                if ($tttv[$j] == $tokens_vars[$i]) {
                                // управляющее значение определено
                                $reply2.=$tttt[$j];
                                $is_default = false;
                                };
                                                        };
                            if ($is_default) {
                                                                // шаблон по умолчанию
                                $reply2.=$tttt[sizeof($tttt)-1];
                                };
                                                        };
                                                };
                                        }
                                else 
                                        {
                                        // не токен 2-го уровня
                    $reply2 .= $step2[$m];
                    };
        };
        return $reply2; 


        }


// внутренняя функция, содерж. файла - > в переменную
function get_file($template_name) {
        //отдать содержимое шаблона
        $reply = "";
                if (!file_exists($template_name)) {
                    trigger_error ("Unable to open template: ".$template_name."\nFILE=".__FILE__."\nLINE=".__LINE__, E_USER_ERROR);
                        };
        $f = fopen ( $template_name , "r");
        while ($buffer = fgets($f, filesize($template_name))) {
            $reply .= $buffer;
            }
        fclose($f);
        return $reply;
        }


// закодировать для input type text
function ttcode ($v) {
        $v = str_replace ("<", "&lt;"  , $v);
        $v = str_replace (">", "&gt;"  , $v);
        $v = str_replace ('"', "&quot;", $v);
        return $v;
        }

// раскодировать
function tdecode ($v) {
        $v = str_replace ("&lt;"  , "<", $v);
        $v = str_replace ( "&gt;" , ">", $v);
        $v = str_replace ("&quot;", '"', $v);
        return $v;
        }

}
?>
