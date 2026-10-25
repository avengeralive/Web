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
				<li class="dropdown">
					<a href="<?php echo Backstage::gi()->portal_url; ?>cms/pages/"><?php echo Translations::gi()->pages; ?></a>
				</li>				
				<li class="dropdown">
					<a href="<?php echo Backstage::gi()->portal_url; ?>cms/contents/"><?php echo Translations::gi()->contents; ?></a>
				</li>
				<li class="dropdown">
					<a href="#dummy" class="dropdown-toggle" data-toggle="dropdown"><?php echo Translations::gi()->catalogs; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
					<?php
						foreach ($catalogs as $catalog)
//							if (Pretorian::gi()->check('catalogs', 'POST', $catalog->id))
								echo '<li class="dropdown"><a href="'.Backstage::gi()->portal_url.'cms/catalogs?id='.$catalog->id.'">'.$catalog->catalog_title.'</a></li>';
					?>
					</ul>
				</li>
                <li class="dropdown"><a href="#dummy"></a></li>
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
