<?php /* Smarty version 2.6.22, created on 2012-08-19 20:20:39
         compiled from index/myDatas.tpl */ ?>
<table class="overview">
	<tr>
		<th>
			Meine Daten
		</th>
	</tr>
	<tr>
		<td style="padding: 10px;">
			<p class="hightlight">
				<?php echo $this->_tpl_vars['user']['prename']; ?>
 <?php echo $this->_tpl_vars['user']['name']; ?>
<br />
				<?php echo $this->_tpl_vars['user']['address']; ?>
<br />
				<?php echo $this->_tpl_vars['user']['plz']; ?>
 <?php echo $this->_tpl_vars['user']['ort']; ?>

			</p>
			
			<p class="hightlight">
				Telephon: <?php echo $this->_tpl_vars['user']['phone']; ?>
<br />
				Mobile: <?php echo $this->_tpl_vars['user']['mobile']; ?>
<br />
				E-Mail: <?php echo $this->_tpl_vars['user']['email']; ?>
<br />
			</p>
			
			<p>
				<a href="index.php?page=mydata&action=edit"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/book_edit.png">&nbsp;Meine Daten bearbeiten</a>
				<br /><a href="index.php?page=mydata&action=editPassword"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/key.png">&nbsp;Passwort ändern</a>
			</p>
		</td>
	</tr>
</table>