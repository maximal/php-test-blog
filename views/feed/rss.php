<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-16
 * @date 2018-03-16
 * @time 12:11
 * @copyright © MaximAL, Sijeko 2018
 */

use app\system\helpers\Html;
use app\system\helpers\Date;

/** @var app\system\View $this */
/** @var \app\models\Post[] $models */
/** @var string $baseUrl */
?>
<?php foreach ($models as $model): ?>
	<item>
		<title><?= Html::encode($model->title) ?></title>
		<link><?= $baseUrl ?>/post/<?= $model->id ?></link>
		<description><?= Html::encode(nl2br($model->text)) ?></description>
		<comments><?= $baseUrl ?>/post/<?= $model->id ?>#comments</comments>
		<guid isPermaLink='true'><?= $baseUrl ?>/post/<?= $model->id ?></guid>
		<pubDate><?= Html::encode(Date::format($model->createdAt, 'r')) ?></pubDate>
		<source url="<?= $baseUrl ?>/feed/rss">Тестовый блог на чистом PHP</source>
		<category><?= Html::encode(\app\models\Post::$categories[$model->category]) ?></category>
	</item>
<?php endforeach ?>
