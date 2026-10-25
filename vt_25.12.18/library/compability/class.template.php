<?php
class template{

        var $var_names = array();
        var $files = array();
        var $start = '{';
        var $end = '}';

        function load_file($file_id, $filename){
                $this->files[$file_id] = fread($fp = fopen($filename, 'r'), filesize($filename));
                fclose($fp);
        }
		
		function load_db($name) {
		    $this->load_file($name,DOCROOT.'.design/'.$name.'.tpl');    
		}

        function set_identifiers($start, $end){
                $this->start = $start;
                $this->end = $end;
        }

        function traverse_array($file_id, $array){
                while(list(,$value) = each($array)){
                        if(is_array($value)) $this->traverse_array($file_id, $value);
                        else $this->var_names[$file_id][] = $value;
                }
        }

        function register($file_id, $var_name){
                if(is_array($var_name)){
                        $this->traverse_array($file_id, $var_name);
                }elseif($var_name != ''){
                        if(is_long(strpos($var_name, ',')) == TRUE){
                                $var_name = explode(',', $var_name);
                                for(reset($var_name); $current = current($var_name); next($var_name)) $this->var_names[$file_id][] = trim($current);
                        }else{
                                $this->var_names[$file_id][] = $var_name;
                        }
                }
        }

        function include_file($file_id, $filename){
                if(file_exists($filename)){
                        $include = fread($fp = fopen($filename, 'r'), filesize($filename));
                        fclose($fp);
                }else $include = '[ERROR: "'.$filename.'" does not exist.]';

                $tag = substr($this->files[$file_id], strpos(strtolower($this->files[$file_id]), '<include filename="'.$filename.'">'), strlen('<include filename="'.$filename.'">'));
                $this->files[$file_id] = str_replace($tag, $include, $this->files[$file_id]);
        }

        function parse($file_id, &$array){
		global $TPL;
		if (!is_array($array)) $array = $TPL;
                $file_ids = explode(',', $file_id);
                for(reset($file_ids); $file_id = trim(current($file_ids)); next($file_ids)){
                        /*while(is_long($pos = strpos(strtolower($this->files[$file_id]), '<include filename="'))){
                                $pos += 19;
                                $endpos = strpos($this->files[$file_id], '">', $pos);
                                $filename = substr($this->files[$file_id], $pos, $endpos-$pos);
                                $this->include_file($file_id, $filename);
                        }*/
						// parsing <if "varname"> ... </if "varname">
						while(is_long($pos = strpos(strtolower($this->files[$file_id]), '<if "'))){
							$pos += 5;
							$endpos = strpos($this->files[$file_id], '">', $pos);
							$temp_var = substr($this->files[$file_id], $pos, $endpos-$pos);
							$endpos1 = strpos($this->files[$file_id], '</if "'.$temp_var.'">', $endpos+2);
							$content = substr($this->files[$file_id], $endpos+2, $endpos1-$endpos-2);
							if (isset($array[$temp_var]) && $array[$temp_var]) {
							  $this->files[$file_id] = str_replace('<if "'.$temp_var.'">','',$this->files[$file_id]);
							  $this->files[$file_id] = str_replace('</if "'.$temp_var.'">','',$this->files[$file_id]);
							} else {
							  $this->files[$file_id] = str_replace('<if "'.$temp_var.'">'.$content.'</if "'.$temp_var.'">','',$this->files[$file_id]);
							}
						}

                        if(isset($this->var_names[$file_id]) AND count($this->var_names[$file_id]) > 0){
                                for($i=0; $i<count($this->var_names[$file_id]); $i++){
                                        $temp_var = $this->var_names[$file_id][$i];
                                        //global $$temp_var;
                                        $this->files[$file_id] = str_replace($this->start.$temp_var.$this->end, $array[$temp_var], $this->files[$file_id]);
                                }
                        }
                }
        }

