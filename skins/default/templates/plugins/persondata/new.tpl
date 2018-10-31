<div class="container">
	<form action="{eval var=$formURL}" method="POST">
		<div class="form-group row">
			<label for="prename" class="col-sm-4 col-form-label">Vorname</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="prename" name="prename">
			</div>
		</div>
		<div class="form-group row">
			<label for="name" class="col-sm-4 col-form-label">Name</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="name" name="name">
			</div>
		</div>
		<div class="form-group row">
			<label for="address" class="col-sm-4 col-form-label">Adresse</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="address" name="address">
			</div>
		</div>
		<div class="form-group row">
			<label for="plz" class="col-sm-4 col-form-label">PLZ</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="plz" name="plz">
			</div>
		</div>
		<div class="form-group row">
			<label for="ort" class="col-sm-4 col-form-label">Ort</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="ort" name="ort">
			</div>
		</div>
		<div class="form-group row">
			<label for="phone" class="col-sm-4 col-form-label">Telefon</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="phone" name="phone">
			</div>
		</div>
		<div class="form-group row">
			<label for="mobile" class="col-sm-4 col-form-label">Mobile</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="mobile" name="mobile">
			</div>
		</div>
		<div class="form-group row">
			<label for="email" class="col-sm-4 col-form-label">E-Mail</label>
			<div class="col-sm-8">
				<input type="email" class="form-control" id="email" name="email">
			</div>
		</div>
		<div class="form-group row">
			<label for="email_parent" class="col-sm-4 col-form-label">E-Mail Eltern / gesetzlicher Vormund</label>
			<div class="col-sm-8">
				<input type="email" class="form-control" id="email_parent" name="email_parent">
			</div>
		</div>
		<div class="form-group row">
			<label for="refid" class="col-sm-4 col-form-label">Schiedsrichter ID (wenn vorhanden)</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="refid" name="refid">
			</div>
		</div>
		<div class="form-group row">
			<label for="birthday" class="col-sm-4 col-form-label">Geburtstag</label>
			<div class="col-sm-8">
	            <div class="input-group" >
	                <input type="text" readonly class="form-control" id="birthday" name="birthday">
									<div class="input-group-append">
										<span class="input-group-text">
												<i class="fas fa-calendar-plus"></i>
										</span>
									</div>
	            </div>
			</div>
		</div>
		<div class="form-group row">
			<label for="gender" class="col-sm-4 col-form-label">Geschlecht</label>
			<div class="col-sm-8">
				<select class="form-control" name="gender">
					<option value="m" >m</option>
					<option value="w" >w</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="schreiber" class="col-sm-4 col-form-label">Schreiber</label>
			<div class="col-sm-8">
				<input type="checkbox" name="schreiber" id="schreiber" value="1">
			</div>
		</div>
		<div class="form-group row">
			<label for="sms" class="col-sm-4 col-form-label">SMS-Benachrichtigung <br />bei Schreibereinsatz</label>
			<div class="col-sm-8">
				<input type="checkbox" name="sms" id="sms" value="1">
			</div>
		</div>

		<div class="form-group row">
			<label for="licence" class="col-sm-4 col-form-label">Lizenz</label>
			<div class="col-sm-8">
				<select class="form-control" id="licence" name="licence">
					{foreach item=licence from=$licences}
							<option value="{$licence.id}">{$licence.typ}</option>
					{/foreach}

				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="licence_comment" class="col-sm-4 col-form-label">Bemerkung zu Lizenz</label>
			<div class="col-sm-8">
				<textarea class="form-control" id="licence_commment" name="licence_comment" rows="4"></textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-offset-2 col-sm-8">
				<button type="submit" class="btn btn-dark" name="doNew" >eintragen</button>
			</div>
		</div>


	</form>
</div>
{literal}
    <script type="text/javascript">
        $(function () {

					$('#birthday').datepicker({
							format: {
								toDisplay: function (date, format, language) {
                  var d = moment(date, "DD.MM.YYYY");
                  return d.format("DD.MM.YYYY");
                },
                toValue: function (date, format, language) {
									var d = moment(date, "DD.MM.YYYY");
                  date = d.toDate();
                  date.setMinutes( date.getMinutes() - date.getTimezoneOffset() );
									return date;
                }
							},
							language: 'de',
              autoclose: true,
							startView: 2,
							autoclose: true,
						});
        });
    </script>
{/literal}
