<?php


require "class.svrs.php";
require_once "class.swissvolley.php";

$team = 0;

$team = $_GET["team"];
$liga = $_GET["liga"];
$type = $_GET["type"];

switch($type) {
	case "national":
		
		
		$swissvolley = new swissvolley();
		$games = $swissvolley->get_GamesbyTeamID($team);
		$ranks = $swissvolley->get_Table($liga);
		
		//print_r($games);
		//print_r($ranklist);
		

		$header_games = "<table class=\"results\">
						<tr>
							<th width=\"20%\">Datum / Zeit</th>
							<th width=\"25%\">Ort / Zeit</th>
							<th width=\"25%\">Heimteam</th>
							<th width=\"25%\">Gastteam</th>
							<th width=\"5%\"></th>
						</tr>";
		$header_ranking = "<table class=\"results\">
						<tr>
							<th width=\"5%\">Rang</th>
							<th width=\"75%\">Team</th>
							<th width=\"5%\">S</th>
							<th width=\"5%\">P</th>
							<th width=\"10%\">G:V</th>
						</tr>";
		
		$body_games = "";
		$body_ranking = "";
		
		if (count($ranks) == 0) {
			$body_ranking .= "<td align='center' colspan='5'>Keine Rangliste vorhanden</td>";
		} else {
			foreach ($ranks as $rank)
			{
				if ($team == $rank->team_ID) {
					$body_ranking .=
					"<tr>
										<td class='td_hightligh'>" . str_replace("&amp;nbsp;","",$rank->Rank) . "</td>
										<td class='td_hightligh'>" . $rank->Caption . "</td>
										<td class='td_hightligh'>" . $rank->NumberOfGames ."</td>
										<td class='td_hightligh'><b>" . $rank->Points . "</b></td>
										<td class='td_hightligh'>" . $rank->SetsWon . ":
										" . $rank->SetsLost . "</td>
									</tr>";
				} else {
					$body_ranking .=
					"<tr>
										<td>" . str_replace("&amp;nbsp;","",$rank->Rank) . "</td>
										<td>" . $rank->Caption . "</td>
										<td>" . $rank->NumberOfGames ."</td>
										<td><b>" . $rank->Points . "</b></td>
										<td>" . $rank->SetsWon . ":
										" . $rank->SetsLost . "</td>
									</tr>";
				}
			}
		}
		
		if (count($games) == 0)	{
			$body_games .= "<td align='center' colspan='5'>Keine Spiele vorhanden</td>";
		} else {
			foreach ($games as $game)
			{
				/* formate the date */
				list ($datum, $zeit) = explode(" ", $game->PlayDate);
				list ($stunde, $minute, $sekunde) = explode (":", $zeit);
				list ($jahr, $monat, $tag) = explode("-", $datum);
				$date = $tag . "." . $monat . "." . $jahr . " " . $stunde . ":" . $minute;
		
				$body_games .= "<tr>
								<td>" . $date . "</td>
								<td>" . $game->HallPlace . " " . $game->HallCaption . "</td>
								<td>" . $game->TeamHomeCaption . "</td>
								<td>" . $game->TeamAwayCaption ."</td>
								<td>";
				if ($game->NumberOfWinsHome != 0 || $game->NumberOfWinsAway != 0)
				{
					$body_games .= $game->NumberOfWinsHome . ":" . $game->NumberOfWinsAway;
				}
				$body_games .= "</td>
						</tr>";
			}
		}
		
		$footer_games = "</table>";
		$footer_ranking = "</table>";
		
		$output_games = $header_games . $body_games . $footer_games;
		$output_ranking = $header_ranking . $body_ranking . $footer_ranking;
		
		echo "<h3>Rangliste</h3>" . $output_ranking . "<h3>Spielplan</h3>". $output_games;

		
		break;
	default:
		
		if ($team != 0 && $liga != "") {
		
			$svrs = new svrs();
		
			$games = $svrs->get_GamesbyTeamID($team);
			$ranking = $svrs->get_RanklistbyLiga($liga);
		
		
			$header_games = "<table class=\"results\">
						<tr>
							<th width=\"20%\">Datum / Zeit</th>
							<th width=\"25%\">Ort / Zeit</th>
							<th width=\"25%\">Heimteam</th>
							<th width=\"25%\">Gastteam</th>
							<th width=\"5%\"></th>
						</tr>";
			$header_ranking = "<table class=\"results\">
						<tr>
							<th width=\"5%\">Rang</th>
							<th width=\"75%\">Team</th>
							<th width=\"5%\">S</th>
							<th width=\"5%\">P</th>
							<th width=\"10%\">G:V</th>
						</tr>";
			$body_games = "";
			$body_ranking = "";
		
		
			// Build Body of Game Table
			if (count($games) == 0) {
				$body_games = "<tr><td align=\"center\" colspan=\"5\">Keine Spiele vorhanden</td></tr>";
			} else {
				foreach ($games as $game) {
		
					list ($datum, $zeit) = explode(" ", $game["isodatum"]);
					list ($stunde, $minute, $sekunde) = explode (":", $zeit);
					list ($jahr, $monat, $tag) = explode("-", $datum);
					$date = $tag . "." . $monat . "." . $jahr . " " . $stunde . ":" . $minute;
		
					$body_games .= "<tr>
						<td>" . $date . "</td>
						<td>" . $game["ort"] . " " . $game["halle"] ."</td>
						<td>" . $game["heimteam"] . "</td>
						<td>" . $game["gastteam"] . "</td>";
		
					if ($game["satzheim"] == 0 && $game["satzgast"] == 0) {
						$body_games .="<td></td>";
					}else {
						$body_games .="<td>" . $game["satzheim"] . ":". $game["satzgast"] ."</td>";
					}
					$body_games .= "</tr>";
				}
			}
		
			// Build Body of Ranking Table
			foreach ($ranking as $liga) {
				foreach ($liga as $rank) {
					if (count($rank) == 0) {
						$body_ranking .= "<td align=\"center\" colspan=\"5\"'>Keine Rangliste vorhanden</td>";
					} else {
						if (strpos($rank["name"],"Langenthal")) {
							$body_ranking .="<tr>
									<td class='td_hightligh'>" . $rank["platz"] . "</td>
									<td class='td_hightligh'>" . $rank["name"] . "</td>
									<td class='td_hightligh'>" . $rank["spiele"] ."</td>
									<td class='td_hightligh'><b>" . $rank["punkte"] . "</b></td>
									<td class='td_hightligh'>" . $rank["satzgewonnen"] . ":
									" . $rank["satzverloren"] . "</td>
								</tr>";
						} else {
							$body_ranking .="<tr>
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
		
		
			$footer_games = "</table>";
			$footer_ranking = "</table>";
		
			$output_games = $header_games . $body_games . $footer_games;
			$output_ranking = $header_ranking . $body_ranking . $footer_ranking;
		
		
			echo "<h3>Rangliste</h3>" . $output_ranking . "<h3>Spielplan</h3>". $output_games;
		
		}
		
		
		
}

?>