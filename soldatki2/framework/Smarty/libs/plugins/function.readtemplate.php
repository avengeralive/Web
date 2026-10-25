<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Include a template file without parsring it.
 * This function embeds another template file within a parent template, without parsing it. So, you can easily write { and } delimiters too.

 * Type:     function<br>
 * Name:     readtemplate<br>
 * Purpose:  Include a template file without parsring it
 * @link http://smarty.php.net/manual/en/language.function.readtemplate.php
 *          readtemplate (Smarty online manual)
 * @author   Bimal Poudel <smarty at bimal dot org dot com dot np>
 */
function smarty_function_readtemplate($params, &$smarty)
{
   if(empty($params['file']))
   {
     trigger_error('Missing file name to read within the template.', E_USER_ERROR);
   }

   $file = '';
   if($smarty->templateExists($params['file']))
   {
      # template_dir will have a trailing slash ( / ) already in its config.
      $dirs = $smarty->getTemplateDir();
      $file = file_get_contents($dirs[0].$params['file']);
   }

   return($file);
}
?>