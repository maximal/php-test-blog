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
/** @var int $id */
/** @var \app\models\Post $model */
/** @var array $postsTop */
/** @var \app\models\Comment[] $comments */
/** @var \app\models\Comment $newComment */
?>
<article class="blog-post" data-id="<?= $id ?>">

	<h1 class="pb-3 mb-4 font-italic border-bottom">
		<?= Html::encode($model->title) ?>
	</h1>

	<p class="blog-post-meta">
		<?= Html::encode(Date::getRuDate($model->createdAt)) ?> —
		<strong><?= Html::encode($model->author) ?></strong> —
		<a href="/<?= $model->category ?>">
			<?= Html::encode(\app\models\Post::$categories[$model->category]) ?>
		</a>
	</p>

	<div class="post-text markdown-text">
		<?= nl2br($model->text) ?>
	</div>

	<div id="new-comment">
		<hr>
		<h3 id="post-form">Комментарии</h3>
		<form class="new-post" method="post" id="form">
			<div class="form-group">
				<label for="comment-author">Автор</label>
				<input type="text" class="form-control" id="comment-author" name="comment-author" maxlength="80"
				       value="<?= Html::encode($newComment->author) ?>"/>
			</div>
			<div class="form-group">
				<label for="comment-text">Текст</label>
				<textarea class="form-control" id="comment-text" name="comment-text" rows="5"><?=
					Html::encode($newComment->text) ?></textarea>
			</div>
			<?= $this->renderPartial('chunks/validation', ['model' => $newComment]) ?>
			<button type="submit" name="comment-submit" class="btn btn-primary" disabled>Оставить комментарий</button>
		</form>
		<hr>
	</div>

	<div id="comments" class="comments">
		<?php foreach ($comments as $comment): ?>
			<div class="row comment" id="comment-<?= $comment->id ?>">
				<div class="col-sm-3">
					<strong><?= Html::encode($comment->author) ?></strong>
					<br>
					<a href="/post/<?= $id ?>#comment-<?= $comment->id ?>">
						<?= Html::encode(Date::getRuDate($comment->createdAt)) ?>
					</a>
				</div>
				<div class="col-sm-9">
					<p class="card-text">
						<?= nl2br(Html::encode($comment->text)) ?>
					</p>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</article>
