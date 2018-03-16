<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 15:38
 * @copyright © MaximAL, Sijeko 2018
 */

use app\system\helpers\Html;

/** @var app\system\View $this */
/** @var string $title */
/** @var string $content */

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="http://getbootstrap.com/favicon.ico">

	<title>Тестовый блог на чистом PHP</title>

	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
	<link href="/css/app.css" rel="stylesheet">
</head>

<body>

<div class="container">
	<header class="blog-header py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="col-4 pt-1">
				<a class="text-muted" href="/feed/rss">Подписаться</a>
			</div>
			<div class="col-4 text-center">
				<a class="blog-header-logo text-dark" href="/">Тестовый блог на&nbsp;чистом PHP</a>
			</div>
			<div class="col-4 d-flex justify-content-end align-items-center">
				<a class="text-muted" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
					     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
					     class="mx-3">
						<circle cx="10.5" cy="10.5" r="7.5"></circle>
						<line x1="21" y1="21" x2="15.8" y2="15.8"></line>
					</svg>
				</a>
				<a class="btn btn-sm btn-outline-secondary" href="/#new-post">Новый пост</a>
			</div>
		</div>
	</header>


	<div class="nav-scroller py-1 mb-2">
		<nav class="nav d-flex justify-content-between">
			<?php foreach (\app\models\Post::$categories as $alias => $name): ?>
				<a class="p-2 text-muted" href="/<?= $alias ?>"><?= Html::encode($name) ?></a>
			<?php endforeach ?>
		</nav>
	</div>

</div>


<main role="main" class="container">


	<div class="row">
		<div class="col-md-8 blog-main">

			<?= $content ?>

		</div><!-- /.blog-main -->

		<aside class="col-md-4 blog-sidebar">
			<div class="p-3 mb-3 bg-light rounded">
				<h4 class="font-italic">Что за?</h4>
				<p class="mb-0">Это&nbsp;простой движок блога на&nbsp;чистом PHP без&nbsp;каких-либо зависимостей
					от&nbsp;внешних PHP-библиотек. Выполнен как&nbsp;тестовое задание.</p>
			</div>

			<div class="p-3">
				<h4 class="font-italic">Архив</h4>
				<ol class="list-unstyled mb-0">
					<?php for (
						$i = 0, $month = new \DateTime(); $i < 12; $i++, $month->sub(new \DateInterval('P1M'))
					): ?>
						<li>
							<a href="/<?= $month->format('Y-m') ?>">
								<?= \app\system\helpers\Date::getRuMonth($month) ?>
							</a>
						</li>
					<?php endfor ?>
				</ol>
			</div>

			<div class="p-3">
				<h4 class="font-italic">Автор</h4>
				<ol class="list-unstyled">
					<!--li><a href="https://sijeko.ru/temp/php-test-blog/">Демо-блог</a></li-->
					<li>Компания — <a href="https://sijeko.ru">sijeko.ru</a></li>
					<li>Сайт — <a href="https://maximals.ru">maximals.ru</a></li>
					<li>Телеграм — <a href="https://t.me/maximal">@maximal</a></li>
					<li>Гитхаб — <a href="https://github.com/maximal/php-test-blog">@maximal/php-test-blog</a></li>
				</ol>
			</div>
		</aside><!-- /.blog-sidebar -->

	</div><!-- /.row -->

</main><!-- /.container -->


<footer class="blog-footer">
	<p>
		Шаблон блога для <a href="http://getbootstrap.com/docs/4.0/examples/">Бутстрапа</a>
		от <a href="https://twitter.com/mdo">@mdo</a>.
	</p>
	<p>
		<a href="#">Наверх</a>
	</p>
</footer>


<!-- Скрипты в конце, чтобы страница загружалась быстрее -->
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"><\/script>')</script>
<script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
-->
<script src="/js/app.js"></script>
</body>
</html>
