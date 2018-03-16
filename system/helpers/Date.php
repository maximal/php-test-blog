<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 18:53
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\system\helpers;

/**
 * Хелпер для работы с датами.
 * @package app\system\helpers
 */
class Date
{
	protected static $months = [
		'Jan' => 'январь',
		'Feb' => 'февраль',
		'Mar' => 'март',
		'Apr' => 'апрель',
		'May' => 'май',
		'Jun' => 'июнь',
		'Jul' => 'июль',
		'Aug' => 'август',
		'Sep' => 'сентябрь',
		'Oct' => 'октябрь',
		'Nov' => 'ноябрь',
		'Dec' => 'декабрь',
	];

	protected static $monthsRod = [
		'Jan' => 'января',
		'Feb' => 'февраля',
		'Mar' => 'марта',
		'Apr' => 'апреля',
		'May' => 'мая',
		'Jun' => 'июня',
		'Jul' => 'июля',
		'Aug' => 'августа',
		'Sep' => 'сентября',
		'Oct' => 'октября',
		'Nov' => 'ноября',
		'Dec' => 'декабря',
	];

	/**
	 * Форматирует дату и время в человекочитаемом формате
	 * @param string $string Дата и время в любом из форматов, поддерживаемых PHP.
	 * @return string Возвращает отформатированную строку с датой и временем
	 */
	public static function getRuDate($string)
	{
		$date = new \DateTime($string);
		return str_replace(
			array_keys(self::$monthsRod),
			array_values(self::$monthsRod),
			$date->format('j M y, G:i')
		);
	}

	/**
	 * Форматирует месяц в человекочитаемом формате
	 * @param \DateTime $date
	 * @return string Возвращает отформатированную строку с месяцем и годом
	 */
	public static function getRuMonth($date)
	{
		return str_replace(
			array_keys(self::$months),
			array_values(self::$months),
			$date->format('M Y')
		);
	}

	/**
	 * Форматирует дату и время в формате PHP
	 * @param string $string Дата и время в любом из форматов, поддерживаемых PHP.
	 * @param string $format Любой из форматов даты и времени, поддерживаемых PHP.
	 * @return string Возвращает отформатированную строку с датой и временем
	 */
	public static function format($string, $format)
	{
		return (new \DateTime($string))->format($format);
	}
}