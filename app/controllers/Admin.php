<?php
class Admin extends Controller
{
    public $layout = 'admin';
	
	public function index()
	{
		// авторизация
		if($this->isPost() && isset($_POST['admin'])){
			$_POST['username'] = $this->clear($_POST['username']);
            $_POST['password'] = $this->clear($_POST['password']);

            $res = $this->model->findWhere([
                ['username', '=', $_POST['username'] ],
                ['password', '=', $this->hash($_POST['password']) ],
                ['is_admin', '=', 1]
            ], 'users');

            if(!$res){
                $arr['notice'] = 'Доступ не правильный!';
            }else{
                $this->login($res['username'], true);
                $this->redirect('admin');
            }
		}
		
		// вывод списка
		
        $datas = $this->model->findAll('brons');
		
		$is_login = $this->filterAdmin();
		
		if(!$is_login) $this->view->setLayout('auth');
		
		$this->view->render('index', ['is_login'=>$is_login,'datas'=>$datas]);
	}

	// Coздания

    public function create(){

        $var = [];

        if($this->isPost() && isset($_POST['createuser'])){

            $_POST['username'] = $this->clear($_POST['username']);
            $_POST['password'] = $this->clear($_POST['password']);

            if(empty($_POST['username'])){
                
                $var['notice'] = 'Логин пользователя не корректный!';
            
            }elseif(empty($_POST['password'])){

                $var['notice'] = 'Пароль пользователя не корректный!';

            }else{
               
                $_POST['is_admin'] = isset($_POST['is_admin']) ? 1 : 0;

                $this->model->insert([
                    'username' => $_POST['username'],
                    'password' => $this->hash($_POST['password']),
                    'is_admin' => $_POST['is_admin'],
                    'password_text' => $_POST['password']
                ]);

                $this->redirect('admin', 'Пользовател успешно был добавлен в базу');
            }

        }

        // Исполнение Вида
        $this->view->render('create', $var);
    }

    // Удаление через AJAX
    public function delete($id){
        // Проверка запроса на AJAX - если не AJAX то сбрасывает нас
		$this->checkAJAX();

        if($this->model->delete($this->clear($id, true), 'brons')){
            print 'Запись успешно удалена!';
        }
    }

    // Редактирование
    public function edit($id){

        $id = $this->clear($id);

        $data = $this->model->findWhere([
                ['id', '=', $id ]
            ] , 'brons');

		if(!$data) $this->redirect('admin', 'Такого записа нет!');
			
        if($this->isPost() && isset($_POST['update'])){

            $_POST['comment'] = $this->clear($_POST['comment']);
			$_POST['is_payed'] = isset($_POST['is_payed']) ? 1 : 0;

			$this->model->update($id, [
				'comment' => $_POST['comment'],
				'is_payed' => $_POST['is_payed']
			], 'brons');

			$this->redirect('admin', 'Данные успешно были изменены!');

        }

        // Исполнение Вида 
        $this->view->render('edit', $data);
    }
	
}