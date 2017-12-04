<?php
namespace VSamFormBulder\Elements;

class FormStart extends Element {
	protected $tag = 'form';
    protected $allowedAttributes = ['accept-charset','action','autocomplete','enctype','method','name','novalidate','target'];

    protected $booleanAttributes = ['novalidate'];

    public function render() {
    	$str = '';
        $attributes = $this->renderElementAttributes();
    	$str = "<form {$attributes}/>";
    	return $str;
    }

    public function post() {
    	$this->setElementAttributes(['method'=>'POST']);
    	return $this;
    }

    public function get() {
    	$this->setElementAttributes(['method'=>'GET']);
    	return $this;
    }

    public function multipart() {
        $this->setElementAttributes(['enctype'=>'multipart/form-data']);
        return $this;
    }
}