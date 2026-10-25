<?php
namespace Sale;

class WidgetCompare extends \Cetera\Widget\Templateable
{
	private $_fields = null;

    protected $_params = array(
	    'template'       => 'default.twig',
    ); 

	protected function init()
	{
	    $this->application->addScript('/plugins/sale/js/locale.php?locale='.$this->application->getLocale());
		$this->application->addScript('/plugins/sale/js/common.js');
	}	
	
	public function getCompare()
	{
		return \Sale\Compare::get();
	}
	
	public function isDiffOnly()
	{
		return (isset($_GET['diff']))?true:false;
	}	
	
	public function getFields()
	{
		if ($this->_fields === null) {
			$this->_fields = array();
			
			$fields = explode(',', $this->getParam('fields'));
			$od = Product::getObjectDefinition();
			
			foreach ($fields as $f) {
				
				try {
					$fld = $od->getField(trim($f));
					if ( $this->isDiffOnly() && !$this->getCompare()->isValuesDiffer($fld) ) {
						continue;
					}					
					$this->_fields[] = $fld;
				} catch (\Exception $e) {
					continue;
				}
			}
			
		}
		return $this->_fields;
	}

	public function fieldValue($product, $field)
	{
		return $this->getCompare()->fieldValue($product, $field);
	}	
	
}