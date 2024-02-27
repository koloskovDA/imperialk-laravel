<?php


$connection = new \yii\db\Connection([
    'dsn' => 'mysql:host=localhost;dbname=u0928104_imperial',
    'username' => 'root',
    'password' => '454636dim',
]);


$connection->open();
$options = $connection->createCommand('SELECT * FROM im_settings')->queryOne();
$connection->close();

return [
    'adminEmail' => 'admin@imperial-k.ru',
    'supportEmail'=>'admin@imperial-k.ru',
    'ratePercent'=>$options['ratePercent'],
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordRegisterTokenExpire'=>86400,
];
