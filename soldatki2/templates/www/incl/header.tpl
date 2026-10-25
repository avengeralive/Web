<!DOCTYPE html>
<html lang="en">
<head>
	<title>{$meta.title_prefix}{$meta.title}{$meta.title_postfix}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content='{$meta.keywords}'>
	<meta name="description" content='{$meta.description}'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/assets/fonts/PFDinDisplayPro/stylesheet.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	{section name=i loop=$css_f}
	<link rel="stylesheet" type="text/css" href="{$uri}/assets/css/{$css_f[i]}.css" media="all" />
	{/section}
</head>
<body>
<!--LiveInternet counter--><script type="text/javascript">
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+
";"+Math.random();</script><!--/LiveInternet-->