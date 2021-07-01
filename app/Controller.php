<?php
class Controller {
	
	protected $accessData = [];
	public $model;
	public $view;
	public $before = [];
    public $layout = 'main';
    protected $name;
	
	public function __construct($model_name)
	{
		$_SESSION['csrf'] = isset($_SESSION['csrf']) ? $_SESSION['csrf'] : md5(uniqid(mt_rand().microtime())); // Уcтановливаем Token для Csrf

		$this->name = strtolower(get_class($this));
		
		// Провераем доступ на вход
		if(!empty($this->before)){
			foreach($this->before as $access){
				if(!$this->{'filter'.ucfirst($access)}())  Start::Error404();
				$this->accessData[$access] = $_SESSION[$access];
			}
		}
	
		// Определяем определенный Модел и Вид 
		$this->model = new $model_name;
		$this->view = new View($this->layout, $this->accessData, $this->name);
	}

	// Очистка данных из запросов
	public function clear($data, $int = false){
		$data = trim($data);

		if($int)
			return abs((int)$data);
		else
			return htmlspecialchars(trim(strip_tags($data)));
	}
	
	public function hash($str){
		return md5(strrev(bin2hex($str)));
	}

	public function redirect($url = null, $flash = null){
		if(isset($flash))	$_SESSION['flash'] = $flash;

		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('Location:'.$host.$url);
		exit(0);
	}

	public function login($username, $is_admin = false){
		if($is_admin)
			$_SESSION['admin'] = $username;
		else
			$_SESSION['user'] = $username;
	}

	public function logout(){
		if(isset($_SESSION['admin']))
			unset($_SESSION['admin']);
		elseif(isset($_SESSION['user']))
			unset($_SESSION['user']);

		$this->redirect($this->name);			
	}

	public function checkAJAX(){
		if( 
			!(
		    	isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
				strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
		    )
		  )
		{
			Start::Error404();
		}
	}

	public function isPost(){
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	public function filterAdmin(){
		return isset($_SESSION['admin']);
	}

	public function filterCsrf(){
		return !($this->isPost() && $_POST['csrf'] !== $_SESSION['csrf']);
	}

}