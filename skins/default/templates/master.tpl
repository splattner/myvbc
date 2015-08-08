<?xml version=\"1.0\" encoding=iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			{$siteTitle}
		</title>


        <script src="libs/jquery/jquery-1.11.3.min.js"></script>
		
	{$xajax_javascript}
	
	{literal}
	<script type="text/javascript">
		xajax.callback.global.onRequest = function() {xajax.$('loading').style.display = 'block';}
		xajax.callback.global.beforeResponseProcessing = function() {xajax.$('loading').style.display='none';}
 	 </script>
  	{/literal}
  	
	{$customer_javascript}
		
	<link rel="stylesheet" type="text/css" media="screen, print" href="skins/default/css/style.css">
	<link rel="stylesheet" type="text/css" media="print" href="skins/default/css/print.css">

		
	</head>
	<body>
	{popup_init src="libs/overlib421/overlib.js"}
	<div id="container">
		<div id="header">
			<div id="navigation">
				{include file='navigation.tpl'}
			</div>
			<div id="loader">
				{include file='loaderDiv.tpl'}
			</div>
		</div>
		<div id="content">
			{include file=$content}
		</div>
	</div> 
	{$loaderJavaScript}
	</body>
</html>