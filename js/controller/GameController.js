/**
 * Created by sebastianplattner on 28.08.16.
 */

myApp.controller("GameController", ["$scope", "$http", "$attrs", "$window", function($scope, $http, $attrs, $window) {


  $scope.selectedTeam = 0;
  $scope.onlyHeimspiele = 0;

  $scope.gameDetailed = {};
  $scope.teamDetailed = {};


  $scope.filterHeimspiele = function(game) {

    if ($scope.onlyHeimspiele == 0) {
      return true;
    }
    
    if ($scope.onlyHeimspiele == 1 && game.heimspiel == 1) {
      return true;
    }

    return false;
  };


  /**
   * Get all Games for a Team
   *
   * @param teamID
   */
  $scope.getGames = function(teamID) {
    $http.get("index.php/api/game/getGames/" + teamID)
      .then(function(response) {
        $scope.games = response.data;

        /*
        $scope.games.forEach(function(entry) {
          $http.get("index.php/api/game/getGameDetailed/" + entry.extid)
            .then(function(response) {
              entry.detailed = response.data
            });
        })*/
      });
  };

  /**
   * Get all Teams
   */
  $scope.getTeams = function() {
    $http.get("index.php/api/game/getTeams/")
      .then(function(response) {
        $scope.teams = response.data;

      });
  };

  /**
   * Call getGames on a change of team
   */
  $scope.changeTeam = function() {

    $scope.getGames($scope.selectedTeam);
  }

  /**
   * Get GameDetailed
   */
  $scope.getGameDetailed = function(gameID) {
    $scope.gameDetailed = {};
    $http.get("index.php/api/game/getGameDetailed/" + gameID)
      .then(function(response) {
        $scope.gameDetailed = response.data;

      });
  };

  /**
   * Get GameDetailed
   */
  $scope.getAddressesByTeam = function(gameId, home) {
    $scope.teamDetailed = {};

    // Away
    if (home == 0) {
      $http.get("index.php/api/game/getGameDetailed/" + gameId)
        .then(function(response) {

          $http.get("index.php/api/game/getAddressesByTeam/" + response.data.TeamHomeID)
            .then(function(response) {
              $scope.teamDetailed = response.data[0];
            });

        });
    } // End Away Case

    // Home
    if (home == 1) {
      $http.get("index.php/api/game/getGameDetailed/" + gameId)
        .then(function(response) {

          $http.get("index.php/api/game/getAddressesByTeam/" + response.data.TeamAwayID)
            .then(function(response) {
              $scope.teamDetailed = response.data[0];
            });

        });
    } // End Home Case

  };

  $scope.getTeams();
  $scope.getGames(0);

}]);
