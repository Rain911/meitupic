<?php

class pagecore{
    //判断数据提交的方式是否为POST
    function isPost(){
        if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
            return true;
        }
        return false;
    }
    //get_magic_quotes_gpc — 获取当前 magic_quotes_gpc 的配置选项设置
    //5.4.0 始终返回 FALSE，因为这个魔术引号功能已经从 PHP 中移除了,5.4版本后可以不用
    //array_map — 为数组的每个元素应用回调函数
    //Syntax: array array_map ( callable $callback , array $array1 [, array $... ] )
    //addslashes — 使用反斜线引用字符串
    function getGet($key,$default=''){
        if(isset($_GET[$key])){
            if(!get_magic_quotes_gpc())
            {
                if(is_array($_GET[$key])){
                    return array_map('addslashes',$_GET[$key]);
                }else{
                    return addslashes($_GET[$key]);
                }
            }
            return $_GET[$key];
        }
        return $default;
    }
    //同上面getGet函数
    function getPost($key,$default=''){
        if(isset($_POST[$key])){
            if(!get_magic_quotes_gpc())
            {
                if(is_array($_POST[$key])){
                    return array_map('addslashes',$_POST[$key]);
                }else{
                    return addslashes($_POST[$key]);
                }
            }
            return $_POST[$key];
        }
        return $default;
    }
    //同上面getGet函数
    function getRequest($key,$default=''){
        if(isset($_REQUEST[$key])){
            if(!get_magic_quotes_gpc())
            {
                if(is_array($_REQUEST[$key])){
                    return array_map('addslashes',$_REQUEST[$key]);
                }else{
                    return addslashes($_REQUEST[$key]);
                }
            }
            return $_REQUEST[$key];
        }
        return $default;
    }
}