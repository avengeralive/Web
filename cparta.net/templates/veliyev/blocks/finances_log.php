
	<?php
	function build_pagination_url($page) 
		{
		$parameters = array('page' => $page);
		return '?'.http_build_query($parameters);
		}
	$result = $mysqli->query( "SELECT COUNT(id) AS count FROM `finances_log` WHERE `user_id`='$user_id'" );
	// Вывод количества страниц
	// Display the number of pages
	//pagination($result,100,11);
	?>

		
<div class="row grow">
    <div class="col-md-12">
        <div class="block">
            <div class="row irow">
                <div class="col-md-12">
					<table class="table fintable" style="width: 100%;">
						<tr>
				                    <th class="text-center"><?php echo $loc['finances.php']['t22']; ?></th>
				                    <th class="text-center"><?php echo $loc['finances.php']['t23']; ?></th>
				                    <th class="text-center" colspan="2"><?php echo $loc['finances.php']['t24']; ?></th>
				                    <th class="text-center"><?php echo $loc['finances.php']['t25']; ?></th>
				                    <th><?php echo $loc['finances.php']['t26']; ?></th>
				                    <th class="text-center"><?php echo $loc['finances.php']['t27']; ?></th>
				                    <th class="text-center"><?php echo $loc['finances.php']['t28']; ?></th>
						</tr>
						
						<?php
						if (isset($_GET['page'])) $offset = ($_GET['page'] - 1) * 100;
						else $offset = 0;
						$show_pages = 100;
						if (isset($offset) && isset($show_pages))
							{
							$sql_finances = "SELECT * FROM finances_log WHERE `user_id`='$user_id' ORDER BY `id` DESC LIMIT $offset, $show_pages";
							}
						else
							{
							$sql_finances = "SELECT * FROM finances_log WHERE `user_id`='$user_id' ORDER BY `id` DESC";
							}
						$result_finances = $mysqli->query($sql_finances);
						$cvet=0;
						if (mysqli_num_rows($result_finances) > 0) 
							{
							while($res_finances=mysqli_fetch_array($result_finances)) 
								{ 
								$finances_id=htmlentities($res_finances['id']);
								$finances_date=htmlentities($res_finances['date']);
								$finances_operation=htmlentities($res_finances['operation']);
								$finances_summ=htmlentities($res_finances['summ']);
								$finances_description=htmlentities($res_finances['description']);
								$finances_balance=htmlentities($res_finances['balance']);
								$finances_status=htmlentities($res_finances['status']);
									
								// Определяем буквенное название статуса
								// Determine the literal name of the status
								if ($finances_status=='1') {$finances_status_text='&nbsp;'; $finances_status_style="color: #D6AB05;";}
								elseif ($finances_status=='2') {$finances_status_text=$loc['finances.php']['t29']; $finances_status_style="color: #28B636;";}
								elseif ($finances_status=='3') {$finances_status_text=$loc['finances.php']['t30']; $finances_status_style="color: #EB001B;";}
									
								// Определяем буквенное название описания транзакции
								// Determine the literal name of the transaction description
								$sql_finances_tpl = "SELECT description FROM finances_tpl WHERE `id`='$finances_description'";
								$result_finances_tpl = $mysqli->query($sql_finances_tpl);
								$res_finances_tpl=mysqli_fetch_array($result_finances_tpl);
								$finances_description=htmlentities($res_finances_tpl['description']);
								
								// Определяем буквенное название типа операции
								// Determine the literal name of the type of operation
								if ($finances_operation=='1') {$finances_operation_text=$loc['finances.php']['t31'];}
								elseif ($finances_operation=='2') {$finances_operation_text=$loc['finances.php']['t32'];}
									
								?>
								<tr>
									<td class="text-center"><?php echo $finances_id; ?></td>
									<td class="text-center" width="200"><?php echo date('d.m.Y / H:i:s', strtotime($finances_date)); ?></td>
									<?php
									if ($finances_operation=='1') {echo '<td class="text-center">'.$finances_operation_text.'</td><td>&nbsp;</td>';}
									elseif ($finances_operation=='2') {echo '<td class="text-center" width="70">&nbsp;</td><td width="70">'.$finances_operation_text.'</td>';}
									?>
									<td class="text-center" width="150"><?php echo $finances_summ; ?></td>
									<td width="300"><?php echo $finances_description; ?></td>
									<td class="text-center" width="150"><?php echo $finances_balance; ?></td>
									<td class="text-center" style="font-weight:400;<?php echo $finances_status_style; ?>"><?php echo $finances_status_text; ?></td>
								</tr>
								<?php
								}
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
		
<p>
	<?php
	// Вывод количества страниц
	// Display the number of pages
	pagination($result,100,11);
	?>
</p>