<?php
if (!$a->getUser() && $a->getUnparsedUrl()!='personal/wishlist')
{
	header('Location: /login');
	die();
}

switch ($a->getUnparsedUrl())
{
	case 'personal/wishlist':
		$twig->display('page_personal_wishlist.twig');
		break;	
	case 'personal/orders':
		$twig->display('page_personal_orders.twig');
		break;
	case 'personal/order':
		if (!(int)$_GET['id'])
		{
			header('Location: /personal/orders');
			die();
		}
		$twig->display('page_personal_order.twig',array(
			'order' => (int)$_GET['id']
		));
		break;		
	default: 
		$twig->display('page_personal.twig');
}