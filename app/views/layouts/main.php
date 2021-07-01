<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=Edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
      <title><?=$title?></title>
      <meta name="description" content="<?=$desc?>" />
	  <link rel="stylesheet" type="text/css" href="/css/style.css?v=22">
   </head>
   <body>
		<?if($flash):?>
			<div class="flash"><?=$flash?></div>
		<?endif?>
		<form action="" method="post">
			<?=$this->csrf()?>
			<div class="group"><h2>Забронировать</h2></div>
			<div class="group"><input type="text" name="fio" value="" placeholder="ФИО"/></div>
			<div class="group"><input type="email" name="email" value="" placeholder="Email"/></div>
			<div class="group"><input type="text" name="telephone" value="" placeholder="Телефон"/></div>
			<div class="group"><input type="date" name="arrival_date" value="" placeholder="Дата заезда"/></div>
			<div class="group"><input type="date" name="departure_date" value="" placeholder="Дата выезда"/></div>
			<div class="group"><textarea name="comment" rows="12" placeholder="Комментарии"/></textarea></div>
			<div class="group send"><input type="submit" name="send" value="Забронировать"/></div>
		</form>
   </body>
</html>