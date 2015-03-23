<!DOCTYPE html>
<html lang="en" ng-app="EventModule">
<head>
<title>Task Manager</title>

<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

<!-- <script src="js/lib/angular.min.js"></script> -->
<!-- <script src="js/lib/angular-route.min.js"></script> -->

<!-- <script src="js/lib/ui-bootstrap-tpls-0.12.1.js"></script> -->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
<script src="js/lib/angular-route.min.js"></script>

<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.1.js"></script>

<script src="js/index.js"></script>
<script src="js/homeEventCtrl.js"></script>
<script src="js/newEventCtrl.js"></script>
<script src="js/updateEventCtrl.js"></script>

<link rel="stylesheet" href="css/mainStyle.css"></link>

</head>
<body>

<div ng-controller="EventCtrl" class="PageWrapper">

	<!-- MAIN MENU -->
	<div class="PageBuffer">
		<div class="MainMenu">
			<a href="#/"><div class="MenuItem" ng-class="todaySelected" ng-click="Today()">Today</div></a>
			<a href="#/"><div class="MenuItem" ng-class="tomorrowSelected" ng-click="Tomorrow()">Tomorrow</div></a>
			<a href="#/"><div class="MenuItem" ng-class="periodSelected" ng-click="Period()">Period</div></a>
			    
			<div class="MenuItem col-md-6">
	            <p class="input-group">
	              <input type="text" class="form-control" 
	              	datepicker-popup="{{format}}" 
	              	ng-model="dtFrom" 
	              	ng-change="SelectFromDate()"
	              	is-open="openedFrom" 
	              	datepicker-options="dateOptions" 
	              	date-disabled="disabled(date, mode)" 
	              	ng-required="true" 
	              	close-text="Close" />
	              <span class="input-group-btn">
	                <button type="button" class="btn btn-default" ng-click="OpenFrom($event)"><i class="glyphicon glyphicon-calendar"></i></button>
	              </span>
	            </p>
	        </div>
	        
	        <div class="MenuItem col-md-6">
	            <p class="input-group">
	              <input type="text" class="form-control" 
	              	datepicker-popup="{{format}}" 
	              	ng-model="dtTo" 
	              	ng-change="SelectToDate()"
	              	is-open="openedTo" 
	              	datepicker-options="dateOptions" 
	              	date-disabled="disabled(date, mode)" 
	              	ng-required="true" 
	              	close-text="Close" />
	              <span class="input-group-btn">
	                <button type="button" class="btn btn-default" ng-click="OpenTo($event)"><i class="glyphicon glyphicon-calendar"></i></button>
	              </span>
	            </p>
	        </div>
	        
		</div>
	</div>

<!-- MAIN AREA -->
<ng-view></ng-view>

</div>

<!-- FOOTER -->
<a href="#/newevent"><div class="PageFooter">New Event</div></a>

</body>
</html>
