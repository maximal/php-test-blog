/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 15:36
 * @copyright © MaximAL, Sijeko 2018
 */

// Ванилла-яваскрипт
document.addEventListener('DOMContentLoaded', function() {

	// Жёсткий, мужицкий стрикт
	'use strict';

	// Поехали!
	var body = document.body;
	var txtTitle = document.querySelector('[name=post-title]');
	var txtAuthor = document.querySelector('[name=post-author]');
	var txtCategory = document.querySelector('[name=post-category]');
	var txtText = document.querySelector('[name=post-text]');
	var btnPostSubmit = document.querySelector('[name=post-submit]');

	if (txtTitle) {
		on([txtTitle, txtAuthor, txtText], 'input', function (event) {
			var title = txtTitle.value.trim();
			var author = txtAuthor.value.trim();
			var text = txtText.value.trim();

			// Клиентская валидация полей
			if (title === '' || author === '' || text === '') {
				btnPostSubmit.setAttribute('disabled', 'disabled');
			} else {
				btnPostSubmit.removeAttribute('disabled');
			}

			if (title === '') {
				txtTitle.classList.add('is-invalid');
			} else {
				txtTitle.classList.remove('is-invalid');
			}

			if (author === '') {
				txtAuthor.classList.add('is-invalid');
			} else {
				txtAuthor.classList.remove('is-invalid');
			}

			if (text === '') {
				txtText.classList.add('is-invalid');
			} else {
				txtText.classList.remove('is-invalid');
			}

			// Сохраняем автора в локальное хранилище
			if (window.localStorage) {
				window.localStorage.setItem('php-test-blog-author', author);
			}
		});

		// При нажатии [Enter] переводим фокус на следующее поле
		on(txtTitle, 'keypress', function (event) {
			if (event.key === 'Enter') {
				txtAuthor.focus();
			}
		});
		on(txtAuthor, 'keypress', function (event) {
			if (event.key === 'Enter') {
				txtText.focus();
			}
		});

		// При нажатии [Ctrl]+[Enter] отправляем форму
		on(txtText, 'keypress', function (event) {
			if ((event.ctrlKey || event.metaKey) && event.key === 'Enter') {
				btnPostSubmit.click();
			}
		});
	}


	var txtCommentAuthor = document.querySelector('[name=comment-author]');
	var txtCommentText = document.querySelector('[name=comment-text]');
	var btnCommentSubmit = document.querySelector('[name=comment-submit]');
	if (txtCommentAuthor && txtCommentText) {
		on([txtCommentAuthor, txtCommentText], 'input', function (event) {
			var author = txtCommentAuthor.value.trim();
			var text = txtCommentText.value.trim();

			// Клиентская валидация полей
			if (author === '' || text === '') {
				btnCommentSubmit.setAttribute('disabled', 'disabled');
			} else {
				btnCommentSubmit.removeAttribute('disabled');
			}

			if (author === '') {
				txtCommentAuthor.classList.add('is-invalid');
			} else {
				txtCommentAuthor.classList.remove('is-invalid');
			}

			if (text === '') {
				txtCommentText.classList.add('is-invalid');
			} else {
				txtCommentText.classList.remove('is-invalid');
			}

			// Сохраняем автора в локальное хранилище
			if (window.localStorage) {
				window.localStorage.setItem('php-test-blog-author', author);
			}
		});

		// При нажатии [Enter] переводим фокус на следующее поле
		on(txtCommentAuthor, 'keypress', function (event) {
			if (event.key === 'Enter') {
				txtCommentText.focus();
			}
		});

		// При нажатии [Ctrl]+[Enter] отправляем форму
		on(txtCommentText, 'keypress', function (event) {
			if ((event.ctrlKey || event.metaKey) && event.key === 'Enter') {
				btnCommentSubmit.click();
			}
		});
	}

	// Ставим автора из локального хранилища
	if (window.localStorage) {
		var author = window.localStorage.getItem('php-test-blog-author');
		if (author) {
			txtAuthor && (txtAuthor.value = author);
			txtCommentAuthor && (txtCommentAuthor.value = author);
		}
	}

	var divValidation = document.querySelector('.j-validation');
	if (divValidation) {
		document.location.hash = 'form';
	}
});


/**
 * Навесить событие на элементы ДОМа.
 *
 * @example
 * // Один элемент
 * var button = document.body.querySelector('#one-button');
 * on(button, 'click', listener);
 *
 * // Много элементов
 * var buttons = document.body.querySelectorAll('.j-button');
 * on(buttons, 'click', listener);
 *
 *
 * @param {Document|Element|NodeList} elements Элементы ДОМа
 * @param {String|String[]} eventName Название события (click, keypress и т. п.)
 * @param {EventListener|Function} callback Выполняемая функция
 *
 * @since 2016-10-24
 * @author MaximAL
 */
function on(elements, eventName, callback) {
	if (eventName instanceof String || typeof eventName === 'string') {
		eventName = [eventName];
	}
	if (elements instanceof NodeList || elements instanceof Array) {
		for (var i in elements) {
			if (!elements.hasOwnProperty(i)) {
				continue;
			}
			for (var j in eventName) {
				if (!eventName.hasOwnProperty(j)) {
					continue;
				}
				elements[i].addEventListener(eventName[j], callback);
			}
		}
	} else if (elements !== null) {
		for (var e in eventName) {
			if (!eventName.hasOwnProperty(e)) {
				continue;
			}
			elements.addEventListener(eventName[e], callback);
		}
	} else {
		//console.info('Info: no element for `' + eventName + '`event.');
	}
}
