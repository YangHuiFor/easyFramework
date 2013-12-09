<?php

/**
 * 路由类
 * 对URL解析进行分发
 *
 * @author yanghuinobody@qq.com 
 * @cratetime 2013-11-23 
 * @version 1.0
 */
namespace Core;

use Core\Functions;

class Router
{
	
	protected static $moduleName = 'Index';

	protected static $controllerName = 'Index';

	protected static $actionName = 'index';

	protected static $currentUrl = null;

	protected static $currentUrlArgs = null;


	public static function init()
	{	
		self::splitRequestUrl();
		self::splitCurrentUrl();

	}

	public static function splitRequestUrl()
	{	
		$requestUrl = $_SERVER['REQUEST_URI'];
		if ($requestUrl != '/') {
			$requestUrlArray = explode("?", $requestUrl);
			self::$currentUrl = $requestUrlArray[0];
			if (isset($requestUrlArray[1])) {
				self::$currentUrlArgs = $requestUrlArray[1];
			}
		} 
	}

	public static function splitCurrentUrl()
	{	
		if (empty(self::$currentUrl)){
			return false;
		}

		$currentUrl = 	explode("/", ltrim(self::$currentUrl,'/'));
		if (!empty($currentUrl)) {
			self::$moduleName = isset($currentUrl[0]) ? ucfirst($currentUrl[0]) : 'Index';
			self::$controllerName = isset($currentUrl[1]) ? ucfirst($currentUrl[1]) : 'Index';
			self::$actionName = isset($currentUrl[2]) ? $currentUrl[2] : 'index';
		}
	}

	public static function run()
	{

		$moduelDir = PATH_MODULE . self::$moduleName;
		$controllerFile = self::$controllerName . CLASS_EXT;
		$controllerDir = PATH_MODULE . self::$moduleName . DIRECTORY_SEPARATOR . $controllerFile . '.php';
		
		if (!is_dir($moduelDir)) {
			throw new \Exception(  "不存在".self::$moduleName."该模块");
		}

		if (!file_exists($controllerDir)) {
			throw new \Exception(  "不存在".self::$controllerName."该控制器");
		}
		require_once $controllerDir ;
		if (!class_exists($controllerFile)) {
			throw new \Exception(  "不存在".self::$controllerName."该类");
		}

		$controller =  new $controllerFile();
		$actionName = self::$actionName . ACTION_EXT;
		if (!method_exists($controller, $actionName)) {
			throw new \Exception(  "不存在". $actionName ."该方法");
		}
		unset($_GET[MODULE]);
		unset($_GET[CONTROLLER]);
		unset($_GET[ACTION]);
		call_user_func(array($controller, $actionName));
	}


	public static function route()
	{
		self::init();
		self::run();
	}
}

