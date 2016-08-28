/**
 * Created by shadowx on 8/27/16.
 */


var app = angular.module('app', []);

app.controller('currencyController', getCurrency);

/*
 http://apilayer.net/api/live
 ? access_key = YOUR_ACCESS_KEY
 & currencies = AUD,EUR,GBP,PLN
 */
function getCurrency($scope, $http){
        // $http.get('http://apilayer.net/api/live?access_key=e969b088fe149bddd0930966fd2b89b3&currencies=HTG,EUR,DOP&format=1')
        //     .success(function(data){
        //         $scope.currency = data;
        //     }).error(function(){
        //         alert("ERROR");
        //
        // });
}