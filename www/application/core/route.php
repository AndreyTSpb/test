<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{

	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
                /**
                 * разделяем строку на переменные и путь
                 * разделитель ?, разделитель пременных &
                 */
                $route_arr = explode('?', $_SERVER['REQUEST_URI']);
                if(!empty($route_arr[0])){
                    $route_str = $route_arr[0]; 
                }else{
                    $route_str ='';
                }
                if(!empty($route_arr[1])){
                    $param_str = $route_arr[1]; 
                }else{
                    $param_str ='';
                }
                //print_r($route_arr[0]); exit;
                /*Делим строку пути на состовлющие: массив с ключом 1 - контроллер, а 2- действие из этого конролера*/
		$routes = explode('/', $route_str);
                //print_r($routes); exit;
                /*Получаем переменные если переданы*/
                $params = array();
                if(!empty($param_str)){
                    $par = explode('&', $param_str);
                    /*разделяем параметры на ключ = значение, разделитель =*/
                    foreach ($par as $val){
                        list($key, $item) = explode('=', $val);
                        $params[$key] = $item; 
                    }
                    //print_r($params); exit;
                }
		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		/**
		echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";
		*/

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
                        //Передаем ему параметры если есть.
			$controller->$action($params);
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
