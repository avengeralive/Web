<?php
namespace Sale;

class WidgetCatalog extends \Cetera\Widget\Section
{
	
	public $productObjectDefinition = null;
	public $view = 'default.twig';
	public $filter = null;
	public $iterator = null;
	public $order = 'name';	
	public $sort = 'asc';

	protected function initParams()
	{
		$this->_params = array(
			'product_catalog'  => null,		
			'show_meta'        => true,
			
			'filter'           => false,
			'filter_name'      => 'filter',
			'filter_css_class' => 'filter',
			
			'compare'          => true,
			'compare_url'      => '/compare/',	
			
			'item_field_picture'   => 'pic',
			'item_field_pictures'  => 'pictures',
			'item_show_tabs' 	   => 'text',
			'item_show_properties' => 'code',
			'item_show_comments'   => true,		
			'item_share_buttons'   => true,
			'show_show_options'    => false,
			'item_template'        => 'default.twig',
			
			'list_limit'        => 16,
			'list_paginator_url'=> '{catalog}?{filter}page={page}',
			
			'page404_title'     => $this->t->_('Страница не найдена'),
			'page404_template'	=> null,	

			'template'       => 'default.twig',
		);  		
	}		
	
	protected function init()
	{
		
	        $this->application->addScript('/plugins/sale/js/locale.php?locale='.$this->application->getLocale());
		$this->application->addScript('/plugins/sale/js/common.js');
		$this->application->addScript('/plugins/sale/js/jquery-ui.min.js');
				
		$this->productObjectDefinition = \Sale\Product::getObjectDefinition();
		

		if (!$this->application->getUnparsedUrl())
		{
			
			$s = $this->application->getSession();
			if (isset($s->saleCatalogView)) $this->view = $s->saleCatalogView;
			
			if (isset($_GET['view']))
			{
				if ($_GET['view'] == 'strings') 
					$this->view = 'strings.twig';
					else $this->view = 'default.twig';
				$s->saleCatalogView = $this->view;
			}
			
			if (isset($s->saleCatalogOrder)) $this->order = $s->saleCatalogOrder;
			if (isset($s->saleCatalogSort)) $this->sort = $s->saleCatalogSort;
			if (isset($_GET['sort']))
			{
				list($this->order, $this->sort) = explode('|',$_GET['sort']);
				if (strtolower($this->sort) != 'asc' && strtolower($this->sort) != 'desc') $this->sort = 'asc';
				$this->order = mysql_real_escape_string($this->order);
				if (!$this->order) $this->order = 'name';
				$s->saleCatalogOrder = $this->order;
				$s->saleCatalogSort = $this->sort;
			}
		
			$this->iterator = $this->getCatalog()->getMaterials()->subfolders()->orderBy($this->getParam('order'), $this->getParam('sort'));
						
			if ($this->getParam('filter'))
			{
				$this->filter = \Sale\Filter::get($this->getParam('filter_name'), $this->productObjectDefinition, $this->getCatalog() );
				$this->filter->apply($this->iterator);
			}
		}
		
	}

	public function getListPaginatorUrl()
	{
		$value = $this->getParam('list_paginator_url');
		$filter = '';
		if ($this->filter)
		{
			$filter = $this->filter->getQueryString();
			if ($filter) $filter .= '&';
		}
		$value = str_replace('{filter}', $filter, $value );
		return $value;
		
	}
		
}