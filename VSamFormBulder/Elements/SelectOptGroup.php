<?php
namespace VSamFormBulder\Elements;
/*
    [
        'label'=> STR,
        'disabled',
        'options' => array options
    ]
 */
class SelectOptGroup extends Element {
    protected $tag = 'SelectOptGroup';
    protected $allowedAttributes = ['disabled', 'label'];

    protected $booleanAttributes = ['disabled'];

    public function render() {
    	$str = '';
        $attributes = $this->renderElementAttributes();
        $content = $this->renderElementContent();

    	$str = "<optgroup {$attributes}>{$content}</optgroup>";
    	return $str;
    }

    public function setOptions ($data) {
        $this->setElementContent($data);
        return $this;
    }
    protected function renderElementContent() {
        $content = '';
        foreach ($this->getElementContent() as  $option) {
            $content .= $option->render();
        }
        return $content;
    }
    public function setElementContent($data) {
        $this->elementContent = $data;  
    }

    public function select($selectedOptionValue) {
        foreach ($this->getElementContent() as $value) {
            $value->select($selectedOptionValue);
        }
    }
}