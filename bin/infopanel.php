<?php


require "class.svrs.php";

$vereinID = 22;
$days = 7;


if (isset($_GET["do"])) {
	$do = $_GET["do"];
} else {
	$do = "buildTable";
}

if ($do == "buildTable") {
	$svrs = new svrs();
	
	$nextGames = $svrs->get_nextGamesbyVerein($vereinID,$days);
	$lastGames = $svrs->get_lastGamesbyVerein($vereinID,$days);

	
	
	$header_lastGames = "<table class=\"results_small\">
						<tr>
							<th width=\"15%\">Datum</th>
							<th width=\"10%\">Liga</th>
							<th width=\"30%\">Heimteam</th>
							<th width=\"30%\">Gastteam</th>
							<th width=\"20%\"></th>
						</tr>";
	
        $header_nextGames = "<table class=\"results_small\">
							<tr>
								<th width=\"15%\">Datum / Zeit</th>
								<th width=\"25%\">Ort</th>
								<th width=\"10%\">Liga</th>
								<th style=\"text-align: right;\" width=\"24%\">Heimteam</th>
								<th width=\"2%\"></th>
								<th tyle=\"text-align: left;\" width=\"24%\">Gastteam</th>
					</tr>";


	$body_nextGames = "";
	$body_lastGames = "";
	
	// Build Body of Game Table
	if (count($nextGames) == 0) {
		$body_nextGames = "<tr><td align=\"center\" colspan=\"5\">Keine Spiele in den n&auml;chsten 7 Tagen</td></tr>";
	} else {
		foreach ($nextGames as $game) {
		
			
			list ($datum, $zeit) = explode(" ", $game["isodatum"]);
			list ($stunde, $minute, $sekunde) = explode (":", $zeit);
			list ($jahr, $monat, $tag) = explode("-", $datum);
			$date = $tag . "." . $monat . "." . $jahr . " " . $stunde . ":" . $minute;
			$datum = $tag . "." . $monat . "." . $jahr;
			
			//if ( strcmp(date("d.m.Y"),$datum) == 0) { echo "true"; }
			
			if (date("d.m.Y") == $datum  && (date("G") > $stunde || (date("G") == $stunde && date("m") >= $minute))) {
			
			} else {
	
				$body_nextGames .= "<tr>
							<td>" . $date . "</td>
							<td>" . $game["ort"] . " " . $game["halle"] ."</td>
							<td>" . $game["liga"] . "</td>
							<td style=\"text-align: right;\">" . $game["heimteam"] . "</td>
							<td style=\"text-align: center;\">:</td>
							<td style=\"text-align: left;\">" . $game["gastteam"] . "</td>";
				$body_nextGames .= "</tr>";
			}
		}
	}
	
	// Build Body of Game Table
	if (count($lastGames) == 0) {
        	$body_lastGames = "<tr><td align=\"center\" colspan=\"5\">Keine Resultate vorhanden</td></tr>";
	} else {
        	foreach (array_reverse($lastGames) as $game) {
				if ($game["satzheim"] != 0 || $game["satzgast"] != 0) {

		                list ($datum, $zeit) = explode(" ", $game["isodatum"]);
        	        	list ($stunde, $minute, $sekunde) = explode (":", $zeit);
                		list ($jahr, $monat, $tag) = explode("-", $datum);
		                $date = $tag . "." . $monat . "." . $jahr;

		                $body_lastGames .= "<tr>
        	                	            	<td>" . $date . "</td>
							<td>" . $game["liga"] . "</td>
               	        		                <td>" . $game["heimteam"] . "</td>
        	                                	<td>" . $game["gastteam"] . "</td>
							<td>" . $game["satzheim"] . ":". $game["satzgast"] ."</td>";
		                $last_games .= "</tr>";
			}
        	}
	}

	
	$footer = "</table>";
		
	$output_nextGames = $header_nextGames . $body_nextGames . $footer;
	$output_lastGames = $header_lastGames . $body_lastGames . $footer;
	
	
	echo "<h3>Resultate</h3>" . $output_lastGames . "<h3>N&auml;chste Spiele</h3>". $output_nextGames;

} else {
?>

<script src="http://www.vbclangenthal.ch/myvbc/bin/jquery-1.3.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
<!--
	jQuery.noConflict();
	jQuery(document).ready(function() {
		jQuery('#results').load('http://www.vbclangenthal.ch/myvbc/bin/infopanel.php');
	});
//-->
</script>

<div id="results"></div>

<p class="copyright" >
	Ranglisten &amp; Spieldaten: &copy; <a href="http://www.volleyballvrs.ch" target="_blank" title="Swiss Volley - Region Solothurn">Swiss Volley - Regio Solothurn </a>
	 &amp; <a href="http://www.swissvolley.ch" target="_blank" title="Swiss Volley">Swiss Volley</a>
</p>


<?

}



?>
