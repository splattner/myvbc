<style type="text/css">
    {literal}

    table.requestForm {
        border: 1px solid black;
        width: 80%;
        margin: auto;
        margin-top: 20px;
    }

    table.requestForm td {
        padding: 5px;
        border: 1px solid black;
    }
    {/literal}
</style>

<style type="text/css" media="print">
    {literal}

    h1 {
        display: none;
    }

    {/literal}

</style>

<p class="submenu">
    <a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page=address"><i class="fa fa-caret-square-o-left"></i></a>
    <a data-toggle="tooltip" data-placement="bottom" title="Liste drucken" href="#" onClick='window.print()'>
        <i class="fa fa-print"></i>
    </a>
</p>

<img src="skins/default/images/logo_vbcl.gif" />

<h1>Beitrittsgesuch in den VBC Langenthal</h1>
<h2>Angaben Neumitglied</h2>

<table class="requestForm">
    <tr>
        <td width="30%"><b>Vorname / Name</b></td>
        <td>{$person[0].prename} / {$person[0].name}</td>
    </tr>

    <tr>
        <td width="30%"><b>Strasse, Nr.</b></td>
        <td>{$person[0].address}</td>
    </tr>

    <tr>
        <td width="30%"><b>PLZ, Ort</b></td>
        <td>{$person[0].plz} {$person[0].ort}</td>
    </tr>

    <tr>
        <td width="30%"><b>Telefonnummer</b></td>
        <td>{$person[0].phone}</td>
    </tr>

    <tr>
        <td width="30%"><b>Mobiltelefonnummer</b></td>
        <td>{$person[0].mobile}</td>
    </tr>

    <tr>
        <td width="30%"><b>E-Mail Adresse</b></td>
        <td>{$person[0].email}</td>
    </tr>

    <tr>
        <td width="30%">
            <b>E-Mail Adresse <br />
            Eltern / gesetzlicher Vormund (wenn Minderj&auml;rig)</b>
        </td>
        <td>{$person[0].email_parent}</td>
    </tr>

    <tr>
        <td width="30%"><b>Geburtsdatum</b></td>
        <td>{$person[0].birthday|date_format:"%d.%m.%Y"}</td>
    </tr>
</table>

<p></p>
<p></p>

<p style="margin: 40px; font-size: 12pt;">
    Ich möchte Mitglied des VBC Langenthal werden, habe die Statuten gelesen und anerkenne sie als verbindlich.
    Insbesondere verpflichte ich mich, anlässlich der vom Verein durchgeführten Anlässe (SAR-SM, Minivolleyballturniere, Beachturniere oder sonstige Anlässe) als Helfer/in aktiv mitzuwirken.
</p>
     
<p style="float: left; margin: 35px; font-size: 12pt;">
    ________________________________________ <br />
    Ort, Datum
    <br /><br /><br />
    ________________________________________ <br />
    Unterschrift Neumitglied
</p>

<p style="float: left; margin: 35px; font-size: 12pt;">
    ________________________________________ <br />
    Ort, Datum
    <br /><br /><br />
    ________________________________________ <br />
    Unterschrift gesetzlicher Vormund*
</p>

<p style="clear: left; margin: 40px; font-size: 10pt;">
    *	(bei minderjährigen Neumitgliedern bedarf es der Unterschrift eines Elternteils bzw. des gesetzlichen Vormunds) <br />
</p>
<p style="margin: 40px; font-size: 12pt;">
    Bitte Angaben prüfen (ggfs. korrigieren) und Formular per Post zurücksenden an: <br />
    VBC Langenthal <br />
    Postfach 1034 <br />
    4901 Langenthal
</p>

{literal}
<script language="javascript" type="text/javascript">
    <!--
    setTimeout(function () { window.print(); }, 500);
    window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
    -->
</script>
{/literal}