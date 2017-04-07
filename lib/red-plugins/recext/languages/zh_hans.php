<?php
return array(

	/**
	 * Menu items and titles
	 */
	'recext' => "书签",
	'recext:add' => "添加书签",
	'recext:edit' => "编辑书签",
	'recext:owner' => "%s 的书签",
	'recext:friends' => "好友的书签",
	'recext:everyone' => "全站的所有书签",
	'recext:this' => "将本页面添加书签",
	'recext:this:group' => "%s 中的书签",
	'recext:recextlet' => "获取书签小工具",
	'recext:recextlet:group' => "获取群组书签小工具",
	'recext:inbox' => "书签收件箱",
	'recext:with' => "共享给",
	'recext:new' => "新书签",
	'recext:address' => "书签地址",
	'recext:none' => '没有书签',

	'recext:notify:summary' => '新书签 %s',
	'recext:notify:subject' => '新书签: %s',
	'recext:notify:body' =>
'%s 添加了新书签: %s

地址: %s

%s

查看并评论该书签:
%s
',

	'recext:delete:confirm' => "你确定删除这个资源？",

	'recext:numbertodisplay' => '要显示的书签个数',

	'recext:shared' => "已添加书签",
	'recext:visit' => "访问资源",
	'recext:recent' => "近期的书签",

	'river:create:object:recext' => '%s 将 %s 添加为书签。',
	'river:comment:object:recext' => '%s 评论了书签 %s',
	'recext:river:annotate' => '此书签的一条评论',
	'recext:river:item' => '一个项目',

	'item:object:recext' => '书签',

	'recext:group' => '群组书签',
	'recext:enablerecext' => '启用群组书签',
	'recext:nogroup' => '本群组尚未添加任何书签',
	
	/**
	 * Widget and recextlet
	 */
	'recext:widget:description' => "显示你最近的书签",

	'recext:recextlet:description' =>
			"书签小工具是你添加到浏览器链接栏的一种特殊按钮，可以让你将在网络上发现的资源保存到你的书签里，也可以与朋友分享。想要设置书签小工具，将下面的按钮拖动到你的浏览器链接栏。",

	'recext:recextlet:descriptionie' =>
			"如果你使用IE浏览器，你需要右击书签小工具图标，选择'添加到收藏'，然后选择链接栏。",

	'recext:recextlet:description:conclusion' =>
			"然后你可以在任何时候点击该按钮将任何正在访问的网页添加到书签。",

	/**
	 * Status messages
	 */

	'recext:save:success' => "项目成功添加到书签。",
	'recext:delete:success' => "书签已删除。",

	/**
	 * Error messages
	 */

	'recext:save:failed' => "书签无法保存。请确认正确输入了标题和地址后再尝试。",
	'recext:save:invalid' => "书签的地址无效，无法保存。",
	'recext:delete:failed' => "书签无法删除。请重试。",
	'recext:unknown_recext' => '无法找到特定的书签。',
);
