<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css?v=22">
	<title><?=$title?></title>
	<script src="/js/core.js"></script>
</head>
<body lang="ru">
<div class="container">
    <?if($flash):?>
		<div class="flash"><?=$flash?></div>
	<?endif?>
    <?php $this->page() ?>
    <div class="notice"><?=$notice?></div>
</div>
</body>
</html>