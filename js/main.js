(function() {
	var app = angular.module('afiliadosPac', ['ui.bootstrap']);

//   	app.controller('AfiliadosPacController', function($scope, $http){
  	 
//   	});

  	app.controller('ConsultaCedulaController', function ($scope, $http) {

      $scope.url = 'php/consultaCedula.php';

      $scope.search = function() {
         
         // Create the http post request
         // the data holds the cedula
         // The request is a JSON request.


         $http.post($scope.url, { "data" : $scope.cedula})
         .
         success(function(data, status) {
            $scope.status = status;
            $scope.data = data;
            $scope.result = data; // Show result from server in our <pre></pre> element
         })
         .
         error(function(data, status) {
            $scope.data = data || "Request failed";
            $scope.status = status;       
         });
      };   







  		$scope.clean = function () {
  			$scope.cedula = '';
  		}
	});
})();

