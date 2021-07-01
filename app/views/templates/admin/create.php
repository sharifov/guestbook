<form method="post" action="" class="createuser">
    <label>Логин нового пользователя:</label>
    <input type="text" name="username"><br/><br/>
    <label>Пароль нового пользователя:</label>
    <input type="password" name="password"><br/><br/>
    <label>Является ли админом:</label>
    <input type="checkbox" name="is_admin"><br/><br/>
    <?=$this->csrf()?>
    <input type="submit" class="btn radius" name="createuser" value="Отправить"/>
</form>
