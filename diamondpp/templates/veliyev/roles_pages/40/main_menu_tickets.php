<?php
$found='0';

// Проверяем, есть ли тикеты требующие нашего внимания
// Check whether there are tickets require our attention
if ($user_tip!='70') {$uid="`ot_kogo`='$user_id' AND";} else {$uid='';}
if (isset($offset) && isset($show_pages))
	{
	$sql_tickets = "SELECT * FROM tickets WHERE (`komu`='all' AND `status`='1') OR (`komu`='$user_id' AND `status`='1') OR (".$uid." `status`='1') ORDER BY `id` DESC LIMIT $offset, $show_pages";
	}
else
	{
	$sql_tickets = "SELECT * FROM tickets WHERE (`komu`='all' AND `status`='1') OR (`komu`='$user_id' AND `status`='1') OR (".$uid." `status`='1') ORDER BY `id` DESC";	
	}
$result_tickets = $mysqli->query($sql_tickets);
if (mysqli_num_rows($result_tickets) > 0) 
	{
	while($res_tickets=mysqli_fetch_array($result_tickets)) 
		{
		$ticket_id=htmlentities($res_tickets['id']);
		$ticket_theme=htmlentities($res_tickets['theme']);
		$ticket_ot_kogo=htmlentities($res_tickets['ot_kogo']);
		$ticket_komu=htmlentities($res_tickets['komu']);
		$ticket_status=htmlentities($res_tickets['status']);
		if ($user_tip=='70' && $ticket_ot_kogo!=$user_id && $found=='0')
			{
			$found='1';
			// Получаем данные ответов на тикет (если они есть)
			// Get the response data on the ticket (if any)
			$sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` DESC";	
			$result_ticket_reply = $mysqli->query($sql_ticket_reply);
			if (mysqli_num_rows($result_ticket_reply) > 0) 
				{
				$res_ticket_reply=mysqli_fetch_array($result_ticket_reply);
				$ticket_reply_ot_kogo=htmlentities($res_ticket_reply['ot_kogo']);
				if ($ticket_reply_ot_kogo!=$user_id)
					{
					if (curr_file()!='tickets.php') {?> | <a href="./tickets.php"><div class="send_ticket2" style="top: 1px;"></div></a><script>$(document).ready(function() {var freqSecs = 0.5; setInterval (blink, freqSecs*1000 ); function blink() {var inout = (freqSecs*1000)/0.5; $(".send_ticket2").fadeIn(inout).fadeOut(inout);}});</script><?php }
					}
				}
			else
				{
				if (curr_file()!='tickets.php') {?> | <a href="./tickets.php"><div class="send_ticket2" style="top: 1px;"></div></a><script>$(document).ready(function() {var freqSecs = 0.5; setInterval (blink, freqSecs*1000 ); function blink() {var inout = (freqSecs*1000)/0.5; $(".send_ticket2").fadeIn(inout).fadeOut(inout);}});</script><?php }
				}
			} 
		elseif ($user_tip=='70' && $ticket_komu!=$user_id && $found=='0')
			{
			$found='1';
			// Получаем данные ответов на тикет (если они есть)
			// Get the response data on the ticket (if any)
			$sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` DESC";	
			$result_ticket_reply = $mysqli->query($sql_ticket_reply);
			if (mysqli_num_rows($result_ticket_reply) > 0) 
				{
				$res_ticket_reply=mysqli_fetch_array($result_ticket_reply);
				$ticket_reply_ot_kogo=htmlentities($res_ticket_reply['ot_kogo']);
				if ($ticket_reply_ot_kogo!=$user_id)
					{
					if (curr_file()!='tickets.php') {?> | <a href="./tickets.php"><div class="send_ticket2" style="top: 1px;"></div></a><script>$(document).ready(function() {var freqSecs = 0.5; setInterval (blink, freqSecs*1000 ); function blink() {var inout = (freqSecs*1000)/0.5; $(".send_ticket2").fadeIn(inout).fadeOut(inout);}});</script><?php }
					}
				}
			}
		elseif ($user_tip!='70' && $ticket_ot_kogo==$user_id && $found=='0')
			{
			$found='1';
			// Получаем данные ответов на тикет (если они есть)
			// Get the response data on the ticket (if any)
			$sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` DESC";	
			$result_ticket_reply = $mysqli->query($sql_ticket_reply);
			if (mysqli_num_rows($result_ticket_reply) > 0) 
				{
				$res_ticket_reply=mysqli_fetch_array($result_ticket_reply);
				$ticket_reply_ot_kogo=htmlentities($res_ticket_reply['ot_kogo']);
				if ($ticket_reply_ot_kogo!=$user_id)
					{
					if (curr_file()!='tickets.php') {?> | <a href="./tickets.php"><div class="send_ticket2" style="top: 1px;"></div></a><script>$(document).ready(function() {var freqSecs = 0.5; setInterval (blink, freqSecs*1000 ); function blink() {var inout = (freqSecs*1000)/0.5; $(".send_ticket2").fadeIn(inout).fadeOut(inout);}});</script><?php }
					}
				}
			}
		elseif ($user_tip!='70' && $ticket_komu==$user_id && $found=='0')
			{
			$found='1';
			// Получаем данные ответов на тикет (если они есть)
			// Get the response data on the ticket (if any)
			$sql_ticket_reply = "SELECT * FROM tickets_reply WHERE `ticket_id`='$ticket_id' ORDER BY `id` DESC";	
			$result_ticket_reply = $mysqli->query($sql_ticket_reply);
			if (mysqli_num_rows($result_ticket_reply) > 0) 
				{
				$res_ticket_reply=mysqli_fetch_array($result_ticket_reply);
				$ticket_reply_ot_kogo=htmlentities($res_ticket_reply['ot_kogo']);
				if ($ticket_reply_ot_kogo!=$user_id)
					{
					if (curr_file()!='tickets.php') {?> | <a href="./tickets.php"><div class="send_ticket2" style="top: 1px;"></div></a><script>$(document).ready(function() {var freqSecs = 0.5; setInterval (blink, freqSecs*1000 ); function blink() {var inout = (freqSecs*1000)/0.5; $(".send_ticket2").fadeIn(inout).fadeOut(inout);}});</script><?php }
					}
				}
			else
				{
				if (curr_file()!='tickets.php') {?> | <a href="./tickets.php"><div class="send_ticket2" style="top: 1px;"></div></a><script>$(document).ready(function() {var freqSecs = 0.5; setInterval (blink, freqSecs*1000 ); function blink() {var inout = (freqSecs*1000)/0.5; $(".send_ticket2").fadeIn(inout).fadeOut(inout);}});</script><?php }
				}	
			}	
		}
	}
?>

