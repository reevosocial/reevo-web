<?php
return array(

	/**
	 * Menu items and titles
	 */
	'recext' => "Favoritos",
	'recext:add' => "Adicionar favorito",
	'recext:edit' => "Editar favoritos",
	'recext:owner' => "Favorito de %s",
	'recext:friends' => "Favoritos dos amigos",
	'recext:everyone' => "Todos os favoritos do site",
	'recext:this' => "Adicionar aos favoritos",
	'recext:this:group' => "Favoritos em %s",
	'recext:recextlet' => "Obter Marcador de favoritos",
	'recext:recextlet:group' => "Obter Marcador de Favoritos da Comunidade",
	'recext:inbox' => "Caixa de entrada dos favoritos",
	'recext:with' => "Compartilhar com",
	'recext:new' => "Um novo item adicionado aos favoritos",
	'recext:address' => "hiperlink a ser marcado como favorito",
	'recext:none' => 'Sem favoritos',

	'recext:notify:summary' => 'Novo favoritos chamado %s',
	'recext:notify:subject' => 'Novo favorito: %s',
	'recext:notify:body' =>
'%s adicionado como um novo favorito: %s

Endereço: %s

%s

Visualizado e comentado no favorito:
%s
',

	'recext:delete:confirm' => "Você tem certeza de que deseja apagar este item?",

	'recext:numbertodisplay' => 'Número de favoritos a serem exibidos',

	'recext:shared' => "Compartilhados",
	'recext:visit' => "Visitar o link",
	'recext:recent' => "Adicionados recentemente",

	'river:create:object:recext' => '%s adicionou como favorito %s',
	'river:comment:object:recext' => '%s comentou no favorito %s',
	'recext:river:annotate' => 'adicionado um comentário neste link marcado como favorito',
	'recext:river:item' => 'um item',

	'item:object:recext' => 'Links favoritos',

	'recext:group' => 'Favoritos da comunidade',
	'recext:enablerecext' => 'Habilita favoritos na comunidade',
	'recext:nogroup' => 'Esta comunidade ainda não tem nenhum favorito',
	
	/**
	 * Widget and recextlet
	 */
	'recext:widget:description' => "Este dispositivo demonstra seus últimos itens favoritos.",

	'recext:recextlet:description' =>
			"O marcador de favoritos permite que você compartilhe qualquer link que você encontrar na Internet com seus amigos, ou apenas marcá-lo como favorito para você mesmo. Para usar este recurso, apenas arraste o seguinte botão para a barra de links do seu navegador:",

	'recext:recextlet:descriptionie' =>
			"Se você está usando o Internet Explorer, você precisará clicar com o botão direito no ícone do marcador de favoritos, selecionar 'adicionar em favoritos', e então selecionar a barra de links.",

	'recext:recextlet:description:conclusion' =>
			"Você poderá então salvar qualquer página que você visitar apenas clicando neste ícone a qualquer momento.",

	/**
	 * Status messages
	 */

	'recext:save:success' => "Este link foi adicionado aos favoritos com sucesso.",
	'recext:delete:success' => "Este hiperlink favorito foi apagado com sucesso.",

	/**
	 * Error messages
	 */

	'recext:save:failed' => "Este hiperlink favorito não pode ser salvo. Tenha certeza que você digitou titulo e endereço e então tente novamente.",
	'recext:save:invalid' => "O endereço do favorito é inválido e não pode ser salvo.",
	'recext:delete:failed' => "Este hiperlink favorito não pode ser apagado. Por favor, tente novamente.",
	'recext:unknown_recext' => 'Não foi possível encontrar favorito específico',
);
