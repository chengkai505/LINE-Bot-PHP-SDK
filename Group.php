<?php
namespace LINE\Group {
	function getProfile($groupId) {
		$sender = curl_init();
		curl_setopt($sender, CURLOPT_URL, "https://api.line.me/v2/bot/group/{$groupId}/summary");
		curl_setopt($sender, CURLOPT_POST, false);
		curl_setopt($sender, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($sender, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($sender, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($sender, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($sender, CURLOPT_HTTPHEADER, [
		    'Content-Type: application/json',
		    'Authorization: Bearer ' . \LINE\Config::$token
		]);
		$result = curl_exec($sender);
		curl_close($sender);
		return json_decode($result);
	}
	function leave($groupId) {
		$sender = curl_init();
		curl_setopt($sender, CURLOPT_URL, "https://api.line.me/v2/bot/group/{$groupId}/leave");
		curl_setopt($sender, CURLOPT_POST, true);
		curl_setopt($sender, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($sender, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($sender, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($sender, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($sender, CURLOPT_HTTPHEADER, [
		    'Content-Type: application/json',
		    'Authorization: Bearer ' . \LINE\Config::$token
		]);
		$result = curl_exec($sender);
		curl_close($sender);
	}
}