<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css?v=22">
	<title><?=$title?></title>
	<script src="/js/core.js"></script>
	<script src="/js/custom.js"></script>
</head>
<body lang="ru">
<div class="container">
	<?if($flash):?>
		<div class="flash"><?=$flash?></div>
    <?endif?>
	<h2 class="title bar">
        <a href="<?=$this->route('admin')?>" class="login">Привет, <?=$_SESSION['admin'] ?></a>
        Admin Panel
        <a href="<?=$this->route('admin/logout')?>" class="logout">Выйти</a>
    </h2>
    <?$this->page()?>
    <div class="notice"><?=$notice?></div>
</div>
</body>
</html>