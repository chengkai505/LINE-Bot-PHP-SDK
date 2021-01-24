<?php
namespace LINE {
	class Config {
		// Channel Settings
		public static $secret = '';
		public static $token = '';
		
		// APP Settings
		public static $accessForbidMsg = 'Terminated';
		public static $enableLog = false;
		public static $logPath = '';
		
		// Mute duration
		public static $muteStart = '23:00:00';
		public static $muteEnd = '07:00:00';
	}
}