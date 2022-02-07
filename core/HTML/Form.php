<?php

namespace Core\HTML;

class Form{
    private $data;
    public $surroung = 'p';

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    protected function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    protected function getValue($index){
        if(is_object($this->data)){
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    public function input($name, $label, $options = [])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        $id = isset($options['id']) ? $options['id'] : '';

        return $this->surround(
            '<input type="'.$type.'" id="'.$id.'" name="'.$name.'" value="'.addslashes($this->getValue($name)).'" />'
        );
    }

    public function submit($name)
    {
        return $this->surround(
            '<button type="submit" class="btn btn-primary">Envoyer</button>'
        );
    }
}