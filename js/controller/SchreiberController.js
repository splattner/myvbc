/**
 * Created by sebastianplattner on 30.08.16.
 */


myApp.controller('SchreiberController', ['$scope', '$http', '$attrs', '$window', function($scope, $http, $attrs, $window) {

  $scope.gameID = $attrs.gameid;
  $scope.selectedSchreiber = {};
  $scope.schreiberInfo = null;

  $scope.getGame = function(gameID) {

    $http.get("index.php/api/game/getGame/" + gameID)
      .then(function(response) {
        $scope.game = response.data[0];

      });
  };

  $scope.getSchreiber = function(gameID) {

    $http.get("index.php/api/schreiber/getSchreiber/" + gameID)
      .then(function(response) {
        $scope.schreibers = response.data;


      });
  };

  $scope.getValidSchreiber = function(gameID) {

    $http.get("index.php/api/schreiber/getValidSchreiber/" + gameID)
      .then(function(response) {
        $scope.allSchreiber = response.data;
      });
  };

  $scope.getSchreiberInfo = function() {


    $http.get("index.php/api/schreiber/getSchreiberInfo/" + $scope.gameID + "/" + $scope.selectedSchreiber.id)
      .then(function(response) {
        $scope.schreiberInfo = response.data;


      });


  };

  $scope.getSchreiberProposal = function(gameID) {

    $http.get("index.php/api/schreiber/getSchreiberProposal/" + gameID)
      .then(function(response) {
        $scope.schreiberproposal = response.data;

      });
  };


  $scope.addSchreiber = function() {

    newSchreiber = {
      "personID": $scope.selectedSchreiber.id,
      "gameID": $scope.gameID
    };

    $http.post("index.php/api/schreiber/changeSchreiber/" + $scope.gameID, newSchreiber)
      .then(function(response) {

        $scope.selectedSchreiber = {};
        $scope.schreiberInfo = null;
        $scope.getSchreiber($scope.gameID);
      });

  };

  $scope.removeSchreiber = function(personID) {

    $http.delete("index.php/api/schreiber/changeSchreiber/" + $scope.gameID + "/" + personID)
      .then(function(response) {

        $scope.getSchreiber($scope.gameID);
      });

  };

  $scope.getGame($scope.gameID);
  $scope.getSchreiber($scope.gameID);
  $scope.getValidSchreiber($scope.gameID);
  $scope.getSchreiberProposal($scope.gameID);

}]);