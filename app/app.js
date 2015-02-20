(function() {
	//+*V?e,!}tH$(
	//DECLARACION MODULOS
	var app = angular.module('afiliadosPac', ['ngAnimate','ui.bootstrap']);

	app.factory('getTableData', function ($http) {
		console.log('FACTORY - getTableData');
		var getTableData = {
			table : function (name) {
				var promise = $http.get('php/get'+name+'.php').then(
					function (response) {							
						return response.data;
					}						
				);
				return promise;
			}		
		};
		return getTableData;											
	});
	app.factory('getJsonTemplate', function ($http) {
		console.log('FACTORY - getJsonTemplate');
		var getJsonTemplate = {
			file : function (name) {
				var promise = $http.get('app/DataTemplateJSON/'+name+'.json').then(
					function (response) {							
						return response.data;
					}						
				);
				return promise;
			}		
		};
		return getJsonTemplate;											
	});

	app.factory('postRegistro', function ($http) {
		console.log('FACTORY - postRegistro');
		var postRegistro = {
			registro : function (object) {
				var promise = $http.post('php/postRegistro.php',object).then(
					function (response) {							
						return response.data;
					}						
				);
				return promise;
			}		
		};
		return postRegistro;											
	});


	app.controller('AfiliadosPacController', ['$animate','$scope','$http', function ($animate,$scope, $http) {

		$scope.partials = {
			buscarCedula : 'app/BuscarCedula/buscarCedula.html',
			registroAfiliado : 'app/RegistroAfiliado/registroAfiliado.html',
			// formRegistro : 'app/RegistroAfiliado/formRegistro.html'
		}

		//
		$scope.partial = $scope.partials.buscarCedula;

		$scope.setPartial = function (partial) {
			$scope.partial = partial;
			console.log('URL: ' + $scope.partial);
		}
		//
		$scope.afiliado = {};
		$scope.resetAfiliado = function () {
			$scope.afiliado = {};
		};		
		$scope.solicitud = {};
		$scope.resetSolicitud = function () {
			$scope.solicitud = {};
		};
		// Regular expressions
		$scope.RegExp = {};
		$scope.RegExp.integer = /^(0|[1-9][0-9]*)$/;	
		$scope.RegExp.char =  !/[^a-zA-Z]*\d/;
		// /^[a-zA-Z]{0,}(\s[a-zA-Z]+)*$/;

	}]);


	app.controller('ModalInstanceCtrl', function ($scope, $modalInstance, config) {	  
	console.log("modal config - ",config);
	  $scope.afiliado = config;
	  $scope.config = config;//objeto
	  $scope.ok = function (data) {
	    $modalInstance.close();
	  };  

	  // $scope.cancel = function () {
	  //   $modalInstance.dismiss('cancel');
	  // };
	});
	app.controller('DatePickerCtrl', function ($scope,$filter) {

		$scope.processDate = function()
	  	{
	  		$scope.registro.nacimiento = $filter('date')($scope.registro.nacimiento, 'dd-MM-yyyy'); 
	  	}
		$scope.today = function() {
		$scope.dt = new Date();
		};
		$scope.today();

		$scope.clear = function () {
		$scope.dt = null;
		};

		// Disable weekend selection
		$scope.disabled = function(date, mode) {
		return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
		};

		$scope.open = function($event) {
		$event.preventDefault();
		$event.stopPropagation();

		$scope.opened = true;
		}
		;
		$scope.dateOptions = {
		formatYear: 'yyyy',
		modelDateFormat: "yyyy-MM-dd"

		};

		$scope.formats = ['dd-MM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
		$scope.format = $scope.formats[0];
	});


	app.controller('RegistroAfiliadoController', ['postRegistro','getJsonTemplate','getTableData','$http','$scope','$modal', '$log', 
		function (postRegistro,getJsonTemplate,getTableData,$http,$scope,$modal, $log) {	
			getTableData.table('Ocupaciones').then(
				function  (d) {
					$scope.ocupaciones = d;						
				},
				function () {							
					getTableData.table('Ocupaciones');
				}
			);

			$scope.registro = {};


			// $scope.solicitud.cedula = '115240447';
			// // $scope.solicitud.cedula = $scope.cedula;
			// $scope.solicitud.nombre = 'hector';
			// $scope.solicitud.apellido1 = 'murillo';
			// $scope.solicitud.apellido2 = 'porras';
			// $scope.solicitud.tel_hab = '25511743';
			// $scope.solicitud.tel_cel = '88769854';
			// $scope.solicitud.tel_ofi = '88768854';
			// $scope.solicitud.tel_fax = '25511743';
			// $scope.solicitud.email = 'hmurillo@gmail.com';

			getJsonTemplate.file('registroAfiliado').then(
				function (data) {						
				$scope.registro = angular.copy(data);

				$scope.registro.cedula = $scope.solicitud.cedula;

				$log.info($scope.registro);

				// angular.copy($scope.registro, $scope.solicitud );
			}, function (data) {
				$scope.registro = data;
				getJsonTemplate.file('registroAfiliado');				
			});

			$log.info($scope.registro);

			getTableData.table('Distelec').then(
				function  (d) {
					$scope.distelec = d;
				},
				function () {							
					getTableData.table('Distelec');
				}							
			);		
			$scope.respuestaServidor = {};	
			$scope.registrar = function() {
				postRegistro.registro($scope.registro).then(function (data) {
					$scope.respuestaServidor = data;					
					console.log(data);
					$scope.setPartial($scope.partials.buscarCedula);
					$scope.open('lg');		
						
				}, function () {
					$scope.respuestaServidor = data;
					console.log(data.msg);
					$scope.open('lg');
				});
				


				$scope.formRegistro.$pristine = true;
				$scope.formRegistro.$untoched = true;
				$scope.formRegistro.$submitted = false;

			};
			$scope.open = function (size) {
				var modalInstance = $modal.open({
				  templateUrl: 'app/RegistroAfiliado/msgRegistro.html',
				  controller: 'ModalInstanceCtrl',
				  size: size,
				  resolve: {
				  	config: function () {
				  		return $scope.respuestaServidor;
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
			$scope.limpiarColabora = function () {
				$scope.registro.colabora_organizacion  = null;
				$scope.registro.colabora_miembro_mesa = null;
				$scope.registro.colabora_fiscal = null;
				$scope.registro.colabora_transporte = null;
				$scope.registro.contribuyente = null;
				$scope.registro.colabora_otros = null;
			};
		}
	]);

	app.controller('BuscarCedulaController', ['$http','$scope','$modal', '$log',function ($http,$scope,$modal, $log) {		
  		$scope.buscar = function(cedula) {
			// Create the http post request
			// the data holds the keywords
			// The request is a JSON request.
			// $scope.solicitud.cedula = '115240447';
			// // $scope.solicitud.cedula = $scope.cedula;
			// $scope.solicitud.nombre = 'hector';
			// $scope.solicitud.apellido1 = 'murillo';
			// $scope.solicitud.apellido2 = 'porras';
			// $scope.solicitud.tel_hab = '25511743';
			// $scope.solicitud.tel_cel = '88769854';
			// $scope.solicitud.tel_ofi = '88768854';
			// $scope.solicitud.tel_fax = '25511743';
			// $scope.solicitud.email = 'hmurillo@gmail.com';
			$scope.solicitud.cedula = cedula;
			$http.post('php/buscarCedula.php', {'cedula': cedula})
				.success(function(data, status) {
					$scope.status = status;
					$scope.data = data;

					$scope.afiliado = data;

					$scope.open('lg');//abre el modal	

					if ($scope.afiliado.length > 0) {
						console.log('if');							
						$scope.setPartial($scope.partials.registroAfiliado);
					}else{
						console.log('esle');
						$scope.resetSolicitud();
						$scope.setPartial($scope.partials.buscarCedula);
							
					}					
					// console.log($scope.afiliado);

				})
				.error(function(data, status) {
					$scope.data = data || "Error en consulta";
					$scope.status = status;		
					$scope.afiliado = data;					
				}
			);
			//post request end
			$scope.cedula = '';
  		};

		$scope.open = function (size) {
			var modalInstance = $modal.open({
			  templateUrl: 'myModalContent.html',
			  controller: 'ModalInstanceCtrl',
			  size: size,
			  resolve: {
			  	config: function () {
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