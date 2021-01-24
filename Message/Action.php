<?php
namespace LINE\Message\Action {
	class Postback {
		public $type = 'postback';
	}
	class Message {
		public $type = 'message';
		public $text;
		function __construct($str, $label = 0) {
			$this->text = $str;
			if ($label) {
				$this->label = $label;
			}
		}
	}
	class Uri {
		public $type = 'uri';
		public $uri;
		function __construct($label, $uri = 0) {
			if ($uri) {
				$this->label = $label;
				$this->uri = $uri;
			}
			else {
				$this->uri = $label;
			}
		}
	}
}