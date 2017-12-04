<?php
namespace VSamFormBulder\Elements;

class SelectOption extends Element {
    protected $tag = 'SelectOption';
    protected $allowedAttributes = ['disabled', 'label','value','selected'];

    protected $booleanAttributes = ['disabled', 'selected'];

    public function render() {
    	$str = '';
        $attributes = $this->renderElementAttributes();
        $content = $this->renderElementContent();

    	$str = "<option {$attributes}>{$content}</option>";
    	return $str;
    }
    public function text ($data) {
        $this->setElementContent($data);
        return $this;
    }
    protected function setElementContent($data) {
        $this->elementContent = $data;  
    }
    protected function renderElementContent() {
    	return $this->elementContent;
    }

    public function select($selectedOptionValue) {
        $attributes = $this->getElementAttributes();
        if(in_array($attributes['value'],$selectedOptionValue)) {
            $this->selected();
        }
        //return $this;
    }
}