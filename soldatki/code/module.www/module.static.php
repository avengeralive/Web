<?php
########################################################
#	module.static.php
#
#	Модуль статической информации
#	Выводит одну статическую страницу с текстом
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
class MODULE_static	{

	function _init()	{

		$this->engine->modules->prepare_landing( $this );

		$this->tpl_file = 'static/index.tpl';
		$this->page = $this->engine->static_info;

	}

	function _start()	{

		if(
			isset($this->page['use_default_tpl']) &&
			empty($this->page['use_default_tpl']) &&
			$this->template->templateExists( 'static/'.$this->page['link'].'.tpl' )
		) {
			$this->tpl_file = 'static/'. $this->page['link'] .'.tpl';
		}

		if( !empty($this->page['title']) )
		$this->template->meta['title'] = &$this->page['title'];

		if( !empty($this->page['meta_keywords']) )
		$this->template->meta['keywords'][] = $this->page['meta_keywords'];

		if( !empty($this->page['meta_description']) )
		$this->template->meta['description'] = $this->page['meta_description'];

		$this->prepareDisplaying();

		$this->template->assignByRef( 'static', $this->page );
		$this->template->display( $this->tpl_file );

	}

	function prepareDisplaying() {

		switch( $this->page['link'] ) {

			case 'dealers':
			case 'contacts':
				// $this->template->update_capcha_url();
			break;

		}

	}
}

?>
