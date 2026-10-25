<?php
use lib\CPanel;
define( '_WEXEC', 1 );
include_once '/var/www/realt/list.php';


$Feed_Queue = new Feed_Queue();
$Feed_Queue->start_queue();

class Feed_Queue {
	
	function start_queue() {
		try {
		    $dbh = new PDO('mysql:host=localhost;dbname=realty', 'www-data', 'XGvPZzGs2WcM55Z7atcZ8hm');
		    foreach($dbh->query('SELECT * from `feed_new`  LIMIT 5') as $Result) {		        
				if (!empty($Result)) {
					$items = [];
					while ($item = $Result->fetch_assoc()) 
						$items[] = $item;
				
					foreach ( $items as $line ) {
    			    	$data = [
        					$line['user'], 
        					$line['domain']
    					];
						CPanel::feed_gen($data);
						$dbh->query("DELETE FROM `feed_new` WHERE ((`id` = '". $line['id'] ."'))");
						//JBase::Query("DELETE FROM `feed_new` WHERE ((`id` = '". $line['id'] ."'))");
					}
				}
		    }
		    $dbh = null;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	
}
	
	