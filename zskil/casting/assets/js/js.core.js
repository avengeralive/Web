/////////////////////////////////////////////////////////
//	js.core.js
//
//	Общие функции для всех JS-файлов
//
//	Автор: И.Ашмарин, mail[-===-]harduino.com
//
/////////////////////////////////////////////////////////
var defaults = {

};

function get_costs( cost, index )	{

	var ret = {};

	if( typeof(cost) == 'string' )
	cost = parseFloat( cost.replace(/ /gim,"") );

	for( var cur_index in currency ) {
		if( cur_index == index ) {
			ret[ cur_index ] = cost;
		} else {
			ret[ cur_index ] = Math.ceil( cost / currency[cur_index] );
		}
	}

	return ret;
}

function get_func( $el, attr_name ) {

	var check_func_name = $el.attr( attr_name );
	if( check_func_name ) {
		var check_func = getFunctionFromString( check_func_name );
		if( typeof(check_func) != 'undefined' && check_func !== false ) {
			return check_func;
		}
	}
	return function() {};
}

function get_cost( value, format, no_kop, ret_empty_on_null ){

	if( typeof(no_kop) == 'undefined' ) var no_kop = 1;
	if( typeof(format) == 'undefined' ) var format = 1;
	if( typeof(ret_empty_on_null) == 'undefined' ) var ret_empty_on_null = 0;

	if( typeof(value) == 'number' ) value = value.toString();

	value = value . replace( /,/gim, "." ) . replace( /[^\d\.]/gim, "" );
	var rub = "", kop = "";

	if( value == "" || value == 0 )
		if( ret_empty_on_null )
			return "";
		else
			return "0" + ( no_kop ? "" : ".00" );

	var explode = value . toString() . split( "." );

	if( explode.length == 1 )
	{
		rub = value;
		kop = "00";
	}
	else
	{
		rub = explode[ 0 ];
		if( !explode[ 1 ].length )
			kop = "00";
		else
			if( explode[ 1 ].length == 1 )
				kop = explode[ 1 ] + "0";
			else
				kop = explode[ 1 ] . substr( 0, 2 );
	}

	if( format )
	{
		var new_rub = "", razryad_nomer = 0;

		for( var i = rub.length-1;i+1;new_rub += rub.substr(i,1), i--, razryad_nomer++ )
			if( razryad_nomer == 3 && !(razryad_nomer=0) )
				new_rub += " ";

		rub = "";

		for( var i = new_rub.length-1;i+1;i-- )
			rub += new_rub . substr( i, 1 );
	}

	return rub + ( no_kop ? "" : "." + kop );

}


function cel( name ){	return document.createElement(name); }
function gel( name ){	return document.getElementById(name); }
function cnod( text ){	return document.createTextNode(text); }

function isEmpty(ob){
	for(var i in ob){ if(ob[i]!=null)return false;}
	return true;
}
function count( obj )	{
	var counter = 0;
	for( var index in obj )
		if( obj[index] != null )
			counter++;
	return counter;
}

function ctable( params )	{

	// order_table=document.createElement("table");order_tbody=document.createElement("tbody")
	var table = document.createElement( "table" );
	var tbody = document.createElement( "tbody" );
	var j = 0;var k = 0;
	var tr = null;
	var td = null;

	var flag = { css:false, attr:false };

	for( var i = 0;i < params.trs.length;i++)
	{
		tr = document.createElement( "tr" );
		if( params.trs[i].tds != undefined )
		for( j = 0;j < params.trs[ i ].tds.length;j++ )
		{
			var td = document.createElement( "td" );
			// innerHTML
			if( params.trs[i].tds[j].html != undefined && params.trs[i].tds[j].html != null )
				for( k = 0;k < params.trs[i].tds[j].html.length;k++ )
					if( typeof(params.trs[i].tds[j].html[k]) == 'object' )
						td.appendChild( params.trs[i].tds[j].html[k] );
					else
						if( typeof(params.trs[i].tds[j].html[k]) == 'string' )
							td.appendChild( cnod(params.trs[i].tds[j].html[k]) );
						else
							alert( typeof(params.trs[i].tds[j].html[k]) );

			// css && attr
			flag.css  = typeof(params.trs[i].tds[j].css)  != 'undefined';
			flag.attr = typeof(params.trs[i].tds[j].attr) != 'undefined';
			if( flag.css && flag.attr )
				$( td )
					.css( params.trs[i].tds[j].css )
					.attr( params.trs[i].tds[j].attr )
				;
			else
				if( flag.css )
					$( td ).css( params.trs[i].tds[j].css );
				else
					if( flag.attr )
						$( td ).attr( params.trs[i].tds[j].attr );
					else;

			// colspan
			if( params.trs[i].tds[j].colspan != undefined )	{
				td.colSpan = params.trs[i].tds[j].colspan;
				j += params.trs[i].tds[j].colspan;
			}

			// assign to global var
			if( typeof(params.trs[i].tds[j].assign) != 'undefined' )
			eval( params.trs[i].tds[j].assign + ' = td;' );

			tr . appendChild( td );
		}

		// css && attr
		flag.css  = typeof(params.trs[i].css)  != 'undefined';
		flag.attr = typeof(params.trs[i].attr) != 'undefined';
		if( flag.css && flag.attr )
			$( tr )
				.css( params.trs[i].css )
				.attr( params.trs[i].attr )
			;
		else
			if( flag.css )
				$( tr ).css( params.trs[i].css );
			else
				if( flag.attr )
					$( tr ).attr( params.trs[i].attr );
				else;

		tbody . appendChild( tr );
	}
	table . appendChild( tbody );

	if( params.rules != undefined )
	table.rules = params.rules;

	if( params.frame != undefined )
	table.frame = params.frame;

	// css && attr
	flag.css  = typeof(params.css)  != 'undefined';
	flag.attr = typeof(params.attr) != 'undefined';
	if( flag.css && flag.attr )
		$( table )
			.css( params.css )
			.attr( params.attr )
		;
	else
		if( flag.css )
			$( table ).css( params.css );
		else
			if( flag.attr )
				$( table ).attr( params.attr );
			else;

	return table;
}

