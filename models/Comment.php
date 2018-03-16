<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 21:14
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\models;

use app\system\Model;

/**
 * Модель комментария к посту блога
 *
 * @property int $id Идентификатор
 * @property int $postId Идентификатор поста
 * @property string $author Автор
 * @property string $text Текст
 * @property string $createdAt Таймштамп
 * @property string $updatedAt Таймштамп обновления
 *
 * @package app\models
 */
class Comment extends Model
{
	public $id;
	public $postId;
	public $author;
	public $text;
	public $createdAt;
	public $updatedAt;

	public static function tableName()
	{
		return 'comments';
	}

	/**
	 * @inheritdoc
	 */
	public function validate()
	{
		if (intval($this->postId) === 0) {
			$this->addError('postId', 'Нужно указать пост.');
		}
		if (trim($this->author) === '') {
			$this->addError('author', 'Автор должен быть указан.');
		}
		if (trim($this->text) === '') {
			$this->addError('text', 'Нужно написать текст.');
		}
		return parent::validate();
	}
}
