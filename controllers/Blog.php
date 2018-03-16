<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 13:42
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\controllers;

use app\models\Comment;
use app\models\Post;
use app\system\Controller;
use app\system\Http;

/**
 * Контроллер блога.
 * @package app\controllers
 */
class Blog extends Controller
{
	public $layout = 'main';

	public function __construct($app)
	{
		parent::__construct($app);
	}

	public function actionIndex()
	{
		$model = new Post();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$model->createdAt = date('c');
			if ($model->load($_POST) && $this->app->db->insertModel($model)) {
				return $this->redirect('/#posts');
			}
		}

		$posts = $this->app->db->query(Post::findAllSql(null, 'createdAt DESC', 10));
		return $this->render('blog/index', [
			'models' => Post::getModels($posts),
			'newModel' => $model,
			'postsTop' => $this->app->db->query(Post::findTopSql()),
		]);
	}

	public function actionPost($id)
	{
		$query = $this->app->db->query(Post::findAllSql(['id' => $id]), ['id' => $id]);
		$models = Post::getModels($query);
		if (count($models) < 1) {
			return Http::status(404, 'Post Not Found');
		}
		$newComment = new Comment();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$newComment->postId = $id;
			$newComment->createdAt = date('c');
			if ($newComment->load($_POST) && $this->app->db->insertModel($newComment)) {
				return $this->redirect('/post/' . $id . '#comments');
			}
		}
		$comments = $this->app->db->query(Comment::findAllSql(['postId' => $id], 'createdAt DESC'), ['postId' => $id]);
		return $this->render('blog/post', [
			'id' => $id,
			'model' => $models[0],
			'comments' => Comment::getModels($comments),
			'newComment' => $newComment,
		]);
	}

	public function actionCategory($alias)
	{
		$filter = ['category' => $alias];
		$posts = $this->app->db->query(Post::findAllSql($filter, 'createdAt DESC', 10), $filter);
		return $this->render('blog/category', [
			'models' => Post::getModels($posts),
			'alias' => $alias,
			'postsTop' => $this->app->db->query(Post::findTopSql($alias), [':category' => $alias]),
		]);
	}

	public function actionMonth($year, $month)
	{
		$yearMonth = $year . '-' . $month;
		try {
			$date = new \DateTime($yearMonth . '-01');
		} catch (\Exception $exception) {
			return Http::status(404, $exception->getMessage());
		}
		// Проверка правильности даты
		if ($date->format('Y-m') !== $yearMonth) {
			return Http::status(404, 'Month `' . $yearMonth . '` Not Exists');
		}
		$posts = $this->app->db->query(Post::findAllSql(
			'year(createdAt) = ' . $year . ' AND month(createdAt) = ' . $month
		));
		return $this->render('blog/month', [
			'month' => $date,
			'models' => Post::getModels($posts),
		]);
	}
}
