<?php
namespace VSamFormBulder\Elements;
//Оборачиваем элемент разными тегами
//Добовляем надписи и подписи
class Wrapper {
	public $label = false;
	public $labelClass = 'wrapper';
	public $help = false;
	public $error = false;
	protected function renderHelp($str) {
		$help = $this->getHelp();
		$error = $this->getError();

		$class = "help";
		if(!empty($error)) {
			$class = $class . ' error';
			$help = $error;
		}

		if($help !== false || $error !== false) {
			$str = $str . "<div class=\"{$class}\">{$help}</div>";
		}
		return $str;
	}

	protected function renderLabel($str,$class) {
		$label = $this->getLabel();
		$help = $this->getHelp();
		$class = trim($this->getLabelClass() . ' ' . $class);
		if(!empty($class)) {
			$class = " class=\"$class\"";
		}
		if($label !== false) {
			$str = "<label{$class}><div class=\"name\">$label</div>{$str}</label>";
		}
		return $str;
	}

	public function renderWrapper($str,$class) {
		return $this->renderLabel($this->renderHelp($str),$class);
	}

	public function getLabel() {
		return $this->label;
	}

	public function getHelp() {
		return $this->help;
	}

	public function getError() {
		return $this->error;
	}
	public function getLabelClass() {
		return $this->labelClass;
	}

}