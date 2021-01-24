<?php
namespace LINE\Message\Flex {
	const SIZE_LIST = ['xxs', 'xs', 'sm', 'md', 'lg', 'xl', 'xxl', '3xl', '4xl', '5xl'];
	const MARGIN_LIST = ['none', 'xs', 'sm', 'md', 'lg', 'xl', 'xxl'];
	const PADDING_LIST = ['none', 'xs', 'sm', 'md', 'lg', 'xl', 'xxl'];
	const BORDER_WIDTH_LIST = ['none', 'light', 'normal', 'medium', 'semi-bold', 'bold'];
	const BORDER_RADIUS_LIST = ['none', 'xs', 'sm', 'md', 'lg', 'xl', 'xxl'];
	class Bubble {
		public $type = 'bubble';
		public function setSize($num) {
			$list = array('nano', 'micro', 'kilo', 'mega', 'giga');
			$this->size = $list[$num];
		}
		public function setDirection($str) {
			$this->direction = $str;
		}
	}
	class Carousel {
		public $type = 'carousel';
		public $contents = array();
		public function push(&$bubble) {
			if ($bubble->type == 'bubble')
				$this->contents[] = $bubble;
		}
	}
	class Text {
		public $type = 'text';
		public $text;
		function __construct($str, $css = 0) {
			$this->text = $str;
			$this->wrap = true;
			if ($css !== 0) {
				$css = json_decode($css, true);
				if ($css['flex'])$this->flex = $css['flex'];
				if ($css['position'])$this->position = $css['position'];
				if ($css['top'])$this->offsetTop = $css['top'];
				if ($css['left'])$this->offsetStart = $css['left'];
				if ($css['right'])$this->offsetEnd = $css['right'];
				if ($css['bottom'])$this->offsetBottom = $css['bottom'];
				if ($css['color'])$this->color = $css['color'];
				if ($css['text-align'])$this->align = $css['text-align'];
				if ($css['vertical-align'])$this->gravity = $css['vertical-align'];
				if ($css['font-weight'])$this->weight = $css['font-weight'];
				if ($css['font-decoration'])$this->decoration = $css['font-decoration'];
				if ($css['font-style'])$this->style = $css['font-style'];
				if ($css['font-size'])$this->size = SIZE_LIST[$css['font-size']];
				if ($css['wrap'])$this->wrap = $css['wrap'];
			}
		}
	}
	class Box {
		public $type = 'box';
		public $layout = 'vertical';
		public $contents = array();
		function __construct($char = 0, $css = 0) {
			switch ($char) {
			case 'h':
				$this->layout = 'horizontal';
				break;
			case 'v':
				$this->layout = 'vertical';
				break;
			}
			if ($css !== 0) {
				$css = json_decode($css, true);
				if ($css['flex'])$this->flex = $css['flex'];
				if ($css['position'])$this->position = $css['position'];
				if ($css['top'])$this->offsetTop = $css['top'];
				if ($css['left'])$this->offsetStart = $css['left'];
				if ($css['right'])$this->offsetEnd = $css['right'];
				if ($css['bottom'])$this->offsetBottom = $css['bottom'];
				if ($css['margin'])$this->margin = MARGIN_LIST[$css['margin']];
				if ($css['padding'])$this->paddingAll = PADDING_LIST[$css['padding']];
				if ($css['padding-top'])$this->paddingTop = PADDING_LIST[$css['padding-top']];
				if ($css['padding-left'])$this->paddingStart = PADDING_LIST[$css['padding-left']];
				if ($css['padding-right'])$this->paddingEnd = PADDING_LIST[$css['padding-right']];
				if ($css['padding-bottom'])$this->paddingBottom = PADDING_LIST[$css['padding-bottom']];
				if ($css['background-color'])$this->backgroundColor = $css['background-color'];
				if ($css['border-color'])$this->borderColor = $css['border-color'];
				if ($css['border-width'])$this->borderWidth = BORDER_WIDTH_LIST[$css['border-width']];
				if ($css['border-radius'])$this->cornorRadius = BORDER_RADIUS_LIST[$css['border-radius']];
			}
		}
	}
	class Button {
		public $type = 'button';
		public $action;
	}
	class hr extends Box {
		function __construct($color) {
			parent::__construct(0, '{
				"background-color": "' . $color . '",
				"margin": 5
			}');
		}
	}
}