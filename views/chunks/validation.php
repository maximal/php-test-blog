<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-16
 * @date 2018-03-16
 * @time 11:47
 * @copyright © MaximAL, Sijeko 2018
 */

use app\system\helpers\Html;

/** @var \app\system\View $this */
/** @var \app\system\Model $model */
?>
<?php if (count($model->getErrors()) > 0): ?>
	<div class="j-validation alert alert-danger" role="alert">
		<ul class="list-unstyled">
			<?php foreach ($model->getErrors() as $error): ?>
				<li><?= Html::encode($error) ?></li>
			<?php endforeach ?>
		</ul>
	</div>
<?php endif ?>
