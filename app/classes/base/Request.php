<?php

namespace app\classes\base;

class Request
{
	
	public static function getUrl() {
		return $_SERVER['REQUEST_URI'];
	}

	public static function getScriptUrl()
	{
		return $_SERVER['SCRIPT_NAME']; //REQUEST_URI
		//return $_SERVER;
	
    }
	
	
	public function getBaseUrl()
    {
        #if ($this->_baseUrl === null) {
            #$this->_baseUrl = rtrim(dirname($this->getScriptUrl()), '\\/');
        #}
        #return $this->_baseUrl;
		
		return  rtrim(dirname(getScriptUrl()), '\\/');
		
    }
	
	 public static function getPathInfo()
    {
        #if ($this->_pathInfo === null) {
            #$this->_pathInfo = $this->resolvePathInfo();
        #}
        #return $this->_pathInfo;
		
		$pathInfo = self::getUrl();
		
		
		 if (($pos = strpos($pathInfo, '?')) !== false) { # asangel(comment) "вырезаем" параметры из строки запроса
            $pathInfo = substr($pathInfo, 0, $pos);
        }
		
		if (substr($pathInfo, 0, 1) === '/') {  # asangel(comment) $pathInfo содержит в начале слэш,
                                                # который является лишним
            $pathInfo = substr($pathInfo, 1);
        }
		
		return $pathInfo;
    }
	
}