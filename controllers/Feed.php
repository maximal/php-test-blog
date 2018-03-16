<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 16:24
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\controllers;

use app\models\Post;
use app\system\Controller;

/**
 * Контроллер для фидов
 * @package app\controllers
 */
class Feed extends Controller
{
	public $layout = 'feed';

	/**
	 * RSS-фид
	 * @return string
	 */
	public function actionRss()
	{
		$posts = $this->app->db->query(Post::findAllSql(null, 'createdAt DESC', 20));
		return $this->render('feed/rss', [
			'models' => Post::getModels($posts),
			'baseUrl' => $this->app->getBaseUrl(),
		]);
	}

	public function actionAtom()
	{
		// TODO: Атом-фид
	}

	public function actionJson()
	{
		// TODO: Джейсон-фид
	}
}
