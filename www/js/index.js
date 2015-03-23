var EventModule = angular.module('EventModule', ['ui.bootstrap', 'ngRoute']);

EventModule.config(['$routeProvider', function($routeProvide){
	$routeProvide
		.when('/', {
			templateUrl: 'pages/home.php',
		})
		.when('/newevent', {
			templateUrl: 'pages/newEvent.php',
			controller: 'NewEventCtrl'
		})
		.when('/updateevent/:eventId', {
			templateUrl: 'pages/updateEvent.php',
			controller: 'UpdateEventCtrl'
		})
		.otherwise({
			redirectTo : '/'
		});
}]);


///
//GeneralFactory defines formatData func, used in homeEvent, newEvent and UpdateEventCtrl
//and stores newEventName, not to loose input data in newEventCtrl
///
EventModule.factory('GeneralFactory', function() {
	  return {
		  newEventName : '',
		  ///
		  // By unknown reasons (may be angular feature) usual javascript data.format do not work
		  // thus to convert date object to formated string this function was used
		  // may be there is a way to use angular filter to do it
		  ///
		  formatData: function (d){
				var currY = d.getFullYear();
			    var currM = d.getMonth() + 1; //Months are zero based
			    if (currM < 10)
			        currM = "0" + currM;
			    var currD = d.getDate();
			    if (currD < 10)
			        currD = "0" + currD;
			    var formaredDate = currY + "/" + currM + "/" + currD;
			    
				return formaredDate;
			}
	  };
});

EventModule.factory('RequestFactory', function($http) {
	var requestUrl = location.protocol + '//' + location.host + "/taskManagerAPI.php",
	GET_ALL_EVENTS = "GET_ALL_EVENTS",
	GET_EVENTS_IN_PERIOD = "GET_EVENTS_IN_PERIOD",
	GET_EVENT_BY_ID = "GET_EVENT_BY_ID",
	CREATE_EVENT =  "CREATE_EVENT",
	UPDATE_EVENT = "UPDATE_EVENT",
	DELETE_EVENT= "DELETE_EVENT";
	return {
		createEvent: function(newEventName, newEventPeriod) {
			return $http({
				url: requestUrl,
				method: "GET",
				params: {
					action: CREATE_EVENT,
					name: newEventName,
					period: newEventPeriod
				}
			});
		},
		createEvent: function(newEventName, newEventPeriod) {
			return $http({
				url: requestUrl,
				method: "GET",
				params: {
					action: CREATE_EVENT,
					name: newEventName,
					period: newEventPeriod
				}
			});
		},
		getEventById: function(eventId){
			return $http({
			    url: requestUrl, 
			    method: "GET",
			    params: {
			    	action: GET_EVENT_BY_ID,
			    	eventId: eventId
			    }
			});
		},
		updateEvent: function(eventId, name, date, status){
			return $http({
			    url: requestUrl, 
			    method: "GET",
			    params: {
			    	action: UPDATE_EVENT,
			    	eventId: eventId,
			    	name: name,
			    	period: date,
			    	status: status
			    }
			});
		},
		updateEvent: function(eventId, name, date, status){
			return $http({
			    url: requestUrl, 
			    method: "GET",
			    params: {
			    	action: UPDATE_EVENT,
			    	eventId: eventId,
			    	name: name,
			    	period: date,
			    	status: status
			    }
			});
		},
		deleteEvent: function(eventId){
			return $http({
			    url: requestUrl, 
			    method: "GET",
			    params: {
			    	action: DELETE_EVENT,
			    	eventId: eventId
			    }
			});
		},
		getEvents: function(formatedFrom, formatedTo){
			return $http({
			    url: requestUrl, 
			    method: "GET",
			    params: {
			    	action: GET_EVENTS_IN_PERIOD,
			    	from: formatedFrom,
			    	to: formatedTo
			    }
			});
		}
	  };
});