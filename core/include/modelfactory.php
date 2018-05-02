<?php

class modelfactory{
    
    function modelfactory(){
        //可以使用libs/output.class.php中的set和get方法来对setting全局数组赋值取值
        $this->output =& get_output();
        //
        $this->db =& db();
    }
}