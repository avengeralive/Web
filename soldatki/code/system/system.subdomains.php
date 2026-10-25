<?php
########################################################
# 	system.subdomains.php
#
#	Системный модуль для работы с субдоменами
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_subdomains {

	function _init( $static=false )	{

		init_interfaces( $this, $static, array('lists','logs') );

		$folders = array_reverse( explode( '.', strtolower( $_SERVER['HTTP_HOST'] ) ) );
		if( !isset($folders[2]) ) {
			$folders[2] = 'www';
		}

		$GLOBALS['subdomain'] = $GLOBALS['subdomain_r'] = $_SERVER['HTTP_HOST'];
		$no_num_domain = str_replace( array('0','1','2','3','4','5','6','7','8','9'), '', $folders[2] ); // str_replace быстрее regex
		if( !empty($folders[3]) && $this->lists->exists( $folders[3], 'subdomains', 'aliases' ) ) {
			$GLOBALS['subdomain'] = $this->lists->val($folders[3],'subdomains','aliases');
			$GLOBALS['subdomain_r'] = $folders[3];
		} else {
			if( !empty($folders[3]) && $this->lists->exists( $folders[3], 'subdomains', 'hosts' ) ) {
				$GLOBALS['subdomain'] = $folders[3];
				$GLOBALS['subdomain_r'] = $GLOBALS['subdomain'];
			} else {
				if( !empty($folders[2]) && $this->lists->exists( $folders[2], 'subdomains', 'hosts' ) ) {
					$GLOBALS['subdomain'] = $folders[2];
					$GLOBALS['subdomain_r'] = $GLOBALS['subdomain'];
				} else {
					// without numeric test
					if( !empty($no_num_domain) && $this->lists->exists( $no_num_domain, 'subdomains', 'hosts' ) ) {
						$GLOBALS['subdomain'] = $no_num_domain;
						$GLOBALS['subdomain_r'] = $GLOBALS['subdomain'];
					} else {
						// alias test
						if( $this->lists->exists($folders[2],'subdomains','aliases') ) {
							$GLOBALS['subdomain'] = $this->lists->val($folders[2],'subdomains','aliases');
							$GLOBALS['subdomain_r'] = $folders[2];
						} else {
							// without numeric test (alias)
							if( $this->lists->exists($no_num_domain,'subdomains','aliases') ) {
								$GLOBALS['subdomain'] = $this->lists->val($no_num_domain,'subdomains','aliases');
								$GLOBALS['subdomain_r'] = $no_num_domain;
							} else {
								$GLOBALS['subdomain'] = $this->lists->first( 'subdomains', 'hosts' );
								$GLOBALS['subdomain_r'] = $GLOBALS['subdomain'];
							}
						}
					}
				}
			}
		}
		// pr($GLOBALS['subdomain']);
		// pr($GLOBALS['subdomain_r'],1);

	}

}
?>
