<?php

class DBManager
{
	private static $dbFile = "db.json";
	
	private function _GetDBObject()
	{
		$file = file_get_contents(__DIR__ . "//" . $this::$dbFile);
		$array = json_decode($file, true);
		return $array;
	}
	
	private function _SetDBObject($events)
	{
		file_put_contents(__DIR__ . "//" . $this::$dbFile, json_encode($events));
		return true;
	}
	
	public function GetAllEvents()
	{
		$events = $this->_GetDBObject();
		return $events;
	}
	
	public function GetEventsByPeriod($from, $to = null)
	{
		$events = $this->_GetDBObject();
		$eventsInPeriod = array();
		
		if($to == null)
		{
			foreach ($events as $ev)
			{
				if($ev['date'] == $from)
				{
					$eventsInPeriod[] = $ev;
				}
			}
		}
		else
		{
			foreach ($events as $ev)
			{
				if(($ev['date'] >= $from) && ($ev['date'] <= $to))
				{
					$eventsInPeriod[] = $ev;
				}
			}
		}
		
		return $eventsInPeriod;
	}
	
	public function CreateNewEvent($name, $timestamp)
	{
		$events = $this->_GetDBObject();
		$count = count($events);
		$newId = 0;
		if($count > 0)
		{
			$newId = $events[$count - 1]['id'];
			$newId++;
		}
		
		$events[] = array(
			'id' => $newId,
			'name' => $name,
			'date' => $timestamp,
			'status' => 0
		);
		
		$this->_SetDBObject($events);
		return true;	
	}
	
	public function GetEventById($eventId)
	{
		$events = $this->_GetDBObject();
		$searchedEvent = array();
		
		foreach($events as $event)
		{
			if($event['id'] == $eventId)
			{
				$searchedEvent = $event;
				break;
			}
		}

		return $searchedEvent;
	}
	
	public function UpdateEventById($eventId, $name, $period, $status)
	{
		$events = $this->_GetDBObject();
		$updatedEvents = array();

		foreach($events as $event)
		{
			if($event['id'] == $eventId)
			{
				$updatedEvents[] = array(
					'id' => intval($eventId),
					'name' => $name,
					'date' => strtotime($period),
					'status' => intval($status)
				);
			}
			else
			{
				$updatedEvents[] = $event;
			}
		}
		
		$this->_SetDBObject($updatedEvents);
		return true;	
	}
	
	public function DeleteEventById($eventId)
	{
		$events = $this->_GetDBObject();
		$updatedEvents = array();
		
		foreach($events as $event)
		{
			if($event['id'] != $eventId)
			{
				$updatedEvents[] = $event;
			}
		}
		
		$this->_SetDBObject($updatedEvents);
		return true;
	}	
}

?>