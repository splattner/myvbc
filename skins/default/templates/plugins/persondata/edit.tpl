<form class="form-horizontal" action="{eval var=$formURL}" method="POST">
    <div class="form-group">
        <label for="prename" class="col-sm-4 control-label">Vorname</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="prename" name="prename" value="{$person.prename}">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="name" name="name" value="{$person.name}">
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="col-sm-4 control-label">Adresse</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="address" name="address" value="{$person.address}">
        </div>
    </div>
    <div class="form-group">
        <label for="plz" class="col-sm-4 control-label">PLZ</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="plz" name="plz" value="{$person.plz}">
        </div>
    </div>
    <div class="form-group">
        <label for="ort" class="col-sm-4 control-label">Ort</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="ort" name="ort" value="{$person.ort}">
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="col-sm-4 control-label">Telefon</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="phone" name="phone" value="{$person.phone}">
        </div>
    </div>
    <div class="form-group">
        <label for="mobile" class="col-sm-4 control-label">Mobile</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="mobile" name="mobile" value="{$person.mobile}">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-4 control-label">E-Mail</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" id="email" name="email" value="{$person.email}">
        </div>
    </div>
    <div class="form-group">
        <label for="email_parent" class="col-sm-4 control-label">E-Mail Eltern / gesetzlicher Vormund</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" id="email_parent" name="email_parent" value="{$person.email_parent}">
        </div>
    </div>
    <div class="form-group">
        <label for="refid" class="col-sm-4 control-label">Schiedsrichter ID (wenn vorhanden)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="refid" name="refid" value="{$person.refid}">
        </div>
    </div>
    <div class="form-group">
        <label for="birthday" class="col-sm-4 control-label">Geburtstag</label>
        <div class="col-sm-8">
            <div class='input-group date' id='datetimepicker'>
                <input type="text" class="form-control" id="birthday" name="birthday">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="gender" class="col-sm-4 control-label">Geschlecht</label>
        <div class="col-sm-8">
            <select class="form-control" name="gender">
                {if $person.gender == 'm'}
                    <option value="m" selected="selected">m</option>
                    <option value="w" >w</option>
                {else}
                    <option value="m" >m</option>
                    <option value="w" selected="selected">w</option>
                {/if}
            </select>
        </div>
    </div>
    {if $allowSignature}
    <div class="form-group">
        <label for="signature" class="col-sm-4 control-label">Vereinsbeitritt unterzeichnet</label>
        <div class="col-sm-8">
            {if $person.signature == 1}
                <input type='checkbox' name='signature' id='signature' value='1' checked="checked">
            {else}
                <input type='checkbox' name='signature' id='signature' value='1'>
            {/if}
        </div>
    </div>
    {/if}
    <div class="form-group">
        <label for="schreiber" class="col-sm-4 control-label">Schreiber</label>
        <div class="col-sm-8">
            {if $person.schreiber == 1}
                <input type='checkbox' name='schreiber' id='schreiber' value='1' checked="checked">
            {else}
                <input type='checkbox' name='schreiber' id='schreiber' value='1'>
            {/if}
        </div>
    </div>
    <div class="form-group">
        <label for="sms" class="col-sm-4 control-label">SMS-Benachrichtigung <br />bei Schreibereinsatz</label>
        <div class="col-sm-8">
            {if $person.sms == 1}
                <input type='checkbox' name='sms' id='sms' value='1' checked="checked">
            {else}
                <input type='checkbox' name='sms' id='sms' value='1'>
            {/if}
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">Teams</label>
        <div class="col-sm-8">
            <p>{if $person.active == 1}{$person.liga}{else}Spieler ist nicht aktiv{/if}</p>
        </div>
    </div>
    <div class="form-group">
        <label for="licence" class="col-sm-4 control-label">Lizenz</label>
        <div class="col-sm-8">
            <select class="form-control" id="licence" name="licence">
                {foreach item=licence from=$licences}

                    {if $person.licence == $licence.id}
                        <option value="{$licence.id}" selected="selected">{$licence.typ}</option>
                    {else}
                        <option value="{$licence.id}">{$licence.typ}</option>
                    {/if}

                {/foreach}

            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="licence_comment" class="col-sm-4 control-label">Bemerkung zu Lizenz</label>
        <div class="col-sm-8">
            <textarea class="form-control" id="licence_commment" name="licence_comment" rows="4">{$person.licence_comment}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" class="btn btn-primary" name="doEdit" >bearbeiten</button>
        </div>
    </div>


</form>

{literal}
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                viewMode: 'years',
                locale: 'de',
                format: 'DD.MM.YYYY',
                defaultDate: moment('{/literal}{$person.birthday}{literal}')
            });
        });
    </script>
{/literal}
