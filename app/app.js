(function() {
	//+*V?e,!}tH$(
	//DECLARACION MODULOS
	var app = angular.module('afiliadosPac', ['ui.bootstrap']);

	app.controller('AfiliadosPacController', ['$scope','$http', function ($scope, $http) {

		$scope.partials = {
			buscarCedula : 'app/BuscarCedula/buscarCedula.html',
			registroAfiliado : 'app/RegistroAfiliado/formRegistro.html'
		}

		$scope.partial = $scope.partials.buscarCedula;

		$scope.setPartial = function (url) {
			$scope.partial = url;
		};

		$scope.afiliado = {};

		$scope.setAfiliado = function  (object) {
			$scope.afiliado = object;	
		};

		$scope.resetAfiliado = function () {
			$scope.afiliado = {};
		};



	}]);


	app.controller('ModalInstanceCtrl', function ($scope, $modalInstance, afiliado) {
	  
	  $scope.afiliado = afiliado;

	  $scope.ok = function (data) {
	    $modalInstance.close();
	  };

	  // $scope.cancel = function () {
	  //   $modalInstance.dismiss('cancel');
	  // };

	});

	app.controller('BuscarCedulaController', ['$http','$scope','$modal', '$log',function ($http,$scope,$modal, $log) {

		$scope.solicitud = {};

  		$scope.resetSolicitud = function () {
  			$scope.solicitud = {};
  		};

  		$scope.buscar = function() {
					// Create the http post request
					// the data holds the keywords
					// The request is a JSON request.
			$http.post('php/buscarCedula.php', $scope.solicitud)
				.success(function(data, status) {

					$scope.status = status;
					$scope.data = data;

					$scope.setAfiliado(data);

					$scope.open('lg');//abre el modal	

					if($scope.afiliado.afiliado_cedula == undefined){						
						$scope.setPartial($scope.partials.registroAfiliado);
					}else{						
						$scope.setPartial($scope.partials.buscarCedula);						
					}

				})
				.error(function(data, status) {
					$scope.data = data || "Error en consulta";
					$scope.status = status;		
					
				}
			);
			//post request end
			$scope.solicitud = {};
  		};

		$scope.open = function (size) {
			var modalInstance = $modal.open({
			  templateUrl: 'myModalContent.html',
			  controller: 'ModalInstanceCtrl',
			  size: size,
			  resolve: {
			  	afiliado: function () {
			  		return $scope.afiliado;
			  	}
			  }
			});

			// modalInstance.result.then(function (data) {
			// 	// $scope.deaseaAfiliarse =  data;
				

			// }, function () {
			// 	//$scope.result = null;
			// 	// $scope.deaseaAfiliarse =  data;				
			// });
		};

	}]);	

})();