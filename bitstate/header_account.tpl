<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{$settings.site_name}</title>
	<link rel="stylesheet" type="text/css" href = "css/styles.css" />
<script src="/landing_files/libs/jquery/jquery-2.1.1.min.js"></script>
</head>
<body>
<div id="creeping_line2">
  <ul></ul>
</div>
<style>#creeping_line2 ul { padding: 0px;  } #creeping_line2 ul li { margin: 0 25px; font-weight: bold; display: inline-block; } #creeping_line2 { text-align: center; background: #f6f6f6;    width: 100%;
    height: 31px; }
#creeping_line2 .pair { color: #307bba; } #creeping_line2 .price { color: #36b2e6; }</style>
<script type="text/javascript">
  $(function(){
    $.ajax({
      url: "https://api.cryptonator.com/api/ticker/btc-usd",
      method: "get",
      success : function(data) {
        var price = Number(data.ticker.price);
        $("#creeping_line2 ul").append('<li><span class="pair">BTC/USD</span> = <span class="price">' + price.toFixed(5) + '</span></li>')
      }
    });
    $.ajax({
      url: "https://api.cryptonator.com/api/ticker/eth-usd",
      method: "get",
      success : function(data) {
        var price = Number(data.ticker.price);
        $("#creeping_line2 ul").append('<li><span class="pair">ETH/USD</span> = <span class="price">' + price.toFixed(5) + '</span></li>')
      }
    });
    $.ajax({
      url: "https://api.cryptonator.com/api/ticker/ltc-usd",
      method: "get",
      success : function(data) {
        var price = Number(data.ticker.price);
        $("#creeping_line2 ul").append('<li><span class="pair">LTC/USD</span> = <span class="price">' + price.toFixed(5) + '</span></li>')
      }
    });
    $.ajax({
      url: "https://api.cryptonator.com/api/ticker/bcn-usd",
      method: "get",
      success : function(data) {
        var price = Number(data.ticker.price);
        $("#creeping_line2 ul").append('<li><span class="pair">BCN/USD</span> = <span class="price">' + price.toFixed(5) + '</span></li>')
      }
    });
  });
</script>

<div id="page">
  <div id="header_user">
    <div id="logotip"><a href="{$settings.site_url}" title="{$settings.site_name}"><img src="images/Logotip.png" alt="" /></a></div>
    <div id="navigation">
      <div id="navigation_right"></div>
      <div id="navigation_center">
        <a href="?a=home" class="home"></a>
        {if $userinfo.logged != 1}
            <a href="?a=signup" class="register"></a>
        {/if}
        <a href="?a=referals" class="referral_system"></a>
        <a href="?a=faq" class="q_and_a"></a>
        <a href="?a=cust&page=rateus" class="monitors"></a>
        <a href="?a=support" class="support"></a>
      </div>
      <div id="navigation_left"></div>
    </div>
  </div>
  <div id="investment_plan"></div>

  <div id="wrapper">
    <div id="leftColomn">
		{include file="left_account.tpl"}
    </div>
    <div id="content">
		<div id="content_text">
    