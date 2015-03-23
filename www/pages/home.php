<div class="MainArea">
	<div class="LeftColumn">
	<h4>Should be done {{when}}</h4>
      <ul>
      	<li ng-repeat="item in events" ng-if="item.status === 0">
      		<b><a href="#/updateevent/{{item.id}}"><p data-status="{{item}}">{{item.name}}</p></a></b>
      		<span>unto: {{item.date}}</span>
      	</li>
      </ul>
    </div>
    <div class="RightColumn">
    <h4>Done {{when == "tomorrow" ? "even earlier" : when}}</h4>
      <ul>
<!--       	<li ng-repeat="item in events | filter:status='false'"> -->
      <li ng-repeat="item in events" ng-if="item.status === 1">
      	    <b><a href="#/updateevent/{{item.id}}"><p data-status="{{item.status}}">{{item.name}}</p></a></b>
      	    <span>unto: {{item.date}}</span>
      	</li>
      </ul>
    </div>
    <div class="ClearColumn"></div>
</div>

