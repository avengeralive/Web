<?php
namespace SaleWishlist;

class WidgetLine extends \Cetera\Widget\Templateable
{

    protected $_params = array(
        'wishlist_url' => '/wishlist/',
	    'template'       => 'default.twig',
	); 

	public function getCount()
	{
		return count(\Sale\WidgetWishList::getChildren());
	}


	
}