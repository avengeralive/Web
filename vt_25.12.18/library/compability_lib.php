<?php
header('Content-type: text/html; charset=UTF-8');
include_once('compability/compability_library.php');
include_once('compability/compability_library_forum.php');
include_once('compability/compability_library_users.php');
include_once('compability/class.template.php');

define('PAGE_BREAK', '<hr class="pagebreak" />');

$tpl = new Template;

function x_get_banner($group_alias) {
	return get_banner($group_alias);
}

function get_banner($group_alias) {
	return '<%BANNER['.$group_alias.']%>';
}

class FSSmarty extends Smarty {
	
		function assign_select($var, $idcat, $fields='*',$where='',$order='',$group='',$limit='',$subs=0) {
			$r = select($idcat,$fields,$where,$order,$group,$limit,$subs);
			if ($r) while ($f = mysql_fetch_assoc($r)) $this->append($var, $f);
		}
		
}
	
$smarty = new FSSmarty;

class Smarty_Resource_FS extends Smarty_Resource_Custom {
   protected function fetch($name, &$source, &$mtime)
   {
      $f = $this->getName($name);
  		$source = file_get_contents($f);
      $mtime = filemtime($f);
      return ($source)?true:false;
   }
   
   protected function fetchTimestamp($name) {
       return filemtime($this->getName($name));
   }
   
    protected function getName($name) {
    
        $name .= '.tpl';
    
        $a = Application::getInstance();
    
        $p = '/'.trim($a->getServer()->templateDir.$a->getCatalog()->url,'/');
        while(strrpos($p, '/') !== false) {
            $f = DOCROOT.'.design'.$p.'/'.$name;
            if (file_exists($f)) return $f;
            $p = substr($p, 0, strrpos($p, '/'));
        }
        return DOCROOT.'.design/'.$name;    
    }
}

$smarty->template_dir = DOCROOT.'.design';
$smarty->compile_dir = DOCROOT.'.smarty/templates_c';
$smarty->config_dir  = DOCROOT.'.smarty/configs';
$smarty->plugins_dir = DOCROOT.'library/smarty/plugins';
$smarty->cache_dir   = DOCROOT.'.smarty/cache';
$smarty->registerResource('fs', new Smarty_Resource_FS());

$smarty->assignByRef('breadcrumb', $BREADCRUMB);

/*
* cached_fopen_url 
* 
* Xbnftn данные из HTTP url
* 
* @param string URL
* @param string в каком режиме открывать файл с полученными данными
* @param integer через какое время содержимое файла считать устаревшим и перечитывать данные
* @param string путь, где хранится r'i
* @param intege время ожидания сокета
* @return file resoruce или FALSE в случае неудачи 
**/ 
function cached_fopen_url($url, $file_mode, $timeout_seconds = 90, $cache_path = ".cache", $fsocket_timeout = 10, $debug = false, $cache_filename = false) 
{ 
          //$handle = fopen($cache_path.'/test.xml', $file_mode); 
          //return $handle; 
          
   try {     
       clearstatcache(); 
       if (!$cache_filename) $cache_filename=$cache_path . "/" . urlencode($url) .".cached";
           else $cache_filename = $cache_path . "/" . $cache_filename; 
        
       if ($debug) { 
          print "local_cache creation_time =" . 
          @filemtime($cache_filename) . 
          " actual time = " . time() . 
          " timeout = " . 
          timeout_seconds ."<p>"; 
       } 
        
       if ( ( @file_exists($cache_filename ) and ( ( @filemtime($cache_filename) + $timeout_seconds) > ( time() ) ) ) ) { 
          // ok, file is already cached and young enouth 
          if ($debug) { print "using cached file ($cache_filename) <p>";} 
       } else { 
           
          if ($debug) { print "cacheing file ($url) to local ($cache_filename)<p>";} 
           
          $urlParts = parse_url($url); 
          $host = $urlParts['host']; 
          $port = (isset($urlParts['port'])) ? $urlParts['port'] : 80; 
           
          if( !$fp = @fsockopen( $host, $port, $errno, $errstr, $fsocket_timeout )) { 
             // Server not responding 
          } else { 
             $path = $urlParts['path'];
    	     if (!$path) $path = '/';
    	     if ($urlParts['query']) $path .= '?'.$urlParts['query'];
             if( !fputs( $fp, "GET ".$path." HTTP/1.0\r\nHost:$host\r\n\r\n" )) die( "unable to send get request" ); 
             $data = null; 
             stream_set_timeout($fp, $fsocket_timeout);    
             $status = socket_get_status($fp); 
             while( !feof($fp) && !$status['timed_out'])          
             { 
                $data .= fgets ($fp,8192); 
                $status = socket_get_status($fp); 
             } 
             fclose ($fp); 
             // strip headers 
             $sData = split("\r\n\r\n", $data, 2); 
             $data = $sData[1]; 
              
             // save to cache file 
             $f2 = fopen($cache_filename,"w+"); 
    		 if ($f2) {
             	fwrite($f2,$data); 
             	fclose($f2); 	     
    		 }
          } 
       } 
        
       // ok, point to (fresh) cached file 
       if ( @file_exists($cache_filename )) { 
          $handle = fopen($cache_filename, $file_mode); 
          return $handle; 
       } 
   } catch (\Exception $e) {   
   } 
   return false; 
} 

