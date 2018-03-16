<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-16
 * @date 2018-03-16
 * @time 12:05
 * @copyright © MaximAL, Sijeko 2018
 */

use app\system\helpers\Html;

/** @var app\system\View $this */
/** @var string $content */
?>
<?= '<?xml version="1.0" encoding="utf-8" ?>' . PHP_EOL ?>
<channel>
	<title>Тестовый блог на чистом PHP</title>
	<link>https://github.com/maximal/php-test-blog</link>
	<description>Тестовый блог на чистом PHP</description>
	<copyright>© Саша Максимал</copyright>
	<pubDate>Thu, 02 Nov 2017 12:19:31 +0300</pubDate>
	<lastBuildDate>Thu, 02 Nov 2017 12:19:31 +0300</lastBuildDate>
	<generator>MaximAL RSS Generator v.2.4</generator>
	<docs>https://cyber.harvard.edu/rss/rss.html</docs>
	<image>
		<url>http://getbootstrap.com/assets/img/bootstrap-stack.png</url>
		<title>Заметки Максимала</title>
		<link>https://php-test-blog.sijeko.ru</link>
		<width>1024</width>
		<height>860</height>
	</image>

	<?= $content ?>

</channel>
