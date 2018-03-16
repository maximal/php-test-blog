<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 13:01
 * @copyright © MaximAL, Sijeko 2018
 */

return [
	'db' => require __DIR__ . '/db.php',
	'url' => [
		'rules' => [
			// Главная
			'' => 'blog/index',

			// Пост
			'post/(\d+)' => 'blog/post',

			// Категория
			'(\w+)' => 'blog/category',

			// Статьи за месяц
			'(\d\d\d\d)-(\d\d)' => 'blog/month',

			// RSS
			'feed/rss' => 'feed/rss',
		],
	]
];
