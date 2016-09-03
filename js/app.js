/**
 * Created by sebastianplattner on 27.08.16.
 */


var myApp = angular.module('myvbc', ['angular.chosen'])
.config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

    }]);
