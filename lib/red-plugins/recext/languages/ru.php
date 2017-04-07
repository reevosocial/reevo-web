<?php
return array(

	/**
	 * Menu items and titles
	 */
	'recext' => "Закладки",
	'recext:add' => "Добавить в закладки",
	'recext:edit' => "Редактировать закладку",
	'recext:owner' => "Закладки пользователя %s",
	'recext:friends' => "Закладки друзей",
	'recext:everyone' => "Все закладки",
	'recext:this' => "Добавить в закладки",
	'recext:this:group' => "Добавить в закладки в %s",
	'recext:recextlet' => "Добавить закладки",
	'recext:recextlet:group' => "Добавить закладки группы",
	'recext:inbox' => "Ваши закладки",
	'recext:with' => "Поделиться",
	'recext:new' => "Новая закладка",
	'recext:address' => "Адрес сайта",
	'recext:none' => '---',

	'recext:notify:summary' => 'Новая закладка %s',
	'recext:notify:subject' => 'Новая закладка: %s',
	'recext:notify:body' =>
'%s добавил[а] новую закладку: %s

Адрес: %s

%s

Просмотреть и комментировать по ссылке:
%s
',

	'recext:delete:confirm' => "Вы действительно хотите удалить закладку?",

	'recext:numbertodisplay' => 'Число отображаемых закладок',

	'recext:shared' => "Закладки",
	'recext:visit' => "Зайти на сайт",
	'recext:recent' => "Recent recext",

	'river:create:object:recext' => 'Пользователь %s добавил закладку',
	'river:comment:object:recext' => 'Пользователь %s оставил комментарий к закладке %s',
	'recext:river:annotate' => 'Пользователь %s сделал',
	'recext:river:item' => 'закладку',

	'item:object:recext' => 'Закладки',

	'recext:group' => 'Закладки группы',
	'recext:enablerecext' => 'Включить закладки группы',
	'recext:nogroup' => 'В этой группе нет закладок',
	
	/**
	 * Widget and recextlet
	 */
	'recext:widget:description' => "Этот элемент показывает Ваши закладки.",

	'recext:recextlet:description' =>
			"Закладки позволяют добавлять адреса понравившихся сайтов, советовать друзьям или просто отмечать для себя. Чтобы использовать элемент, перетащите кнопку в адресную строку Вашего браузера:",

	'recext:recextlet:descriptionie' =>
			"Если Вы используете Internet Explorer, Вам нужно нажать правой кнопкой мыши на значок закладок, выбрать 'Добавить в избранное', а затем на адресную строку.",

	'recext:recextlet:description:conclusion' =>
			"Вы можете сохранить любую страницу в любое время.",

	/**
	 * Status messages
	 */

	'recext:save:success' => "Закладка добавлена.",
	'recext:delete:success' => "Закладка удалена.",

	/**
	 * Error messages
	 */

	'recext:save:failed' => "Простите, Ваша закладка не может быть сохранена. Проверьте название, адрес и попробуйте снова.",
	'recext:save:invalid' => "Адрес закладки не корректный - она не будет сохранена.",
	'recext:delete:failed' => "Простите, Ваша закладка не может быть удалена. Попробуйте снова.",
	'recext:unknown_recext' => 'Не могу найти указанную закладку',
);
