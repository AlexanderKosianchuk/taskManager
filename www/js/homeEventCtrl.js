EventModule.controller('EventCtrl', ['$scope', '$http', 'GeneralFactory','RequestFactory',
                                     function ($scope, $http, GF, RF) {
		
	$scope.when = 'today';
	$scope.todaySelected = 'MenuItemSelected';
	$scope.tomorrowSelected = '';
	$scope.periodSelected = '';
	
	$scope.format = 'yyyy/MM/dd'; 
	/*$scope.dtFrom = $scope.dtFrom.format($scope.format); //not working here, thus using formatData func
	$scope.dtTo = $scope.dtTo.format($scope.format);*/
	$scope.dtFrom = GF.formatData(new Date());
	$scope.dtTo = GF.formatData(new Date());
	
	RF.getEvents($scope.dtFrom, $scope.dtTo)
	.success(function(data){	
		$scope.events = data;
	});
	
	$scope.OpenFrom = function($event) {
		$event.preventDefault();
		$event.stopPropagation();
		
		$scope.openedFrom = true;
		$scope.openedTo = false;
	};
	
	$scope.OpenTo = function($event) {
		$event.preventDefault();
		$event.stopPropagation();
		
		$scope.openedFrom = false;
		$scope.openedTo = true;
	};
	
	///
	// Click menu item today
	///
	$scope.Today = function() {
		$scope.when = 'today';
		$scope.todaySelected = 'MenuItemSelected';
		$scope.tomorrowSelected = '';
		$scope.periodSelected = '';
		
		$scope.dtFrom = GF.formatData(new Date());
		$scope.dtTo = GF.formatData(new Date());
		
		RF.getEvents($scope.dtFrom, $scope.dtTo)
		.success(function(data){	
			$scope.events = data;
		});
	};
	
	///
	// Click menu item tomorrow
	///
	$scope.Tomorrow = function() {
		$scope.when = 'tomorrow';
		$scope.todaySelected = '';
		$scope.tomorrowSelected = 'MenuItemSelected';
		$scope.periodSelected = '';
		
		var today = new Date();
		var tomorrow = new Date(today);
		tomorrow.setDate(today.getDate()+1);
		
		$scope.dtFrom = GF.formatData(tomorrow);
		$scope.dtTo = GF.formatData(tomorrow);  
	
		RF.getEvents($scope.dtFrom, $scope.dtTo)
		.success(function(data){	
			$scope.events = data;
		});
	};
	
	///
	// Click menu item period
	///
	$scope.Period = function() {	
        var formatedFrom = GF.formatData(new Date($scope.dtFrom)),
        	formatedTo = GF.formatData(new Date($scope.dtTo));  
        
        if(formatedFrom == formatedTo){
        	$scope.when = "at " + formatedFrom;
        } else if(formatedFrom < formatedTo){
        	$scope.when = "from " + formatedFrom + " to " + formatedTo;
        } else {
        	$scope.dtFrom = formatedTo;
        	$scope.dtTo = formatedFrom;
        	formatedFrom = GF.formatData(new Date($scope.dtFrom)),
        	formatedTo = GF.formatData(new Date($scope.dtTo)); 
        	$scope.when = "from " + formatedFrom + " to " + formatedTo;
        }
        
        RF.getEvents(formatedFrom, formatedTo)
        .success(function(data){	
        	$scope.events = data;
        });

		$scope.todaySelected = '';
		$scope.tomorrowSelected = '';
		$scope.periodSelected = 'MenuItemSelected';
	};
	
	///
	// Change from day in main menu
	///
	$scope.SelectFromDate = function() {
		$scope.todaySelected = '';
		$scope.tomorrowSelected = '';
		$scope.periodSelected = 'MenuItemSelected';
		
		var formatedFromDate = new Date($scope.dtFrom),
			formatedToDate = new Date($scope.dtTo)
		
		if((formatedFromDate != 'Invalid Date') && (formatedToDate != 'Invalid Date') &&
				(formatedFromDate <= formatedToDate)){
	        var formatedFrom = GF.formatData(formatedFromDate),
	    		formatedTo = GF.formatData(formatedToDate);  

	        $scope.when = "from " + formatedFrom + " to " + formatedTo;
			
			RF.getEvents(formatedFrom, formatedTo)
			.success(function(data){	
				$scope.events = data;
			});
		}
	}
	
	///
	// Change to day in main menu
	///
	$scope.SelectToDate = function() {
		$scope.todaySelected = '';
		$scope.tomorrowSelected = '';
		$scope.periodSelected = 'MenuItemSelected';
		
		var formatedFromDate = new Date($scope.dtFrom),
		formatedToDate = new Date($scope.dtTo)
	
		if((formatedFromDate != 'Invalid Date') && (formatedToDate != 'Invalid Date') &&
				(formatedFromDate <= formatedToDate)){
	        var formatedFrom = GF.formatData(formatedFromDate),
	    		formatedTo = GF.formatData(formatedToDate);  
	
	        $scope.when = "from " + formatedFrom + " to " + formatedTo;
			
			RF.getEvents(formatedFrom, formatedTo)
			.success(function(data){	
				$scope.events = data;
			});
		}
	}
	
	///
	// Calls from newEventCtrl and updateEventCtrl to update events list after applying changes
	/// 
	$scope.$on('UpdateEventList', function(event, args) {
        var formatedFrom = GF.formatData(new Date($scope.dtFrom)),
    		formatedTo = GF.formatData(new Date($scope.dtTo));  
		
        RF.getEvents(formatedFrom, formatedTo)
        .success(function(data){	
        	$scope.events = data;
        });
	});
}]);
