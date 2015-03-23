<?php 

require_once(__DIR__ . '/model/DBManager.php');

define(GET_ALL_EVENTS, "GET_ALL_EVENTS");
define(GET_EVENTS_IN_PERIOD, "GET_EVENTS_IN_PERIOD");
define(GET_EVENT_BY_ID, "GET_EVENT_BY_ID");
define(CREATE_EVENT, "CREATE_EVENT");
define(UPDATE_EVENT, "UPDATE_EVENT");
define(DELETE_EVENT, "DELETE_EVENT");

//error_log("GET " . json_encode($_GET));
// error_log("POST " . json_encode($_POST));

if(isset($_GET['action']) && ($_GET['action'] != null) && ($_GET['action'] != ''))
{
	$action = $_GET['action'];
	
	if($action == GET_ALL_EVENTS)
	{
		$db = new DBManager();
		$events = $db->GetAllEvents();
		unset($db);
		echo(json_encode($events));
	}
	else if($action == GET_EVENTS_IN_PERIOD)
	{
		if(isset($_GET['from']) && ($_GET['from'] != null) && ($_GET['from'] != '') &&
				isset($_GET['to']) && ($_GET['to'] != null) && ($_GET['to'] != '')  &&
				(strtotime($_GET['from']) > 0) && (strtotime($_GET['to']) > 0)) // check is date
		{
			
			$from = strtotime($_GET['from']);
			$to = strtotime($_GET['to']);
			
			$events = array();
			$db = new DBManager();
			if($from == $to)
			{
				$events = $db->GetEventsByPeriod($from);
			}
			else 
			{
				$events = $db->GetEventsByPeriod($from, $to);
			}
			
			$patchedEvents = array();
			foreach ($events as $event)
			{
				$patchedEvents[] = array(
						'id' => $event['id'],
						'name' => $event['name'],
						'date' => date('Y/m/d', $event['date']),
						'status' => $event['status']
				);
			}
					
			unset($db);
			echo(json_encode($patchedEvents));
		}
		else
		{
			$msg = "Incorrect data input for action " . GET_EVENTS_IN_PERIOD . ". ".
					"Data - " . json_encode($_GET) . ". " .
					"Page - taskManager.php";
			error_log($msg);
		
			echo array(
					'status' => "er",
					'errorCode' => 1,
					'msg' => $msg
			);
		}
	}
	else if($action == GET_EVENT_BY_ID)
	{
		if(isset($_GET['eventId']) && ($_GET['eventId'] != null) && ($_GET['eventId'] != ''))
		{	
			$eventId = $_GET['eventId'];
			$db = new DBManager();
			$searchedEvent = $db->GetEventById($eventId);
			unset($db);
			
			if(!empty($searchedEvent))
			{
				$searchedEvent['date'] = date ('Y/m/d', $searchedEvent['date']);
			}
							
			echo(json_encode($searchedEvent));
		}
		else
		{
			$msg = "Incorrect data input for action " . GET_EVENT_BY_ID . ". ".
					"Data - " . json_encode($_GET) . ". " .
					"Page - taskManager.php";
			error_log($msg);
	
			echo array(
					'status' => "er",
					'errorCode' => 1,
					'msg' => $msg
			);
		}
	}
	else if($action == CREATE_EVENT)
	{
		if(isset($_GET['name']) && ($_GET['name'] != null) && ($_GET['name'] != '') &&
				isset($_GET['period']) && ($_GET['period'] != null) && ($_GET['period'] != ''))
		{
			$name = $_GET['name'];
			$period = $_GET['period'];
			
			$timestamp = strtotime($period);
			if($timestamp > 0)
			{
				$db = new DBManager();
				$db->CreateNewEvent($name, $timestamp);
				unset($db);
				echo("ok");
			}
			else
			{
				$msg = "Incorrect period input for action " . CREATE_EVENT . ". ".
						"Data - " . json_encode($_GET) . ". " .
						"Page - taskManager.php";
				error_log($msg);
				
				echo array(
						'status' => "er",
						'errorCode' => 1,
						'msg' => $msg
				);
			}
		}
		else
		{
			$msg = "Incorrect data input for action " . CREATE_EVENT . ". ".
					"Data - " . json_encode($_GET) . ". " .
					"Page - taskManager.php";
			error_log($msg);
				
			echo array(
					'status' => "er",
					'errorCode' => 1,
					'msg' => $msg
			);
		}
	}
	else if($action == UPDATE_EVENT)
	{
		if(isset($_GET['eventId']) && ($_GET['eventId'] != null) && ($_GET['eventId'] != '') &&
				isset($_GET['name']) && ($_GET['name'] != null) && ($_GET['name'] != '') &&
				isset($_GET['period']) && ($_GET['period'] != null) && ($_GET['period'] != '') &&
				isset($_GET['status']) && ($_GET['status'] != null) && ($_GET['status'] != ''))
		{
			$eventId = $_GET['eventId'];
			$name = $_GET['name'];
			$period = $_GET['period'];
			$status = $_GET['status'];
			
			$db = new DBManager();
			$db->UpdateEventById($eventId, $name, $period, $status);
			unset($db);;
			echo("ok");
		}
		else
		{
			$msg = "Incorrect data input for action " . UPDATE_EVENT . ". ".
					"Data - " . json_encode($_GET) . ". " .
					"Page - taskManager.php";
			error_log($msg);
				
			echo array(
					'status' => "er",
					'errorCode' => 2,
					'msg' => $msg
			);
		}
	}
	else if($action == DELETE_EVENT)
	{
		if(isset($_GET['eventId']) && ($_GET['eventId'] != null) && ($_GET['eventId'] != ''))
		{
			$eventId = $_GET['eventId'];
			
			$db = new DBManager();
			$db->DeleteEventById($eventId);
			unset($db);
			echo("ok");
		}
		else
		{
			$msg = "Incorrect data input for action " . DELETE_EVENT . ". ".
					"Data - " . json_encode($_GET) . ". " .
					"Page - taskManager.php";
			error_log($msg);
	
			echo array(
					'status' => "er",
					'errorCode' => 3,
					'msg' => $msg
			);
		}
	}
	else 
	{
		$msg = "Incorrect action. ".
				"Data - " . json_encode($_GET) . ". " .
				"Page - taskManager.php";
		error_log($msg);
			
		echo array(
				'status' => "er",
				'errorCode' => 0,
				'msg' => $msg
		);
	}
}

