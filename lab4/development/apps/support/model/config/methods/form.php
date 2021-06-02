<?php
$methods = [
	'submitAmbassador' => [
		'params' => [
			[
				'name' => 'firstname',
				'source' => 'p',
				'pattern' => 'name',
				'required' => true
			],
			[
				'name' => 'secondname',
				'source' => 'p',
				'pattern' => 'name',
				'required' => true
			],
			[
				'name' => 'position',
				'source' => 'p',
				'pattern' => '',
				'required' => false,
				'default' => ' '
			],
			[
				'name' => 'phone',
				'source' => 'p',
				'pattern' => 'phone',
				'required' => true
			],
			[
				'name' => 'email',
				'source' => 'p',
				'pattern' => 'email',
				'required' => false,
				'default' => ' '

			],
		]
	]
];