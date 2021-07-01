<?php
class Abort extends Controller
{
	
	public function index()
	{
        // Исполнение Вида - Ошибок
		$this->view->render('abort',['title'=>'My Site']);
	}
}