// if(isset($_POST['action']) && ($_POST['action'] != null) && ($_POST['action'] != ''))
// {
// 	$action = $_POST['action'];

// 	if($action == GET_ALL_EVENTS)
// 	{
// 		$db = new DBManager();
// 		$events = $db->GetAllEvents();
// 		unset($db);
// 		error_log(json_encode($events));
// 		echo(json_encode($events));
// 	}
// 	else if($action == CREATE_EVENT)
// 	{
// 		if(isset($_POST['name']) && ($_POST['name'] != null) && ($_POST['name'] != '') &&
// 				isset($_POST['period']) && ($_POST['period'] != null) && ($_POST['period'] != ''))
// 		{
// 			$name = $_POST['name'];
// 			$period = $_POST['period'];
// 			$db = new DBManager();
// 			unset($db);
// 			echo("");
// 		}
// 		else
// 		{
// 			$msg = "Incorrect data input for action " . CREATE_EVENT . ". ".
// 					"Data - " . json_encode($_POST) . ". " .
// 					"Page - taskManager.php";
// 			error_log($msg);

// 			echo array(
// 					'status' => "er",
// 					'errorCode' => 1,
// 					'msg' => $msg
// 			);
// 		}
// 	}
// 	else if($action == UPDATE_EVENT)
// 	{
// 		if(isset($_POST['id']) && ($_POST['id'] != null) && ($_POST['id'] != '') &&
// 				isset($_POST['name']) && ($_POST['name'] != null) && ($_POST['name'] != '') &&
// 				isset($_POST['period']) && ($_POST['period'] != null) && ($_POST['period'] != '') &&
// 				isset($_POST['status']) && ($_POST['status'] != null) && ($_POST['status'] != ''))
// 		{
// 			$name = $_POST['name'];
// 			$period = $_POST['period'];
// 			$db = new DBManager();
// 			unset($db);;
// 			echo("");
// 		}
// 		else
// 		{
// 			$msg = "Incorrect data input for action " . UPDATE_EVENT . ". ".
// 					"Data - " . json_encode($_POST) . ". " .
// 					"Page - taskManager.php";
// 			error_log($msg);

// 			echo array(
// 					'status' => "er",
// 					'errorCode' => 2,
// 					'msg' => $msg
// 			);
// 		}
// 	}
// 	else if($action == DELETE_EVENT)
// 	{
// 		if(isset($_POST['id']) && ($_POST['id'] != null) && ($_POST['id'] != ''))
// 		{
// 			$name = $_POST['name'];
// 			$period = $_POST['period'];
				
// 			$db = new DBManager();
// 			unset($db);
// 			echo("");
// 		}
// 		else
// 		{
// 			$msg = "Incorrect data input for action " . DELETE_EVENT . ". ".
// 					"Data - " . json_encode($_POST) . ". " .
// 					"Page - taskManager.php";
// 			error_log($msg);

// 			echo array(
// 					'status' => "er",
// 					'errorCode' => 3,
// 					'msg' => $msg
// 			);
// 		}
// 	}
// 	else
// 	{
// 		$msg = "Incorrect action. ".
// 				"Data - " . json_encode($_POST) . ". " .
// 				"Page - taskManager.php";
// 		error_log($msg);
			
// 		echo array(
// 				'status' => "er",
// 				'errorCode' => 0,
// 				'msg' => $msg
// 		);
// 	}
// }

?>