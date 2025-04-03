<?php 
	class StringManipulator { 
		private $text = ""; 

		public function append($text) { 
			$this->text .= $text; 
			return $this; 
		} public function prepend($text) { 
			$this->text = $text . $this->text; 
			return $this; 
		} public function toUpperCase() { 
			$this->text = strtoupper($this->text); 
			return $this; 
		} public function toLowerCase() { 
			$this->text = strtolower($this->text); 
			return $this; 
		} public function getResult() { 
			return $this->text; 
		} 
	} 
	$manipulator = new StringManipulator(); 
	echo $manipulator->append("world")->prepend("Hello ")->toUpperCase()->getResult(); 
?>