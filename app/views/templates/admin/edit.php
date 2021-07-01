<form method="post" action="" class="createuser">
    <label>Комментарии:</label>
    <input type="text" name="comment" value="<?=$comment?>"><br/><br/>
    <label>Оплачен ли Брон?</label>
    <input type="checkbox" name="is_payed" <?=$is_payed?'checked="checked"':null?> ><br/><br/>
    <?=$this->csrf()?>
    <input type="submit" class="btn radius" name="update" value="Отправить"/>
</form>
