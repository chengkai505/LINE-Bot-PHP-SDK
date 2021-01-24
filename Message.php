<?php
namespace LINE\Message {
	class Text {
		public $type = 'text';
		public $text = '';
		function __construct($content) {
			$this->text = $content;
		}
	}
	class Image {
		public $type = 'image';
		public $originalContentUrl;
		public $previewImageUrl;
		function __construct($original, $preview = 0) {
			$this->originalContentUrl = $original;
			$this->previewImageUrl = $preview == 0 ? $original : $preview;
		}
	}
	class Flex {
		public $type = 'flex';
		public $altText;
		public $contents;
		function __construct($str = 'undefined') {
			$this->altText = $str;
			$this->contents = new \stdClass;
		}
	}
	require_once 'Message/Action.php';
	require_once 'Message/Flex.php';
}