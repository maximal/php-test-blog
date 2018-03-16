<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 15:44
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\system;

/**
 * Класс для работы с представлениями (вьюхами)
 * @package app\system
 */
class View
{
	public $layout = 'main';
	public $title = '';

	/**
	 * Создать представление с заданным лейаутом
	 * @param $layout
	 */
	public function __construct($layout)
	{
		$this->layout = $layout;
	}

	/**
	 * Отрендерить представление (вьюху) с лейаутом
	 * @param string $view Название представления
	 * @param array $params Параметры, которые нужно передать в представление
	 * @return string Возвращает строку с отрендеренным представлением в лейауте
	 */
	public function render($view, $params = [])
	{
		$content = $this->renderPartial($view, $params);
		ob_start();
		ob_implicit_flush(false);
		$layoutParams = ['content' => $content, 'title' => $this->title, 'view' => $this];
		extract($layoutParams, EXTR_OVERWRITE);
		require __DIR__ . '/../views/layouts/' . $this->layout . '.php';
		return ob_get_clean();
	}

	/**
	 * Отрендерить только представление (вьюху), без лейаута
	 * @param string $view Название представления
	 * @param array $params Параметры, которые нужно передать в представление
	 * @return string Возвращает строку с отрендеренным представлением без в лейаута
	 */
	public function renderPartial($view, $params = [])
	{
		ob_start();
		ob_implicit_flush(false);
		extract($params, EXTR_OVERWRITE);
		require __DIR__ . '/../views/' . $view . '.php';
		return ob_get_clean();
	}
}
