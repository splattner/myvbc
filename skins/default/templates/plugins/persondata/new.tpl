<form class="form-horizontal" action="{eval var=$formURL}" method="POST">
	<div class="form-group">
		<label for="prename" class="col-sm-4 control-label">Vorname</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="prename" name="prename">
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="name" name="name">
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="col-sm-4 control-label">Adresse</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="address" name="address">
		</div>
	</div>
	<div class="form-group">
		<label for="plz" class="col-sm-4 control-label">PLZ</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="plz" name="plz">
		</div>
	</div>
	<div class="form-group">
		<label for="ort" class="col-sm-4 control-label">Ort</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="ort" name="ort">
		</div>
	</div>
	<div class="form-group">
		<label for="phone" class="col-sm-4 control-label">Telefon</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="phone" name="phone">
		</div>
	</div>
	<div class="form-group">
		<label for="mobile" class="col-sm-4 control-label">Mobile</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="mobile" name="mobile">
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-4 control-label">E-Mail</label>
		<div class="col-sm-8">
			<input type="email" class="form-control" id="email" name="email">
		</div>
	</div>
	<div class="form-group">
		<label for="email_parent" class="col-sm-4 control-label">E-Mail Eltern / gesetzlicher Vormund</label>
		<div class="col-sm-8">
			<input type="email" class="form-control" id="email_parent" name="email_parent">
		</div>
	</div>
	<div class="form-group">
		<label for="refid" class="col-sm-4 control-label">Schiedsrichter ID (wenn vorhanden)</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="refid" name="refid">
		</div>
	</div>
	<div class="form-group">
		<label for="birthday" class="col-sm-4 control-label">Geburtstag</label>
		<div class="col-sm-8">
			<input type="date" class="form-control" id="birthday" name="birthday">
		</div>
	</div>
	<div class="form-group">
		<label for="gender" class="col-sm-4 control-label">Geschlecht</label>
		<div class="col-sm-8">
			<select class="form-control" name="gender">
				<option value="m" >m</option>
				<option value="w" >w</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="schreiber" class="col-sm-4 control-label">Schreiber</label>
		<div class="col-sm-8">
			<input type='checkbox' name='schreiber' id='schreiber' value='0'>
		</div>
	</div>
	<div class="form-group">
		<label for="sms" class="col-sm-4 control-label">SMS-Benachrichtigung <br />bei Schreibereinsatz</label>
		<div class="col-sm-8">
			<input type='checkbox' name='sms' id='sms' >
		</div>
	</div>

	<div class="form-group">
		<label for="licence" class="col-sm-4 control-label">Lizenz</label>
		<div class="col-sm-8">
			<select class="form-control" id="licence" name="licence">
				{foreach item=licence from=$licences}
						<option value="{$licence.id}">{$licence.typ}</option>
				{/foreach}

			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="licence_comment" class="col-sm-4 control-label">Bemerkung zu Lizenz</label>
		<div class="col-sm-8">
			<textarea class="form-control" id="licence_commment" name="licence_comment" rows="4"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" class="btn btn-primary" name="doNew" >eintragen</button>
		</div>
	</div>


</form>
