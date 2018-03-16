<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 16:46
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\models;

use app\system\Model;

/**
 * Модель поста в блоге
 *
 * @property int $id Идентификатор
 * @property string $title Заголовок
 * @property string $author Автор
 * @property string $category Категория (одна из `Post::$categories`)
 * @property string $text Текст
 * @property string $createdAt Таймштамп
 * @property string $updatedAt Таймштамп обновления
 *
 * @package app\models
 */
class Post extends Model
{
	public $id;
	public $title;
	public $author;
	public $category = self::CATEGORY_OTHER;
	public $text;
	public $createdAt;
	public $updatedAt;

	const CATEGORY_TECHNOLOGY = 'technology';
	const CATEGORY_DESIGN = 'design';
	const CATEGORY_CULTURE = 'culture';
	const CATEGORY_BUSINESS = 'business';
	const CATEGORY_POLITICS = 'politics';
	const CATEGORY_SCIENCE = 'science';
	const CATEGORY_HEALTH = 'health';
	const CATEGORY_STYLE = 'style';
	const CATEGORY_TRAVEL = 'travel';
	const CATEGORY_OTHER = 'other';

	public static $categories = [
		self::CATEGORY_TECHNOLOGY => 'Технологии',
		self::CATEGORY_DESIGN => 'Дизайн',
		self::CATEGORY_CULTURE => 'Культура',
		self::CATEGORY_BUSINESS => 'Бизнес',
		self::CATEGORY_POLITICS => 'Политика',
		self::CATEGORY_SCIENCE => 'Наука',
		self::CATEGORY_HEALTH => 'Здоровье',
		self::CATEGORY_STYLE => 'Стиль',
		self::CATEGORY_TRAVEL => 'Путешествия',
		self::CATEGORY_OTHER => 'Другое',
	];

	public static function tableName()
	{
		return 'posts';
	}

	/**
	 * @inheritdoc
	 */
	public function validate()
	{
		if (trim($this->title) === '') {
			$this->addError('title', 'Заголовок должен быть заполнен.');
		}
		if (trim($this->author) === '') {
			$this->addError('author', 'Автор должен быть указан.');
		}
		if (trim($this->text) === '') {
			$this->addError('text', 'Нужно написать текст.');
		}
		if (!isset(self::$categories[$this->category])) {
			$this->addError('category', 'Категории `' . $this->category . '` не существует.');
		}
		return parent::validate();
	}

	/**
	 * Сделать лид из текста модели
	 * @param int $limit Ограничение по количеству символов
	 * @return string Возвращает лид
	 */
	public function getLeadText($limit = 100)
	{
		return self::leadifyText($this->text, $limit);
	}

	/**
	 * Вернуть топ постов.
	 * @param string|null $category Категория
	 * @param int $limit Ограничение на количество элементов в выборке
	 * @return string Возвращает строку с SQL-запросом для топа постов
	 */
	public static function findTopSql($category = null, $limit = 5)
	{
		$sql = sprintf(
			'SELECT p.`id`, p.`title`, p.`author`, p.`category`, p.`text`, p.`createdAt`, count(*) as `count`
			FROM `%s` p
			INNER JOIN `%s` c ON c.postId = p.id
			%s
			GROUP BY p.`id`, p.`title`, p.`author`, p.`category`, p.`text`, p.`createdAt`
			ORDER BY `count` DESC, `createdAt` DESC
			LIMIT %d',
			static::tableName(),
			Comment::tableName(),
			$category ? 'WHERE p.`category` = :category' : '',
			$limit
		);
		return $sql;
	}

	/**
	 * Сделать лид из текста.
	 * @param string $text Произвольный текст
	 * @param int $limit Ограничение по количеству символов
	 * @return string Возвращает лид
	 */
	public static function leadifyText($text, $limit = 100)
	{
		if (mb_strlen($text) <= $limit) {
			return $text;
		}

		return trim(mb_substr($text, 0, $limit)) . '…';
	}
}
