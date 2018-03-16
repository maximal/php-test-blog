<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 16:05
 * @copyright © MaximAL, Sijeko 2018
 */

use app\system\helpers\Date;
use app\system\helpers\Html;
use app\models\Post;

/** @var \app\system\View $this */
/** @var string $alias */
/** @var app\models\Post[] $models */
/** @var array $postsTop */
?>

<div class="blog-index">

	<?= $this->renderPartial('chunks/top', ['postsTop' => $postsTop, 'category' => $alias]) ?>

	<h3 class="pb-3 mb-4 font-italic border-bottom" id="posts">
		<?= Html::encode(\app\models\Post::$categories[$alias]) ?>
	</h3>

	<?php foreach ($models as $model): ?>
		<article class="blog-post">
			<h2 class="blog-post-title">
				<a href="/post/<?= $model->id ?>"><?= Html::encode($model->title) ?></a>
			</h2>

			<p class="blog-post-meta">
				<?= Html::encode(Date::getRuDate($model->createdAt)) ?> —
				<strong><?= Html::encode($model->author) ?></strong>
			</p>

			<div class="post-text markdown-text">
				<?= nl2br($model->text) ?>
			</div>
		</article><!-- /.blog-post -->
	<?php endforeach ?>

</div>
