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

/** @var \app\system\View $this */
/** @var app\models\Post[] $models */
/** @var app\models\Post $newModel */
/** @var array $postsTop */
?>

<div class="blog-index">

	<?= $this->renderPartial('chunks/top', ['postsTop' => $postsTop]) ?>

	<h3 class="pb-3 mb-4 font-italic border-bottom" id="posts">
		Все посты
	</h3>

	<?php foreach ($models as $model): ?>
		<article class="blog-post">
			<h2 class="blog-post-title">
				<a href="/post/<?= $model->id ?>"><?= Html::encode($model->title) ?></a>
			</h2>

			<p class="blog-post-meta">
				<?= Html::encode(Date::getRuDate($model->createdAt)) ?> —
				<strong><?= Html::encode($model->author) ?></strong> —
				<a href="/<?= $model->category ?>">
					<?= Html::encode(\app\models\Post::$categories[$model->category]) ?>
				</a>
			</p>

			<div class="post-text markdown-text">
				<?= nl2br(Html::encode($model->getLeadText())) ?>
			</div>
		</article><!-- /.blog-post -->
	<?php endforeach ?>


	<hr>
	<h3 id="new-post">Новый пост</h3>
	<form class="new-post" method="post" id="form">
		<div class="form-group">
			<label for="post-title">Заголовок</label>
			<input type="text" class="form-control" id="post-title" name="post-title" maxlength="80"
			       value="<?= Html::encode($newModel->title) ?>"/>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="post-author">Автор</label>
				<input type="text" class="form-control" id="post-author" name="post-author" maxlength="80"
				       value="<?= Html::encode($newModel->author) ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="post-category">Категория</label>
				<select class="form-control" id="post-category" name="post-category">
					<?php foreach (\app\models\Post::$categories as $alias => $name): ?>
						<option value="<?= $alias ?>"<?= $newModel->category === $alias ? ' selected' : '' ?>>
							<?= Html::encode($name) ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="post-text">Текст</label>
			<textarea class="form-control" id="post-text" name="post-text" rows="5"><?=
				Html::encode($newModel->text) ?></textarea>
		</div>
		<?= $this->renderPartial('chunks/validation', ['model' => $newModel]) ?>
		<button type="submit" name="post-submit" class="btn btn-primary" disabled>Написать</button>
	</form>
	<hr>

</div>
