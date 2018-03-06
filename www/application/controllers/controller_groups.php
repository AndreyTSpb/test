<?php

class Controller_Groups extends Controller
{
	
	function action_index()
	{
		$this->view->generate('groups_view.php', 'template_view.php');
	}
}
