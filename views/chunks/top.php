<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 22:05
 * @copyright © MaximAL, Sijeko 2018
 */

use app\system\helpers\Date;
use app\system\helpers\Html;
use app\models\Post;

/** @var \app\system\View $this */
/** @var string $category */
/** @var array $postsTop */
?>
<?php if (count($postsTop) > 0): ?>
	<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
		<div class="col-md-6 px-0">

			<h2 class="display-4 font-italic">
				<a href="/post/<?= $postsTop[0]['id'] ?>"><?= Html::encode($postsTop[0]['title']) ?></a>
			</h2>
			<p class="my-3">
				<?= Html::encode(Date::getRuDate($postsTop[0]['createdAt'])) ?>
				<?php if (!isset($category)): ?>
					—
					<a href="/<?= $postsTop[0]['category'] ?>">
						<strong class="d-inline-block mb-2 text-primary">
							<?= Html::encode(Post::$categories[$postsTop[0]['category']]) ?>
						</strong>
					</a>
				<?php endif ?>
			</p>
			<p class="lead my-3"><?= Html::encode(Post::leadifyText($postsTop[0]['text'])) ?></p>
			<p class="lead mb-0">
				<a href="/post/<?= $postsTop[0]['id'] ?>" class="text-white font-weight-bold">Читать полностью →</a>
			</p>
		</div>
	</div>
<?php endif ?>

<div class="row mb-2">
	<?php foreach ($postsTop as $index => $post): ?>
		<?php if ($index === 0): ?>
			<?php continue ?>
		<?php endif ?>

		<div class="col-md-6">
			<div class="card flex-md-row mb-4 box-shadow h-md-250">
				<div class="card-body d-flex flex-column align-items-start">
					<?php if (!isset($category)): ?>
						<a href="/<?= $post['category'] ?>">
							<strong class="d-inline-block mb-2 text-primary">
								<?= Html::encode(Post::$categories[$post['category']]) ?>
							</strong>
						</a>
					<?php endif ?>
					<h3 class="mb-0">
						<a href="/post/<?= $post['id'] ?>"><?= Html::encode($post['title']) ?></a>
					</h3>
					<div class="mb-1 text-muted"><?= Html::encode(Date::getRuDate($post['createdAt'])) ?></div>
					<p class="card-text mb-auto"><?= Html::encode(Post::leadifyText($post['text'])) ?></p>

					<a href="/post/<?= $post['id'] ?>">Читать полностью →</a>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
