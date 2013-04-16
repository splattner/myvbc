<?php /* Smarty version 2.6.22, created on 2012-08-19 20:20:33
         compiled from index/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mailto', 'index/index.tpl', 34, false),)), $this); ?>
<h1>
	myVBC
	
	<?php if ($this->_tpl_vars['isAuth']): ?>
	&nbsp;-&nbsp; <?php echo $this->_tpl_vars['user']['prename']; ?>
 <?php echo $this->_tpl_vars['user']['name']; ?>

	<?php endif; ?>
</h1>

<?php if ($this->_tpl_vars['isAuth']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'index/myDatas.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'index/myTeams.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'index/myGames.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'index/mySchreiber.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'index/myRefGames.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
<table class="overview">
<tr>
	<td style="text-align: center;width: 200px; height: 200px;">
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/logo_vbcl.gif">
	</td>
	<td style="">
		<h3>
			Willkommen in der VBC Langenthal Web-Verwaltung
		</h3>
		<p>
			Um die Funktionen dieser Web-Verwaltung zu benutzen, müssen Sie sich zuerst authentifizieren.
		</p>

		<p class="indented">
			<a href="?page=auth"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/key.png">&nbsp;Mit E-Mail Adresse und Passwort anmelden</a>
		</p>
		
				
		<p> <img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/exclamation.png"> Wenn Sie noch keinen Zugang haben, schreiben Sie bitte eine E-Mail an <?php echo smarty_function_mailto(array('address' => "myVBC@vbclangenthal.ch"), $this);?>
 um einen
			Zugang einzurichten!
		</p>
	</td>
</tr>
</table>

<?php endif; ?>