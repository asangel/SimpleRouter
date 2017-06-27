<?php

namespace app\classes\base;

class URLRoute 
{

public $name;	
public $pattern = '<controller:[\w-]+>/<action:[\w-]+>/<id>';
public $route = 'post/<action>';
public $defaults = [];
#public $pathInfo = 'post/test';
public $_template = ''; # for create
public $_routeParam = ['action'=>'<action>', 'controller'=>'<controller>'];
public $_paramRule = []; # for create
public $_routeRule = ''; # for create


	public function __construct($config=[]) {
	    
		#debug($config);die;
		
		App::configure($this, $config);
		
	    $this->init();
	
    }

    protected function init() {
	
		if(empty($this->name)){
			$this->name = $this->pattern;
		}
	
	    if( false !== strpos($this->route, '<') && preg_match_all('#<([\w-_]+)>#', $this->route, $matches, PREG_SET_ORDER)  ){
			if(is_null($this->_routeParam))$this->_routeParam = [];
			foreach($matches as $match){
				$this->_routeParam[$match[1]] = $match[0];
			}
			
		}
		
	    $this->_template = preg_replace('#<([\w]+):?([^>]+)?>#' , '<$1>' , $this->pattern);
		
		$tr = [];
		if (preg_match_all('#<([\w]+):?([^>]+)?>#', $this->pattern, $matches, PREG_SET_ORDER)){
			
			foreach($matches as $match){
				$name = $match[1];
				$tmplt = isset($match[2])? $match[2]: '[\w-_.]+' ;
				$tr["<$name>"] = "(?P<$name>$tmplt)";
				
				if(!isset($this->_routeParam[$name])){
					$this->_paramRule[$name] = $tmplt;
				}
				
			}
			 
			#debug($tr);
			
		}
		
		$this->pattern = '#^' . strtr($this->_template, $tr) . '$#u';
		#debug($this->pattern) ; die();
		

    }
	

	public function parseRequest($pathInfo){
		
		if(!preg_match($this->pattern, $pathInfo, $matches)){
				#echo "<p> Маршрут $pathInfo не совпал с $this->pattern <\p>";
			   return false;
		}
		
		$tr = [];
		
		foreach($this->defaults as $key=>$value){
			if(empty($matches[$key])){
			    $matches[$key] = $value;				
			}
		}
		
		// оставляем только элементы со строковыми ключами:
		foreach($matches as $key=>$value){
			if(!is_string($key)){
				unset($matches[$key]);
				continue;
			}
					
			if(isset($this->_routeParam)){
				$tr[$this->_routeParam[$key]] = $value;
			}
			
		}
		
		$route = $this->route;
		if(0!==count($tr)){
			$route = strtr($this->route, $tr);
		}
		
		#echo "<p>$this->name</p>";
		return $route;
		
	}

}