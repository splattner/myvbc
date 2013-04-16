<?php /* Smarty version 2.6.22, created on 2012-05-23 16:42:02
         compiled from navigation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'navigation.tpl', 1, false),)), $this); ?>
<a href="?page=index" <?php echo smarty_function_popup(array('caption' => "Übersicht",'text' => 'Deine myVBC Startseite'), $this);?>
><img src="skins/default/images/icons/house.png"></a>




<?php if ($this->_tpl_vars['canAddress']): ?>
<a href="?page=address" <?php echo smarty_function_popup(array('caption' => 'Mitglieder Verwaltung','text' => 'Alle Adressen bearbeiten oder neue Personen eintragen'), $this);?>
><img src="skins/default/images/icons/book_addresses.png"></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['canOrder']): ?>
<a href="?page=order" <?php echo smarty_function_popup(array('caption' => 'Lizenzbestellung','text' => "neue Lizenzen bestellen, Status von Bestellungen prüfen"), $this);?>
><img src="skins/default/images/icons/basket.png"></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['canTeam']): ?>
<a href="?page=team" <?php echo smarty_function_popup(array('caption' => 'Team Verwaltung','text' => "Team Daten bearbeiten. Neue Teams erstellen. Personen den Teams zuordnen"), $this);?>
><img src="skins/default/images/icons/group.png"></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['canGames']): ?>
<a href="?page=games" <?php echo smarty_function_popup(array('caption' => 'Spiele','text' => "Spiele verwaltung und von Externen Quellen importieren. Schreiber den Spielen zuweisen"), $this);?>
><img src="skins/default/images/icons/sport_soccer.png"></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['canReport']): ?>
<a href="?page=report" <?php echo smarty_function_popup(array('caption' => 'Reports','text' => "Berichte, Dokumente erstellen. Teamlisten, Schreiberlisten, etc"), $this);?>
><img src="skins/default/images/icons/report.png"></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['canNotification']): ?>
<a href="?page=notification" <?php echo smarty_function_popup(array('caption' => 'Benachrichtigung','text' => "Benachrichtigungs-Meldungen anschauen und bestätigen"), $this);?>
><img src="skins/default/images/icons/note.png"></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['canWorkflow']): ?>
<a href="?page=workflow" <?php echo smarty_function_popup(array('caption' => 'Workflow','text' => "Workflow Status pr&uuml;fen und ausl&ouml;sen"), $this);?>
><img src="skins/default/images/icons/cog.png"></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['canAdmin']): ?>
<a href="?page=admin" <?php echo smarty_function_popup(array('caption' => 'Administration','text' => "Administrative Aufgaben. Zugangsberechtigungen verwalten"), $this);?>
><img src="skins/default/images/icons/wrench.png"></a>
<?php endif; ?>

&nbsp;&nbsp;&nbsp;&nbsp;

<?php if (! $this->_tpl_vars['isAuth']): ?>
	<a href="?page=auth" <?php echo smarty_function_popup(array('caption' => 'Anmelden','text' => "Mit E-Mail Adresse und Passwort an myVBC anmelden"), $this);?>
 ><img src="skins/default/images/icons/key.png"></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['isAuth']): ?>
	<a href="?page=auth" <?php echo smarty_function_popup(array('caption' => 'Beenden','text' => 'myVBC beenden und ausloggen'), $this);?>
><img src="skins/default/images/icons/cross.png"></a>
<?php endif; ?>