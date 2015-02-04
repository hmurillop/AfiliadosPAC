(function() {
	//+*V?e,!}tH$(
	var app = angular.module('afiliadosPac', ['ui.bootstrap']);


	app.controller('AfiliadosPacController', ['$scope','$http', function ($scope, $http) {
		$scope.partial = 'assets/buscar-cedula.html';//buscar-cedula.html
	}]);

	app.controller('ModalInstanceCtrl', function ($scope, $modalInstance, result, afiliado,cedula) {

	  $scope.result = result;
	  $scope.afiliado = afiliado;  
	  $scope.cedula = cedula;	


	  $scope.ok = function (data) {
	    $modalInstance.close();
	  };

	  $scope.cancel = function () {
	    $modalInstance.dismiss('cancel');
	  };

	});


  	app.controller('BuscarCedulaController', ['$http','$scope','$modal', '$log',function ($http,$scope,$modal, $log) {


  		$scope.clean = function () {
  			$scope.cedula = '';
  		};

  		$scope.buscar = function() {
					// Create the http post request
					// the data holds the keywords
					// The request is a JSON request.
			$http.post('php/buscarCedula.php', { "cedula" : $scope.cedula})
				.success(function(data, status) {
					$scope.status = status;
					$scope.data = data;
					$scope.result = data;
					if ($scope.result.afiliado_cedula) {
						$scope.afiliado = true;
					}else{
						$scope.afiliado = false;
					};
					$scope.open('lg');//abre el modal
				})
				.error(function(data, status) {
					$scope.data = data || "Error en consulta";
					$scope.status = status;			
				}
			);
			//post request end 		 			

  		};


		$scope.open = function (size) {
			var modalInstance = $modal.open({
			  templateUrl: 'myModalContent.html',
			  controller: 'ModalInstanceCtrl',
			  size: size,
			  resolve: {
			  	result: function () {
			  		return $scope.result;
			  	},
			  	afiliado: function () {
			  		return $scope.afiliado;
			  	},
			  	cedula:function () {
			  		return $scope.cedula;
			  	}
			  }
			});

			modalInstance.result.then(function (data) {
				$scope.deaseaAfiliarse =  data;
				$scope.clean();

			}, function () {
				$scope.result = null;
				$scope.deaseaAfiliarse =  data;
				$scope.clean();
			});
		};


	}]);


})();