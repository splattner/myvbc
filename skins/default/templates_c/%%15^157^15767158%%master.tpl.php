<?php /* Smarty version 2.6.22, created on 2011-12-25 11:03:50
         compiled from master.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup_init', 'master.tpl', 32, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version=\"1.0\" encoding=iso-8859-1"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			<?php echo $this->_tpl_vars['siteTitle']; ?>

		</title>
	
	
	
		
	<?php echo $this->_tpl_vars['xajax_javascript']; ?>

	
	<?php echo '
	<script type="text/javascript">
		xajax.callback.global.onRequest = function() {xajax.$(\'loading\').style.display = \'block\';}
		xajax.callback.global.beforeResponseProcessing = function() {xajax.$(\'loading\').style.display=\'none\';}
 	 </script>
  	'; ?>

  	
	<?php echo $this->_tpl_vars['customer_javascript']; ?>

		
	<link rel="stylesheet" type="text/css" media="screen, print" href="skins/default/css/style.css">
	<link rel="stylesheet" type="text/css" media="print" href="skins/default/css/print.css">

		
	</head>
	<body>
	<?php echo smarty_function_popup_init(array('src' => "libs/overlib421/overlib.js"), $this);?>

	<div id="container">
		<div id="header">
			<div id="navigation">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'navigation.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			<div id="loader">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'loaderDiv.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</div>
		<div id="content">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div> 
	<?php echo $this->_tpl_vars['loaderJavaScript']; ?>

	</body>
</html>