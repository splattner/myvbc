<div class="card">
	<h4 class="card-header">
		<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main">
			<i class="fas fa-times"></i>
		</a>
		Von Fairgate importieren
	</h4>
	<div class="card-body">
		<form enctype="multipart/form-data" action="index.php?page={$currentPage}&action=importFairgate" method="POST">
		{if $importStage == "new"}
		<div class="container">

			<div class="form-group row">
				<div class="col-sm-offset-2 col-sm-8">
					<button type="submit" class="btn btn-dark" name="doImport" >Importvorgang starten</button>
				</div>
			</div>
		</div>
		{/if}
		{if $importStage == "preview" }
		<div class="container">
			<div class="form-group row">
				Bitte Daten zum importieren prüfen:
			</div>

		</div>
		<div class="container">
			<table class="table table-striped table-sm">
				<thead class="thead-inverse">
				<tr>

					<th>Kontakt aus Fairgate</th>
					<th>Status</th>
					<th>Verkn&uuml;pfen mit myvbc Person</th>
				</tr>
				</thead>
				<tbody>
				{foreach item=import from=$importData}
					<tr>
						<td>
							{$import["prename"]} {$import["name"]}
							<br />Geburtsdatum: {$import["birthday"]|date_format:"%d.%m.%Y"}
							{if $import["warnings"]["birthdayNotSet"] eq true}
							<br /><i class="fas fa-exclamation-triangle" style="color:red;" ></i> Geburtdstag nicht vorhanden!
							{/if}
							{if $import["warnings"]["genderNotSet"] eq true}
							<br /><i class="fas fa-exclamation-triangle" style="color:red;" ></i> Geschlecht nicht vorhanden!
							{/if}
							{if $import["warnings"]["emailNotSet"] eq true}
							<br /><i class="fas fa-exclamation-triangle" style="color:red;" ></i> E-Mail nicht vorhanden!
							{/if}
							{if $import["warnings"]["mobileNotSet"] eq true}
							<br /><i class="fas fa-exclamation-triangle" style="color:red;" ></i> Mobile nicht vorhanden!
							{/if}
							{if $import["warnings"]["addressNotSet"] eq true}
							<br /><i class="fas fa-exclamation-triangle" style="color:red;" ></i> Adresse nicht vorhanden!
							{/if}
						</td>
						<td>
							{if $import["linkedPersonAvailable"] eq true}
							<i class="fas fa-check" style="color:green;"></i> in myVBC vorhanden
							<br /><input type="checkbox" checked="checked" name="override[]" value="true" /> leere Felder &uumlbertragen
							{else}
							<i class="fas fa-check" style="color:red;"></i> in myVBC nicht vorhanden
							{/if}
						</td>
						<td>

							<select style="form-control" class="form-control person-select" name="linkedPerson[]">
									
									{if $import["linkedPersonAvailable"] eq false}
										{if 
											$import["warnings"]["addressNotSet"] eq false and
											$import["warnings"]["mobileNotSet"] eq false and
											$import["warnings"]["emailNotSet"] eq false and
											$import["warnings"]["genderNotSet"] eq false and
											$import["warnings"]["birthdayNotSet"] eq false
										}
										<option  selected="selected" value="0" >(neu erstellen)</option>
										<option value="-1" >(nicht importieren)</option>
										{else}
										<option value="0" >(neu erstellen)</option>
										<option selected="selected" value="-1" >(nicht importieren)</option>
										{/if}
									{else}
										<option  value="0" >(neu erstellen)</option>
										<option value="-1" >(nicht importieren)</option>
									{/if}
									{foreach item=person from=$allPersons}
										{if $import["linkedPerson"]["id"] eq $person.id}
											<option selected="selected" value="{$person.id}">{$person.prename} {$person.name}</option>
										{else}
											<option  value="{$person.id}">{$person.prename} {$person.name}</option>
										{/if}
									{/foreach}
								</select>

						</td>

					</tr>
					
				{/foreach}
				</tbody>
			</table>
		</div>
		<div class="container">
			<div class="form-group row">
				<div class="col-sm-offset-2 col-sm-8">
					<button type="submit" class="btn btn-dark" name="doImportFinal" >importieren</button>
				</div>
			</div>
		</div>
		{literal}
		<script type="text/javascript">
			$('.person-select').chosen({width: "95%"});
		</script>
		{/literal}
		{/if}
		{if $importStage == "imported" }
		<div class="container">
			<div class="form-group row">
				<p>
					Import abgeschlossen.
				</p>
				<p>
					<textarea class="form-control" cols="100" rows="20" name="importLog">{$importLog}</textarea>
				</p>

			</div>
		</div>
		{/if}
        </form>
	</div>
</div>

{include file='messages/info.tpl'}

