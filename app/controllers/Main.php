<?php
class Main extends Controller
{
	public $before = ['csrf'];

	public function index()
	{

        if(isset($_SESSION['admin']))  $this->redirect('admin');

        $arr = [];

        if($this->isPost() && isset($_POST['send'])){

            $_POST['fio'] = $this->clear($_POST['fio']);
            $_POST['email'] = $this->clear($_POST['email']);
            $_POST['telephone'] = $this->clear($_POST['telephone']);
            $_POST['arrival_date'] = $this->clear($_POST['arrival_date']);
            $_POST['departure_date'] = $this->clear($_POST['departure_date']);
            $_POST['comment'] = $this->clear($_POST['comment']);

			$this->model->insert([
				'name' => $_POST['fio'],
				'email' => $_POST['email'],
				'telephone' => $_POST['telephone'],
				'arrival_date' => $_POST['arrival_date'],
				'departure_date' => $_POST['departure_date'],
				'comment' => $_POST['comment']
			]);

            $this->redirect('', 'Заявка успешно забронировано!');
        }

        // Исполнение Вида - Главной странице
        $this->view->render('main', $arr);
	}
}