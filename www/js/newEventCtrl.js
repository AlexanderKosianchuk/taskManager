EventModule.controller('NewEventCtrl', ['$scope', '$http', '$location', 'GeneralFactory','RequestFactory',
                                        function ($scope, $http, $location, GF, RF) {
	
	$scope.newEventName = GF.newEventName;
	$scope.newEventPeriod = GF.formatData(new Date());

	$scope.SaveNewEvent = function() {	
		if(($scope.newEventName !== "") && 
				($scope.newEventName !== undefined) && 
				($scope.newEventPeriod !== undefined)){
			
			RF.createEvent($scope.newEventName, $scope.newEventPeriod)
			.success(function(){
				$location.path('/');
				GF.newEventName = "";
				$scope.$emit('UpdateEventList');
			});
		}
	}
	
	$scope.ChangeNewEventName = function() {	
		GF.newEventName = $scope.newEventName;
	}	
	
	$scope.NoPeriod = function() {	
		console.log("NoPeriod");
	}
}]);
