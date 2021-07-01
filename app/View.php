<?php
class View
{
	private $folder = 'main';
	private $page = 'index';
	private $layout;
	
    // Значение по умольчанию
    public $data = ['title'=>'My App', 'flash'=>'', 'notice'=>''];

    // Получаем допольнительные параметри с помощью конструктора
    public function __construct($layout, $accessData, $folder = false){
	
        // берем флеш Сообшения из сессии
        if(isset($_SESSION['flash'])){
            $this->data['flash'] = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        if(isset($layout)){
            $this->layout = $layout;
        }
		
		if($folder) $this->folder = $folder;

        if(!empty($accessData)){
            $this->data = array_merge($this->data, $accessData);
        }
    }

	public function setLayout($layout){
		$this->layout = $layout;
	}
	
    // Для вывода вида
	public function render($page, $data = null)
	{
		if($page) $this->page = $page;
		
        //Если есть пользовательские данные добавляем их тож в наш Массив для страницы
		if(is_array($data)) $this->data = array_merge($this->data, $data);
		
		extract($this->data);
		
        // Подключаем определенный шаблон вида
		$layout = __DIR__.'/views/layouts/'.$this->layout.'.php';
		if(file_exists($layout)) include_once $layout;
	}

    public function route($route){
        return 'http://'.$_SERVER['HTTP_HOST'].'/'.$route;
    }

	public function page($partial=false){
		
		if($partial)
			$page = __DIR__.'/views/templates/'.$this->folder.'/'.'partials/'.$partial.'.php';
		else
			$page = __DIR__.'/views/templates/'.$this->folder.'/'.$this->page.'.php';
	
		extract($this->data);
		
		if(file_exists($page)) include_once $page;
	}
	
    public function csrf(){
        return '<input type="hidden" name="csrf" value="'.$_SESSION['csrf'].'"/>';
    }
}