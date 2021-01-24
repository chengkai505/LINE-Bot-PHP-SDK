<?php
namespace LINE\Event {
	function isUser(&$event) {
		if ($event['source']['type'] == 'user') {
			return true;
		}
		else {
			return false;
		}
	}
	function isGroup(&$event) {
		if ($event['source']['type'] == 'group') {
			return true;
		}
		else {
			return false;
		}
	}
	function isRoom(&$event) {
		if ($event['source']['type'] == 'room') {
			return true;
		}
		else {
			return false;
		}
	}
	function getSource(&$event) {
		switch ($event['source']['type']) {
		case 'user':
			return $event['source']['userId'];
		case 'group':
			return $event['source']['groupId'];
		case 'room':
			return $event['source']['roomId'];
		}
	}
}