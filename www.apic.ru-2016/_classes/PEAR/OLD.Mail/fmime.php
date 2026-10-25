<?

// http://pear.php.net/bugs/bug.php?id=30 
// 


class fMail_Mime extends Mail_Mime {
function _encodeHeaders($input)
{
    foreach ($input as $hdr_name => $hdr_value) 
    {
        if (preg_match('/(\w*[\x80-\xFF]+\w*)/', $hdr_value))
           
$hdr_value='=?'.$this->_build_params['head_charset'].'?B?'.base64_encode($hdr_value).'?=';
        $input[$hdr_name] = $hdr_value;
    }
    return $input;
}

/*
// проблемы с знаками - : итп в сабжекте, яндекс считает заголовок некорректным.
function _encodeHeaders($input)
    {
        foreach ($input as $hdr_name => $hdr_value) {
            preg_match_all('/(\w*[\x80-\xFF ]+\w*)/', $hdr_value,
$matches);
            foreach ($matches[1] as $value) {
                $replacement = preg_replace('/([\x80-\xFF ])/e',
                                            '"=" .
                                           
strtoupper(dechex(ord("\1")))',
                                            $value);
                if($replacement == "=20") break;
                $hdr_value = str_replace($value, '=?' .
                                        
$this->_build_params['head_charset'] .
                                         '?Q?' . $replacement . '?=',
                                         $hdr_value);
            }
            $input[$hdr_name] = $hdr_value;
        }

        return $input;
    }
*/

}


?>