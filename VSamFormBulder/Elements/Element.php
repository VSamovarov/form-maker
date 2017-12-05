<?php
namespace VSamFormBulder\Elements;

abstract class Element {
    protected $tag = '';
	protected $elementAttributes = [];//["name1"=>"value1","name2"=>"value2",...]
	protected $elementContent = [];//str|array
	
	protected $allowedAttributes = []; //Все возможные атрибуты элемента
	protected $booleanAttributes = []; //Логические атрибуты

    protected $wrapper; //объект
    public function __construct($attributes='') {
        if(is_string($attributes)) {
            if(!empty($attributes)) $this->name($attributes);
        } else {
            $this->setElementAttributes($attributes);
        }
        $this->wrapper = new Wrapper;
    }	

    public function getTag() {
        return $this->tag;
    }

    abstract public function render();

    /*  
    	["name1"=>"value1","name2"=>"value2",...]
    	name1="value1" name2="value2" ...
    	
    	["name1"=>"value1","name2"=>"value2",...], prefix
    	prefix-name1="value1" prefix-name2="value2" ...
     */
    protected function setElementAttributes(array $attributes, $prefix='',$separator='-') {
    	if(!empty($prefix)) {
    		$prefix = "{$prefix}{$separator}";
    	}
    	foreach ($attributes as $name => $value) {
    		$this->elementAttributes[$prefix . $name] = $this->escape(strval($value));
    	}
    }

    public function addAttr(array $attributes) {
        $this->setElementAttributes($attributes);
        return $this;
    }

    public function addData(array $attributes) {
        $this->setElementAttributes($attributes,'data');
        return $this;
    }

    public function getElementAttributes() {
        return $this->elementAttributes;
    }

    protected function renderElementAttributes() {
        $str = '';
        foreach ($this->getElementAttributes() as $name => $value) {
            $str .= "{$name}=\"$value\" ";
        }
        return substr($str,0,-1);
    }

    public function removeAttribute($attribute) {
        unset($this->elementAttributes[$attribute]);
    }

    protected function setBooleanAttribute($attribute, $value=true) {
        if ($value === false || $value === 0) {
            $this->removeAttribute($attribute);
        } else {
            $this->setElementAttributes([$attribute=>$attribute]);
        }
    }

    public function getElementContent() {
        return $this->elementContent;
    }

    protected function escape($value) {
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }
    protected function renderWrapper($str) {
        //Добовляем к элементу обертку
        //Label, help, error...
        //генерим дополнительный класс $class из $this->tag и $this->elementAttributes['name'] 
        $class = '';
        if(!empty($this->elementAttributes['name'])) {
            $class = strtolower ($this->elementAttributes['name']);
            $class = preg_replace('{[^a-z0-9_-]}', '-', $class);
        }
        return $this->wrapper->renderWrapper($str,$class);
    }
    //========================
    public function __toString() {
        return $this->renderWrapper($this->render());
    }
    //========================
    public function __call($method, $params) {
        if(empty($params[0])) $params[0] = '';
    	if(in_array($method, $this->booleanAttributes)) {
    		$this->setBooleanAttribute($method,$params[0]);
            return $this;
    	} elseif(in_array($method, $this->allowedAttributes)) {
    		$this->setElementAttributes([$method=>$params[0]]);
            return $this;
    	}
        throw new \Exception("Функции {$method} не существует!");
    }

    public function accesskey ($params) {
    	//0-9 или латинская буква (a-z)
    	if(preg_match('{^[a-z0-9]$}')) {
    		$this->setElementAttributes(['accesskey'=>$params]);
    	}
    	return $this;
    }

    public function name ($params) {
    	$this->setElementAttributes(['name'=>$params]);
    	return $this;
    }

    public function id ($params) {
    	$this->setElementAttributes(['id'=>$params]);
    	return $this;
    }

    public function addClass ($params) {
    	$this->setElementAttributes(['id'=>$params]);
    	return $this;
    }

    public function labelWrapper($str,$class="") {
        $this->wrapper->label = $str;
        if(!empty($class)) $this->class = $this->class . ' ' . $class;
        return $this;
    }

    public function help($str) {
        $this->wrapper->help = $str;
        return $this;
    }

    public function error($str) {
        $this->wrapper->error = $str;
        return $this;
    }
}
