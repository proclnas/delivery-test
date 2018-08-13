(function(){
    'use strict';

    var app = angular.module('delivery', [])

    app.controller('UploadCtrl', function($scope, $http){
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
    });

    app.controller('EntregaCtrl', function($scope, $http){
        var map;
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();

        $scope.entregas = [];
        $scope.clientes = [];
        $scope.loading = false;
        
        $scope.getEntregas = function() {
            $scope.loading = true;
            $http.get('api/v1/clients/entregas').then(function(res){
                $scope.entregas = res.data;
                $scope.clientes = res.data;
                $scope.loading = false;
            });
        }

        $scope.openModal = function(event) {
            $('#myModal').modal('toggle');

            var enderecoPartida = 'Avenida Dr. Gastão Vidigal, 1132 Vila Leopoldina';
            var endCliente = event.entrega.address[0];
            var enderecoChegada = endCliente.lograudoro + ', ' + endCliente.numero + ' ' + endCliente.cidade;  

            var request = {
                origin: enderecoPartida,
                destination: enderecoChegada,
                travelMode: google.maps.TravelMode.DRIVING
            };
        
            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(result);
                    directionsDisplay.setPanel(document.getElementById('trajeto-texto'));
                }
            });
        }

        $scope.exportCsv = function() {
            window.location.href = 'api/v1/clients/export';
        }

        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
            
            var options = {
               zoom: 5,
               center: latlng,
               mapTypeId: google.maps.MapTypeId.ROADMAP
            };
          
            map = new google.maps.Map(document.getElementById("mapa"), options);
            directionsDisplay.setMap(map);

        }
        
        initialize();
        $scope.getEntregas();
    })
})()