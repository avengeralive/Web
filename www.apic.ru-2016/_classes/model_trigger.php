<?


require_once CLASSES_BASE.'class_html_mime_mail.php';

class model_trigger{

function model_trigger($m){
	$this->m = &$m;
	}

/**
Триггер вызывать здесь. Сам определяет кому слать, шлет, и пишет лог
*/
function call_trigger($trigger_name, $params, $emails = array() ) {
	// получим триггер.
	$trigger = $this->get_trigger($trigger_name);
	if (!$trigger['status']) {
		return array(
			'status'=>false
			);
		};
	if (!isset($trigger['trigger']['body'])) {
		return array(
			'status'=>true
			);
		};

	// сформируем текст сообщения.
	$body = $trigger['trigger']['body'];
	$subject = $trigger['trigger']['subj'];
	reset($params);
	while (list($k, $v) = each($params)) {
		$body = preg_replace("/{{".$k."}}/ms", $v, $body);
		$subject = preg_replace("/{{".$k."}}/ms", $v, $subject);
		};

	// запишем событие в лог 
	$event_id = NULL;
	$e_s = $this->create_event($trigger_name, $body, $params);
	if (($e_s['status']) && ($e_s['event_id']>0) ){
		$event_id = $e_s['event_id'];
		}
	else {
		return array(
			'status'=>false
			);
		};

	// получим список подписавшихся
	$subscribers = $this->get_subscribers($trigger_name);
	// и добавим extra- массив 
	$subscribers['subscribers'] = array_merge( array_keys($subscribers['subscribers']), $emails);
	if (
		!(sizeof($subscribers['subscribers'])>0) 
		) {
		// рассылать письма некому, вернем что все хорошо.
		return array(
			'status'=>true,
			'event_id'=>$event_id
			);
		};

	// разошлем письма подписчикам.
	while (list($k, $email) = each($subscribers['subscribers'])) {
		html_mime_mail::sendTxtMail($email, $subject, $body, EHANDLER_ADMIN_EMAIL );
		$this->save_trigger_sended($event_id, $trigger_name, $email);
		};

	return array(
		'status'=>true,
		'event_id'=>$event_id
		);
	}


/**
Запомним событие в БД.
*/
function create_event($trigger_name, $message, $params){
	$q1 = "
		INSERT
			".MYSQL_DB.".TRIGGERS_EVENT
		SET
			trigger_name = '#trigger_name#',
			message        = '#message#',
			created      =  NOW()
		";
	$q2 = "
		INSERT
			".MYSQL_DB.".TRIGGERS_EVENT_PARAMS
		SET
			trigger_name = '#trigger_name#',
			event_id     = '#event_id#',
			param_name   = '#param_name#',
			param_value  = '#param_value#'
		";

    $this->m->begin(__FILE__, __LINE__);
	$r = $this->m->query($q1, __FILE__, __LINE__, 
        Array(
			'trigger_name'=>$trigger_name,
			'message'=>$message
            )
        );
    if ($this->m->error ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
	$event_id = $this->m->insert_id;

	// параметры
	while (list($param_name, $param_value) = each($params)) {
		$r = $this->m->query($q2, __FILE__, __LINE__, 
	        Array(
				'trigger_name'=>$trigger_name,
				'event_id'=>$event_id,
				'param_name'=>$param_name,
				'param_value'=>$param_value
	            )
	        );
	    if ($this->m->error ) {
	        $this->m->rollback(__FILE__, __LINE__);
	        return Array('status'=>false);
	        };
		};

    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

	return array(
		'status'=>true,
		'event_id'=>$event_id
		);
}


/**
Запомним что слали письмо
*/
function save_trigger_sended($event_id, $trigger_name, $email){
    $this->m->begin(__FILE__, __LINE__);
	$q = "
		INSERT
			".MYSQL_DB.".TRIGGERS_SENDED
		SET
			event_id     = '#event_id#',
			trigger_name = '#trigger_name#',
			email        = '#email#',
			created      =  NOW()
		";
	$r = $this->m->query($q, __FILE__, __LINE__, 
        Array(
			'event_id'=>$event_id,
			'trigger_name'=>$trigger_name,
			'email'=>$email
            )
        );
    if ($this->m->error ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
    return Array(
        'status'=>true
        );
}


/**
Кто подписался ..
*/
function get_subscribers($ID){
    $this->m->begin(__FILE__, __LINE__);
	$q = "
		SELECT
			email
		FROM
			".MYSQL_DB.".TRIGGERS_SUBSCRIBERS
		WHERE
			trigger_name = '#trigger_name#'
		";
	$r = $this->m->selectManyRowsByID($q,  'email' , __FILE__, __LINE__, 
        Array(
			'trigger_name'=>$ID
            )
        );
    if ($this->m->error ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
    return Array(
        'status'=>true, 
        'subscribers'=>$r
        );
	}


/**
*   Получить тело письма
*/
function get_trigger($ID){
    $this->m->begin(__FILE__, __LINE__);
	$q = "
		SELECT
			*
		FROM
			".MYSQL_DB.".TRIGGERS_DEFINED
		WHERE
			trigger_name = '#trigger_name#'
		LIMIT 1
		";
	$r = $this->m->selectOneRow($q, __FILE__, __LINE__, 
        Array(
			'trigger_name'=>$ID
            )
        );
    if ($this->m->error ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };
    return Array(
        'status'=>true, 
        'trigger'=>$r
        );
	}


}
?>