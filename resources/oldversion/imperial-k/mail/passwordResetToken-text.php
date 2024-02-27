<?php
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Здравствуйте, <?= $user->username ?>!

Следуйте по этой ссылке для сброса пароля

<?= $resetLink ?>