<table cellspacing="4" cellpadding="0" border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Емаил</th>
        <th>Телефон</th>
        <th>Дата завезда</th>
        <th>Дата выезда</th>
        <th>Редактировать</th>
        <th>Удалить</th>
    </tr>
    <?foreach($datas as $data):?>
        <tr>
            <td><?=$data->id?></td>
            <td><?=$data->name?></td>
            <td><?=$data->email?></td>
            <td><?=$data->telephone?></td>
            <td><?=$data->arrival_date?></td>
            <td><?=$data->departure_date?></td>
            <td>
                <a class="orange" href="<?=$this->route('admin/edit/'.$data->id)?>">Редактировать</a>
            </td>
            <td>
                <a class="red" href="<?=$this->route('admin/delete/'.$data->id)?>">Удалить</a>
            </td>
        </tr>
    <?endforeach?>
</table>
<?=$this->csrf()?>