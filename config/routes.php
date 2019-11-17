<?php

return [
	'api/News' => [
		'controller' => App\Controllers\NewsController::class,
		'action' => 'index',
	],
	'api/News/{id:\d+}' => [
		'controller' => App\Controllers\NewsController::class,
		'action' => 'view',
	],
	'api/Participant' => [
		'controller' => App\Controllers\ParticipantController::class,
		'action' => 'index',
	],
	'api/Participant/{id:\d+}' => [
		'controller' => App\Controllers\ParticipantController::class,
		'action' => 'view',
	],
		'api/Session' => [
		'controller' => App\Controllers\SessionController::class,
		'action' => 'index',
	],
	'api/Session/{id:\d+}' => [
		'controller' => App\Controllers\SessionController::class,
		'action' => 'view',
	],
	'api/SessionSubscribe' => [
		'controller' => App\Controllers\SubscribeController::class,
		'action' => 'store',
	],
];