<?php
namespace VSamFormBulder\Elements;

class Button extends Element {
	protected $tag = 'button';
	protected $allowedAttributes = ['accesskey','autofocus','disabled','form','formaction','formenctype','formmethod','formnovalidate','formtarget','name','type','value'];
	
	protected $booleanAttributes = ['autofocus','disabled','formnovalidate'];


	public function render() {
    	$str = '';
        $attributes = $this->renderElementAttributes();
        $content = $this->renderElementContent();

    	$str = "<button {$attributes}>{$content}</button>";
    	return $str;
    }
    public function value ($data) {
        $this->setElementContent($data);
        return $this;
    }
    public function text ($data) {
        $this->setElementContent($data);
        return $this;
    }

    public function reset ($data=true) {
    	if($data !== false && $data !== 0) {
    		$this->setElementAttributes(['type'=>'reset']);
    	} else {
    		$this->setElementAttributes(['type'=>'button']);
    	}
        return $this;
    }
    public function submit ($data=true) {
    	if($data !== false && $data !== 0) {
    		$this->setElementAttributes(['type'=>'submit']);
    	} else {
    		$this->setElementAttributes(['type'=>'button']);
    	}
        return $this;
    }
    protected function renderElementContent() {
        $content = $this->getElementContent();
        return $content;
    }
    protected function setElementContent($data) {
        $this->elementContent = $data;  
    }


}