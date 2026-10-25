<?

    $fp = fsockopen('api.elasticemail.com', 80, $errno, $errstr, 10);

    if(!$fp) {
      echo "ERROR. Could not open connection $errno  $errstr ";
       }
    else {
     echo 'connect OK';
	};
