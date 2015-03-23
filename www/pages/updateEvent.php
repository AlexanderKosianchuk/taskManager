<div class="MainArea">

	<form novalidate class="EventForm">
		<h4>Update Event</h4>
		<table class="EventTable">
			<tr><td><label>Event name:</label></td>
				<td><input type="text" ng-model="event.name" size="50" required minlength="4"/></td></tr>
			<tr><td><label>Period of execution:</label></td>
				<td><input type="text" ng-model="event.date" 
					required pattern="[0-9]{4}/[0-9]{2}/[0-9]{2}" minlength="10" maxlength="10"/></td></tr>
			<tr><td><label>Status:</label></td>
				<td><input type="radio" ng-model="event.status" value="0" />not done 
   				<input type="radio" ng-model="event.status" value="1" />done<br /></td></tr>
	    <table>
		    <button type="button" class="btn btn-default" ng-click="UpdateEvent(event.id)">Update event</button>&nbsp;
		    <button type="button" class="btn btn-default" ng-click="DeleteEvent(event.id)">Delete event</button>
	</form>
  
</div>