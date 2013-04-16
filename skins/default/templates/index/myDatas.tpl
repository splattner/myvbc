<table class="overview">
	<tr>
		<th>
			Meine Daten
		</th>
	</tr>
	<tr>
		<td style="padding: 10px;">
			<p class="hightlight">
				{$user.prename} {$user.name}<br />
				{$user.address}<br />
				{$user.plz} {$user.ort}
			</p>
			
			<p class="hightlight">
				Telephon: {$user.phone}<br />
				Mobile: {$user.mobile}<br />
				E-Mail: {$user.email}<br />
			</p>
			
			<p>
				<a href="index.php?page=mydata&action=edit"><img src="{$templateDir}/images/icons/book_edit.png">&nbsp;Meine Daten bearbeiten</a>
				<br /><a href="index.php?page=mydata&action=editPassword"><img src="{$templateDir}/images/icons/key.png">&nbsp;Passwort ändern</a>
			</p>
		</td>
	</tr>
</table>