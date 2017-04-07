<?php
return array(

	/**
	 * Menu items and titles
	 */
	'recext' => "ブックマーク",
	'recext:add' => "新規ブックマーク登録",
	'recext:edit' => "ブックマークを編集",
	'recext:owner' => "%s さんのブックマーク",
	'recext:friends' => "友達のブックマーク",
	'recext:everyone' => "サイト全体のブックマーク",
	'recext:this' => "このページをブックマークする",
	'recext:this:group' => "%s のブックマーク",
	'recext:recextlet' => "ブックマークレットの取得",
	'recext:recextlet:group' => "グループのブックマークレットの取得",
	'recext:inbox' => "Bookmarks inbox",
	'recext:with' => "共有するメンバーの選択",
	'recext:new' => "新しいブックマークが追加されました",
	'recext:address' => "ブックマークのアドレス",
	'recext:none' => 'ブックマークはひとつも登録されていません',

	'recext:notify:summary' => '新着ブックマーク「%s」があります。',
	'recext:notify:subject' => '新着ブックマーク: %s',
	'recext:notify:body' =>
'%s さんが新しいブックマークを追加しました: %s

アドレス: %s

%s

このブックマークに対して閲覧・コメントするには:
%s
',

	'recext:delete:confirm' => "削除してもよろしいですか?",

	'recext:numbertodisplay' => '表示するブックマークの件数',

	'recext:shared' => "ブックマーク済み",
	'recext:visit' => "ブックマーク先へ",
	'recext:recent' => "最近のブックマーク",

	'river:create:object:recext' => '%s さんは、%s をブックマークに登録しました。',
	'river:comment:object:recext' => '%s さんは、ブックマーク %s にコメントしました。',
	'recext:river:annotate' => 'このブックマークへのコメント',
	'recext:river:item' => 'アイテム',

	'item:object:recext' => 'ブックマーク',

	'recext:group' => 'グループブックマーク',
	'recext:enablerecext' => 'グループブックマークの利用',
	'recext:nogroup' => 'このグループには、まだブックマークが登録されていません。',
	
	/**
	 * Widget and recextlet
	 */
	'recext:widget:description' => "あなたが最近つけたブックマークを表示します。",

	'recext:recextlet:description' =>
			"ブックマークレットは特殊なボタンで、ブラウザのリンクバーに保存することができます。Webで見つけたリソースを自分のブックマークに保存したり、オプションとして友だちと共有したりすることもできます。この機能を使用するには、ボタンをあなたのブラウザのリンクバーまでドラッグしてください:",

	'recext:recextlet:descriptionie' =>
			"Internet Explorerをお使いの方はブックマークレットアイコンを右クリックしてから「お気に入りに保存」を選択していただき、その後、リンクバーに登録してください。",

	'recext:recextlet:description:conclusion' =>
			"ブラウザのボタンをクリックすると訪れたページをブックマークすることができあます。",

	/**
	 * Status messages
	 */

	'recext:save:success' => "ブックマークに登録しました。",
	'recext:delete:success' => "ブックマークから削除しました。",

	/**
	 * Error messages
	 */

	'recext:save:failed' => "ブックマークに登録できませんでした。タイトル欄とアドレス欄に入力したことを確かめて、もう一度試してみてください。",
	'recext:save:invalid' => "このブックマークのアドレスはどこか間違っていますので、保存することはできませんでした。",
	'recext:delete:failed' => "ブックマークから削除できませんでした。もう一度試してみてください。",
	'recext:unknown_recext' => 'お探しのブックマークを見つけることができません。',
);
