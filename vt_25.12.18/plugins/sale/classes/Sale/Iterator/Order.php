<?php
/**
 * Cetera CMS 3 
 *
 * @package CeteraCMS
 * @version $Id$
 * @copyright 2000-2010 Cetera labs (http://www.cetera.ru) 
 * @author Roman Romanov <nicodim@mail.ru> 
 **/
 
namespace Sale\Iterator; 
 
class Order extends \Cetera\Iterator\DbObject {
		

    public function __construct()
    { 
        parent::__construct();
        $this->query->select('*')->from('sale_orders');
        
    } 
    	
	protected function fetchObject($row)
	{
		return new \Sale\Order( null, $row );
	}    

}
