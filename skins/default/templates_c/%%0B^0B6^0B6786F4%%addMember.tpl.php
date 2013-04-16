<?php /* Smarty version 2.6.22, created on 2012-08-23 16:19:28
         compiled from myTeam/addMember.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'myTeam/addMember.tpl', 9, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=addMember&teamID=<?php echo $this->_tpl_vars['teamID']; ?>
" method="POST">
<table class="edit">
	<tr>
		<th>
			Mitglied zu Team hinzuf&uuml;gen
		</th>
		<th style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zur&uuml;ck",'text' => "Zur&uuml;ck zur &Uuml;bersicht"), $this);?>
  href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main&teamID=<?php echo $this->_tpl_vars['teamID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td>
			Person ausw&auml;hlen
		</td>
		<td>
			<select name="person">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
					<option value="<?php echo $this->_tpl_vars['user']['id']; ?>
"><?php echo $this->_tpl_vars['user']['name']; ?>
 <?php echo $this->_tpl_vars['user']['prename']; ?>
 </option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			<?php if ($this->_tpl_vars['canAddMember']): ?>
			<p>
				<a <?php echo smarty_function_popup(array('caption' => 'Neu','text' => 'Neue Person erfassen'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=new&teamID=<?php echo $this->_tpl_vars['teamID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/add.png"></a>
				Wenn eine Person noch nicht im System erfasst ist, k�nnen Sie diese hier hinzuf&uuml;gen.
			</p>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td>
			Funktion
		</td>
		<td>
			<select name="typ">
				<option value="1">Spieler</option>
				<option value="2">Captain / Teamverantwortlicher</option>
				<option value="3">Trainer</option>
				<option value="4">Sonstige Funktion</option>
			</select>
		</td>
	</tr>
	<td>
		<td colspan="2">
			<input type="submit" name="doAdd" value="hinzuf&uuml;gen">
		</td>
	</tr>

</table>
</form>