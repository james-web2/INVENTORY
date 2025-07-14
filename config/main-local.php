<?php
return [
	'components' => [


		'db' => [
            'class' => 'yii\db\Connection',
            'dsn' =>'sqlsrv:server=DESKTOP-2VPR9IB;database=INVENTORY',
            
            'username' => 'james',
            'password' => 'kagio@254',
            'charset' => 'utf8',
        ],
       


		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@common/mail',
			'useFileTransport' => false,
			'transport' => [
				 'class' => 'Swift_SmtpTransport',
				 'host' => 'outlook.office.com',
				 'username' => '',
				 'password' => '',
				 'port' => '587',
				 'encryption' => 'tls',
				 'streamOptions' => [ 'ssl' =>
			 [
				 'allow_self_signed' => false,
				 'verify_peer' => true,
				 'verify_peer_name' => true,
			 ],
				 ],
			],
	  	],


],

];