define('POLL_TIMEOUT', 1800);

if (isset($_REQUEST['poll']) && is_array($_REQUEST['poll']))
    foreach($_REQUEST['poll'] as $poll_id=>$poll_values) 
      Poll::get($poll_id)->vote($poll_values);

class Poll {

  public $fields = array();

  public static function get($id=0, $server=0)
  {
    if (!$server) $server = Application::getInstance()->getServer()->id;
    if (!$id && !$server) return FALSE;
    
    $slot = new Cache_Slot_Poll($id, $server);
    if (false === ($poll = $slot->load())) {
    
        if ($id) $where = "id=$id"; else $where = "type&1=1";
        $r = fssql_query("SELECT *, UNIX_TIMESTAMP(dat) as start, UNIX_TIMESTAMP(dat_end) as end FROM vote WHERE ".$where);
    
        if (!mysql_num_rows($r)) return FALSE;
        $f = mysql_fetch_assoc($r);
        $f['answers'] = array();
        
        $r = fssql_query('SELECT A.* FROM vote_answer A LEFT JOIN vote_vote_answer_answers B ON (A.id=B.dest) WHERE B.id='.$f['id'].' ORDER BY B.tag');
        while ($f1 = mysql_fetch_assoc($r)) $f['answers'][$f1['id']] = $f1;
        $poll = new Poll($f);
        $slot->addTag(new Cache_Tag_Poll($poll->id));
        $slot->save($poll);
    
    }
    return $poll;
  }
  
    public function __get($name)
    {
        return $this->fields[$name];
    }

  protected function __construct($f)
  {
    $this->fields = $f;
    $this->fields['question'] = $this->fields['name'];
    $this->fields['input_type'] = ($this->fields['multiple'])?'checkbox':'radio';
    $this->fields['all'] = 0;
    $this->fields['total'] = $this->fields['count'];
    
    $max = 0;
    foreach ($this->fields['answers'] as $aid => $value) if ($value) {
  	  if ($value['count'] > $max) $max = $value['count'];
  	  $this->fields['all'] += $value['count']; 
    }
    foreach ($this->fields['answers'] as $aid => $value) {
        if ($this->fields['count']) 
  		  $this->fields['answers'][$aid]['percent'] = round(1000*$value['count']/$this->fields['count'])/10;
  	    if ($max) 
  		  $this->fields['answers'][$aid]['width']   = round(100*$value['count']/$max); 
    }
  }
  
  private function clearCache() 
  {
    $tpl = new Cache_Tag_Poll($this->id);
    $tpl->clean();
  }
  
  private function getSession() 
  {
    return Application::getInstance()->getSession();
  }
  
  private function addToSession() 
  {
        $s =  $this->getSession();
	    if (!isset($s->vote) || !in_array($this->id, $s->vote)) {
	        if (!isset($s->vote)) $s->vote = array(); 
            $s->vote[] = $this->id; 
        }
  }
  
  public function isVoted()
  {
    $s =  $this->getSession();
    if (isset($s->vote) && is_array($s->vote) && in_array($this->id, $s->vote)) {
      return TRUE;
    } else {
    	$r = fssql_query("select time from vote_history where id='".$this->id."' and ip=".ip2long($_SERVER['REMOTE_ADDR']));
    	if (!mysql_num_rows($r)) return FALSE;
      if ((time() - mysql_result($r,0)) < POLL_TIMEOUT) {
	    $this->addToSession(); 	 
        return TRUE;
      }
      return FALSE;
    }
  }
  
  public function vote($poll_values)
  {    
    if ($this->isVoted()) return;
  	foreach($poll_values as $answer) {
  		$this->fields['answers'][$answer]['count']++;
  		$this->fields['all']++;
  	}
  	$this->fields['count']++;
  	$this->save();
	$this->addToSession(); 		
  }

  private function save()
  {
    if ($this->isVoted()) return;
    fssql_query("REPLACE vote_history (id,ip,time) values('".$this->id."', ".ip2long($_SERVER['REMOTE_ADDR']).", ".time().")");
    fssql_query('UPDATE vote SET count='.$this->fields['count'].' WHERE id='.$this->fields['id']);
    foreach($this->fields['answers'] as $value) {
        fssql_query('UPDATE vote_answer SET count='.$value['count'].' WHERE id='.$value['id']);
    }
    $this->clearCache();
  }
}

class Cache_Slot_Poll extends Cetera\Cache\Slot\Slot {
    public function __construct($id, $server) {
        parent::__construct("poll_{$id}_{$server}", 3600 * 24);
    }
}

class Cache_Tag_Poll extends Cetera\Cache\Tag\Tag {
    public function __construct($id) {
        parent::__construct("poll_{$id}");
    }
}
