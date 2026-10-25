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
 
class RecentlyViewed extends \Cetera\Iterator\Object {
		
    public function __construct($exclude = null)
    {
		if (isset($_SESSION['sale_recently_viewed']))
		{
			$a = $_SESSION['sale_recently_viewed'];
			if ($exclude)
			{
				$ek = array_search($exclude,$a);
				if ($ek !== false) unset($a[$ek]);
			}
			return parent::__construct(array_values($a));
		}
		else
		{
			return parent::__construct();
		}
    }   
	
    /**
     * Возвращает текущий элемент              
     *             
     * @return FSObject  
     */
    public function current()
    {
		$p = $this->getPosition();

		if (!is_object($this->elements[$p]))
		{
		    try {
			$this->elements[$p] = \Sale\Product::getById($this->elements[$p]);
                    }
                    catch (\Exception $e) {
                        continue;
                    }
		}
		return $this->elements[$p];
    }	
	
	public function where()
	{
		return $this;
	}
}
