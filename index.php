<?php

require './config.php';

//var = () ? verdadero : falso
$url = (isset($_GET['url'])) ? $_GET['url'] : 'Index/index';

$url = explode('/', $url);

$controller = (isset($url[0])) ? $url[0].'_controller':'Index_controller';
$method = (isset($url[1]) && $url[1] !=null) ? $url[1] : 'index';
$params = (isset($url[2]) && $url[2] !=null) ? $url[2] : null;

spl_autoload_register(function($class){
	if(file_exists(LIBS.$class.'php')){
		require LIBS.$class.'.php';
	}elseif(MODELS.$class.'.php'){
		require MODELS.$class.'.php';
	}else{
		if(file_exists(BS.$class.'php')){
			require BS.$class.'.php';
		}else{
			exit('La clase '.$class.' no ha sido definida'); 
		}	
	}
});

// echo '<b>controller</b>: '.$controller;
// echo '<br><b>method</b>: '.$method;
// echo '<br><b>params</b>: '.$params;

$path = './controllers/'.$controller.'.php';
if(file_exists($path)){
	require $path;
	$controller = new $controller();

	if(method_exists($controller, $method)){
		if($params !=null){
			$controller->{$method}($params);
		}else{
			$controller->{$method}();
		}
	}

}else{
	exit('invalid Controller');
}

?>