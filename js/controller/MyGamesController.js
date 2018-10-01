/**
 * Created by sebastianplattner on 28.08.16.
 */

myApp.controller("MyGamesController", ["$scope", "$http", "$attrs", "$window", function($scope, $http, $attrs, $window) {


  $scope.myGames = {}

  $scope.gameDetailed = {};
  $scope.teamDetailed = {};


  /**
   * Get all Games for a Team
   *
   * @param teamID
   */
  $scope.getMyGames = function() {
    $http.get("index.php/api/game/getMyGames/")
      .then(function(response) {
        $scope.myGames = response.data;

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
    $scope.teamDetailed = {}:

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

  $scope.getMyGames();


}]);
