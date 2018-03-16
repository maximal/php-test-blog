<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 17:38
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\system;

/**
 * Класс для подключения и работы с базой данных
 *
 * @property string $dsn DSN-строка для подключения к БД
 * @property string $user Имя пользователя для подключения к БД
 * @property string $pass Пароль для подключения к БД
 * @property string $char Кодировка символов при работе с БД (по умолчанию `utf8mb4`)
 * @property \PDO $db Подключение к БД
 * @package app\system
 */
class Connection
{
	protected $dsn;
	protected $user;
	protected $pass;
	protected $char = 'utf8mb4';
	protected $db;

	/**
	 * Создание соединения к БД по массиву с конфигурацией
	 * @param array $config Конфигурация в виде ассоциативного массива
	 *                      `['dsn' => '…', 'username' => '…', 'password' => '…', 'charset' => '…', ]`
	 */
	public function __construct($config)
	{
		$this->dsn = $config['dsn'];
		$this->user = $config['username'];
		$this->pass = $config['password'];
		$this->char = $config['charset'];

		$this->db = new \PDO(
			rtrim($this->dsn, ';') . ';charset=' . $this->char,
			$this->user,
			$this->pass
		);
	}

	/**
	 * Выполняет запрос на получение данных
	 * @param string $sql SQL-запрос
	 * @param array $params Именованные параметры
	 * @param int $fetchStyle Стиль получения (см. `\PDO::FETCH_*`)
	 * @return array Возвращает массив данных
	 */
	public function query($sql, $params = [], $fetchStyle = \PDO::FETCH_ASSOC)
	{
		$sth = $this->db->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll($fetchStyle);
	}

	/**
	 * Выполняет запрос на изменение данных
	 * @param string $sql SQL-запрос
	 * @param array $params Именованные параметры
	 * @return bool Возвращает `true`, если выполнение удачно, и `false` в противном случае.
	 */
	public function execute($sql, $params = [])
	{
		$sth = $this->db->prepare($sql);
		return $sth->execute($params);
	}

	/**
	 * Вставляет новую модель в БД
	 * @param Model $model
	 * @return bool Возвращает `true`, если вставка успешна, и `false` в противном случае.
	 */
	public function insertModel($model)
	{
		if (!$model->validate()) {
			return false;
		}
		$sql = 'INSERT INTO `' . $model::tableName() . '`';
		$attributes = [];
		$params = [];
		foreach ($model as $attribute => $value) {
			$attributes []= $attribute;
			$params[':' . $attribute] = $value;
		}
		$sql .= ' (`' . implode('`, `', $attributes) . '`)';
		$sql .= ' VALUES (' . implode(', ', array_keys($params)) . ')';
		return $this->execute($sql, $params);
	}
}
