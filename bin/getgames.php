<?php
// Set flag that this is a parent file
define( '_MYVBC', 1 );

require_once "class.svrs.php";
require_once "class.swissvolley.php";


header("Cache-Control: no-cache");

if (isset($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = "";
}

$team = $_GET["team"];
$type = $_GET["type"];
$liga = $_GET["liga"];


switch($page) {
	case "svrs-games":
		$svrs = new svrs();
		$games = $svrs->get_GamesbyTeamID($team);
		
		$header= "<table class='result-table''>
			<tr>
				<th width='15%'><b>Datum / Zeit</b></td>
				<th width='25%'><b>Ort / Halle</b></td>
				<th width='27%'><b>Heimteam</b></td>
				<th width='27%'><b>Gastteam</b></td>
				<th width='6%'></td>
			</tr>";
		$footer = "</table>";
		$content = "";

		if (count($games) == 0)	{
			content. "<td align='center' colspan='5'>Keine Spiele vorhanden</td>";
		} else {
			foreach ($games as $game)
			{
				/* format the date */
				list ($datum, $zeit) = explode(" ", $game["isodatum"]);
				list ($stunde, $minute, $sekunde) = explode (":", $zeit);
				list ($jahr, $monat, $tag) = explode("-", $datum);
				$date = $tag . "." . $monat . "." . $jahr . " " . $stunde . ":" . $minute;
				
				$content .= "<tr><td>" . $date . "</td><td>" . $game["ort"] . " " . $game["halle"] ."</td><td>" . $game["heimteam"] . "</td><td>" . $game["gastteam"] . "</td><td>";
				
				if ($game["satzheim"] != 0 || $game["satzgast"] != 0)
				{
					$content .= $game["satzheim"] . ":". $game["satzgast"];
				}


				$content .= "</td></tr>";
			}
		}
	
		echo $header . $content . $footer;
	
		break;
	
	case "sw-games":
	
		$swissvolley = new swissvolley();
		$games = $swissvolley->get_GamesbyTeamID($team);
		
		$header = "<table class='result-table'>
			<tr>
				<th width='15%'><b>Datum / Zeit</b></td>
				<th width='25%'><b>Ort / Halle</b></td>
				<th width='27%'><b>Heimteam</b></td>
				<th width='27%'><b>Gastteam</b></td>
				<th width='6%'></td>
			</tr>";
		$footer = "</table>";
		$content = "";
		
		if (count($games) == 0)	{
			$content .= "<td align='center' colspan='5'>Keine Spiele vorhanden</td>";
		} else {
			foreach ($games as $game)
			{
				/* formate the date */
				list ($datum, $zeit) = explode(" ", $game->PlayDate);
				list ($stunde, $minute, $sekunde) = explode (":", $zeit);
				list ($jahr, $monat, $tag) = explode("-", $datum);
				$date = $tag . "." . $monat . "." . $jahr . " " . $stunde . ":" . $minute;
				
				$content .= "<tr>
								<td>" . $date . "</td>
								<td>" . utf8_decode($game->HallPlace) . " " . utf8_decode($game->HallCaption) . "</td>
								<td>" . utf8_decode($game->TeamHomeCaption) . "</td>
								<td>" . utf8_decode($game->TeamAwayCaption) ."</td>
								<td>";
									if ($game->NumberOfWinsHome != 0 || $game->NumberOfWinsAway != 0)
									{
										$content .= $game->NumberOfWinsHome . ":" . $game->NumberOfWinsAway;
									}
								$content .= "</td>
						</tr>";
			}
		}

		echo $header . utf8_encode($content) . $footer;
		
		break;
		
	case "svrs-ranks":
		
		$svrs = new svrs();
		$ranklist = $svrs->get_RanklistbyLiga($liga);

		$header = "<table class='result-table''>
			<tr>
				<th width='5%'><b>Rang</b></td>
				<th width='75%'><b>Team</b></td>
				<th width='5%'><b>S</b></td>
				<th width='5%'><b>P</b></td>
				<th width='10%'><b>G:V</b></td>
			</tr>";
		$footer = "</table>";
		$content = "";
		

		foreach ($ranklist as $liga)
		{
			foreach ($liga as $rank)
			{
				if (count($rank) == 0) {
					$content .= "<td align='center' colspan='5'>Keine Rangliste vorhanden</td>";
				} else {
					if (strpos($rank["name"],"Langenthal")) {
						$content .= 
										"<tr>
											<td class='td_hightligh'>" . $rank["platz"] . "</td>
											<td class='td_hightligh'>" . $rank["name"] . "</td>
											<td class='td_hightligh'>" . $rank["spiele"] ."</td>
											<td class='td_hightligh'><b>" . $rank["punkte"] . "</b></td>
											<td class='td_hightligh'>" . $rank["satzgewonnen"] . ":
											" . $rank["satzverloren"] . "</td>
										</tr>";
					} else {
						$content .= 
										"<tr>
											<td>" . $rank["platz"] . "</td>
											<td>" . $rank["name"] . "</td>
											<td>" . $rank["spiele"] ."</td>
											<td><b>" . $rank["punkte"] . "</b></td>
											<td>" . $rank["satzgewonnen"] . ":
											" . $rank["satzverloren"] . "</td>
										</tr>";
					}
				}
				
			}
		}

		echo $header . $content . $footer;
	
		break;
		
	case "sw-ranks":
	
		$swissvolley = new swissvolley();
		$ranks = $swissvolley->get_Table($liga);
		
		$header = "<table class='result-table''>
			<tr>
				<th width='5%'><b>Rang</b></td>
				<th width='75%'><b>Team</b></td>
				<th width='5%'><b>S</b></td>
				<th width='5%'><b>P</b></td>
				<th width='10%'><b>G:V</b></td>
			</tr>";
		$footer = "</table>";
		$content = "";
		
		if (count($ranks) == 0) {
			$content .= "<td align='center' colspan='5'>Keine Rangliste vorhanden</td>";
		} else {
			foreach ($ranks as $rank)
			{
				if ($team == $rank->team_ID) {
					$content .= 
									"<tr>
										<td class='td_hightligh'>" . $rank->Rank . "</td>
										<td class='td_hightligh'>" . $rank->Caption . "</td>
										<td class='td_hightligh'>" . $rank->NumberOfGames ."</td>
										<td class='td_hightligh'><b>" . $rank->Points . "</b></td>
										<td class='td_hightligh'>" . $rank->SetsWon . ":
										" . $rank->SetsLost . "</td>
									</tr>";
				} else {
					$content .= 
									"<tr>
										<td>" . $rank->Rank . "</td>
										<td>" . $rank->Caption . "</td>
										<td>" . $rank->NumberOfGames ."</td>
										<td><b>" . $rank->Points . "</b></td>
										<td>" . $rank->SetsWon . ":
										" . $rank->SetsLost . "</td>
									</tr>";
				}
			}
		}
		echo $header . $content . $footer;
		break;
		
	default:
	?>
	<script src="http://myVBC.vbclangenthal.ch/bin/jquery-1.3.2.min.js" type="text/javascript"></script>
	
	<script>
	
		jQuery.noConflict();
		jQuery(document).ready(function() {
		<?php
		if ($type == "regional")
		{
			$liga = str_replace(" ","%20","$liga");
			echo "jQuery('.ranks').load('http://myVBC.vbclangenthal.ch/bin/getgames.php?page=svrs-ranks&team=" . $team . "&type=" . $type . "&liga=" . $liga ."');";
			echo "\njQuery('.games').load('http://myVBC.vbclangenthal.ch/bin/getgames.php?page=svrs-games&team=" . $team . "&type=" . $type . "&liga=" . $liga ."');";
		}
		elseif ($type == "national")
		{
			echo "jQuery('.ranks').load('http://myVBC.vbclangenthal.ch/bin/getgames.php?page=sw-ranks&team=" . $team . "&type=" . $type . "&liga=" . $liga ."');";
			echo "\njQuery('.games').load('http://myVBC.vbclangenthal.ch/bin/getgames.php?page=sw-games&team=" . $team . "&type=" . $type . "&liga=" . $liga ."');";
		}
		?>
		
		});
	
	
	</script>
	
	<style type="text/css">
	<!--

		body {
			background-color:	#ffffff;
			font-family:Arial,Verdana,sans-serif;
			font-size:9pt;
		}

		a {
			color:#930;
			text-decoration:none
		}

		a:hover {
			color:#fa0;
			text-decoration:none
		}

		p.topic {
			font-size:			10pt;
			font-family:		Arial;
			font-weight:		bold;
			text-align:			left;
		}
		
		p.copyright {
			font-size:			8pt;
			font-family:		Arial;
			text-align:			left;
		}
		
		table.result-table
		{
			width:				600px;
			border:				none;
			
			font-size:			7pt;
			font-family:		Arial;
			border-collapse:	collapse;
		}
		
		table.result-table th
		{
			background-color:	#b0b0b0;
			padding:			2px;
		}
		
		td.td_hightligh
		{
			background-color: 	#578ced;
		}

	//-->
	</style>
	
	<p class='topic'>Rangliste</p>
	<div class='ranks'>
	<table class='result-table'>
	<tr>
		<th width='5%'><b>Rang</b></th>
		<th width='75%'><b>Team</b></th>
		<th width='5%'><b>S</b></th>
		<th width='5%'><b>P</b></th>
		<th width='10%'><b>G:V</b></th>
	</tr>
	<tr>
		<td align='center' colspan='5'>Daten werden geladen... <img alt='Daten werden geladen' src='http://myVBC.vbclangenthal.ch/bin/ajax-loader.gif'></td>
	</tr>
	</table>
	</div>


	<p class='topic'>Spielplan</p>
	<div class='games'>
	<table class='result-table'>
	<tr>
		<th width='15%'><b>Datum / Zeit</b></th>
		<th width='25%'><b>Ort / Halle</b></th>
		<th width='27%'><b>Heimteam</b></th>
		<th width='27%'><b>Gastteam</b></th>
		<th width='6%'></th>
	</tr>
	<tr>
		<td align='center' colspan='5'>Daten werden geladen... <img alt='Daten werden geladen' src='http://myVBC.vbclangenthal.ch/bin/ajax-loader.gif'></td>
	</tr>
	</table>
	</div>
	<?php

	if($type == "regional")
	{
		echo "<p class='copyright'>Ranglisten &amp; Spieldaten: &copy; <a href='http://www.volleyballvrs.ch' target='_blank' title='Swiss Volley - Region Solothurn'>SVRS</a></p>";
	}
	elseif ($type == "national")
	{
		echo "<p class='copyright'>Ranglisten &amp; Spieldaten: &copy; <a href='http://www.swissvolley.ch' target='_blank' title='Swiss Volley'>Swiss Volley</a></p>";
	}
	
	break;
}

?>
