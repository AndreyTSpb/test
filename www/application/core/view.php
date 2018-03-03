<?php

class View
{
	
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	/*
	$content_file - виды отображающие контент страниц;
	$template_file - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
	*/
	function generate($content_view, $template_view, $data = null)
	{
		
		/*
		if(is_array($data)) {
			
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/
                if(!empty($_COOKIE['phone']) AND !empty($_COOKIE['password'])){
                    $chek = new Controller();
                    $data = $chek->check($_COOKIE['phone'],$_COOKIE['password']);
//                    print_r($data);
//                    if($data['enter'] == 'active') echo "test";
                }
		/*
		динамически подключаем общий шаблон (вид),
		внутри которого будет встраиваться вид
		для отображения контента конкретной страницы.
		*/
		include 'application/views/'.$template_view;
	}
}
