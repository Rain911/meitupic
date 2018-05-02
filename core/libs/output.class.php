<?php
//通过set函数对$data数组赋值
//通过get函数对$data数组取值

class output{
    var $data = array();
    
    function set($key,$value){
        $this -> data[$key] = $value;
    }
    
    function get($key = ''){
        if(!$key) return $this -> data;
        else  return isset($this->data[$key]) ? $this->data[$key] : '';
    }
}