<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 16:22
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\system\helpers;

/**
 * Хелпер со вспомогательными функциями для работы с HTML
 * @package app\system
 */
class Html
{
	/**
	 * Закодировать спецсимволым HTML в строке
	 * @param string $text Строка
	 * @return string Возвращает строку с закодированными спецсимволами HTML
	 */
	public static function encode($text)
	{
		return htmlspecialchars($text);
	}
}
