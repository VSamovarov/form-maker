<?php
namespace VSamFormBulder\Elements;
class Select extends Element {
	protected $tag = 'select';
    protected $allowedAttributes = ['accesskey', 'autofocus', 'disabled','form','multiple','name','required','size','tabindex','label','selected','value'];
    protected $booleanAttributes = ['autofocus', 'disabled','multiple','required','selected'];

    public function options(array $options) {
    	$this->setElementContent($options);
    	return $this;
    }

 	protected function setElementContent(array $options) {
 		foreach ($options as $key => $value) {
 			if($this->isOption($value)) {
 				//Опции
 				$this->elementContent[] = $this->buildOptionData($value,$key);

 			} elseif($this->isOptgroup($value)) {
 				//группы опций
 				$opt = new SelectOptGroup();
				if(isset($value['disabled'])) $opt->disabled($value['disabled']);
				if(isset($value['label'])) {
 					$opt->label($value['label']);
 				} else {
 					$opt->label($key);
 				}
 				//Опции, сохраняем в объект группы опций
 				$arrayOpt = [];
 				foreach ($value['options'] as $key => $value) {
 					$arrayOpt[] = $this->buildOptionData($value,$key);
 				}
 				$opt->setElementContent($arrayOpt);
 				$this->elementContent[] = $opt;
 			}				
 		}
 	}

 	protected function buildOptionData($value,$key) {
		$opt = new SelectOption();
		if(is_array($value)) {
			if(isset($value['value'])) {
				$opt->value($value['value']);
			} else {
				$opt->value($key);
			}
			if(isset($value['text'])) $opt->text($value['text']);
			if(isset($value['label'])) $opt->label($value['label']);
			if(isset($value['selected']) || (isset($value['value']) && in_array('selected',$value,true)) ) {
				$opt->selected();
			}
			if(isset($value['disabled']) || (isset($value['value']) && in_array('disabled',$value,true)) ) {
				$opt->disabled();
			}
		} else {
			$opt->value($key);
			$opt->text($value);
		}
		return $opt;
 	}
 	protected function isOption($value) {
 		if(is_array($value)) {
	 		foreach ($value as $st) {
	 			if(is_array($st)) return false;
	 		}
 		}
 		return true;
 	}

	protected function isOptgroup($value) {
 		if(isset($value['options']) && is_array($value['options'])) {
 			return true;
 		} else {
 			return false;
 		}
 	}

	public function render() {
		$str = $content ='';
		$attributes = $this->renderElementAttributes();
		foreach ($this->getElementContent() as $key => $value) {
			$content .= $value->render();
		}
		$str = "<select {$attributes}>{$content}</select>";
    	return $str;
    }

    public function select($selectedOptionValue) {
    	if(!is_array($selectedOptionValue)) $selectedOptionValue = [$selectedOptionValue];
		foreach ($this->getElementContent() as $value) {
			$value->select($selectedOptionValue);
		}
		return $this;
    }
}