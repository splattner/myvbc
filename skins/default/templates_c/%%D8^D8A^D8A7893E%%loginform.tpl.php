<?php /* Smarty version 2.6.22, created on 2012-08-19 20:20:35
         compiled from auth/loginform.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mailto', 'auth/loginform.tpl', 26, false),)), $this); ?>
<table class="overview">

<tr>
	<td style="width: 200px; height: 200px;">
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/enter.jpg">
	</td>
	<td style="text-align: center">
		<form action="?page=auth&action=login" method="post">
		<table style="padding: 10px;border: 5px solid #DDDDDD; margin: auto;width: 300px">
			<tr>
				<td style="text-align: left; width: 100px;"><b>E-Mail</b></td>
				<td style="text-align: left;width: 200px;"><input type="text" name="email"></td>
			</tr>
			<tr>
				<td style="text-align: left;width:100px;"><b>Password</b></td>
				<td style="text-align: left;width:200px;"><input type="password" name="password"></td>
			</tr>
			<tr>
				<td style="text-align: left;width:10px;">&nbsp;</td>
				<td style="text-align: left;width:020px;"><input type="submit" name="doLogin" value="Login"></td>
			</tr>
		</table>
		</form>
		
		<p class="indented">
			Bei Problemen wenden Sie sich bitte an <?php echo smarty_function_mailto(array('address' => "myVBC@vbclangenthal.ch"), $this);?>

		</p>
	</td>

</tr>


</table>
