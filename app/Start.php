<?php

class Start
{
	public function __construct()
	{

		session_start();

		$params = [];				// Допольнительные параметри
		$controller_name = 'Main';	// Имя Контроллера по умолчанию
		$action_name = 'index';		// Имя Метода по умолчанию
		$model_name = 'Model';		// Имя Модела по умолчанию
		
		$routes = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

		if ( !empty($routes[0]) )
			$controller_name = ucfirst(strtolower($routes[0]));	// берем имя Контроллера
		
		if ( !empty($routes[1]) )
			$action_name = $routes[1];		// берем имя Метода

		if(count($routes)>2)
			$params = array_slice($routes, 2);	// берем Допольнительные параметри

		// Сформируем Имя Модели
		$model_file = 'Model'.$controller_name.'.php';
		$model_path = __DIR__."/models/".$model_file;
		if(file_exists($model_path))
		{
			include "models/".$model_file;
			$model_name = substr($model_file, 0, -4);
		}
	
		// Сформируем Имя Контроллера
		$controller_file = $controller_name.'.php';
		$controller_path = __DIR__."/controllers/".$controller_file;

		if(file_exists($controller_path))
			require_once $controller_path;
		else
			$this->Error404();
	
		//Подключаем Контроллер
		
		$controller = new $controller_name($model_name);

		

		if(method_exists($controller, $action_name))
			call_user_func_array([$controller, $action_name], $params);
		else
			$this->Error404();
	}

	public function Error404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'abort');
		exit;
    }
    
}