        function parse_loop($file_id, $array_name){
                global $$array_name;

                $loop_code = '';
                $file = explode(chr(10), $this->files[$file_id]);

                $start_pos = strpos(strtolower($this->files[$file_id]), '<loop name="'.$array_name.'">') + strlen('<loop name="'.$array_name.'">');
                $end_pos = strpos(strtolower($this->files[$file_id]), '</loop name="'.$array_name.'">');

                $loop_code = substr($this->files[$file_id], $start_pos, $end_pos-$start_pos);

                $start_tag = substr($this->files[$file_id], strpos(strtolower($this->files[$file_id]), '<loop name="'.$array_name.'">'),strlen('<loop name="'.$array_name.'">'));
                $end_tag = substr($this->files[$file_id], strpos(strtolower($this->files[$file_id]), '</loop name="'.$array_name.'">'),strlen('</loop name="'.$array_name.'">'));

                if($loop_code != ''){
                        $new_code = '';
						while(list($i,) = each(${$array_name})){
                        //for($i=0; $i<count($$array_name); $i++){


						// parsing <if "varname"> ... </if "varname">
						$middle_code = $loop_code;
						while(is_long($pos = strpos(strtolower($middle_code), '<if "'))){
							$pos += 5;
							$endpos = strpos($middle_code, '">', $pos);
							$temp_var = substr($middle_code, $pos, $endpos-$pos);
							$endpos1 = strpos($middle_code, '</if "'.$temp_var.'">', $endpos+2);
							$content = substr($middle_code, $endpos+2, $endpos1-$endpos-2);
							if (${$array_name}[$i][$temp_var]) {
							  $middle_code = str_replace('<if "'.$temp_var.'">','',$middle_code);
							  $middle_code = str_replace('</if "'.$temp_var.'">','',$middle_code);
							} else {
							  $middle_code = str_replace('<if "'.$temp_var.'">'.$content.'</if "'.$temp_var.'">','',$middle_code);
							}
						}


                                $temp_code = $middle_code;
                                while(list($key,) = each(${$array_name}[$i])){
                                        $temp_code = str_replace($this->start.$key.$this->end,${$array_name}[$i][$key], $temp_code);
                                }
                                $new_code .= $temp_code;

                        }
                        $this->files[$file_id] = str_replace($start_tag.$loop_code.$end_tag, $new_code, $this->files[$file_id]);
                }
        }

        function parse_sql($file_id, $result_name){
                global $$result_name;
                $loop_code = '';

                $start_pos = strpos(strtolower($this->files[$file_id]), '<loop name="'.$result_name.'">') + strlen('<loop name="'.$result_name.'">');
                $end_pos = strpos(strtolower($this->files[$file_id]), '</loop name="'.$result_name.'">');

                $loop_code = substr($this->files[$file_id], $start_pos, $end_pos-$start_pos);

                $start_tag = substr($this->files[$file_id], strpos(strtolower($this->files[$file_id]), '<loop name="'.$result_name.'">'),strlen('<loop name="'.$result_name.'">'));
                $end_tag = substr($this->files[$file_id], strpos(strtolower($this->files[$file_id]), '</loop name="'.$result_name.'">'),strlen('</loop name="'.$result_name.'">'));

                if($loop_code != ''){
                        $new_code = '';
                        $field_names = array();
                        for($i=0; $i<mysql_num_fields($$result_name); $i++) $field_names[] = mysql_field_name($$result_name,$i);
                        while($row_data = mysql_fetch_array($$result_name, MYSQL_ASSOC)){
                                $temp_code = $loop_code;
                                for($i=0; $i<count($field_names); $i++){
                                        $temp_code = str_replace($this->start.$field_names[$i].$this->end, $row_data[$field_names[$i]], $temp_code);
                                }
                                $new_code.= $temp_code;
                        }
                        $this->files[$file_id] = str_replace($start_tag.$loop_code.$end_tag, $new_code, $this->files[$file_id]);
                }
        }

        function print_file($file_id){
                if(is_long(strpos($file_id, ',')) == TRUE){
                        $file_id = explode(',', $file_id);
                        for(reset($file_id); $current = current($file_id); next($file_id)) echo $this->files[trim($current)];
                }else{
                        echo $this->files[$file_id];
                }
        }

        function return_file($file_id){
                $ret = '';
                if(is_long(strpos($file_id, ',')) == TRUE){
                        $file_id = explode(',', $file_id);
                        for(reset($file_id); $current = current($file_id); next($file_id)) $ret .= $this->files[trim($current)];
                }else{
                        $ret .= $this->files[$file_id];
                }
                return $ret;
        }

        function pprint($file_id, $replacements = '', &$array){
                $this->register($file_id, $replacements);
                $this->parse($file_id, $array);
                $this->print_file($file_id);
        }

        function pget($file_id, $replacements = '', &$array){
                $this->register($file_id, $replacements);
                $this->parse($file_id, $array);
                return $this->return_file($file_id);
        }

        function pprint_file($filename, $replacements = ''){
                for($file_id=1; isset($this->files[$file_id]); $file_id++);
                $this->load_file($file_id, $filename);
                $this->pprint($file_id, $replacements);
                unset($this->files[$file_id]);
        }

        function pget_file($filename, $replacements = ''){
                for($file_id=1; isset($this->files[$file_id]); $file_id++);
                $this->load_file($file_id, $filename);
                return $this->pget($file_id, $replacements);
        }

} // End of class