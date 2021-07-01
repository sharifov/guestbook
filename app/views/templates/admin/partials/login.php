<form class="block" action="" method="post">
	<p>
		<label>Логин</label>
		<input type="text" name="username" />
	</p>
	<span class="margin"></span>
	<p>
		<label>Пароль</label>
		<input type="password" name="password" />
	</p>
	<?=$this->csrf()?>
	<p><input type="submit" value="Войти" name="admin" class="btn radius"/></p>
</form>