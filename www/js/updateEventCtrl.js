EventModule.controller('UpdateEventCtrl', ['$scope', '$http', '$routeParams', '$location', 'GeneralFactory','RequestFactory',
                                           function ($scope, $http, $routeParams, $location, GF, RF) {
	$scope.eventId = $routeParams.eventId;
	
	RF.getEventById($scope.eventId)
	.success(function(data){
		$scope.event = data;
	});
	
	$scope.UpdateEvent = function(eventId) {	
		if(($scope.event.name !== undefined) && 
				($scope.event.date !== undefined) && 
				($scope.event.status !== undefined)){
			
			RF.updateEvent(eventId, $scope.event.name, $scope.event.date, $scope.event.status)
			.success(function(){
				$location.path('/');
				$scope.$emit('UpdateEventList');
			});
		}
	}
	
	$scope.DeleteEvent = function(eventId) {	
		RF.deleteEvent(eventId)
		.success(function(){
			$location.path('/');
			$scope.$emit('UpdateEventList');
		});
	}
}]);