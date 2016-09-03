/**
 * Created by sebastianplattner on 27.08.16.
 */


myApp.controller('OrderController', ['$scope', '$http', '$attrs', '$window', function($scope, $http, $attrs, $window) {


    $scope.uid = $window.uid;
    $scope.allowEdit = $attrs.allowedit;
    $scope.orderID = $attrs.orderid;

    $scope.getStatusList = function () {

        $http.get("index.php/api/order/getStatusList")
            .then(function (response) {
                $scope.statuslist = response.data;

            });
    };

    $scope.getOrder = function(orderID) {
        $http.get("index.php/api/order/getOrder/" + orderID)
            .then(function(response) {

                $scope.order = response.data[0];
                $scope.order.status = String($scope.order.status);
            });
    };

    $scope.getAllPersons = function() {
        $http.get("index.php/api/order/getAllPersons")
            .then(function(response) {
                $scope.persons = response.data;
            });
    };


    $scope.getOrderItems = function(orderID) {
        $http.get("index.php/api/order/getItemsEntry/" + orderID)
            .then(function(response) {
                $scope.orderItems = response.data
            });
    };

    $scope.removeOrderItem = function(personID) {

        $http.delete("index.php/api/order/orderItem/" + $scope.orderID + "/" + removeLicence.personID)
            .then(function (response) {
                $scope.getOrderItems($scope.orderID);
            });
    };

    $scope.addNewLicence = function() {

        $scope.getAllPersons();

        licence = {
            "orderID" : 0,
            "orderitemid" : 0,
            "personID" : 0,
            "name" : "",
            "premame" : "",
            "licence" : "",
            "licenceID": 0,
            "comment" : ""
        };

        $scope.orderItems.push(licence);

    };

    $scope.addLicence = function(person) {

        newLicence = {
            "personID": person.id,
            "orderID": $scope.orderID
        };


        $http.post("index.php/api/order/orderItem/" + $scope.orderID, newLicence)
            .then(function (response) {
                $scope.getOrderItems($scope.orderID);
            });

    };


    $scope.updateStatus = function(newStatus) {

        data = {
            "status": newStatus
        };

        $http.post("index.php/api/order/updateStatus/" + $scope.orderID, data)
            .then(function (response) {
                $scope.getOrder($scope.orderID);
            });

    };

    $scope.editOrder = function() {


        data = {
            "id": $scope.order.id,
            "comment": $scope.order.comment,
            "status": $scope.order.status
        };

        $http.post("index.php/api/order/updateOrder/" + $scope.orderID, data)
            .then(function (response) {
                $scope.getOrder($scope.orderID);
            });


    };

    $scope.getStatusList();
    $scope.getOrder($scope.orderID);
    $scope.getOrderItems($scope.orderID);


}]);