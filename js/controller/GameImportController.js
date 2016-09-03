/**
 * Created by sebastianplattner on 03.09.16.
 */


myApp.controller('GameImportController', ['$scope', '$http', '$attrs', '$window', function($scope, $http, $attrs, $window) {


    $scope.selectedTeam = 0;


    $scope.getTeams = function (teamID) {

        $http.get("index.php/api/game/getTeams/")
            .then(function (response) {
                $scope.teams = response.data;
            });
    };

    $scope.getGames = function() {

        $http.get("index.php/api/game/getGamesFromExternal/" + $scope.selectedTeam.id)
            .then(function (response) {
                $scope.games = response.data;
            });
    }

    $scope.importGames = function() {

        $http.post("index.php/api/game/importGames/" + $scope.selectedTeam.id)
            .then(function (response) {

                $scope.getGames();
            });
    }

    $scope.getTeams();

}]);