(function(){
    'use strict';

    angular.module('delivery', [])

    .controller('UploadCtrl', function($scope, $http){
        $scope.test = 'ok';
        $scope.fd = new FormData();
        
        $http({
            'url': 'api/v1/clients'
        }).then(function(res){
            console.log(res.data);
        });

        $scope.prepareFile = function(files) {
            $scope.fd.delete('csv');
            $scope.fd.append('csv', files[0]);
        }

        $scope.import = function() {
            swal({
                title: 'Importar arquivo',
                text: 'Após a importação, as informações de entrega estarão disponível em clientes e entregas.' + 
                      'Obs: Os clientes existentes serão atualizados',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((confirm) => {
                if (!confirm)
                    return;

                var apiUrl = 'api/v1/clients/import';
                $scope.fd.append('nome_arquivo', $scope.nome_arquivo);
                $scope.fd.append('separador', $scope.separador);
                $scope.fd.append('obs', $scope.obs);

                $http.post(apiUrl, $scope.fd, {
                    headers: {'Content-Type': undefined },
                    transformRequest: angular.identity
                }).then(function(res){
                    swal({
                        text: 'Arquivo importado',
                        icon: 'success',
                        buttons: true
                    });
                }).catch(function(err){

                });
            });
        };
    })
})()