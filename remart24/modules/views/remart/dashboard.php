<div class="container-fluid" id="dashboardtable">
    <div class="row">
	<nav class="nav nav-pills flex-column flex-sm-row col-12">
	    <? if ($permissions['project_managers']->show) { ?><a class="nav-link" data-id="v-pills-projectmanagers"><? echo Translations::gi()->project_managers; ?></a><? } ?>
	    <? if ($permissions['realtors']->show) { ?><a class="nav-link" data-id="v-pills-realtors"><? echo Translations::gi()->realtors; ?></a><? } ?>
	    <? if ($permissions['realtor_companies']->show) { ?><a class="nav-link" data-id="v-pills-realtor_companies"><? echo Translations::gi()->realtor_companies; ?></a><? } ?>
	    <? if ($permissions['credit_specialists']->show) { ?><a class="nav-link" data-id="v-pills-creditspecialists"><? echo Translations::gi()->credit_specialists; ?></a><? } ?>
	    <? if ($permissions['banks']->show) { ?><a class="nav-link" data-id="v-pills-bank"><? echo Translations::gi()->banks; ?></a><? } ?>
	    <? if ($permissions['appraisers']->show) { ?><a class="nav-link" data-id="v-pills-appraiser"><? echo Translations::gi()->appraisers; ?></a><? } ?>
	    <? if ($permissions['objects']->show) { ?><a class="nav-link" data-id="v-pills-objects"><? echo Translations::gi()->objects; ?></a><? } ?>
	    <? if ($permissions['bids']->show) { ?><a class="nav-link" data-id="v-pills-bids"><? echo Translations::gi()->bids; ?></a><? } ?>
	    <? if ($permissions['buyers']->show) { ?><a class="nav-link" data-id="v-pills-buyer"><? echo Translations::gi()->buyers; ?></a><? } ?>
	</nav>
	<div class="tab-content col-12" id="v-pills-tabContent">
	    <? if ($permissions['project_managers']->show) { ?>
	    <div class="tab-pane" id="v-pills-projectmanagers">
	    <? 
		$user_group = "project_manager";
		$user_groups = "project_managers";
		$user_role = 4;
		$company = 0;
		$user_create = "create_".$user_group;
	    ?>
	    <? include('additional_user.php'); ?>
	    </div>
	    <? } ?>
	    <? if ($permissions['realtors']->show) { ?>
	    <div class="tab-pane" id="v-pills-realtors">
	    <? 
		$user_group = "realtor";
		$user_groups = "realtors";
		$user_role = 5;
		$company = 0;
		$user_create = "create_".$user_group;
	    ?>
	    <? include('additional_user.php'); ?>
	    </div>
	    <? } ?>
	    <? if ($permissions['realtor_companies']->show) { ?>
	    <div class="tab-pane" id="v-pills-realtor_companies">
	    <? 
		$user_group = "realtor_company";
		$user_groups = "realtor_companies";
		$user_role = 5;
		$company = 1;
		$user_create = "create_".$user_group;
	    ?>
	    <? include('additional_user.php'); ?>
	    </div>
	    <? } ?>
	    <? if ($permissions['credit_specialists']->show) { ?>
	    <div class="tab-pane" id="v-pills-creditspecialists">
	    <? 
		$user_group = "credit_specialist";
		$user_groups = "credit_specialists";
		$user_role = 6;
		$company = 0;
		$user_create = "create_".$user_group;
	    ?>
	    <? include('additional_user.php'); ?>
	    </div>
	    <? } ?>
	    <? if ($permissions['banks']->show) { ?>
	    <div class="tab-pane" id="v-pills-bank">
		<? include('additional_banks.php'); ?>
	    </div>
	    <? } ?>
	    <? if ($permissions['appraisers']->show) { ?>
	    <div class="tab-pane" id="v-pills-appraiser">
	    <? 
		$user_group = "appraiser";
		$user_groups = "appraisers";
		$user_role = 7;
		$company = 0;
		$user_create = "create_".$user_group;
	    ?>
	    <? include('additional_user.php'); ?>
	    </div>
	    <? } ?>
	    <? if ($permissions['objects']->show) { ?>
	    <div class="tab-pane" id="v-pills-objects">
	    <? include('additional_objects.php'); ?>
	    </div>
	    <? } ?>
	    <? if ($permissions['bids']->show) { ?>
	    <div class="tab-pane" id="v-pills-bids">
	    <? include('additional_bids.php'); ?>
	    </div>
	    <? } ?>
	    <? if ($permissions['buyers']->show) { ?>
	    <div class="tab-pane" id="v-pills-buyer">
	    <? 
		$user_group = "buyer";
		$user_groups = "buyers";
		$user_role = 8;
		$company = 0;
		$user_create = "create_".$user_group;
	    ?>
	    <? include('additional_user.php'); ?>
	    </div>
	    <? } ?>
	</div>
    </div>
</div>
<script>
    $(function() {
	$(".nav-pills a:first-child").addClass('active');
	$(".tab-pane:first-child").addClass('active');
    });
</script>