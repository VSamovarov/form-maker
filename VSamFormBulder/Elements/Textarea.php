<?php
namespace VSamFormBulder\Elements;

class Textarea extends Element {
    protected $tag = 'textarea';
    protected $allowedAttributes = ['accept', 'autofocus','cols','disabled', 'form','maxlength','name','placeholder','readonly','required','rows','tabindex','wrap'];

    protected $booleanAttributes = ['autofocus', 'disabled','readonly','required'];

    public function render() {
    	$str = '';
        $attributes = $this->renderElementAttributes();
        $content = $this->renderElementContent();

    	$str = "<textarea {$attributes}>{$content}</textarea>";
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
    protected function renderElementContent() {
        $content = $this->getElementContent();
        return $content;
    }
    protected function setElementContent($data) {
        $this->elementContent = $data;  
    }
}