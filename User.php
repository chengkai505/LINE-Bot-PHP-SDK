<?php
namespace LINE\User {
	function getProfile($uuid) {
		$sender = curl_init();
		curl_setopt($sender, CURLOPT_URL, "https://api.line.me/v2/bot/profile/{$uuid}");
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
}