<?php

 
function &db($name = 'default',$config = ''){
    global $db_config;
    static $database = array();
    
    if(!isset($database[$name])){
        
        if($name == 'default'){
            $config = $db_config;
        }
        
        require_once (LIBDIR.'db.class.php');
        $database[$name] =& new db($config);
    }
    return $database[$name];
}
//加载模板,默认加载的是models/alumb.php
function &load_model($model){
    static $models = array();
    
    if(!isset($models[$model])){
        $modelPath = MODELDIR.$model.'.php';
        if(file_exists($modelPath)) {
            require_once(INCDIR.'modelfactory.php');
            require_once($modelPath);
        }else{ 
            exit('Can not load model:'.$model);
        }

        $models[$model] =& new $model;
    }
    return $models[$model];
}

//定义引用函数get_output,可以实现对output类元素赋值
function &get_output(){
    static $output = array();
    
    if(!isset($output[0])){
        require_once (LIBDIR.'output.class.php');
        $output[0] =& new output(); 
    }
    return $output[0];
}

function run(){
    //全局化$setting数组，使其数据在本函数中可用
    global $setting;
    //通过GET数据加载控制器以及控制器的方法，
    //如果未传入数据，则使用default控制器中的index方法
    $ctl = isset($_GET['ctl'])?$_GET['ctl']:'default';
    $act = isset($_GET['act'])?$_GET['act']:'index';
    //open_photo 的值设置为false并且控制器不是photo，控制器的方法不是resiz则加载admin.php页面
    if(!$setting['open_photo'] && $ctl != 'photo' && $act != 'resize'){
        header('Location: admin.php');
        exit;
    }
    //加载相应控制器文件以及前端页面frontpage.php
    if(file_exists(CTLDIR.'front/'.$ctl.'.php')){
        require_once(INCDIR.'frontpage.php');
        require_once(CTLDIR.'front/'.$ctl.'.php');
        define('IN_CTL',$ctl);
        define('IN_ACT',$act);
        //controller类在ctls/front/album.php中定义
        $controller = new controller();
        if(is_callable(array(&$controller,$act))){
            call_user_func(array(&$controller,$act));
        }else{
            showInfo('404 not found！',false);
        }
    }else{
        showInfo('404 not found！',false);
    }
}

function run_admin(){
    $ctl = isset($_GET['ctl'])?$_GET['ctl']:'default';
    $act = isset($_GET['act'])?$_GET['act']:'index';
    
    if(file_exists(CTLDIR.'admin/'.$ctl.'.php')){
        require_once(INCDIR.'adminpage.php');
        require_once(CTLDIR.'admin/'.$ctl.'.php');
        define('IN_CTL',$ctl);
        define('IN_ACT',$act);
        $controller = new controller();
        if(is_callable(array(&$controller,$act))){
            call_user_func(array(&$controller,$act));
        }else{
            showInfo('404 not found！',false);
        }
    }else{
        showInfo('404 not found！',false);
    }
}