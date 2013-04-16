<p class="submenu">
	<a href="index.php?page={$currentPage}&action=new" {popup caption="Person erfassen" text="Neue Person in myVBC erfassen"}><img src="{$templateDir}/images/icons/add.png" ></a>
	<a href="index.php?page={$currentPage}&action=import" {popup caption="Importieren" text="Personen Daten mit einer externen Quelle abgleichen"}><img src="{$templateDir}/images/icons/basket_put.png" ></a>
	<a href="#" onClick='window.print()' {popup caption="Drucken" text="Diese Liste drucken"}><img src="{$templateDir}/images/icons/printer.png"></a>
</p>

{include file='messages/info.tpl'}


<table class="legend">
<tr>
	<td>
		<img src="{$templateDir}/images/icons/bullet_green.png"> Aktiv in einem Team <br />
		<img src="{$templateDir}/images/icons/bullet_red.png"> Inaktiv (keinem Team zugeordnet) <br />
	</td>
</tr>
</table>
<p class="alphabet">
	<a href="#" onClick="getAddressEntrys()">all</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('a')">a</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('b')">b</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('c')">c</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('d')">d</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('e')">e</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('f')">f</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('g')">g</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('h')">h</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('i')">i</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('j')">j</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('k')">k</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('l')">l</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('m')">m</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('n')">n</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('o')">o</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('p')">p</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('q')">q</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('r')">r</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('s')">s</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('t')">t</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('u')">u</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('v')">v</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('w')">w</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('x')">x</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('y')">y</a>&nbsp;
	<a href="#" onClick="getAddressEntrys('z')">z</a>

</p>
</td>

<div id="addressEntrys">
<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="10%">Vorname</th>
	<th width="10%">Name</th>
	<th width="21%">Adresse</th>
	<th width="12%">Telefon</th>
	<th width="12%">Mobile</th>
	<th width="23%">E-Mail</th>
	<th width="10%">&nbsp;</th>
</tr>
</table>
</div>