<!DOCTYPE html>
<html lang="en">
<head>
	<title>{$meta.title_prefix}{$meta.title}{$meta.title_postfix}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content='{$meta.keywords}'>
	<meta name="description" content='{$meta.description}'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

	<link rel="icon" type="image/png" href="{$uri}/assets/images/favicon.png" />

	{section name=i loop=$css_f}
	<link rel="stylesheet" type="text/css" href="{$uri}/assets/css/{$css_f[i]}.css" media="all" />
	{/section}

</head>
<body>
