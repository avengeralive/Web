// Avoid CSS expressions for IE7,IE6, use this script
(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'calc\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icn-apple': '&#xe900;',
		'icn-android': '&#xe901;',
		'icn-laptop': '&#xe902;',
		'icn-mobile': '&#xe903;',
		'icn-tablet': '&#xe904;',
		'icn-watch': '&#xe905;',
		'icn-tv': '&#xe906;',
		'icn-layout1': '&#xe907;',
		'icn-layout2': '&#xe908;',
		'icn-layout3': '&#xe909;',
		'icn-at': '&#xe90a;',
		'icn-tel': '&#xe90b;',
		'icn-people': '&#xe90c;',
		'icn-news': '&#xe90d;',
		'icn-profile': '&#xe90e;',
		'icn-catalog': '&#xe90f;',
		'icn-sms': '&#xe910;',
		'icn-message': '&#xe911;',
		'icn-talk': '&#xe912;',
		'icn-letter': '&#xe913;',
		'icn-cart': '&#xe914;',
		'icn-bag': '&#xe915;',
		'icn-rss': '&#xe916;',
		'icn-paycard': '&#xe917;',
		'icn-vr': '&#xe918;',
		'icn-ar': '&#xe919;',
		'icn-video': '&#xe91a;',
		'icn-smartwatch': '&#xe91b;',
		'icn-qrcode': '&#xe91c;',
		'icn-cloud': '&#xe91d;',
		'icn-integration': '&#xe91e;',
		'icn-secure': '&#xe91f;',
		'icn-invoice': '&#xe920;',
		'icn-analytic': '&#xe921;',
		'icn-manage': '&#xe922;',
		'icn-users': '&#xe923;',
		'icn-moderate': '&#xe924;',
		'icn-feedback': '&#xe925;',
		'icn-statistic': '&#xe926;',
		'icn-check': '&#xe927;',
		'icn-film': '&#xe928;',
		'icn-location': '&#xe948;',
		'icn-calendar': '&#xe953;',
		'icn-tablet2': '&#xe95a;',
		'icn-check2': '&#xea10;',
		'icn-mail': '&#xea86;',
		'icn-fb': '&#xea91;',
		'icn-vk': '&#xea98;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icn-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
