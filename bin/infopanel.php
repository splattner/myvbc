<?php


require "class.swissvolley.php";

$clubID_cup = 908240;
$clubID_bern = 907920;
$days = 21;

class VolleyGame {

	public $date;
	public $HallPlace;
	public $HallCaption;
	public $league;
	public $teamHome;
	public $teamAway;
	public $NumberOfWinsHome;
	public $NumberOfWinsAway;

}

function parseRawGamesSV($raw_games) {

	$lastGames = array();
    $nextGames = array();
    global $days;

    if (count($raw_games) == 0) {
    	return array($lastGames,$nextGames);
    }

	foreach($raw_games as $game) {

		$today = new DateTime("now");
		$playDate = DateTime::createFromFormat("Y-m-d H:i:s", $game->PlayDate);

		$diff = $today->diff($playDate);

		if ($game->IsResultCommited == 1 && $diff->d <= $days && $diff->m == 0) {

			$volleyGame = new VolleyGame();
			$volleyGame->date = $playDate->format("d.m.Y");
			$volleyGame->league = $game->LeagueCatCaption;
			$volleyGame->teamHome = $game->TeamHomeCaption;
			$volleyGame->teamAway = $game->TeamAwayCaption;
			$volleyGame->NumberOfWinsHome = $game->NumberOfWinsHome;
			$volleyGame->NumberOfWinsAway = $game->NumberOfWinsAway;

      $lastGames[] = $volleyGame;

		} else {
      if($diff->d <= $days && $diff->m == 0 && $diff->invert == 0) {

      	$volleyGame = new VolleyGame();
				$volleyGame->date = $playDate->format("d.m.Y H:i");
				$volleyGame->league = $game->LeagueCatCaption;
				$volleyGame->teamHome = $game->TeamHomeCaption;
				$volleyGame->teamAway = $game->TeamAwayCaption;
				$volleyGame->HallPlace = $game->HallPlace;
				$volleyGame->HallCaption = $game->HallCaption;

          $nextGames[] = $volleyGame;
      }
		}
	}

	return array($lastGames, $nextGames);
}



if (isset($_GET["do"])) {
	$do = $_GET["do"];
} else {
	$do = "buildTable";
}

if ($do == "buildTable") {
	$sv = new swissvolley();


	$games_cup_raw = $sv->getGamesByClub($clubID_cup);
	$games_bern_raw = $sv->getGamesByClub($clubID_bern);

	// Parse National Games (SwissVolley for Cup)
  $parsedGamesNational = parseRawGamesSV($games_cup_raw);
  $parsedGamesNational = parseRawGamesSV($games_cup_raw);
  $lastGamesNational = $parsedGamesNational[0];
  $nextGamesNational = $parsedGamesNational[1];

  // Parse Games Region Bern-Solothurn
  $parsedGamesBern= parseRawGamesSV($games_bern_raw);
  $parsedGamesBern = parseRawGamesSV($games_bern_raw);
  $lastGamesBern = $parsedGamesBern[0];
  $nextGamesBern = $parsedGamesBern[1];



  $nextGames = array_merge($nextGamesNational,$nextGamesBern, $nextGamesSolothurn);
  $lastGames = array_merge($lastGamesNational, $lastGamesBern, $lastGamesSolothurn);

  function sortFunction($a, $b) {
  	return(strtotime($a->date) - strtotime($b->date));
  }

  usort($nextGames, "sortFunction");
  usort($lastGames, "sortFunction");



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

	foreach($nextGames as $game) {

		$body_nextGames .= "<tr>
							<td>" . $game->date . "</td>
							<td>" . $game->HallPlace . " " . $game->HallCaption ."</td>
							<td>" . $game->league . "</td>
							<td style=\"text-align: right;\">" . $game->teamHome . "</td>
							<td style=\"text-align: center;\">:</td>
							<td style=\"text-align: left;\">" . $game->teamAway . "</td>
							</tr>";

	}

	foreach($lastGames as $game) {
		$body_lastGames .= "<tr>
                            <td>" . $game->date . "</td>
                            <td>" . $game->league. "</td>
                            <td>" . $game->teamHome . "</td>
                            <td>" . $game->teamAway . "</td>
                            <td>" . $game->NumberOfWinsHome . ":". $game->NumberOfWinsAway ."</td>
                            </tr>";
	}



	$footer = "</table>";



    // Next Games
	$output_nextGames = $header_nextGames;
    if(count($body_nextGames > 0)) {
        $output_nextGames .= $body_nextGames;
    }
    $output_nextGames .= $footer;

    // Last Games
    $output_lastGames = $header_lastGames;
    if(count($lastGames) > 0) {
        $output_lastGames .= $body_lastGames;
    }
    $output_lastGames .= $footer;


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

<div id="results">
</div>

<p class="copyright" >
	Ranglisten &amp; Spieldaten: &copy; <a href="http://www.volleyballvrs.ch" target="_blank" title="Swiss Volley - Region Solothurn">Swiss Volley - Regio Solothurn </a>
	 &amp; <a href="http://www.swissvolley.ch" target="_blank" title="Swiss Volley">Swiss Volley</a>
</p>


<?

}



?>
