<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">

<head>

	<title>{$meta.title_prefix}{$meta.title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content='{$meta.keywords}'>
	<meta name="description" content='{$meta.description}'>
	<link rel="icon" type="image/png" href="{$uri}/assets/images/favicon.png" />

	<link rel="stylesheet" type="text/css" href="{$uri}/assets/css/styles.www.lk.css" media="all" />
	{section name=i loop=$css_f}
	<link rel="stylesheet" type="text/css" href="{$uri}/assets/css/{$css_f[i]}.css" media="all" />
	{/section}

</head>
<body>
<center>

<div id="pageBody">
<div id="top"></div>
	<div id="pageHead">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td class="tm" valign="middle">
				<div>
					<span>Система администрирования</span>
					<a href="{$uri}/" style="font-size: 12px;color: black;">[вернуться на сайт]</a>
					<span class="disk-free-container">свободно: <span class="disk-free js-stat" data-stat-name="space_free">{$space_free}</span> из <span class="disk-total js-stat" data-stat-name="space_total">{$space_total}</span>, активных задач конвертирования: <span class="active-convert-tasks js-stat" data-stat-name="active_convert_tasks">{$active_convert_tasks}</span>
				</div>
				<div>
					Пользователь: <img src='{$uri}/assets/images/lk/man.png' align="absmiddle" /> {$user.email}
					<a href="{$uri}/lk/logout/">выход</a><br />
				</div>
			</td>
		</tr>
		</table>
	</div>

	<div id="menu1">
		<ul>
		{foreach $lk_modules as $id => $data }
			<li{if $selected_module==$id} class="active"{/if}>
				<a href="{$uri}/lk/{$id}/">{$data.title}{if isset($data.count_index)&&isset($counts[$data.count_index])} ({$counts[$data.count_index]}){/if}</a>
			</li>
		{/foreach}
		</ul>
	</div>


	<div id="globalContent" style="display:block">
