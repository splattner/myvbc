/**
 * Created by sebastianplattner on 28.08.16.
 */

myApp.controller("GameController", ["$scope", "$http", "$attrs", "$window", function($scope, $http, $attrs, $window) {


  $scope.selectedTeam = 0;


  /**
   * Get all Games for a Team
   *
   * @param teamID
   */
  $scope.getGames = function(teamID) {
    $http.get("index.php/api/game/getGames/" + teamID)
      .then(function(response) {
        $scope.games = response.data;


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

  $scope.getTeams();
  $scope.getGames(0);

}]);
