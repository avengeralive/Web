<?php echo $header; ?>
<div class="container">
	<?php require_once(dirname(__FILE__) . '/../common/breadcrumbs.tpl'); ?>
	<?php if ($success) { ?>
	<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
	<?php } ?>
	<div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
			<div class="account-container box-shadow box-corner">
				<h1><?php echo $heading_title; ?></h1>
				<div class="ac-block">
					<ul>
						<li><span class="ac-option"><?php echo $text_name; ?></span> <span class="as-value"> <?php echo $customerData['name']; ?>,</span></li>
						<li><span class="ac-option"><?php echo $text_phone; ?></span> <span class="as-value"> <?php echo $customerData['telephone']; ?>,</span></li>
						<li><span class="ac-option"><?php echo $text_email; ?></span> <span class="as-value"> <?php echo $customerData['email']; ?>,</span></li>
						<li><span class="ac-option"><?php echo $text_newsletter; ?></span> <span class="as-value"> <?php echo $customerData['newsletter'] ? $text_yes : $text_no; ?></span></li>
						
	        </ul>
					<a href="<?php echo $edit; ?>" class="btn"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $text_edit; ?></a>
				</div>
        <div class="ac-block">
        	<ul>
        	  <li><span class="ac-option"><?php echo $text_password; ?></span> <span class="as-value"> **** </span></li>
        		
        	</ul>
        	<a href="<?php echo $password; ?>" class="btn"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $text_edit; ?></a>
        </div>

          <div class="ac-block">
          	<ul>
          							<li><span class="ac-option"><?php echo $text_shipping; ?></span> <span class="as-value"><?php echo $addressData; ?> </span></li>
          						
          	</ul>
          	<a href="<?php echo $address; ?>" class="btn"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $text_edit; ?></a>
          </div>

			</div>
			<?php echo $content_bottom; ?></div>
		<?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
