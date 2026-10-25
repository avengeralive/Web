<?php
if ($s->id == $c->id)
{  

	if ( $a->getUnparsedUrl() )
	{
		
		include( 'ordinary.php' );
		
	} 
	else 
	{
	
		if ($t->config->index_template)
		{
			$tpl = str_replace($t->getUrl().'/design/','',$t->config->index_template);
			$twig->display($tpl);
		}
		else
		{
			$twig->display('page_index.twig');
		}
	
	}

} 
else
{
    include( 'ordinary.php' );
}