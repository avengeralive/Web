
						<form action="./zakaz.php" method="post">
							<?php echo $loc['zakaz.php']['t165']; ?>&nbsp;
							<select type="text" name="newstatus" id="newstatus">
								<option class="options" value="<?php if (isset($_GET['status'])) {echo htmlentities($_GET['status']);} else {echo '1';} ?>" selected><?php echo $loc['zakaz.php']['t176']; ?></option>
								<option class="options" value="1"><?php echo $loc['zakaz.php']['t124']; ?></option>
								<option class="options" value="2"><?php echo $loc['zakaz.php']['t125']; ?></option>
								<option class="options" value="3"><?php echo $loc['zakaz.php']['t126']; ?></option>
								<option class="options" value="0"><?php echo $loc['zakaz.php']['t127']; ?></option>
								<option class="options" value="5"><?php echo $loc['zakaz.php']['r1']; ?></option>
							</select>
							<input type="hidden" name="oldstatus" id="oldstatus" value="<?php if (isset($_GET['status'])) {echo htmlentities($_GET['status']);} else {echo '1';} ?>">
							
							<?php echo $loc['zakaz.php']['t175']; ?>&nbsp;
							<select type="text" name="newaddstatus" id="newaddstatus">
								<option class="options" value="100" selected><?php echo $loc['zakaz.php']['t176']; ?></option>
								<option class="options" value="0"><?php echo $loc['zakaz.php']['t16']; ?></option>
								<option class="options" value="1"><?php echo $loc['zakaz.php']['t17']; ?></option>
								<option class="options" value="2"><?php echo $loc['zakaz.php']['t18']; ?></option>
								<option class="options" value="3"><?php echo $loc['zakaz.php']['t19']; ?></option>
								<option class="options" value="4"><?php echo $loc['zakaz.php']['t20']; ?></option>
								<option class="options" value="5"><?php echo $loc['zakaz.php']['t21']; ?></option>
								<option class="options" value="6"><?php echo $loc['zakaz.php']['t22']; ?></option>
								<option class="options" value="7"><?php echo $loc['zakaz.php']['t146']; ?></option>
								<option class="options" value="8"><?php echo $loc['zakaz.php']['t147']; ?></option>
								<option class="options" value="9"><?php echo $loc['zakaz.php']['t148']; ?></option>
							</select>
							
							<input type="hidden" name="zakaznumbers" id="zakaznumbers" value="">
							<input type="submit" id="newstatus_submit" name="newstatus_submit" value="<?php echo $loc['zakaz.php']['t166']; ?>" style="margin: 0px 0px 0px 10px; width: 70px; height: 27px;" onclick="if (!confirm('<?php echo $loc['zakaz.php']['t167']; ?>'))return false;">
						</form>
						<br />
					