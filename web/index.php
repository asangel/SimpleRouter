<?php

use app\classes\base\URLRoute;
use app\classes\base\Request;
use app\classes\base\Application;
use app\classes\base\App;

define('DIR_APP', dirname(__FILE__) . '/app');
define('DIR_ROOT', dirname(dirname(__FILE__)));

function debug($obj) {
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}

////////// DEBUG BEGIN //////////////////////
#$requestURI = $_SERVER['REQUEST_URI']; // http://s1.localhost/post/test?page=1
#if( false !== ($pos=strpos($requestURI, '?'))  ){
	
	#$requestURI = substr($requestURI, 0, $pos);
	#debug($requestURI);
#}

#$someURI = 'http://teleprogramma.pro/cinema-stop/207760/';
#$pattern = '#^((?:http|htths):\/\/[^\/]+)#i';
#if( preg_match_all($pattern, $someURI, $matches) ){
	#debug($matches);
	#$someURI = preg_replace($pattern, '', $someURI);
	#debug( trim($someURI, '\/')  );
#} #else{die('error');}

#die;

#$scriptFile = $_SERVER['SCRIPT_FILENAME'];
#$scriptName = basename($scriptFile);
#$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']));
#debug($_SERVER['SCRIPT_NAME']);

#die($_SERVER['PHP_SELF']);
debug($_SERVER);
////////// DEBUG END ///////////////////

function myAutoload($name){
	//die(DIR_ROOT);
	$fileName = DIR_ROOT . '/' . $name . '.php';
	$fileName = str_replace('\\', '/', $fileName);
	#echo $fileName;
	if(is_file($fileName)){
		//echo "<p>$fileName</p>";
		include_once($fileName);
	}else{
		die(" файл класса $fileName не найден");
	}
	
}

spl_autoload_register('myAutoload');

$scriptURL = Request::getScriptUrl();
$app = new Application();
#debug($app); die;
$app->run();


	
$route = new URLRoute();