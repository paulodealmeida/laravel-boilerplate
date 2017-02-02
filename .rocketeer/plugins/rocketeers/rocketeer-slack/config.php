<?php

return array(

	// Slack room credentials
	'url'      => 'https://hooks.slack.com/services/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',
	'username' => 'monitoracao',
	'room'     => '#sgi',

	// Message
	// You can use the following variables :
	// 1: User deploying
	// 2: Branch
	// 3: Connection and stage
	// 4: Host
	'before_deploy'  => '{1} está fazendo uma entrega da branch "{2}" no servidor de "{3}" ({4}) - SGI APP',
	'after_deploy'   => '{1} efetuou uma entrega com sucesso da branch "{2}" no servidor de "{3}" ({4}) - SGI APP',
	'after_rollback' => '{1} reverteu uma entrega da branch "{2}" no servidor de "{3}" para a versão anterior ({4}) - SGI APP',

	// Default emoji to use as the bot's avatar
	'emoji'   => ':rocket:',

);
