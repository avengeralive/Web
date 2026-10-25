<script type="text/javascript" charset="utf-8">
    $(function()
    {
        $('#logout').click(function(e)
        {
            $.ajax(
                {
                    url: "<?php echo Backstage::gi()->portal_url;?>auth/logout/",
                    type: "GET",
                    success:function(data, status, jqxhr)
                    {
                        location.reload(false);
                    },
                    error: function (request, status, error)
                    {
                        console.log(request.responseText);
                    }
                });
            e.preventDefault();
        });
    });
</script>

<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/layouts/"><?php echo Translations::gi()->layouts; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/pages/"><?php echo Translations::gi()->pages; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/contents/"><?php echo Translations::gi()->contents; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/catalogs/"><?php echo Translations::gi()->catalogs; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/designs/"><?php echo Translations::gi()->designs; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/forms/"><?php echo Translations::gi()->forms; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/users/"><?php echo Translations::gi()->users; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/grants/"><?php echo Translations::gi()->grants; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/subscribers/"><?php echo Translations::gi()->subscribers; ?></a></li>
                <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/translations/"><?php echo Translations::gi()->translations; ?></a></li>
                <li class="dropdown"><a href="#dummy">|</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php echo Translations::gi()->settings; ?><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>admin/siteConfigs/"><?php echo Translations::gi()->configurations; ?></a></li>
                        <li class="dropdown"><a href="<?php echo Backstage::gi()->portal_url; ?>updates/form/"><?php echo Translations::gi()->update; ?></a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#dummy" id="logout"><?php echo Translations::gi()->logout; ?></a></li>
				<?php 
						// Langbar query
					$lb = Loader::gi()->callModule('GET', 'pages/getLangBar', array('design'=>'admin_langbar'));
					$lb['query'] = $lb['body'];
					$lb = Loader::gi()->getLQ($lb);					
					echo $lb['query'];
				?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>