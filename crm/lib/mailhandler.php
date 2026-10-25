<?php
set_include_path( '/var/www/vocu/lib' . PATH_SEPARATOR . get_include_path() );
include_once 'class.mail.phpmailer.php';
include_once 'class.mail.smtp.php';

$mysql = new PDO( "mysql:host=localhost;charset=UTF8", 'www-data', 'POLNe7UDnK8ui4Nz' );

$counter = 0;

foreach ( $mysql->query( "SHOW DATABASES" )->fetchAll( PDO::FETCH_COLUMN ) as $db )
{
	if ( $mysql->query( "SHOW TABLES FROM `$db` LIKE 'email_queue'" )->rowCount() )
	{
		$mysql->exec( "USE `$db`" );
		$queue = $mysql->query( "SELECT email_queue.* FROM email_queue WHERE trying < NOW() AND sending IS NULL ORDER BY trying LIMIT 15" )->fetchAll( PDO::FETCH_OBJ );
		foreach ( $queue as $line )
		{
			$smtp = new \PHPMailer( false );
			$smtp->XMailer = 'PHP/'.phpversion();
			$smtp->SetLanguage( 'ru' );
			$smtp->CharSet = 'UTF-8';
			$smtp->isSMTP();
			$smtp->Host = 'localhost';
			$smtp->SetFrom( $line->sender );
			$smtp->AddAddress( $line->recipient );
			$smtp->Subject = $line->subject;
			$smtp->addCustomHeader("List-Unsubscribe",'<mailto:admin@appcars.ru?subject=unsubscribe&body=' . $_POST['to_id'] . '>');
			$smtp->msgHTML( $line->body );
			$result = $smtp->send();
			$line->log .= date('[Y-m-d H:i:s]').' To: '.$line->recipient.' From: '.$line->sender.' Status: '.($smtp->ErrorInfo?$smtp->ErrorInfo:'OK')."\n";
			
			if ( !$result && $line->attempts < 5 ) {
				// Если неудача и число попыток меньше 5 откладываем отправку на число дней
				$query = "UPDATE email_queue SET trying=NOW()+INTERVAL {$line->attempts} DAYS, attempts=attempts+1, log=? WHERE email=? AND recipient=?";
			} else {
				// Иначе отмечаем завершение (удача или исчерпано число попыток)
				$query = "UPDATE email_queue SET sending=NOW(), log=? WHERE email=? AND recipient=?";
			}
			
			$sth = $mysql->prepare( $query );
			$sth->execute( [ $line->log, $line->email, $line->recipient ] );
			if ( ++$counter > 15 ) exit;
			sleep(4);
		}
	}
}

