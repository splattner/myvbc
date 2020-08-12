

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

<div class="d-print-none">
  <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page=index"><i class="fas fa-caret-square-left"></i></a>
  <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Liste drucken" href="#" onclick="window.print()"><i class="fas fa-print"></i></a>
      -
  <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Infoblatt" href="https://www.vbclangenthal.ch/vbc-langenthal/dokumente/send/2-reglemente-statuten/47-infoblatt" target="_blank"><i class="fas fa-file-pdf"></i></a>
  <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Finanz- und Bussenreglement" href="https://www.vbclangenthal.ch/vbc-langenthal/dokumente/send/2-reglemente-statuten/45-finanzreglement-vbc-langenthal" target="_blank"><i class="fas fa-file-pdf"></i></a>
  <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Statuten" href="https://www.vbclangenthal.ch/vbc-langenthal/dokumente/send/2-reglemente-statuten/1-statuten-vbc-langenthal" target="_blank"><i class="fas fa-file-pdf"></i></a>
</div>

<h1>Beitrittserklärung in den VBC Langenthal</h1>

<p style="margin: 40px; font-size: 10pt;">
<b>Herzlich willkommen beim VBC Langenthal!</b><br />
Es freut uns, dich in Zukunft zu unseren Mitgliedern zählen zu dürfen. Wir wünschen dir schon
jetzt viel Erfolg und Freude beim “bäuele“ und natürlich keine Verletzungen.
</p>

<h2>Angaben Neumitglied</h2>

<table class="requestForm">
    <tr>
        <td width="30%"><b>Vorname / Name</b></td>
        <td>{$person.prename} / {$person.name}</td>
    </tr>

    <tr>
        <td width="30%"><b>Strasse, Nr.</b></td>
        <td>{$person.address}</td>
    </tr>

    <tr>
        <td width="30%"><b>PLZ, Ort</b></td>
        <td>{$person.plz} {$person.ort}</td>
    </tr>

    <tr>
        <td width="30%"><b>Telefonnummer</b></td>
        <td>{$person.phone}</td>
    </tr>

    <tr>
        <td width="30%"><b>Mobiltelefonnummer</b></td>
        <td>{$person.mobile}</td>
    </tr>

    <tr>
        <td width="30%"><b>E-Mail Adresse</b></td>
        <td>{$person.email}</td>
    </tr>

    <tr>
        <td width="30%">
            <b>E-Mail Adresse <br />
            Eltern / gesetzlicher Vormund (wenn Minderj&auml;rig)</b>
        </td>
        <td>{$person.email_parent}</td>
    </tr>

    <tr>
        <td width="30%">
            <b>AHV Nummer</b>
        </td>
        <td>{$person.ahv}</td>
    </tr>
    
    <tr>
        <td width="30%"><b>Geburtsdatum</b></td>
        <td>{$person.birthday|date_format:"%d.%m.%Y"}</td>
    </tr>
</table>

<p></p>
<p></p>

<p style="margin: 40px; font-size: 10pt;">
    Ich möchte Mitglied des VBC Langenthal werden, habe die Statuten gelesen und anerkenne sie als verbindlich.
    Insbesondere verpflichte ich mich, anlässlich der vom Verein durchgeführten Anlässe (Schreibereinsätze, Minivolleyballturniere, Beachturniere oder sonstige Anlässe) als Helfer/in aktiv mitzuwirken.
</p>
     
<p style="float: left; margin: 35px; font-size: 10pt;">
    ____________________________ <br />
    Ort, Datum
    <br /><br /><br />
    ____________________________ <br />
    Unterschrift Neumitglied
</p>

<p style="float: left; margin: 35px; font-size: 10pt;">
    ____________________________ <br />
    Ort, Datum
    <br /><br /><br />
    ____________________________ <br />
    Unterschrift gesetzlicher Vormund*
</p>

<p style="clear: left; margin: 40px; font-size: 8pt;">
    *   (bei minderjährigen Neumitgliedern bedarf es der Unterschrift eines Elternteils bzw. des gesetzlichen Vormunds) <br />
</p>
<p style="margin: 40px; font-size: 10pt;">
    Bitte Angaben prüfen und falls nötig ergänzen und/oder korrigieren und anschliessend das Formuular per Post zurücksenden an: <br />
    VBC Langenthal <br />
    Postfach 1034 <br />
    4901 Langenthal
</p>

{literal}
<script language="javascript" type="text/javascript">


    setTimeout(function () {
        window.print();

    }, 500);

    //window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }

</script>
{/literal}
