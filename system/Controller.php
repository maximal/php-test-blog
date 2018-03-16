<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 16:26
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\system;

/**
 * Базовый класс веб-контроллера
 *
 * @property string $layout Лейаут для вьюх
 * @property App $app Приложение
 * @property View $view Вьюха
 *
 * @package app\system
 */
class Controller
{
	public $layout = 'main';

	protected $app;
	protected $view;

	public function __construct($app)
	{
		$this->app = $app;
		$this->view = new View($this->layout);
	}

	/**
	 * Отрендерить представление
	 * @param string $view Имя представления
	 * @param array $params Параметры, передаваемые в представление
	 * @return string
	 */
	protected function render($view, $params = [])
	{
		return $this->view->render($view, $params);
	}

	/**
	 * Перенаправить браузер к другому УРЛУ
	 * @param string $url УРЛ
	 * @param int $code Код редиректа (по умолчанию: 302 — временный редирект)
	 * @return string Возвращает переданный HTTP-код ответа
	 */
	protected function redirect($url, $code = 302)
	{
		header('Location: ' . $url, true, $code);
		return Http::status($code, 'Redirect');
	}
}
