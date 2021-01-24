<?php
namespace LINE\IO_Center {
	function auth() {
		$httpRequest = file_get_contents('php://input');
		$httpSignature = $_SERVER['HTTP_X_LINE_SIGNATURE'];
		$hash = hash_hmac('sha256', $httpRequest, \LINE\Config::$secret, true);
		$hashSignature = base64_encode($hash);
		if($hashSignature != $httpSignature) {
			echo \LINE\Config::$accessForbidMsg;
			exit(0);
		}
	}
	function getData() {
		return json_decode(file_get_contents('php://input'), true);
	}
	function getEvents() {
		return getData()['events'];
	}
	function sender($type, $target, $messages, $mute = false) {
		$pkg = array();
		$sender = curl_init();
		switch($type) {
			case 'reply':
				$pkg['replyToken'] = $target;
				$url = 'https://api.line.me/v2/bot/message/reply';
				break;
			case 'push':
				$pkg['to'] = $target;
				$url = 'https://api.line.me/v2/bot/message/push';
				break;
			case 'broadcast':
				$url = 'https://api.line.me/v2/bot/message/broadcast';
				break;
			default:
				return;
		}
		foreach($messages as $item) {
			if($item == NULL) continue;
			$pkg['messages'][] = $item;
		}
		$currentTime = new \DateTime;
		$start = new \DateTime(\LINE\Config::$muteStart);
		$end = new \DateTime(\LINE\Config::$muteEnd);
		$pkg['notificationDisabled'] = ($mute || $currentTime > $start || $currentTime < $end);
		curl_setopt($sender, CURLOPT_URL, $url);
		curl_setopt($sender, CURLOPT_POST, true);
		curl_setopt($sender, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($sender, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($sender, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($sender, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($sender, CURLOPT_POSTFIELDS, json_encode($pkg));
		curl_setopt($sender, CURLOPT_HTTPHEADER, [
		    'Content-Type: application/json',
		    'Authorization: Bearer ' . \LINE\Config::$token
		]);
		$result = curl_exec($sender);
		curl_close($sender);
		$log = 'Content: ' . json_encode($pkg, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\nResult: {$result}";
		if (\LINE\Config::$enableLog)file_put_contents(\LINE\Config::$logPath . $type . '_' . $currentTime->format('Y-m-d_H.i.s') . '.log', $log);
	}
}