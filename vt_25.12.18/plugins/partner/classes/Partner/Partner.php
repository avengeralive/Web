<?php
namespace Partner;

class Partner {
	
  	const ACTION_REGISTER = 1;
  	
  	const STATUS_MODERATING = 0;
  	const STATUS_QUEUED     = 1;
  	const STATUS_PROCESSED  = 2;
  	const STATUS_REJECTED   = 3;
    
    const GLOBAL_PERCENT = 30;
	
	  private static $dbConnection;
	
	  public $id;
    public $fields;
	
    private function __construct($fields) 
    {
		    $this->id = $fields['id'];
        $this->fields = $fields;
    }
	
    public static function setDbConnection( $conn )
    {
        self::$dbConnection = $conn;
    }
    
    public static function actionName( $action )
    {
        switch ($action) {
            case self::ACTION_REGISTER: return 'Создание сайта';
        }
    }    
    
    public static function getDbConnection()
    {
        if (!self::$dbConnection) 
		{
			$app = \Cetera\Application::getInstance();
			$connectionParams = array(
				'dbname'   => 'tpl_fastsite_ru',
				'user'     => $app->getVar('dbuser'),
				'password' => $app->getVar('dbpass'),
				'host'     => $app->getVar('dbhost'),
				'driver'   => $app->getVar('dbdriver')?$this->getVar('dbdriver'):'pdo_mysql',
			);
	 
			self::$dbConnection = \Doctrine\DBAL\DriverManager::getConnection( 
				$connectionParams, 
				new \Doctrine\DBAL\Configuration()
			);           
				
			self::$dbConnection->executeQuery('SET CHARACTER SET utf8'); 
			self::$dbConnection->executeQuery('SET names utf8'); 			
		}
        return self::$dbConnection;
    }	
	
  	public static function getById($id)
  	{
  		$conn = self::getDbConnection();
  		
  		$partner = $conn->fetchAssoc('SELECT * FROM domains WHERE id = ?', array( $id ));
  		if ($partner) return new self($partner);
  		return NULL;		
  		
  	}
  	
  	public static function getByHost($host)
  	{
  		
    		$ip = gethostbyname($host);
    		if ($ip != SERVER_IP) return FALSE;
    		$host = str_replace('.'.DOMAIN,'',$host);
    		
    		$conn = self::getDbConnection();
    		
    		$partner = $conn->fetchAssoc('SELECT * FROM domains WHERE domain = ?', array( $host ));
    		if ($partner) return new self($partner);
    		return FALSE;
  		
  	}
    
  	public static function register($data)
  	{
    		$conn = self::getDbConnection();
    		
        $data['date'] = (new \DateTime("now"))->format('Y-m-d H:i:s');      
      	$conn->insert('domains', $data);	
        
        $partner = self::getById( $conn->lastInsertId() );
        
        if ($partner->fields['parent']) 
            $status = self::STATUS_MODERATING;
            else $status = self::STATUS_QUEUED;
        
        $partner->doAction( self::ACTION_REGISTER, 300, $status );
        
        return $partner;        		
  	}    
    
    public function doAction( $action, $sum, $status = \Partner\Partner::STATUS_MODERATING )
    {
        $conn = self::getDbConnection();
        $conn->executeQuery('INSERT INTO actions SET code=?, date=NOW(), client_id=?, status=?, sum=?', array($action, $this->id, $status, $sum) );    
    }
    
  	public static function processActions()
  	{
    		$conn = self::getDbConnection();
    		
        $data = $conn->fetchAll( 'SELECT * FROM actions WHERE status = ?', array( self::STATUS_QUEUED ) );
        foreach ($data as $action) {
        
            $client = self::getById( $action['client_id'] );
			if ($client)
				$client->processAction( $action );
        
        }       		
  	} 
	
	public function getParent()
	{
		if (!$this->fields['parent']) return NULL;
		return self::getById( $this->fields['parent'] );
	}
    
    public function processAction( $action )
    {
		if ($this->id != $action['client_id']) return;

        $percents = array(
            1 => array(100),
            2 => array(20,80),
            3 => array(15,25,60),
            4 => array(10,15,20,65),
            5 => array(5,10,15,20,50),
        );
		    
        $conn = self::getDbConnection();
		
		$parents = array();
		
		$parent = $this->getParent();
		while ($parent) 
		{
			$parents[] = $parent;
			$parent = $parent->getParent();
		}
		
		if (count($parents))
		{
			$percent = $percents[ count($parents) ];			
			$percent_value = $action['sum'] * self::GLOBAL_PERCENT / 100;
			
			foreach ($parents as $i => $parent)
			{
				$p = $percent_value * $percent[$i] / 100;
				
				$comment = 'Партнерский %';
				if ($action['code'] == self::ACTION_REGISTER) $comment .= ' за регистрацию сайта '.$this->fields['domain'].'.fastsite.ru';
					
				$conn->executeQuery('INSERT INTO money SET client_id=?, action_id=?, amount=?, comment=?, date=NOW()', array( $parent->id, $action['id'], $p, $comment ) );    
			}
			
		}

		$conn->executeQuery('UPDATE actions SET status=? WHERE id=?', array(self::STATUS_PROCESSED, $action['id']) );    
 
    } 

	public function getBalance()	
	{
	    $conn = self::getDbConnection();
		$res = $conn->fetchAssoc('SELECT SUM(amount) as balance FROM money WHERE client_id = ?', array( $this->id ));
		return $res['balance'];
	}
	
	public function getTransactions()	
	{
	    $conn = self::getDbConnection();
		$res = $conn->fetchAll('SELECT * FROM money WHERE client_id = ? ORDER BY date DESC LIMIT 10', array( $this->id ));
		return $res;
	}	
	
}