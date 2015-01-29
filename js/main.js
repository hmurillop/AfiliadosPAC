(function() {



	var app = angular.module('afiliadosPac', ['ui.bootstrap']);






//   	app.controller('AfiliadosPacController', function($scope, $http){
  	 
//   	});

  	app.controller('ConsultaCedulaController', function ($scope, $http) {

      $http.get('php/consultaCedula.php')
      
      .success(function(data) {
        // here the data from the api is assigned to a variable named users
        console.log(data);
        $scope.user = data;
        console.log($scope.user);
      });

      


  		$scope.clean = function () {
  			$scope.cedula = '';
  		}

  		// $scope.consultar= function() {
		



  		// }


      console.log($scope.user);



  		
	});

  		









})();