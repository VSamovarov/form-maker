<?php
namespace VSamFormBulder;
use VSamFormBulder\Elements;

class FormBuilder {
    protected $elemets;
    //Старт формы
    public function open($attributes='') {
        if(empty($attributes)) {
            $attributes = ['method'=>'POST'];
        }
        
        return $this->elemets[]  = new Elements\FormStart($attributes);
    }
    //Старт формы (синоним)
    public function start($attributes='') {
        return $this->open($attributes='');
    }

    //Старт формы (синоним)
    public function end($attributes='') {
        return '</form>';
    }
    //textarea
    public function textarea($attributes='') {
        return $this->elemets[]  = new Elements\Textarea($attributes);
    }
    //select
    public function select($attributes='',$options = []) {
        $select = new Elements\Select($attributes);
        $select->options($options);
        return $this->elemets[] = $select;
    }   
    //button
    public function button($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'button','type'=>'submit']);
        return $this->elemets[] = new Elements\Button($attributes);
    } 

    //Input ======
    public function input($attributes='') {
        return $this->elemets[] = new Elements\Input($attributes);
    }
    public function checkbox($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'checkbox']);
        return $this->elemets[] = new Elements\Input($attributes);
    }
    public function file($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'file']);
        return $this->elemets[] = new Elements\Input($attributes);
    }

    public function hidden($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'hidden']);
        return $this->elemets[] = new Elements\Input($attributes);
    } 
    
    public function password($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'password']);
        return $this->elemets[] = new Elements\Input($attributes);
    }  

    public function radio($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'radio']);
        return $this->elemets[] = new Elements\Input($attributes);
    }

    public function text($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'text']);
        return $this->elemets[] = new Elements\Input($attributes);
    }

    public function email($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'email','pattern'=>"^.+@.+$"]);
        return $this->elemets[] = new Elements\Input($attributes);
    }

    public function tel($attributes='') {
        $attributes = $this->mergeAttributes($attributes,['type'=>'tel','pattern'=>"[0-9./()\s-]+"]);
        return $this->elemets[] = new Elements\Input($attributes);
    }

    //=========================================

    protected function mergeAttributes($inputData, array $attributes) {
        if(is_string($inputData)) { //Это только может быть параметр "name"
            $attributes['name'] = $inputData;
        } elseif(is_array($inputData)) {
            $attributes =+ $inputData;
        }
        return $attributes;
    } 

    public function getFormData() {
        $data = [];
        foreach ($this->elemets as $n => $e) {
            $data[$n] = [   
                            'tag'=>$e->getTag(),
                            'attributes'=>$e->getElementAttributes(),
                            'content'=>$e->getElementContent()
                        ];
        }
        return $data;
    }
}
