<?php
namespace VSamFormBulder\Elements;

class Input extends Element {
	protected $tag = 'input';
    protected $allowedAttributes = ['accept','accesskey','align','alt','autocomplete','autofocus','checked','dirname','disabled','form','formaction','formenctype','formmethod','formnovalidate','formtarget','height','list','max','maxlength','min','multiple','name','pattern','placeholder','readonly','required','size','src','step','type','value','width'];

    protected $booleanAttributes = ['autofocus','checked','disabled','formnovalidate','multiple','readonly','required'];

    public function render() {
    	$str = '';
        $attributes = $this->renderElementAttributes();
    	$str = "<input {$attributes}/>";
    	return $str;
    }

}