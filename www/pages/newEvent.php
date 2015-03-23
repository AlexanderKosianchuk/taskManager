<div class="MainArea">

	<form novalidate class="EventForm">
		<h4>New Event</h4>
		<table class="EventTable">
			<tr><td><label>Event name:</label></td>
				<td><input type="text" ng-model="newEventName" ng-change="ChangeNewEventName()" size="50" required minlength="4"/></td></tr>
			<tr><td><label>Period of execution:</label></td>
				<td><input type="text" ng-model="newEventPeriod" 
					required pattern="[0-9]{4}/[0-9]{2}/[0-9]{2}" minlength="10" maxlength="10"/></td></tr>
	    <table>
		    <button type="button" class="btn btn-default" ng-click="SaveNewEvent()">Save event</button>
	</form>
  
</div>