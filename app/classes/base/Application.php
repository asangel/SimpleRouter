<?php


namespace app\classes\base; 

class Application
{
	#use controllers\PostController;
	
	public $rules = [];
	public $controllerNamespace = 'controllers';
	public $controller;
	
	function __construct(){
		
		$this->init();
		
	}
	
	private function init(){
		
		$rules_conf = require DIR_ROOT . '/config/rules_config.php';
		if (is_array($rules_conf)){
			
			
			foreach($rules_conf as $key=>$value){
				if(is_string($key)){
				   $rule = new URLRoute(['pattern'=>$key, 'route'=>$value,]);					
				}elseif(is_array($value)){
				   $rule = new URLRoute($value);

				}else{
					die('Неверный формат маршрута в конфигурации!');
				}
				
				$this->rules[] = $rule;
			}
			
		}
		
	}
	
	public function run(){
		
		$pathInfo = Request::getPathInfo();
	
		foreach($this->rules as $rule){
			
			$result = $rule->parseRequest($pathInfo);
			if(false===$result){
				continue;
			}else{
				break; // до первого совпадения
			}	
		}
		
		$arr = explode('/', $result);
		
		$controller =  $this->controllerNamespace . '\\' . ucwords($arr[0]) . 'Controller';
		if(class_exists( $controller)) { 
			$this->controller = $controller;
			$cObj = new $controller();
			
		}else{
			die("Класс $controller не существует");
		}
		
		$action = 'action' . ucwords($arr[1]);
		if(method_exists($cObj, $action) ){
			
			$cObj->$action();
		}
		
		#debug($arr);
		
	}
	
}


