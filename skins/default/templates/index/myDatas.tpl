<table class="overview">
	<tr>
		<th>
			Meine Daten 
			 <a {popup caption="Daten bearbeiten" text="Meine Daten bearbeiten"} href="index.php?page=mydata&action=edit"><img src="{$templateDir}/images/icons/book_edit.png"></a>
			 <a {popup caption="Passwort"  text="Neues Passwort setzen"}  href="index.php?page=mydata&action=editPassword"><img src="{$templateDir}/images/icons/key.png"></a>
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
			
		</td>
	</tr>
</table>