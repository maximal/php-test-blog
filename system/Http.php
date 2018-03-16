<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 13:05
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\system;

/**
 * Класс для работы с HTTP-протоколом
 * @package app\system
 */
class Http
{
	/**
	 * Сообщить браузеру HTTP-состояние.
	 *
	 * @param int $code HTTP-код ответа
	 * @param string $message Сообщение для HTTP
	 * @return int Возвращает переданный HTTP-код ответа
	 */
	public static function status($code, $message)
	{
		header($_SERVER['SERVER_PROTOCOL'] . ' ' . intval($code) . ' ' . trim($message));
		if ($code !== 200) {
			echo $message;
		}
		return $code;
	}
}
