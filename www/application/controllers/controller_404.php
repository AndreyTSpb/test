<?php

class Controller_404 extends Controller
{
	
	function action_index()
	{
		$this->view->generate('404_view.php', 'template_view.php');
	}
        function action_tyt($params = false){
            foreach ($params as $key => $val){
                echo $key .'=>'.$val."<br>";
            } 
            exit;
        }
}
