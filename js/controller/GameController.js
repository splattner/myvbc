/**
 * Created by sebastianplattner on 28.08.16.
 */

myApp.controller("GameController", ["$scope", "$http", "$attrs", "$window", function($scope, $http, $attrs, $window) {


  $scope.selectedTeam = 0;

  $scope.gameDetailed = {};


  /**
   * Get all Games for a Team
   *
   * @param teamID
   */
  $scope.getGames = function(teamID) {
    $http.get("index.php/api/game/getGames/" + teamID)
      .then(function(response) {
        $scope.games = response.data;

        /*$scope.games.forEach(function(entry) {
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
    $http.get("index.php/api/game/getGameDetailed/" + gameID)
      .then(function(response) {
        $scope.gameDetailed = response.data;

      });
  };

  $scope.getTeams();
  $scope.getGames(0);

}]);
