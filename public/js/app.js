(function(){
    'use strict';

    angular.module('delivery', [])

    .controller('IndexCtrl', function($scope, $http){
        $scope.test = 'ok';
        
        $http({
            'url': 'api/v1/clients'
        }).then(function(res){
            console.log(res.data);
        });
    })
})()