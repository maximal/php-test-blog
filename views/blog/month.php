<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-16
 * @date 2018-03-16
 * @time 10:49
 * @copyright © MaximAL, Sijeko 2018
 */

use app\system\helpers\Date;
use app\system\helpers\Html;

/** @var \app\system\View $this */
/** @var \DateTime $month */
/** @var \app\models\Post[] $models */
?>
<h1 id="posts">
	Все посты за <?= Html::encode(Date::getRuMonth($month)) ?>
</h1>
<ol class="list-unstyled">
	<?php foreach ($models as $model): ?>
	<li>
		<a href="/post/<?= $model->id ?>">
			<?= Html::encode($model->title) ?>
		</a>
		—
		<?= Html::encode($model->author) ?>
	</li>
	<?php endforeach ?>
</ol>