function filter( query, mask )	{
	var i, j;
	var result	= '';
	var c		= '';

	for( i = 0;i < query.length;i++ )
		for( j = 0;j < mask.length;j++ )
		{
			c = query.substr(i,1);
			if( c == mask.substr(j,1) )
			{
				result += c;
				break;
			}
		}

	return result;
}

function fill_zero( str, zero_count, right_join, symbol  )	{
	if( typeof(symbol) == 'undefined' ) var symbol = '0';
	if( typeof(right_join) == 'undefined' ) var right_join = false;

	var zeros = "";

	if( typeof(str) != 'string' )
	str = str.toString();

	//$len = strlen( $str );
	if( str.length >= zero_count )
	return str;

	for( var i = str.length;i < zero_count;i++ )
	zeros += symbol;

	if( right_join )
		return zeros + str;
	else
		return str + zeros;
}

function getFunctionFromString( string ) {
	var scope = window;
	var scopeSplit = string.split('.');
	for (i = 0; i < scopeSplit.length - 1; i++) {
		scope = scope[scopeSplit[i]];

		if( typeof(scope) == 'undefined' ) return false;
	}

	return scope[scopeSplit[scopeSplit.length - 1]];
}

function urlencode( str ){
	return encodeURIComponent(str).replace(/[!'()]/g, escape).replace(/\*/g, "%2A");
}

function lfToBr( str ) { return $.trim( str.replace(/(\r|\n|\r\n)/gim,'<br />') ); }
function brToLf( str ) { return str.replace( /<br(|\/|\s\/)>/gim, "\r\n" ); }


function doElsCollide(el1, el2) {
    el1.offsetBottom = el1.offsetTop + el1.offsetHeight;
    el1.offsetRight = el1.offsetLeft + el1.offsetWidth;
    el2.offsetBottom = el2.offsetTop + el2.offsetHeight;
    el2.offsetRight = el2.offsetLeft + el2.offsetWidth;

    return !((el1.offsetBottom < el2.offsetTop) ||
             (el1.offsetTop > el2.offsetBottom) ||
             (el1.offsetRight < el2.offsetLeft) ||
             (el1.offsetLeft > el2.offsetRight))
};

var loaded_scripts = {};
function load_script( url, onload_func, onload_params ){
	if( typeof(loaded_scripts[url]) != 'undefined' )	return false;
	if( typeof(onload_params) == 'undefined' )			var onload_params = {};
	if( typeof(onload_func) == 'undefined' )			var onload_func = function(){};

	var script = document.createElement( 'script' ),
		done = false
	;

	script.src = url;
	script.type = 'text/javascript';
	script.language = 'javascript';
	script.onload = script.onreadystatechange = function()
	{
		if( !done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete'))
		{
			done = true;

			// Handle memory leak in IE
			script.onload = script.onreadystatechange = null;
			script.parentNode.removeChild(script);

			// onload_func( onload_params );
			onload_func.call( onload_params );
		}
	};

	// sync way of adding script tags to the page
	document.body.appendChild( script );
	return loaded_scripts[ url ] = true;
};
