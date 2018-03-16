<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 16:49
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\system;

/**
 * Базовый класс для моделей базы данных
 *
 * @property array $errors Массив с ошибками валидации.
 * @package app\system
 */
class Model
{
	protected $errors = [];

	/**
	 * Получить имя таблицы для данного класса. По умолчанию равно имени класса.
	 * @return string Возвращает имя таблицы для класса модели
	 */
	public static function tableName()
	{
		return strtolower(get_called_class());
	}

	/**
	 * Получить строку SQL-запроса для выборки моделей
	 * @param array|string|null $where Ассоциативный массив [атрибут=>значение] или SQL-строка для фильтрации атрибутов
	 * @param string|null $order Сортировка моделей
	 * @param int|null $limit Ограничить количество моделей
	 * @return string Возвращает строку SQL-запроса
	 */
	public static function findAllSql($where = null, $order = null, $limit = null)
	{
		$sql = 'SELECT * FROM `' . static::tableName() . '`';
		if ($where) {
			if (is_array($where)) {
				$filter = [];
				foreach ($where as $attribute => $value) {
					$filter [] = '`' . $attribute . '` = :' . $attribute;
				}
				if (count($filter) > 0) {
					$sql .= ' WHERE ' . implode(', ', $filter);
				}
			} else {
				$sql .= ' WHERE ' . $where;
			}
		}
		if ($order) {
			$sql .= ' ORDER BY ' . $order;
		}
		if ($limit) {
			$sql .= ' LIMIT ' . intval($limit);
		}
		return $sql;
	}

	public static function insertSql($attributes)
	{
		if (count($attributes) < 1) {
			throw new \RangeException('`attributes` must contain at leas one item.');
		}
		$sql = 'INSERT INTO `' . static::tableName() . '`';
		$fields = array_keys($attributes);
		$sql .= ' (`' . implode('`, `', $fields) . '`)';
		$values = [];
		foreach ($attributes as $attribute => $value) {
			$values [] = '`' . $attribute . '` = :' . $attribute;
		}
		$sql .= ' VALUES ' . implode(', ', $values);
		return $sql;
	}

	/**
	 * Получить массив моделей из ассоциативного массива вида [атрибут=>значение]
	 * @param array $array Ассоциативный мссив моделей вида [атрибут=>значение]
	 * @return static[] Возвращает массив моделей
	 */
	public static function getModels($array)
	{
		$res = [];
		foreach ($array as $item) {
			$model = new static();
			$model->fillAttributes($item);
			$res []= $model;
		}
		return $res;
	}

	/**
	 * Загрузить модель из запроса. Например, из `$_POST`.
	 * @param array $request
	 * @return bool
	 */
	public function load($request)
	{
		$assignments = 0;
		$className = strtolower(substr(strrchr(get_class($this), '\\'), 1));
		foreach ($request as $key => $value) {
			$attribute = str_replace($className . '-', '', $key);
			if (property_exists($this, $attribute)) {
				$this->$attribute = $value;
				$assignments++;
			}
		}
		return $assignments > 0;
	}

	/**
	 * Провалидировать модель.
	 * @return bool Возвращает `true`, если валидация успешна, и `false` в противном случае.
	 */
	public function validate()
	{
		return count($this->errors) === 0;
	}

	/**
	 * Получить ошибки валидации
	 * @return array Возвращает ошибки валидации вида [поле=>ошибка]
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Добавить ошибку валидации для поля модели
	 * @param string $field Поле
	 * @param string $error Ошибка
	 */
	public function addError($field, $error)
	{
		$this->errors[$field] = $error;
	}

	/**
	 * Заполнить атрибуты модели из массива [ключ=>значение]
	 * @param $attributes
	 */
	protected function fillAttributes($attributes)
	{
		foreach ($attributes as $attribute => $value) {
			if (property_exists($this, $attribute)) {
				$this->$attribute = $value;
			}
		}
	}
}
