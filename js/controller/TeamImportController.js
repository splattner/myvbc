/**
 * Created by sebastianplattner on 30.08.16.
 */


myApp.controller("TeamImportController", ["$scope", "$http", "$attrs", "$window", function($scope, $http, $attrs, $window) {

  $scope.teams = {};
  $scope.selectedTeam = {};
  $scope.selectedTeamID = 0;

  $scope.isEmpty = function(obj){
    return Object.keys(obj).length === 0;
  };



  $scope.getTeams = function() {

    $http.get("index.php/api/teamImport/getTeamsByClub/")
      .then(function(response) {
        $scope.teams = response.data;

        if ($scope.selectedTeamID > 0 ){
          $scope.selectedTeam = $scope.teams.filter(function (team) {
            return (team.ID_team === $scope.selectedTeamID);
          })[0];
        }

      });
  };



  $scope.init = function(teamId) {
    $scope.selectedTeamID = teamId;
  }

  $scope.getTeams();

}]);
