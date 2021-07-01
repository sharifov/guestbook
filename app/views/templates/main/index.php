<form class="block" action="" method="post">
  <label>Логин</label>
  <input type="text" name="username" />
  <span class="margin"></span>
  <label>Пароль</label>
  <input type="password" name="password" />
  <?=$this->csrf()?>
  <input type="submit" value="Войти" name="admin" class="btn radius"/>
</form>